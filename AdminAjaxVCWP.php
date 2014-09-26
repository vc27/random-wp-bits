<?php
/**
 * File Name AdminAjaxVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * AdminAjaxVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$AdminAjaxVCWP = new AdminAjaxVCWP();
class AdminAjaxVCWP {
	
	
	
	/**
	 * msg__default_error
	 * 
	 * @access public
	 * @var string
	 **/
	var $msg__error_default = 'Invalid ajax call';
	
	
	
	/**
	 * msg__default_error
	 * 
	 * @access public
	 * @var string
	 **/
	var $msg__error_nonce = 'Invalid nonce';
	
	
	
	/**
	 * action
	 * 
	 * @access public
	 * @var string
	 **/
	var $action = 'vc-admin-ajax';
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		// hook method admin_init
		add_action( 'admin_init', array( &$this, 'admin_init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * admin_init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
	 * 
	 * Description:
	 * admin_init is triggered before any other hook when a user access the admin area.
	 * This hook doesn't provide any parameters, so it can only be used to callback a 
	 * specified function.
	 **/
	function admin_init() {
		
		add_action( "wp_ajax_$this->action", array( $this, 'do_ajax' ) );
		
	} // end function admin_init
	
	
	
	
	
	
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
	 * set__case
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__case() {
		
		if ( isset( $_REQUEST['switch_case'] ) AND ! empty( $_REQUEST['switch_case'] ) ) {
			$this->set( 'case', $_REQUEST['switch_case'] );
		}
		
	} // end function set__case
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * do_ajax
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function do_ajax() {
		
		// Default Response
		$this->set__response( 'status', 'error' );
		$this->set__response( 'message', $this->msg__error_default );
		
		if ( $this->is_doing_ajax() ) {
			
			$this->set__response( 'message', $this->msg__error_nonce );
			
			if ( $this->have_switch_case() AND $this->have_nonce() ) {
				$this->set__case();
				$this->set( '_request', $_POST );
				
				switch ( $this->case ) {
					
					case "sortable-metadata" :
						$this->sortable_metadata();
						break;
					
				} // end switch ( $_POST['switch_case'] )
			
			} // end if varify
			
			header( 'Content: application/json' );
			echo json_encode( $this->response );

			die();
		
		} // end if DOING_AJAX
		
	} // end function do_ajax
	
	
	
	
	
	
	/**
	 * sortable_metadata
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function sortable_metadata() {
		
		extract( $this->_request, EXTR_SKIP );
		
		if ( isset( $list ) AND is_array( $list ) AND ! empty( $list ) ) {
			
			$old_array = get_post_meta( $save_point, $save_name, true );
			$new_array = $this->extract_new_list_sortable( "$save_name-sort-", $list, $old_array );
			$updated = update_post_meta( $save_point, $save_name, $new_array );
			
			if ( $updated ) {
				$this->set__response( 'status', 'success' );
				$this->set__response( 'message', 'List was accepted.' );
			} else {
				$this->set__response( 'status', 'error' );
				$this->set__response( 'message', 'update_post_meta failure' );
			}
			
		} else if ( isset( $sss ) ) {
			$this->set__response( 'status', 'error' );
			$this->set__response( 'message', 'list was not array' );
		}
		
	} // end function sortable_metadata
	
	
	
	
	
	
	/**
	 * Extract New List
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function extract_new_list_sortable( $str, $new_array, $old_array ) {
		
		if ( isset( $new_array ) AND is_array( $new_array ) AND ! empty( $new_array ) ) {
			
			foreach ( $new_array as $new_key => $old_key ) {
				
				$old_key = (int)str_replace( $str, '', $old_key );
				$new_array[$new_key] = $old_array[$old_key];
				
			}
			
		}
		
		return $new_array;
		
	} // end function extract_new_list_sortable
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * is_doing_ajax
	 *
	 * @version 1.0
	 * @updated 00.00.13
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
	 * have_switch_case
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_switch_case() {
		
		if ( isset( $_POST['switch_case'] ) AND ! empty( $_POST['switch_case'] ) ) {
			$this->set( 'have_switch_case', 1 );
		} else {
			$this->set( 'have_switch_case', 0 );
		}
		
		return $this->have_switch_case;
	
	} // end function have_switch_case
	
	
	
	
	
	
	/**
	 * have_nonce
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_nonce() {
		
		if ( isset( $_POST['nonce'] ) AND ! empty( $_POST['nonce'] ) AND wp_verify_nonce( $_POST['nonce'], $this->action ) ) {
			$this->set( 'have_nonce', 1 );
		} else {
			$this->set( 'have_nonce', 0 );
		}
		
		return $this->have_nonce;
	
	} // end function have_nonce
	
	
	
} // end class AdminAjaxVCWP