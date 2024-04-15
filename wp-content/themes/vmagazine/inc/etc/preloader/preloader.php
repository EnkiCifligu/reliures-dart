<?php
/**
 * @package Vmagazine
 *
 * @since 1.0.3
 */
if ( !function_exists( 'vmagazine_preloader' ) ) {

    function vmagazine_preloader() {
      
        $vmagazine_preloaders_lists = get_theme_mod('vmagazine_preloaders_lists','preloader1');


        switch ( $vmagazine_preloaders_lists ) {
            case 'preloader1':
                ?>
                <div id="loading1" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div id="object"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader2':
                ?>
                <div id="loading2" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two"></div>
                            <div class="object" id="object_three"></div>
                            <div class="object" id="object_four"></div>
                            <div class="object" id="object_five"></div>
                            <div class="object" id="object_six"></div>
                            <div class="object" id="object_seven"></div>
                            <div class="object" id="object_eight"></div>
                            <div class="object" id="object_big"></div>
                        </div>
                    </div> 
                </div>
                <?php
                break;

            case 'preloader3':
                ?>
                <div id="loading3" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="first_object"></div>
                            <div class="object" id="second_object"></div>
                            <div class="object" id="third_object"></div>
                        </div>
                    </div> 
                </div>
                <?php
                break;

            case 'preloader4':
                ?>
                <div id="loading4" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="first_object"></div>
                            <div class="object" id="second_object"></div>
                            <div class="object" id="third_object"></div>
                            <div class="object" id="forth_object"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader5':
                ?>
                <div id="loading5" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two"></div>
                            <div class="object" id="object_three"></div>
                            <div class="object" id="object_four"></div>
                            <div class="object" id="object_five"></div>
                            <div class="object" id="object_six"></div>
                            <div class="object" id="object_seven"></div>
                            <div class="object" id="object_eight"></div>
                            <div class="object" id="object_nine"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader6':
                ?>
                <div id="loading6" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two"></div>
                            <div class="object" id="object_three"></div>
                            <div class="object" id="object_four"></div>
                            <div class="object" id="object_five"></div>
                            <div class="object" id="object_six"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader7':
                ?>
                <div id="loading7" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two"></div>
                            <div class="object" id="object_three"></div>
                            <div class="object" id="object_four"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader8':
                ?>
                <div id="loading8" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two"></div>
                            <div class="object" id="object_three"></div>
                            <div class="object" id="object_four"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader9':
                ?>
                <div id="loading9" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two"></div>
                            <div class="object" id="object_three"></div>
                            <div class="object" id="object_four"></div>
                            <div class="object" id="object_five"></div>
                            <div class="object" id="object_six"></div>
                            <div class="object" id="object_seven"></div>
                            <div class="object" id="object_eight"></div>
                            <div class="object" id="object_big"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader10':
                ?>
                <div id="loading10" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="first_object"></div>
                            <div class="object" id="second_object" style="float:right;"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader11':
                ?>
                <div id="loading11" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader12':
                ?>
                <div id="loading12" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute-one">
                            <div class="object-one"></div>
                            <div class="object-one"></div>
                            <div class="object-one"></div>
                            <div class="object-one"></div>
                            <div class="object-one"></div>
                            <div class="object-one"></div>
                            <div class="object-one"></div>
                            <div class="object-one"></div>
                            <div class="object-one"></div>
                        </div>
                        <div id="loading-center-absolute-two">
                            <div class="object-two"></div>
                            <div class="object-two"></div>
                            <div class="object-two"></div>
                            <div class="object-two"></div>
                            <div class="object-two"></div>
                            <div class="object-two"></div>
                            <div class="object-two"></div>
                            <div class="object-two"></div>
                            <div class="object-two"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader13':
                ?>
                <div id="loading13" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two"></div>
                            <div class="object" id="object_three"></div>
                            <div class="object" id="object_four"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader14':
                ?>
                <div id="loading14" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two" style="left:20px;"></div>
                            <div class="object" id="object_three" style="left:40px;"></div>
                            <div class="object" id="object_four" style="left:60px;"></div>
                            <div class="object" id="object_five" style="left:80px;"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader15':
                ?>
                <div id="loading15" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two"></div>
                            <div class="object" id="object_three"></div>
                            <div class="object" id="object_four"></div>
                            <div class="object" id="object_five"></div>
                            <div class="object" id="object_six"></div>
                            <div class="object" id="object_seven"></div>
                            <div class="object" id="object_eight"></div>
                            <div class="object" id="object_nine"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader16':
                ?>
                <div id="loading16" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader17':
                ?>
                <div id="loading17" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                            <div class="object"></div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'preloader18':
                ?>
                <div id="loading18" class="vmagazine-loader">
                    <div id="loading-center">
                        <div id="loading-center-absolute">
                            <div class="object" id="object_one"></div>
                            <div class="object" id="object_two"></div>
                            <div class="object" id="object_three"></div>
                            <div class="object" id="object_four"></div>
                        </div>
                    </div> 
                </div>
                <?php
                break;
        }
    }

}

add_action( 'vmagazine_preloader', 'vmagazine_preloader' );



if( ! function_exists('vmagazine_prelaoder_styles') ){

    function vmagazine_prelaoder_styles(){

        wp_enqueue_style('vmagazine-preloader-styles', VMAG_URI.'/inc/etc/preloader/preloader.css' );
    }

}
add_action( 'wp_enqueue_scripts', 'vmagazine_prelaoder_styles' );