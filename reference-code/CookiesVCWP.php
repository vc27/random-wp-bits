<?php
/**
 * File Name CookiesVCWP.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 03.22.13
 **/
####################################################################################################






/**
 * set__cookie
 *
 * @version 1.0
 * @updated 03.22.13
 * http://php.net/manual/en/function.setcookie.php
 **/
function set__cookie( $args ) {
	
	$CookiesVCWP = new CookiesVCWP();
	return $CookiesVCWP->set_cookie( $args );
	
} // end function set__cookie





/**
 * CookiesVCWP
 *
 * @version 1.0
 * @updated 03.22.13
 **/
class CookiesVCWP {
	
	
	
	/**
	 * cookie
	 * 
	 * @access public
	 * @var bool
	 **/
	var $cookie = 0;
	
	
	
	/**
	 * have_args
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_args = 0;
	
	
	
	/**
	 * name
	 * 
	 * @access public
	 * @var string
	 **/
	var $name = 0;
	
	
	
	/**
	 * value
	 * 
	 * @access public
	 * @var string
	 **/
	var $value = 0;
	
	
	
	/**
	 * expire
	 * 
	 * @access public
	 * @var string
	 **/
	var $expire = 0; // 30 days = time()+60*60*24*30;
	
	
	
	/**
	 * path
	 * 
	 * @access public
	 * @var string
	 **/
	var $path = '/';
	
	
	
	/**
	 * domain
	 * 
	 * @access public
	 * @var string
	 **/
	var $domain = false;
	
	
	
	/**
	 * secure
	 * 
	 * @access public
	 * @var string
	 **/
	var $secure = false;
	
	
	
	/**
	 * httponly
	 * 
	 * @access public
	 * @var string
	 **/
	var $httponly = false;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function __construct() {
		
		// 

	} // end function __construct
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set 
	
	
	
	
	
	
	/**
	 * set_args
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function set_args( $args ) {
		$this->set( 'args', $args );
		
		if ( is_array( $this->args ) AND ! empty( $this->args ) {
			foreach ( $this->args as $k => $v ) {
				$this->set( $k, $v );
			}
		}
		
	} // end function set_args
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * set_cookie
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 * http://php.net/manual/en/function.setcookie.php
	 **/
	function set_cookie( $args ) {
		
		$this->set_args($args);
		if ( $this->have_args() ) {
			
			$this->cookie = setcookie( 
				$this->name,
				$this->value, 
				$this->expire,
				$this->path,
				$this->domain,
				$this->secure = false,
				$this->httponly = false 
				);
				
		}
		
		return $this->cookie;
		
	} // end function set_cookie
	
	
	
	
	
	
	/**
	 * get_cookie
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function get_cookie( $key ) {
		
		if ( isset( $_COOKIE[$key] ) AND ! empty( $_COOKIE[$key] ) ) {
			$this->$key = $_COOKIE[$key];
		} else {
			$this->$key = false;
		}
		
		return $this->$key;
		
	} // end function get_cookie
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_args
	 *
	 * @version 1.0
	 * @updated 03.22.13
	 **/
	function have_args() {
		
		if ( 
			isset( $this->name ) AND ! empty( $this->name ) AND 
			isset( $this->value ) AND ! empty( $this->value ) AND 
			isset( $this->expire ) AND ! empty( $this->expire ) AND 
			isset( $this->path ) AND ! empty( $this->path ) AND 
			isset( $this->domain ) AND ! empty( $this->domain ) AND 
			) {
			$this->set( 'have_args', 1 );
		} else {
			$this->set( 'have_args', 0 );
		}
		
		return $this->have_args;
		
	} // end function have_args
	
	
	
} // end class CookiesVCWP