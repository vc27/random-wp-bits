<?php
/* Template Name: Import Users */

/**
 * File Name tpl-CreatetUsersCSV.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 * Description:
 * This file was orginally created to import uses from the same db as wordpress.
 * This may be out of date and my have errors it is for reference only
 **/
#################################################################################################### */



/**
 * Class: ImportUsers
 *
 * @version 1.0
 * @updated 02.10.13
 **/
class ImportUsers {
	
	
	var $role = 'subscriber';
	
	var $errored_users = array();	
	var $have_errored_users = false;
	
	var $errored_user__option_name = '_rc-errored_users';
	
	
	
	
	
	
	/**
	 * import
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function import() {
		
		$this->get_users();
		$this->import_users();
		$this->save_errored_users();
		
	} // end function import
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * get_users
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function get_users() {		
		global $wpdb;

		$this->user_querystr = "SELECT * FROM users";

		$this->users = $wpdb->get_results( $this->user_querystr );
		
	} // end function get_users
	
	
	
	
	
	
	/**
	 * import_users
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function import_users() {		
		
		foreach ( $this->users as $this->rc_user ) {
			
			$this->reset_user_errors();
			$this->reset_user();
			$this->set_user_email();
			$this->set_user_login();
			$this->set_user_pass();
			$this->set_role();
			$this->wp_insert_user();
			$this->add_user_meta();
			
		} // end foreach ( $this->users as $this->user )
		
	} // end function import_users
	
	
	
	
	
	
	/**
	 * reset_user
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function reset_user() {		
		
		$this->user = array();
		
	} // end function reset_user
	
	
	
	
	
	
	/**
	 * reset_errors
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function reset_user_errors() {		
		
		$this->errors[$this->rc_user->userid] = false;
		$this->set( 'have_user_error', false );
		
	} // end function reset_errors
	
	
	
	
	
	
	/**
	 * set_user_email
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function set_user_email() {		

		if ( isset( $this->rc_user->email ) AND ! empty( $this->rc_user->email ) AND is_email( $this->rc_user->email ) ) {
			$this->user['user_email'] = $this->rc_user->email;
		} else {
			$this->set_errors( array(
				'user_email' => 'User email was not properly formatted.'
				) );
			$this->user['user_email'] = false;
		}
		
	} // end function set_user_email
	
	
	
	
	
	
	/**
	 * set_user_login
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function set_user_login() {		
		
		if ( isset( $this->user['user_email'] ) AND $this->user['user_email'] != false ) {
			// sanitize_user
			$user_login = sanitize_title_with_dashes( $this->user['user_email'] );
			if ( isset( $user_login ) AND ! empty( $user_login ) ) {
				$this->user['user_login'] = $user_login;
			} else {				
				$this->set_errors( array(
					'user_login' => 'User Login was missing.'
					) );
				$this->user['user_login'] = false;
			}
			
		}
		
	} // end function set_user_login 
	
	
	
	
	
	
	/**
	 * set_user_pass
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function set_user_pass() {
		
		if ( isset( $this->rc_user->password ) AND ! empty( $this->rc_user->password ) ) {			
			$this->user['user_pass'] = $this->rc_user->password;			
		} else {
			$this->set_errors( array(
				'user_pass' => 'User password was missing.'
				) );
			$this->user['user_pass'] = false;
		}
		
	} // end function set_user_pass
	
	
	
	
	
	
	/**
	 * set_user_login
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function set_role() {		
		
		$this->user['role'] = $this->role;
		
	} // end function set_user_login
	
	
	
	
	
	
	/**
	 * wp_insert_user
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function wp_insert_user() {
		
		$this->imported_user = false;
		if ( $this->have_user_error == false ) {
			
			$this->imported_user = wp_insert_user( $this->user );
			if ( $this->is_wp_insert_user_error() ) {
				$this->add_errored_users();
			}
			
		} else {
			$this->add_errored_users();
		}
		
	} // end function wp_insert_user
	
	
	
	
	
	
	/**
	 * is_wp_insert_user_error
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function is_wp_insert_user_error() {
		
		if ( is_wp_error( $this->imported_user ) ) {
			return true;
		} else {
			return false;
		}
		
	} // end function is_wp_insert_user_error
	
	
	
	
	
	
	/**
	 * add_errored_users
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function add_errored_users() {
		
		$this->set( 'have_errored_users', true );
		$this->errored_users[$this->rc_user->userid]['rc_user'] = $this->rc_user;		
		$this->errored_users[$this->rc_user->userid]['rc_import_error'] = $this->errors[$this->rc_user->userid];
		$this->errored_users[$this->rc_user->userid]['wp_user'] = $this->user;
		$this->errored_users[$this->rc_user->userid]['wp_insert_user__error'] = $this->imported_user;
		
	} // end function add_errored_users
	
	
	
	
	
	
	/**
	 * have_errored_users
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function have_errored_users() {		
		
		return $this->have_errored_users;
		
	} // end function have_errored_users
	
	
	
	
	
	
	/**
	 * set_errors
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function set_errors( $errors ) {
		
		$this->set( 'have_user_error', true );
		$this->errors[$this->rc_user->userid][] = $errors;
		
	} // end function set_errors
	
	
	
	
	
	
	/**
	 * save_errored_users
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function save_errored_users() {
		
		if ( $this->have_errored_users() ) {
			update_option( $this->errored_user__option_name, $this->errored_users );
		}
		
	} // end function save_errored_users
	
	
	
	
	
	
	/**
	 * get_errored_users
	 *
	 * @version 1.0
	 * @updated 02.10.13
	 **/
	function get_errored_users() {
		
		return get_option( $this->errored_user__option_name );
		
	} // end function get_errored_users 
	
	
	
	
	
	
	/**
	 * add_user_meta
	 *
	 * @version 1.0
	 * @updated 02.20.13
	 **/
	function add_user_meta() {
		
		if ( isset( $this->imported_user ) AND is_numeric( $this->imported_user ) AND ! $this->is_wp_insert_user_error() ) {
			$this->get_user_bookclubs();
			$this->prep_user_bookclubs_for_meta();
			$this->add_user_bookclubs_to_meta();
			$this->add_rc_userid_to_meta();
			
		}
		
	} // end function add_user_meta
	
	
	
	
	
	
	/**
	 * get_user_bookclubs
	 *
	 * @version 1.0
	 * @updated 02.20.13
	 **/
	function get_user_bookclubs() {		
		global $wpdb;

		$this->bookclub_querystr = "	SELECT circleid 
							FROM circles 
							WHERE 
								userid = " . $this->rc_user->userid . " AND
								status = 'posted' AND
								xloc = '_ad'
							";

		$bookclubs = $wpdb->get_results( $this->bookclub_querystr );
		if ( is_array( $bookclubs ) AND isset( $bookclubs[0] ) AND ! empty( $bookclubs[0] ) AND isset( $bookclubs[0]->circleid ) AND is_numeric( $bookclubs[0]->circleid ) ) {
			$this->set( 'have_bookclubs', true );
			$this->bookclubs = $bookclubs;
		} else {
			$this->bookclubs = false;
			$this->set( 'have_bookclubs', false );
		}
		
	} // end function get_user_bookclubs 
	
	
	
	
	
	
	/**
	 * prep_user_bookclubs_for_meta
	 *
	 * @version 1.0
	 * @updated 02.20.13
	 **/
	function prep_user_bookclubs_for_meta() {		
		
		if ( $this->have_bookclubs ) {
			foreach ( $this->bookclubs as $item ) {
				$bookclubs[] = $item->circleid;
			}
			
			$this->bookclubs = $bookclubs;
		} else {
			$this->bookclubs = false;
		}
		
	} // end function prep_user_bookclubs_for_meta 
	
	
	
	
	
	
	/**
	 * add_user_bookclubs_to_meta
	 *
	 * @version 1.0
	 * @updated 03.09.13
	 **/
	function add_user_bookclubs_to_meta() {		
		
		if ( $this->have_bookclubs ) {
			add_user_meta( $this->imported_user, '_rc_bookclub_ids', $this->bookclubs );
		}
		
	} // end function add_user_bookclubs_to_meta
	
	
	
	
	
	
	/**
	 * add_rc_userid_to_meta
	 *
	 * @version 1.0
	 * @updated 03.09.13
	 **/
	function add_rc_userid_to_meta() {		
		
		if ( $this->have_bookclubs ) {
			add_user_meta( $this->imported_user, '_rc_userid', $this->rc_user->userid );
		}
		
	} // end function add_rc_userid_to_meta
	
	
	
} // end class ImportUsers

$rc = new ImportUsers();
$rc->import();

print_r($rc);

// $user_id = 137;
// $user = new WP_User($user_id);
// $user->usermeta = get_user_meta( $user_id, '_rc_bookclub_ids', true );
// print_r($user);









