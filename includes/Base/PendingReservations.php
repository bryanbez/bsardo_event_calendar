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
use \Inc\Api\Callbacks\AddReservationCallbacks;


 class PendingReservations extends BaseController {

    public $subpages = [];
    public $callbacks;
    public $settings;
 
        public function register() {
            
            $this->settings = new SettingsApi(); 
            $this->callbacks = new AdminCallbacks();
            $this->setSubPages();
            $this->settings->addSubPages($this->subpages)->register();
          
        }
    
        public function setSubPages() {
    
            $this->subpages = [
                [
                    'parent_slug' => 'bsardo_event_calendar',
                    'page_title' => 'BSardo Events Calendar',
                    'menu_title' => 'Pending Reservations',
                    'capability' => 'manage_options',
                    'menu_slug' => 'bsardo_pending_reservations',
                    'callback' => array($this->callbacks, 'pendingReservations'),
                ],
            ];
    
        }

 }