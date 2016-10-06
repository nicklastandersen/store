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

/**
 * Prestabrain Category Drop Down List Class
 * modified dropdown-pages from wp-includes/class-wp-customize-control.php
 *
 * @since Prestabrain v1.0
 */
if(  class_exists("WP_Customize_Control") ){

    emarket_pbr_includes(  get_template_directory() . '/inc/customizer/*.php' );
    
    class Emarket_Sidebar_DropDown extends WP_Customize_Control{
     
        public function render_content(){
            
            global $wp_registered_sidebars;
            
            $output = array();
            
            $output[] = '<option value="">'.esc_html__( 'No Sidebar', 'emarket' ).'</option>';

            foreach( $wp_registered_sidebars as $sidebar ){ 
                $selected = ($this->value() == $sidebar['id'])?' selected="selected" ': '';
                $output[] = '<option value="'.$sidebar['id'].'" '.$selected.'>'.$sidebar['name'].'</option>';
            }

            $dropdown = '<select>'.implode( " ", $output ).'</select>';
            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

            printf( 
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
     
        }
    }

    ///
    class Emarket_Layout_DropDown extends WP_Customize_Control{
        public $type="PBR_Layout";
        public function render_content(){
            
            $layouts = array(
                '' => esc_html__('Auto', 'emarket'),
                'leftmain' => esc_html__('Left - Main Sidebar', 'emarket'),
                'mainright' => esc_html__('Main - Right Sidebar', 'emarket'),
                'leftmainright' => esc_html__('Left - Main - Right Sidebar', 'emarket'),
        
            );
             printf( 
                '<label class="customize-control-select"><span class="customize-control-title">%s</span>',
                 $this->label
               
            );
            ?>
            <div class="page-layout">
               

            <?php
            $output = array();
            
            foreach( $layouts as $key => $layout ){ 
                $v = $this->value() ? $this->value() : 'fullwidth' ;   
                $selected = ( $v == $key)?' selected="selected" ': '';
                $output[] = '<option value="'.$key.'" '.$selected.'>'.$layout.'</option>';
            }

            $dropdown = '<select>'.implode( " ", $output ).'</select>';
            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

            printf( 
                '%s</label>',
                
                $dropdown
            ).'</div>';
        }
    }

}
if ( class_exists( 'WP_Customize_Control' ) ) {
    class Emarket_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
        public $type = 'dropdown-categories';	

        public function render_content() {
            $dropdown = wp_dropdown_categories( 
                array( 
                    'name'             => '_customize-dropdown-categories-' . $this->id,
                    'echo'             => 0,
                    'hide_empty'       => false,
                    'show_option_none' => '&mdash; ' . esc_html__('Select', 'emarket') . ' &mdash;',
                    'hide_if_empty'    => false,
                    'selected'         => $this->value(),
                )
            );

            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

            printf( 
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}

/**
 * Prestabrain TextArea Control Class
 * create custom textarea input field
 *
 * @since Prestabrain v0.5
 **/

if ( class_exists( 'WP_Customize_Control' ) ) {
    # Adds textarea support to the theme customizer
    class PBRTextAreaControl extends WP_Customize_Control {
        public $type = 'textarea'; # can change to 'number' for input[type=number] field
        public function __construct( $manager, $id, $args = array() ) {
            $this->statuses = array( '' => esc_html__( 'Default', 'emarket' ) );
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {
            echo '<label>
                <span class="customize-control-title">' . esc_html( $this->label ) . '</span>
                <textarea rows="5" style="width:100%;" ';
            $this->link();
            echo '>' . esc_textarea( $this->value() ) . '</textarea>
                </label>';
        }
    }

}

if (  class_exists( 'WP_Customize_Control' ) ) {
     

    /**
     * Class to create a custom tags control
     */
    class Text_Editor_Custom_Control extends WP_Customize_Control
    {
          /**
           * Render the content on the theme customizer page
           */
          public function render_content()
           {
                ?>
                    <label>
                      <span class="customize-text_editor"><?php echo esc_html( $this->label ); ?></span>
                      <?php
                        $settings = array(
                          'textarea_name' => $this->id
                          );

                        wp_editor($this->value(), $this->id, $settings );
                      ?>
                    </label>
                <?php
           }
    }

}

/**
 * Prestabrain Google Front Control Class
 *
 * @since Prestabrain v2.1
 **/
if ( class_exists( 'WP_Customize_Control' ) ) {
    # Adds textarea support to the theme customizer
    class Emarket_GoogleFontControl extends WP_Customize_Control {
    
        private $fonts = false;

        public function __construct($manager, $id, $args = array(), $options = array()){
            $this->fonts = get_transient( 'google_font_names_');

            if ( ! is_array( $this->fonts ) )
                $this->fonts = $this->get_font_names();

            if ( ! $this->fonts ) return;
            
            parent::__construct( $manager, $id, $args );

        }
    
        public function render_content() {
            if(!empty($this->fonts)) { ?>
                <label>
                    <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                    <select <?php $this->link(); ?>>
                <?php
                foreach ( $this->fonts as $key => $value ) {
                    printf('<option value="%s">%s</option>',
                        $key,
                        $value);
                }
                ?>
                    </select>
                </label>
            <?php
            }
        }

        public function get_font_names() {
            
            $font_name_list = get_transient( 'google_font_names_');

            if ( $font_name_list )
                return $font_name_list;

            $json_name_list = @wp_remote_get( 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyBWVfrVgpz5SYM-inIZL4SpzCzTPi4Dhrg' );

            if ( !isset( $json_name_list ) )
                return;

            $decoded_name_list = @json_decode( $json_name_list[ 'body'] );

            $font_name_list[ 'none' ] = 'none';

            if ( is_object( $decoded_name_list ) )
                foreach ( $decoded_name_list->items as $font_name )
                    $font_name_list[ str_replace( ' ', '+', $font_name->family ) ] = $font_name->family;

            set_transient( 'google_font_names_', $font_name_list, 60 * 60 *24 );
            return $font_name_list;
        }
    }
}
?>
<?php
/**
 * Emarket Customizer support
 *
 * @package WpOpal
 * @subpackage WpOpal_Base
 * @since Emarket 1.0
 */

/**
 * Implement Customizer additions and adjustments.
 *
 * @since Emarket 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function emarket_fnc_customize_register( $wp_customize ) {
	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'emarket' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display Site Title &amp; Tagline', 'emarket' );

	// Add custom description to Colors and Background controls or sections.
	if ( property_exists( $wp_customize->get_control( 'background_color' ), 'description' ) ) {
		$wp_customize->get_control( 'background_color' )->description = esc_html__( 'May only be visible on wide screens.', 'emarket' );
		$wp_customize->get_control( 'background_image' )->description = esc_html__( 'May only be visible on wide screens.', 'emarket' );
	} else {
		$wp_customize->get_section( 'colors' )->description           = esc_html__( 'Background may only be visible on wide screens.', 'emarket' );
		$wp_customize->get_section( 'background_image' )->description = esc_html__( 'Background may only be visible on wide screens.', 'emarket' );
	} 


    $wp_customize->add_setting('topbar_bg', array( 
        'default'    => get_option('topbar_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('topbar_bg', array( 
        'label'    => esc_html__('Topbar Background', 'emarket'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );
    $wp_customize->add_setting('topbar_color', array( 
        'default'    => get_option('footer_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('topbar_color', array( 
        'label'    => esc_html__('Topbar Text Color', 'emarket'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );


    ///// 
    $wp_customize->add_setting('page_bg', array( 
        'default'    => get_option('page_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('page_bg', array( 
        'label'    => esc_html__('Page Container Background', 'emarket'),
        'section'  => 'colors',
        'type'      => 'color',
        'default'   => '#FFFFFF'
    ) );
    
    //

    $wp_customize->add_setting('footer_bg', array( 
        'default'    => get_option('footer_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('footer_bg', array( 
        'label'    => esc_html__('Footer Background', 'emarket'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );

    $wp_customize->add_setting('footer_heading_color', array( 
        'default'    => get_option('footer_heading_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('footer_heading_color', array( 
        'label'    => esc_html__('Footer Heading Color', 'emarket'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );


    $wp_customize->add_setting('footer_color', array( 
        'default'    => get_option('footer_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('footer_color', array( 
        'label'    => esc_html__('Footer Text Color', 'emarket'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );


    ///

    $wp_customize->add_setting('header_image_link', array( 
        'default'    => get_option('footer_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
        'default'   => '#'
    ) );
    
    $wp_customize->add_control('header_image_link', array( 
        'label'    => esc_html__('Image Link', 'emarket'),
        'section'  => 'header_image',
        'type'      => 'text',
        'default'   => '#'
    ) );
}

add_action( 'customize_register', 'emarket_fnc_customize_register' );


function emarket_fnc_sanitize_textarea( $content ){
    return wp_kses_post( force_balance_tags( $content ) );
}


/**
 *
 */
add_action( 'customize_register', 'emarket_fnc_cst_customizer' );

function emarket_fnc_cst_customizer($wp_customize){

    # General Settings
    // Panel Header
    $wp_customize->add_section('pbr_cst_general_settings', array(
        'title'      => esc_html__('General Settings', 'emarket'),
        'description'    => esc_html__('Website General Settings', 'emarket'),
        'transport'  => 'postMessage',
        'priority'   => 10,
    ));

    // Parameter Options
    $wp_customize->add_setting('blogname', array( 
        'default'    => get_option('blogname'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('blogname', array( 
        'label'    => esc_html__('Site Title', 'emarket'),
        'section'  => 'pbr_cst_general_settings',
        'priority' => 1,
    ) );
     
    //
    $wp_customize->add_setting('blogdescription', array( 
        'default'    => get_option('blogdescription'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('blogdescription', array( 
        'label'    => esc_html__('Tagline', 'emarket'),
        'section'  => 'pbr_cst_general_settings',
        'priority' => 2,
    ) );

    $wp_customize->add_setting('display_header_text', array( 
        'default'    => 1,
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );    
    $wp_customize->add_control( 'display_header_text', array(
        'settings' => 'header_textcolor',
        'label'    => esc_html__( 'Show Title & Tagline', 'emarket' ),
        'section'  => 'pbr_cst_general_settings',
        'type'     => 'checkbox',
        'priority' => 4,
    ) );


    /* 
     * Custom Logo 
     */
    if ( version_compare( $GLOBALS['wp_version'], '4.5', '<' ) ) {
         $wp_customize->add_setting('pbr_theme_options[logo]', array(
            'default'    => '',
            'type'       => 'option',
            'capability' => 'manage_options',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'pbr_theme_options[logo]', array(
            'label'    => esc_html__('Logo', 'emarket'),
            'section'  => 'pbr_cst_general_settings',
            'settings' => 'pbr_theme_options[logo]',
            'priority' => 10,
        ) ) );
    }
    
     /* 
     * Custom payment 
     */
     $wp_customize->add_setting('pbr_theme_options[image-payment]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'pbr_theme_options[image-payment]', array(
        'label'    => esc_html__('Payment Logo', 'emarket'),
        'section'  => 'pbr_cst_general_settings',
        'settings' => 'pbr_theme_options[image-payment]',
        'priority' => 11,
    ) ) );

    //
    $wp_customize->add_setting('pbr_theme_options[copyright_text]', array(
        'default'    => 'Copyright 2015 - Mixtheme - All Rights Reserved.',
        'type'       => 'option',
        'transport'=>'refresh',
         'sanitize_callback' => 'emarket_fnc_sanitize_textarea',
    ) );

    $wp_customize->add_control( new PBRTextAreaControl( $wp_customize, 'pbr_theme_options[copyright_text]', array(
        'label'    => esc_html__('Copyright text', 'emarket'),
        'section'  => 'pbr_cst_general_settings',
        'settings' => 'pbr_theme_options[copyright_text]',
        'priority' => 12,
    ) ) );


   /***************************************************************************
    * Theme Settings 
    ***************************************************************************/

  
   /**
     * General Setting
     */
    $wp_customize->add_section( 'ts_general_settings', array(
        'priority' => 12,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Themes And Layouts Setting', 'emarket' ),
        'description' => '',
    ) );

    //
    $wp_customize->add_setting( 'pbr_theme_options[skin]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => 'default',
         'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'pbr_theme_options[skin]', array(
        'label'      => esc_html__( 'Active Skin', 'emarket' ),
        'section'    => 'ts_general_settings',
        'type'    => 'select',
        'choices'    => emarket_fnc_cst_skins(),
    ) );

     $wp_customize->add_setting( 'pbr_theme_options[headerlayout]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'pbr_theme_options[headerlayout]', array(
        'label'      => esc_html__( 'Header Layout Style', 'emarket' ),
        'section'    => 'ts_general_settings',
        'type'    => 'select',
         'choices' => array(''=>'Default'), 
         'choices'    => emarket_fnc_get_header_layouts(),
    ) );


    $wp_customize->add_setting('pbr_theme_options[keepheader]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 0,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('pbr_theme_options[keepheader]', array(
        'settings'  => 'pbr_theme_options[keepheader]',
        'label'     =>  esc_html__( 'Keep Header', 'emarket' ),
        'section'   => 'ts_general_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );



    $wp_customize->add_setting( 'pbr_theme_options[footer-style]', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        'default'        => 'default'   ,
        'sanitize_callback' => 'sanitize_text_field'
        //  'theme_supports' => 'static-front-page',
    ) );
    
     $wp_customize->add_control( 'pbr_theme_options[footer-style]', array(
        'label'      => esc_html__( 'Footer Styles Builder', 'emarket' ),
        'section'    => 'ts_general_settings',
        'type'       => 'select',
        'choices'    => emarket_fnc_get_footer_profiles()
    ) );
     
 

    /******************************************************************
     * Social share
     ******************************************************************/
    $wp_customize->add_section( 'social_share_settings', array(
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Social Share setting', 'emarket' ),
        'description' => '',
    ) );

    // Share facebook
    emarket_fnc_social_config( $wp_customize, 'facebook_share_blog', esc_html__('Share facebook ', 'emarket'), 'social_share_settings');
    //share twitter
    emarket_fnc_social_config( $wp_customize, 'twitter_share_blog', esc_html__('Share twitter ', 'emarket'), 'social_share_settings');
    //share linkedin
    emarket_fnc_social_config( $wp_customize, 'linkedin_share_blog', esc_html__('Share linkedin ', 'emarket'), 'social_share_settings');
    //share tumblr
    emarket_fnc_social_config( $wp_customize, 'tumblr_share_blog', esc_html__('Share tumblr ', 'emarket'), 'social_share_settings');
    //share google plus
    emarket_fnc_social_config( $wp_customize, 'google_share_blog', esc_html__('Share google plus ', 'emarket'), 'social_share_settings');
    //share pinterest
    emarket_fnc_social_config( $wp_customize, 'pinterest_share_blog', esc_html__('Share pinterest ', 'emarket'), 'social_share_settings');
    //share mail
    emarket_fnc_social_config( $wp_customize, 'mail_share_blog', esc_html__('Share mail ', 'emarket'), 'social_share_settings');


    /******************************************************************
     * Navigation
     ******************************************************************/

     # Sticky Top Bar Option
    $wp_customize->add_setting('pbr_theme_options[verticalmenu]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('pbr_theme_options[verticalmenu]', array(
        'settings'  => 'pbr_theme_options[verticalmenu]',
        'label'     => esc_html__('Vertical Megamenu', 'emarket'),
        'section'   => 'nav',
        'type'      => 'select',
        'choices' => emarket_fnc_get_menugroups(),
    ) );
    


    # Sticky Top Bar Option
    $wp_customize->add_setting('pbr_theme_options[megamenu-is-sticky]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('pbr_theme_options[megamenu-is-sticky]', array(
        'settings'  => 'pbr_theme_options[megamenu-is-sticky]',
        'label'     => esc_html__('Sticky Top Bar', 'emarket'),
        'section'   => 'nav',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );   
 
    $wp_customize->add_setting( 'pbr_theme_options[megamenu-duration]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => '300',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'pbr_theme_options[megamenu-duration]', array(
        'label'      => esc_html__(  'Megamenu Duration', 'emarket' ),
        'section'    => 'nav',
        'type'    => 'text'
    ) );

    /*****************************************************************
     * Front Page Settings Panel
     *****************************************************************/   
    $wp_customize->add_section( 'static_front_page', array(
        'title'          => esc_html__( 'Front Page Settings', 'emarket' ),
        'priority'       => 120,
        'description'    => esc_html__( 'Your theme supports a static front page.', 'emarket'),
    ) );

    $wp_customize->add_setting( 'pbr_theme_options[sidebar_position]', array(
        'default' => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
 
    $wp_customize->add_control( 'pbr_theme_options[sidebar_position]', array(
        'type' => 'radio',
        'label' => 'Sidebar Position',
        'section' => 'static_front_page',
        'priority' => 1,
        'choices' => array(
            'left' => 'Left',
            'right' => 'Right',
        ),
    ) );

    $wp_customize->add_setting( 'show_on_front', array(
        'default'        => get_option( 'show_on_front' ),
        'capability'     => 'manage_options',
        'type'           => 'option',
        //  'theme_supports' => 'static-front-page',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'show_on_front', array(
        'label'   => esc_html__( 'Front page displays', 'emarket' ),
        'section' => 'static_front_page',
        'type'    => 'radio',
        'choices' => array(
            'posts' => esc_html__( 'Your latest posts', 'emarket' ),
            'page'  => esc_html__( 'A static page', 'emarket' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'page_on_front', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'page_on_front', array(
        'label'      => esc_html__( 'Front page', 'emarket' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );

    $wp_customize->add_setting( 'page_for_posts', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        //  'theme_supports' => 'static-front-page',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'page_for_posts', array(
        'label'      => esc_html__( 'Posts page', 'emarket' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );


    /* 
     /*****************************************************************
     * Front Page Settings Panel
     *****************************************************************/   
    $wp_customize->add_section( 'pages_setting', array(
        'title'          => esc_html__( 'Pages Settings', 'emarket' ),
        'priority'       => 120,
        'description'    => esc_html__( 'Your theme supports a static front page.', 'emarket'),
    ) );

     
    $wp_customize->add_setting( 'pbr_theme_options[404_post]', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        'default'        => ''   ,
        'sanitize_callback' => 'sanitize_text_field'
        //  'theme_supports' => 'static-front-page',
    ) );
    
     $wp_customize->add_control( 'pbr_theme_options[404_post]', array(
        'label'      => esc_html__( '404 Page', 'emarket' ),
        'section'    => 'pages_setting',
        'type'       => 'dropdown-pages',
    ) );

     // 
}


function emarket_fnc_social_config( $wp_customize, $id, $name_social, $section){
    $wp_customize->add_setting('pbr_theme_options['.$id.']', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('pbr_theme_options['.$id.']', array(
        'settings'  => 'pbr_theme_options['.$id.']',
        'label'     => $name_social,
        'section'   => $section,
        'type'      => 'checkbox',
        'transport' => 4,
    ) );
}



 
add_action( 'customize_register', 'emarket_fnc_blog_settings' );
function emarket_fnc_blog_settings( $wp_customize ){
    
    $wp_customize->add_panel( 'panel_blog', array(
        'priority' => 80,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Blog & Post', 'emarket' ),
        'description' =>esc_html__( 'Make default setting for page, general', 'emarket' ),
    ) );


 
   

  


    /**
     * General Setting
     */
    $wp_customize->add_section( 'blog_general_settings', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'General Setting', 'emarket' ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

    
    

    /**
     * Archive Setting
     */
    $wp_customize->add_section( 'archive_general_settings', array(
        'priority' => 11,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Archive & Categgory Setting', 'emarket' ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

    $wp_customize->add_setting('pbr_theme_options[blog-archive-column]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '1',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'pbr_theme_options[blog-archive-column]', array(
        'label'      => esc_html__( 'Select column', 'emarket' ),
        'section'    => 'archive_general_settings',
        'type'       => 'select',
        'choices'     => array(
            '1' => esc_html__('1 column', 'emarket' ),
            '2' => esc_html__('2 columns', 'emarket' ),
            '3' => esc_html__('3 columns', 'emarket' ),
            '4' => esc_html__('4 columns', 'emarket' ),
            '6' => esc_html__('6 columns', 'emarket' ),
        )
    ) );

      ///  Archive layout setting
    $wp_customize->add_setting( 'pbr_theme_options[blog-archive-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'mainright',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Emarket_Layout_DropDown( $wp_customize, 'pbr_theme_options[blog-archive-layout]', array(
        'settings'  => 'pbr_theme_options[blog-archive-layout]',
        'label'     => esc_html__('Archive Layout', 'emarket'),
        'section'   => 'archive_general_settings',
        'priority' => 1

    ) ) );

   

   
    $wp_customize->add_setting( 'pbr_theme_options[blog-archive-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-left',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    
    $wp_customize->add_control( new Emarket_Sidebar_DropDown( $wp_customize, 'pbr_theme_options[blog-archive-left-sidebar]', array(
        'settings'  => 'pbr_theme_options[blog-archive-left-sidebar]',
        'label'     => esc_html__('Archive Left Sidebar', 'emarket'),
        'section'   => 'archive_general_settings' ,
         'priority' => 2
    ) ) );

     /// 
    $wp_customize->add_setting( 'pbr_theme_options[blog-archive-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-right',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Emarket_Sidebar_DropDown( $wp_customize, 'pbr_theme_options[blog-archive-right-sidebar]', array(
        'settings'  => 'pbr_theme_options[blog-archive-right-sidebar]',
        'label'     => esc_html__('Archive Right Sidebar', 'emarket'),
        'section'   => 'archive_general_settings',
         'priority' => 2 
    ) ) );

    /**
     * Single post Setting
     */
    $wp_customize->add_section( 'blog_single_settings', array(
        'priority' => 12,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Single post Setting', 'emarket' ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

    
    $wp_customize->add_setting('pbr_theme_options[blog-show-share-post]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 0,
        'checked' => 0,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('pbr_theme_options[blog-show-share-post]', array(
        'settings'  => 'pbr_theme_options[blog-show-share-post]',
        'label'     => esc_html__('Show share post', 'emarket'),
        'section'   => 'blog_single_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );

    $wp_customize->add_setting('pbr_theme_options[blog-show-related-post]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('pbr_theme_options[blog-show-related-post]', array(
        'settings'  => 'pbr_theme_options[blog-show-related-post]',
        'label'     => esc_html__('Show related post', 'emarket'),
        'section'   => 'blog_single_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );
    

    $wp_customize->add_setting( 'pbr_theme_options[blog-items-show]', array(
        'type'       => 'option',
        'default'    => 4,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'pbr_theme_options[blog-items-show]', array(
        'label'      => esc_html__( 'Number of related posts to show', 'emarket' ),
        'section'    => 'blog_single_settings',
        'type'       => 'select',
        'choices'     => array(
            '2' => esc_html__('2 posts', 'emarket' ),
            '3' => esc_html__('3 posts', 'emarket' ),
            '4' => esc_html__('4 posts', 'emarket' ),
            '6' => esc_html__('6 posts', 'emarket' ),
        )
    ) );   


       ///  single layout setting
    $wp_customize->add_setting( 'pbr_theme_options[blog-single-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Emarket_Layout_DropDown( $wp_customize,  'pbr_theme_options[blog-single-layout]', array(
        'settings'  => 'pbr_theme_options[blog-single-layout]',
        'label'     => esc_html__('Single Blog Layout', 'emarket'),
        'section'   => 'blog_single_settings' 
    ) ) );

   
    $wp_customize->add_setting( 'pbr_theme_options[blog-single-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Emarket_Sidebar_DropDown( $wp_customize,  'pbr_theme_options[blog-single-left-sidebar]', array(
        'settings'  => 'pbr_theme_options[blog-single-left-sidebar]',
        'label'     => esc_html__('Single blog Left Sidebar', 'emarket'),
        'section'   => 'blog_single_settings' 
    ) ) );

     $wp_customize->add_setting( 'pbr_theme_options[blog-single-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Emarket_Sidebar_DropDown( $wp_customize,  'pbr_theme_options[blog-single-right-sidebar]', array(
        'settings'  => 'pbr_theme_options[blog-single-right-sidebar]',
        'label'     => esc_html__('Single blog Right Sidebar', 'emarket'),
        'section'   => 'blog_single_settings' 
    ) ) );



}


/**
 * Sanitize the Featured Content layout value.
 *
 * @since Emarket 1.0
 *
 * @param string $layout Layout type.
 * @return string Filtered layout type (grid|slider).
 */
function emarket_fnc_sanitize_layout( $layout ) {
	if ( ! in_array( $layout, array( 'grid', 'slider' ) ) ) {
		$layout = 'grid';
	}

	return $layout;
}

/**
 * Bind JS handlers to make Customizer preview reload changes asynchronously.
 *
 * @since Emarket 1.0
 */
function emarket_fnc_customize_preview_js() {
	wp_enqueue_script( 'emarket_fnc_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'emarket_fnc_customize_preview_js' );

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 * @since Emarket 1.0
 */
function emarket_fnc_contextual_help() {
	if ( 'admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow'] ) {
		return;
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'emarket',
		'title'   => esc_html__( 'Emarket', 'emarket' ),
		'content' =>
			'<ul>' .
				'<li>' . sprintf( wp_kses_post( __( 'The home page features your choice of up to 6 posts prominently displayed in a grid or slider, controlled by a <a href="%1$s">tag</a>; you can change the tag and layout in <a href="%2$s">Appearance &rarr; Customize</a>. If no posts match the tag, <a href="%3$s">sticky posts</a> will be displayed instead.', 'emarket' ) ), esc_url( add_query_arg( 'tag', _x( 'featured', 'featured content default tag slug', 'emarket' ), admin_url( 'edit.php' ) ) ), admin_url( 'customize.php' ), admin_url( 'edit.php?show_sticky=1' ) ) . '</li>' .
				'<li>' . sprintf( wp_kses_post( __( 'Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. Emarket uses featured images for posts and pages&mdash;above the title&mdash;and in the Featured Content area on the home page.', 'emarket' ) ), 'https://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail' )  . '</li>' .
				'<li>' . sprintf( wp_kses_post( __( 'For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">Emarket documentation</a>.', 'emarket' ) ), 'https://codex.wordpress.org/Presta_Base' ) . '</li>' .
			'</ul>',
	) );
}
add_action( 'admin_head-themes.php', 'emarket_fnc_contextual_help' );
add_action( 'admin_head-edit.php',   'emarket_fnc_contextual_help' );
