<div class="wrap">

    <div class="tab-content">
        <div id="tab-settings" class="tab-pane active">
            <form action="options.php" method="post">
                <?php
                    settings_fields('bsardo_add_reservation_settings');
                   
                    do_settings_sections('bsardo_add_reservation');
                    submit_button();
                ?>
            </form>
        </div>


</div>