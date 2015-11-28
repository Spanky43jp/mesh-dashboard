<?php
/************************************************************************
* Functions File
*************************************************************************/
if(!function_exists('nzs_menu_body_class')){
	function nzs_menu_body_class($classes){
		global $smof_data;
		if(is_home() && isset( $smof_data['nzs_nav_position'] ) && $smof_data['nzs_nav_position'] == 'bottom'){
			$classes[] = 'has-bottom-menu';
		}

		return $classes;
	}
	add_filter('body_class', 'nzs_menu_body_class');
}

if(!function_exists('nzs_add_menu_id')){
	
	function nzs_add_menu_id($args){
		
		if(isset($args['theme_location']) && $args['theme_location'] == 'primary'){
			$args['menu_id'] = 'main-menu';
		}

		return $args;
	}

	add_filter( 'wp_nav_menu_args' , 'nzs_add_menu_id', 10 , 1 );
}

if ( !function_exists( 'sort_sections' ) ){

	function sort_sections(){


		if(!has_nav_menu( 'primary' )){
			return;
		}


		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations['primary'] ) ) {
		

			$menu = wp_get_nav_menu_object( $locations['primary'] );

			if(!isset($menu->term_id)) return;

			$items  = wp_get_nav_menu_items($menu->term_id);

			$sections = array();

			foreach((array) $items as $key => $menu_items){


				if('page-sections' == $menu_items->object){

					$sections[] = $menu_items->object_id;

				}


			}


			return $sections;

		}

	}

}

if(!function_exists('nzs_add_ul_list_class')){
	function nzs_add_ul_list_class($content){

		$content = str_ireplace('<ul>', '<ul class="disc">', $content);

		return $content;
	}
	add_filter( 'the_content' , 'nzs_add_ul_list_class', 10 );
}

if(!function_exists('get_custom_sidebar')){
	function get_custom_sidebar(){
		global $post,$smof_data;

		if(!isset($post->ID)){
			return;
		}

		$get_custom_sidebar = get_post_meta( $post->ID, 'nzs_unlimited_sidebar', true);

		if(isset($post->post_type) && $get_custom_sidebar == 'sidebar-1' && ($post->post_type == 'one_page_portfolio' || $post->post_type == 'recent_works')){
			return false;
		}

		if(isset($get_custom_sidebar) && !empty($get_custom_sidebar)){

			return $get_custom_sidebar;
			
		}else{

			if(isset($post->post_type) && ($post->post_type == 'one_page_portfolio' || $post->post_type == 'recent_works')){
				return false;
			}

			return 'sidebar-1';
		}

	}
}

if(! function_exists('nzs_get_caption')){

	/**
	 * $thumbID interger
	 * returns image caption
	 */

	function nzs_get_caption($thumbID){

		$imageData = get_post($thumbID);

		if(isset($imageData->post_excerpt) && !empty($imageData->post_excerpt)){
			
			return $imageData->post_excerpt;

		}else{

			return false;

		}
	}
}

if ( ! function_exists( 'custom_single_file_type' ) ){

	function custom_single_file_type($template) { 
		global $post,$smof_data; 


		if(isset($post->post_type) && $post->post_type == 'one_page_portfolio'){

	    	$page_template = get_post_meta( $post->ID, 'nzs_page_layout', true);

			$page_template_option = (isset($page_template) && !empty($page_template)) ? $page_template : $smof_data['nzs_portfolio_page_layout'];

			if(isset($page_template_option)){

				switch ($page_template_option) {
					case '2cr':
						$layout = 'single-portfolio.php';
					break;

					case '1c':
						$layout = 'single-portfolio-full.php';
					break;

					case '2cl':
						$layout = 'single-portfolio-left.php';
					break;
					
					default:
						$layout = 'single-portfolio.php';
					break;
				}


			}else{

				$layout = 'single-portfolio.php';

			}

	    return locate_template($layout); 

		}elseif(isset($post->post_type) && $post->post_type == 'recent_works'){

			$page_template = get_post_meta( $post->ID, 'nzs_page_layout', true);

			$page_template_option = (isset($page_template) && !empty($page_template)) ? $page_template : $smof_data['nzs_works_page_layout'];

			if(isset($page_template_option)){

				switch ($page_template_option) {
					case '2cr':
						$layout = 'single-recent-works.php';
					break;

					case '1c':
						$layout = 'single-recent-works-full.php';
					break;

					case '2cl':
						$layout = 'single-recent-works-left.php';
					break;
					
					default:
						$layout = 'single-recent-works.php';
					break;
				}


			}else{
				$layout = 'single-recent-works.php';
			}

	    return locate_template($layout);

		}elseif(isset($post->post_type) && $post->post_type == 'post' && is_single()){


			$page_template = get_post_meta( $post->ID, 'nzs_page_layout', true);

			$page_template_option = (isset($page_template) && !empty($page_template)) ? $page_template : $smof_data['nzs_single_page_layout'];

			if(isset($page_template_option)){

				switch ($page_template_option) {
					case '2cr':
						$layout = 'single.php';
					break;

					case '1c':
						$layout = 'single-full.php';
					break;

					case '2cl':
						$layout = 'single-left.php';
					break;
					
					default:
						$layout = 'single.php';
					break;
				}


			}else{
				$layout = 'single.php';
			}

	    return locate_template($layout); 

		}

	  return $template; 

	}
}

