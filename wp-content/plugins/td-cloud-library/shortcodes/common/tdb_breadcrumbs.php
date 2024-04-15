<?php
/**
 * Class tdb_breadcrumbs
 */

class tdb_breadcrumbs extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @icon_size */
                .$unique_block_class .tdb-bread-sep {
                    font-size: @icon_size;
                }
                /* @icon_space */
                .$unique_block_class .tdb-bread-sep {
                    margin: 0 @icon_space;
                }
                 /* @text_color */
				.$unique_block_class,
				.$unique_block_class a {
					color: @text_color;
				}
                /* @link_h_color */
				.$unique_block_class a:hover {
					color: @link_h_color;
				}
                /* @icon_color */
				.$unique_block_class .tdb-bread-sep {
					color: @icon_color;
				}
				/* @align_center */
				.td-theme-wrap .$unique_block_class {
					text-align: center;
				}
				/* @align_right */
				.td-theme-wrap .$unique_block_class {
					text-align: right;
				}	
				/* @align_left */
				.td-theme-wrap .$unique_block_class {
					text-align: left;
				}
				/* @f_text */
				.$unique_block_class {
					@f_text
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- SEPARATOR ICON -- */
        // separator icon size
        $icon_size = $res_ctx->get_shortcode_att('icon_size');
        $res_ctx->load_settings_raw( 'icon_size', $icon_size );
        if( $icon_size != '' ) {
            if( is_numeric( $icon_size ) ) {
                $res_ctx->load_settings_raw( 'icon_size', $icon_size . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'icon_size', '8px' );
        }

        // separator icon space
        $icon_space = $res_ctx->get_shortcode_att('icon_space');
        $res_ctx->load_settings_raw( 'icon_space', $icon_space );
        if( $icon_space != '' ) {
            if( is_numeric( $icon_space ) ) {
                $res_ctx->load_settings_raw( 'icon_space', $icon_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'icon_space', '5px' );
        }

        // content align
        $content_align = $res_ctx->get_shortcode_att('content_align_horizontal');
        if ( $content_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'align_center', 1 );
        } else if ( $content_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'align_right', 1 );
        } else if ( $content_align == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'align_left', 1 );
        }

        /*-- COLORS -- */
        // text color
        $res_ctx->load_settings_raw( 'text_color', $res_ctx->get_shortcode_att('text_color') );

        // link hover color
        $res_ctx->load_settings_raw( 'link_h_color', $res_ctx->get_shortcode_att('link_h_color') );

        // separator icon color
        $res_ctx->load_settings_raw( 'icon_color', $res_ctx->get_shortcode_att('icon_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_text' );

    }

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts );

        global $tdb_state_single, $tdb_state_category, $tdb_state_author, $tdb_state_search, $tdb_state_date, $tdb_state_tag, $tdb_state_attachment;

        $breadcrumbs_array = array();

        switch( tdb_state_template::get_template_type() ) {
            case 'single':
                $breadcrumbs_array = $tdb_state_single->post_breadcrumbs->__invoke( $this->get_all_atts() );
                break;

            case 'category':
                $breadcrumbs_array = $tdb_state_category->category_breadcrumbs->__invoke( $this->get_all_atts() );
                break;

            case 'author':
                $breadcrumbs_array = $tdb_state_author->author_breadcrumbs->__invoke( $this->get_all_atts() );
                break;

            case 'search':
                $breadcrumbs_array = $tdb_state_search->search_breadcrumbs->__invoke( $this->get_all_atts() );
                break;

            case 'date':
                $breadcrumbs_array = $tdb_state_date->date_breadcrumbs->__invoke( $this->get_all_atts() );
                break;

            case 'tag':
                $breadcrumbs_array = $tdb_state_tag->tag_breadcrumbs->__invoke( $this->get_all_atts() );
                break;

            case 'attachment':
                $breadcrumbs_array = $tdb_state_attachment->attachment_breadcrumbs->__invoke( $this->get_all_atts() );
                break;
        }


        // add home breadcrumb if the theme is configured to show it
        if ( $this->get_att( 'show_home' ) != '' ) {
            array_unshift(
                $breadcrumbs_array,
                array(
                    'title_attribute' => '',
                    'url'             => esc_url( home_url( '/' ) ),
                    'display_name'    => __td( 'Home', TD_THEME_NAME )
                )
            );
        }

        // separator icon
        $separator_icon = $this->get_att( 'tdicon' );

        $buffy = '';

//        $buffy .= '<pre>';
//        $buffy .= '<span style="color: red;">' . print_r( tdb_state_template::get_template_type(), true ) . '</span>';
//        $buffy .= print_r($breadcrumbs_array, true);
//        $buffy .= '</pre>';

        $buffy .= '<div class="' . $this->get_block_classes() . ' tdb-breadcrumbs " ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $array_elements = count( $breadcrumbs_array );

            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                foreach ( $breadcrumbs_array as $key => $breadcrumb ) {

                    if ( $key == $array_elements - 1 ) {
                        $categories_array = array();
                        foreach ( get_categories() as $category ) {
                            $categories_array[] = $category->name;
                        }

                        //last element should not display the url if it's not a category
                        if ( !in_array( $breadcrumb['display_name'], $categories_array ) ) {
                            $breadcrumb['url'] = '';
                        }
                    }

                    if ( empty( $breadcrumb['url'] ) ) {
                        if ( $key != 0 ) { //add separator only after first
                            $buffy .= ' <i class="' . $separator_icon . ' tdb-bread-sep tdb-bred-no-url-last"></i> ';
                        }
                        //no link - breadcrumb
                        $buffy .=  '<span class="tdb-bred-no-url-last">' . esc_html( $breadcrumb['display_name'] ) . '</span>';

                    } else {
                        if ($key != 0) { //add separator only after first
                            $buffy .= ' <i class="' . $separator_icon . ' tdb-bread-sep"></i> ';
                        }
                        //normal links
                        $buffy .= '<span><a title="' . esc_attr( $breadcrumb['title_attribute'] ) . '" class="tdb-entry-crumb" href="' . esc_url( $breadcrumb['url'] ) . '">' . esc_html( $breadcrumb['display_name'] ) . '</a></span>';
                    }
                }

            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

}