<?php
/**
 * Custom coupons for woocommerce
 *
 * @package           custom-coupons
 * @author            Kirubanithi G <kirubanithikm@gmail.com>
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Coupons for WooCommerce
 * Plugin URI:        http://wordpress.org/plugins/hello-wordpress/
 * Description:       Create custom coupons!
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            Kirubanithi G
 * Author URI:        http://example.org/
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('ABSPATH')) {exit;}

/**
 * Define plugin path
 */
if (!defined('CC_PLUGIN_PATH')) {
    define('CC_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

if (file_exists(__DIR__. '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} else {
    wp_die('Custom coupons is unable to find the autoload file.');
}

// To bootstrap the plugin
if (class_exists('CC\App\Route')) {
    new CC\App\Route();
} else {
    wp_die('Custom coupons plugin for WooCommerce is unable to find the Route class.');
}