add_filter('template_include', 'custom_single_file_type'); 


if ( ! function_exists( 'custom_excerpt_lengths' ) ){

	function custom_excerpt_lengths($content){
		global $post,$smof_data;


		$has_link = false;


		if('one_page_portfolio' == $post->post_type){

			if(stripos($content, 'link')){
				

				if(1 === preg_match('/\[link title="([^"]+)"\]([^\[]+)\[\/link\]/', $content, $match)){

					$has_link = true;


					$content = str_replace($match[0], "-".$match[1], $content);

				}

			}

			if(isset($smof_data['nzs_portfolio_excerpt_length']) && $smof_data['nzs_portfolio_excerpt_length'] == 0){

				$content = " ";
				return $content;
			}

			$portfolio_excerpt = (!empty($smof_data['nzs_portfolio_excerpt_length'])) ? $smof_data['nzs_portfolio_excerpt_length'] : 55;

			if($portfolio_excerpt == '0'){
				$content = " ";
				return $content;
			}


			if(strlen($content) > $portfolio_excerpt){

	    		$content = strip_tags($content);

	    		$content = substr($content, 0, $portfolio_excerpt)."...";

	    		$content = '<p>'.$content.'</p>';

	    	}

		}elseif('recent_works' == $post->post_type){


			
			if(stripos($content, 'link')){
				

				if(1 === preg_match('/\[link title="([^"]+)"\]([^\[]+)\[\/link\]/', $content, $match)){

					$has_link = true;


					$content = str_replace($match[0], "-".$match[1], $content);

				}

			}

			if(isset($smof_data['nzs_works_excerpt_length']) && $smof_data['nzs_works_excerpt_length'] == 0){
				$content = " ";
				return $content;
			}

			$works_excerpt = (!empty($smof_data['nzs_works_excerpt_length'])) ? $smof_data['nzs_works_excerpt_length'] : 98;

			if(strlen($content) > $works_excerpt){

	    		$content = strip_tags($content);

	    		$content = substr($content, 0, $works_excerpt)."...";

	    		$content = '<p>'.$content.'</p>';

	    	}

		}


		if($has_link){

			$content = str_replace( "-".$match[1],$match[0], $content);

			$content = do_shortcode( $content );
		}

		return $content;
	}

}

add_filter( 'the_excerpt','custom_excerpt_lengths');


if ( ! function_exists( 'nzs_wp_title' ) ){

	function nzs_wp_title( $title, $sep ){
		global $paged, $page,$s;

		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		if ( $site_description && is_search() )
			$title = sprintf(__('Search Results For: %s','framework'),$s)." ".$sep." ".get_bloginfo( 'name' );

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'framework' ), max( $paged, $page ) );

		return esc_html( $title );

	}
}

add_filter('wp_title','nzs_wp_title',10,2);
 



// INCLUDE CUSTOM SYTLES
include( get_template_directory() . '/assets/php/custom-styles.php' );
include( get_template_directory() . '/assets/php/custom-js.php' );
include( get_template_directory() . '/assets/php/custom-widgets.php' );


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 610; /* pixels */

if ( ! function_exists( 'ninezeroseven_wp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function ninezeroseven_wp_setup() {

	global $smof_data;

	set_post_thumbnail_size( 610, 230);

	add_image_size('editor-thumbs', 150, 150, true);

	add_image_size('one_page_portfolio-thumbnail', 410, 230, true);

	add_image_size('one_page_iso_portfolio-thumbnail', 410, 9999);

	add_image_size('recent_works-thumbnail', 410, 160, true);

	add_image_size('recent_iso_works-thumbnail', 410, 9999);

	add_image_size('team-thumbnail', 250, 250, true);

	if(isset($smof_data['nzs_grid_width']) && 1 == $smof_data['nzs_grid_width']){
		add_image_size('post-custom-thumbnail', 775, 295, true);
	}else{
		add_image_size('post-custom-thumbnail', 610, 230, true);
	}

	locate_template( '/assets/php/post-types.php' , true );
	
	/**
	 * Translation
	 */
	load_theme_textdomain( 'framework', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'framework' ),
	) );

}
endif; // ninezeroseven_wp_setup

add_action( 'after_setup_theme', 'ninezeroseven_wp_setup' );



/**
 * Register widgetized area and update sidebar with default widgets
 */
if(!function_exists('ninezeroseven_wp_widgets_init')){
	function ninezeroseven_wp_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Sidebar', 'framework' ),
			'id' => 'sidebar-1',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="heading"><h5>',
			'after_title' => '</h5></div>',
		) );
	}
	add_action( 'widgets_init', 'ninezeroseven_wp_widgets_init' );
}



