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
use \Inc\Api\Callbacks\PendingReservationCallbacks;


 class PendingReservations extends BaseController {

    public $subpages = [];
    public $callbacks;
    public $settings;
 
        public function register() {
            
            $this->settings = new SettingsApi(); 
            $this->callbacks = new AdminCallbacks();
            $this->pending_reservation_callbacks = new PendingReservationCallbacks();
            $this->passToDoneEventsArchive();
            $this->setSubPages();
            $this->setSettings();
            $this->setSections();
            $this->setFields();

            $this->settings->addSubPages($this->subpages)->register();
          
        }

        public function passToDoneEventsArchive() { // pass the past event info into done event archive table field 

            $output = get_option('bsardo_reservations');

            $getDoneEventFields = [];
   
            $currDay = getdate()['year'].'-'.$this->addZeroInSingleDigitDaysInCurrDay(getdate()['mon']).'-'.getdate()['mday'];
   
            foreach($output as $key => $value) {

                if ($currDay > $value['event_date']) {

                    $getDoneEventFields[$key] = $value;
                    unset($output[$key]);
            
                }

            }

            if (count($getDoneEventFields) != 0) {
                update_option('bsardo_done_reservations_archive', $getDoneEventFields);
            }   
            
            update_option('bsardo_reservations', $output);
            
         }
   
         public function addZeroInSingleDigitDaysInCurrDay($month) {
   
            if ($month < 10) {
                return '0'.$month;
            }
            else {
                return $month;
            }
   
         }

        public function setSettings() {
    
            $args = [
                [
                    'option_group' => 'bsardo_reservations_settings',
                    'option_name' => 'bsardo_reservations',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'AddReservationSanitize'
                    ]
                ]
            ];
    
            $this->settings->setSettings($args);
        } 
    
        public function setSections() {
    
            $args = [
                [
                    'id' => 'bsardo_reservations_index',
                    'title' => '',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'addReservationMessage'
                    ],
                    'page' => 'bsardo_reservations',
                ]
            ];
    
            $this->settings->setSections($args);
        }
    
        public function setSubPages() {
    
            $this->subpages = [
                [
                    'parent_slug' => 'bsardo_event_calendar',
                    'page_title' => 'BSardo Events Calendar',
                    'menu_title' => 'Manage Reservations',
                    'capability' => 'manage_options',
                    'menu_slug' => 'bsardo_reservations_page',
                    'callback' => array($this->callbacks, 'manageReservations'),
                ],
            ];
    
        }

         public function setFields() {
    
            $args = [
                [
                    'id' => 'representative_name',
                    'title' => 'Representative Name',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
                        'label_for' => 'representative_name',
                        'placeholder' => 'type your name'
                    ]
                ],
                [
                    'id' => 'representative_email',
                    'title' => 'Representative Email',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
                        'label_for' => 'representative_email',
                        'placeholder' => 'type your email'
                    ]
                ],
                [
                    'id' => 'representative_contact_no',
                    'title' => 'Representative Contact No.',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
                        'label_for' => 'representative_contact_no',
                        'placeholder' => 'type your contact no'
                    ]
                ],
                [
                    'id' => 'reservation_date',
                    'title' => 'Date of Reservation',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
                        'label_for' => 'reservation_date',
                        'placeholder' => ''
                    ]
                ],
                [
                    'id' => 'event_name',
                    'title' => 'Event Name',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
                        'label_for' => 'event_name',
                        'placeholder' => 'eg. My Event'
                    ]
                ],
                [
                        'id' => 'event_date',
                        'title' => 'Event Date',
                        'callback' => [
                            $this->pending_reservation_callbacks,
                            'textBoxDateField'
                        ],
                        'page' => 'bsardo_reservations', 
                        'section' => 'bsardo_reservations_index',
                        'args' => [
                            'passPageValue' => 'bsardo_reservations',
                            'label_for' => 'event_date',
                        ]
                ],
                [
                    'id' => 'facilities_to_use',
                    'title' => 'Facilities to Use',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'checkboxField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
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
                        $this->pending_reservation_callbacks,
                        'radioButtonField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
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
                        $this->pending_reservation_callbacks,
                        'textBoxField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
                        'label_for' => 'people_count',
                        'placeholder' => 'how many?'
                    ]
                ],
                [
                    'id' => 'event_details',
                    'title' => 'Event Details',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'textAreaField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
                        'label_for' => 'event_details',
                        'placeholder' => 'type the details here'
                    ]
                ],
                [
                    'id' => 'reserve_id',
                    'title' => 'Reserve ID',
                    'callback' => [
                        $this->pending_reservation_callbacks,
                        'reserveIDTextBoxField'
                    ],
                    'page' => 'bsardo_reservations', 
                    'section' => 'bsardo_reservations_index',
                    'args' => [
                        'passPageValue' => 'bsardo_reservations',
                        'label_for' => 'reserve_id',
                    ]
                ],
 
            ];
           
            $this->settings->setFields($args);
        }

 }