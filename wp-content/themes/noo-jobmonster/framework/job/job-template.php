<?php
if (!function_exists('jm_job_template_loader')) :
    function jm_job_template_loader($template)
    {
        $job_taxes = jm_get_job_taxonomies();
        if (is_post_type_archive('noo_job') || is_tax($job_taxes)) {
            $template = locate_template('archive-noo_job.php');
        }

        return $template;
    }

    add_filter('template_include', 'jm_job_template_loader');
endif;

if (!function_exists('jm_job_post_class')) :
    function jm_job_post_class($output)
    {

        $post_id = get_the_ID();
        if ('noo_job' == get_post_type($post_id)) {
            if ('yes' == noo_get_post_meta($post_id, '_featured', '')) {
                $output[] = 'featured-job';
            }
            if ($closing = noo_get_post_meta($post_id, '_closing', '')) {
                if (absint($closing) < time()) {
                    $output[] = 'closed-job';
                }
            }
            if (noo_get_option('noo_jobs_list_style', '') == 'two') {
                $output[] = 'noo_job-style-2';
            }
        }

        return $output;
    }

    add_filter('post_class', 'jm_job_post_class');
endif;

if (!function_exists('jm_job_social_media')) :
    function jm_job_social_media()
    {
        if (!is_singular('noo_job')) {
            return;
        }

        // Facebook media
        if (noo_get_option('noo_job_social_facebook', true)) {
            $job_id = get_the_ID();
            $thumbnail_id = noo_get_post_meta($job_id, '_cover_image', '');

            if (empty($thumbnail_id)) {
                $company_id = jm_get_job_company($job_id);
                $thumbnail_id = noo_get_post_meta($company_id, '_logo', '');
            }
            $social_share_img = wp_get_attachment_url($thumbnail_id, 'full');
            if (!empty($social_share_img)) :
                ?>
                <meta property="og:url" content="<?php echo get_permalink($job_id); ?>"/>
                <meta property="og:image" content="<?php echo $social_share_img; ?>"/>
                <?php if (is_ssl()) : ?>
                <meta property="og:image:secure_url" content="<?php echo $social_share_img; ?>"/>
            <?php endif; ?>
            <?php endif;
        }
    }

    add_filter('wp_head', 'jm_job_social_media');
endif;

if (!function_exists('jm_job_loop')) :
    function jm_job_loop($args = '')
    {
        $defaults = array(
            'paginate' => 'normal',
            'class' => '',
            'item_class' => 'loadmore-item',
            'query' => '',
            'title_type' => 'text',
            'title' => '',
            'pagination' => 1,
            'excerpt_length' => 30,
            'posts_per_page' => '',
            'ajax_item' => false,
            'featured' => 'recent',
            'no_content' => 'text',
            'display_style' => 'list',
            'list_job_meta' => array(),
            'paginate_data' => array(),
            'show_view_more' => 'yes',
            'show_autoplay' => 'on',
            'is_shortcode' => false,
            'slider_style' => 'style-1',
            'is_widget' => false,
        );
        $loop_args = wp_parse_args($args, $defaults);
        extract($loop_args);

        global $wp_query;
        if (!empty($loop_args['query'])) {
            $wp_query = $loop_args['query'];
        }

        $content_meta = array();

        $content_meta['show_company'] = get_theme_mod('noo_jobs_show_company_name', true);
        $settings_fields = get_theme_mod('noo_jobs_list_fields', 'job_type,job_location,job_date,_closing');

        $content_meta['fields'] = !is_array($settings_fields) ? explode(',', $settings_fields) : $settings_fields;

        // $content_meta['show_type'] = noo_get_option('noo_jobs_show_job_type', true);
        // $content_meta['show_location'] = noo_get_option('noo_jobs_show_job_location', true);
        // $content_meta['show_date'] = noo_get_option('noo_jobs_show_job_date', true);
        // $content_meta['show_closing_date'] = noo_get_option('noo_jobs_show_closing', true);
        // $content_meta['show_category'] = noo_get_option('noo_jobs_show_job_category', false);

        $list_job_meta = array_merge($content_meta, $list_job_meta);

        $paginate_data = apply_filters('noo-job-loop-paginate-data', $paginate_data, $loop_args);

        if ($display_style == 'slider') {
            $class .= ' slider';
            $paginate = '';
        }

        $item_class = array($item_class);
        $item_class[] = 'noo_job';
        $item_class[] = $slider_style;
        ob_start();

        if ($is_shortcode) {
            remove_action('job_list_before', 'noo_job_list_before');
        } else {
            add_action('job_list_before', 'noo_job_list_before');
        }
        if ($is_widget) {
            remove_action('job_list_before', 'noo_job_list_before');
            $pagination = false;
        }

        if ($display_style == 'grid') {
            include(locate_template("layouts/job/loop/grid.php"));
        } elseif ($display_style == 'slider') {
            include(locate_template("layouts/job/loop/slider.php"));
        } elseif ($display_style == 'list2') {
            include(locate_template("layouts/job/loop/list2.php"));
        } elseif ($display_style == 'grid2') {
            include(locate_template("layouts/job/loop/grid2.php"));
        } else {
            include(locate_template("layouts/job/loop/loop.php"));
        }

//        include( locate_template( 'layouts/job/job-'.$display_style.'.php' ) );

        echo ob_get_clean();
        wp_reset_query();
    }
