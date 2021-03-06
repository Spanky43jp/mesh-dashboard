<?php

	// Get WPDB Object
	global $wpdb;

	// Table name
	$table_name = $wpdb->prefix . "cuteslider";

	// Get the IF of the slider
	$id = (int) $_GET['id'];

	// Get slider
	$slider = $wpdb->get_row("SELECT * FROM $table_name WHERE id = ".(int)$id." ORDER BY date_c DESC LIMIT 1" , ARRAY_A);
	$slider = json_decode($slider['data'], true);
?>
<div id="cs-sample-slide">
	<div class="cs-box cs-layer-box active">
		<input type="hidden" name="layerkey" value="0">
		<table>
			<thead class="cs-layer-options-thead">
				<tr>
					<td colspan="7">
						<span id="cs-icon-layer-options"></span>
						<h4>
							<?php _e('Slide Options', 'CuteSlider') ?>
							<a href="#" class="duplicate cs-layer-duplicate"><?php _e('Duplicate this slide', 'CuteSlider') ?></a>
						</h4>
					</td>
				</tr>
			</thead>
			<tbody class="cs-slide-options">
				<tr>
					<td class="right"><?php _e('Slide options', 'CuteSlider') ?></td>
					<td class="right"><?php _e('Image', 'CuteSlider') ?></td>
					<td>
						<div class="reset-parent">
							<input type="text" name="image" class="cs-upload" value="">
							<span class="cs-reset">x</span>
						</div>
					</td>
					<td class="right"><?php _e('Thumbnail', 'CuteSlider') ?></td>
					<td>
						<div class="reset-parent">
							<input type="text" name="thumbnail" class="cs-upload" value="">
							<span class="cs-reset">x</span>
						</div>
					</td>
					<td class="right"><?php _e('Delay', 'CuteSlider') ?></td>
					<td><input type="text" name="slidedelay" value="4">(s)</td>
				</tr>
				<tr>
					<td class="right"><?php _e('Transitions', 'CuteSlider') ?></td>
					<td class="right">3D</td>
					<td>
						<input type="hidden" name="3d_transitions" value="">
						<a href="#" class="cs-open-transition-gallery 3d"><?php _e('Select 3D transitions', 'CuteSlider') ?></a>
					</td>
					<td class="right">2D</td>
					<td>
						<input type="hidden" name="2d_transitions" value="">
						<a href="#" class="cs-open-transition-gallery 2d"><?php _e('Select 2D transitions', 'CuteSlider') ?></a>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="right"><?php _e('Link this slide', 'CuteSlider') ?></td>
					<td class="right"><?php _e('URL', 'CuteSlider') ?></td>
					<td>
						<div class="reset-parent">
							<input type="text" name="link">
							<span class="cs-reset">x</span>
						</div>
					</td>
					<td class="right"><?php _e('Target', 'CuteSlider') ?></td>
					<td>
						<select name="link_target">
							<option>_self</option>
							<option>_blank</option>
						</select>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="right"><?php _e('Info box', 'CuteSlider') ?></td>
					<td class="right"><?php _e('Alignment', 'CuteSlider') ?></td>
					<td>
						<select name="infobox_aligment">
							<option value="top"><?php _e('top', 'CuteSlider') ?></option>
							<option value="right"><?php _e('right', 'CuteSlider') ?></option>
							<option value="bottom" selected="selected"><?php _e('bottom', 'CuteSlider') ?></option>
							<option value="left"><?php _e('left', 'CuteSlider') ?></option>
						</select>
					</td>
					<td class="right"><?php _e('Title', 'CuteSlider') ?></td>
					<td>
						<div class="reset-parent">
							<input type="text" name="infobox_title">
							<span class="cs-reset">x</span>
						</div>
					</td>
					<td class="right"><?php _e('Text', 'CuteSlider') ?></td>
					<td>
						<div class="reset-parent">
							<input type="text" name="infobox_text">
							<span class="cs-reset">x</span>
						</div>
					</td>
				</tr>
				<tr>
					<td class="right"><?php _e('Inbo box link', 'CuteSlider') ?></td>
					<td class="right"><?php _e('Name', 'CuteSlider') ?></td>
					<td><input type="text" name="infobox_button" value="Read more"></td>
					<td class="right"><?php _e('URL', 'CuteSlider') ?></td>
					<td>
						<div class="reset-parent">
							<input type="text" name="infobox_link">
							<span class="cs-reset">x</span>
						</div>
					</td>
					<td class="right"><?php _e('Target', 'CuteSlider') ?></td>
					<td>
						<select name="infobox_target">
							<option>_self</option>
							<option>_blank</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="right"><?php _e('Misc', 'CuteSlider') ?></td>
					<td class="right"><?php _e('Video URL', 'CuteSlider') ?></td>
					<td>
						<div class="reset-parent">
							<input type="text" name="video">
							<span class="cs-reset">x</span>
						</div>
					</td>
					<td class="right"><?php _e('Hidden', 'CuteSlider') ?></td>
					<td colspan="5"><input type="checkbox" class="checkbox" name="skip"></td>
				</tr>
			</tbody>
		</table>
		<table>
			<thead>
				<tr>
					<td>
						<span id="cs-icon-preview"></span>
						<h4><?php _e('Preview', 'CuteSlider') ?></h4>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="9" class="cs-preview-td">
						<div class="cs-preview-wrapper">
							<div class="cs-preview">
								<div class="draggable"></div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<thead>
				<tr>
					<td>
						<span id="cs-icon-captions"></span>
						<h4><?php _e('Captions', 'CuteSlider') ?></h4>
					</td>
				</tr>
			</thead>
			<tbody class="cs-captions"></tbody>
		</table>
		<a href="#" class="cs-add-sublayer"><?php _e('Add new caption', 'CuteSlider') ?></a>
	</div>
