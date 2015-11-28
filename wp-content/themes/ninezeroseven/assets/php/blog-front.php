<?php

/************************************************************************
* Front Blog Page
*************************************************************************/

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'blog-front.php' == basename($_SERVER['SCRIPT_FILENAME'])){
	die ('This file can not be accessed directly!');
}

	global $post,
	$nzs_post_count,
	$nzs_blog_counter,
	$nzs_blog_category;

	$nzs_blog_counter = (isset($nzs_blog_counter) && is_numeric($nzs_blog_counter)) ? $nzs_blog_counter : 1;
	
	$nsz_blog_id = 'id="nzs-blog-'.$nzs_blog_counter.'"';
	$old = $post;

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$nzs_post_count = ( isset( $nzs_post_count ) && is_numeric( $nzs_post_count ) ) ? $nzs_post_count : get_option( 'posts_per_page' );
	$query_args = array( 
		'post_type'      => 'post', 
		'order'          => 'DESC',
		'posts_per_page' => $nzs_post_count,
		'paged'          => $paged
		);

	if ( !empty( $nzs_blog_category ) ) {
			$query_args['category_name'] = $nzs_blog_category;
		}

	$nzs_custom_query = new WP_Query( $query_args ); 
		
?>



		<div class="two-thirds column posts">
			<div <?php echo $nsz_blog_id;?> class="leftpadding ajaxed">

				<?php
				if($nzs_custom_query->have_posts()): while($nzs_custom_query->have_posts()) : $nzs_custom_query->the_post(); 
				
				?>
				
				<!-- POST -->
				<article class="post">
					<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<div class="meta">
						<ul>
							<li class="date"><?php echo get_the_date(get_option('date_format'))?></li>
							<li class="user"><?php _e('By','framework'); ?> <?php the_author_posts_link(); ?></li>
							<li class="postin"><?php _e('In','framework'); ?> <?php the_category(', ') ?></li>
							<li class="comments"><?php comments_number(__('No Comments','framework'), __('1 Comment','framework'), __('% Comments','framework') );?></li>
						</ul>
					</div>

					<?php

					get_template_part('assets/php/featured-image');
					
					?>

					<div class="content">
						
					<?php the_excerpt(); ?>

					</div>
					<div class="readmore">
						<?php

						printf('<a href="%1s" class="color-btn main-btn">%2s</a>',
							get_permalink(),
							__('Read More &raquo;','framework')
							);
						 
						?>
					</div>
				</article>	
				<!-- ./END POST -->

			<?php
			endwhile;
			?>
			<div id="page-links" class="page-nav clearfix" style="margin-bottom:30px;">

				<?php
					if(get_next_posts_link( $label = null, $nzs_custom_query->max_num_pages ) && $nzs_custom_query->max_num_pages > 0 ){


						next_posts_link( __("&laquo; Older Posts","framework"), $nzs_custom_query->max_num_pages);
					}

					if(get_previous_posts_link( $label = null, $nzs_custom_query->max_num_pages ) && $nzs_custom_query->max_num_pages > 0 ){
						
						previous_posts_link( __("Newer Posts &raquo;","framework"), $nzs_custom_query->max_num_pages);
					
					}
				?>
			</div>
			<?php endif; ?>

			</div>
		</div>

		<?php
			$post = $old; 
			get_sidebar(); 
		?>

