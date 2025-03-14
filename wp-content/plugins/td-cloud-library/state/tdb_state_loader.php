<?php




class tdb_state_loader {


    /**
     * This is used for composer iframe and composer ajax calls to set the state.
     *  - The global wp_query is the template's
     *  - We have to get the content by making a new wp_query
     */
    static function on_tdc_loaded_load_state() {
        if (tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe()) {

            global $tdb_state_single, $tdb_state_category, $tdb_state_author, $tdb_state_search, $tdb_state_date, $tdb_state_tag, $tdb_state_attachment;

            // get the content id and content type
            $tdbLoadDataFromId = tdb_util::get_get_val('tdbLoadDataFromId');
            $tdbTemplateType = tdb_util::get_get_val('tdbTemplateType');


            // try to load the content, if we fail to load it, we will ship the default state... ? @todo ?
            if ( $tdbLoadDataFromId !== false && $tdbTemplateType !== false ) {
                switch ($tdbTemplateType) {
                    case 'single':
                        // get the content wp_query
                        $wp_query_content = new WP_Query( array(
                                'page_id' => $tdbLoadDataFromId,
                                'post_type' => 'post'
                            )
                        );
                        $tdb_state_single->set_wp_query($wp_query_content);
                    break;

                    case 'attachment':
                        // get the content wp_query
                        $wp_query_content = new WP_Query( array(
                                'page_id' => $tdbLoadDataFromId,
                                'post_type' => 'attachment'
                            )
                        );
                        $tdb_state_attachment->set_wp_query($wp_query_content);
                    break;

                    case 'category':

                        $template_id = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            $current_category_obj = get_category( $tdbLoadDataFromId );
                            $current_category_id = $current_category_obj->cat_ID;

                            // read the individual cat template
                            $tdb_individual_category_template = td_util::get_category_option( $current_category_id, 'tdb_category_template' );

                            // read the global template
                            $tdb_category_template = td_options::get( 'tdb_category_template' );

                            // if we find an individual template..
                            if ( !empty( $tdb_individual_category_template ) && td_global::is_tdb_template( $tdb_individual_category_template ) ) {
                                $template_id = td_global::tdb_get_template_id( $tdb_individual_category_template );
                            } else {
                                // if we don't find an individual template go for a global one
                                if ( td_global::is_tdb_template( $tdb_category_template ) ) {
                                    $template_id = td_global::tdb_get_template_id( $tdb_category_template );
                                }
                            }

                            // if we don't have a template do not build the query
                            if ( !empty( $template_id ) ) {

                                // load the tdb template
                                $wp_query_template = new WP_Query( array(
                                        'p' => $template_id,
                                        'post_type' => 'tdb_templates',
                                    )
                                );
                            }

                            // do not set the template content if we don't find the template
                            if ( !empty( $wp_query_template ) && $wp_query_template->have_posts() ) {
                                $tem_content = $wp_query_template->post->post_content;
                            }
                        }

                        if ( !empty( $tem_content ) ) {
                            // if we have a template do the query with 'posts_per_page' and 'offset' params
                            $wp_query_content = new WP_Query( array(
                                    'cat' => $tdbLoadDataFromId,
                                    'posts_per_page' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','limit' ),
                                    'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' )
                                )
                            );
                        } else {
                            // if we don not have a temp content just get the category wp_query
                            $wp_query_content = new WP_Query( array(
                                    'cat' => $tdbLoadDataFromId,
                                )
                            );
                        }

                        $tdb_state_category->set_wp_query( $wp_query_content );
                    break;

                    case 'author':

                        $template_id = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            // read the template
                            $tdb_author_template = td_options::get( 'tdb_author_template' );
                            if ( td_global::is_tdb_template( $tdb_author_template ) ) {
                                $template_id = td_global::tdb_get_template_id( $tdb_author_template );
                            }

                            // load the tdb template
                            $wp_query_template = new WP_Query( array(
                                    'p' => $template_id,
                                    'post_type' => 'tdb_templates',
                                )
                            );

                            $tem_content = $wp_query_template->post->post_content;
                        }

                        // get the author wp_query
                        $wp_query_content = new WP_Query( array(
                                'author' => $tdbLoadDataFromId,
                                'posts_per_page' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','limit' ),
                                'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' )
                            )
                        );
                        $tdb_state_author->set_wp_query($wp_query_content);
                    break;

                    case 'search':

                        /**
                         *  the search query is made based on query strings not an id
                         *  @todo this may need a different implementation where we can pass multiple query args or the paged arg
                         */

