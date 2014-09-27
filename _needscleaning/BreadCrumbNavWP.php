<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.0.0
 **/
####################################################################################################





/**
 * BreadCrumbNavWP
 * @since 0.0.0
 **/
class BreadCrumbNavWP {
	
	
	
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
	 * breadCrumbNav
	 * @since 0.0.0
	 **/
	static function breadCrumbNav( $post, $spacer = '&raquo;', $id = 'navigation-breadcrumb' ) {
		
		$output = "<div id=\"$id\">";
			$ancestors = array_reverse( $post->ancestors );
			$i=0;
			foreach ( $ancestors as $post_id ) {
				if ( $i == count( $ancestors ) ) { $spacer = false; }
				$output .= "<a class=\"menu-item\" href=\"" . get_permalink( $post_id ) . "\">" . get_the_title( $post_id ) . "</a> $spacer ";
				$i++;
			}
			$output .= "<span class=\"menu-item menu-item-page current-menu-item\">" . get_the_title() . "</span>";
		$output .= "</div>";
		
		return $output;
		
	} // end static function breadCrumbNav
	
	
	
	
	
	
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
	
	
	
} // end class BreadCrumbNavWP