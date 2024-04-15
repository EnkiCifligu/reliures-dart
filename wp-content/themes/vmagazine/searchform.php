<?php 	
/*
* Default search form for the theme
* @package Vmagazine
*
*/

 ?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e('Search for:','vmagazine')?></span>
		<input type="search" autocomplete="off" class="search-field" placeholder="<?php esc_attr_e( 'Search ...', 'vmagazine' ); ?>" value="" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'vmagazine' ); ?>">

</form>

