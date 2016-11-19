<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link http://suitpress.com
 * @since 1.0.0
 * @package Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name: External Featured Image Pro
 * Plugin URI: http://suitpress.com/plugins/external-featured-image/
 * Description: Use external image as featured image of your post, page, product or all post types.
 * Version: 1.0.0
 * Author: SuitPress
 * Author URI: http://suitpress.com/
 * License: GPLv2 or later
 * License URI: http://suitpress.com/licenses/
 * Text Domain: external-featured-image
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_external_featured_image() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-external-featured-image-activator.php';
	External_Featured_Image_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_external_featured_image() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-external-featured-image-deactivator.php';
	External_Featured_Image_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_external_featured_image');
register_deactivation_hook(__FILE__, 'deactivate_external_featured_image');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-external-featured-image.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_external_featured_image() {
	$class = new External_Featured_Image();
	$class->run();
}

// Automatically deactivate itself if some conditions are not met.
run_external_featured_image();