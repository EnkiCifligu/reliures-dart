<?php


//AJAX VIEW PANEL LOADING
add_action( 'wp_ajax_td_panel_vue_get_data', array('td_panel_vue', 'get_data'));



class td_panel_vue {

	static function get_data() {

		// die if request is fake
		check_ajax_referer('td-panel-box', 'td_magic_token');


		//if user is logged in and can switch themes
		if (!current_user_can('edit_theme_options')) {
			die;
		}

		$buffy = array();
		$data_type = td_util::get_http_post_val('td_data_type');

		switch($data_type) {
			case 'author-templates':
				$buffy['td_users_list'] = self::get_users();
				$buffy['td_author_templates'] = self::get_author_templates();
				break;
			default:
				die;
		}

		die(json_encode($buffy));
	}



	/**
	 * Get wordpress users
	 * @param int $number
	 * @param int $offset
	 *
	 * @return array
	 */
	private static function get_users($number = 10, $offset = 0) {
		$td_users_list = array();
		$args = array(
			'number' => $number,
			'offset' => $offset
		);

		$user_query = new WP_User_Query($args);
		$wp_users_list = $user_query->get_results();

		$author_template = td_util::get_option('author_template');

		foreach ( $wp_users_list as $user ) {
			$tdb_template_id = '';
			if (!empty($author_template[$user->ID])) {
				$tdb_template_id = $author_template[$user->ID];
			}

			$td_users_list[ $user->ID ] = array(
				'ID'            => $user->ID,
				'user_login'    => $user->data->user_login,
				'user_nicename' => $user->data->user_nicename,
				'tdb_template_id' => $tdb_template_id
			);
		}

		return $td_users_list;
	}



	/**
	 * Get TD Cloud Library author templates
	 * @return array
	 */
	private static function get_author_templates() {
		$tdb_author_templates = array();

		$wp_query_templates = new WP_Query( array(
				'post_type' => 'tdb_templates',
				'posts_per_page' => -1
			)
		);

		if ( !empty( $wp_query_templates->posts ) ) {
			foreach ( $wp_query_templates->posts as $post ) {
				$tdb_template_type = get_post_meta( $post->ID, 'tdb_template_type', true );

				if ( $tdb_template_type === 'author' ) {
					$tdb_author_templates[$post->ID] = $post->post_title;
				}
			}
		}

		return $tdb_author_templates;
	}

}