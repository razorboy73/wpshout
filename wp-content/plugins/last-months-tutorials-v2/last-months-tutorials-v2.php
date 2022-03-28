<?php
/*
Plugin Name: Last Months Tutorials v2
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

class LMTPlugin{

    function __construct()
    {
        
   
    //adds the display to the content
    // adds to settings menu
    add_action("admin_menu", array($this,"adminPage"));
    add_action("admin_init", array($this,"settings"));
    add_filter("the_content", array($this,"ifWrap"));
    }

    function ifWrap(){
        if('tutorial' == get_post_type() AND (!is_admin())){
            if(get_option("lmt_shortcode","1")){
                add_shortcode("lmt",array($this,"lmt_display_shortcode"));
            }

            if (get_option("lmt_display","1")){
                return $this->createHTML();
            }
        // echo "Not Wrapped";
        // echo "<hr>";
        return get_the_content();
        }
        
    }
    function createHTML(){

        $textStuff = "";
        $textStuff = $textStuff . "<hr>";
        $textStuff = $textStuff . $this->lmtGeneration("intermediate");
        $textStuff = $textStuff . "<hr>";
        $textStuff = $textStuff . get_the_content();
        return $textStuff;

      
    }

    function lmtGeneration($difficulty="beginner"){
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
                        'terms'    => $difficulty

                    ),
                ),
    
       
        );
    
        $query = new WP_Query($q_args);
    
        $buffer = "";
        if( $query->have_posts() ) :
            
            $buffer = $buffer. '<h3>'.get_option("lmt_headline").': '. $difficulty .' Tutorials From Last Month</h3> <ul>';
            while( $query->have_posts() ) :
                $query->the_post();
                $buffer = $buffer.  '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a>.  Published on: '. get_the_date().'</li>';
            endwhile;
            $buffer = $buffer. '</ul>';
        endif;
    
        
        wp_reset_postdata();
        
        return $buffer;
    }
    function settings(){
        
        add_settings_section("lmt_first_section","Optional Heading (set to Null if not needed)",array($this,"optional_content"), "lmt-settings-page" );
        //sets location of plugin within post
        add_settings_field("lmt_location","Display Location (Not Being Used)",array($this,"locationHTML"),"lmt-settings-page","lmt_first_section" );
        register_setting("lmtplugin","lmt_location", array("sanitize_callback"=>array($this,"sanitizeLocation"),"default"=>"0"));

        //set textHeading for tutorial section
        add_settings_field("lmt_headline","Tutorial Headline - inserts text into headline of tutorial",array($this,"headlineHTML"),"lmt-settings-page","lmt_first_section" );
        register_setting("lmtplugin","lmt_headline", array("sanitize_callback"=>"sanitize_text_field","default"=>"Tutorial Collection"));
        //set display as on or off
        add_settings_field("lmt_display","Show Tutorials On All Tutorial Posts", array($this,"checkboxHTML"),"lmt-settings-page","lmt_first_section",array("theName"=>"lmt_display") );
        register_setting("lmtplugin","lmt_display", array("sanitize_callback"=>"sanitize_text_field","default"=>"1"));
        //set displayable via short code
        add_settings_field("lmt_shortcode","Render Via Shortcode on individual posts", array($this,"checkboxHTML"),"lmt-settings-page","lmt_first_section",array("theName"=>"lmt_shortcode") );
        register_setting("lmtplugin","lmt_shortcode", array("sanitize_callback"=>"sanitize_text_field","default"=>"0"));

       
      
    }


    function sanitizeLocation($input){

        if($input != "0" AND $input != "1"){
          add_settings_error('lmt_location', "lmt_location_error", "Display location must be either begining or end".$input);
          return get_option('lmt_location');
        }
        
        return $input;
      }
/*
    function checkboxHTML() { ?>
        <input type="checkbox" name="lmt_display" value="1" <?php checked(get_option('lmt_display'), '1') ?>>
    <?php }


*/
    function checkboxHTML($args){ ?>

        <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']),'1')?>>
        
    <?php }
        

    function headlineHTML(){?>
        <input type="text" name="lmt_headline" value="<?php echo esc_attr(get_option("lmt_headline"))?>">
        <?php }

    function locationHTML(){?>
            <select name="lmt_location" id="">
                <option value="0" <?php selected(get_option("lmt_location"),"0") ?>>Beginning of Post</option>
                <option value="1" <?php selected(get_option("lmt_location"),"1") ?>>End of Post</option>
                </select>
                <?php
    }

    function optional_content(){
        echo "Optional Content - could be set to null.  If this is inside a class, remember to use (array(($)this,callback)) to use function";
    }

    function lmt_display_shortcode($attributes){
        $attributes = shortcode_atts( array( 
            'difficulty' => 'beginner',
        ), $attributes, 'lmt_display_shortcode' );

        return $this->lmtGeneration($attributes['difficulty']);
    
    }
    
    
    
    function adminPage(){
        add_options_page("Last Month's Tutorial Display Settings", "Tutorial Display",
        "manage_options","lmt-settings-page", array($this,"lmtHTML" ));
    }
    
    function lmtHTML(){ ?>
    <div class="wrap">
        <h1>Last Month's Tutorial Settings</h1>
        <form action="options.php" method="POST" >
        <?php
        settings_fields("lmtplugin");
        do_settings_sections("lmt-settings-page");
        submit_button();
        ?>
        </form>
    </div>
    <?php }

    


}

$lmtPlugin =  new LMTPlugin();


    
    