                        $template_id = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            // read the template
                            $tds_search_template = td_options::get( 'tds_search_template' );
                            if ( td_global::is_tdb_template( $tds_search_template ) ) {
                                $template_id = td_global::tdb_get_template_id( $tds_search_template );
                            }

                            // load the tdb template
                            $wp_query_template = new WP_Query( array(
                                    'p' => $template_id,
                                    'post_type' => 'tdb_templates',
                                )
                            );

                            $tem_content = $wp_query_template->post->post_content;
                        }

                        // get the search wp_query
                        $wp_query_content = new WP_Query( array(
                                's' => $tdbLoadDataFromId,
                                'posts_per_page' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','limit' ),
                                'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' )
                            )
                        );
                        $tdb_state_search->set_wp_query($wp_query_content);
                    break;

                    case 'date':

                        /**
                         * the date query may need all year/month/day args while through the "$tdbLoadDataFromId" var we can pass just an id
                         * @todo this needs a different implementation where we can pass multiple query args
                         *  we also need this for paginated(paged) pages, when loading content from page no 2,3,4...
                         */

                        $template_id = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            // read the template
                            $tds_date_template = td_options::get( 'tds_date_template' );
                            if ( td_global::is_tdb_template( $tds_date_template ) ) {
                                $template_id = td_global::tdb_get_template_id( $tds_date_template );
                            }

                            // load the tdb template
                            $wp_query_template = new WP_Query( array(
                                    'p' => $template_id,
                                    'post_type' => 'tdb_templates',
                                )
                            );

                            $tem_content = $wp_query_template->post->post_content;
                        }

                        // get the search wp_query
                        $wp_query_content = new WP_Query( array(
                                'year' => $tdbLoadDataFromId,
                                'posts_per_page' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','limit' ),
                                'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' )
                            )
                        );
                        $tdb_state_date->set_wp_query($wp_query_content);
                    break;

                    case 'tag':

                        $template_id = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            // read the template
                            $tdb_tag_template = td_options::get( 'tdb_tag_template' );
                            if ( td_global::is_tdb_template( $tdb_tag_template ) ) {
                                $template_id = td_global::tdb_get_template_id( $tdb_tag_template );
                            }

                            // load the tdb template
                            $wp_query_template = new WP_Query( array(
                                    'p' => $template_id,
                                    'post_type' => 'tdb_templates',
                                )
                            );

                            $tem_content = $wp_query_template->post->post_content;
                        }

                        $tag = get_tag( $tdbLoadDataFromId, OBJECT );

                        // get the tag wp_query
                        $wp_query_content = new WP_Query( array(
                                'tag' => $tag->name,
                                'posts_per_page' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','limit' ),
                                'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' )
                            )
                        );
                        $tdb_state_tag->set_wp_query($wp_query_content);
                    break;
                }
            }
        }
    }



    /**
     * Here we build the state for the single template when is accessed on the front end,
     *  - we have to do it on this hook because we want to use the wordpress wp_query from it's main query.
     *  - Why we use two hooks to store the state: when td-composer is editing a single template, the main query is the template's query
     *      so we have to make a new query, unlike here where we already have the global wp_query available
     *
     */
    static function on_template_redirect_load_state() {

        global $wp_query, $tdb_state_single, $tdb_state_category, $tdb_state_author, $tdb_state_search, $tdb_state_date, $tdb_state_tag, $tdb_state_attachment;

        // we are on the front end on a post
        if ( is_singular( array( 'post' ) ) ) {
            $tdb_state_single->set_wp_query($wp_query);
        }

        // we are on the front end on an attachment page
        if ( is_singular( array( 'attachment' ) ) ) {
            $tdb_state_attachment->set_wp_query($wp_query);
        }

        // we are on the front end on a category page
        if ( is_category() ) {
            $tdb_state_category->set_wp_query($wp_query);
        }

        // we are on the front end on a author page
         if ( is_author() ) {
            $tdb_state_author->set_wp_query($wp_query);
        }

        // we are on the front end on a search page
         if ( is_search() ) {
            $tdb_state_search->set_wp_query($wp_query);
        }

        // we are on the front end on a date archive page
         if ( is_date() ) {
             $tdb_state_date->set_wp_query($wp_query);
        }

        // we are on the front end on a tag page
         if ( is_tag() ) {
             $tdb_state_tag->set_wp_query($wp_query);
        }
    }
}