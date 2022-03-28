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


     
    add_shortcode("lmt","lmt_display_shortcode");
      
    
       
    


    function lmt_display_shortcode($attributes){
        $attributes = shortcode_atts( array( 
            'difficulty' => 'beginner',
        ), $attributes, 'lmt_display_shortcode' );

        return lmtGeneration($attributes);
    
    }

    function lmtGeneration($attributes){
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
                ),
    
       
        );
    
        $query = new WP_Query($q_args);
    
        $buffer = "";
        if( $query->have_posts() ) :
            $buffer = $buffer. '<div class="last-month-tuts">';
            $buffer = $buffer. '<h3>'.ucfirst($attributes['difficulty']).' Tutorials From Last Month</h3> <ul>';
            while( $query->have_posts() ) :
                $query->the_post();
                $buffer = $buffer.  '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a>.  Published on: '. get_the_date().'</li>';
            endwhile;
            $buffer = $buffer. '</ul></div>';
        endif;
      
    
       
        
        wp_reset_postdata();
    
        return $buffer;
    }
    
    
    
    





