<?php

/**
 * @package bsardo_event_calendar
 */

 namespace Inc\Base;

 class Activate {

    public static function activate_plugin() {
        
        flush_rewrite_rules();

        $default = array();

        if (! get_option('bsardo_event_calendar')) {
            update_option('bsardo_event_calendar', $default); // generate bsardo_plugin field in wp_option table in database
        }

    }
 }