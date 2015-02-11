<?php

	if(empty($_POST['tp_photo_gallery_hidden']))
		{
					
			$tp_light_gallery_custom_photo_width = get_option( 'tp_light_gallery_custom_photo_width' );
			$tp_light_gallery_custom_photo_height = get_option( 'tp_light_gallery_custom_photo_height' );
			$tp_light_gallery_custom_photo_bg_color = get_option( 'tp_light_gallery_custom_photo_bg_color' );
			$tp_light_gallery_custom_photo_top_width = get_option( 'tp_light_gallery_custom_photo_top_width' );
			$tp_light_gallery_custom_photo_top_height = get_option( 'tp_light_gallery_custom_photo_top_height' );
		}

	else
		{
		
		if($_POST['tp_photo_gallery_hidden'] == 'Y')
			{
			//Form data sent

				
			$tp_light_gallery_custom_photo_width = $_POST['tp_light_gallery_custom_photo_width'];
			update_option('tp_light_gallery_custom_photo_width', $tp_light_gallery_custom_photo_width);
						
			$tp_light_gallery_custom_photo_height = $_POST['tp_light_gallery_custom_photo_height'];
			update_option('tp_light_gallery_custom_photo_height', $tp_light_gallery_custom_photo_height);
			
			$tp_light_gallery_custom_photo_top_width = $_POST['tp_light_gallery_custom_photo_top_width'];
			update_option('tp_light_gallery_custom_photo_top_width', $tp_light_gallery_custom_photo_top_width);
						
			$tp_light_gallery_custom_photo_top_height = $_POST['tp_light_gallery_custom_photo_top_height'];
			update_option('tp_light_gallery_custom_photo_top_height', $tp_light_gallery_custom_photo_top_height);
			
			$tp_light_gallery_custom_photo_bg_color = $_POST['tp_light_gallery_custom_photo_bg_color'];
			update_option('tp_light_gallery_custom_photo_bg_color', $tp_light_gallery_custom_photo_bg_color);
			
			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.' ); ?></strong></p>
            </div>
      
            
<?php
			}
		} 
?>


<div class="wrap">
<?php echo "<h2>".__('Custom Photo Gallery Settings')."</h2>";?>

<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="tp_photo_gallery_hidden" value="Y">
        <?php settings_fields( 'tp_custom_gallery_options_setting' );
				do_settings_sections( 'tp_custom_gallery_options_setting' );
		?>
			<table class="form-table">
                <tr valign="top">
                    <th scope="row">Use this Shortcode:
                    </th>
                    <td style="vertical-align:middle;">
                        <input  type="text" name="light_gallery_shortcode" onClick="this.select();" size="auto" id="light_gallery-shortcode"  value ="[custom-photo-gallery]"><br> <span style="font-size:12px;color:#22aa5d">** Use this shortcode to display custom photo gallery wordpress **</span>
                    </td>
                </tr>
                
           		 <tr valign="top">
					<th scope="row"><label for="tp_light_gallery_custom_photo_width">Width</label></th>
					<td style="vertical-align:middle;">
<input  size='10' name='tp_light_gallery_custom_photo_width' placeholder="0" class='light-gallery-option-width' id="light-gallery-width" type='text' value='<?php echo esc_attr($tp_light_gallery_custom_photo_width); ?>' />px<br/>
<span style="font-size:12px;color:#22aa5d">select custom photo gallery wordpress width. default width 0px.</span>
					</td>
				</tr>
                
				<tr valign="top">
					<th scope="row"><label for="tp_light_gallery_custom_photo_height">Height</label></th>
					<td style="vertical-align:middle;">
<input  size='10' name='tp_light_gallery_custom_photo_height' placeholder="0" class='light-gallery-option-height' id="light-gallery-height" type='text' value='<?php echo esc_attr($tp_light_gallery_custom_photo_height); ?>' />px<br>
<span style="font-size:12px;color:#22aa5d">select custom photo gallery wordpress height. default height 0px.</span>
					</td>
				</tr>
  				<tr valign="top">
					<th scope="row"><label for="tp_light_gallery_custom_photo_bg_color">Gallery Background</label></th>
					<td style="vertical-align:middle;">
<input  size='10' name='tp_light_gallery_custom_photo_bg_color' placeholder="bg-color" class='light-gallery-option-color' type='text' id="light-gallery-option-color" value='<?php echo esc_attr($tp_light_gallery_custom_photo_bg_color); ?>' /><br />
<span style="font-size:12px;color:#22aa5d">select custom photo gallery wordpress background color. default background color: none.</span>
					</td>
				</tr>
                
           		 <tr valign="top">
					<th scope="row"><label for="tp_light_gallery_custom_photo_top_width">Image Width</label></th>
					<td style="vertical-align:middle;">
<input  size='10' name='tp_light_gallery_custom_photo_top_width' placeholder="185" class='light-gallery-top-width' id="light-gallery-top-width" type='text' value='<?php echo esc_attr($tp_light_gallery_custom_photo_top_width); ?>' />px<br>
<span style="font-size:12px;color:#22aa5d">select custom photo gallery wordpress images width.default image width 185px.</span>
					</td>
				</tr>
                
           		<tr valign="top">
					<th scope="row"><label for="tp_light_gallery_custom_photo_top_height">Image Height</label></th>
					<td style="vertical-align:middle;">
<input  size='10' name='tp_light_gallery_custom_photo_top_height' placeholder="70" class='light-gallery-option-top-height' id="kt_light_gallery-top-height" type='text' value='<?php echo esc_attr($tp_light_gallery_custom_photo_top_height); ?>' />px<br>
<span style="font-size:12px;color:#22aa5d">select custom photo gallery wordpress images height. default image height 70px.</span>
					</td>
				</tr>

			</table>
			<p class="submit">
				<input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes' ) ?>" />
			</p>

</form>
			<script>
            jQuery(document).ready(function(jQuery)
                {	
                jQuery('#light-gallery-option-color').wpColorPicker();
                });
            </script> 

</div>