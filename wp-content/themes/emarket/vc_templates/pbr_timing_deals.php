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


    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

    $enddays = strtotime( $input_datetime );

    if( $enddays < time())
        return;

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
   
        'posts_per_page' => 10,
        'meta_query' => array(
            array(
                'key' => '_visibility',
                'value' => array('catalog', 'visible'),
                'compare' => 'IN'
            ),
            
            array(
                'key' => '_sale_price_dates_to',
                'value' => time(),
                'compare' => '>=',
                'type' => 'NUMERIC'
            ),
              
            array(
                'key' => '_sale_price',
                'value' => 0,
                'compare' => '>',
                'type' => 'NUMERIC'
            )
        )
    );

 
    $loop = new WP_Query( $args );
    $_id = emarket_fnc_makeid();
    
    $_total  = $loop->found_posts;
 

    $words = explode(" ", trim($title) ) ; 
    if( count($words) > 1 ){
        $title = '<span>'.($words[0]).'</span>';
        unset($words[0]);
        $title .=' '. implode(' ', $words);
    }    
    ?>

    <?php if ( $loop->have_posts() ) { ?> 
    <div class="widget-timing-deal bg-danger <?php echo ($el_class!='')?' '.esc_attr( $el_class ):''; ?>">
       <div class="widget-content">
        <div class="woocommerce woo-deals  clearfix">
                <div class="col-lg-3 col-md-4">
                    <div class="widget-heading text-white">
                        <?php if( !empty($description) ){ ?>
                        <p><?php echo trim( $description ); ?></p>
                        <?php } ?>
                         <?php if($title!=''){ ?>
                            <h3 class="text-white">
                               <?php echo trim( $title ); ?>
                            </h3>
                        <?php } ?>
                        <div class="countdown-wrapper">
                            <div class="pbr-countdown clearfix" data-countdown="countdown"
                                 data-date="<?php echo date('m',$enddays).'-'.date('d',$enddays).'-'.date('Y',$enddays).'-'. date('H',$enddays) . '-' . date('i',$enddays) . '-' .  date('s',$enddays) ; ?>">
                            </div>
                        </div>
                     </div>
                </div>
                <?php if( !empty($columns_count) ){ ?>
                <div class="col-lg-9 col-md-8 woo-products-deals bg-white">    
                        <div id="carousel-<?php echo esc_attr($_id); ?>" class="widget-content owl-carousel-play" data-ride="owlcarousel">  
                             <?php if($_total>$columns_count){ ?>
                 
                                    <a class="left carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="prev">
                                            <span class="fa fa-arrow-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="next">
                                            <span class="fa fa-arrow-right"></span>
                                    </a>
                           
                            <?php } ?>
                             <div class="owl-carousel rows-products" data-slide="<?php echo esc_attr($columns_count); ?>" data-pagination="false" data-navigation="true">
                               <?php 
                                 while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                   <?php woocommerce_get_template_part( 'content', 'product-deal' ); ?>
                                <?php  endwhile;  ?>
                               
                            </div>
                        </div>
                </div>  
                 <?php } ?>  
            </div>
        </div>
    </div>
    <?php   }  ?>
<?php wp_reset_postdata(); ?>
