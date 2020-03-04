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


 class AddReservation extends BaseController {

    public $subpages = [];
    public $settings;
    public $callbacks;
    public $add_reservation_callbacks;
    public $setSettings = array();
    public $setSections = array();
    public $setFields = array();
    
        public function register() {
    
            $this->settings = new SettingsApi(); 
            $this->callbacks = new AdminCallbacks();
            $this->add_reservation_callbacks = new AddReservationCallbacks();
            $this->setSubPages();
            $this->setSettings();
            $this->setSections();
            $this->setFields();
            $this->settings->addSubPages($this->subpages)->register();
          
        }
    
        public function setSettings() {
    
            $args = [
                [
                    'option_group' => 'bsardo_add_reservation_settings',
                    'option_name' => 'bsardo_add_reservation',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'AddReservationSanitize'
                    ]
                ]
            ];
    
            $this->settings->setSettings($args);
        } 
    
        public function setSections() {
    
            $args = [
                [
                    'id' => 'bsardo_add_reservation_index',
                    'title' => '',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'addReservationMessage'
                    ],
                    'page' => 'bsardo_add_reservation',
                ]
            ];
    
            $this->settings->setSections($args);
        }
    
        public function setFields() {
    
            $args = [
                [
                    'id' => 'representative_name',
                    'title' => 'Representative Name',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'representative_name',
                        'placeholder' => 'type your name'
                    ]
                ],
                [
                    'id' => 'representative_email',
                    'title' => 'Representative Email',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'representative_email',
                        'placeholder' => 'type your email'
                    ]
                ],
                [
                    'id' => 'representative_contact_no',
                    'title' => 'Representative Contact No.',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'representative_contact_no',
                        'placeholder' => 'type your contact no'
                    ]
                ],
                [
                    'id' => 'reservation_date',
                    'title' => 'Date of Reservation',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'reservation_date',
                        'placeholder' => ''
                    ]
                ],
                [
                    'id' => 'event_name',
                    'title' => 'Event Name',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'event_name',
                        'placeholder' => 'eg. My Event'
                    ]
                ],
                [
                        'id' => 'event_date',
                        'title' => 'Event Date',
                        'callback' => [
                            $this->add_reservation_callbacks,
                            'textBoxDateField'
                        ],
                        'page' => 'bsardo_add_reservation', 
                        'section' => 'bsardo_add_reservation_index',
                        'args' => [
                            'passPageValue' => 'bsardo_add_reservation',
                            'label_for' => 'event_date',
                        ]
                ],
                [
                    'id' => 'facilities_to_use',
                    'title' => 'Facilities to Use',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'checkboxField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'facilities_to_use',
                        'checkboxLists' => [
                            [
                                'id' => 'swimming_pool',
                                'title' => 'Swimming Pool',
                            ],
                            [
                                'id' => 'function_hall',
                                'title' => 'Function Hall',
                            ],
                            [
                                'id' => 'concert_hall',
                                'title' => 'Concert Hall',
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 'time_schedule',
                    'title' => 'Time Schedule',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'radioButtonField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'time_schedule',
                        'radioButtonLists' => [
                            [
                                'id' => 'time_am',
                                'title' => 'AM',
                            ],
                            [
                                'id' => 'time_pm',
                                'title' => 'PM',
                            ],
                            [
                                'id' => 'time_whole_day',
                                'title' => 'Whole Day',
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 'people_count',
                    'title' => 'People Count',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'people_count',
                        'placeholder' => 'how many?'
                    ]
                ],
                [
                    'id' => 'event_details',
                    'title' => 'Event Details',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'textAreaField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'event_details',
                        'placeholder' => 'type the details here'
                    ]
                ],
                [
                    'id' => 'reserve_id',
                    'title' => 'Reserve ID',
                    'callback' => [
                        $this->add_reservation_callbacks,
                        'reserveIDTextBoxField'
                    ],
                    'page' => 'bsardo_add_reservation', 
                    'section' => 'bsardo_add_reservation_index',
                    'args' => [
                        'passPageValue' => 'bsardo_add_reservation',
                        'label_for' => 'reserve_id',
                    ]
                ],
 
            ];
           
            $this->settings->setFields($args);
        }

        public function setSubPages() {
    
            $this->subpages = [
                [
                    'parent_slug' => 'bsardo_event_calendar',
                    'page_title' => 'BSardo Events Calendar',
                    'menu_title' => 'Add Reservation',
                    'capability' => 'manage_options',
                    'menu_slug' => 'bsardo_add_reservation',
                    'callback' => array($this->callbacks, 'addReservationPage'),
                ],
            ];
    
        }

 }