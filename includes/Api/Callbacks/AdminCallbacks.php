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

    public function addReservationPage() {
        return require_once("$this->plugin_path/templates/addReservation.php");

    }

    public function pendingReservations() {
        return require_once("$this->plugin_path/templates/manageReservationsTemplate.php");

    }

}