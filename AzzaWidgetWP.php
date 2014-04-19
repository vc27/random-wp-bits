<?php
/**
 * File Name AzzaWidgetWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * AzzaWidgetWP
 *
 * @version 1.0
 * @updated 00.00.00
 **/
class AzzaWidgetWP extends WP_Widget {
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {
		
		$this->set( 'name', __( 'Widget Name', 'parenttheme' ) );
		$this->set( 'id', 'unique_css_id' );
		
		$this->set( 'control_ops', array(
			// 'width' => 400,
			// 'height' => 350,
			'id_base' => $this->id
			) );
		
		$this->set( 'widget_ops', array(
			'classname' => $this->id,
			'description' => __( 'Desription.', 'parenttheme' )
			) );
		
		
		$this->WP_Widget( $this->id, $this->name, $this->widget_ops, $this->control_ops );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Widget 
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function widget( $args, $instance ) {
		// $args
		// $instance
		
		
	   	// display
		
	} // end function widget
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Admin
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Update Widget data
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['value'] = $new_instance['value'];
		
		return $instance;
	
	} // end function update
	
	
	
	
	
	
	/**
	 * Widget Form
	 *
	 * @version 1.1
	 * @updated 07.16.13
	 **/
	/*function form( $instance ) {
		
		//Defaults
		$defaults = array(
			'defaults' => __( 'Text', 'parenttheme' ),
			);
		
		$r = wp_parse_args( $instance, $defaults );
		extract( $r, EXTR_SKIP );
		
		
		// Get pages
		$pages = get_pages();
		
		
		?>
		<!-- Text Title
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Text Title:', 'parenttheme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('text_title'); ?>" type="text" value="<?php echo $text_title; ?>" />
		</p>
		-->
		<?php
	
	
	} // end function form*/
	
	
	
} // end class AzzaWidgetWP