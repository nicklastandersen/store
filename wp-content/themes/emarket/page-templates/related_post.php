<?php

	if( $relates->have_posts() ): ?>
    <div class="widget widget-style">
        <h4 class="related-post-title widget-title">
            <span><?php esc_html_e( 'Related post', 'emarket' ); ?></span>
        </h4>

        <div class="related-posts-content  widget-content">
            <div class="row">
            <?php
                $class_column = 12/$relate_count;
                while ( $relates->have_posts() ) : $relates->the_post();
                    ?>
                    <div class="col-sm-<?php echo esc_attr( $class_column ); ?> col-md-<?php echo esc_attr( $class_column ); ?> col-lg-<?php echo esc_attr( $class_column ); ?>">
                          <?php get_template_part( 'vc_templates/blog/blog-v2' ); ?>
                    </div>
                    <?php
                endwhile; ?>
            </div>
        </div>
        
    </div>
        <?php
    endif;
?>