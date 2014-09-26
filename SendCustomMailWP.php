<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */






/**
 * SendCustomMailWP
 **/
class SendCustomMailWP {
	
	
	
	var $message = false;
	var $from_email = false;
	var $from_name = false;
	var $subject = '[default subject]';
	var $to_email = false;
	var $allow_html = true;
	
	var $headers = false;
	
	var $sent = 0;
	var $args = array();
	var $errors = array();
	var $_errors = array();
	var $has_errors = false;
	
	var $error_messages = array(
		'message' => 'The email was missing a message.',
		'from_email' => 'There was no to-email.',
		'from_name' => 'From name was missing.',
		'subject' => 'There was no subject.',
		'to_email' => 'There is no too email.',
		);
	
	
	var $user = false;
	var $html_body_css_style = false;
	var $html_head = false;
	
	var $user_shortcodes = array(
		'display_name' => '%display_name%',
		'ID' => '%user_id%',
		);
	
	
	
	
	
	
	/**
	 * Set
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function __construct() {
		
		$this->from_email = get_option( 'admin_email' );
		$this->from_name = '[' . get_bloginfo('name') . ']';
		$this->subject = get_bloginfo('name');
		
		$this->error_messages = apply_filters( 'SendCustomMailWP-error_messages', $this->error_messages );
		
	} // end function __construct
	
	
	
	
	
	
	/**
	 * Set
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * Send Mail
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 *
	 * Note: the return value does not signify weather or not
	 * the email was sent. unfortunately wp_mail will return false
	 * if there were errors, but that does not mean the email wasn't sent.
	 **/
	function send_mail( $args = array() ) {
		
		$defaults = array(
			'message' => $this->message,
			'from_email' => $this->from_email,
			'from_name' => $this->from_name,
			'subject' => $this->subject,
			'to_email' => $this->to_email,
			);
		
		$this->args = wp_parse_args( $args, $defaults );
		$this->set_args();
		
		// Allow for html email
		if ( $this->allow_html )
			add_filter( 'wp_mail_content_type', array( &$this, 'mail_content_type' ) );
		
		
		$this->set_to_email();
		$this->check_errors();
		
		// Only send if there is a message and a "to" email
		if ( $this->has_errors() ) {
			
			$this->set_errors();
			return false;
			
		} else {
			
			// Setup Email Info
			$this->set_headers();
			$this->set_subject();
			$this->set_message();
			
			// Send Mail - $to, $subject, $message, $headers, $attachment
			$this->sent = wp_mail( $this->to_email, $this->subject, $this->message, $this->headers );
			
			return $this->sent;

		}
		
	} // end function send_email
	
	
	
	
	
	
	/**
	 * Set args
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function set_args() {
		
		foreach ( $this->args as $key => $val ) {
			$this->set( $key, $val );
		}
		
	} // end function set_args 
	
	
	
	
	
	
	/**
	 * Has Errors
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function has_errors() {
		
		return $this->has_errors;
		
	} // end function has_errors
	
	
	
	
	
	
	/**
	 * Get Errors
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function get_errors() {
		
		return $this->errors;
		
	} // end function get_errors
	
	
	
	
	
	
	/**
	 * Get Errors
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function set_errors() {
		
		foreach ( $this->_errors as $val ) {
			$this->errors[$val] = $this->error_messages[$val];
		}
		
	} // end function set_errors
	
	
	
	
	
	
	/**
	 * Set To Email
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function set_to_email() {
		
		if ( isset( $this->to_email ) AND ! empty( $this->to_email ) AND ! is_array( $this->to_email ) AND is_email( $this->to_email ) ) {
			$this->to_email = array( $this->to_email );
		} else {
			$this->to_email = false;
		}
		
	} // end function set_to_email
	
	
	
	
	
	
	/**
	 * Check Errors
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function check_errors() {
		
		// Message
		foreach ( $this->args as $key => $val ) {
			
			if ( ! isset( $val ) OR empty( $val ) OR $val == false ) {
				$this->_errors[] = $key;
				$this->set( 'has_errors', true );
			} else if ( $key == 'from_email' AND ! is_email( $val ) ) {
				$this->_errors[] = $key;
				$this->set( 'has_errors', true );
			} else if ( $key == 'to_email' ) {
				
				if ( is_array( $this->to_email ) ) {
					
					foreach ( $this->to_email as $k => $email ) {
						if ( ! is_email( $email ) ) {
							unset( $this->to_email[$k] );
						}
					}
					
					if ( ! is_array( $this->to_email ) ) {
						$this->_errors[] = $key;
						$this->set( 'has_errors', true );
					}
					
				} else {
					$this->_errors[] = $key;
					$this->set( 'has_errors', true );
				}
			}
			
		}
		
	} // end function check_errors
	
	
	
	
	
	
	/**
	 * Set Headers
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function set_headers() {
		
		$this->headers = "From: " . stripslashes( $this->from_name ) . " <$this->from_email>\r\n ";
		
	} // end function set_headers
	
	
	
	
	
	
	/**
	 * Set Subject
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function set_subject() {
		
		$this->subject = strip_tags( stripslashes( $this->subject ) );
		
	} // end function set_subject
	
	
	
	
	
	
	/**
	 * Mail Content Type
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function mail_content_type() {
		
		return "text/html";
		
	} // end function mail_content_type
	
	
	
	
	
	
	/**
	 * Set Message
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function set_message() {
		
		// do stuff to the message
		if ( ! $this->allow_html ) {
			
			$this->message = strip_tags( stripslashes( $this->message ) );
			$this->apply_shortcodes();
			
		} else {
			
			$this->message = stripslashes( $this->message );
			$this->apply_shortcodes();
			$this->message = html_entity_decode( $this->message );
			$this->message = wpautop( $this->message );
			$this->set_html_message();
			
		}
		
	} // end function set_message
	
	
	
	
	
	
	/**
	 * Have User
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function have_user() {
		
		if ( isset( $this->user ) AND ! empty( $this->user ) AND is_object( $this->user ) ) {
			return true;
		} else {
			return false;
		}
		
	} // end function have_user
	
	
	
	
	
	
	/**
	 * Apply Shortcodes
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function apply_shortcodes() {
		
		if ( $this->have_user() ) {
			foreach ( $this->user_shortcodes as $key => $val ) {
				$this->message = str_replace( $val, $user->$key, $this->message );
			}
		}
		
	} // end function apply_shortcodes
	
	
	
	
	
	
	/**
	 * HTML Frame
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 *
	 * Note: html was pulled directly from mailchimp template as
	 * a secure starting point for an html frame.
	 **/
	function set_html_message() {
		
		$html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
		$html .= "<html>";
			$html .= "<head>";
				$html .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
		        $html .= "<title>$this->subject</title>";
		
				if ( $this->html_head )
					$html .= $this->html_head;

			$html .= "</head>";
			$html .= "<body leftmargin=\"0\" marginwidth=\"0\" topmargin=\"0\" marginheight=\"0\" offset=\"0\" style=\"font-family:Arial; font-size:12px; line-height:18px; color:#333; -webkit-text-size-adjust: none;margin: 0;padding: 0;display:block;width: auto !important; $this->html_body_css_style\">";
				
				$html .= $this->message;

			$html .= "</body>";
		$html .= "</html>";

		$this->message = $html;
		
	} // end function set_html_message
	
	
	
} // end class SendCustomMailWP