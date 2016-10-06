<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */
$link_url =  get_post_meta( get_the_ID(),'emarket_link_link', true );
$link_text =  get_post_meta( get_the_ID(),'emarket_link_text', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-preview">
		<?php if( empty($link_url) ) : ?>
		<?php emarket_fnc_post_thumbnail(); ?>
		<?php else : ?>
		<a class="post-link" href="<?php echo esc_url( $link_url ) ?>" title="<?php echo esc_url( $link_text ) ?>">
			<?php echo esc_url( $link_url ) ?>
		</a>
		<?php endif; ?>

		<span class="post-format">
			<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><i class="fa fa-link"></i></a>
		</span>
	</div>

	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && emarket_fnc_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'emarket' ) ); ?></span>
		</div><!-- .entry-meta -->
		<?php
			endif;

			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif;
		?>

		<div class="entry-meta">
			
			<div class="entry-date pull-left">
                <span><?php the_time( 'd' ); ?></span>&nbsp;<?php the_time( 'M' ); ?>
            </div>
            <span class="author pull-left"><?php esc_html_e('by', 'emarket'); the_author_posts_link(); ?></span>
            <div class="entry-category pull-left">
                <?php esc_html_e('in', 'emarket'); the_category(); ?>
            </div>
			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
			<span class="comments-link pull-left"><span class="fa fa-comment-o"></span> <?php comments_popup_link( esc_html__( 'Leave a comment', 'emarket' ), esc_html__( '1 Comment', 'emarket' ), esc_html__( '% Comments', 'emarket' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( esc_html__( 'Edit', 'emarket' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			if(is_single()){
				the_content( sprintf(
					esc_html__( 'Continue reading %s', 'emarket').'<span class="meta-nav">&rarr;</span>',
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );
			}else{
				the_excerpt();
			}

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'emarket' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
