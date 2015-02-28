<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.0.0
 **/
####################################################################################################





/**
 * ClassName
 * @since 0.0.0
 **/
class ClassName {



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

	} // end function __construct






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



} // end class ClassName
