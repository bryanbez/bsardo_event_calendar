<?php
/**
 * @package bsardo_event_calendar
 */

namespace Inc;

class Initialization {

    public static function get_services() {
         return [
            Pages\PluginDashboard::class,
            Base\Enqueue::class,
            Base\ActivityCalendar::class,
            Base\PendingReservations::class,
            Api\SettingsApi::class
         ];
    }

    public static function register_services(){
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
 
        }
    }

    private static function instantiate($class) {
        $service = new $class();
        return $service;
    }
    
}