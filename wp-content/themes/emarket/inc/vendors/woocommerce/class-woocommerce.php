<?php 
/**
 * Class Emarket Woocommerce
 *
 */
class Emarket_Woocommerce{

    /**
     * Constructor to create an instance of this for processing logics render content and modules.
     */
	public function __construct(){
        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

		add_action( 'customize_register',  array( $this, 'registerCustomizer' ), 9 );
        add_action( 'wp_enqueue_scripts', array( $this, 'loadThemeStyles' ), 15 );


        if( emarket_fnc_theme_options('is-quickview',true) ){
            add_action( 'wp_ajax_emarket_quickview', array($this,'quickview') );
            add_action( 'wp_ajax_nopriv_emarket_quickview', array($this,'quickview') );
            add_action( 'wp_footer', array($this,'quickviewModal') );
	    }

        if( emarket_fnc_theme_options( 'is-swap-effect',true ) ){
            remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
            add_action('woocommerce_before_shop_loop_item_title',   array($this,'swapImages'),10);

        }    
    }

    /**
     * Enable product swap image
     *
     * @static
     * @access public
     * @since Emarket 1.0
     */
    public function swapImages(){
        global $post, $product, $woocommerce;
        $placeholder_width = get_option('shop_catalog_image_size');
        $placeholder_width = $placeholder_width['width'];

        $placeholder_height = get_option('shop_catalog_image_size');
        $placeholder_height = $placeholder_height['height'];

        $output='';
        $class = 'image-no-effect';
        if(has_post_thumbnail()){
            $attachment_ids = $product->get_gallery_attachment_ids();
            if($attachment_ids) {
                $class = 'image-hover';
                $output.=wp_get_attachment_image($attachment_ids[0],'shop_catalog',false,array('class'=>"attachment-shop_catalog image-effect"));
            }
            $output.=get_the_post_thumbnail( $post->ID,'shop_catalog',array('class'=>$class) );
        }else{
            $output .= '<img src="'.woocommerce_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'emarket').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }

    /**
     * Load woocommerce styles follow theme skin actived
     *
     * @static
     * @access public
     * @since Emarket 1.0
     */
    public function loadThemeStyles() {
        $current = emarket_fnc_theme_options( 'skin','default' );
        if($current == 'default'){
            $path =  get_template_directory_uri() .'/css/woocommerce.css';
        }else{
            $path =  get_template_directory_uri() .'/css/skins/'.$current.'/woocommerce.css';
        }
        wp_enqueue_style( 'emarket-woocommerce', $path , 'emarket-woocommerce-front' , PRESTABASE_THEME_VERSION, 'all' );
    }

	/**
	 * Add settings to the Customizer.
	 *
	 * @static
	 * @access public
	 * @since Emarket 1.0
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer object.
	 */
	public function registerCustomizer( $wp_customize ){
		$wp_customize->add_panel( 'panel_woocommerce', array(
    		'priority' => 70,
    		'capability' => 'edit_theme_options',
    		'theme_supports' => '',
    		'title' => esc_html__( 'Woocommerce', 'emarket' ),
    		'description' =>esc_html__( 'Make default setting for page, general', 'emarket' ),
    	) );

        /**
         * General Setting
         */
        $wp_customize->add_section( 'wc_general_settings', array(
            'priority' => 1,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'General Setting', 'emarket' ),
            'description' => '',
            'panel' => 'panel_woocommerce',
        ) );

