<?php

/**
 * @package bsardo_event_calendar
 */
 /**
  * Plugin Name: BSardo Event Calendar
  * Description: My First Custom Plugin after the tutorial
  * Version: 1.0
  * Author: Bryan Sardo
  * Text Domain: bsardo-event-calendar
  */

defined ('ABSPATH') or die ('Not this time script kiddies');

if (file_exists (dirname(__FILE__) .'/vendor/autoload.php')) {
    require_once dirname(__FILE__) .'/vendor/autoload.php';
}

function activate_bsardo_event_calendar() {
    Inc\Base\Activate::activate_plugin();
}

register_activation_hook(__FILE__, 'activate_bsardo_event_calendar');


function deactivate_bsardo_event_calendar() {
    Inc\Base\Deactivate::deactivate_plugin();
}

register_deactivation_hook(__FILE__, 'deactivate_bsardo_event_calendar');


//Initialize all classes of the plugin
if (class_exists('Inc\\Initialization')) {
    Inc\Initialization::register_services();
}