endif;

if (!function_exists('jm_job_detail')) :
    function jm_job_detail($query = null, $in_preview = false)
    {
        if (empty($query)) {
            global $wp_query;
            $query = $wp_query;
        }
        /* add code select detail layout job */
        $layout = noo_get_option('noo_job_detail_layout', 'style-1');
        $layout = isset($_GET['layout']) ? sanitize_text_field($_GET['layout']) : $layout;


        while ($query->have_posts()): $query->the_post();
            global $post;

            $job_id = $post->ID;
            $company_id = jm_get_job_company($post);

            ob_start();
            if (!$in_preview) {
                if (jm_can_view_job($job_id)) {
                    if ('style-1' == $layout) {
                        include(locate_template("layouts/job/single/detail.php"));
                    } else {
                        include(locate_template("layouts/job/single/detail-style-2.php"));
                    }
                } else {
                    include(locate_template("layouts/job/cannot-view-job.php"));
                }
            } else {
                include(locate_template("layouts/forms/noo_job-preview.php"));
            }
            echo ob_get_clean();

        endwhile;
        wp_reset_query();
    }
endif;

if (!function_exists('jm_the_job_meta')) :
    function jm_the_job_meta($args = '', $job = null)
    {
        $defaults = array(
            'show_company' => true,
            // 'show_type'=>true,
            // 'show_location'=>true,
            // 'show_date'=>true,
            // 'show_closing_date'=>false,
            // 'show_category'=>false,

            'fields' => null,
            'job_id' => '',
            'schema' => true,
        );
        $args = wp_parse_args($args, $defaults);

        if (empty($job) || !is_object($job)) {
            $job = get_post(get_the_ID());
        }
        $job_id = $job->ID;

        $html = array();
        $html[] = '<p class="content-meta">';
        // Company Name
        $company_id = jm_get_job_company($job);
        if ($args['show_company']) {

            if (!empty($company_id)) {
                $html[] = '<span class="job-company"> <a href="' . get_permalink($company_id) . '">' . get_the_title($company_id) . '</a></span>';
            }
        }
        if (!empty($company_id) && $args['schema']) {
            $html[] = '<span class="hidden" itemprop="hiringOrganization" itemscope itemtype="http://schema.org/Organization"><span itemprop="name">' . get_the_title($company_id) . '</span></span>';
        }

        $company_name = get_the_title($company_id);
        $company_logo_id = noo_get_post_meta($company_id, '_logo', '');
        $company_logo_url = wp_get_attachment_image_url($company_logo_id);

        $fields_define = jm_get_job_custom_fields();

        if (!empty($args['fields'])) {
            $fields = (array)$args['fields'];
            foreach ($fields as $field_id) {
                $icon_class = isset($fields_define[$field_id]['icon']) ? $fields_define[$field_id]['icon'] : '';
                $icon = str_replace("|", " ", $icon_class);
                if ($field_id == 'job_type') {
                    $allow_multiple_type=strpos( $fields_define[$field_id]['type'], 'multi') !== false;
                    $type = jm_get_job_type($job_id,$allow_multiple_type);
                    if (!empty($type)) {
                        foreach ($type as $typ){
                            $schema = $args['schema'] ? ' employmentType="' . $typ->name . '"' : '';
                            $html[] = '<span class="job-type"' . $schema . '><a href="' . get_term_link($typ, 'job_type') . '" style="color: ' . $typ->color . '"><i class="fa fa-bookmark"></i>' . $typ->name . '</a></span>';
                            $html[] = '<span class="hidden" ' . $schema . '>' . $typ->name . '</a></span>';
                        }

                    }
                } elseif ($field_id == 'job_location') {
                    $locations_html = '';
                    $separator = ', ';
                    $location_name = '';

                    $locations = get_the_terms($job_id, 'job_location');
                    if (!empty($locations) && !is_wp_error($locations)) {
                        foreach ($locations as $location) {
                            $locations_html .= '<a href="' . get_term_link($location->term_id, 'job_location') . '"><em>' . $location->name . '</em></a>' . $separator;
                            $location_name .= $location->name . ', ';
                        }
                        $html[] = '<i class="' . $icon . '"></i>';
                        $html[] = trim($locations_html, $separator);
                        $html[] = '</span>';
                    }
                } elseif ($field_id == 'job_category') {
                    $categories_html = '';
                    $separator = ' - ';

                    $categories = get_the_terms($job_id, 'job_category');
                    if (!empty($categories) && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            $categories_html .= '<a href="' . get_term_link($category->term_id, 'job_category') . '" title="' . esc_attr(sprintf(__("View all jobs in: &ldquo;%s&rdquo;", 'noo'), $category->name)) . '">' . ' ' . $category->name . '</a>' . $separator;
                        }
                        $schema = $args['schema'] ? ' itemprop="occupationalCategory"' : '';
                        $html[] = '<span class="job-category"' . $schema . '>';
                        $html[] = '<i class="' . $icon . '"></i>';
                        $html[] = trim($categories_html, $separator);
                        $html[] = '</span>';
                    }
                } elseif ($field_id == 'job_date') {
                    $html[] = '<span class="job-date">';
                    $html[] = '<time class="entry-date" datetime="' . esc_attr(get_the_date('c', $job_id)) . '">';
                    $html[] = '<i class="fa fa-calendar"></i>';
                    $schema = $args['schema'] ? ' itemprop="datePosted"' : '';
                    $html[] = '<span' . $schema . '>';
                    $html[] = esc_html(get_the_date(get_option('date_format'), $job_id));
                    $html[] = '</span>';

                    $separator = ' - ';
                    if (in_array('_closing', $fields)) {
                        $closing_date = noo_get_post_meta($job_id, '_closing', '');
                        $closing_date = is_numeric($closing_date) ? $closing_date : strtotime($closing_date);
                        if (!empty($closing_date)) {
                            $html[] = '<span>';
                            $html[] = $separator . esc_html(date_i18n(get_option('date_format'), $closing_date));
                            $html[] = '</span>';
                        }
                    }
                    $html[] = '</time>';
                    $html[] = '</span>';
                } elseif ($field_id == '_closing') {
                    if (in_array('job_date', $fields)) {
                        continue;
                    } else {
                        $closing_date = noo_get_post_meta($job_id, '_closing', '');
                        if (!empty($closing_date)) {
                            $html[] = '<span class="job-date">';
                            $html[] = '<time class="entry-date" datetime="' . esc_attr(get_the_date('c', $job_id)) . '">';
                            $html[] = '<i class="fa fa-calendar"></i>';
                            $html[] = '<span>';
                            $closing_date = is_numeric($closing_date) ? $closing_date : strtotime($closing_date);
                            $html[] = esc_html(date_i18n(get_option('date_format'), $closing_date));
                            $html[] = '</span>';
                            $html[] = '</time>';
                            $html[] = '</span>';
                        }
                    }
                } else {
                    $field = jm_get_job_field($field_id);
                    if (empty($field)) {
                        continue;
                    }

                    if (isset($field['is_default'])) {
                        if (isset($field['is_tax'])) {
                            continue;
                        }
                        if ($field['name'] == '_closing') // reserve the _closing field
                        {
                            continue;
                        }
                    }
                    $id = jm_job_custom_fields_name($field['name'], $field);
                    $value = get_post_meta(get_the_ID(), $id, true);
                    $value = noo_convert_custom_field_value($field, $value);

                    $custom_date = noo_get_post_meta($job_id, '_noo_job_field__customdate', '');
                    $date_format = esc_html(date_i18n(get_option('date_format'), strtotime($custom_date)));
                    if ($field['type'] == 'datepicker') {
                        $date = date($date_format, strtotime($value));
                    }

                    if (!empty($date)) {
                        $html[] = '<span class="job-' . $field['name'] . '">';
                        $html[] = '<i class="' . $icon . '"></i>';
                        $html[] = '<em>' . $field['label'] . ': </em>';
                        $html[] = is_array($date) ? implode(', ', $date) : $date;
                        $html[] = '</span>';
                    } elseif (!empty($value)) {
                        $html[] = '<span class="job-' . $field['name'] . '">';
                        $html[] = '<i class="' . $icon . '"></i>';
                        $html[] = '<em>' . $field['label'] . ': </em>';
                        $html[] = is_array($value) ? implode(', ', $value) : $value;
                        $html[] = '</span>';
                        if('_closing' == $field['name']){
                            if($args['schema']):
                                $html[] = '<span class="hidden" itemprop="validThrough">'.$value.'</span>';
                            endif;
                        }
                        if('_salary' == $field['name']){
                            if($args['schema']):
                                $html[] = '<span class="hidden" itemprop="baseSalary">'.$value.'</span>';
                            endif;
                        }
                        if ('_full_address' == $field['name']) {
                            $full_address = explode(',', $value);
                            $postalCode = noo_get_post_meta($job_id,'_postalcode',true);
                            if($args['schema']):
                                $html[] = '<span class="hidden" itemprop="jobLocation" itemscope itemtype="http://schema.org/Place"><span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="streetAddress">' . $full_address[0] . '</span><span itemprop="addressRegion">' . $full_address[1] . '</span><span itemprop="addressLocality">' . $full_address[3] . '</span><span itemprop="postalCode">' . $postalCode . '</span></span></span>';
                            endif;
                        }
                    }
                }
            }
        }

        do_action('job_list_after_meta');

        // if ( is_singular( 'noo_job' ) ) :
        //  // -- Add button print
        //  $html[] = '<span>';
        //  $html[] = '<a href="javascript:void(0)" onclick="return window.print();"><i class="fa fa-print"></i> ' . __( 'Print', 'noo' ) . '</a>';
        //  $html[] = '</span>';
        // endif;

        echo implode($html, "\n");
    }
