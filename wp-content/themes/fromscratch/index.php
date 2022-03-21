
<?php get_header()?>
                <main class="site-main">
                    <?php 
                       
                        if(have_posts()):
                            while(have_posts()):
                                the_post(); 
                                if(is_single()){
                                    get_template_part("content","single");
                                }else{
                                    get_template_part("content","loop");
                                }
                                
                                endwhile;
                                ?>
                                <div class="posts-nav">
                                    <?php next_posts_link("Older");?>
                                    &nbsp;
                                    <?php previous_posts_link("Newer");?>
                                </div>
                            <?php else: ?>
                                <section>
                                    <header>
                                        <h1>404 biatch</h1>
                                    </header>
                                </section>
                        <?php
                            endif;
                        ?>
                </main>
<?php get_footer()?>