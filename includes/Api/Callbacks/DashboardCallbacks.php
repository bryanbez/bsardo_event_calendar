<?php

/**
 *
 * @package bsardo_event_calendar
 * 
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

 class DashboardCallbacks extends BaseController {

    public function checkBoxSanitize( $input ) {

        $output = array();
    
        foreach($this->managers as $key => $value) {
            $output[$key] = isset($input[$key]) ? true : false;
        }
        return $output;
    }

    public function adminSectionDashboard() {
        echo 'Event Calendar Dashboard';
    }

    public function checkBoxField($args) {
        $chk_name = $args['label_for'];
        $classes = $args['class'];
        $passPageValue = $args['passPageValue'];
        $checkbox = get_option($passPageValue);
        $checked = isset($checkbox[$chk_name]) ? ($checkbox[$chk_name] ? true : false): false;

        echo '<input type="checkbox" id="'.$chk_name.'" name="'.$passPageValue.'['.$chk_name.']" 
                value="1" class="" '. ($checked ? 'checked' : '') .'>'; 
    
    }  


 }  