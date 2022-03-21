<?php
function enqueue_twenty_fifteen_stylesheet(){
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
    
    }


add_action("wp_enqueue_scripts","enqueue_twenty_fifteen_stylesheet");


if ( ! function_exists( 'twentyfifteen_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since Twenty Fifteen 1.0
	 */
	function twentyfifteen_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

		<div class="post-thumbnail fifteenchild">
        <?php the_post_thumbnail( 'post-thumbnail', array(
				
				"alt" => " "
			)); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

		<?php
	endif; // End is_singular().
	}
endif;


?> 