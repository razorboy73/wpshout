<section <?php post_class() ?>>
        <header>
           <div class="post-image">
                <?php 
                if(has_post_thumbnail()){
                            //Check if post has an image attached…
                    the_post_thumbnail("better-thumb");//Display Post Thumbnail…
                }else{
                    echo "<br> upload a picture";
                }
                ?>
            </div>
                <a href="<?php the_permalink()?>">
                    <h2 class="post-title"><?php the_title(); ?></h2>
                </a>
                <p class="byline">
                    by <?php the_author(); ?> on <?php the_date();?>
                </p>
        </header>
            <?php the_content(); ?>
                <footer>
                   
                    <a href="<?php the_permalink(); ?>"> &infin;</a>
                </footer>
            </section>          