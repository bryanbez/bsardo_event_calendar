<div class="wrap">
	
	<h2> Activity Calendar</h2>

</div>

<?php 
	
	define("ADAY", (60*60*24));

	if ((!isset($_POST['month'])) || (!isset($_POST['year']))){
	  $nowArray = getdate();
	  $month = $nowArray['mon'];
	  $year = $nowArray['year'];
	}
	else{
	  $month = $_POST['month'];
	  $year = $_POST['year'];
	  
	}

	$start = mktime(12, 0, 0, $month, 1, $year);
	$firstDayArray = getdate($start);


?>

<!DOCTYPE html>
<html>
<head>
	
</head>
<body>

	<center>
	
	<form method="post" id="pickMonthYear" action="">

	<select name="month">
	<?php

	$months = Array("January","February","March","April","May","June","July","August","September","October","November","December");

	for ($x=1; $x<=count($months); $x++){
	  echo "<option value='$x'";
	  if ($x == $month){
	    echo "selected";
	  }
	  echo ">".$months[$x-1]."</option>";
	}

	?>
	</select>

	<select name="year">
	<?php

	for ($x=2020; $x<=2030; $x++){
	  echo "<option";
	  if ($x == $year){
	    echo " selected";
	  }
	  echo ">$x</option>";
	}

	?>

	</select>
	<input type="submit" name="submit" value="Go" class="btnSubmit">
	</form>
	</center>

	<?php

	$days = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");

	echo "<center><table class='activityCalendar' cellpadding='5'><tr>";

	foreach ($days as $day){
	    echo "<th><strong> ".$day." </strong></th>";
	}

		$options = get_option("bsardo_reservations");
		$arrayOfEventDates = array();

		foreach ($options as $value) {

			if($value['time_schedule'] == 'time_am') {
				$value['time_schedule'] = 'AM';
			} else if($value['time_schedule'] == 'time_pm') {
				$value['time_schedule'] = 'PM';
			} else {
				$value['time_schedule'] = 'Whole Day';
			}


			$arrayOfEventDates[] = [
				'event_name' => "".$value['event_name']."",
				'event_date' => "".$value['event_date']."",
				'event_schedule_time' => "".$value['time_schedule'].""
			];
		}
	
	  for ($count=0; $count < (6*7); $count++){

	    $dayArray = getDate($start);
	
	    	if (strlen((string)$dayArray['mon']) == 1) { // add zero in once digit month
				$dayArray['mon'] = '0'.$dayArray['mon'];
			}
			else {
				$dayArray['mon'] = $dayArray['mon'];
			}

			if (strlen((string)$dayArray['mday']) == 1) { // add zero in once digit day
				$dayArray['mday'] = '0'.$dayArray['mday'];
			}
			else {
				$dayArray['mday'] = $dayArray['mday'];
			}

		    if (($count % 7) == 0){
		      	if ($dayArray["mon"] != $month){
		        	break;
		      	}
		      	else
		      	{
		        	echo "</tr><tr>";
		      	}
		    }

		    if ($count < $firstDayArray["wday"] || $dayArray["mon"] != $month) {
		      echo "<td></td>";
		    }
		    else
		    {

				$addClass = '';
				$title = '';
				$availableTime = '';

				$getFullDate = $dayArray["year"].'-'.$dayArray["mon"].'-'.$dayArray["mday"];
				
				$addEventBtn = '<form method="post" action="?page=bsardo_reservations_page">
									<input type="hidden" name="eventDate" value="'.$getFullDate.'"></input>
									<input type="submit" value="+" name="goToAddReservation" class="btnAddEvent"></input>
								</form>';

		    	for($i = 0; $i < count($arrayOfEventDates); $i++) {

		    		if($getFullDate == $arrayOfEventDates[$i]['event_date']) {	
						
						$addClass .= 'eventDay'.$arrayOfEventDates[$i]['event_schedule_time'];

						$title .= '<b>'.$arrayOfEventDates[$i]['event_schedule_time']. '</b> - ' .$arrayOfEventDates[$i]['event_name'];
						
						if ($arrayOfEventDates[$i]['event_schedule_time'] == 'Whole Day') {
							$addEventBtn = '';
						} else if ($arrayOfEventDates[$i]['event_schedule_time'] == 'AM') {
							$addEventBtn = '<form method="post" action="?page=bsardo_reservations_page">
												<input type="hidden" name="eventDate" value="'.$getFullDate.'"></input>
												<input type="hidden" name="availTime" value="PM"></input>
												<input type="submit" value="+" name="goToAddReservation" class="btnAddEvent"></input>
											</form>';
						} else if ($arrayOfEventDates[$i]['event_schedule_time'] == 'PM') {
							$addEventBtn = '<form method="post" action="?page=bsardo_reservations_page">
												<input type="hidden" name="eventDate" value="'.$getFullDate.'"></input>
												<input type="hidden" name="availTime" value="AM"></input>
												<input type="submit" value="+" name="goToAddReservation" class="btnAddEvent"></input>
											</form>';
						} else {
							//
						}
					}

				}
				
				echo "<td class='".$addClass."'>".$dayArray["mday"]."</a><br />".$title."<br />".$addEventBtn."</td>";

		        unset($title);

		        $start += ADAY;
		      
		    }
	 }

	echo "</tr></table></center>";

	?>



	<!-- <table class="activityCalendar">
		<tr>
			<th> Sunday </th>
			<th> Monday </th>
			<th> Tuesday </th>
			<th> Wednsday</th>
			<th> Thursday </th>
			<th> Friday </th>
			<th> Saturday</th>
		</tr>
		<?php

			foreach ($weeks as $week) {

				echo $week;
			}
		?>
	</table>
 -->
</body>
</html>