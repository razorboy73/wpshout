<?php
/*
Plugin Name: WPShout Tutorials Banner Widget 
*/ 

// Create widget
class WPShout_Tutorials_Banner_Widget extends WP_Widget {
    public function widget( $args, $instance ) {
        echo '<h2>Enjoy WordPress Tutorials by  WPShout</h2>';
    }

    public function __construct() {
		parent::__construct(
		    'wpshout_tutorials_banner_widget', // Base ID
		    'WPShout Tutorials Banner Silly Widget', // Name
		    array( 'description' => 'Displays a stupid silly simple text string with no options' ) // Args
		);
	}
}

// Register widget
function wpshout_register_tutorials_banner_widget() {
     register_widget( 'WPShout_Tutorials_Banner_Widget' ); //Name of the widget class
}
add_action( 'widgets_init', 'wpshout_register_tutorials_banner_widget' );



?>