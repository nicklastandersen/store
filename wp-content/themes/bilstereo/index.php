<?php get_header(); ?>


        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="content">
                <h2><?php the_title();?></h2>
                <p><?php the_content();?></p>
            </div>

        <?php endwhile; else : ?>

            <p><?php _e('Sorry, no posts mathced your criteria.' ); ?></p>

        <?php endif; ?>

<?php get_footer(); ?>