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

	<!-- <h3> <a href="?page=bsardo_activity_calendar_page&ym=<?php echo $prev ?>"> &lt; </a><?php echo $html_title; ?><a href="?page=bsardo_activity_calendar_page&ym=<?php echo $next ?>"> &gt; </a> </h3>
 -->

	 <h1><center>Select a Month/Year</center></h1>
	<center><form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
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

	for ($x=2015; $x<=2035; $x++){
	  echo "<option";
	  if ($x == $year){
	    echo " selected";
	  }
	  echo ">$x</option>";
	}

	?>

	</select>
	<input type="submit" name="submit" value="Go" class="w3-btn w3-white w3-border w3-round">
	</form>

	<?php

	$days = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");

	echo "<center><table class='activityCalendar' cellpadding='5'><tr>";

	foreach ($days as $day){
	    echo "<td><strong> ".$day." </strong></td>";
	}

		$options = get_option("bsardo_reservations");
		$arrayna = array();

		$arrayOfDates = array(
			[
				'seconds' => 1,
				'minutes' => 2,
				'hours' => "2020-03-19"
			],
			[
				'seconds' => 4,
				'minutes' => 5,
				'hours' => 6
			]
		);

		foreach ($options as $value) {
			$arrayna[] = [
				'event_name' => "".$value['event_name']."",
				'event_date' => "".$value['event_date'].""
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

		    	$title = "";
		    	$title = "<br>";

		    	$getFullDate = $dayArray["year"].'-'.$dayArray["mon"].'-'.$dayArray["mday"];

		    	for($i = 0; $i < count($arrayna); $i++) {

		    		if($getFullDate == $arrayna[$i]['event_date']) {
		    			
		    			$title .= '<div class="event"> '.$arrayna[$i]['event_name'].' </div>';
		    		}

		    	}
		
		        echo "<td>".$dayArray["mday"]."</a><br />".$title."</td>"; // print date

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