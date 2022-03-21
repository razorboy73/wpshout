<?php
function from_scratch_primary_menu(){
    wp_nav_menu(array(
        'theme_location'  => 'primary',
        "menu_class" =>"primary-menu",
        "container_class" => "primary-menu-container")
    );
}