<?php
function enqueue_twenty_nineteen_stylesheet(){
    // wp_enqueue_style(
    // "twentyfifteen",
    // get_template_directory_uri()."/style.css"
    // );
    wp_enqueue_style(
        "parent-style",
        get_template_directory_uri()."/style.css" //Always returns the root URL of the parent theme, 
        //whether or not there’s a child theme running. 
        //Useful for building pieces of a parent theme that you don’t want to be easily overridden by the child theme.
        );
        wp_enqueue_style(
            "child-style",
            get_stylesheet_uri(),array("parent-style") //return the URL for the style.css of the current theme.
            //array is the dependancy
            //loads after the parent
            //CSS selector overrides the parent
            );
            wp_enqueue_script( 
                'checkpoint',
                get_stylesheet_directory_uri() . '/js/checkpoint.js'
            );
    }
add_action("wp_enqueue_scripts","enqueue_twenty_nineteen_stylesheet");


function new_image_sizes() {
    //add_theme_support("post-thumbnails");//Do I need this?
    add_image_size( 'large_square', 743, 824, true );  //this isnt doing what I expected
}
add_action('after_setup_theme', 'new_image_sizes');



function content_filter_example( $the_content ) {
	return $the_content. "<br> <p>Thanks for reading!</p>";
}
add_filter( 'the_content', 'content_filter_example' );
?>