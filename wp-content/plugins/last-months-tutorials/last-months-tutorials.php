<?php
/*
Plugin Name: Last Months Tutorials
Description:  Fetchs all Tutorial that are from last month
Version: 1.0
Author: Josh Kerbel
License: GPL2

*/


//I’d like it to fetch all posts of type Tutorial that 
// are from last month, and display them (title and link) 
// as list elements of a <ul>. So if it’s February, 
// it would be a list of all Tutorials from January, 
// with clickable links.






// function last_months_tutorial($content){
//     if ( ! is_singular( 'tutorial' ) ) {
// 		return $content;
	
//     $q_args = array(
//         "post_type" => "tutorial"
//     );

//     $query = new WP_Query($q_args);

//     if($query->have_posts()){
//         while ($query->have_posts()){
//             $query->the_post();
//             $content = the_title(). $content;
//         }
//     }
  

   
//     }
//     wp_reset_postdata();
//     return $content;

// }



// add_filter( 'the_content', 'last_months_tutorial' );

add_shortcode("lmt","lmt_display_shortcode");

function lmt_display_shortcode($attributes){
    $attributes = shortcode_atts( array( 
		'difficulty' => 'advanced',
		'color' => 'blue'
	), $attributes, 'lmt_display_shortcode' );

   
	
    $q_args = array(
        "post_type" => "tutorial",
        "posts_per_page" => -1,
        'date_query' => array(
	        array(
                //figure out last momnth
	            'after'     => date("F j y", strtotime("first day of previous month")),
                'before'     => date("F j y", strtotime("first day of this month")),
	            'inclusive' => false,
	        )
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'difficulty',
                    'field'    => 'slug',
                    'terms'    => $attributes['difficulty']
                ),
            )

   
    );

    $query = new WP_Query($q_args);

    
    if( $query->have_posts() ) :
        echo '<div class="last-month-tuts">';
		echo '<h3>'.ucfirst($attributes['difficulty']).' Tutorials From Last Month</h3> <ul>';
		while( $query->have_posts() ) :
			$query->the_post();
			echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a>.  Published on: '. get_the_date().'</li>';
		endwhile;
		echo '</ul></div>';
	endif;
  

   
    
    wp_reset_postdata();

    

    
  
}
