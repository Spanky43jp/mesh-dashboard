<?php
/************************************************************************
 * Custom Header File
 *************************************************************************/ 
?>

<section class="custom-header-option">
	
	<?php 
		global $smof_data;
		echo do_shortcode( $smof_data['nzs_custom_header_code'] );

	 ?>

</section> <!-- ./custom-header-option -->