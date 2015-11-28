<?php
/************************************************************************
* Full width page template
*************************************************************************/

get_header(); ?>

<section <?php post_class( 'blog alternate-bg2  page-padding');?> id="blog">
	<div class="container">

		<?php while ( have_posts() ) : the_post(); ?>

		<div class="titleBar">
			<span><?php _e('You Are Viewing','framework');?></span>
			<h2><?php the_title();?></h2>
			<?php putRevSlider('MainSlider', 'homepage'); ?>
		</div>

				<!-- Display Page Content -->


					<div class="page-content clearfix">
						
					<?php the_content(); ?>


					</div>

				<!-- ./END Page Context -->


				<?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>


		<?php endwhile; // end of the loop. ?>
	</div>
</section>
<?php get_footer(); ?>