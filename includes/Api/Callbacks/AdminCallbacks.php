<?php
/**
 * @package bsardo_event_calendar
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController {

    public function adminDashboard() {
        return require_once("$this->plugin_path/templates/index.php");
    }

    public function manageReservations() {
        return require_once("$this->plugin_path/templates/manageReservationsTemplate.php");

    }

    // public function activityCalendarPage() {
    //     return require_once("$this->plugin_path/templates/activityCalendarTemplate.php");

    // }

    public function activityCalendarPage() {
        return require_once("$this->plugin_path/templates/calendarTemplate.php");

    }

}