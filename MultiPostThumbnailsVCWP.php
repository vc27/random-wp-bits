<?php
/**
 * File Name MultiPostThumbnailsVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################


/*
$single_thumbnail = array(
	'label' => null,
	'id' => null,
	'post_type' => 'post',
	'priority' => 'low',
	'context' => 'side'
);
*/





/**
 * MultiPostThumbnailsVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
class MultiPostThumbnailsVCWP {
	
	
	
	/**
	 * Option name
	 * 
	 * @access public
	 * @var string
	 * Description:
	 * Used for various purposes when an import may be adding content to an option.
	 **/
	var $option_name = false;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		
		
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
	 * add_thumbnail
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function add_thumbnail( $array = array() ) {
		
		if ( class_exists( 'MultiPostThumbnails' ) ) {
			
			$this->thumbnail = new MultiPostThumbnails( $array );
			
		} else {
			return false;
		}
		
	} // end function add_thumbnail
	
	
	
} // end class MultiPostThumbnailsVCWP