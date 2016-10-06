<h4 class="widget-title"><span><?php echo trim( $title ); ?></span></h4>
<ul class="social list-unstyled list-inline bo-sicolor">
    <?php foreach( $socials as $key=>$social):
            if( isset($social['status']) && !empty($social['page_url']) ): ?>
                <li>
                    <a href="<?php echo esc_url($social['page_url']);?>" class="<?php echo esc_attr($key); ?>">
                        <i class="fa fa-<?php echo esc_attr($key); ?> bo-social-<?php echo esc_attr($key); ?>">&nbsp;</i> <?php echo trim( $social['name'] ); ?>
                    </a>
                </li>
    <?php
            endif;
        endforeach;
    ?>
</ul>