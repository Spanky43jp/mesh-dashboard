<ul class="team clearfix">

<?php
/************************************************************************
* Team members
*************************************************************************/

	global $post,$smof_data,$nzs_category;
	$old = $post;

	if(isset($smof_data['nzs_team_cols'])){

		switch ($smof_data['nzs_team_cols']) {
			case 2:
				$team_column_num = "eight columns";

			break;

			case 3:
				$team_column_num = "one-third column";

			break;

			case 4:
				$team_column_num = "four columns";

			break;
			
			default:
				$team_column_num = "four columns";
			break;
		}

	}else{

		$team_column_num = "four columns";

	}

	$target_window = $smof_data['nzs_social_target'];

	$portfolio_query = new WP_Query( array( 'post_type' => 'team_members', 'posts_per_page' => -1, 'order' => 'ASC','filter_team'=>$nzs_category  ) ); 
		
		if($portfolio_query->have_posts()): while($portfolio_query->have_posts()) : $portfolio_query->the_post();



		$team_link = get_post_meta(get_the_ID(), 'nzs_team_link_option', true);
		$team_link_window = get_post_meta(get_the_ID(), 'nzs_team_link_window', true);

?>
			<li class="<?php echo $team_column_num; ?>">

				<?php
				if(has_post_thumbnail()){
			 		// $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'team-thumbnail');  
			 		$thumb = nzs_get_post_image(get_post_thumbnail_id());
				?>

				<span class="img-wrap">

					<?php if($team_link){?>

					<a href="<?php echo esc_url($team_link);?>" target="<?php esc_attr_e($team_link_window); ?>"><img src="<?php echo $thumb;?>" alt="" class="rounded scale-with-grid"></a>

					<?php }else{ ?>
					
					<img src="<?php echo $thumb;?>" alt="" class="rounded scale-with-grid">

					<?php } ?>

				</span>

				<?php
				}else{
				?>

				<span class="img-wrap">

					<?php if($team_link){?>

					<a href="<?php echo esc_url($team_link);?>" target="<?php esc_attr_e($team_link_window); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/team-holder.jpg" alt="" class="rounded scale-with-grid"></a>

					<?php }else{ ?>
					
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/team-holder.jpg" alt="" class="rounded scale-with-grid">

					<?php } ?>


				</span>

				<?php
				}

				the_content();

				$team_twitter    = get_post_meta( get_the_ID(), 'nzs_member_social_twitter', true);
				$team_facebook   = get_post_meta( get_the_ID(), 'nzs_member_social_facebook', true);
				$team_google     = get_post_meta( get_the_ID(), 'nzs_member_social_google', true);
				$team_flickr     = get_post_meta( get_the_ID(), 'nzs_member_social_flickr', true);
				$team_linkedin   = get_post_meta( get_the_ID(), 'nzs_member_social_linkedin', true);
				$team_dribbble   = get_post_meta( get_the_ID(), 'nzs_member_social_dribbble', true);
				$team_deviantart = get_post_meta( get_the_ID(), 'nzs_member_social_deviantart', true);
				$team_pinterest  = get_post_meta( get_the_ID(), 'nzs_member_social_pinterest', true);
				
				$team_youtube    = get_post_meta( get_the_ID(), 'nzs_member_social_youtube', true);
				$team_vimeo      = get_post_meta( get_the_ID(), 'nzs_member_social_vimeo', true);
				$team_instagram  = get_post_meta( get_the_ID(), 'nzs_member_social_instagram', true);
				$team_email      = get_post_meta( get_the_ID(), 'nzs_member_social_email', true);
				$team_soundcloud = get_post_meta( get_the_ID(), 'nzs_member_social_soundcloud', true);
				$team_behance    = get_post_meta( get_the_ID(), 'nzs_member_social_behance', true);
				$team_ustream    = get_post_meta( get_the_ID(), 'nzs_member_social_ustream', true);
				$team_rss        = get_post_meta( get_the_ID(), 'nzs_member_social_rss', true);


				$social_markup = '';

				if(isset($smof_data['nzs_style_change']) && $smof_data['nzs_style_change'] == '1'){
					if(!empty($team_twitter)){
						$social_markup .= '<a class="social-icon twitter" target="'.esc_attr($target_window).'" href="'.esc_html($team_twitter).'"><i class="fa fa-twitter"></i></a>';
					}
					if(!empty($team_facebook)){
						$social_markup .= '<a class="social-icon facebook" target="'.esc_attr($target_window).'" href="'.esc_html($team_facebook).'"><i class="fa fa-facebook"></i></a>';
					}
					if(!empty($team_google)){
						$social_markup .= '<a class="social-icon google" target="'.esc_attr($target_window).'" href="'.esc_html($team_google).'"><i class="fa fa-google"></i></a>';
					}
					if(!empty($team_flickr)){
						$social_markup .= '<a class="social-icon flickr" target="'.esc_attr($target_window).'" href="'.esc_html($team_flickr).'"><i class="fa fa-flickr"></i></a>';
					}
					if(!empty($team_linkedin)){
						$social_markup .= '<a class="social-icon linkedin" target="'.esc_attr($target_window).'" href="'.esc_html($team_linkedin).'"><i class="fa fa-linkedin"></i></a>';
					}
					if(!empty($team_pinterest)){
						$social_markup .= '<a class="social-icon pinterest" target="'.esc_attr($target_window).'" href="'.esc_html($team_pinterest).'"><i class="fa fa-pinterest"></i></a>';
					}
					if(!empty($team_dribbble)){
						$social_markup .= '<a class="social-icon dribbble" target="'.esc_attr($target_window).'" href="'.esc_html($team_dribbble).'"><i class="fa fa-dribbble"></i></a>';
					}
					if(!empty($team_deviantart)){
						$social_markup .= '<a class="social-icon deviantart" target="'.esc_attr($target_window).'" href="'.esc_html($team_deviantart).'"><i class="fa fa-deviantart"></i></a>';
					}

					if(!empty($team_youtube)){
						$social_markup .= '<a class="social-icon youtube" target="'.esc_attr($target_window).'" href="'.esc_html($team_youtube).'"><i class="fa fa-youtube"></i></a>';
					}

					if(!empty($team_vimeo)){
						$social_markup .= '<a class="social-icon vimeo" target="'.esc_attr($target_window).'" href="'.esc_html($team_vimeo).'"><i class="fa fa-vimeo"></i></a>';
					}

					if(!empty($team_instagram)){
						$social_markup .= '<a class="social-icon instagram" target="'.esc_attr($target_window).'" href="'.esc_html($team_instagram).'"><i class="fa fa-instagram"></i></a>';
					}

					if(!empty($team_email)){
						$social_markup .= '<a class="social-icon email" target="'.esc_attr($target_window).'" href="mailto:'.esc_html($team_email).'"><i class="fa fa-envelope"></i></a>';
					}

					if(!empty($team_soundcloud)){
						$social_markup .= '<a class="social-icon soundcloud" target="'.esc_attr($target_window).'" href="'.esc_html($team_soundcloud).'"><i class="fa fa-soundcloud"></i></a>';
					}

					if(!empty($team_behance)){
						$social_markup .= '<a class="social-icon behance" target="'.esc_attr($target_window).'" href="'.esc_html($team_behance).'"><i class="fa fa-behance"></i></a>';
					}

					if(!empty($team_ustream)){
						$social_markup .= '<a class="social-icon ustream" target="'.esc_attr($target_window).'" href="'.esc_html($team_ustream).'"><i class="fa fa-magnet"></i></a>';
					}

					if(!empty($team_rss)){
						$social_markup .= '<a class="social-icon rss" target="'.esc_attr($target_window).'" href="'.esc_html($team_rss).'"><i class="fa fa-rss"></i></a>';
					}
				}else{

					if($team_twitter){
						$social_markup .= '<a class="hide-text twitter" target="'.$target_window.'" href="'.$team_twitter.'">Twitter</a>';
					} 

					if($team_facebook){
						$social_markup .= '<a class="hide-text facebook" target="'.$target_window.'" href="'.$team_facebook.'">Facebook</a>';
					} 

					if($team_google){
						$social_markup .= '<a class="hide-text google" target="'.$target_window.'" href="'.$team_google.'">Google+</a>';
					} 
					
					if($team_dribbble){
						$social_markup .= '<a class="hide-text dribbble" target="'.$target_window.'" href="'.$team_dribbble.'">Dribbble</a>';
					} 
					
					if($team_pinterest){
						$social_markup .= '<a class="hide-text pinterest" target="'.$target_window.'" href="'.$team_pinterest.'">Pinterest</a>';
					} 

					if($team_flickr){
						$social_markup .= '<a class="hide-text flickr" target="'.$target_window.'" href="'.$team_flickr.'">Flickr</a>';
					}

					if($team_deviantart){
						$social_markup .= '<a class="hide-text deviantart" target="'.$target_window.'" href="'.$team_deviantart.'">Deviantart</a>';
					}

					if($team_linkedin){
						$social_markup .= '<a class="hide-text linkedin" target="'.$target_window.'" href="'.$team_linkedin.'">Linkedin</a>';
					}

					if($team_vimeo){
						$social_markup .= '<a class="hide-text vimeo" target="'.$target_window.'" href="'.$team_vimeo.'">Vimeo</a>';
					}

					if($team_instagram){
						$social_markup .= '<a class="hide-text instagram" target="'.$target_window.'" href="'.$team_instagram.'">Instagram</a>';
					}

					if($team_email){
						$social_markup .= '<a class="hide-text email" target="'.$target_window.'" href="mailto:'.$team_email.'">Email</a>';
					}

					if($team_youtube){
						$social_markup .= '<a class="hide-text youtube" target="'.$target_window.'" href="'.$team_youtube.'">Youtube</a>';
					}

					if($team_soundcloud){
						$social_markup .= '<a class="hide-text soundcloud" target="'.$target_window.'" href="'.$team_soundcloud.'">Soundcloud</a>';
					} 

					if($team_behance){
						$social_markup .= '<a class="hide-text behance" target="'.$target_window.'" href="'.$team_behance.'">Behance</a>';
					}

					if($team_ustream){
						$social_markup .= '<a class="hide-text ustream" target="'.$target_window.'" href="'.$team_ustream.'">Ustream</a>';
					}

					if($team_rss){
						$social_markup .= '<a class="hide-text rss" target="'.$target_window.'" href="'.$team_rss.'">RSS</a>';
					} 

				}
			?>

				<div class="social">
					<?php echo $social_markup; ?>
				</div>

			</li>
			<?php
			 		
		endwhile;
		endif;

$post = $old;
 
?>
		
</ul>
