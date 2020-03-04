<?php
/**
 * @package bsardo_event_calendar
 */

namespace Inc\Pages;
  
use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\DashboardCallbacks;

 class PluginDashboard extends BaseController {

    public $settings;
    public $pages = [];
    public $callbacks;
    public $dashboard_callbacks;

    public function register() {

        $this->settings = new SettingsApi(); 
        $this->callbacks = new AdminCallbacks();
        $this->dashboard_callbacks = new DashboardCallbacks();
        $this->setPages();
        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages($this->pages)->withSubpages('PluginDashboard')->register();
    }

    public function setSettings() {

        $args = [
            [
                'option_group' => 'bsardo_event_calendar_settings',
                'option_name' => 'bsardo_event_calendar',
                'callback' => [
                    $this->dashboard_callbacks,
                    'dashboardSettingsSanitize'
                ]
            ]
        ];

        $this->settings->setSettings($args);
    }


    public function setPages() {

        $this->pages = [
            [ 
                'page_title' => 'BSardo Event Calendar',
                'menu_title' => 'BSardo Event Calendar',
                'capability' => 'manage_options',
                'menu_slug' => 'bsardo_event_calendar',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-calendar-alt',
                'position' => 110
            ],

        ];
    }

    public function setSections() {

        $args = [
            [
                'id' => 'bsardo_event_calendar_admin_id',
                'title' => 'Event Calendar Settings',
                'callback' => [
                    $this->dashboard_callbacks,
                    'adminSectionDashboard'
                ],
                'page' => 'bsardo_event_calendar',
            ]
        ];

        $this->settings->setSections($args);
    }

    public function setFields() {

        $args = [
            [
                'id' => 'export_calendar_data',
                'title' => 'Export Calendar Data',
                'callback' => [
                    $this->dashboard_callbacks,
                    'checkBoxField'
                ],
                'page' => 'bsardo_event_calendar',
                'section' => 'bsardo_event_calendar_admin_id',
                'args' => [
                    'passPageValue' => 'bsardo_event_calendar',
                    'label_for' => 'export_calendar_data',
                    'class' => 'form-control'
                ]
                
            ],
            [
                'id' => 'bsardo_calendar_name',
                'title' => 'Calendar Name',
                'callback' => [
                    $this->dashboard_callbacks,
                    'textBoxField'
                ],
                'page' => 'bsardo_event_calendar',
                'section' => 'bsardo_event_calendar_admin_id',
                'args' => [
                    'passPageValue' => 'bsardo_event_calendar',
                    'label_for' => 'bsardo_calendar_name',
                    'class' => 'form-control',
                    'placeholder' => 'e.g. My Calendar'
                ]
            ],
            [
                'id' => 'dark_theme',
                'title' => 'Dark Theme Mode',
                'callback' => [
                    $this->dashboard_callbacks,
                    'checkBoxField'
                ],
                'page' => 'bsardo_event_calendar',
                'section' => 'bsardo_event_calendar_admin_id',
                'args' => [
                    'passPageValue' => 'bsardo_event_calendar',
                    'label_for' => 'dark_theme',
                    'class' => 'form-control'
                ]
                    
            ]


        ];
       
        // foreach($this->dashboard_settings_fields->fields as $key => $value) {
   
        //     $args[] = [
        //         'id' => $key,
        //         'title' => $value,
        //         'callback' => [
        //             $this->dashboard_callbacks,
        //             'checkBoxField'
        //         ],
        //         'page' => 'bsardo_event_calendar',
        //         'section' => 'bsardo_event_calendar_admin_id',
        //         'args' => [
        //             'passPageValue' => 'bsardo_event_calendar',
        //             'label_for' => $key,
        //             'class' => 'form-control'
        //         ]
        //     ];    

        // }

        $this->settings->setFields($args);
    }

 }