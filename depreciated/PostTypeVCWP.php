<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.0
 **/
####################################################################################################





/**
 * PostTypeVCWP
 **/
class PostTypeVCWP {
	
	/**
	 * Post type array
	 *
	 * @since 1.6
	 * @access public
	 * @var array
	 */
	var $post_type = 0;
	
	/**
	 * Post type query var
	 *
	 * @since 1.6
	 * @access public
	 * @var string
	 */
	var $_post_type = 0;
	
	/**
	 * Post type query var
	 *
	 * @since 1.6
	 * @access public
	 * @var string
	 */
	var $have_post_type = 0;
	
	/**
	 * The registered post type object, or an error object
	 *
	 * @since 1.6
	 * @access public
	 * @var object
	 */
	var $registered_post_type = 0;
	
	/**
	 * Continue loading script
	 *
	 * @since 1.6
	 * @access public
	 * @var bool
	 */
	var $continue = 1;
	
	
	
	
	
	
	/**
	 * register_post_type
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function register_post_type( $args ) {
		
		$this->set_args( $args );
		$this->process_post_type();
		
		return $this;

	} // end function register_post_type
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set 
	
	
	
	
	
	
	/**
	 * set_args
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function set_args( $args ) {
		
		if ( isset( $args ) AND ! empty( $args ) AND is_array( $args ) ) {
			foreach ( $args as $k => $v ) {
				$this->set( $k, $v );
			}
		}
		
	} // end function set_args
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * process_post_type
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function process_post_type() {
		
		if ( $this->have_post_type() ) {
			$this->set( '_post_type', $this->post_type['query_var'] );
			$this->_register_post_type();
		}
		
	} // end function process_post_type
	
	
	
	
	
	
	/**
	 * register_post_type
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function _register_post_type() {
		
		$this->registered_post_type = register_post_type( $this->_post_type, $this->post_type );
		
	} // end function register_post_type 
	
	
	
	
	
	
	/**
	 * Add External Metaboxes
	 * 
	 * @version 1.1
	 * @updated	03.22.13
	 * 
	 * Description:
	 * Works in conjunction with existing filter used with in
	 * post-meta-vc.php. It will add the post type to the metabox
	 * that is being specified.
	 **/
	function add_external_metaboxes( $post_types ) {
		
		$post_types[] = $this->_post_type;
		return $post_types;
		
	} // end function add_external_metaboxes
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_post_type
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function have_post_type() {
		
		if ( is_array( $this->post_type ) AND ! empty( $this->post_type ) AND isset( $this->post_type['query_var'] ) AND ! empty( $this->post_type['query_var'] ) ) {
			$this->set( 'have_post_type', 1 );
		} else {
			$this->set( 'have_post_type', 0 );
		}
		
		return $this->have_post_type;
		
	} // end function have_post_type
	
	
	
} // end class PostTypeVCWP