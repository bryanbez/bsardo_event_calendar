<?php
/**
 * @package bsardo_event_calendar
 */

 namespace Inc\Base;

 class BaseController {

     public $plugin_path;
     public $plugin_url;
     public $plugin;
    //  public $managers = [];

     public function __construct() {
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = plugin_basename(dirname(__FILE__, 3)) . '/bsardo_event_calendar.php';

        // $this->managers = [
        //     'add_reservation_page' => 'Add Reservation',
         
        // ]; // this is displayed in the dashboard with checkbox


     }

    //  public function activatedGetOption (string $key) {
         
    //     $option = get_option('bsardo_event_calendar');
    //     return isset($option[$key]) ? $option[$key] : false; 
    //  }


 }