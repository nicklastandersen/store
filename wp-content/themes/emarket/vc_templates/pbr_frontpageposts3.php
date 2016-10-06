<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



if(empty($loop)) return;
$this->getLoop($loop);
$args = $this->loop_args;

if(is_front_page()){
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
else{
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}
$args['paged'] = $paged; 
$post_per_page = $args['posts_per_page']; 


$loop = new WP_Query($args);
?>

<section class="widget frontpage-posts frontpage-3 section-blog widget-style <?php echo ($el_class!='')?' '.esc_attr( $el_class ):''; ?>">
    <?php
        if($title!=''){ ?>
            <h3 class="widget-title visual-title <?php echo esc_attr($size).' '.esc_attr( $alignment ); ?>">
                <span><?php echo trim($title); ?></span>
            </h3>
        <?php }
    ?>
    <div class="widget-content"> 
       <?php
        $_count =1;
        $colums = '3';
        $bscol = floor( 12/$colums );
        $end = $loop->post_count;
        ?>

        <div class="frontpage-wrapper">
        <div class="row">
        <?php

            $i = 0;
            $main = $num_mainpost;

            while($loop->have_posts()){
                $loop->the_post();
         ?>
                <?php if( $i<=$main-1) { ?>
                    <?php if( $i == 0 ) {  ?>
                        <div  class="col-sm-12 main-posts large">
                    <?php } ?>
                    <?php get_template_part( 'vc_templates/post/_single-v2' ) ?>

                    <?php if( $i == $main-1 || $i == $end -1 ) { ?>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                        <?php if( $i == $main  ) { ?>
                        <div class="col-sm-12 secondary-posts">
                        <?php }  ?>
                             <?php get_template_part( 'vc_templates/post/_single-v2' ) ?>
                        <?php if( $i == $end-1 ) {   ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
        <?php  $i++; } ?>
        </div>
        </div>
    
        <?php if( isset($show_pagination) && $show_pagination ): ?>
        <div class="w-pagination clearfix"><?php emarket_fnc_pagination_nav( $post_per_page,$loop->found_posts,$loop->max_num_pages ); ?></div>
        <?php endif ; ?>
    </div>
</section>
<?php wp_reset_postdata(); ?>