/**
 * Enqueue scripts and styles
 */
if(!function_exists('ninezeroseven_wp_scripts')){
	function ninezeroseven_wp_scripts() {

		global $smof_data;


		wp_enqueue_script('jquery');

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}


		// LOAD GOOGLE Font
		// 
		 $font_sets = "";

			if(!empty($smof_data['nzs_body_font_options'])){

			$font_sets = array();

			foreach ($smof_data['nzs_body_font_options'] as $key => $value) {
				$font_sets[] = $key;
			}

			$font_sets = "&subset=".join(',',$font_sets);

			}

		wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600|Oswald:400,300,700'.$font_sets);




		wp_enqueue_style( 'base', get_template_directory_uri().'/assets/css/base.css');

		if(isset($smof_data['nzs_grid_width']) && 1 == $smof_data['nzs_grid_width']){
			wp_enqueue_style( 'skeleton', get_template_directory_uri().'/assets/css/skeleton-1200.css');
		}else{
			wp_enqueue_style( 'skeleton', get_template_directory_uri().'/assets/css/skeleton.css');
		}


		if(isset($smof_data['nzs_style_change']) && $smof_data['nzs_style_change'] == 1){
			wp_enqueue_style( 'layout-updated', get_template_directory_uri().'/assets/css/layout-updated.css',array('base','skeleton'));
		}else{
			wp_enqueue_style( 'layout', get_template_directory_uri().'/assets/css/layout.css',array('base','skeleton'));
		}
		
		wp_register_style( 'font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css');
		wp_enqueue_style( 'font-awesome' );

		wp_enqueue_style( 'prettyphoto', get_template_directory_uri().'/assets/css/prettyPhoto.css');
		wp_enqueue_style( 'flexslider', get_template_directory_uri().'/assets/css/flexslider.css');

		//SUPERSIZED HEADER
		
		if(is_home() && "fullscreen" == $smof_data['nzs_header_options']){
			wp_enqueue_style( 'supersized', get_template_directory_uri().'/assets/css/supersized.css');
			wp_enqueue_style( 'shutter', get_template_directory_uri().'/assets/css/supersized.shutter.css');
			wp_enqueue_style( 'fullslider-option', get_template_directory_uri().'/assets/css/fullslider.css');
			wp_enqueue_script( 'supersized', get_template_directory_uri() . '/assets/js/supersized.3.2.7.js', array( 'jquery' ), '1.0',true );
			wp_enqueue_script( 'supersized-shutter', get_template_directory_uri() . '/assets/js/supersized.shutter.min.js', array( 'jquery' ), '1.0',true );
		}

		if(is_home() && "parallax" == $smof_data['nzs_header_options']){
			wp_enqueue_style( 'fullslider-option', get_template_directory_uri().'/assets/css/parallax.css');
		}

		if(is_home() && "flexslider" == $smof_data['nzs_header_options']){
			wp_enqueue_style( 'fullslider-option', get_template_directory_uri().'/assets/css/flexslider-option.css');
		}

		if(is_home() && "video-header" == $smof_data['nzs_header_options']){

			wp_enqueue_style( 'video-header-option', get_template_directory_uri().'/assets/css/video-header-option.css');

			if(0 == $smof_data['nzs_full_video_type']){

				wp_enqueue_script( 'tubular-script', get_template_directory_uri() . '/assets/js/jquery.tubular.1.0.js', array( 'jquery' ), '1.0',true );
			}else{

				wp_enqueue_script( 'froogaloop2-script', get_template_directory_uri() . '/assets/js/froogaloop.min.js', array( 'jquery' ), '1.0',true );
				wp_enqueue_script( 'tubular-script', get_template_directory_uri() . '/assets/js/jquery.tubular.vimeo.js', array( 'jquery' ), '1.0',true );

			}

		}

		if(isset($smof_data['nzs_responsive_layout']) && 0 == $smof_data['nzs_responsive_layout']){

			if(isset($smof_data['nzs_grid_width']) && 1 == $smof_data['nzs_grid_width']){
				wp_enqueue_style( 'media-frame', get_template_directory_uri().'/assets/css/nzs-frame-media-1200.css',array('base','skeleton'));
			}else{
				wp_enqueue_style( 'media-frame', get_template_directory_uri().'/assets/css/nzs-frame-media.css',array('base','skeleton'));
			}

			wp_enqueue_style( 'custom-media-frame', get_template_directory_uri().'/assets/css/nzs-custom-media.css',array('media-frame'));
		}
		
		wp_enqueue_style( 'style', get_stylesheet_uri());

		wp_enqueue_style( 'custom-mobile-queries', get_template_directory_uri().'/mobile-media-queries.css');

		wp_register_script( 'form-custom', get_template_directory_uri() . '/assets/js/jquery.form.js', array( 'jquery' ), '1.0',true );
		wp_register_script( 'form-validate', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array( 'jquery' ), '1.0',true );
		wp_register_script( 'nzs-contact-form', get_template_directory_uri() . '/assets/js/contact-form.js', array( 'jquery' ), '1.0',true );

		wp_enqueue_script( 'flexslider-script', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array( 'jquery' ), '1.0',true );
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '1.0',true );
		wp_enqueue_script( 'prettyphoto', get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.js', array( 'jquery' ), '1.0',true );
		wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0',true );

	}

	add_action( 'wp_enqueue_scripts', 'ninezeroseven_wp_scripts');
}

