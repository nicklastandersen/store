<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2015 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('nice-style'); ?>>
        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <?php endif; ?>
        <div class="post-container">
            <div class="blog-post-detail blog-post-grid">
                <figure class="entry-thumb">
                    <?php emarket_fnc_post_thumbnail(); ?>                   
                </figure>
                <div class="information-post">
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h4>
                    <div class="entry-meta">
                        <span class="entry-date">
                            <span class="fa fa-clock-o"></span>
                            <span class="year">&nbsp;<?php echo get_the_date('M d, Y'); ?></span>
                        </span>                    
                    </div>
                    <div class="description">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
