
<?php

/**
 *
 * @package bsardo_event_calendar
 * 
 */

// namespace Inc\Calendar;

 class CalendarAdmin {

    public $month;
    public $year;
    public $currDay;
    public $nowArray;
    public $start;
    public $firstdayArray;
    public $days = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
    public $arrayOfEventDates = [];
    public $addClass;
    public $title;
    public $getFullDate;
    public $addEventBtn;
    public $countEventPerDay;
  
    public function __construct() {

        define("ADAY", (60*60*24));

            if ((!isset($_POST['month'])) || (!isset($_POST['year']))){
                $this->nowArray = getdate();
                $this->month = $this->nowArray['mon'];
                $this->year = $this->nowArray['year'];
                
            }
            else {
                $this->month = $_POST['month'];
                $this->year = $_POST['year'];    
                
            }
      
          $this->start = mktime(12, 0, 0, $this->month, 1, $this->year);
          $this->firstdayArray = getdate($this->start);

          $this->currDay = getdate()['year'].'-'.$this->addZeroInSingleDigitDaysInCurrDay(getdate()['mon']).'-'.getdate()['mday'];

    
    }

    public function putCalendarDays() {

        echo "<center><table class='activityCalendar' cellpadding='5'><tr>";

        foreach ($this->days as $day){
            echo "<th><strong> ".$day." </strong></th>";
        }

            $options = get_option("bsardo_reservations"); // get the field that stores the reservations.

            foreach ($options as $value) {

                if ($value['event_status'] == 'event_approved') {

                    if($value['time_schedule'] == 'time_am') {
                        $value['time_schedule'] = 'AM';
                    } else if($value['time_schedule'] == 'time_pm') {
                        $value['time_schedule'] = 'PM';
                    } else {
                        $value['time_schedule'] = 'Whole Day';
                    }
    
    
                    $this->arrayOfEventDates[] = [
                        'event_name' => "".$value['event_name']."",
                        'event_date' => "".$value['event_date']."",
                        'event_schedule_time' => "".$value['time_schedule'].""
                    ];
                    
                }
            }

            $this->sanitizeDates();


            echo "</tr></table></center>";

    }

    public function sanitizeDates() {

        for ($count=0; $count < (6*7); $count++){

	        $this->dayArray = getDate($this->start);
	
	    	$this->addZeroInSingleDigitDays();

		    if (($count % 7) == 0){
		      	if ($this->dayArray["mon"] != $this->month){
		        	break;
		      	}
		      	else
		      	{
		        	echo "</tr><tr>";
		      	}
		    }

		    if ($count < $this->firstdayArray["wday"] || $this->dayArray["mon"] != $this->month) {
		      echo "<td></td>";
		    }
		    else
		    {
              
				$this->addClass = '';
				$this->title = '';

				$this->getFullDate = $this->dayArray["year"].'-'.$this->dayArray["mon"].'-'.$this->dayArray["mday"];
                
                $this->checkDateIfItIsPastDays($this->getFullDate);

				$this->countEventPerDay = [];

		    	for($i = 0; $i < count($this->arrayOfEventDates); $i++) {

		    		if($this->getFullDate == $this->arrayOfEventDates[$i]['event_date']) {	// Same date of event. Check if am and pm events are not available.

						$this->countEventPerDay[] = $this->arrayOfEventDates[$i]['event_schedule_time'];
						
						$this->addClass .= 'eventDay'.$this->arrayOfEventDates[$i]['event_schedule_time'];

						$this->title .= '<b>'.$this->arrayOfEventDates[$i]['event_schedule_time']. '</b> - ' .$this->arrayOfEventDates[$i]['event_name'].'<br />';
                        
                        $this->checkEventTime($i, $count);
					}

				}
				
				if (count($this->countEventPerDay) == 2) { // styling the date has a 2 events (am and pm)
					$this->addEventBtn = '';
					$this->addClass = 'fullSlot';
				}

				echo "<td class='".$this->addClass."'>".$this->dayArray["mday"]."</a><br />". $this->title ."<br />".  $this->addEventBtn."</td>";

		        unset($this->title);

		        $this->start += ADAY;
		      
		    }
        }
     
    }

    public function addZeroInSingleDigitDays() {

        if (strlen((string)$this->dayArray['mon']) == 1) { // add zero in once digit month
            $this->dayArray['mon'] = '0'.$this->dayArray['mon'];
        }
        else {
            $this->dayArray['mon'] = $this->dayArray['mon'];
        }

        if (strlen((string)$this->dayArray['mday']) == 1) { // add zero in once digit day
            $this->dayArray['mday'] = '0'.$this->dayArray['mday'];
        }
        else {
            $this->dayArray['mday'] = $this->dayArray['mday'];
        }

    }

    public function addZeroInSingleDigitDaysInCurrDay($month) {

        if ($month < 10) {
            return '0'.$month;
        }
        else {
            return $month;
        }

    }

    public function checkDateIfItIsPastDays($getFullDate) {

        if ($getFullDate < $this->currDay) {

            $this->addEventBtn = '<br />';

        }
        else if ($getFullDate == $this->currDay) {

            $this->addEventBtn = '<br />';

        }
        else {

            $this->addEventBtn = '<form method="post" action="?page=bsardo_reservations_page"> 
                <input type="hidden" name="eventDate" value="'.$this->getFullDate.'"></input>
                <input type="submit" value=" + " name="goToAddReservation" class="btnAddEvent"></input>
                </form>'; // button add event template
        }

    }

    public function checkEventTime($i) {

        if ($this->arrayOfEventDates[$i]['event_schedule_time'] == 'Whole Day') { // if event is whole day
                            
            $this->addEventBtn = '';
            
        } else if ($this->arrayOfEventDates[$i]['event_schedule_time'] == 'AM') {
            $this->addEventBtn = '<form method="post" action="?page=bsardo_reservations_page">
                                <input type="hidden" name="eventDate" value="'.$this->getFullDate.'"></input>
                                <input type="hidden" name="availTime" value="PM"></input>
                                <input type="submit" value="+" name="goToAddReservation" class="btnAddEvent"></input>
                            </form>';
        } else if ($this->arrayOfEventDates[$i]['event_schedule_time'] == 'PM') {
            $this->addEventBtn = '<form method="post" action="?page=bsardo_reservations_page">
                                <input type="hidden" name="eventDate" value="'.$this->getFullDate.'"></input>
                                <input type="hidden" name="availTime" value="AM"></input>
                                <input type="submit" value="+" name="goToAddReservation" class="btnAddEvent"></input>
                            </form>';
        } else  {
            //
        }

    }

    
 }