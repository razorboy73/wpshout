<?php
/**
 * Plugin Name:       Github Contributors
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Displays a repo's github contributors
 * Version:           1.00
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Josh Kerbel
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */


add_shortcode( 'ghc', 'ghc_display_shortcode' );
function ghc_display_shortcode($attributes){
    // using teh shortcodes_att function
    // $attributes = shortcode_atts( array( 
		// 'repo' => 'laravel/laravel',
	// ), $attributes, 'ghc_display_shortcode' );

    if(!isset ($attributes['repo'])){
        return "Repo not specified";
    }
    $contributors = ghc_get_repository_contributors(
        $attributes['repo']
    );
    //var_dump($parsed);
    ob_start();
    include plugin_dir_path(__FILE__)."templates/shortcode.php";
    return ob_get_clean();
   
}


function ghc_get_repository_contributors($repo){
    $cached = get_transient("ghc_contributors_".$repo);
    if (false !==$cached){
        //echo "got Cached";
        return json_decode($cached);
    }
    $response = wp_remote_get("https://api.github.com/repos/".$repo."/contributors");
    $cachable = $response['body'];
    set_transient("ghc_contributors_".$repo, $cachable, 60*60*5);
    return json_decode($cachable);

}




function ghc_enqueue_styles(){
    wp_enqueue_style(
        "ghc-style",
       plugins_url("ghc-style.css",__FILE__)
        );
}

add_action("wp_enqueue_scripts", "ghc_enqueue_styles");