Comment  

<section class="comments-area">
    <ul class="comments-list">
        <?php wp_list_comments(
            array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 74,
            )
        ); ?>

        <?php comment_form(); ?>
    </ul>
</section>






