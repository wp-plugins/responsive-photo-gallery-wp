<?php
/*
Plugin Name: Custom Photo Gallery Wordpress
Plugin URI: http://themepoints.com
Description: Custom photo gallery wordpress is a pure css3 plugins. This plugins will enable a awesome responsive photo gallery in your website. install and enjoy this feature.
Version: 1.0
Author: themepoints
Author URI: http://themepoints.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) exit;
	
define('TP_CUSTOM_PHOTO_GALLERY_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


// add latest jquery form wordpress

function tp_custom_photo_gallery_script_enable()
	{
	wp_enqueue_script('jquery');
	wp_enqueue_script('plugin-tps-main-js', plugins_url( '/js/lightGallery.js', __FILE__ ), array('jquery'), '1.0', false);	
	wp_enqueue_style('plugin-tps-main-css', TP_CUSTOM_PHOTO_GALLERY_PLUGIN_PATH.'css/lightGallery.css');
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('tps-wp-color-picker', plugins_url(), array( 'wp-color-picker' ), false, true );	
	}
add_action('init', 'tp_custom_photo_gallery_script_enable');


// enable custom photo gallery wordpress js

function tp_photo_gallery_active_script () {?>
	<script type="text/javascript">
        jQuery(document).ready(function(){
        jQuery("#lightGallery").lightGallery();;
        });
    </script>
<?php	
}
add_action('wp_head', 'tp_photo_gallery_active_script');

function tp_custom_photo_gallery_active_css () {
?>
<style type="text/css">
.ligh_gallery_item ul li img{border-radius: 0;height: 100px;width:100px;}
</style>
<?php	
}
add_action('wp_head', 'tp_custom_photo_gallery_active_css');



// register custom photo gallery post type
function tp_custom_photo_gallery_post_register() {
	register_post_type(
	'tp_photo_gallery',
		array(
			'labels' => array(
				'name' => __( 'photogallery','photogallery' ),
				'singular_name' => __( 'photogallery','photogallery' ), 
				'menu_name' => __( 'Photo Gallery','photogallery' ), 
				'all_items' => __( 'All Photos','photogallery' ), 
				'add_new' => __( 'Add New Photos','photogallery' ),
				'add_new_item' => __( 'Add photogallery','photogallery' ),
				'edit_item' => __( 'Edit photogallery','photogallery' ),				
				'view_item' => __( 'View photogallery','photogallery' ), 
				'search_items' => __( 'Search in photogallery','photogallery' ), 
				'not_found' => __( 'Nothing Found in photogallery','photogallery' ),
				'not_found_in_trash' => __( 'Nothing Found in Trash.','photogallery' ), 	
				'new_item' => __( 'New photogallery','photogallery' ), 
				'parent_item_colon' => __( 'photogallery','photogallery' )
			),
		
			'description' => "all our photogallery",
			'public' => true,
			'exclude_from_search' => false, 
			'publicly_queryable' => true, 
			'show_ui' => true, 
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => false, 
			'menu_position' => 21, 
			'show_in_menu' => true,
			'supports' => array( 'title', 'editor', 'thumbnail' ), 
			'exclude_from_search' => true,
			'menu_icon' => TP_CUSTOM_PHOTO_GALLERY_PLUGIN_PATH.'/css/gallery.png',			
		)
	);

}

add_action( 'init', 'tp_custom_photo_gallery_post_register' );

// custom post gallery options initialise
function tp_custom_phto_gallery_option_init(){

	register_setting( 'tp_custom_gallery_options_setting', 'tp_light_gallery_custom_photo_width');
	register_setting( 'tp_custom_gallery_options_setting', 'tp_light_gallery_custom_photo_height');
	register_setting( 'tp_custom_gallery_options_setting', 'tp_light_gallery_custom_photo_bg_color');
	register_setting( 'tp_custom_gallery_options_setting', 'tp_light_gallery_custom_photo_top_width');
	register_setting( 'tp_custom_gallery_options_setting', 'tp_light_gallery_custom_photo_top_height');
	
    }
add_action('admin_init', 'tp_custom_phto_gallery_option_init' );



// custom photo gallery shortcode settings
function tp_custom_photo_gallery_shortcode_setting($atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => "",
				), $atts);


			$postid = $atts['id'];
			
			$tp_light="";
		
		$tp_light_gallery_custom_photo_width = get_option( 'tp_light_gallery_custom_photo_width' );
		$tp_light_gallery_custom_photo_height = get_option( 'tp_light_gallery_custom_photo_height' );
		$tp_light_gallery_custom_photo_bg_color = get_option( 'tp_light_gallery_custom_photo_bg_color' );
		$tp_light_gallery_custom_photo_top_width = get_option( 'tp_light_gallery_custom_photo_top_width' );		
		$tp_light_gallery_custom_photo_top_height = get_option( 'tp_light_gallery_custom_photo_top_height' );


		$tp_light.='<div class="ligh_gallery_item" style="width:'.$tp_light_gallery_custom_photo_width.'px;height:'.										$tp_light_gallery_custom_photo_height.'px;background-color:'.$tp_light_gallery_custom_photo_bg_color.'">';
	
	
		$args_lightgallery = array(
		'post_type' => 'tp_photo_gallery',
		'posts_per_page' => 50
		);	
		$lightgallery_query = new WP_Query( $args_lightgallery );


		$tp_light.='<ul id="lightGallery">';
		if($lightgallery_query->have_posts()): while($lightgallery_query->have_posts()): $lightgallery_query->the_post();


		$thumb_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

		$tp_light.='<li data-src="'.esc_attr($thumb_url).'">';
		$tp_light.='<img style="width:'.esc_attr($tp_light_gallery_custom_photo_top_width).'px;height:'.esc_attr($tp_light_gallery_custom_photo_top_height).'px;" src="'.esc_attr($thumb_url).'" />';
		$tp_light.='</li>';
		
		
		endwhile;  wp_reset_postdata(); endif;
		$tp_light.='</ul>';
		$tp_light.='</div>';
		

		return $tp_light;

}
add_shortcode('custom-photo-gallery', 'tp_custom_photo_gallery_shortcode_setting');





// register custom photo gallery option page
function tp_custom_photo_gallery_option_settings(){
	include('custom-photo-gallery-wordpress-admin.php');
}

// custom photo gallery menu register
function tp_custom_photo_gallery_menu_init() {

	add_submenu_page('edit.php?post_type=tp_photo_gallery', __('Gallery options','tp_gallery_op'), __('Gallery Settings','tp_gallery_op'), 'manage_options', 'tp_custom_photo_gallery_option_settings', 'tp_custom_photo_gallery_option_settings');
}
add_action('admin_menu', 'tp_custom_photo_gallery_menu_init');	

?>