/************************************************************************
* AJAX
*************************************************************************/
if(!function_exists('ajax_contact')){
	function ajax_contact(){

		if ( empty($_POST) || !wp_verify_nonce($_POST['nzs_contact_nonce'],'contact_form') )
			{
			   print 'Sorry, your nonce did not verify.';
			   exit;
			}

			
			$email = get_option('admin_email');

			$errors = 0;

			$from = trim($_POST['email']);

			if(!$email){
				$errors = 1;
			}
			if(empty($from)){
				$errors = 1;
			}

			if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $from)) {
			    $errors = 1;
			} 

			if(isset($_POST)){

				$subject = "Contact Form Submission";

				$name   = trim($_POST['name']);

				$message = trim(stripslashes($_POST['message']));

				if($errors == 0){

					$mail = wp_mail($email,$subject,$message,"From: ".$name." <".$from.">");

					if($mail){

						echo "<h4>".__('Message sent.','framework')."</h4> ".__('We will reply as soon as possible.','framework');

					}else{

						echo __("There was a problem, please try again.","framework");
					}
					
				}else{
					
					echo __("Setup not completed.","framework");
				}
			}

		die();
	}
	add_action('wp_ajax_nopriv_contact_form', 'ajax_contact');
	add_action('wp_ajax_contact_form', 'ajax_contact');
}

if ( ! function_exists( 'nzs_show_header' ) ){

	function nzs_show_header(){
		global $smof_data;
			
		if(!is_home()){
			return;
		}

		switch(strtolower($smof_data['nzs_header_options'])){
			case 'fullscreen':
				$header_option_file = 'header-full-slider.php' ;

			break;

			case 'parallax':
				$header_option_file = 'header-parallax.php' ;
			break;

			case 'flexslider':
				$header_option_file = 'header-flexslider.php' ;
			break;

			case 'customheader':
				$header_option_file = 'custom-header.php' ;
			break;

			case 'video-header':
				
				if(0 == $smof_data['nzs_full_video_type']){

					$header_option_file = 'header-full-video.php' ;
				}else{

					$header_option_file = 'header-full-video-vimeo.php' ;
				}


			break;

			default:
				$header_option_file = 'header-full-slider.php' ;
			break;
		}

		if(isset($header_option_file) && file_exists(get_template_directory().'/assets/php/'.$header_option_file)){

			ob_start();	
			locate_template('/assets/php/'.$header_option_file, true);
			$content = ob_get_clean();
	    	return $content;

		}


	}
}

if(!function_exists('nzs_custom_admin_scripts')){
	function nzs_custom_admin_scripts() {
		wp_register_script('color-picker', get_template_directory_uri().'/admin/assets/js/colorpicker.js', array('jquery'));
		wp_register_script('upload-meta-box', get_template_directory_uri().'/admin/assets/js/upload-meta-box.js', array('jquery'));
		wp_enqueue_script('color-picker');
		wp_enqueue_script('upload-meta-box');
	}
	add_action('admin_print_scripts', 'nzs_custom_admin_scripts');
}

if(!function_exists('nzs_custom_admin_styles')){
	function nzs_custom_admin_styles() {
		wp_enqueue_style( 'colorsd', get_template_directory_uri().'/admin/assets/css/colorpicker.css');
	}
	add_action('admin_print_styles', 'nzs_custom_admin_styles');
}

/*------------------------------------------*/
/* Options Framework
/*------------------------------------------*/

require_once (get_template_directory() . '/admin/index.php');

if( is_admin() ){
	include( get_template_directory() . '/assets/php/meta-boxes.php');
	include( get_template_directory() . '/admin/zilla-shortcodes/zilla-shortcodes.php' );
}
include( get_template_directory() . '/assets/php/updated-functions.php');
locate_template( '/assets/php/shortcodes.php', true );
add_filter('widget_text', 'do_shortcode');