        //config mini cart
        $wp_customize->add_setting('pbr_theme_options[woo-show-minicart]', array(
            'capability' => 'manage_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control('pbr_theme_options[woo-show-minicart]', array(
            'settings'  => 'pbr_theme_options[woo-show-minicart]',
            'label'     => esc_html__('Enable Mini Basket', 'emarket'),
            'section'   => 'wc_general_settings',
            'type'      => 'checkbox'
        ) );

        
        $wp_customize->add_setting('pbr_theme_options[is-quickview]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control('pbr_theme_options[is-quickview]', array(
            'settings'  => 'pbr_theme_options[is-quickview]',
            'label'     => esc_html__('Enable QuickView', 'emarket'),
            'section'   => 'wc_general_settings',
            'type'      => 'checkbox',
            'transport' => 4,
        ) );



        $wp_customize->add_setting('pbr_theme_options[is-swap-effect]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control('pbr_theme_options[is-swap-effect]', array(
            'settings'  => 'pbr_theme_options[is-swap-effect]',
            'label'     => esc_html__('Enable Swap Image', 'emarket'),
            'section'   => 'wc_general_settings',
            'type'      => 'checkbox',
            'transport' => 4,
        ) );

        /**
         * Archive Page Setting
         */
        $wp_customize->add_section( 'wc_archive_settings', array(
            'priority' => 2,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Archive Page Setting', 'emarket' ),
            'description' => 'Configure categories, search, shop page setting',
            'panel' => 'panel_woocommerce',
        ) );

         ///  Archive layout setting
        $wp_customize->add_setting( 'pbr_theme_options[woocommerce-archive-layout]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'mainright',
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( new Emarket_Layout_DropDown( $wp_customize,  'pbr_theme_options[woocommerce-archive-layout]', array(
            'settings'  => 'pbr_theme_options[woocommerce-archive-layout]',
            'label'     => esc_html__('Archive Layout', 'emarket'),
            'section'   => 'wc_archive_settings',
            'priority' => 1

        ) ) );

       //sidebar archive left
        $wp_customize->add_setting( 'pbr_theme_options[woocommerce-archive-left-sidebar]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'sidebar-left',
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( new Emarket_Sidebar_DropDown( $wp_customize,  'pbr_theme_options[woocommerce-archive-left-sidebar]', array(
            'settings'  => 'pbr_theme_options[woocommerce-archive-left-sidebar]',
            'label'     => esc_html__('Archive Left Sidebar', 'emarket'),
            'section'   => 'wc_archive_settings' ,
             'priority' => 3
        ) ) );

          //sidebar archive right
        $wp_customize->add_setting( 'pbr_theme_options[woocommerce-archive-right-sidebar]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'sidebar-right',
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( new Emarket_Sidebar_DropDown( $wp_customize,  'pbr_theme_options[woocommerce-archive-right-sidebar]', array(
            'settings'  => 'pbr_theme_options[woocommerce-archive-right-sidebar]',
            'label'     => esc_html__('Archive Right Sidebar', 'emarket'),
            'section'   => 'wc_archive_settings',
             'priority' => 4 
        ) ) );

        //number product per page
        $wp_customize->add_setting( 'pbr_theme_options[woo-number-page]', array(
            'type'       => 'option',
            'default'    => 12,
            'capability' => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( 'pbr_theme_options[woo-number-page]', array(
            'label'      => esc_html__( 'Number of Products Per Page', 'emarket' ),
            'section'    => 'wc_archive_settings',
            'priority' => 6
        ) );

        //number product per row
        $wp_customize->add_setting( 'pbr_theme_options[wc_itemsrow]', array(
            'type'       => 'option',
            'default'    => 4,
            'capability' => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'pbr_theme_options[wc_itemsrow]', array(
            'label'      => esc_html__( 'Number of Products Per Row', 'emarket' ),
            'section'    => 'wc_archive_settings',
            'type'       => 'select',
            'choices'     => array(
                '2' => esc_html__('2 Items', 'emarket' ),
                '3' => esc_html__('3 Items', 'emarket' ),
                '4' => esc_html__('4 Items', 'emarket' ),
                '6' => esc_html__('6 Items', 'emarket' ),
            ),
            'priority' => 7
        ) );
    	

        /**
    	 * Product Single Setting
    	 */
    	$wp_customize->add_section( 'wc_product_settings', array(
    		'priority' => 12,
    		'capability' => 'edit_theme_options',
    		'theme_supports' => '',
    		'title' => esc_html__( 'Single Product Page Setting', 'emarket' ),
    		'description' => 'Configure single product page',
    		'panel' => 'panel_woocommerce',
    	) );
        ///  single layout setting
        $wp_customize->add_setting( 'pbr_theme_options[woocommerce-single-layout]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'mainright',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        //Select layout
        $wp_customize->add_control( new Emarket_Layout_DropDown( $wp_customize,  'pbr_theme_options[woocommerce-single-layout]', array(
            'settings'  => 'pbr_theme_options[woocommerce-single-layout]',
            'label'     => esc_html__('Product Detail Layout', 'emarket'),
            'section'   => 'wc_product_settings',
            'priority' => 1
        ) ) );

       
        $wp_customize->add_setting( 'pbr_theme_options[woocommerce-single-left-sidebar]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        //Sidebar left
        $wp_customize->add_control( new Emarket_Sidebar_DropDown( $wp_customize,  'pbr_theme_options[woocommerce-single-left-sidebar]', array(
            'settings'  => 'pbr_theme_options[woocommerce-single-left-sidebar]',
            'label'     => esc_html__('Product Detail Left Sidebar', 'emarket'),
            'section'   => 'wc_product_settings',
            'priority' => 2 
        ) ) );

         $wp_customize->add_setting( 'pbr_theme_options[woocommerce-single-right-sidebar]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'sidebar-right',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        //Sidebar right
        $wp_customize->add_control( new Emarket_Sidebar_DropDown( $wp_customize,  'pbr_theme_options[woocommerce-single-right-sidebar]', array(
            'settings'  => 'pbr_theme_options[woocommerce-single-right-sidebar]',
            'label'     => esc_html__('Product Detail Right Sidebar', 'emarket'),
            'section'   => 'wc_product_settings',
            'priority' => 3 
        ) ) );

        //Show related product
        $wp_customize->add_setting('pbr_theme_options[wc_show_related]', array(     
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 0,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        
        $wp_customize->add_control('pbr_theme_options[wc_show_related]', array(
            'settings'  => 'pbr_theme_options[wc_show_related]',
            'label'     => esc_html__('Disable show related product', 'emarket'),
            'section'   => 'wc_product_settings',
            'type'      => 'checkbox',
            'priority' => 4
        ) );
         //Show upsells product
        $wp_customize->add_setting('pbr_theme_options[wc_show_upsells]', array(     
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 0,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        
        $wp_customize->add_control('pbr_theme_options[wc_show_upsells]', array(
            'settings'  => 'pbr_theme_options[wc_show_upsells]',
            'label'     => esc_html__('Disable show upsells product', 'emarket'),
            'section'   => 'wc_product_settings',
            'type'      => 'checkbox',
            'transport' => 3,
            'priority' => 5
        ) );

        //number of product per row 
        $wp_customize->add_setting( 'pbr_theme_options[product-number-columns]', array(
            'type'       => 'option',
            'default'    => 3,
            'capability' => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'pbr_theme_options[product-number-columns]', array(
            'label'      => esc_html__( 'Number of Product Per Row', 'emarket' ),
            'section'    => 'wc_product_settings',
            'type'       => 'select',
            'choices'     => array(
                '2' => esc_html__('2 Items', 'emarket' ),
                '3' => esc_html__('3 Items', 'emarket' ),
                '4' => esc_html__('4 Items', 'emarket' ),
                '5' => esc_html__('5 Items', 'emarket' ),
                '6' => esc_html__('6 Items', 'emarket' )
            ),
            'priority' => 6
        ) );
        
        //Number of product to show 
        $wp_customize->add_setting( 'pbr_theme_options[woo-number-product-single]', array(
            'type'       => 'option',
            'default'	 => 6,
            'capability' => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'pbr_theme_options[woo-number-product-single]', array(
            'label'      => esc_html__( 'Number of Products to Show', 'emarket' ),
            'section'    => 'wc_product_settings',
            'priority' => 7
        ) );

         //Show Social share product
        $wp_customize->add_setting('pbr_theme_options[wc_show_share_social]', array(     
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        
        $wp_customize->add_control('pbr_theme_options[wc_show_share_social]', array(
            'settings'  => 'pbr_theme_options[wc_show_share_social]',
            'label'     => esc_html__('Show Social share product', 'emarket'),
            'section'   => 'wc_product_settings',
            'type'      => 'checkbox',
            'priority' => 8
        ) );
	}


    public function quickview(){
        $args = array(
                'post_type'=>'product',
                'product'=>$_GET['productslug']
            );
        $query = new WP_Query($args);
        if($query->have_posts()){
            while($query->have_posts()): $query->the_post();
                if(is_file( get_template_directory().'/woocommerce/quickview.php')){
                    require( get_template_directory().'/woocommerce/quickview.php' );
                }
            endwhile;
        }

        wp_reset_postdata();
        die;
    }

    public function quickviewModal(){
    ?>
    <div class="modal fade" id="pbr-quickview-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body"><span class="spinner"></span></div>
                </div>
            </div>
        </div>

    <?php    
    }
}

new Emarket_Woocommerce();