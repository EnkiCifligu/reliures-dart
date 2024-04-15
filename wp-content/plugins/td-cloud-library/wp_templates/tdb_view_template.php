<?php
/**
 * Template use to view the template (When you click view on the template in wp-admin)
 * - we start with the template context and we don't have a content context
 */
get_header();
global $wp_query;


if (have_posts()) {


    tdb_state_template::set_wp_query($wp_query);
    the_post();
    // run the template
    ?>
    <div class="td-main-content-wrap td-container-wrap">
        <div class="tdc-content-wrap">
            <?php the_content(); ?>
        </div>
    </div>
    <?php


} else {
    //no posts - use the theme no posts message
    echo td_page_generator::no_posts();
}




get_footer();
