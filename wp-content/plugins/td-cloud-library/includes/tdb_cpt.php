<?php


/**
 * Add custom columns on wp-admin cpt list
 */
add_filter('manage_tdb_templates_posts_columns', function($columns) {
    $date = $columns['date'];
    unset($columns['date']);
    $columns['tdb_template_type'] = 'Template Type';
    $columns['tdb_default'] = 'Default';
    $columns['date'] = $date;


    return $columns;
});


/**
 * Add custom data to the columns  on wp-admin cpt list
 */
add_action('manage_tdb_templates_posts_custom_column' , function($column, $post_id) {
    switch($column) {
        case 'tdb_template_type':
            echo get_post_meta($post_id, 'tdb_template_type', true);
            break;
        case 'tdb_default':

            $template_type = get_post_meta($post_id, 'tdb_template_type', true);


            switch ($template_type) {
                case 'single':
                    $default_site_post_template = td_options::get('td_default_site_post_template');
                    if (td_global::is_tdb_template($default_site_post_template) && td_global::tdb_get_template_id($default_site_post_template) == $post_id) {
                        $unset_default_class = '';
                        $set_default_class = 'tdb-hide-default';
                    } else {
                        $unset_default_class = 'tdb-hide-default';
                        $set_default_class = '';
                    }
                    break;

                case 'category':
                    $tdb_category_template = td_options::get('tdb_category_template');
                    if (td_global::is_tdb_template($tdb_category_template) && td_global::tdb_get_template_id($tdb_category_template) == $post_id) {
                        $unset_default_class = '';
                        $set_default_class = 'tdb-hide-default';
                    } else {
                        $unset_default_class = 'tdb-hide-default';
                        $set_default_class = '';
                    }
                    break;

                case 'author':
                $tdb_author_template = td_options::get('tdb_author_template');
                if (td_global::is_tdb_template($tdb_author_template) && td_global::tdb_get_template_id($tdb_author_template) == $post_id) {
                    $unset_default_class = '';
                    $set_default_class = 'tdb-hide-default';
                } else {
                    $unset_default_class = 'tdb-hide-default';
                    $set_default_class = '';
                }
                break;

                case 'search':
                $tds_search_template = td_options::get('tds_search_template');
                if (td_global::is_tdb_template($tds_search_template) && td_global::tdb_get_template_id($tds_search_template) == $post_id) {
                    $unset_default_class = '';
                    $set_default_class = 'tdb-hide-default';
                } else {
                    $unset_default_class = 'tdb-hide-default';
                    $set_default_class = '';
                }
                break;

                case 'date':
                $tds_date_template = td_options::get('tds_date_template');
                if (td_global::is_tdb_template($tds_date_template) && td_global::tdb_get_template_id($tds_date_template) == $post_id) {
                    $unset_default_class = '';
                    $set_default_class = 'tdb-hide-default';
                } else {
                    $unset_default_class = 'tdb-hide-default';
                    $set_default_class = '';
                }
                break;

                case 'tag':
                $tdb_tag_template = td_options::get('tdb_tag_template');
                if (td_global::is_tdb_template($tdb_tag_template) && td_global::tdb_get_template_id($tdb_tag_template) == $post_id) {
                    $unset_default_class = '';
                    $set_default_class = 'tdb-hide-default';
                } else {
                    $unset_default_class = 'tdb-hide-default';
                    $set_default_class = '';
                }
                break;

                case 'attachment':
                $tds_attachment_template = td_options::get('tds_attachment_template');
                if (td_global::is_tdb_template($tds_attachment_template) && td_global::tdb_get_template_id($tds_attachment_template) == $post_id) {
                    $unset_default_class = '';
                    $set_default_class = 'tdb-hide-default';
                } else {
                    $unset_default_class = 'tdb-hide-default';
                    $set_default_class = '';
                }
                break;

                case '404':
                $tds_404_template = td_options::get('tds_404_template');
                if (td_global::is_tdb_template($tds_404_template) && td_global::tdb_get_template_id($tds_404_template) == $post_id) {
                    $unset_default_class = '';
                    $set_default_class = 'tdb-hide-default';
                } else {
                    $unset_default_class = 'tdb-hide-default';
                    $set_default_class = '';
                }
                break;
            }






            ?>
            <span class="tdb-working-prompt">Working...</span>
            <a data-post-id="<?php echo $post_id ?>" data-template-type="<?php echo $template_type ?>" class="tdb-unset-default <?php echo $unset_default_class ?>" href="#" title="Set this template as the default template. It will load instead of the theme's single template on all posts that don't have a template set.">Unset default</a>
            <a data-post-id="<?php echo $post_id ?>" data-template-type="<?php echo $template_type ?>" class="tdb-set-default <?php echo $set_default_class ?>" href="#" title="Set this template as the default template. It will load instead of the theme's single template on all posts that don't have a template set in the panel that is under the editor while editing a post.">Set default</a>
            <?php
            break;
    }

}, 10, 2 );


/**
 * add sorting support  on wp-admin cpt list
 */
add_filter('manage_edit-tdb_templates_sortable_columns', function ( $columns ) {
    $columns['tdb_template_type'] = 'tdb_template_type';
    $columns['tdb_default'] = 'tdb_default';
    return $columns;
});


/**
 * change the links for each item on wp-admin cpt list
 */
add_filter('page_row_actions', function ($actions, $post) {
    global $current_screen;
    if (!empty($current_screen) && $current_screen->post_type != 'tdb_templates') {
        return $actions;
    }

    $tdb_template_type = get_post_meta($post->ID, 'tdb_template_type', true);

    // remove the default td-composer edit
    unset($actions['edit_tdc_composer']);

    $actions = array_merge(
        array(
            'edit_tdc_composer' => '<a href="' . admin_url( 'post.php?post_id=' . $post->ID . '&td_action=tdc&tdbTemplateType=' . $tdb_template_type . '&prev_url='  . rawurlencode(tdc_util::get_current_url() ) ) . '">Edit template</a>'
        ),
        $actions
    );
    unset($actions['inline hide-if-no-js']); // hide quick edit

    return $actions;
}, 11, 2 );

