<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Description:
 **/
####################################################################################################



/**
 * Class_Name_WP
 * @since 1.0
 **/
class Class_Name_WP {

	/**
	 * public_get_key
	 *
	 * @access public
	 * @var string
	 * @since 1.0
	 **/
	private $public_get_key = 'public-key';

	/**
	 * public_get_val
	 *
	 * @access public
	 * @var string
	 * @since 1.0
	 **/
	private $public_get_val = 'mRGvz6Bwpf!tQc09WWAiJ*sbxrb7rSKE@Cj3KfjmZhs-daY9cqVos9';



	/**
	 * __construct
	 **/
	function __construct() {

	} // end function __construct



	####################################################################################################
	/**
	 * Set Get
	 **/
	####################################################################################################



	/**
	 * set
	 * @since 1.0
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set



	/**
	 * get
	 * @since 1.0
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
	 * @since 1.0
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
	 * have_key_and_password
	 * @since 1.0
	 **/
	function have_key_and_password() {

		if (
			isset( $_GET[$this->public_get_key] )
			AND ! empty( $_GET[$this->public_get_key] )
			AND $_GET[$this->public_get_key] === $this->public_get_val
		) {
			return true;
		} else {
			return false;
		}

	} // end function have_key_and_password



} // end class Class_Name_WP
