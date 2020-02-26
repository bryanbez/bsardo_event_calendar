<?php
/**
 * @package bsardo_event_calendar
 */

namespace Inc\Base;

class Deactivate {

    public static function deactivate_plugin() {

        flush_rewrite_rules();
    
    }
 }