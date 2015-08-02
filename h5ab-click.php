<?php

/**
 * Plugin Name: Colorful Clicks
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Make Every Click More Interesting with Colorful Clicks
 * Version: 0.2
 * Author: HTML5andBeyond
 * Author URI: https://www.html5andbeyond.com/
 * License: GPL2 or Later
 */

	if ( ! defined( 'ABSPATH' ) ) exit;

	define( 'H5AB_CLICK_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
	define( 'H5AB_CLICK_PLUGIN_URL', plugin_dir_url( __FILE__ ));

    include_once( H5AB_CLICK_PLUGIN_DIR . 'includes/h5ab-click-functions.php');

	if(!class_exists('H5AB_CLICK')) {

			class H5AB_CLICK {

                const _version = '0.2';
				private $formResponse = "";

				public function __construct() {

					add_action( 'admin_menu', array($this, 'add_menu') );

                    add_action( 'wp_enqueue_scripts', array($this, 'load_scripts'), 1 );
                    add_action( 'init', array($this, 'validate_form_callback'), 2 );
                    add_action( 'admin_enqueue_scripts', array($this, 'admin_init'), 3 );

				}

                public function load_scripts() {

					wp_enqueue_script('h5ab-click-js', H5AB_CLICK_PLUGIN_URL . 'js/h5ab-click.js', array('jquery'), '', true);

					$h5abClickArray = get_option('h5abClickArray');
					$clickSettings = (! empty($h5abClickArray))? $h5abClickArray : '';
					
					if(is_array($clickSettings)) $clickSettings = array_map(array($this, "escape"), $clickSettings);

				   wp_enqueue_script('h5ab-click-on-page', H5AB_CLICK_PLUGIN_URL . 'js/h5ab-click-on-page.js', array('jquery'), '', true);
				   wp_localize_script( 'h5ab-click-on-page', 'h5abClickSettings', $clickSettings);

				}

				public function add_menu() {

					add_menu_page('Colorful Clicks', 'Colorful Clicks','administrator', 'h5ab-click-settings',
					array($this, 'plugin_settings_page'), H5AB_CLICK_PLUGIN_URL . 'images/icon.png');

				}

                public function admin_init() {

                    wp_enqueue_style('h5ab-click-spectrum-css', H5AB_CLICK_PLUGIN_URL . 'css/spectrum.css');
                    wp_enqueue_style('h5ab-click-admin-css', H5AB_CLICK_PLUGIN_URL . 'css/h5ab-click-admin.css');

                    wp_enqueue_script('h5ab-click-spectrum-js', H5AB_CLICK_PLUGIN_URL . 'js/spectrum.js', array('jquery'), '', true);

                }

				public function plugin_settings_page() {

					if(!current_user_can('administrator')) {
						  wp_die('You do not have sufficient permissions to access this page.');
					}

					include_once(sprintf("%s/templates/h5ab-click-settings.php", H5AB_CLICK_PLUGIN_DIR));

				}
				
				public function setFormResponse($response) {
					$class = ($response['success']) ? 'updated' : 'error';
				    $this->formResponse =  '<div = class="' . $class . '"><p>' . $response['message'] . '</p></div>';
				}
				
				public function getFormResponse() {
				    $fr = $this->formResponse;
				    echo $fr;
				}

                public function validate_form_callback() {

					if (isset($_POST['h5ab_click_settings_nonce'])) {

							if(wp_verify_nonce( $_POST['h5ab_click_settings_nonce'], 'h5ab_click_settings_n' )) {

								$response = h5ab_click_settings();
								
								$this->setFormResponse($response);

								add_action('admin_notices',  array($this, 'getFormResponse'));
					
							} else {
								wp_die("You do not have access to this page");
							}

					}

				}

				public function escape($item) {
					 return esc_attr($item);
				}

                public static function activate() {

                    $h5abClickArray = array (
                        "h5ab-click-color" => 'blue',
                        "h5ab-click-delay" => '0.25',
                        "h5ab-click-size" => '30',
                        "h5ab-click-disable-input" => 'false'
                    );

                    add_option('h5abClickArray', $h5abClickArray);

				}

                public static function deactivate() {
                    delete_option( 'h5abLoginStyler' );
				}

            }

	}

	if(class_exists('H5AB_CLICK')) {

        register_activation_hook( __FILE__, array('H5AB_CLICK' , 'activate'));
        register_deactivation_hook( __FILE__, array('H5AB_CLICK' , 'deactivate'));

		$H5AB_CLICK = new H5AB_CLICK();

	}


?>
