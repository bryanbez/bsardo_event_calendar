<?php
/**
 * @package bsardo_event_calendar
 */

 namespace Inc\Base;

 use \Inc\Base\BaseController;

 class Enqueue extends BaseController {

    function enqueue_styles_and_scripts() {

    	wp_enqueue_script('media-upload');
    	wp_enqueue_media();

        wp_enqueue_script('custom_script', $this->plugin_url. 'assets/js/index.min.js');
        wp_enqueue_style('bootstrap', $this->plugin_url. 'assets/css/index.min.css');
    }

    function register() {
        add_action('admin_enqueue_scripts', array( $this, 'enqueue_styles_and_scripts'));
    }

 }