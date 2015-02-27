<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * 
 * Note: This file requires $_POST['nonce'], $_POST['case'], DOING_AJAX and is written to 
 * be ran from the wordpress admin-ajax.php system.
 **/
####################################################################################################




/**
 * AjaxGeneral
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$AjaxGeneral = new AjaxGeneral();
class AjaxGeneral {
	
	
	
	/**
	 * status
	 * 
	 * @access public
	 * @var string
	 **/
	var $status = 'error';
	
	
	
	/**
	 * message
	 * 
	 * @access public
	 * @var string
	 **/
	var $message = 'Invalid ajax call';
	
	
	
	
	
	
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
	function __construct() {
		
		$this->set( 'settings', new SettingsClassHere() );
		$this->set( 'action', $this->settings->action );
		
		add_action( "wp_ajax_$this->action", array( &$this, 'do_ajax' ) );
		add_action( "wp_ajax_nopriv_$this->action", array( &$this, 'do_ajax' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * set
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * error
	 **/
	function error( $error_key ) {
		
		$this->errors[] = $error_key;
		
	} // end function error
	
	
	
	
	
	
	/**
	 * set__response
	 *
	 * Description:
	 * This function is used to add a new key=value
	 * pair to the response variable. The response variable
	 * is echoed at the end of the process with json_encode.
	 * Any key=value pair added to the response will be available
	 * in the jQuery response.
	 **/
	function set__response( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->response[$key] = $val;
		}
		
	} // end function set__response
	
	
	
	
	
	
	/**
	 * set__case
	 **/
	function set__case() {
		
		if ( isset( $_POST['case'] ) AND ! empty( $_POST['case'] ) ) {
			$this->set( 'case', $_POST['case'] );
		}
		
	} // end function set__case 
	
	
	
	
	
	
	/**
	 * set__response_html
	 **/
	function set__response_html( $val ) {
		
		if ( isset( $val ) AND ! empty( $val ) ) {
			if ( ! isset( $this->response['html'] ) OR empty( $this->response['html'] ) ) {
				$this->set__response( 'html', $val );
			} else {
				$this->response['html'] = $this->response['html'] . $val;
			}
		}
		
	} // end function set__response_html
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * do_ajax
	 **/
	function do_ajax() {
		
		if ( $this->is_doing_ajax() ) {
			$this->check_required_paramaters();
			
			if ( ! $this->have_errors() ) {
				$this->set__case();
				$this->set( '_request', $_POST );
				
				switch ( $this->case ) {
					
					case "process-some-code" :
						$this->process_some_code();
						break;
					
				} // end switch
			
			} // end ! have_errors
			
			if ( $this->have_errors() ) {
				$this->set__response( 'errors', $this->errors );
				wp_send_json_error( $this->response );
			} else {
				wp_send_json_success( $this->response );
			}
		
		} // end is_doing_ajax
		
	} // end function do_ajax
	
	
	
	
	
	
	/**
	 * process_some_code
	 **/
	function process_some_code() {
		
		if ( $do_some_code ) {
			
			$this->set__response( 'message', 'success text message goes here' );
			
			$this->set__response_html( 'Put html here.' );
			$this->set__response_html( ' Then append more html after that!' );
			
		} else {
			
			$this->error('error-id-here');
			$this->set__response( 'message', 'error text message goes here' );
			
		}
		
	} // end function process_some_code
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_errors
	 **/
	function have_errors() {
		
		if ( isset( $this->errors ) AND ! empty( $this->errors ) AND is_array( $this->errors ) ) {
			$this->set( 'have_errors', 1 );
		} else {
			$this->set( 'have_errors', 0 );
		}
		
		return $this->have_errors;
		
	} // end function have_errors
	
	
	
	
	
	
	/**
	 * check_required_paramaters
	 **/
	function check_required_paramaters() {
		
		if ( ! $this->have_case() ) {
			$this->error('no-case');
			$this->set__response( 'message', 'missing required parameters' );
		}
		
		if ( ! $this->have_nonce() ) {
			$this->error('no-nonce');
			$this->set__response( 'message', 'missing required parameters' );
		}
		
	} // end function check_required_paramaters
	
	
	
	
	
	
	/**
	 * is_doing_ajax
	 **/
	function is_doing_ajax() {
		
		if ( defined( 'DOING_AJAX') AND DOING_AJAX ) {
			$this->set( 'is_doing_ajax', 1 );
		} else {
			$this->set( 'is_doing_ajax', 0 );
		}
		
		return $this->is_doing_ajax;
	
	} // end function is_doing_ajax 
	
	
	
	
	
	
	/**
	 * have_case
	 **/
	function have_case() {
		
		if ( isset( $_POST['case'] ) AND ! empty( $_POST['case'] ) ) {
			$this->set( 'have_case', 1 );
		} else {
			$this->set( 'have_case', 0 );
		}
		
		return $this->have_case;
	
	} // end function have_case
	
	
	
	
	
	
	/**
	 * have_nonce
	 **/
	function have_nonce() {
		
		if ( isset( $_POST['nonce'] ) AND ! empty( $_POST['nonce'] ) AND wp_verify_nonce( $_POST['nonce'], $this->action ) ) {
			$this->set( 'have_nonce', 1 );
		} else {
			$this->set( 'have_nonce', 0 );
		}
		
		return $this->have_nonce;
	
	} // end function have_nonce
	
	
	
} // end class AjaxGeneral