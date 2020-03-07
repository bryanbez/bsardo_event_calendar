<?php

/**
 *
 * @package bsardo_event_calendar
 * 
 */
namespace Inc\Base;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ActivityCalendarCallbacks;


 class ActivityCalendar extends BaseController {

    public $subpages = [];
    public $callbacks;
    public $settings;
 
        public function register() {
            
            $this->settings = new SettingsApi(); 
            $this->callbacks = new AdminCallbacks();
            $this->pending_reservation_callbacks = new ActivityCalendarCallbacks();
          
            $this->setSubPages();
            // $this->setSettings();
            // $this->setSections();
            // $this->setFields();

            $this->settings->addSubPages($this->subpages)->register();
          
        }
    
        public function setSubPages() {
    
            $this->subpages = [
                [
                    'parent_slug' => 'bsardo_event_calendar',
                    'page_title' => 'BSardo Events Calendar',
                    'menu_title' => 'Activity Calendar',
                    'capability' => 'manage_options',
                    'menu_slug' => 'bsardo_activity_calendar_page',
                    'callback' => array($this->callbacks, 'activityCalendarPage'),
                ],
            ];
    
        }

        // public function setSettings() {
    
        //     $args = [
        //         [
        //             'option_group' => 'bsardo_reservations_settings',
        //             'option_name' => 'bsardo_reservations',
        //             'callback' => [
        //                 $this->pending_reservation_callbacks,
        //                 'AddReservationSanitize'
        //             ]
        //         ]
        //     ];
    
        //     $this->settings->setSettings($args);
        // } 
    
        // public function setSections() {
    
        //     $args = [
        //         [
        //             'id' => 'bsardo_reservations_index',
        //             'title' => '',
        //             'callback' => [
        //                 $this->pending_reservation_callbacks,
        //                 'addReservationMessage'
        //             ],
        //             'page' => 'bsardo_reservations',
        //         ]
        //     ];
    
        //     $this->settings->setSections($args);
        // }
}