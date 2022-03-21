<?php
/*
Template Name: Archive Page
*/
?>
This is archive page tempate
<?php get_header()?>
                <main class="site-main">
                    <?php 
                        while(have_posts()):
                            the_post();  ?>
                        <section <?php post_class()?>>
                            <header>
                                <h2 class="post-title">Our Archives</h2>
                            </header>
                            <?php the_content() ?>
                        <?php 
                        endwhile;
                        ?>
                            <ul>
                                <?php
                                $q = new WP_Query(array(
                                    "ignore_sticky_posts" => false,
                                    "posts_per_page" => -1
                                ));

                                while($q->have_posts()):
                                    $q->the_post();
                                    ?>
                                    <li><?php the_title(); ?>

                                    <?php
                                endwhile;
                                wp_reset_postdata();
                                ?>







                                <li>PostName</li>
                            </ul>
                        </section>
                                
                </main>
<?php get_footer()?>