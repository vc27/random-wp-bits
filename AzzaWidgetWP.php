<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * AzzaWidgetWP
 **/
class AzzaWidgetWP extends WP_Widget {
	
	
	
	/**
	 * name
	 * 
	 * @access public
	 * @var string
	 **/
	var $name = null;
	
	
	
	/**
	 * id
	 * 
	 * @access public
	 * @var string
	 **/
	var $id = 'unique_css_id';
	
	
	
	/**
	 * control_ops
	 * 
	 * @access public
	 * @var array
	 **/
	var $control_ops = array();
	
	
	
	/**
	 * widget_ops
	 * 
	 * @access public
	 * @var array
	 **/
	var $widget_ops = array();
	
	
	
	
	
	
	/**
	 * __construct
	 **/
	function __construct() {
		
		$this->set( 'name', __( 'Widget Name', 'parenttheme' ) );
		$this->set( 'control_ops', array(
			'id_base' => $this->id
		) );
		$this->set( 'widget_ops', array(
			'classname' => $this->id
			,'description' => __( 'Desription.', 'parenttheme' )
		) );
		$this->WP_Widget( $this->id, $this->name, $this->widget_ops, $this->control_ops );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * set
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
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['value'] = $new_instance['value'];
		
		return $instance;
	
	} // end function update
	
	
	
	
	
	
	/**
	 * Widget Form
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