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


//Create a taxonomy
//I’d like Tutorial posts to be organized by difficulty:
//  Beginner, Intermediate, Advanced. 
//  I’d like the single Tutorial post template to show that post’s 
//  difficulty, and I’d like to be able to browse all posts of that 
//  Tutorial’s difficulty by clicking the difficulty as a link. 
//  (See a single article on wpshout.com for a demo of this functionality.)

// Remember to create a page for this to render
function register_tutorial_post_type(){

    //Cant figure out the date aspect of the CPT


 
    register_post_type("tutorial", array(

        "public" => true,
        "show_in_rest" => true,
        "menu_position" => 20,
        'rewrite'     => array( 'slug' => 'tutorials' ),
        "label" => "Tutorials",
        "has_archive" => true,
        "supports" => array(
            "title",
            "editor",
            "thumbnail",
          
       

        )
    )
    );

}

add_action("init", "register_tutorial_post_type");


function difficulty_taxonomy() {
    $args = array( 
        'hierarchical' => true,
        'label' => 'Difficulty',
    );
    register_taxonomy( 'difficulty', 'tutorial', $args );
}
add_action( 'init', 'difficulty_taxonomy' );


function register_difficulty_terms( ) {
	wp_insert_term( 'Beginner', 'difficulty', $args = array(
		'description' => 'Easy Peasy'
	) );
	
	wp_insert_term( 'Intermediate', 'difficulty', $args = array(
		'description' => 'May be hard'
	) );

    wp_insert_term( 'Advanced', 'difficulty', $args = array(
		'description' => 'Super Duper Hard'
	) );
}
add_action( 'init', 'register_difficulty_terms' );

// I’d like Tutorial posts to have “Topics,” 
// allowing me to tag Tutorials with things like 
// “JavaScript,” “PHP,” or “Workflows.” I’d like the 
// list of Topics applied to a Tutorial to show on that 
// Tutorial’s single page as well. (Again, see a single wpshout.com 
// article for a demo.)


function topic_tags() {
    $args = array( 
        'hierarchical' => false,
        'label' => 'Topics',
    );
    register_taxonomy( 'topics', 'tutorial', $args );
}
add_action( 'init', 'topic_tags' );



//Lastly, I’d like each Tutorial post to have a unique property called 
//“Minutes” that says how long the Tutorial takes to read //
//(e.g., “6 minutes,” “20 minutes,” “40 minutes,” etc.).

//Had to activate custom-fields support on custom post

//Add time to read

function time_to_read($content){
    $minutes_to_read = get_post_meta(get_the_ID(), "minutes", true);

    if( empty( $minutes_to_read ) ) {
		return $content;
	}

    $minutes_to_read_string = '<br><em>This tutorial will take ' . $minutes_to_read . ' minutes to read.</em><hr>';
	return  $content. $minutes_to_read_string;


}

add_filter( 'the_content', 'time_to_read' );
