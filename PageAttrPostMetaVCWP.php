<?php
/**
 * File Name PageAttrPostMetaVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.1
 * @updated 08.12.13
 **/
####################################################################################################





/**
 * PageAttrPostMetaVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$PageAttrPostMetaVCWP = new PageAttrPostMetaVCWP();
class PageAttrPostMetaVCWP {
	
	
	
	/**
	 * post_types
	 * 
	 * @access public
	 * @var array
	 **/
	var $post_types = array( 'page' );
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		// hook method admin_init
		add_action( 'init', array( &$this, 'init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function init() {
		
		$this->register__postmeta();
		
	} // end function init
	
	
	
	
	
	
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
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * register__postmeta
	 *
	 * @version 1.1
	 * @updated 08.12.13
	 **/
	function register__postmeta() {
		
		if ( is_admin() ) {
			
			$options = array(
				'id' => 'vc_custom_page_meta', // required
				'title' => 'Additional Page Attributes', 
				'context' => 'normal', // options: normal, side
				'priority' => 'low', // ('high', 'core', 'default' or 'low')
				// 'desc' => 'Metabox description can go here.',
				// 'callback' => array( &$this, 'custom_meta_box_option' ),
				'post_meta' => array( // array of post_meta fields
					array(
						'type' => 'checkbox',
						'validation' => 'checkbox',
						'title' => 'Display Child Pages',
						'name' => 'list_child_pages',
						'desc' => 'Display all child pages below main content.',
						),
					),
				);

			$this->registered = register__postmeta( $this->post_types, apply_filters( 'vc_custom_page_meta', $options ) );
			
		} // end if ( is_admin() )
		
	} // end function register__postmeta
	
	
	
} // end class PageAttrPostMetaVCWP