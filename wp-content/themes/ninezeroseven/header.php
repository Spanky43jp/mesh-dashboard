<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title('&raquo;', true, 'right' );?></title>

	<!-- Mobile Specific Metas
  ================================================== -->

  	<?php global $smof_data; ?>

	<?php if(isset($smof_data['nzs_responsive_layout']) && 0 == $smof_data['nzs_responsive_layout']): ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php endif; ?>

		<!-- CSS
  ================================================== -->


	<?php

	 	if(!empty($smof_data['nzs_custom_favicon'])):
	 	
	 		echo '<link rel="icon" href="'.$smof_data['nzs_custom_favicon'].'">';

	 	endif;
  	?>
  	

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->



	<?php wp_head(); ?>

	<script type="text/javascript" src="wp-content/uploads/2015/11/data.js"></script>
	<script>
		jQuery.fn.digits = function() { 
    				return this.each(function() { 
        			jQuery(this).text(jQuery(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
    			})
		}
				
		set_hex_values = function(field, number, reference) {
			var percent = (number * 100 / reference);
			jQuery('#' + field + '-percent').text(percent.toFixed(2) + "%");
			jQuery('#' + field + '-number').text("(" + number + ")");
			jQuery('#' + field + '-number').digits();
		}

		load_region_bar = function(id, region, num_in_region) {	
			console.log("Load: " + region);
			var this_region = null;
			mesh_data["regions"].map(function(item) {
     				if (item["reigon_name"] == region) {
					this_region = item;	
				} 
			})
			
			var installed = this_region["installed"];
			var communicating = this_region["communicating"];
			
			var communicating_height = (communicating * 100) / num_in_region;
			var installed_height = ((installed * 100) / num_in_region) - communicating_height;
			
			var buffer_height = 100 - communicating_height - installed_height;
			
			jQuery('#' + id).append(
				'<td class="clsRegionBar">' + 
					'<div class="clsRegionBarCell">'+
						'<div class="buffer" style="height:' + buffer_height +'%"></div>'+
						'<div class="installed" style="height:' + installed_height +'%"></div>'+
						'<div class="communicating" style="height:' + communicating_height +'%"></div>'+
					'</div>'+
				'</td>');
		}
		load_region_bars = function(id, regions) {
			jQuery('#' + id).html('');
			load_region_bar(id, "PILOT", 2138);
			load_region_bar(id, "LILYDALE", 51887);
			load_region_bar(id, "LEONGATHA", 28809);
			load_region_bar(id, "BENALLA", 19103);
			load_region_bar(id, "BEACONSFIELD", 37814);
			load_region_bar(id, "WODONGA", 23600);
			load_region_bar(id, "BAIRNSDALE", 25462);			
			load_region_bar(id, "SOUTH MORANG", 33013);
			load_region_bar(id, "TRARALGON", 33978);
			load_region_bar(id, "SEYMOUR", 13952);		
		}

		jQuery(function() 
		{
			var installed = mesh_data["total_installed"];
			var communicating = mesh_data["communicating"];
			var read_data = mesh_data["read_data"];
			
			var newest = null;
			
			read_data.map( function(item) {
     				if (newest != null) {
					if (item["read_date"] > newest["read_date"]) {
						newest = item;
					}	
				} 
				else {
					newest = item;
				}
			})

			var read = newest["read_count"];

			set_hex_values('installed-hex', installed, 268212.0);
  			set_hex_values('communicating-hex', communicating, 268212.0);
  			set_hex_values('updated-data-hex', read, 268212.0);
			load_region_bars('region-bar-data-row', mesh_data["regions"]);
  			
		})
	</script>
</head>

<body <?php body_class(); ?>>

<!-- Primary Page Layout
	================================================== -->

<div id="up"></div>

<!-- TOP BAR -->



<!-- ENDS TOP BAR -->

<?php
echo nzs_show_header();
?>