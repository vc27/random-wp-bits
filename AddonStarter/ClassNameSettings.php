<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.0.0
 **/
####################################################################################################





/**
 * ClassNameSettings
 * @since 0.0.0
 **/
class ClassNameSettings {



	/**
	 * optionName
	 *
	 * @access public
	 * @var string
	 * @since 0.0.0
	 **/
	var $optionName = false;






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



} // end class ClassNameSettings