if ( ! function_exists( 'nzs_social_links' ) ){

	function nzs_social_links(){

		global $smof_data;

		$twitter    = $smof_data['nzs_social_twitter'];
		$facebook   = $smof_data['nzs_social_facebook'];
		$google     = $smof_data['nzs_social_google'];
		$flickr     = $smof_data['nzs_social_flickr'];
		$linkedin   = $smof_data['nzs_social_linkedin'];
		$pinterest  = $smof_data['nzs_social_pinterest'];
		$dribbble   = $smof_data['nzs_social_dribbble'];
		$deviantart = $smof_data['nzs_social_deviantart'];
		
		$youtube    = $smof_data['nzs_social_youtube'];
		$vimeo      = $smof_data['nzs_social_vimeo'];
		$instagram  = $smof_data['nzs_social_instagram'];
		$email      = $smof_data['nzs_social_email'];
		$soundcloud = $smof_data['nzs_social_soundcloud'];
		$behance    = $smof_data['nzs_social_behance'];
		$ustream    = $smof_data['nzs_social_ustream'];
		$rss        = $smof_data['nzs_social_rss'];


		$target_window = $smof_data['nzs_social_target'];


		$str = '';

		if(!empty($twitter)){
			$str .= '<a class="hide-text twitter" target="'.esc_attr($target_window).'" href="'.esc_html($twitter).'">'. __('Twitter','framework') .'</a>';
		}

		if(!empty($facebook)){
			$str .= '<a class="hide-text facebook" target="'.esc_attr($target_window).'" href="'.esc_html($facebook).'">'. __('Facebook','framework') .'</a>';
		}
		if(!empty($google)){
			$str .= '<a class="hide-text google" target="'.esc_attr($target_window).'" href="'.esc_html($google).'">'. __('Google','framework') .'</a>';
		}
		if(!empty($flickr)){
			$str .= '<a class="hide-text flickr" target="'.esc_attr($target_window).'" href="'.esc_html($flickr).'">'. __('Flickr','framework') .'</a>';
		}
		if(!empty($linkedin)){
			$str .= '<a class="hide-text linkedin" target="'.esc_attr($target_window).'" href="'.esc_html($linkedin).'">'. __('LinkedIn','framework') .'</a>';
		}
		if(!empty($pinterest)){
			$str .= '<a class="hide-text pinterest" target="'.esc_attr($target_window).'" href="'.esc_html($pinterest).'">'. __('Pinterest','framework') .'</a>';
		}
		if(!empty($dribbble)){
			$str .= '<a class="hide-text dribbble" target="'.esc_attr($target_window).'" href="'.esc_html($dribbble).'">'. __('Dribbble','framework') .'</a>';
		}
		if(!empty($deviantart)){
			$str .= '<a class="hide-text deviantart" target="'.esc_attr($target_window).'" href="'.esc_html($deviantart).'">'. __('DeviantArt','framework') .'</a>';
		}

		if(!empty($youtube)){
			$str .= '<a class="hide-text youtube" target="'.esc_attr($target_window).'" href="'.esc_html($youtube).'">'. __('Youtube','framework') .'</a>';
		}

		if(!empty($vimeo)){
			$str .= '<a class="hide-text vimeo" target="'.esc_attr($target_window).'" href="'.esc_html($vimeo).'">'. __('Vimeo','framework') .'</a>';
		}

		if(!empty($instagram)){
			$str .= '<a class="hide-text instagram" target="'.esc_attr($target_window).'" href="'.esc_html($instagram).'">'. __('Instagram','framework') .'</a>';
		}

		if(!empty($email)){
			$str .= '<a class="hide-text email" target="'.esc_attr($target_window).'" href="mailto:'.esc_html($email).'">'. __('Email','framework') .'</a>';
		}

		if(!empty($soundcloud)){
			$str .= '<a class="hide-text soundcloud" target="'.esc_attr($target_window).'" href="'.esc_html($soundcloud).'">'. __('Soundcloud','framework') .'</a>';
		}

		if(!empty($behance)){
			$str .= '<a class="hide-text behance" target="'.esc_attr($target_window).'" href="'.esc_html($behance).'">'. __('Behance','framework') .'</a>';
		}

		if(!empty($ustream)){
			$str .= '<a class="hide-text ustream" target="'.esc_attr($target_window).'" href="'.esc_html($ustream).'">'. __('Ustream','framework') .'</a>';
		}

		if(!empty($rss)){
			$str .= '<a class="hide-text rss" target="'.esc_attr($target_window).'" href="'.esc_html($rss).'">'. __('rss','framework') .'</a>';
		}

		return apply_filters('nzs_social_links', $str);
	}
}

/************************************************************************
* Load Google Fonts
*************************************************************************/
include(get_template_directory()."/admin/functions/custom-googlefonts.php");



