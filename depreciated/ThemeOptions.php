<?php
/**
 * File Name ThemeOptions.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 10.20.13
 **/
####################################################################################################





/**
 * ThemeOptions
 *
 * @version 1.0
 * @updated 00.00.13
 **/
class ThemeOptions {
	
	
	
	/**
	 * option_name
	 * 
	 * @access public
	 * @var string
	 **/
	var $option_name = '_vc_general_options';
	
	
	
	/**
	 * options
	 * 
	 * @access public
	 * @var array
	 **/
	var $options = array();
	
	
	
	
	
	
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
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_option
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_option( $option, $setting = '' ) {
		
		if ( ! $this->have_options() ) {
			$this->set( 'options', get_option( $this->option_name ) );
		}
		
		if ( $this->have_options() AND isset( $this->options[$option][$setting] ) AND  ! empty( $this->options[$option][$setting] ) ) {
			return true;
		} else {
			return false;
		}
		
	} // end function have_option
	
	
	
	
	
	
	/**
	 * get_option
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get_option( $option, $setting ) {
		
		if ( $this->have_option( $option, $setting ) ) {
			return $this->sanitize_option( $option, $setting );
		} else {
			return false;
		}
		
	} // end function get_option 
	
	
	
	
	
	
	/**
	 * sanitize_option
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function sanitize_option( $option, $setting ) {
		global $wp_query;
		
		$this->set( 'output', stripslashes( $this->options[$option][$setting] ) );
		
		switch ( $option ) {
			
			case "search" :
				global $s;
				$this->set( 'output', str_replace( '%search_term%', $s, $this->output ) );
				break;
			case "contact" :
				$this->set( 'output', str_replace( '%year%', date('Y'), $this->output ) );
				break;
			case "date_archive_title" :
				if ( is_day() ) {
					$archive_type = get_the_date();
				} else if ( is_month() ) {
					$archive_type = get_the_date('F Y');
				} else if ( is_year() ) {
					$archive_type = get_the_date('Y');
				}
				$this->set( 'output', str_replace( '%date_archive_name%', $archive_type, $this->output ) );
				break;
			case "tag_title" : 
				$this->set( 'output', str_replace( '%tag_name%', $wp_query->queried_object->name, $this->output ) );
				break;
			case "category_title" :
				$this->set( 'output', str_replace( '%cat_name%', $wp_query->queried_object->name, $this->output ) );
				break;
			case "author_title" :
				$this->set( 'output', str_replace( '%author_name%', $wp_query->queried_object->display_name, $this->output ) );
				break;
			default : 
				break;
			
		} // end switch ( $option )
		
		return $this->output;
		
	} // end function sanitize_option
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_options
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_options() {
		
		if ( isset( $this->options ) AND ! empty( $this->options ) ) {
			return true;
		} else {
			return false;
		}
		
	} // end function have_options
	
	
	
} // end class ThemeOptions