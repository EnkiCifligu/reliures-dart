<?php
/**
 * Template use to render on the front end for single posts
 * - we start with the content context
 * tdb_state_template has a wp-query already, we only get in this template if a template is set, otherwise we load the
 * theme default template
 */
get_header();
global $wp_query;


if (have_posts()) {

    // save the content wp_query - mainly for the top black bar for now and to revert back to it at the end of the template
    tdb_state_content::set_wp_query($wp_query);

	//increment the views counter
	if (!tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe()) {
		td_page_views::update_page_views($post->ID);
	}

    $wp_query = tdb_state_template::get_wp_query(); // set the global wp_query as the template one
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
    echo td_page_generator::no_posts(); //@todo trebuie facut ceva intern si trebuie sa fie in wrapere
}



$wp_query = tdb_state_content::get_wp_query();
$wp_query->rewind_posts();
the_post();


get_footer();
