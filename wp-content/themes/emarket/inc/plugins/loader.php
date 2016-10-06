<?php
/**
 * Implement rick meta box for post and page, custom post types. These 're used with metabox plugins
 */
if( is_admin() ){ 
	emarket_pbr_includes(  get_template_directory() . '/inc/admin/function.php' );
	emarket_pbr_includes(  get_template_directory() . '/inc/admin/metabox/*.php' );
}
emarket_pbr_includes(  get_template_directory() . '/inc/classes/*.php' );
emarket_pbr_includes(  get_template_directory() . '/inc/*.php' );