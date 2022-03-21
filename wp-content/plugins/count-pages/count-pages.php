<?php
/*
Plugin Name: WPShout Count Pages By Author
Description: Count the number of pages authored by the user who is the autheor of the current Post


Are we on a page or a post - only want to display this if we are on a post

if we are on a post, want to find all the PAGEs in teh database with the same author ID

Count these pages

Output that number

*/



function count_pages_by_post_author($content){
    //bring in the content with $content
    //test page type
    //if page is post type, figure out the author
    if(!is_singular("post")){
        return $content;
    }
    
    $args = array(
        //figuring out author
        "author_id" => get_the_author_meta("ID"),
        //Find all Page post types from author
        "post_type" => "page",
        "post_per_page" => -1
    );

    $query = new WP_Query($args);

    if($query->have_posts()){
        //returns true of posts are left
        $content = '<p><em>The post author has also written ' . count($query->posts). ' pages. </em></p>'. $content;



    }

    wp_reset_postdata();

    return $content;



}


add_filter("the_content","count_pages_by_post_author");