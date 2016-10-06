<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$socials = array('facebook' => esc_html__('Facebook', 'emarket'), 'twitter' => esc_html__('Twitter', 'emarket'),
	'youtube' => esc_html__('Youtube', 'emarket'), 'pinterest' => esc_html__('Pinterest', 'emarket'),
	'google-plus' => esc_html__('Google Plus', 'emarket'));
?>
<section class="widget-social <?php echo ($el_class!='')?' '.esc_attr( $el_class ):''; ?>">
    <?php if ($title!='') { ?>
        <h4 class="widget-title">
            <span><?php echo trim($title); ?></span>
        </h4>
    <?php } ?>
    <div class="widget-content">
	    <?php if ( !empty($description) ): ?>
	    	<?php echo trim( $description ); ?>
	    <?php endif; ?>
		<ul class="social list-unstyled list-inline">
		    <?php foreach( $socials as $key=>$social):
		            if( isset($atts[$key.'_url']) && !empty($atts[$key.'_url']) ): ?>
		                <li>
		                    <a href="<?php echo esc_url($atts[$key.'_url']);?>" class="<?php echo esc_attr($key); ?>">
		                        <i class="fa fa-<?php echo esc_attr($key); ?> "></i>
		                    </a>
		                </li>
		    <?php
		            endif;
		        endforeach;
		    ?>
		</ul>
	</div>
</section>