</div>

<table id="cs-sample-caption">
	<tbody>
		<tr>
			<td>
				<div class="cs-caption-wrapper">
					<span class="cs-caption-number">1</span>
					<input type="text" name="subtitle" class="cs-caption-title" value="Caption #1">
					<div class="clear"></div>
					<div class="cs-caption-nav">
						<a href="#" class="active"><?php _e('HTML', 'CuteSlider') ?></a>
						<a href="#"><?php _e('Options', 'CuteSlider') ?></a>
						<a href="#"><?php _e('Link', 'CuteSlider') ?></a>
						<a href="#"><?php _e('Style', 'CuteSlider') ?></a>
						<a href="#" title="Remove this caption" class="remove">x</a>
					</div>
					<div class="cs-caption-pages">
						<div class="cs-caption-page cs-caption-html active">
							<textarea name="html" cols="50" rows="5"></textarea>
						</div>
						<div class="cs-caption-page cs-caption-options">
							<table>
								<tbody>
									<tr>
										<td><?php _e('Caption options', 'CuteSlider') ?></td>
										<td class="right"><?php _e('Effect', 'CuteSlider') ?></td>
										<td>
											<select name="effect">
												<option value="fade"><?php _e('fade', 'CuteSlider') ?></option>
												<option value="slide"><?php _e('slide', 'CuteSlider') ?></option>
											</select>
										</td>
										<td class="right"><?php _e('Delay', 'CuteSlider') ?></td>
										<td><input type="text" name="delay" value="0"> (ms)</td>
										<td class="right"><?php _e('Hidden', 'CuteSlider') ?></td>
										<td><input type="checkbox" class="checkbox" name="skip"></td>
										<td class="right"></td>
										<td><button class="button duplicate"><?php _e('Duplicate this caption', 'CuteSlider') ?></button></td>
									</tr>
							</table>
						</div>
						<div class="cs-caption-page cs-caption-link">
							<table>
								<tbody>
									<tr>
										<td><?php _e('URL', 'CuteSlider') ?></td>
										<td class="url"><input type="text" name="url" value=""></td>
										<td>
											<select name="target">
												<option>_self</option>
												<option>_blank</option>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="cs-caption-page cs-caption-style">
							<table>
								<tbody>
									<tr>
										<td><?php _e('Dimensions', 'CuteSlider') ?></td>
										<td class="right"><?php _e('Width', 'CuteSlider') ?></td>
										<td><input type="text" name="width" value="auto"></td>
										<td class="right"><?php _e('Height', 'CuteSlider') ?></td>
										<td colspan="5"><input type="text" name="height" value="auto"></td>
									<tr>
										<td><?php _e('Positions', 'CuteSlider') ?></td>
										<td class="right"><?php _e('Top', 'CuteSlider') ?></td>
										<td><input type="text" name="top" value="10%"></td>
										<td class="right"><?php _e('Left', 'CuteSlider') ?></td>
										<td colspan="5"><input type="text" name="left" value="10%"></td>
									</tr>
									<tr>
										<td><?php _e('Padding', 'CuteSlider') ?></td>
										<td class="right"><?php _e('Top', 'CuteSlider') ?></td>
										<td><input type="text" name="padding_top" value="1%"></td>
										<td class="right"><?php _e('Right', 'CuteSlider') ?></td>
										<td><input type="text" name="padding_right" value="1%"></td>
										<td class="right"><?php _e('Bottom', 'CuteSlider') ?></td>
										<td><input type="text" name="padding_bottom" value="1%"></td>
										<td class="right"><?php _e('Left', 'CuteSlider') ?></td>
										<td><input type="text" name="padding_left" value="1%"></td>
									</tr>
									<tr>
										<td><?php _e('Border', 'CuteSlider') ?></td>
										<td class="right"><?php _e('Top', 'CuteSlider') ?></td>
										<td><input type="text" name="border_top" value="0px solid #000"></td>
										<td class="right"><?php _e('Right', 'CuteSlider') ?></td>
										<td><input type="text" name="border_right" value="0px solid #000"></td>
										<td class="right"><?php _e('Bottom', 'CuteSlider') ?></td>
										<td><input type="text" name="border_bottom" value="0px solid #000"></td>
										<td class="right"><?php _e('Left', 'CuteSlider') ?></td>
										<td><input type="text" name="border_left" value="0px solid #000"></td>
									</tr>
									<tr>
										<td><?php _e('Font', 'CuteSlider') ?></td>
										<td class="right"><?php _e('Family', 'CuteSlider') ?></td>
										<td><input type="text" name="font_family" value="Arial, sans-serif"></td>
										<td class="right"><?php _e('Size', 'CuteSlider') ?></td>
										<td><input type="text" name="font_size" value="17px"></td>
										<td class="right"><?php _e('Line-height', 'CuteSlider') ?></td>
										<td><input type="text" name="line_height" value="normal"></td>
										<td class="right"><?php _e('Color', 'CuteSlider') ?></td>
										<td><input type="text" name="color" value="#FFF"></td>
									</tr>
									<tr>
										<td><?php _e('Misc', 'CuteSlider') ?></td>
										<td class="right"><?php _e('Background', 'CuteSlider') ?></td>
										<td colspan="7"><input type="text" name="background" value="#000"></td>
									</tr>
									<tr>
										<td><?php _e('Custom style settings', 'CuteSlider') ?></td>
										<td class="right"><?php _e('Custom styles', 'CuteSlider') ?></td>
										<td colspan="7"><textarea rows="5" cols="50" name="style" class="style"></textarea></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>


