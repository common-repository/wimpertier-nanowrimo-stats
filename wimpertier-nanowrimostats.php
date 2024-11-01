<?php
/*
 * Plugin Name: Wimpertier NaNoWriMo Stats
 * Description: Displays a simple statistic from a National Novel Writing Month writer in a widget.
 * Version: 1.0
 * Author: Simone Truniger
 * Author URI: http://www.simonetruniger.net
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: wtnnwm
*/

/*
 * Defining Paths
*/
define( 'WTNNWM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/*
 * Include Widget
*/
include( WTNNWM_PLUGIN_PATH . 'includes/wtnnwm-widget.php' );
	
/*
 * Include CSS
*/
add_action('wp_enqueue_scripts',  'wtnnwm_scripts'); 
function wtnnwm_scripts() {
	
	wp_register_style( 'wtnnwm-widget', plugins_url( '/css/wtnnwm-widget.css', __FILE__ ) );
	wp_enqueue_style( 'wtnnwm-widget' );
}
	
/*
 * Load translation
*/ 
add_action( 'plugins_loaded', 'wtnnwm_load_textdomain' );
function wtnnwm_load_textdomain() {
  
  load_plugin_textdomain( 'wtnnwm', false, basename( dirname( __FILE__ ) ) . '/languages/' ); 
} 
?>
