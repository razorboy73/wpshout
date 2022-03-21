<?php
/*
Plugin Name: Resturant Review Plugin
Description:  Find the best restaurants around campus
Plugin URI: http://frshminds.com
Version: 1.0
Author: Josh Kerbel
License: GPL2

*/


// Remember to create a page for this to render
function register_restaurant_reviews(){


 
    register_post_type("restaurant_review", array(

        "public" => true,
        "menu_position" => 20,
        'rewrite'     => array( 'slug' => 'crappy-food' ),
        "label" => "Restaurant Reviews"

        )
    );

}

add_action("init", "register_restaurant_reviews");

