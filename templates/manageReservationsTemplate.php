<div class="wrap">

            <h3> Pending Reservations </h3>
             <?php settings_errors(); 
             
             ?>

            <ul class="nav nav-tabs">
		        <li class="<?php 
                        if (isset($_POST['edit_reservation']) || isset($_POST['goToAddReservation'])) {
                            echo '';
                        } else {
                            echo 'active';
                        }
                    ?>"> <a href="#tab-manage-reservation"> Manage Reservations</a></li>
		        <li class="<?php 
                        if (isset($_POST['edit_reservation']) || isset($_POST['goToAddReservation'])) {
                            echo 'active';
                        } else {
                            echo '';
                        }
                    ?>"><a href="#tab-add-update-reservation"> <?php echo isset($_POST['edit_reservation']) ? 'Update Reservation' : 'Add Reservation' ?> </a></li>
                <li><a href="#tab-done-reservation-archive"> Done Events </a></li>
            </ul>

		    <div class="tab-content">

			   	<div id="tab-manage-reservation" class="tab-pane <?php 
                        if (isset($_POST['edit_reservation']) || isset($_POST['goToAddReservation'])) {
                            echo '';
                        } else {
                            echo 'active';
                        }
                    ?>">
					
					<?php  

                    $options = get_option('bsardo_reservations') ?: [];
                    // var_dump($options);
                    // die();
   					
   					if (count($options) === 0) {
                        echo '<br/ ><br /><h3 class=""> No Pending Reservation Requests </h3>';
                    }
                    else {
                        ?> <table class="pendingReservationsTable">
                        <tr>
                            <th>Event Date</th>  
                            <th>Time Schedule</th>
                            <th>Event Name</th>                    
                            <th>Representative Name</th> 
                            <th colspan="2">Options</th> 
                        </tr>
							<?php
							 foreach($options as $option) {                       
								
                            ?>
                        <tr>
                            <td> <?php echo $option['event_date']; ?> </td>
                            <td> <?php if($option['time_schedule'] == 'time_am') {
                                echo 'AM';
                            } else if($option['time_schedule'] == 'time_pm') {
                                echo 'PM';
                            } else {
                                echo 'Whole Day';
                            } ?> </td>
                            <td> <?php echo $option['event_name']; ?> </td>
                            <td> <?php echo $option['representative_name']; ?> </td>
                           	<td>
                           		 <form action="" method="post">
                                    <?php
                                        settings_fields('bsardo_reservations_settings');
                                        ?><input type="hidden" name="edit_reservation" value="<?php echo $option['reserve_id']; ?>"></input>
                                          <input type="hidden" name="edit_reservation_event_date" value="<?php echo $option['event_date']; ?>"></input>
                                          <input type="hidden" name="edit_reservation_time_schedule" value="<?php echo $option['time_schedule']; ?>"></input>
                                        <?php submit_button('Update Request', 'btnUpdate', 'submit_edit', false);
                                    ?>
                                </form>
                           	</td>
                           	<td> 
								 <form action="options.php" method="post">
                                    <?php
                                        settings_fields('bsardo_reservations_settings');
                                        ?><input type="hidden" name="reject_reservation" value="<?php echo $option['reserve_id']; ?>"></input>
                                        <?php submit_button('Reject Request', 'btnReject', 'submit_reject', false, [
                                            'onclick' => 'return confirm("Are you sure to remove this reservation ? ");'
                                        ]);
                                    ?>
                                </form>
                           	</td>
                        </tr>
                            <?php } ?>
                        </table>
                        <?php
                    }
                ?>
	             
	            </div>

                <div id="tab-add-update-reservation" class="tab-pane <?php 
                        if (isset($_POST['edit_reservation']) || isset($_POST['goToAddReservation'])) {
                            echo 'active';
                        } else {
                            echo '';
                        }
                    ?>">
					
					<form action="options.php" method="post">
		                <?php
		                    settings_fields('bsardo_reservations_settings');
		                    do_settings_sections('bsardo_reservations');
		                    submit_button();
		                ?>
	            	</form>

                </div>
                
                <div id="tab-done-reservation-archive" class="tab-pane">
					
                    <h2> Done Events </h2>

                    <?php  

                    $options = get_option('bsardo_done_reservations_archive');
                
   					if (count($options) === 0) {
                        echo '<br/ ><br /><h3 class=""> No Done Reservation Archive Records </h3>';
                    }
                    else {
                        ?> <table class="pendingReservationsTable">
                        <tr>
                            <th>Event Date</th>  
                            <th>Time Schedule</th>
                            <th>Event Name</th>                    
                            <th>Representative Name</th> 
                        </tr>
							<?php
							 foreach($options as $option) {                       
								
                            ?>
                        <tr>
                            <td> <?php echo $option['event_date']; ?> </td>
                            <td> <?php if($option['time_schedule'] == 'time_am') {
                                echo 'AM';
                            } else if($option['time_schedule'] == 'time_pm') {
                                echo 'PM';
                            } else {
                                echo 'Whole Day';
                            } ?> </td>
                            <td> <?php echo $option['event_name']; ?> </td>
                            <td> <?php echo $option['representative_name']; ?> </td>
                           
                        </tr>
                            <?php } ?>
                        </table>
                        <?php
                    }
                ?>

	            </div>

           </div>
	
</div>