/************************************************************************
* CUSTOM COMMENT FORM
*************************************************************************/
if(!function_exists('nzs_custom_comment_form')){
	function nzs_custom_comment_form( $args = array(), $post_id = null ) {
		global $id;

		if ( null === $post_id )
			$post_id = $id;
		else
			$id = $post_id;

		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields =  array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name','framework' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email','framework' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website','framework' ) . '</label>' .
			            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);

		$required_text = sprintf( ' ' . __('Required fields are marked %s','framework'), '<span class="required">*</span>' );
		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment','noun', 'framework' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.','framework' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','framework' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.','framework' ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s','framework' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave a Reply','framework' ),
			'title_reply_to'       => __( 'Leave a Reply to %s','framework' ),
			'cancel_reply_link'    => __( 'Cancel reply','framework' ),
			'label_submit'         => __( 'Post Comment','framework' ),
		);

		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

		?>
			<?php if ( comments_open( $post_id ) ) : ?>
				<?php do_action( 'comment_form_before' ); ?>
				<div id="respond">
					<div class="heading">
						<h5><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?></h5>
					</div>
					<small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small>
					<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
						<?php echo $args['must_log_in']; ?>
						<?php do_action( 'comment_form_must_log_in_after' ); ?>
					<?php else : ?>
						<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
							<?php do_action( 'comment_form_top' ); ?>
							<?php if ( is_user_logged_in() ) : ?>
								<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
								<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
							<?php else : ?>
								<?php echo $args['comment_notes_before']; ?>
								<?php
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								do_action( 'comment_form_after_fields' );
								?>
							<?php endif; ?>
							<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
							<?php echo $args['comment_notes_after']; ?>
							<p class="form-submit">
								<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
								<?php comment_id_fields( $post_id ); ?>
							</p>
							<?php do_action( 'comment_form', $post_id ); ?>
						</form>
					<?php endif; ?>
				</div><!-- #respond -->
				<?php do_action( 'comment_form_after' ); ?>
			<?php else : ?>
				<?php do_action( 'comment_form_comments_closed' ); ?>
			<?php endif; ?>
		<?php
	}
}

if(!function_exists('nzs_get_avatar_url')){
	function nzs_get_avatar_url($get_avatar){
	    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	    return $matches[1];
	}
}
if(!function_exists('custom_comments')){
	function custom_comments($comment,$args,$depth){

		$GLOBALS['comment'] = $comment;

		if(get_comment_type() == 'comment'){ ?>
			<!-- COMMENT -->
			<li id="comment-<?php comment_ID();?>">

				<article <?php comment_class('clearfix');?>>
				<div class="box box-left">
					
						<img src="<?php echo nzs_get_avatar_url(get_avatar($comment,'80'));?>" class="img-frame" width="80" height="80" alt="" />
					
				</div>
				<div class="comment-meta">
					<?php comment_author_link();?> on <?php comment_date();?>
				</div>


				<div class="comment-content">

					<?php if($comment->comment_approved == '0') :?>

					<p><?php _e('Your Comment Awaiting Moderation','framework');?></p>

				<?php else: ?>
									
					<?php comment_text();?>

				<?php endif;?>
				</div>
				<div class="alignright"><?php comment_reply_link(array_merge($args, array('depth'=>$depth,'max_depth'=>$args['max_depth'])));?></div>

			<!-- END COMMENT -->
			</article>


		<?php
		}

	}	
}

if(!function_exists('custom_comment_form')){
	function custom_comment_form($defaults){
		$defaults['comment_notes_before'] = '';
		$defaults['comment_notes_after'] = '';
		$defaults['id_form'] = 'reply';
		$defaults['comment_field'] = '<label for="message">'. __('Comment*','framework').'</label><textarea id="comment" name="comment" cols="90" rows="5"></textarea>';

		return $defaults;
	}

	add_filter('comment_form_defaults','custom_comment_form');
}

if(!function_exists('custom_form_fields')){
	function custom_form_fields(){
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$arial_req = ($req ? "aria-required='true'" : ' ');

		$fields = array(
			'author' => '<label class="first" for="author">'. __('Name*','framework').'</label>
						<input type="text" id="author" name="author" value="'.esc_attr( $commenter['comment_author'] ).'" '.$arial_req.' />',
			'email' => '<label class="first" for="email">'. __('Email*','framework').'</label>
						<input type="text" id="email" name="email" value="'.esc_attr( $commenter['comment_author_email'] ).'" '.$arial_req.' />',
			'url' => '<label class="first" for="url">'. __('Website','framework').'</label>
						<input type="text" id="url" name="url" value="'.esc_attr( $commenter['comment_author_url'] ).'" '.$arial_req.' />'						


			);
		return $fields;
	}

	add_filter('comment_form_default_fields','custom_form_fields');
}

/************************************************************************
* Navigation Related Functions
*************************************************************************/

if(!function_exists('page_section_redirect')){
	function page_section_redirect(){
		global $wp;

		if(is_404()){

			if(isset($wp->query_vars["page-sections"])){

				wp_redirect(home_url('/#').$wp->query_vars["name"]);

			}
			
		}
	}
	add_filter('template_redirect', 'page_section_redirect');
}


if(!function_exists('single_page_nav_links')){
	function single_page_nav_links( $items ) {

		foreach ( $items as $item ) {

			if('page-sections' == $item->object){

				$current_post = get_post($item->object_id);

				$menu_title = "#".$current_post->post_name;

					if(!is_home()){
						
						$item->url = home_url( '/' ).$menu_title;

					}else{

						$item->url = $menu_title;

					}

			}elseif('custom' == $item->type && !is_home()){

				if( 1 === preg_match('/^#([^\/]+)$/', $item->url , $matches)){
				 	
				 	$item->url = home_url( '/' ).$item->url;

				}

			}
		
		 
		}

		return $items;   
	}
	add_filter( 'wp_nav_menu_objects', 'single_page_nav_links' );
}

