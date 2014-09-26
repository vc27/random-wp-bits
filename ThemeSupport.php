<?php
/**
 * File Name ThemeSupport.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * ThemeSupport
 **/
$ThemeSupport = new ThemeSupport();
class ThemeSupport {
	
	
	
	/**
	 * appName
	 * 
	 * @access public
	 * @var string
	 **/
	var $appName = 'projectApp';
	
	
	
	
	
	
	/**
	 * __construct
	 **/
	function __construct() {
		
		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );
		// add_action( 'init', array( &$this, 'init' ) );
		// add_action( 'admin_init', array( &$this, 'admin_init' ) );
		// add_action( 'wp', array( &$this, 'wp' ) );
		// add_action( 'widgets_init', array( &$this, 'widgets_init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 **/
	function after_setup_theme() {
		
		
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 **/
	function init() {
		
		
		
	} // end function init
	
	
	
	
	
	
	/**
	 * admin_init
	 **/
	function admin_init() {
		
		// 
		
	} // end function admin_init
	
	
	
	
	
	
	/**
	 * wp
	 **/
	function wp() {
		
		
		
	} // end function wp
	
	
	
	
	
	
	/**
	 * Widgets Initiate
	 **/
	function widgets_init() {
		
		// register_widget( 'TwitterWidgetVCWP' );
		
	} // end function widgets_init
	
	
	
	
	
	
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
	
	
	
	
	
	
	/**
	 * get
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get( $key ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}
		
	} // end function get
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * function_name
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function function_name() {
		
		// function_name
		
	} // end function function_name
	
	
	
	
	
	
	####################################################################################################
	/**
	 * static
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * static_function_name
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	static function static_function_name() {

		// 
		
	} // end function static_function_name
	
	
	
} // end class ThemeSupport