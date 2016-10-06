<?php $_delay = 150; ?>
<ul class="pbr-w-products-list">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
			<?php wc_get_template_part( 'content', 'product-list' ); ?>
		<?php $_delay+=200; ?>
	<?php endwhile; ?>
</ul>
<?php wp_reset_postdata(); ?>