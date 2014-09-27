<?php
/**
 * File Name: 		cform-post_meta.php
 * @package			WordPress
 * @subpackage 		ParentTheme_VC
 * @license 		GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 		0.0.2
 * @updated: 		01.14.12
 **/
#################################################################################################### */






/**
 * Get cForm from based on form_id
 **/
function vc_cform( $form_id ) {
	global $wp_qeury;
	
	if ( !empty( $form_id ) ) {
		
		$cformsSettings = get_option('cforms_settings');
		$j = ( $form_id > 1 ) ? $form_id : '';
		$form = stripslashes( $cformsSettings['form' . $j]['cforms' . $j . '_fname'] );
		
		echo apply_filters( 'the_content', "<!--cforms name=\"$form\"-->" );
		
	} // end if ( !empty( $form_id ) )
	
} // end function vc_cform






/**
 * Initiate Custom Fields
 **/
add_action( 'init', 'init_cForm_VC', 1 );
function init_cForm_VC() {
	
	if ( function_exists( 'cforms_activate' ) )
		$cForm_VC = new cForm_VC();
	
} // end function init_cForm_VC






/**
 * CustomFields_VC Class
 **/
class cForm_VC extends ParentTheme_VC {
	
	
	
	/**
	 * cForm_VC Construct
	 **/
	function cForm_VC() {
		
		
		// Set Save Noncename
		$this->save_noncename	= "vc-custom_fields-cForm_meta_box";
		
		// Add Custom Meta Boxes
		add_action( 'add_meta_boxes', array( &$this, 'add_custom_meta_boxes' ) );
		
		// Save Post
		// add_action(	'pre_post_update', array( &$this, 'save_custom_fields_data' ) );
		add_action(	'save_post', array( &$this, 'save_custom_fields_data' ), 10, 2 );
		
		
		
	} // end function CustomFields_VC
	
	
	
	
	
	
	/**
	 * Add Custom Fields Meta Boxes
	 *
	 * @uses add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
	 **/
	function add_custom_meta_boxes( $post ) {
		
		add_meta_box( "$this->id_prefix-cForm_meta", 'cForms', array( &$this, 'cForm_meta_box' ), 'page', 'side', 'low');
		
	} // end function add_custom_meta_boxes
	
	
	
	
	
	
	/**
	 * Prep Custom Fields Array
	 **/
	function prep_custom_fields_array( $post, $new_instance ) {
		
		$instance['vc_cform_select']	= $new_instance['vc_cform_select'];
		
		return $instance;
		
	} // end function pre_custom_fields_array
	
	
	
	
	
	
	/**
	 * Page Meta Box
	 **/
	function cForm_meta_box( $post ) {
		
		// get the post meta data
		$vc_cform_select	= get_post_meta( $post->ID, 'vc_cform_select', true );
		$cformsSettings		= get_option('cforms_settings');
		$form_count			= $cformsSettings['global']['cforms_formcount'];

		?>
		
		<p>
			<label for="vc_cform_select"><?php _e('Select a Form'); ?></label>
			<select style="width:125px;" id="vc_cform_select" name="vc_cform_select">

			<?php
			for ( $i = 1; $i <= $form_count; $i++){
				$j   = ( $i > 1 ) ? $i : '';

				if ( $vc_cform_select == $i )
					$sel = 'selected="selected"';
				else
					$sel = '';

				echo "<option $sel value=\"$i\">" . stripslashes( $cformsSettings['form'.$j]['cforms'.$j.'_fname'] ) . "</option>";

			}

			?>

			</select>
		</p>
		
		<input type="hidden" name="<?php echo $this->save_noncename; ?>" id="<?php echo $this->save_noncename; ?>" value="<?php echo wp_create_nonce( plugin_basename(__FILE__) ); ?>" />
		
		<?php
		
	} // end function cForm_meta_box
	
	
	
	
	
	
	/**
	 * Update and add Meta data on save or pre_post_update
	 **/
	function save_custom_fields_data( $post_id, $post ) {
		
		// Varify nonce
		if ( !wp_verify_nonce( $_POST[$this->save_noncename], plugin_basename( __FILE__ ) ) )
			return $post_id;
		
		
		// Save
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
			return $post_id;
		
		
		// Restrict User
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
			
		
		// New
		$new_instance = $this->prep_custom_fields_array( $_POST );

		foreach ( $new_instance as $key => $val ) {

			$old = get_post_meta( $post_id, $key, true );
			if ( !empty( $val ) )
				update_post_meta( $post_id, $key, $val, $old );
			elseif ( empty( $val ) )
				delete_post_meta( $post_id, $key, $val);

		} // end foreach ( $new as $key => $val )
		
		
	} // end function save_custom_meta_boxes
	
	
	
} // end class CustomFields_VC extends ParentTheme_VC