<?php
/**
 * Plugin Name: JetFormBuilder Select2
 * Plugin URI: #
 * Description: Select2 integraiotn for the JetFormBuilder.
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

add_action( 'plugins_loaded', function() {

	define( 'JFB_S2__FILE__', __FILE__ );
	define( 'JFB_S2_PLUGIN_BASE', plugin_basename( JFB_S2__FILE__ ) );
	define( 'JFB_S2_PATH', plugin_dir_path( JFB_S2__FILE__ ) );
	define( 'JFB_S2_URL', plugins_url( '/', JFB_S2__FILE__ ) );

	// Replace this with your actual field name
	define( 'JFB_FIELD_NAME', 'field_name' );

} );

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'select2', JFB_S2_URL . 'assets/css/select2.min.css', array(), '4.0.13' );
} );

function jfb_select2_init() {
	remove_action( 'jet-form-builder/before-start-form-row', 'jfb_select2_init' );
	wp_enqueue_script( 'select2', JFB_S2_URL . 'assets/js/select2.min.js', array(), '4.0.13', true );
	wp_add_inline_script( 'select2', '
		( function( $ ) {
			var $feild = $( \'select[name="' . JFB_FIELD_NAME . '"]\' );
			if ( $feild.length ) {
				$feild.select2();
			}
		}( jQuery ) );
	' );
}

add_action( 'jet-form-builder/before-start-form-row', 'jfb_select2_init' );
