<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * FeaturedImageFormSelectWP
 **/
class FeaturedImageFormSelectWP {
	
	
	function __construct( $args = array() ) {
		global $_wp_additional_image_sizes;
		
		$defaults = array(
			'val' => '',
			'id' => '',
			'name' => '',
			'attr' => false,
		);
		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		if ( isset( $_wp_additional_image_sizes ) AND is_array( $_wp_additional_image_sizes ) AND ! empty( $_wp_additional_image_sizes ) ) {
			echo "<select id=\"$id\" name=\"$name\" $attr>";
				echo "<option value=\"\">" . __( 'Select an Image Size', 'parenttheme' ) . "</option>";
				foreach ( $_wp_additional_image_sizes as $name => $attr ) {
					if ( $val == $name ) {
						$sel = 'selected="selected"';
					} else {
						$sel = '';
					}
					echo "<option $sel value=\"" . $featured_images->post->post_name . "\">";
					 	echo $name . " " . $attr['width'] . "x" . $attr['height'];
						if ( isset( $attr['crop'] ) AND $attr['crop'] == 1 ) {
							echo " cropped";
						}
					echo "</option>";
				}
			echo "</select>";
		} else {
			echo __( "There are no featured image sizes available.", 'parenttheme' );
		}

	} // end function featured_image__form_select
	
	
	
} // end class FeaturedImageFormSelectWP