/************************************************************************
* Exlude Menu Items with class of exclude-from-menu
*************************************************************************/


if(!function_exists('nzs_exlude_menu_items')){
	function nzs_exlude_menu_items( $items ) {
		$temp_menu = array();

		foreach ( $items as $item ) {

			if($item->classes[0] !== 'exclude-from-menu'){

				$temp_menu[] = $item;

			}

		 }

		$items = $temp_menu;

		return $items;   
	}
	add_filter( 'wp_nav_menu_objects' , 'nzs_exlude_menu_items', 10 );
	add_filter( 'nzs_filter_drop_down' , 'nzs_exlude_menu_items' );
}

if(!function_exists('ninezeroseven_wp_drop_menu')){
	function ninezeroseven_wp_drop_menu(){


		if(!has_nav_menu( 'primary' )){
			return;
		}


		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations['primary'] ) ) {

			$menu = wp_get_nav_menu_object( $locations['primary'] );

			if(!isset($menu->term_id)) return;

			$items  = apply_filters( 'nzs_filter_drop_down' , wp_get_nav_menu_items($menu->term_id) );

			$menu_option ='<select size="1" id="subMenu" name="subMenu">'. "\n";


			$menu_option .="\t\t\t".'<option selected="selected" value="">'.__( 'Menu', 'ninezeroseven_wp' ).'</option>'. "\n";

			foreach((array) $items as $key => $menu_items){

				if('page-sections' == $menu_items->object){

					$current_post = get_post($menu_items->object_id);

					$menu_title = "#".$current_post->post_name;

					if(!is_home()){

						$drop_nav_url = home_url( '/' ).$menu_title;

					}else{

						$drop_nav_url= $menu_title;
					
					}

				}elseif('custom' == $menu_items->type && !is_home()){
					
					if( 1 === preg_match('/^#([^\/]+)$/', $menu_items->url , $matches) ){
						
						$drop_nav_url = home_url( '/' ).$menu_items->url;

					}else{

						$drop_nav_url = $menu_items->url;
					}
					


				}else{

					$drop_nav_url = $menu_items->url;

				}


				if( 0 != $menu_items->menu_item_parent){

					$title = '--'.$menu_items->title;
				}else{
					$title = '-'.$menu_items->title;
				}


				$menu_option .="\t\t\t".'<option value="'.$drop_nav_url.'">'.$title.'</option>'. "\n";
			}

			$menu_option .="\t\t".'</select>'. "\n";

			return $menu_option;

		}

	}
}

if ( !function_exists( 'nzs_menu_class' ) ){

	function nzs_menu_class(){

		global $smof_data;


		$menu_pos = '';

		if(!isset($smof_data['nzs_mobile_menu_type']) || $smof_data['nzs_mobile_menu_type'] == 0){

			$menu_pos .='nzs-drop-menu ';
		}else{
			$menu_pos .='nzs-mobile-menu ';
		}
			
		
		if(is_home()){

			if(isset($smof_data['nzs_nav_position'])){
				$menu_pos .= ($smof_data['nzs_nav_position'] == 'bottom') ? 'full-header' : 'normal-menu';
			}else{
				$menu_pos .= 'normal-menu';
			}


			}else{

			$menu_pos .='normal-menu';
			
		}

		return $menu_pos;
		
	}
}
if ( !function_exists( 'add_class_link_next' ) ){
	function add_class_link_next(){
		return 'class="alignleft"';
	}

	add_filter('next_posts_link_attributes','add_class_link_next');
}

if ( !function_exists( 'add_class_link_previous' ) ){
	function add_class_link_previous(){
		return 'class="alignright"';
	}

	add_filter('previous_posts_link_attributes','add_class_link_previous');
}

/************************************************************************
* Misc Functions
*************************************************************************/

if ( !function_exists( 'include_footer_sections' ) ){
	function include_footer_sections(){
		global $post,$smof_data;


		$tmp_post = $post;

		if(!is_home() && !is_admin()): 


			$custom_parallax = get_post_meta(get_the_ID(), 'nzs_parallax_custom_attach', TRUE);
			$custom_page_section = get_post_meta(get_the_ID(), 'nzs_page_section_custom_attach', TRUE);


			if((is_single() || is_page()) && 'default' != $custom_parallax && !empty($custom_parallax)){

				if($custom_parallax && 'none' != $custom_parallax){

					$parallax_post = get_post($custom_parallax); 

				}


			}else{

				if(isset($smof_data['nzs_default_parallax']) && 'none' != $smof_data['nzs_default_parallax']){

					$parallax_post = get_post($smof_data['nzs_default_parallax']); 

				}

			}

			if(isset($parallax_post)){
				setup_postdata( $parallax_post );
				$post = $parallax_post;

				locate_template('assets/php/parallax-section.php', true);

				wp_reset_postdata();

				$post = $tmp_post;
				
			}

			

			if((is_single() || is_page()) && 'default' != $custom_page_section && !empty($custom_page_section)){

				if($custom_page_section && 'none' != $custom_page_section){

					$page_section_post = get_post($custom_page_section); 

				}


			}else{

				if(isset($smof_data['nzs_default_page_section']) && 'none' != $smof_data['nzs_default_page_section']){


					$page_section_post = get_post($smof_data['nzs_default_page_section']); 

				}

			}

			if(isset($page_section_post)){

				setup_postdata( $page_section_post );
				$post = $page_section_post;


				locate_template('assets/php/page-section.php', true);

				wp_reset_postdata();

				$post = $tmp_post;
			}
			
		endif;
	}

	add_action('get_footer','include_footer_sections');
}


