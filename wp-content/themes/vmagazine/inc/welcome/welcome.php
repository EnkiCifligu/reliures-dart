<?php
	if(!class_exists('Vmagazine_Welcome')) :

		class Vmagazine_Welcome {

			public $tab_sections = array();

			public $theme_name = ''; // For storing Theme Name
			public $theme_version = ''; // For Storing Theme Current Version Information
			public $documentation_link = ''; // Theme Documentation Link
			public $free_plugins = array(); // For Storing the list of the Recommended Free Plugins
			public $pro_plugins = array(); // For Storing the list of the Recommended Pro Plugins
			public $req_plugins = array(); // For Storing the list of the Required Plugins
			public $companion_plugins = array(); // For Storing the list of the Companion Plugins

			/**
			 * Constructor for the Welcome Screen
			 */
			public function __construct() {

				/** Useful Variables **/
				$theme = wp_get_theme();
				$this->theme_name = $theme->Name;
				$this->theme_version = $theme->Version;

				/** List of Companion Plugins **/
				$this->companion_plugins = array(

					'vmagazine-companion' => array(
						'slug' => 'vmagazine-companion',
						'name' => esc_html__('Vmagazine Companion', 'vmagazine'),
						'filename' =>'vmagazine-companion.php',
						'class_name' => 'Vmagazine_Companion',
						'class' => 'Vmagazine_Companion',
						'github_repo' => false,
						'bundled' => true,
						'location' => admin_url().'themes.php?page=tgmpa-install-plugins&plugin_status=install',
						'info' => esc_html__('This plugin is required to make the theme work properly', 'vmagazine'),
					),

					

				);



				/** List of required Plugins **/
				$this->req_plugins = array(

					'access-demo-importer' => array(
						'slug' => 'access-demo-importer',
						'name' => esc_html__('Vmagazine Demo Importer', 'vmagazine'),
						'filename' =>'access-demo-importer.php',
						'bundled' => true,
						'class' => 'PDI_Importer',
						'location' => admin_url().'themes.php?page=tgmpa-install-plugins&plugin_status=install',
						'info' => esc_html__('Access Demo Importer Plugin adds the feature to Import the Demo Conent with a single click.', 'vmagazine'),
					),
                    

				);

				/** Define Tabs Sections **/
				$this->tab_sections = array(
					'getting_started' => esc_html__('Getting Started', 'vmagazine'),
					'actions_required' => esc_html__('Actions Required', 'vmagazine'),
					'demo_import' => esc_html__('Import Demo', 'vmagazine'),
					'support' => esc_html__('Support', 'vmagazine'),
				);

				

				/** Links **/

				/* Theme Activation Notice */
				add_action( 'load-themes.php', array( $this, 'vmagazine_activation_admin_notice' ) );

				/* Create a Welcome Page */
				add_action( 'admin_menu', array( $this, 'vmagazine_welcome_register_menu' ) );

				/* Enqueue Styles & Scripts for Welcome Page */
				add_action( 'admin_enqueue_scripts', array( $this, 'vmagazine_welcome_styles_and_scripts' ) );


				add_action( 'init', array( $this, 'get_required_plugin_notification' ));

			}

			public function get_required_plugin_notification() {
                
				$req_plugins = $this->companion_plugins;
				$notif_counter = count($this->companion_plugins);
				$vmagazine_plugin_installed_notif = get_option('vmagazine_plugin_installed_notif');

				foreach($req_plugins as $plugin) {
                    
					$folder_name = $plugin['slug'];
					$file_name = $plugin['filename'];
					$path = WP_PLUGIN_DIR.'/'.esc_attr($folder_name).'/'.esc_attr($file_name);
					if(file_exists( $path )) {
						if(($plugin['class_name'])) {
							$notif_counter--;
						}
					}
				}
				update_option('vmagazine_plugin_installed_notif', absint($notif_counter));
				return $notif_counter;
			}

			/** Welcome Message Notification on Theme Activation **/
			public function vmagazine_activation_admin_notice() {
				global $pagenow;

				if( is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated'])) ) {
					?>
					<div class="notice notice-success is-dismissible">
						<p><?php printf( wp_kses_post( 'Welcome! Thank you for choosing %1$s! Please make sure you visit our <a href="%2$s">Welcome page</a> to get started with Vmagazine.', 'vmagazine' ), $this->theme_name, admin_url( 'themes.php?page=vmagazine-welcome' )  ); ?></p>
						<p><a class="button" href="<?php echo admin_url( 'themes.php?page=vmagazine-welcome' ) ?>"><?php esc_html_e( 'Lets Get Started', 'vmagazine' ); ?></a></p>
					</div>
					<?php
				}
			}

			/** Register Menu for Welcome Page **/
			public function vmagazine_welcome_register_menu() {
				$action_count = get_option('vmagazine_plugin_installed_notif');
				$title        = $action_count > 0 ? esc_html__( 'Welcome', 'vmagazine' ) . '<span class="badge pending-tasks">' . esc_html( $action_count ) . '</span>' : esc_html__( 'Welcome', 'vmagazine' );
				add_theme_page( 'Welcome', $title , 'edit_theme_options', 'vmagazine-welcome', array( $this, 'vmagazine_welcome_screen' ));
			}

			/** Welcome Page **/
			public function vmagazine_welcome_screen() {
				$tabs = $this->tab_sections;

				$current_section = isset($_GET['section']) ? $_GET['section'] : 'getting_started';
				$section_inline_style = '';
				?>
				<div class="wrap about-wrap access-wrap">
					<h1><?php printf( esc_html__( 'Welcome to %s - Version %s', 'vmagazine' ), $this->theme_name, $this->theme_version ); ?></h1>
					<div class="about-text"><?php printf( esc_html__( 'The %s is full fledged Premium WordPress theme for companies. The theme comes with spectacular design and powerful features. It is a highly flexible theme that gives you full control to design and manage your dream website as per your wish.', 'vmagazine' ), $this->theme_name ); ?></div>

					<a target="_blank" href="http://www.accesspressthemes.com" class="accesspress-badge wp-badge"><span><?php echo esc_html('AccessPressThemes'); ?></span></a>

				<div class="nav-tab-wrapper clearfix">
					<?php foreach($tabs as $id => $label) : ?>
						<?php
							$section = isset($_REQUEST['section']) ? esc_attr($_REQUEST['section']) : 'getting_started';
							$nav_class = 'nav-tab';
							if($id == $section) {
								$nav_class .= ' nav-tab-active';
							}
						?>
						<a href="<?php echo admin_url('themes.php?page=vmagazine-welcome&section='.$id); ?>" class="<?php echo esc_attr($nav_class); ?>" >
							<?php echo esc_html( $label ); ?>
							<?php if($id == 'actions_required') : $not = $this->get_required_plugin_notification(); ?>
								<?php if($not) : ?>
							   		<span class="pending-tasks">
						   				<?php echo esc_html($not); ?>
						   			</span>
				   				<?php endif; ?>
						   	<?php endif; ?>
					   	</a>
					<?php endforeach; ?>
			   	</div>

		   		<div class="welcome-section-wrapper">
	   				<?php $section = isset($_REQUEST['section']) ? $_REQUEST['section'] : 'getting_started'; ?>

   					<div class="welcome-section <?php echo esc_attr($section); ?> clearfix">
   						<?php require_once get_template_directory() . '/inc/welcome/sections/'.esc_html($section).'.php'; ?>
					</div>
			   	</div>
			   	</div>
				<?php
			}

			/** Enqueue Necessary Styles and Scripts for the Welcome Page **/
			public function vmagazine_welcome_styles_and_scripts() {
				wp_enqueue_style( 'vmagazine-welcome-screen', get_template_directory_uri() . '/inc/welcome/css/welcome.css' );

				wp_localize_script( 'vmagazine-welcome-screen', 'vmagazineWelcomeObject', array(
					'admin_nonce'	=> wp_create_nonce('vmagazine_plugin_installer_nonce'),
					'activate_nonce'	=> wp_create_nonce('vmagazine_plugin_activate_nonce'),
					'ajaxurl'		=> esc_url( admin_url( 'admin-ajax.php' ) ),
					'activate_btn' => esc_html__('Activate', 'vmagazine'),
					'installed_btn' => esc_html__('Activated', 'vmagazine'),
					'demo_installing' => esc_html__('Installing Demo', 'vmagazine'),
					'demo_installed' => esc_html__('Demo Installed', 'vmagazine'),
					'demo_confirm' => esc_html__('Are you sure to import demo content ?', 'vmagazine'),
				) );
			}

			/** Plugin API **/
			public function vmagazine_call_plugin_api( $plugin ) {
				include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				$call_api = plugins_api( 'plugin_information', array(
					'slug'   => $plugin,
					'fields' => array(
						'downloaded'        => false,
						'rating'            => false,
						'description'       => false,
						'short_description' => true,
						'donate_link'       => false,
						'tags'              => false,
						'sections'          => true,
						'homepage'          => true,
						'added'             => false,
						'last_updated'      => false,
						'compatibility'     => false,
						'tested'            => false,
						'requires'          => false,
						'downloadlink'      => false,
						'icons'             => true
					)
				) );

				return $call_api;
			}

			/** Check For Icon **/
			public function vmagazine_check_for_icon( $arr ) {
				if ( ! empty( $arr['svg'] ) ) {
					$plugin_icon_url = $arr['svg'];
				} elseif ( ! empty( $arr['2x'] ) ) {
					$plugin_icon_url = $arr['2x'];
				} elseif ( ! empty( $arr['1x'] ) ) {
					$plugin_icon_url = $arr['1x'];
				} else {
					$plugin_icon_url = $arr['default'];
				}

				return $plugin_icon_url;
			}

			/** Check if Plugin is active or not **/
			public function vmagazine_plugin_active($plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];
				$class = $plugin['class'];
				$status = 'install';
				
				$path = WP_PLUGIN_DIR.'/'.esc_attr($folder_name).'/'.esc_attr($file_name);
				if( file_exists( $path ) ){
					$status = ( class_exists($class) ) ? 'inactive' : 'active';
				}
				

				return $status;
			}

			/** Generate Url for the Plugin Button **/
			public function vmagazine_plugin_generate_url($status, $plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];

				switch ( $status ) {
					case 'install':
						return wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'install-plugin',
									'plugin' => esc_attr($folder_name)
								),
								network_admin_url( 'update.php' )
							),
							'install-plugin_' . esc_attr($folder_name)
						);
						break;

					case 'inactive':
						return add_query_arg( array(
							                      'action'        => 'deactivate',
							                      'plugin'        => rawurlencode( esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
							                      'plugin_status' => 'all',
							                      'paged'         => '1',
							                      '_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
						                      ), network_admin_url( 'plugins.php' ) );
						break;

					case 'active':
						return add_query_arg( array(
							                      'action'        => 'activate',
							                      'plugin'        => rawurlencode( esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
							                      'plugin_status' => 'all',
							                      'paged'         => '1',
							                      '_wpnonce'      => wp_create_nonce( 'activate-plugin_' . esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
						                      ), network_admin_url( 'plugins.php' ) );
						break;
				}
			}

		
			


			

			public function all_required_plugins_installed() {

		      	$companion_plugins = $this->companion_plugins;
				$show_success_notice = false;

				foreach($companion_plugins as $plugin) {

					$path = WP_PLUGIN_DIR.'/'.esc_attr($plugin['slug']).'/'.esc_attr($plugin['filename']);

					if(file_exists($path)) {
						if(($plugin['class_name'])) {
							$show_success_notice = true;
						} else {
							$show_success_notice = false;
							break;
						}
					} else {
						$show_success_notice = false;
						break;
					}
				}

				return $show_success_notice;
	      	}

			public static function get_plugin_file( $plugin_slug ) {
		         require_once ABSPATH . '/wp-admin/includes/plugin.php'; // Load plugin lib
		         $plugins = get_plugins();

		         foreach( $plugins as $plugin_file => $plugin_info ) {

			         // Get the basename of the plugin e.g. [askismet]/askismet.php
			         $slug = dirname( plugin_basename( $plugin_file ) );

			         if($slug){
			            if ( $slug == $plugin_slug ) {
			               return $plugin_file; // If $slug = $plugin_name
			            }
		            }
		         }
		         return null;
	      	}

		  	public function get_local_dir_path($plugin) {

	      		$url = wp_nonce_url(admin_url('themes.php?page=vmagazine-welcome&section=import_demo'),'vmagazine-file-installation');
				if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {
					return; // stop processing here
				}

	      		if ( ! WP_Filesystem($creds) ) {
					request_filesystem_credentials($url, '', true, false, null);
					return;
				}

				global $wp_filesystem;
				$file = $wp_filesystem->get_contents( $plugin['location'] );

				$file_location = get_template_directory().'/inc/welcome/plugins/'.$plugin['slug'].'.zip';

				$wp_filesystem->put_contents( $file_location, $file, FS_CHMOD_FILE );

				return $file_location;
	      	}

		}

		new Vmagazine_Welcome();

	endif;

	