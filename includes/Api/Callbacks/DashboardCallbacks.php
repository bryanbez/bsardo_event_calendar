<?php

/**
 *
 * @package bsardo_event_calendar
 * 
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;


 class DashboardCallbacks extends BaseController {

    public $checkboxes = [];

    public function dashboardSettingsSanitize( $input ) {

         return $input;

    }

    public function adminSectionDashboard() {
        // echo 'Event Calendar Dashboard';
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

    public function textBoxField( $args ) {

        $txt_name = $args['label_for'];
        $passPageValue = $args['passPageValue'];
        $textboxValue = get_option($passPageValue); 
        $value = $textboxValue[$txt_name];

        echo '<input type="text" class="regular-text" id="'.$txt_name.'" name="' . $passPageValue. '[' . $txt_name .
        ']" value="'.$value.'" placeholder="'.$args['placeholder'].'" required>';
    }


 }  