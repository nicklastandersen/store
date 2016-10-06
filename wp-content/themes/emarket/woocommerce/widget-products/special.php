<?php

$_total = $loop->post_count;
$_count = 1;
$_id = emarket_fnc_makeid();
?>
<div id="carousel-<?php echo esc_attr($_id); ?>" class="owl-carousel-play" data-ride="owlcarousel">         
    
        <?php if($posts_per_page>$columns_count && $_total>$columns_count){ ?>
            <div class="carousel-controls">
                <a class="left carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="prev">
                        <span class="fa fa-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="next">
                        <span class="fa fa-chevron-right"></span>
                </a>
            </div>
        <?php } ?>
         <div class="owl-carousel" data-slide="<?php echo esc_attr($columns_count); ?>" data-pagination="false" data-navigation="true">
            <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                    <div class="products-grid product">
                        <div class="product-wrapper">
                            <ul class="pbr-w-products-list">
                                <?php wc_get_template_part( 'content', 'product-list' ); ?>
                            </ul>
                        </div>
                    </div>
            <?php endwhile; ?>
        </div>
 
</div>    
<?php wp_reset_postdata(); ?>