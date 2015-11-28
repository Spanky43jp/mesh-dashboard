<?php
/************************************************************************
 * Custom JS File
 *************************************************************************/ 
if(!function_exists('nzs_load_custom_js')){
	function nzs_load_custom_js(){
		global $smof_data;
		if(isset($smof_data['nzs_google_analytics']) && !empty($smof_data['nzs_google_analytics'])){
			echo $smof_data['nzs_google_analytics']."\n\n\n";
		}
	}
	add_action('wp_footer','nzs_load_custom_js',20);
}
?>