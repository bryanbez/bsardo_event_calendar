<?php
/**
 * @package bsardo_event_calendar
 */

namespace Inc\Api\Callbacks;

class AddReservationCallbacks {

    public function addReservationMessage() {

         echo isset($_POST['edit_reservation']) ? '<h2> Update Reservation </h2>' : '<h2> Add Reservation </h2>';
    }

    public function AddReservationSanitize( $input ) {
      
        $output = get_option('bsardo_add_reservation');

         if (isset($_POST['submit_reject'])) {

            unset($output[$_POST['reject_reservation']]); // remove reservation
            return $output;
        }

        if (count($output) == 0) {
            $output[$input['reserve_id']] = $input; // using reserve_id as an id for fetching data.
            return $output;
        }

        foreach($output as $key => $value) {

            if ($input['reserve_id'] === $key) {
                $output[$key] = $input; // Update Existing Record
            } else {
                $output[$input['reserve_id']] = $input; // Add Record
            }
        }
    
        return $output;

    }

    public function reserveIDTextBoxField($args) {

        $txt_name = $args['label_for'];
        $passPageValue = $args['passPageValue'];
        $textboxValue = get_option($passPageValue); 
        $value = (isset($_POST['edit_reservation']) ? $textboxValue[$_POST['edit_reservation']][$txt_name] : mt_rand(100, 1000000));

        echo '<input type="text" class="regular-text" readonly id="'.$txt_name.'" name="' . $passPageValue. '[' . $txt_name .
        ']" value="'.$value.'">';  

    }

    public function textBoxField($args) {

        $txt_name = $args['label_for'];
        $passPageValue = $args['passPageValue'];
        $textboxValue = get_option($passPageValue); 
        $value = ($args['label_for'] == 'reservation_date') ? date('d/m/Y') : '';
        $disabledDate = ($args['label_for'] == 'reservation_date') ? 'readonly' : '';

        if(isset($_POST['edit_reservation'])) {
    
            $value = $textboxValue[$_POST['edit_reservation']][$txt_name];
        }

        echo '<input type="text" class="regular-text" id="'.$txt_name.'" name="' . $passPageValue. '[' . $txt_name .
        ']" value="'.$value.'" placeholder="'.$args['placeholder'].'" required '.$disabledDate.'>';  

    }

    public function textAreaField($args) {
        
        $textarea_name = $args['label_for'];
        $passPageValue = $args['passPageValue'];
        $textboxValue = get_option($passPageValue); 
        $value = '';

        if(isset($_POST['edit_reservation'])) {
            $value = $textboxValue[$_POST['edit_reservation']][$textarea_name];
        }

        echo '<textarea rows="7" class="regular-text" id="'.$textarea_name.'" name="' . $passPageValue. '[' . $textarea_name .
        ']" required>'.$value.'</textarea>';  

    }

    public function textBoxDateField($args) {


        $txt_name = $args['label_for'];
        $passPageValue = $args['passPageValue'];
        $textboxValue = get_option($passPageValue); 
        $value = '';

        if(isset($_POST['edit_reservation'])) {
            $value = $textboxValue[$_POST['edit_reservation']][$txt_name];
        }

        echo '<input type="date" class="regular-text" id="'.$txt_name.'" name="' . $passPageValue. '[' . $txt_name .
        ']" value="'.$value.'" required>';

    }

    public function checkBoxField($args) {

        $chk_name = $args['label_for'];
        $passPageValue = $args['passPageValue'];
        $checked = false; 

         foreach ($args['checkboxLists'] as $lists) {

                $checkbox = get_option($passPageValue);
                if(isset($_POST['edit_reservation'])) {
                    $checked = isset($checkbox[$_POST['edit_reservation']][$chk_name][$lists['id']]) ?: false; 
                }

                echo '<input type="checkbox" id="'.$chk_name.'" name="'.$passPageValue.'['.$chk_name.']['.$lists['id'].']" 
                    value="1" class="" '. ($checked ? 'checked' : '') .'><label>'. $lists['title'] .'</label><br /><br />'; 
         } 
    }

    public function radioButtonField($args) {

        $radio_name = $args['label_for'];
        $passPageValue = $args['passPageValue'];
        $checked = false;
        
         foreach ($args['radioButtonLists'] as $lists) {

                $radio_box = get_option($passPageValue);
                if(isset($_POST['edit_reservation'])) {
                    $checked = ($radio_box[$_POST['edit_reservation']][$radio_name] == $lists['id']) ? 'checked' : ''; 
                }

                echo '<input type="radio" id="'.$radio_name.'" name="'.$passPageValue.'['.$radio_name.']" 
                    value="'.$lists['id'].'" class="" '. ($checked ? 'checked' : '') .'><label>'. $lists['title'] .'</label><br /><br />'; 
         } 
    }


}