<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="wrap" id="cs-slider-form">

	<input type="hidden" name="posted_edit" value="1">

	<!-- Title -->
	<div class="cuteslider-icon"></div>
	<h2>
		<?php _e('Edit this Cute Slider', 'CuteSlider') ?>
		<a href="?page=cuteslider" class="add-new-h2"><?php _e('Back to the list', 'CuteSlider') ?></a>
	</h2>

	<!-- Main menu bar -->
	<div id="cs-main-nav-bar">
		<a href="#" class="settings"><?php _e('Slider Settings', 'CuteSlider') ?></a>
		<a href="#" class="layers active"><?php _e('Slides', 'CuteSlider') ?></a>
		<a href="#" class="callbacks"><?php _e('Callbacks', 'CuteSlider') ?></a>
		<a href="#" class="support unselectable"><?php _e('Documentation', 'CuteSlider') ?></a>
		<a href="#" class="clear unselectable"></a>
	</div>

	<!-- Pages -->
	<div id="cs-pages">

		<!-- Slider Settings -->
		<div class="cs-page cs-settings">

			<div id="post-body-content">
				<div id="titlediv">
					<div id="titlewrap">
						<input type="text" name="title" value="<?php echo $slider['properties']['title'] ?>" id="title" autocomplete="off" placeholder="<?php _e('Type your slider name here', 'CuteSlider') ?>">
					</div>
				</div>
			</div>

			<div class="cs-box cs-settings">
				<h3 class="header"><?php _e('Slider Settings', 'CuteSlider') ?></h3>
				<table>
					<thead>
						<tr>
							<td colspan="3">
								<span id="cs-icon-basic"></span>
								<h4><?php _e('Basic', 'CuteSlider') ?></h4>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php _e('Width', 'CuteSlider') ?></td>
							<td><input type="text" name="width" value="<?php echo $slider['properties']['width'] ?>" class="input"></td>
							<td class="desc">(px) <?php _e('The slider width in pixels.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Height', 'CuteSlider') ?></td>
							<td><input type="text" name="height" value="<?php echo $slider['properties']['height'] ?>" class="input"></td>
							<td class="desc">(px) <?php _e('The slider height in pixels.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Responsiveness', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="responsive" <?php echo isset($slider['properties']['responsive']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('Enable this option to turn Cute Slider WP into a responsive slider.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Min-Width', 'CuteSlider') ?></td>
							<td><input type="text" name="minwidth" value="<?php echo $slider['properties']['minwidth'] ?>" class="input"></td>
							<td class="desc">(px) <?php _e('The slider minimum width in pixels. Zero means disabled.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Max-Width', 'CuteSlider') ?></td>
							<td><input type="text" name="maxwidth" value="<?php echo $slider['properties']['maxwidth'] ?>" class="input"></td>
							<td class="desc">(px) <?php _e('The slider maximum width in pixels. Zero means disabled.', 'CuteSlider') ?></td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<td colspan="3">
								<span id="cs-icon-slideshow"></span>
								<h4><?php _e('Slideshow', 'CuteSlider') ?></h4>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php _e('Automatically start slideshow', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="autostart" <?php echo isset($slider['properties']['autostart']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('If enabled, slideshow will automatically start after loading the page.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Pause on hover', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="pauseonhover" <?php echo isset($slider['properties']['pauseonhover']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('Slideshow will pause when your mouse pointer is over CuteSlider.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Random slideshow', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="randomslideshow" <?php echo isset($slider['properties']['randomslideshow']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('Cute Slider will change slides in random order.', 'CuteSlider') ?></td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<td colspan="3">
								<span id="cs-icon-appearance"></span>
								<h4><?php _e('Appearance', 'CuteSlider') ?></h4>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php _e('Skin', 'CuteSlider') ?></td>
							<td>
								<select name="skin">
									<?php $files = scandir(dirname(__FILE__) . '/skins'); ?>
									<?php foreach($files as $entry) : ?>
									<?php if($entry == '.' || $entry == '..' || $entry == 'preview') continue; ?>
									<?php if($entry == $slider['properties']['skin']) { ?>
									<option selected="selected"><?php echo $entry ?></option>
									<?php } else { ?>
									<option><?php echo $entry ?></option>
									<?php } ?>
									<?php endforeach; ?>
								</select>
							</td>
							<td class="desc"><?php _e('You can change the skin of your slider. Your custom skins will appear in the list when you create their folders as well.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Force 2D transitions', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="force_2d" <?php echo isset($slider['properties']['force_2d']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('CuteSlider WP will use 3D transitions when available, with this option you can force the slider to use 2D transitions only.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Shadow', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="shadow" <?php echo isset($slider['properties']['shadow']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('If you enable this option, there will be a shadow below the slider.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Slider style', 'CuteSlider') ?></td>
							<td>
								<div class="reset-parent">
									<input type="text" name="sliderstyle" class="input" value="<?php echo $slider['properties']['sliderstyle'] ?>">
									<span class="cs-reset">x</span>
								</div>
							</td>
							<td class="desc"><?php _e('Here you can apply your custom CSS style settings to the slider.', 'CuteSlider') ?></td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<td colspan="3">
								<span id="cs-icon-navigation"></span>
								<h4><?php _e('Navigation', 'CuteSlider') ?></h4>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php _e('Thumbnail navigation', 'CuteSlider') ?></td>
							<td>
								<select name="thumbnav">
									<option value="disabled" <?php echo ($slider['properties']['thumbnav'] == 'disabled') ? 'selected="selected"' : '' ?>><?php _e('Disabled', 'CuteSlider') ?></option>
									<option value="hover" <?php echo ($slider['properties']['thumbnav'] == 'hover') ? 'selected="selected"' : '' ?>><?php _e('Hover', 'CuteSlider') ?></option>
									<option value="always" <?php echo ($slider['properties']['thumbnav'] == 'always') ? 'selected="selected"' : '' ?>><?php _e('Thumbnail list', 'CuteSlider') ?></option>
								</select>
							</td>
							<td class="desc"><?php _e('If enabled, the navigation buttons will show small thumbnails of the slide if you move your mouse cursor over them.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Hover thumbnails alignment', 'CuteSlider') ?></td>
							<td>
								<select name="thumbnav_hover_align">
									<option value="up" <?php echo ($slider['properties']['thumbnav_hover_align'] == 'up') ? 'selected="selected"' : '' ?>><?php _e('Above navigation', 'CuteSlider') ?></option>
									<option value="bottom" <?php echo ($slider['properties']['thumbnav_hover_align'] == 'bottom') ? 'selected="selected"' : '' ?>><?php _e('Below navigation', 'CuteSlider') ?></option>
								</select>
							</td>
							<td class="desc"><?php _e('Specifies the aligment of hover thumbnails.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Prev and Next buttons', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="navprevnext" <?php echo isset($slider['properties']['navprevnext']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('If disabled, Prev and Next buttons will be invisible.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Slide buttons', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="navbuttons" <?php echo isset($slider['properties']['navbuttons']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('If disabled, slide buttons will be invisible.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Bar timer', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="navbartimer" <?php echo isset($slider['properties']['navbartimer']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('Adds bar timer to your slides.', 'CuteSlider') ?></td>
						</tr>
						<tr>
							<td><?php _e('Circle timer', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="navcircletimer" <?php echo isset($slider['properties']['navcircletimer']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('Adds circle timer to your slides. Please note that this type of timer only works in modern browsers that support the canvas element.', 'CuteSlider') ?></td>
					</tbody>
					<thead>
						<tr>
							<td colspan="3">
								<span id="cs-icon-misc"></span>
								<h4><?php _e('Misc', 'CuteSlider') ?></h4>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php _e('Use relative URLs', 'CuteSlider') ?></td>
							<td><input type="checkbox" name="relativeurls" <?php echo isset($slider['properties']['relativeurls']) ? 'checked="checked"' : '' ?>></td>
							<td class="desc"><?php _e('If enabled, Cute Slider WP will use relative URLs for images.', 'CuteSlider') ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Slides -->
		<div class="cs-page active">

			<div id="cs-layer-tabs">
				<?php if(!empty($slider['layers'])) : ?>
				<?php foreach($slider['layers'] as $key => $layer) : ?>
				<?php $active = empty($key) ? 'active' : '' ?>
				<a href="#" class="<?php echo $active ?>">Slide #<?php echo ($key+1) ?> <span>x</span></a>
				<?php endforeach; ?>
				<?php endif; ?>
				<a href="#" class="unsortable" id="cs-add-layer"><?php _e('Add new slide', 'CuteSlider') ?></a>
				<div class="unsortable clear"></div>
			</div>
			<div id="cs-layers">
				<?php if(!empty($slider['layers'])) : ?>
				<?php foreach($slider['layers'] as $key => $layer) : ?>
				<?php $active = empty($key) ? 'active' : '' ?>
				<div class="cs-box cs-layer-box <?php echo $active ?>">
					<input type="hidden" name="layerkey" value="0">
					<table>
						<thead class="cs-layer-options-thead">
							<tr>
								<td colspan="7">
									<span id="cs-icon-layer-options"></span>
									<h4>
										<?php _e('Slide Options', 'CuteSlider')?>
										<a href="#" class="duplicate cs-layer-duplicate"><?php _e('Duplicate this slide', 'CuteSlider') ?></a>
									</h4>
								</td>
							</tr>
						</thead>
						<tbody class="cs-slide-options">
							<tr>
								<td class="right"><?php _e('Slide options', 'CuteSlider') ?></td>
								<td class="right"><?php _e('Image', 'CuteSlider') ?></td>
								<td>
									<div class="reset-parent">
										<input type="text" name="image" class="cs-upload" value="<?php echo $layer['properties']['image'] ?>">
										<span class="cs-reset">x</span>
									</div>
								</td>
								<td class="right"><?php _e('Thumbnail', 'CuteSlider') ?></td>
								<td>
									<div class="reset-parent">
										<input type="text" name="thumbnail" class="cs-upload" value="<?php echo $layer['properties']['thumbnail'] ?>">
										<span class="cs-reset">x</span>
									</div>
								</td>
								<td class="right"><?php _e('Delay', 'CuteSlider') ?></td>
								<td><input type="text" name="slidedelay" value="<?php echo $layer['properties']['slidedelay'] ?>">(s)</td>
							</tr>
							<tr>
								<td class="right"><?php _e('Transitions', 'CuteSlider') ?></td>
								<td class="right">3D</td>
								<td>
									<input type="hidden" name="3d_transitions" value="<?php echo $layer['properties']['3d_transitions'] ?>">
									<a href="#" class="cs-open-transition-gallery 3d"><?php _e('Select 3D transitions', 'CuteSlider') ?></a>
								</td>
								<td class="right">2D</td>
								<td>
									<input type="hidden" name="2d_transitions" value="<?php echo $layer['properties']['2d_transitions'] ?>">
									<a href="#" class="cs-open-transition-gallery 2d"><?php _e('Select 2D transitions', 'CuteSlider') ?></a>
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="right"><?php _e('Link this slide', 'CuteSlider') ?></td>
								<td class="right"><?php _e('URL', 'CuteSlider') ?></td>
								<td>
									<div class="reset-parent">
										<input type="text" name="link" value="<?php echo $layer['properties']['link'] ?>">
										<span class="cs-reset">x</span>
									</div>
								</td>
								<td class="right"><?php _e('Target', 'CuteSlider') ?></td>
								<td>
									<select name="link_target">
										<option <?php echo ($layer['properties']['link_target'] == '_self') ? 'selected="selected"' : '' ?>>_self</option>
										<option <?php echo ($layer['properties']['link_target'] == '_blank') ? 'selected="selected"' : '' ?>>_blank</option>
									</select>
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="right"><?php _e('Info box', 'CuteSlider') ?></td>
								<td class="right"><?php _e('Alignment', 'CuteSlider') ?></td>
								<td>
									<select name="infobox_aligment">
										<option <?php echo ($layer['properties']['infobox_aligment'] == 'top') ? 'selected="selected"' : '' ?>><?php _e('top', 'CuteSlider') ?></option>
										<option <?php echo ($layer['properties']['infobox_aligment'] == 'right') ? 'selected="selected"' : '' ?>><?php _e('right', 'CuteSlider') ?></option>
										<option <?php echo ($layer['properties']['infobox_aligment'] == 'bottom') ? 'selected="selected"' : '' ?>><?php _e('bottom', 'CuteSlider') ?></option>
										<option <?php echo ($layer['properties']['infobox_aligment'] == 'left') ? 'selected="selected"' : '' ?>><?php _e('left', 'CuteSlider') ?></option>
									</select>
								</td>
								<td class="right"><?php _e('Title', 'CuteSlider') ?></td>
								<td>
									<div class="reset-parent">
										<input type="text" name="infobox_title" value="<?php echo stripslashes($layer['properties']['infobox_title']) ?>">
										<span class="cs-reset">x</span>
									</div>
								</td>
								<td class="right"><?php _e('Text', 'CuteSlider') ?></td>
								<td>
									<div class="reset-parent">
										<input type="text" name="infobox_text" value="<?php echo stripslashes($layer['properties']['infobox_text']) ?>">
										<span class="cs-reset">x</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="right"><?php _e('Inbo box link', 'CuteSlider') ?></td>
								<td class="right"><?php _e('Name', 'CuteSlider') ?></td>
								<td><input type="text" name="infobox_button" value="<?php echo stripslashes($layer['properties']['infobox_button']) ?>"></td>
								<td class="right"><?php _e('URL', 'CuteSlider') ?></td>
								<td>
									<div class="reset-parent">
										<input type="text" name="infobox_link" value="<?php echo $layer['properties']['infobox_link'] ?>">
										<span class="cs-reset">x</span>
									</div>
								</td>
								<td class="right"><?php _e('Target', 'CuteSlider') ?></td>
								<td>
									<select name="infobox_target">
										<option <?php echo ($layer['properties']['infobox_target'] == '_self') ? 'selected="selected"' : '' ?>>_self</option>
										<option <?php echo ($layer['properties']['infobox_target'] == '_blank') ? 'selected="selected"' : '' ?>>_blank</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="right"><?php _e('Misc', 'CuteSlider') ?></td>
								<td class="right"><?php _e('Video URL', 'CuteSlider') ?></td>
								<td>
									<div class="reset-parent">
										<input type="text" name="video" value="<?php echo $layer['properties']['video'] ?>">
										<span class="cs-reset">x</span>
									</div>
								</td>
								<td class="right"><?php _e('Hidden', 'CuteSlider') ?></td>
								<td colspan="5"><input type="checkbox" class="checkbox" name="skip" <?php echo isset($layer['properties']['skip']) ? 'checked="checked"' : '' ?>></td>
							</tr>
						</tbody>
					</table>
					<table>
						<thead>
							<tr>
								<td>
									<span id="cs-icon-preview"></span>
									<h4><?php _e('Preview', 'CuteSlider') ?></h4>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="9" class="cs-preview-td">
									<div class="cs-preview-wrapper">
										<div class="cs-preview">
											<div class="draggable"></div>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<table>
						<thead>
							<tr>
								<td>
									<span id="cs-icon-captions"></span>
									<h4><?php _e('Captions', 'CuteSlider') ?></h4>
								</td>
							</tr>
						</thead>
						<tbody class="cs-captions">
							<?php if(!empty($layer['sublayers'])) : ?>
							<?php foreach($layer['sublayers'] as $key => $sublayer) : ?>
							<?php $active = (count($layer['sublayers']) == ($key+1)) ? ' class="active"' : '' ?>
							<?php $title = empty($sublayer['subtitle']) ? 'Sublayer #'.($key+1).'' : htmlspecialchars(stripslashes($sublayer['subtitle'])); ?>
							<tr<?php echo $active ?>>
								<td>
									<div class="cs-caption-wrapper">
										<span class="cs-caption-number"><?php echo ($key + 1) ?></span>
										<input type="text" name="subtitle" class="cs-caption-title" value="<?php echo $title ?>">
										<div class="clear"></div>
										<div class="cs-caption-nav">
											<a href="#" class="active">HTML</a>
											<a href="#"><?php _e('Options', 'CuteSlider') ?></a>
											<a href="#"><?php _e('Link', 'CuteSlider') ?></a>
											<a href="#"><?php _e('Style', 'CuteSlider') ?></a>
											<a href="#" title="Remove this caption" class="remove">x</a>
										</div>
										<div class="cs-caption-pages">
											<div class="cs-caption-page cs-caption-html active">
												<textarea name="html" cols="50" rows="5"><?php echo stripslashes($sublayer['html']) ?></textarea>
											</div>
											<div class="cs-caption-page cs-caption-options">
												<table>
													<tbody>
														<tr>
															<td><?php _e('Caption options', 'CuteSlider') ?></td>
															<td class="right"><?php _e('Effect', 'CuteSlider') ?></td>
															<td>
																<select name="effect">
																	<option value="fade" <?php echo ($sublayer['effect'] == 'fade') ? 'selected="selected"' : '' ?>><?php _e('fade', 'CuteSlider') ?></option>
																	<option value="slide" <?php echo ($sublayer['effect'] == 'slide') ? 'selected="selected"' : '' ?>><?php _e('slide', 'CuteSlider') ?></option>
																</select>
															</td>
															<td class="right"><?php _e('Delay', 'CuteSlider') ?></td>
															<td><input type="text" name="delay" value="<?php echo $sublayer['delay'] ?>"> (ms)</td>
															<td class="right"><?php _e('Hidden', 'CuteSlider') ?></td>
															<td><input type="checkbox" class="checkbox" name="skip" <?php isset($sublayer['skip']) ? 'checked="checked"' : '' ?>></td>
															<td class="right"></td>
															<td><button class="button duplicate"><?php _e('Duplicate this caption', 'CuteSlider') ?></button></td>
														</tr>
												</table>
											</div>
											<div class="cs-caption-page cs-caption-link">
												<table>
													<tbody>
														<tr>
															<td><?php _e('URL', 'CuteSlider') ?></td>
															<td class="url"><input type="text" name="url" value="<?php echo $sublayer['url'] ?>"></td>
															<td>
																<select name="target">
																	<option <?php echo ($sublayer['target'] == '_self') ? 'selected="selected"' : '' ?>>_self</option>
																	<option <?php echo ($sublayer['target'] == '_blank') ? 'selected="selected"' : '' ?>>_blank</option>
																</select>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="cs-caption-page cs-caption-style">
												<table>
													<tbody>
														<tr>
															<td><?php _e('Dimensions', 'CuteSlider') ?></td>
															<td class="right"><?php _e('Width', 'CuteSlider') ?></td>
															<td><input type="text" name="width" value="<?php echo $sublayer['width'] ?>"></td>
															<td class="right"><?php _e('Height', 'CuteSlider') ?></td>
															<td colspan="5"><input type="text" name="height" value="<?php echo $sublayer['height'] ?>"></td>
														<tr>
															<td><?php _e('Positions', 'CuteSlider') ?></td>
															<td class="right"><?php _e('Top', 'CuteSlider') ?></td>
															<td><input type="text" name="top" value="<?php echo $sublayer['top'] ?>"></td>
															<td class="right"><?php _e('Left', 'CuteSlider') ?></td>
															<td colspan="5"><input type="text" name="left" value="<?php echo $sublayer['left'] ?>"></td>
														</tr>
														<tr>
															<td><?php _e('Padding', 'CuteSlider') ?></td>
															<td class="right"><?php _e('Top', 'CuteSlider') ?></td>
															<td><input type="text" name="padding_top" value="<?php echo $sublayer['padding_top'] ?>"></td>
															<td class="right"><?php _e('Right', 'CuteSlider') ?></td>
															<td><input type="text" name="padding_right" value="<?php echo $sublayer['padding_right'] ?>"></td>
															<td class="right"><?php _e('Bottom', 'CuteSlider') ?></td>
															<td><input type="text" name="padding_bottom" value="<?php echo $sublayer['padding_bottom'] ?>"></td>
															<td class="right"><?php _e('Left', 'CuteSlider') ?></td>
															<td><input type="text" name="padding_left" value="<?php echo $sublayer['padding_left'] ?>"></td>
														</tr>
														<tr>
															<td><?php _e('Border', 'CuteSlider') ?></td>
															<td class="right"><?php _e('Top', 'CuteSlider') ?></td>
															<td><input type="text" name="border_top" value="<?php echo $sublayer['border_top'] ?>"></td>
															<td class="right"><?php _e('Right', 'CuteSlider') ?></td>
															<td><input type="text" name="border_right" value="<?php echo $sublayer['border_right'] ?>"></td>
															<td class="right"><?php _e('Bottom', 'CuteSlider') ?></td>
															<td><input type="text" name="border_bottom" value="<?php echo $sublayer['border_bottom'] ?>"></td>
															<td class="right"><?php _e('Left', 'CuteSlider') ?></td>
															<td><input type="text" name="border_left" value="<?php echo $sublayer['border_left'] ?>"></td>
														</tr>
														<tr>
															<td><?php _e('Font', 'CuteSlider') ?></td>
															<td class="right"><?php _e('Family', 'CuteSlider') ?></td>
															<td><input type="text" name="font_family" value="<?php echo stripslashes($sublayer['font_family']) ?>"></td>
															<td class="right"><?php _e('Size', 'CuteSlider') ?></td>
															<td><input type="text" name="font_size" value="<?php echo $sublayer['font_size'] ?>"></td>
															<td class="right"><?php _e('Line-height', 'CuteSlider') ?></td>
															<td><input type="text" name="line_height" value="<?php echo $sublayer['line_height'] ?>"></td>
															<td class="right"><?php _e('Color', 'CuteSlider') ?></td>
															<td><input type="text" name="color" value="<?php echo $sublayer['color'] ?>"></td>
														</tr>
														<tr>
															<td><?php _e('Misc', 'CuteSlider') ?></td>
															<td class="right"><?php _e('Background', 'CuteSlider') ?></td>
															<td colspan="7"><input type="text" name="background" value="<?php echo $sublayer['background'] ?>"></td>
														</tr>
														<tr>
															<td><?php _e('Custom style settings', 'CuteSlider') ?></td>
															<td class="right"><?php _e('Custom styles', 'CuteSlider') ?></td>
															<td colspan="7"><textarea rows="5" cols="50" name="style" class="style"><?php echo stripslashes($sublayer['style']) ?></textarea></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
					<a href="#" class="cs-add-sublayer"><?php _e('Add new caption', 'CuteSlider') ?></a>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

		<!-- Event Callbacks -->
		<div class="cs-page cs-callback-page">
			<div class="cs-box cs-callback-box">
				<h3 class="header">Cute.SliderEvent.CHANGE_START</h3>
				<div class="inner">
					<textarea name="api_change_start" cols="20" rows="5"><?php echo stripslashes($slider['properties']['api_change_start']) ?></textarea>
				</div>
			</div>

			<div class="cs-box cs-callback-box">
				<h3 class="header">Cute.SliderEvent.CHANGE_END</h3>
				<div class="inner">
					<textarea name="api_change_end" cols="20" rows="5"><?php echo stripslashes($slider['properties']['api_change_end']) ?></textarea>
				</div>
			</div>

			<div class="cs-box cs-callback-box side">
				<h3 class="header">Cute.SliderEvent.WATING</h3>
				<div class="inner">
					<textarea name="api_wating" cols="20" rows="5"><?php echo stripslashes($slider['properties']['api_wating']) ?></textarea>
				</div>
			</div>

			<div class="cs-box cs-callback-box">
				<h3 class="header">Cute.SliderEvent.CHANGE_NEXT_SLIDE</h3>
				<div class="inner">
					<textarea name="api_change_next" cols="20" rows="5"><?php echo stripslashes($slider['properties']['api_change_next']) ?></textarea>
				</div>
			</div>

			<div class="cs-box cs-callback-box">
				<h3 class="header">Cute.SliderEvent.WATING_FOR_NEXT</h3>
				<div class="inner">
					<textarea name="api_waiting_next" cols="20" rows="5"><?php echo stripslashes($slider['properties']['api_waiting_next']) ?></textarea>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<div class="cs-box cs-publish">
		<h3 class="header"><?php _e('Publish', 'CuteSlider') ?></h3>
		<div class="inner">
			<button class="button-primary"><?php _e('Save changes', 'CuteSlider') ?></button>
			<p class="cs-saving-warning"></p>
			<div class="clear"></div>
		</div>
	</div>

	<script type="text/javascript">
		<?php if(function_exists( 'wp_enqueue_media' )) { ?>
		var newMediaUploader = true;
		<?php } else { ?>
		var newMediaUploader = false;
	<?php } ?>
	</script>
</form>