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

function image_sizes(){
    add_theme_support("post-thumbnails");
    add_image_size( 'large_square', 1000, 1000, true );
	
}

add_filter('post_class', 'image_sizes');

function wpshout_filter_example( $the_content ) {
	return $the_content. "<br> <p>Thanks for reading!</p>";
}
add_filter( 'the_content', 'wpshout_filter_example' );
?>