if(!function_exists('nzs_hex_rgb')){

	function nzs_hex_rgb($hex , $alpha = false) {
		$hex = str_replace("#", "", $hex);
		$color = array();

		$r = $g = $b = 0;


		 
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}

		if($alpha){

			if(!preg_match('/^[0-9]+$/', $alpha)){

				$color['a'] = 0;

			}else{

				$color['a'] = $alpha / 100;

			}

		}else{

			$color['a'] = 0;

		}
		 
		return implode(',', $color);
	}
}


/************************************************************************
* Image Sizing/Getting Function
*************************************************************************/
include(get_template_directory().'/admin/functions/aq_resizer.php');


if ( ! function_exists( 'nzs_get_post_image' ) ){

	/**
	 * Gets post image and checks for custom sizes set
	 * in Theme Options panel
	 * @param  int $id    image/post id
	 * @param  string $image [description]
	 * @return string        Returns image source or false
	 */
	function nzs_get_post_image($image_id, $array_return = false){
		global $smof_data,$post;

		switch ( $post->post_type ) {

			case 'one_page_portfolio':

				if( is_single() ){

					$page_template = get_post_meta( $post->ID, 'nzs_page_layout', true );

					if( empty( $page_template ) ){
						$page_template = $smof_data['nzs_portfolio_page_layout'];
					}

					if($page_template == '1c'){

						$image = 'portfolio_single_full';

					}else{

						$image = 'portfolio_single';

					}

					$theme_img = 'post-custom-thumbnail';

				}else{

					$image = 'portfolio';
					
					if(1 == $smof_data['nzs_iso_portfolio_option']){

						$theme_img = 'one_page_portfolio-thumbnail';

					}else{

						$theme_img = 'one_page_iso_portfolio-thumbnail';
						
					}

				}

			break;


			case 'recent_works':

				if(is_single()){

					$page_template = get_post_meta( $post->ID, 'nzs_page_layout', true);


					if(empty($page_template)){
						$page_template = $smof_data['nzs_works_page_layout'];
					}

					if($page_template == '1c'){

						$image = 'works_single_full';

					}else{

						$image = 'works_single';

					}

					$theme_img = 'post-custom-thumbnail';

				}else{

					$image = 'works';

					if(1 == $smof_data['nzs_iso_works_option']){

						$theme_img = 'recent_works-thumbnail';

					}else{

						$theme_img = 'recent_iso_works-thumbnail';

					}

				}


			break;


			case 'team_members':

				$image = 'team';

				$theme_img = 'team-thumbnail';

			break;
			
			default:

				if(is_single()){

					$page_template = get_post_meta( $post->ID, 'nzs_page_layout', true);

					if(empty($page_template)){
						$page_template = $smof_data['nzs_single_page_layout'];
					}

					if($page_template == '1c'){

						$image = 'post_single_full';

					}else{

						$image = 'post_single';

					}

					$theme_img = 'post-custom-thumbnail';

				}else{

					$page_template = $smof_data['nzs_blog_page_layout'];


					if($page_template == '1c'){

						$image = 'post_single_full';

					}else{

						$image = 'post_single';

					}

					$theme_img = 'post-custom-thumbnail';

				}
				break;
		}

		
		$image = (isset($image)) ? $image : 'post_single';


		$enable_override = (isset($smof_data['nzs_'.$image.'_thumb_enable'])) ? $smof_data['nzs_'.$image.'_thumb_enable'] : false;

		$aq_enable = (1 == $enable_override) ? true : false;

		
		if(!$aq_enable || !isset($aq_enable)){

			$thumbnail = wp_get_attachment_image_src( $image_id, $theme_img);

			if( $array_return == true){
				return $thumbnail;
			}else{
				return $thumbnail[0];
			}
			

		}else{

			$img_width = $smof_data['nzs_'.$image.'_thumb_width'];

			$img_height = $smof_data['nzs_'.$image.'_thumb_height'];

			$crop_enable = (1 == $smof_data['nzs_'.$image.'_crop_mode']) ? true : false;

			$large_image_url = wp_get_attachment_image_src( $image_id, 'full');

			if( $array_return == true){
				return aq_resize( $large_image_url[0], $img_width, $img_height , $crop_enable, false );
			}else{
				return aq_resize( $large_image_url[0], $img_width, $img_height , $crop_enable, true);
			}
			

		}

	}

}
?>