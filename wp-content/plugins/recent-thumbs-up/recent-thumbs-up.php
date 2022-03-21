<?php


/*
Plugin Name: Get Recent Thumbs Up Restaurants
Description: written by the site’s admin user post type Restaurant Review Received a “Thumbs Up!” value in the Thumbs Up/Down taxonomy Were written 7 or fewer days ago

Were written by the site’s admin user
Are of post type Restaurant Review
Received a “Thumbs Up!” value in the Thumbs Up/Down taxonomy
Were written 7 or fewer days ago
*/



function get_recent_thumbs_up_by_admin(){

    $args = array(
        //figuring out author
        "author_id" => 1,
        //Find all Page post types from author
        "post_per_page" => -1,
        "post_type" => "restaurant_review",
        "tax_query" => array(
            array(
                "taxonomy" => "thumbs",
                "field" => "slug",
                "terms" => "Thumbs Up!"
            )
            ),
        "date_query" => array(
            array(
                "after "=> "January 1st, 2022",
                "before"=> date("F j, Y", (strtotime("7 days ago"))),
                "inclusive" => true,
            )
        )
    );


    $query = new WP_Query($args);

    if($query->have_posts()):
        echo '<footer>Restaurants our site admin has given a Thumbs Up since January 1 2022 and '. date("F j, Y", (strtotime("7 days ago"))).' <ul>';

        while($query->have_posts()):
            $query->the_post();
            
            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
		endwhile;
		echo '</ul></footer>';
	endif;
	wp_reset_postdata();

    }


    add_action( 'get_footer', 'get_recent_thumbs_up_by_admin' );