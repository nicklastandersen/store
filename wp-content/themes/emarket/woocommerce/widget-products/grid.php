<?php global $woocommerce_loop; 
	$woocommerce_loop['columns'] = $columns_count ;
?>
<?php $_count = 1;$_delay = 150; $_total = $loop->post_count; ?>
<div class="<?php if($columns_count<=1){ ?>w-products-list<?php }else{ ?>products-grid<?php } ?>"><div class="row">
<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		<?php wc_get_template_part( 'content', 'products' ); ?>
<?php endwhile; ?>
</div></div>

<?php wp_reset_postdata(); ?>