endif;

if (!function_exists('jm_the_job_tag')) :
    function jm_the_job_tag($job = null)
    {
        if (empty($job) || !is_object($job)) {
            $job = get_post(get_the_ID());
        }
        $job_id = $job->ID;
        $html = array();

        $tags = get_the_terms($job_id, 'job_tag');
        if (!empty($tags)) {
            $html[] = '<div class="entry-tags">';
            $html[] = '<span><i class="fa fa-tag"></i></span>';
            foreach ($tags as $tag) {
                $html[] = '<a href="' . get_term_link($tag->term_id, 'job_tag') . '" title="' . esc_attr(sprintf(__("View all jobs in: &ldquo;%s&rdquo;", 'noo'), $tag->name)) . '">' . ' ' . $tag->name . '</a>';
            }
            $html[] = '</div>';
        }

        echo implode($html, "\n");
    }
endif;

if (!function_exists('jm_the_job_social')) :
    function jm_the_job_social($job_id = null, $title = '')
    {
        if (!noo_get_option('noo_job_social', true)) {
            return;
        }

        $job_id = (null === $job_id) ? get_the_ID() : $job_id;
        if (get_post_type($job_id) != 'noo_job') {
            return;
        }

        $facebook = noo_get_option('noo_job_social_facebook', true);
        $twitter = noo_get_option('noo_job_social_twitter', true);
        $google = noo_get_option('noo_job_social_google', true);
        $pinterest = noo_get_option('noo_job_social_pinterest', false);
        $linkedin = noo_get_option('noo_job_social_linkedin', false);
        $email = noo_get_option('noo_job_social_email', false);

        $share_url = urlencode(get_permalink());
        $share_title = urlencode(get_the_title());
        $share_source = urlencode(get_bloginfo('name'));
        // $share_content = urlencode( get_the_content() );
        $thumbnail_id = noo_get_post_meta($job_id, '_cover_image', '');

        if (empty($thumbnail_id)) {
            $company_id = jm_get_job_company($job_id);
            $thumbnail_id = noo_get_post_meta($company_id, '_logo', '');
        }
        $share_media = !empty($thumbnail_id) ? wp_get_attachment_url($thumbnail_id, 'full') : '';

        $popup_attr = 'resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0';

        $html = array();

        if ($facebook || $twitter || $google || $pinterest || $linkedin || $email) {
            $html[] = '<div class="job-social clearfix">';
            $html[] = '<span class="noo-social-title">';
            $html[] = empty($title) ? __("Share this job", 'noo') : $title;
            $html[] = '</span>';
            if ($facebook) {
                $html[] = '<a href="#share" class="noo-icon fa fa-facebook"' . ' title="' . __('Share on Facebook', 'noo') . '"' . ' onclick="window.open(' . "'http://www.facebook.com/sharer.php?u={$share_url}&amp;t={$share_title}','popupFacebook','width=650,height=270,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($twitter) {
                $html[] = '<a href="#share" class="noo-icon fa fa-twitter"' . ' title="' . __('Share on Twitter', 'noo') . '"' . ' onclick="window.open(' . "'https://twitter.com/intent/tweet?text={$share_title}&amp;url={$share_url}','popupTwitter','width=500,height=370,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($google) {
                $html[] = '<a href="#share" class="noo-icon fa fa-google-plus"' . ' title="' . __('Share on Google+', 'noo') . '"' . ' onclick="window.open(' . "'https://plus.google.com/share?url={$share_url}','popupGooglePlus','width=650,height=226,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($pinterest) {
                $html[] = '<a href="#share" class="noo-icon fa fa-pinterest"' . ' title="' . __('Share on Pinterest', 'noo') . '"' . ' onclick="window.open(' . "'http://pinterest.com/pin/create/button/?url={$share_url}&amp;media={$share_media}&amp;description={$share_title}','popupPinterest','width=750,height=265,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($linkedin) {
                $html[] = '<a href="#share" class="noo-icon fa fa-linkedin"' . ' title="' . __('Share on LinkedIn', 'noo') . '"' . ' onclick="window.open(' . "'http://www.linkedin.com/shareArticle?mini=true&amp;url={$share_url}&amp;title={$share_title}&amp;source={$share_source}','popupLinkedIn','width=610,height=480,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($email) {
                $html[] = '<a href="mailto:?subject=' . $share_title . '&amp;body=' . $share_url . '" class="noo-icon fa fa-envelope-o"' . ' title="' . __('Share on email', 'noo') . '">';
                $html[] = '</a>';
            }

            $html[] = '</div>'; // .noo-social.social-share
        }

        echo implode("\n", $html);
    }
