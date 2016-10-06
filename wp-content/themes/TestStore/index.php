<?php get_header(); ?>


    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div id="content">
            <h1><?php the_title();?></h1>
            <p><?php the_content();?></p>
        </div>

    <?php endwhile; else : ?>

    <p><?php _e('Sorry, no posts mathced your criteria.' ); ?></p>

<?php endif; ?>
</div>
    </div>
</section>

<?php get_footer(); ?>