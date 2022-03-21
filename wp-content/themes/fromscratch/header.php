<!DOCTYPE html>
<html>
    <head>
    <?php 
        wp_head();
    ?>
    </head>
    <body <?php body_class(); ?>>
    
        <div class="site-container">
            <div id="content" class="site-content">
            <header class="site-header">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                    rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php from_scratch_primary_menu()?>
			
                </header>