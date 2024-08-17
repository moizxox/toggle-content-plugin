<?php
/**
 * Plugin Name: Elementor Toggle Content
 * Description: Adds a toggle content widget to Elementor.
 * Version: 1.0
 * Author: Mian Moiz
 * Author URI: https://github.com/moizxox
 */

defined('ABSPATH') or die('No script kiddies please!');

// Enqueue the plugin's CSS and JS
function etc_enqueue_assets() {
    wp_enqueue_style('etc-styles', plugins_url('test.css', __FILE__));
    wp_enqueue_script('etc-scripts', plugins_url('test.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'etc_enqueue_assets');

// Register Elementor Widget
function etc_register_elementor_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/toggle-content-widget.php');
    $widgets_manager->register(new \Elementor_Toggle_Content_Widget());
}
add_action('elementor/widgets/register', 'etc_register_elementor_widget');