endif;

if (!function_exists('jm_related_jobs')) :
    function jm_related_jobs($job_id, $title = '')
    {
        global $wp_query;
        //  -- args query
        // $terms = get_the_terms( $post->ID , 'noo_job');

        $args = array(
            'post_type' => 'noo_job',
            'post_status' => 'publish',
            // 'tag__in'        => array($first_tag),
            'posts_per_page' => (int)noo_get_option('noo_job_related_num', 8),
            'post__not_in' => array($job_id),
        );

        //  -- tax_query

        $job_categorys = get_the_terms($job_id, 'job_category');
        $job_types = get_the_terms($job_id, 'job_type');
        $job_locations = get_the_terms($job_id, 'job_location');

        $args['tax_query'] = array('relation' => 'AND');
        if ($job_categorys) {
            $term_job_category = array();
            foreach ($job_categorys as $job_category) {
                $term_job_category = array_merge($term_job_category, (array)$job_category->slug);
            }
            $args['tax_query'][] = array(
                'taxonomy' => 'job_category',
                'field' => 'slug',
                'terms' => $term_job_category,
            );
        }

        if ($job_types) {
            $term_job_type = array();
            foreach ($job_types as $job_type) {
                $term_job_type = array_merge($term_job_type, (array)$job_type->slug);
            }
            $args['tax_query'][] = array(
                'taxonomy' => 'job_type',
                'field' => 'slug',
                'terms' => $term_job_type,
            );
        }

        if ($job_locations) {
            $term_job_location = array();
            foreach ($job_locations as $job_location) {
                $term_job_location = array_merge($term_job_location, (array)$job_location->slug);
            }
            $args['tax_query'][] = array(
                'taxonomy' => 'job_location',
                'field' => 'slug',
                'terms' => $term_job_location,
            );
        }

        // --- new query
        $wp_query = new WP_Query($args);

        $loop_args = array(
            'title' => $title,
            'paginate' => null,
            'class' => 'related-jobs hidden-print',
            'item_class' => '',
            'query' => $wp_query,
            'pagination' => false,
            'ajax_item' => null,
            'no_content' => 'none',
            'display_style' => '',
        );

        jm_job_loop($loop_args);
    }
