<div class="wrap">

    <h1>BSardo Event Calendar</h1>


    <div class="tab-content">
        <div id="tab-settings" class="tab-pane active">
            <form action="options.php" method="post">
                <?php
              
                    settings_fields('bsardo_event_calendar_settings');
                   
                    do_settings_sections('bsardo_event_calendar');
                    submit_button();
                ?>
            </form>
        </div>



</div>