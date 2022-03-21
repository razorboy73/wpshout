<?php 
/*
Plugin Name: WPShout Favorite Song Widget
Description: A plugin to create a "Favorite Song" widget
Version: 1.0
Author: WPShout
Author URI: https://wpshout.com/
*/


// Here we’ll cover creating a dynamic widget: 
// one that accepts, 
// formats, and 
// displays user input.
 


class WPShout_Favorite_Song_Widget extends WP_Widget {

	
	public function __construct() {	
		parent::__construct(
	            'wpshout_favorite_song_widget', // Base ID
        	    'WPShout Favorite Song Widget', // Name
 	           array( 'description' => 'Widget for playable favorite song' ) // Args
		);
	}

	function form($instance){
		$link = "";
		$songinfo = "";
		$songyear = "";
		

		//check values
		if($instance){
			$link = esc_attr($instance["link"]);
			$songinfo = esc_attr($instance["songinfo"]);
			$songyear = esc_attr($instance["songyear"]);
		} ?>
			<p>
				<label for="<?php echo $this->get_field_id("link"); ?>">Song Info:</label>
				<input class="widefat" id="<?php echo $this->get_field_id("link"); ?>" name="<?php echo $this->get_field_name("link");?>" type="text" value="<?php echo $link; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'songinfo' ); ?>">Song Info:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'songinfo' ); ?>" name="<?php echo $this->get_field_name( 'songinfo' ); ?>" type="text" value="<?php echo $songinfo; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'songyear' ); ?>">Song Year:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'songyear' ); ?>" name="<?php echo $this->get_field_name( 'songyear' ); ?>" type="text" value="<?php echo $songyear; ?>" />
			</p>

	<?php }

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		//Fields
		$instance['link'] = strip_tags($new_instance["link"]);
		$instance["songinfo"] = strip_tags($new_instance['songinfo']);
		$instance["songyear"] = strip_tags($new_instance['songyear']);
		return $instance;
	}

	function widget($args, $instance){
		echo $args["before_widget"];
		echo "<h2>Now Listening: </h2>";
		echo $instance['songinfo'];
		echo $instance['songyear'];
		echo
		'<p>
			<audio controls>
				<source src="' . $instance[ 'link' ] . '" type="audio/mpeg">
				Your browser does not support the audio element.
			</audio>
			<a href="' . $instance[ 'link' ] . '">Download it</a>
		</p>';
		echo $args[ 'after_widget' ];
	}

}
	


function wpshout_register_widgets() {
	register_widget( 'WPShout_Favorite_Song_Widget' );
}

add_action( 'widgets_init', 'wpshout_register_widgets' );