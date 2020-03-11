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
            update_option('bsardo_event_calendar', $default); 
        }

        if (! get_option('bsardo_reservations')) {
            update_option('bsardo_reservations', $default); 
        }

        if (! get_option('bsardo_done_reservations_archive')) {
            update_option('bsardo_done_reservations_archive', $default); 
        }

        if (! get_option('bsardo_reject_reservations_archive')) {
            update_option('bsardo_reject_reservations_archive', $default); 
        }


    }
 }