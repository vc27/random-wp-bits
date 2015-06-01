<?php
/**
 * File Name GetRemoteDataWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * GetRemoteDataWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
class GetRemoteDataWP {



	/**
	 * transient_timeout
	 *
	 * @access public
	 * @var int
	 **/
	var $transient_timeout = 86400;



	/**
	 * transient_timeout__filter_name
	 *
	 * @access public
	 * @var string
	 **/
	var $transient_timeout__filter_name = 'vc-remote_data-transient_timeout';



	/**
	 * set__data__filter_name
	 *
	 * @access public
	 * @var string
	 **/
	var $set__data__filter_name = 'vc_remote_fetch_data';



	/**
	 * extract_data__filter_name
	 *
	 * @access public
	 * @var string
	 **/
	var $extract_data__filter_name = 'vc_remote_extract_data';



	/**
	 * is_wp_error
	 *
	 * @access public
	 * @var bool
	 **/
	var $is_wp_error = 0;



	/**
	 * error
	 *
	 * @access public
	 * @var mix
	 **/
	var $error = 0;



	/**
	 * type
	 *
	 * @access public
	 * @var string
	 **/
	var $type = null;



	/**
	 * have_type
	 *
	 * @access public
	 * @var bool
	 **/
	var $have_type = 0;



	/**
	 * url
	 *
	 * @access public
	 * @var string
	 **/
	var $url = null;



	/**
	 * have_url
	 *
	 * @access public
	 * @var bool
	 **/
	var $have_url = 0;



	/**
	 * args
	 *
	 * @access public
	 * @var array
	 **/
	var $args = array();



	/**
	 * transient_name
	 *
	 * @access public
	 * @var string
	 **/
	var $transient_name = 0;



	/**
	 * have_transient_name
	 *
	 * @access public
	 * @var bool
	 **/
	var $have_transient_name = 0;



	/**
	 * is_transient_set
	 *
	 * @access public
	 * @var bool
	 **/
	var $is_transient_set = 0;



	/**
	 * reset_transient
	 *
	 * @access public
	 * @var bool
	 **/
	var $reset_transient = 0;



	/**
	 * transient_is_reset
	 *
	 * @access public
	 * @var bool
	 **/
	var $transient_is_reset = 0;



	/**
	 * response
	 *
	 * @access public
	 * @var array
	 **/
	var $response = array();



	/**
	 * have_response
	 *
	 * @access public
	 * @var bool
	 **/
	var $have_response = 0;



	/**
	 * headers
	 *
	 * @access public
	 * @var array
	 **/
	var $headers = array();



	/**
	 * have_headers
	 *
	 * @access public
	 * @var bool
	 **/
	var $have_headers = 0;



	/**
	 * have_data
	 *
	 * @access public
	 * @var bool
	 **/
	var $have_data = 0;



	/**
	 * content_type
	 *
	 * @access public
	 * @var string
	 **/
	var $content_type = 0;



	/**
	 * have_content_type
	 *
	 * @access public
	 * @var bool
	 **/
	var $have_content_type = 0;



	/**
	 * data
	 *
	 * @access public
	 * @var mix
	 **/
	var $data = 0;






	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		//

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






	/**
	 * set__sanitize
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__sanitize( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = sanitize_title_with_dashes( $val );
		}

	} // end function set__sanitize






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






	/**
	 * set__data__transient
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__data__transient() {

		if ( $this->have_transient_name() ) {

			$this->set( 'data', get_transient( $this->transient_name ) );

			if ( $this->data === false ) {
				$this->set( 'have_transient_data', 0 );
			} else {
				$this->set( 'have_transient_data', 1 );
			}

		} else {

			$this->set( 'have_transient_data', 0 );
		}

	} // end function set__data__transient






	/**
	 * set__data
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__data() {

		switch ( $this->type ) {

			case "get" :
				$this->set( 'data', wp_remote_get( $this->url, $this->args ) );
				break;
			case "post" :
				$this->set( 'data', wp_remote_post( $this->url, $this->args ) );
			default :
				$this->set( 'data', apply_filters( $this->set__data__filter_name, $this->url, $this->args ) );
				break;

		} // end switch

	} // end function set__data






	/**
	 * set__wp_error
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__wp_error() {

		if ( is_wp_error( $this->data ) ) {

			$this->set( 'is_wp_error', 1 );
			$this->set( 'error', $this->data );
			$this->set( 'data', 0 );
			$this->set( 'have_data', 0 );

		} else {

			$this->set( 'is_wp_error', 0 );
			$this->set( 'have_data', 1 );

		}

	} // end function set__wp_error






	/**
	 * set__response
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__response( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->response[$key] = $val;
		}

	} // end function set__response






	/**
	 * set_content_type
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set_content_type() {

		if ( isset( $this->data['headers']['content-type'] ) AND ! empty( $this->data['headers']['content-type'] ) ) {

			// e.g. = application/json; charset=utf-8
			$this->set( 'content_type', explode( '/', $this->data['headers']['content-type'] ) );

			// e.g. = json; charset=utf-8
			if ( isset( $this->content_type[1] ) AND ! empty( $this->content_type[1] ) ) {
				$this->set( 'content_type', explode( ';', $this->content_type[1] ) );

				if ( isset( $this->content_type[0] ) AND ! empty( $this->content_type[0] ) ) {
					$this->set( 'content_type', $this->content_type[0] );
				} else {
					$this->set( 'content_type', 0 );
				}

			} else {
				$this->set( 'content_type', 0 );
			}

		}

	} // end function set_content_type






	/**
	 * set__headers
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__headers() {

		if ( isset( $this->data['headers'] ) AND ! empty( $this->data['headers'] ) ) {

			$this->set( 'headers', $this->data['headers'] );

		}

	} // end function set__headers






	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################






	/**
	 * Fetch Data
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function fetch_data( $type, $url, $args = array(), $transient_name = false, $reset_transient = false ) {

		$this->set__sanitize( 'type', $type );
		$this->set( 'url', $url );

		if ( $this->have_type() AND $this->have_url() ) {

			$this->set( 'args', $args );
			$this->set( 'transient_name', $transient_name );
			$this->set( 'reset_transient', $reset_transient );

			$this->set__data__transient();

			if ( ! $this->have_transient_data ) {

				$this->set__data();

				if ( is_wp_error( $this->data ) ) {

					$this->set__wp_error();

				} else if ( $this->have_data() ) {

					$this->extract_data();
					$this->set( 'response', apply_filters( $this->extract_data__filter_name, $this->response ) );

					// set__transient
					if ( $this->have_transient_name() ) {
						$this->set( 'is_transient_set', set_transient( $this->transient_name, $this->data, apply_filters( $this->transient_timeout__filter_name, $this->transient_timeout ) ) );
					} else {
						$this->set( 'is_transient_set', 0 );
					}

				}

			}

		}

	} // end function fetch_data






	/**
	 * reset_transient
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function reset_transient() {

		if ( $this->have_transient_name() AND $this->is_reset_transient() ) {
			$this->set( 'transient_is_reset', delete_transient( $this->transient_name ) );
		}

	} // end function reset_transient






	/**
	 * extract_data
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function extract_data() {


		if ( 200 != wp_remote_retrieve_response_code( $this->data ) ) {

			$this->set__response( 'message', wp_remote_retrieve_response_message( $this->data ) );
			$this->set__response( 'status', wp_remote_retrieve_response_code( $this->data ) );

		} else if ( ! wp_remote_retrieve_body( $this->data ) ) {

			$this->set__response( 'message', 'Unregistered Error' );
			$this->set__response( 'status', 'error' );
			$this->set__response( 'body', $this->data );

		} else {

			$this->set( 'body', wp_remote_retrieve_body( $this->data ) );
			$this->set__response( 'message', 'Data was received.' );
			$this->set__response( 'status', 'success' );

			$this->set_content_type();

			if ( $this->have_content_type() ) {

				$this->set__headers();
				$this->have_headers();

				switch ( $this->content_type ) {

					case "x-JavaScript" :
					case "json" :
						$this->set__response( 'content_type', 'json' );
						$this->_parse_json();
						break;
					case "xml" :
						$this->set__response( 'content_type', 'xml' );
						$this->_parse_xml();
						break;
					default :
						$this->set__response( 'content_type', $this->content_type );
						$this->set__response( 'body', 'unregistered-content-type' );
						break;

				} // end switch ( $content_type )

			}

		}

	} // end function extract_data






	/**
	 * Parses a json response body.
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 */
	function _parse_json() {

		$this->set( 'data', json_decode( trim( $this->body ) ) );

		if ( $this->have_data() ) {

			if ( is_object( $this->data ) ) {
				$this->data = (array)$this->data;
			}

		} else {

			$this->set( 'data', 0 );
			$this->set( 'have_data', 0 );

		}

	} // end function _parse_json






	/**
	 * Parses an XML response body.
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 */
	function _parse_xml() {

		if ( function_exists('simplexml_load_string') ) {

			$errors = libxml_use_internal_errors( 'true' );
			$this->data = simplexml_load_string( utf8_encode($this->body), 'SimpleXMLElement', LIBXML_NOCDATA );
			libxml_use_internal_errors( $errors );

			if ( is_object( $this->data ) ) {
				$this->data = (array)$this->data;
			}

		} else {

			$this->set( 'data', 0 );
			$this->set( 'have_data', 0 );

		}

	} // end function _parse_xml






	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################






	/**
	 * have_transient_name
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_transient_name() {

		if ( isset( $this->transient_name ) AND ! empty( $this->transient_name ) ) {
			$this->set( 'have_transient_name', 1 );
		} else {
			$this->set( 'have_transient_name', 0 );
		}

		return $this->have_transient_name;

	} // end function have_transient_name






	/**
	 * is_reset_transient
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function is_reset_transient() {

		return $this->reset_transient;

	} // end function is_reset_transient






	/**
	 * have_type
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_type() {

		if ( isset( $this->type ) AND ! empty( $this->type ) ) {
			$this->set( 'have_type', 1 );
		} else {
			$this->set( 'have_type', 0 );
		}

		return $this->have_type;

	} // end function have_type






	/**
	 * have_url
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_url() {

		if ( isset( $this->url ) AND ! empty( $this->url ) ) {
			$this->set( 'have_url', 1 );
		} else {
			$this->set( 'have_url', 0 );
		}

		return $this->have_url;

	} // end function have_url






	/**
	 * have_data
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * Note:
	 * This check may not be complete. It's pretty weak at this point.
	 **/
	function have_data() {

		if ( isset( $this->data ) AND ! is_wp_error( $this->data ) AND ! empty( $this->data ) ) {
			$this->set( 'have_data', 1 );
		} else {
			$this->set( 'have_data', 0 );
		}

		return $this->have_data;

	} // end function have_data






	/**
	 * have_response
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_response() {

		if ( isset( $this->response ) AND is_array( $this->response ) AND ! empty( $this->response ) ) {
			$this->set( 'have_response', 1 );
		} else {
			$this->set( 'have_response', 0 );
		}

		return $this->have_response;

	} // end function have_response






	/**
	 * have_content_type
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_content_type() {

		if ( isset( $this->content_type ) AND ! is_array( $this->content_type ) AND ! empty( $this->content_type ) ) {
			$this->set( 'have_content_type', 1 );
		} else {
			$this->set( 'have_content_type', 0 );
		}

		return $this->have_content_type;

	} // end function have_content_type






	/**
	 * have_headers
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_headers() {

		if ( isset( $this->headers ) AND is_array( $this->headers ) AND ! empty( $this->headers ) ) {
			$this->set( 'have_headers', 1 );
		} else {
			$this->set( 'have_headers', 0 );
		}

		return $this->have_headers;
		
	} // end function have_headers




} // end class GetRemoteDataWP
