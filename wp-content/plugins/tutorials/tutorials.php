<?php
/*
Plugin Name: Tutorial Plugin
Description:  Find the best tutorials
Version: 1.0
Author: Josh Kerbel
License: GPL2

*/

// I would like single posts of the Tutorial post type to be different than regular Posts: 
// I don’t want them to display the author, or the publication date. Please set this up, 
// using the template hierarchy, in the Twenty Nineteen child theme you registered in the first section. 
// Make use of template parts, since the content is going to be similar (although not identical) to the 
// display of regular Posts.

// Remember to create a page for this to render
function register_tutorial_post_type(){

    //Cant figure out the date aspect of the CPT


 
    register_post_type("tutorial", array(

        "public" => true,
        "menu_position" => 20,
        'rewrite'     => array( 'slug' => 'tutorials' ),
        "label" => "Tutorials",
        "has_archive" => true,
       

        )
    );

}

add_action("init", "register_tutorial_post_type");