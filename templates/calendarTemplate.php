<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h2> Select Month / Year</h2>
<br />

    <?php include(plugin_dir_path(__FILE__). '../includes/Calendar/CalendarAdmin.php');

        $calendar = new CalendarAdmin();

    ?>
    <center>
    <form method="post" id="pickMonthYear" action="">

        <select name="month">
         <?php
         
            $months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

            for ($x=1; $x<=count($months); $x++){
                echo "<option value='$x'";
                if ($x == $calendar->month){
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
                if ($x == $calendar->year){
                    echo " selected";
                }
                echo ">$x</option>";
                }

            ?>

        </select>
        <input type="submit" name="submit" value="Go" class="btnSubmit">
    </form>
    </center>

    <?php $calendar->putCalendarDays(); ?>
    
</body>
</html>