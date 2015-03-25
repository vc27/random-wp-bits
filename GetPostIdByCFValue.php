<?php
/**
 * File Name GetPostIdByCFValue.php
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * GetPostIdByCFValue
 *
 * @version 1.0
 * @updated 00.00.00
 **/
class GetPostIdByCFValue {



	/**
	 * queryStr
	 *
	 * @access public
	 * @var string
	 **/
	var $queryStr = null;



	/**
	 * results
	 *
	 * @access public
	 * @var object
	 **/
	var $results = null;



	/**
	 * postId
	 *
	 * @access public
	 * @var int
	 **/
	var $postId = 0;



	/**
	 * errors
	 *
	 * @access public
	 * @var array
	 **/
	var $errors = array();






	/**
	 * __construct
	 **/
	function __construct( $key, $value, $post_type = 'post', $post_status = 'publish' ) {
		global $wpdb;

		$this->set( 'queryStr', "	SELECT post_id
									FROM $wpdb->postmeta
									LEFT JOIN $wpdb->posts ON ($wpdb->postmeta.post_id = $wpdb->posts.ID)
									WHERE
										$wpdb->postmeta.meta_key = '$key'
										AND $wpdb->postmeta.meta_value = '$value'
										AND $wpdb->posts.post_status = '$post_status'
										AND $wpdb->posts.post_type = '$post_type'
									LIMIT 1
								" );


		$this->set( 'results', $wpdb->get_results( $this->queryStr ) );
		if ( isset( $this->results[0]->post_id ) AND is_numeric( $this->results[0]->post_id ) AND $this->results[0]->post_id >= 1 ) {
			$this->set( 'postId', $this->results[0]->post_id );
		} else {
			$this->set( 'postId', 0 );
		}

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
	 * example_function
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function example_function() {

		// sss

	} // end function example_function






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



} // end class GetPostIdByCFValue
