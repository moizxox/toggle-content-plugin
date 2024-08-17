<?php
/**
 * Plugin Name: Elementor Toggle Content
 * Description: Adds a toggle content widget to Elementor.
 * Version: 1.0
 * Author: Mian Moiz
 * Author URI: https://github.com/moizxox
 */

defined('ABSPATH') or die('No script kiddies please!');

// Enqueue the plugin's CSS and JS for the frontend
function etc_enqueue_assets() {
    wp_enqueue_style('etc-styles', plugin_dir_url(__FILE__) . 'assets/toggle-content.css');
    wp_enqueue_script('etc-scripts', plugin_dir_url(__FILE__) . 'assets/toggle-content.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'etc_enqueue_assets');

// Register Elementor Widget
function etc_register_elementor_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/toggle-content-widget.php');
    $widgets_manager->register(new \Elementor_Toggle_Content_Widget());
}
add_action('elementor/widgets/register', 'etc_register_elementor_widget');

// Enqueue CSS and JS for Elementor editor
add_action('elementor/editor/after_enqueue_scripts', function() {
    // Enqueue CSS for Elementor editor
    wp_enqueue_style('toggle-widget-editor-style', plugin_dir_url(__FILE__) . 'assets/toggle-content.css');
    
    // Enqueue JS for Elementor editor
    wp_enqueue_script('toggle-widget-editor-script', plugin_dir_url(__FILE__) . 'assets/toggle-content.js', ['jquery'], false, true);
});
