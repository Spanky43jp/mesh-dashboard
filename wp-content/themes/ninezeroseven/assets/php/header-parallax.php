<?php
/************************************************************************
 * Parallax Header File
 *************************************************************************/ 

global $smof_data;

$p_header_tag ='';

if(isset($smof_data['nzs_header_options']) && 'parallax' == $smof_data['nzs_header_options']){

	if(isset($smof_data['nzs_parallax_header_speed'])){

		$p_header_tag = ' data-parallax-speed="'.esc_attr( $smof_data['nzs_parallax_header_speed'] ).'"';

	}else{
		$p_header_tag = ' data-parallax-speed="0.3"';
	}

}
?>

<section class="parallax fullheader entry" id="header-option"<?php if(is_admin_bar_showing()){echo ' style="margin-top:-28px"';} ?><?php echo $p_header_tag;?>>
	<div class="container">

		<?php if(isset($smof_data['nzs_parallax_logo_image']) && !empty($smof_data['nzs_parallax_logo_image'])): ?>


				<div class="sixteen columns header-logo-area">

					<img src="<?php echo $smof_data['nzs_parallax_logo_image']; ?>" class="header-logo scale-with-grid"/>

				</div>


			<?php endif; ?>


		<?php
			if(!empty($smof_data['nzs_parallax_heading_text']) || !empty($smof_data['nzs_parallax_description_text'])){
		?>

		<div class="message">

		<?php if(!empty($smof_data['nzs_parallax_heading_text'])): ?>

			<h2><?php echo $smof_data['nzs_parallax_heading_text'];?></h2><br/>

		<?php endif; ?>

		<?php if(!empty($smof_data['nzs_parallax_description_text'])): ?>

			<p><?php echo $smof_data['nzs_parallax_description_text'];?></p>

		<?php endif; ?>

		</div>

		<?php } ?>

	</div>
	<?php if( function_exists('nzs_social_links') ){ ?>

		<div class="social">
			<?php echo nzs_social_links();?>
		</div>

	<?php }?>
</section>