endif;

if (!function_exists('noo_job_list_display_type')) :

    function noo_job_list_display_type()
    {

        $arr_type = array('list', 'grid');

        $defaut = noo_get_option('noo_jobs_display_type', 'list');

        $type = isset($_GET['display']) && in_array($_GET['display'], $arr_type) ? $_GET['display'] : $defaut;

        return $type;
    }

endif;

if (!function_exists('noo_share_social')) :
    function noo_share_social($post_id = null)
    {

        $facebook = noo_get_option('noo_job_social_facebook', true);
        $twitter = noo_get_option('noo_job_social_twitter', true);
        $google = noo_get_option('noo_job_social_google', true);
        $pinterest = noo_get_option('noo_job_social_pinterest', false);
        $linkedin = noo_get_option('noo_job_social_linkedin', false);
        $email = noo_get_option('noo_job_social_email', false);

        $share_url = urlencode(get_permalink());
        $share_title = urlencode(get_the_title());
        $share_source = urlencode(get_bloginfo('name'));

        $thumbnail_id = noo_get_post_meta($post_id, '_cover_image', '');

        if (empty($thumbnail_id)) {
            $company_id = jm_get_job_company($post_id);
            $thumbnail_id = noo_get_post_meta($company_id, '_logo', '');
        }
        $share_media = !empty($thumbnail_id) ? wp_get_attachment_url($thumbnail_id, 'full') : '';

        $popup_attr = 'resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0';

        $html = array();

        if ($facebook || $twitter || $google || $pinterest || $linkedin || $email) {
            $html[] = '<div class="noo-social-share">';
            if ($facebook) {
                $html[] = '<a href="#share" class="noo-icon fa fa-facebook"' . ' title="' . __('Share on Facebook', 'noo') . '"' . ' onclick="window.open(' . "'http://www.facebook.com/sharer.php?u={$share_url}&amp;t={$share_title}','popupFacebook','width=650,height=270,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($twitter) {
                $html[] = '<a href="#share" class="noo-icon fa fa-twitter"' . ' title="' . __('Share on Twitter', 'noo') . '"' . ' onclick="window.open(' . "'https://twitter.com/intent/tweet?text={$share_title}&amp;url={$share_url}','popupTwitter','width=500,height=370,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($google) {
                $html[] = '<a href="#share" class="noo-icon fa fa-google-plus"' . ' title="' . __('Share on Google+', 'noo') . '"' . ' onclick="window.open(' . "'https://plus.google.com/share?url={$share_url}','popupGooglePlus','width=650,height=226,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($pinterest) {
                $html[] = '<a href="#share" class="noo-icon fa fa-pinterest"' . ' title="' . __('Share on Pinterest', 'noo') . '"' . ' onclick="window.open(' . "'http://pinterest.com/pin/create/button/?url={$share_url}&amp;media={$share_media}&amp;description={$share_title}','popupPinterest','width=750,height=265,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($linkedin) {
                $html[] = '<a href="#share" class="noo-icon fa fa-linkedin"' . ' title="' . __('Share on LinkedIn', 'noo') . '"' . ' onclick="window.open(' . "'http://www.linkedin.com/shareArticle?mini=true&amp;url={$share_url}&amp;title={$share_title}&amp;source={$share_source}','popupLinkedIn','width=610,height=480,{$popup_attr}');" . ' return false;">';
                $html[] = '</a>';
            }

            if ($email) {
                $html[] = '<a href="mailto:?subject=' . $share_title . '&amp;body=' . $share_url . '" class="noo-icon fa fa-envelope-o"' . ' title="' . __('Share on email', 'noo') . '">';
                $html[] = '</a>';
            }

            $html[] = '</div>'; // .noo-social.social-share
        }

        echo implode("\n", $html);
    }
endif;

if (!function_exists('noo_job_list_before')) {
    function noo_job_list_before()
    {
        noo_get_layout('job/job_archive_before');
    }
}
if(!function_exists('noo_job_list_customRSS')){
    function noo_job_list_customRSS(){
        noo_get_layout('job/job_feed');
    }
}