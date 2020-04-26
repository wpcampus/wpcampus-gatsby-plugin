<?php
/**
 * Plugin Name:     WPCampus: Gatsby
 * Plugin URI:      https://github.com/wpcampus/wpcampus-gatsby-plugin
 * Description:     Manages Gatsby-related data for the WPCampus website.
 * Version:         1.0.0
 * Author:          WPCampus
 * Author URI:      https://wpcampus.org
 * Text Domain:     wpc-gatsby
 * Domain Path:     /languages
 *
 * @package         WPCampus_Gatsby
 */

defined( 'ABSPATH' ) or die();

$plugin_dir = plugin_dir_path( __FILE__ );

require_once $plugin_dir . 'inc/class-wpcampus-gatsby-global.php';

if ( is_admin() ) {
	require_once $plugin_dir . 'inc/wpcampus-gatsby-fields.php';
}
