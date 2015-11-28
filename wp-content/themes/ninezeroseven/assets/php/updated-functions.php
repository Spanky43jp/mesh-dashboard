<?php 
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'updated-functions.php' == basename($_SERVER['SCRIPT_FILENAME'])){
	die ('This file can not be accessed directly!');
}

global $smof_data;

if(isset($smof_data['nzs_style_change']) && $smof_data['nzs_style_change'] == '1'){
	
	if(!function_exists('show_contact_info')){
		function show_contact_info( $atts, $content = null ) {
			$atts = extract( shortcode_atts( array(
						'name' => '',
						'phone' => '',
						'address' => '',
						'email' => '',
					), $atts ) );



			$info = '';

			$info .='<ul class="contact-info">';

			if ( !empty( $name ) ) {
				$info .='<li class="name"><i class="fa fa-user"></i>'.$name.'</li>';
			}

			if ( !empty( $phone ) ) {
				$info .='<li class="phone"><i class="fa fa-phone"></i>'.$phone.'</li>';
			}

			if ( !empty( $address ) ) {
				$info .='<li class="address"><i class="fa fa-map-marker"></i>'.$address.'</li>';
			}

			if ( !empty( $email ) ) {
				$info .='<li class="email"><i class="fa fa-envelope"></i><a href="mailto:'.esc_attr( $email ).'">'.$email.'</a></li>';
			}


			$info .='</ul>';

			return $info;



		}

		add_shortcode( 'contact_info', 'show_contact_info' );
	}

	if(!function_exists('social_code')){
		function social_code( $atts, $content = null ) {
			$atts = extract( shortcode_atts( array(
						'pos' => '#',
					), $atts ) );

			global $smof_data;

			$twitter       = $smof_data['nzs_social_twitter'];
			$facebook      = $smof_data['nzs_social_facebook'];
			$google        = $smof_data['nzs_social_google'];
			$flickr        = $smof_data['nzs_social_flickr'];
			$linkedin      = $smof_data['nzs_social_linkedin'];
			$pinterest     = $smof_data['nzs_social_pinterest'];
			$dribbble      = $smof_data['nzs_social_dribbble'];
			$deviantart    = $smof_data['nzs_social_deviantart'];
			
			$youtube       = $smof_data['nzs_social_youtube'];
			$vimeo         = $smof_data['nzs_social_vimeo'];
			$instagram     = $smof_data['nzs_social_instagram'];
			$email         = $smof_data['nzs_social_email'];
			$soundcloud    = $smof_data['nzs_social_soundcloud'];
			$behance       = $smof_data['nzs_social_behance'];
			$ustream       = $smof_data['nzs_social_ustream'];
			$rss           = $smof_data['nzs_social_rss'];
			
			$target_window = $smof_data['nzs_social_target'];


			$links = '';

			$links .= '<ul class="social-links">';


			if(!empty($twitter)){
				$links .= '<li><a class="social-icon twitter" target="'.esc_attr($target_window).'" href="'.esc_html($twitter).'"><i class="fa fa-twitter"></i></a></li>';
			}

			if(!empty($facebook)){
				$links .= '<li><a class="social-icon facebook" target="'.esc_attr($target_window).'" href="'.esc_html($facebook).'"><i class="fa fa-facebook"></i></a></li>';
			}
			if(!empty($google)){
				$links .= '<li><a class="social-icon google" target="'.esc_attr($target_window).'" href="'.esc_html($google).'"><i class="fa fa-google"></i></a></li>';
			}
			if(!empty($flickr)){
				$links .= '<li><a class="social-icon flickr" target="'.esc_attr($target_window).'" href="'.esc_html($flickr).'"><i class="fa fa-flickr"></i></a></li>';
			}
			if(!empty($linkedin)){
				$links .= '<li><a class="social-icon linkedin" target="'.esc_attr($target_window).'" href="'.esc_html($linkedin).'"><i class="fa fa-linkedin"></i></a></li>';
			}
			if(!empty($pinterest)){
				$links .= '<li><a class="social-icon pinterest" target="'.esc_attr($target_window).'" href="'.esc_html($pinterest).'"><i class="fa fa-pinterest"></i></a></li>';
			}
			if(!empty($dribbble)){
				$links .= '<li><a class="social-icon dribbble" target="'.esc_attr($target_window).'" href="'.esc_html($dribbble).'"><i class="fa fa-dribbble"></i></a></li>';
			}
			if(!empty($deviantart)){
				$links .= '<li><a class="social-icon deviantart" target="'.esc_attr($target_window).'" href="'.esc_html($deviantart).'"><i class="fa fa-deviantart"></i></a></li>';
			}

			if(!empty($youtube)){
				$links .= '<li><a class="social-icon youtube" target="'.esc_attr($target_window).'" href="'.esc_html($youtube).'"><i class="fa fa-youtube"></i></a></li>';
			}

			if(!empty($vimeo)){
				$links .= '<li><a class="social-icon vimeo" target="'.esc_attr($target_window).'" href="'.esc_html($vimeo).'"><i class="fa fa-vimeo"></i></a></li>';
			}

			if(!empty($instagram)){
				$links .= '<li><a class="social-icon instagram" target="'.esc_attr($target_window).'" href="'.esc_html($instagram).'"><i class="fa fa-instagram"></i></a></li>';
			}

			if(!empty($email)){
				$links .= '<li><a class="social-icon email" target="'.esc_attr($target_window).'" href="mailto:'.esc_html($email).'"><i class="fa fa-envelope"></i></a></li>';
			}

			if(!empty($soundcloud)){
				$links .= '<li><a class="social-icon soundcloud" target="'.esc_attr($target_window).'" href="'.esc_html($soundcloud).'"><i class="fa fa-soundcloud"></i></a></li>';
			}

			if(!empty($behance)){
				$links .= '<li><a class="social-icon behance" target="'.esc_attr($target_window).'" href="'.esc_html($behance).'"><i class="fa fa-behance"></i></a></li>';
			}

			if(!empty($ustream)){
				$links .= '<li><a class="social-icon ustream" target="'.esc_attr($target_window).'" href="'.esc_html($ustream).'"><i class="fa fa-magnet"></i></a></li>';
			}

			if(!empty($rss)){
				$links .= '<li><a class="social-icon rss" target="'.esc_attr($target_window).'" href="'.esc_html($rss).'"><i class="fa fa-rss"></i></a></li>';
			}

			$links .= '</ul>';


			return $links;

		}

		add_shortcode( 'social_links', 'social_code' );
	}
	//Social Links
	if ( ! function_exists( 'nzs_social_links' ) ){

		function nzs_social_links(){

			global $smof_data;

			// wp_enqueue_style( 'font-awesome' );

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
				$str .= '<a class="social-icon twitter" target="'.esc_attr($target_window).'" href="'.esc_html($twitter).'"><i class="fa fa-twitter"></i></a>';
			}

			if(!empty($facebook)){
				$str .= '<a class="social-icon facebook" target="'.esc_attr($target_window).'" href="'.esc_html($facebook).'"><i class="fa fa-facebook"></i></a>';
			}
			if(!empty($google)){
				$str .= '<a class="social-icon google" target="'.esc_attr($target_window).'" href="'.esc_html($google).'"><i class="fa fa-google"></i></a>';
			}
			if(!empty($flickr)){
				$str .= '<a class="social-icon flickr" target="'.esc_attr($target_window).'" href="'.esc_html($flickr).'"><i class="fa fa-flickr"></i></a>';
			}
			if(!empty($linkedin)){
				$str .= '<a class="social-icon linkedin" target="'.esc_attr($target_window).'" href="'.esc_html($linkedin).'"><i class="fa fa-linkedin"></i></a>';
			}
			if(!empty($pinterest)){
				$str .= '<a class="social-icon pinterest" target="'.esc_attr($target_window).'" href="'.esc_html($pinterest).'"><i class="fa fa-pinterest"></i></a>';
			}
			if(!empty($dribbble)){
				$str .= '<a class="social-icon dribbble" target="'.esc_attr($target_window).'" href="'.esc_html($dribbble).'"><i class="fa fa-dribbble"></i></a>';
			}
			if(!empty($deviantart)){
				$str .= '<a class="social-icon deviantart" target="'.esc_attr($target_window).'" href="'.esc_html($deviantart).'"><i class="fa fa-deviantart"></i></a>';
			}

			if(!empty($youtube)){
				$str .= '<a class="social-icon youtube" target="'.esc_attr($target_window).'" href="'.esc_html($youtube).'"><i class="fa fa-youtube"></i></a>';
			}

			if(!empty($vimeo)){
				$str .= '<a class="social-icon vimeo" target="'.esc_attr($target_window).'" href="'.esc_html($vimeo).'"><i class="fa fa-vimeo"></i></a>';
			}

			if(!empty($instagram)){
				$str .= '<a class="social-icon instagram" target="'.esc_attr($target_window).'" href="'.esc_html($instagram).'"><i class="fa fa-instagram"></i></a>';
			}

			if(!empty($email)){
				$str .= '<a class="social-icon email" target="'.esc_attr($target_window).'" href="mailto:'.esc_html($email).'"><i class="fa fa-envelope"></i></a>';
			}

			if(!empty($soundcloud)){
				$str .= '<a class="social-icon soundcloud" target="'.esc_attr($target_window).'" href="'.esc_html($soundcloud).'"><i class="fa fa-soundcloud"></i></a>';
			}

			if(!empty($behance)){
				$str .= '<a class="social-icon behance" target="'.esc_attr($target_window).'" href="'.esc_html($behance).'"><i class="fa fa-behance"></i></a>';
			}

			if(!empty($ustream)){
				$str .= '<a class="social-icon ustream" target="'.esc_attr($target_window).'" href="'.esc_html($ustream).'"><i class="fa fa-magnet"></i></a>';
			}

			if(!empty($rss)){
				$str .= '<a class="social-icon rss" target="'.esc_attr($target_window).'" href="'.esc_html($rss).'"><i class="fa fa-rss"></i></a>';
			}

			return apply_filters('nzs_social_links', $str);
		}
	}	
}

?>