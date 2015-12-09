<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.0.0
 **/
####################################################################################################





/**
 * ACFWP
 * @since 0.0.0
 **/
class ACFWP {



	/**
	 * Option name
	 *
	 * @access public
	 * @var string
	 * @since 0.0.0
	 **/
	var $option_name = false;



	/**
	 * errors
	 *
	 * @access public
	 * @var array
	 * @since 0.0.0
	 **/
	var $errors = array();



	/**
	 * have_errors
	 *
	 * @access public
	 * @var bool
	 * @since 0.0.0
	 **/
	var $have_errors = 0;






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
	function error( $error_key ) {

		$this->errors[] = $error_key;

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
	 * get_image
	 * @since 0.0.0
	 **/
	static function get_image( $meta_key, $post_id, $size ) {

		$image = get_field( $meta_key, $post_id );
		return self::return_image($image, $size);

	} // end function get_image






	/**
	 * return_image
	 * @since 0.0.0
	 **/
	static function return_image( $image, $size ) {

		if (
			isset( $image['sizes'] )
			AND is_array( $image['sizes'] )
			AND isset( $image['sizes'][$size] )
			AND ! empty( $image['sizes'] )
		) {
			return $image['sizes'][$size];
		} else if ( isset( $image['url'] ) AND ! empty( $image['url'] ) ) {
			return $image['url'];
		} else {
			return false;
		}

	} // end function return_image






	/**
	 * get_sub_field
	 * @since 0.0.0
	 **/
	static function get_sub_field( $field_value, $key ) {

		if (
			isset( $field_value )
			AND ! empty( $field_value )
			AND isset( $key )
			AND ! empty( $key )
			AND isset( $field_value[$key] )
			AND ! empty( $field_value[$key] )
		) {
			return $field_value[$key];
		} else {
			return false;
		}

	} // end static function get_sub_field






	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################






	/**
	 * have_errors
	 * @since 0.0.0
	 **/
	function have_errors() {

		if ( isset( $this->errors ) AND ! empty( $this->errors ) AND is_array( $this->errors ) ) {
			$this->set( 'have_errors', 1 );
		} else {
			$this->set( 'have_errors', 0 );
		}

		return $this->have_errors;

	} // end function have_errors



} // end class ACFWP
