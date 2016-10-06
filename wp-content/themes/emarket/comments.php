<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WpOpal Team <opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2016 http://www.wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

if ( post_password_required() ){
    return;
}
?>
<div id="comments" class="comments">
    <header class="header-title">
        <h5 class="comments-title"><?php comments_number( esc_html__('0 Comment', 'emarket'), esc_html__('1 Comment', 'emarket'), esc_html__('% Comments', 'emarket') ); ?></h5>
    </header><!-- /header -->

    <?php if ( have_comments() ) { ?>
        <div class="pbr-commentlists">
    	    <ol class="commentlists">
    	        <?php wp_list_comments('callback=emarket_fnc_theme_comment'); ?>
    	    </ol>
    	    <?php
    	    	// Are there comments to navigate through?
    	    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    	    ?>
    	    <footer class="navigation comment-navigation" role="navigation">
    	        <div class="previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'emarket' ) ); ?></div>
    	        <div class="next right"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'emarket' ) ); ?></div>
    	    </footer><!-- .comment-navigation -->
    	    <?php endif; // Check for comment navigation ?>

    	    <?php if ( ! comments_open() && get_comments_number() ) : ?>
    	        <p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'emarket' ); ?></p>
    	    <?php endif; ?>
        </div>
    <?php } ?> 

	<?php
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                        'title_reply'=> '<h4 class="title">'.esc_html__('Leave a Comment','emarket').'</h4>',
                        'comment_field' => '<div class="form-group">
                                                <label class="field-label" for="comment">'. esc_html__('Comment:', 'emarket').'</label>
                                                <textarea rows="8" id="comment" class="form-control"  name="comment"'.$aria_req.'></textarea>
                                            </div>',
                        'fields' => apply_filters(
                        	'comment_form_default_fields',
                    		array(
                                'author' => '<div class="form-group">
                                            <label for="author">'. esc_html__('Name:', 'emarket').'</label>
                                            <input type="text" name="author" class="form-control" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
                                            </div>',
                                'email' => ' <div class="form-group">
                                            <label for="email">'. esc_html__('Email:', 'emarket').'</label>
                                            <input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
                                            </div>',
                                'url' => '<div class="form-group">
                                            <label for="url">'. esc_html__('Website:', 'emarket').'</label>
                                            <input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
                                            </div>',
                            )),
                        'label_submit' => esc_html__('Post Comment', 'emarket'),
						'comment_notes_before' => '<div class="form-group h-info">'.esc_html__('Your email address will not be published.','emarket').'</div>',
						'comment_notes_after' => '',
                        );
    ?>
	<?php global $post; ?>
	<?php if('open' == $post->comment_status){ ?>
	<div class="commentform row reset-button-default">
    	<div class="col-sm-12">
			<?php emarket_fnc_comment_form($comment_args); ?>
    	</div>
    </div><!-- end commentform -->
	<?php } ?>
</div><!-- end comments -->