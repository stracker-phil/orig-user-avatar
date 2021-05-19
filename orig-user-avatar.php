<?php
/*
Plugin Name: Orig User Avatar
Plugin URI:  https://github.com/stracker-phil/orig-user-avatar
Description: Use any image from your WordPress Media Library as a custom user avatar. Add your own Default Avatar.
Author:      Philipp Stracker
Author URI:  https://github.com/stracker-phil
Version:     2.2.16
Text Domain: wp-user-avatar
Domain Path: /lang/
License: GPL v2+

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

/**
 * Let's get started!
 */
class WP_User_Avatar_Setup {
	/**
	 * Constructor
	 *
	 * @since 1.9.2
	 */
	public function __construct() {
		$this->_define_constants();
		$this->_load_wp_includes();
		$this->_load_wpua();
	}

	/**
	 * Define paths
	 *
	 * @since 1.9.2
	 */
	private function _define_constants() {
		define( 'WPUA_VERSION', '2.2.16' );
		define( 'WPUA_FOLDER', basename( dirname( __FILE__ ) ) );
		define( 'WPUA_DIR', plugin_dir_path( __FILE__ ) );
		define( 'WPUA_INC', WPUA_DIR . 'includes' . '/' );
		define( 'WPUA_URL', plugin_dir_url( WPUA_FOLDER ) . WPUA_FOLDER . '/' );
		define( 'WPUA_INC_URL', WPUA_URL . 'includes' . '/' );
	}

	/**
	 * WordPress includes used in plugin
	 *
	 * @uses  is_admin()
	 * @since 1.9.2
	 */
	private function _load_wp_includes() {
		if ( ! is_admin() ) {
			// wp_handle_upload
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			// wp_generate_attachment_metadata
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			// image_add_caption
			require_once( ABSPATH . 'wp-admin/includes/media.php' );
			// submit_button
			require_once( ABSPATH . 'wp-admin/includes/template.php' );
		}
		// add_screen_option
		require_once( ABSPATH . 'wp-admin/includes/screen.php' );
	}

	/**
	 * Load WP User Avatar
	 *
	 * @uses  bool $wpua_tinymce
	 * @uses  is_admin()
	 * @since 1.9.2
	 */
	private function _load_wpua() {
		global $wpua_tinymce;
		require_once( WPUA_INC . 'wpua-globals.php' );
		require_once( WPUA_INC . 'wpua-functions.php' );
		require_once( WPUA_INC . 'class-wp-user-avatar-admin.php' );
		require_once( WPUA_INC . 'class-wp-user-avatar.php' );
		require_once( WPUA_INC . 'class-wp-user-avatar-functions.php' );
		require_once( WPUA_INC . 'class-wp-user-avatar-shortcode.php' );
		require_once( WPUA_INC . 'class-wp-user-avatar-subscriber.php' );
		require_once( WPUA_INC . 'class-wp-user-avatar-update.php' );
		require_once( WPUA_INC . 'class-wp-user-avatar-widget.php' );
		require_once( WPUA_INC . 'mo-notice.php' );

		// Load TinyMCE only if enabled
		if ( (bool) $wpua_tinymce == 1 ) {
			require_once( WPUA_INC . 'wpua-tinymce.php' );
		}

	}
}

/**
 * Initialize
 */
new WP_User_Avatar_Setup();
