<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.0.0
 **/
####################################################################################################





/**
 * ClassNameWP
 * @since 0.0.0
 **/
class ClassNameWP {



	/**
	 * optionName
	 *
	 * @access public
	 * @var string
	 * @since 0.0.0
	 **/
	var $optionName = false;



	/**
	 * errors
	 *
	 * @access public
	 * @var array
	 * @since 0.0.0
	 **/
	var $errors = array();



	/**
	 * haveErrors
	 *
	 * @access public
	 * @var bool
	 * @since 0.0.0
	 **/
	var $haveErrors = 0;






	/**
	 * __construct
	 * @since 0.0.0
	 **/
	function __construct() {

		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );
		// add_action( 'init', array( &$this, 'init' ) );
		// add_action( 'admin_init', array( &$this, 'admin_init' ) );

	} // end function __construct






	/**
	 * after_setup_theme
	 * @since 0.0.0
	 **/
	function after_setup_theme() {

		//

	} // end function after_setup_theme






	/**
	 * init
	 * @since 0.0.0
	 **/
	function init() {

        //

	} // end function init






	/**
	 * admin_init
	 * @since 0.0.0
	 **/
	function admin_init() {

		//

	} // end function admin_init






	/**
	 * set
	 * @since 0.0.0
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set






	/**
	 * error
	 * @since 0.0.0
	 **/
	function error( $errorKey ) {

		$this->errors[] = $errorKey;

	} // end function error






	/**
	 * get
	 * @since 0.0.0
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
	 * exampleFunction
	 * @since 0.0.0
	 **/
	function exampleFunction() {

		// exampleFunction

	} // end function exampleFunction






	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################






	/**
	 * haveErrors
	 * @since 0.0.0
	 **/
	function haveErrors() {

		if ( isset( $this->errors ) AND ! empty( $this->errors ) AND is_array( $this->errors ) ) {
			$this->set( 'haveErrors', 1 );
		} else {
			$this->set( 'haveErrors', 0 );
		}

		return $this->haveErrors;

	} // end function haveErrors



} // end class ClassNameWP
