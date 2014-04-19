<?php
/**
 * File Name AjaxClassName.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 * 
 * Note: This file requires $_POST['nonce'], $_POST['case'], DOING_AJAX and is written to 
 * be ran from the wordpress admin-ajax.php system.
 **/
####################################################################################################




/**
 * AjaxClassName
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$AjaxClassName = new AjaxClassName();
class AjaxClassName {
	
	
	
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
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {
		
		$this->set( 'settings', new SettingsClassHere() );
		$this->set( 'action', $this->settings->action );
		
		add_action( "wp_ajax_$this->action", array( &$this, 'do_ajax' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 00.00.00
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
	 * @updated 00.00.00
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
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function set__case() {
		
		if ( isset( $_POST['case'] ) AND ! empty( $_POST['case'] ) ) {
			$this->set( 'case', $_POST['case'] );
		}
		
	} // end function set__case 
	
	
	
	
	
	
	/**
	 * set__response_html
	 *
	 * @version 1.0
	 * @updated 00.00.00
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
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function do_ajax() {
		
		$this->set__response( 'status', 'error' );
		$this->set__response( 'message', $this->msg__error_default );
		
		if ( $this->is_doing_ajax() ) {
			
			$this->set__response( 'message', $this->msg__error_nonce );
			
			if ( $this->have_case() AND $this->have_nonce() ) {
				$this->set__case();
				$this->set( '_request', $_POST );
				
				switch ( $this->case ) {
					
					case "show-more-artists" :
						$this->more_artists();
						break;
					
				} // end switch ( $_POST['case'] )
			
			} // end if varify
			
			header( 'Content: application/json' );
			echo json_encode( $this->response );

			die();
		
		} // end if DOING_AJAX
		
	} // end function do_ajax
	
	
	
	
	
	
	/**
	 * more_artists
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function more_artists() {
		
		if ( $this->have_page() ) {
			
			
			/**
			 * Note:
			 * Globalizing is required because this is the first 
			 * instance of the $wp_query since we are technically
			 * in the admin-ajax.php file.
			 **/
			global $wp_query, $post;
			
			
			
			/**
			 * Note:
			 * Extract $this->_request is actually extracting $_POST
			 * Any variable added to the jQuery.post parameters will be 
			 * available here to use. 
			 **/
			extract( $this->_request, EXTR_SKIP );
			
			
			
			/**
			 * Note:
			 * Utilize WP_Query by what ever mean necessary in combination
			 * with the extracted $this->_request variables to do a search.
			 **/
			$wp_query = new WP_Query();
			$wp_query->query( array(
				'paged' => $page,
				'post_type' => 'artists',
				'archive_ajax' => 1,
			) );
			
			$this->set__response( 'is_last_page', 0 );
			if ( $page == $wp_query->max_num_pages ) {
				$this->set__response( 'is_last_page', 1 );
			}			
			
			if ( have_posts() ) {
				
				$this->set__response( 'current_page', $page );
				$this->set__response( 'next_page', ( $page + 1 ) );
				$this->set__response( 'status', 'success' );
				$this->set__response( 'have_posts', 1 );
				$this->set__response( 'message', '<h3>Results found</h3>' );
				
				while ( have_posts() ) {
					the_post();
					
					$this->set__response_html( "<li>$post->post_title</li>" );
					
				} // end while ( have_posts() )
				
			} else {
				
				$this->set__response( 'current_page', $page );
				$this->set__response( 'status', 'success' );
				$this->set__response( 'have_posts', 0 );
				$this->set__response( 'message', '<h3>No posts found</h3>' );
				$this->set__response( 'html', '' );
				
			}
			
		} else {
			
			$this->set__response( 'status', 'error' );
			$this->set__response( 'message', 'put your special message here' );
			
		}
		
	} // end function more_artists
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_page
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_page() {
		
		if ( isset( $this->_request['page'] ) AND ! empty( $this->_request['page'] ) AND is_numeric( $this->_request['page'] ) AND $this->_request['page'] >= 2 ) {
			$this->set( 'have_page', 1 );
		} else {
			$this->set( 'have_page', 0 );
		}
		
		return $this->have_page;
	
	} // end function have_page
	
	
	
	
	
	
	/**
	 * is_doing_ajax
	 *
	 * @version 1.0
	 * @updated 00.00.00
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
	 *
	 * @version 1.0
	 * @updated 00.00.00
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
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_nonce() {
		
		if ( isset( $_POST['nonce'] ) AND ! empty( $_POST['nonce'] ) AND wp_verify_nonce( $_POST['nonce'], $this->action ) ) {
			$this->set( 'have_nonce', 1 );
		} else {
			$this->set( 'have_nonce', 0 );
		}
		
		return $this->have_nonce;
	
	} // end function have_nonce
	
	
	
} // end class AjaxClassName