<?php
// Template Name: Create 301 Redirects
/**
 * File Name Create301Redirects.php
 * @subpackage MetaCake
 * @license MetaCake LLC
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * Create301Redirects
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$Create301Redirects = new Create301Redirects();
class Create301Redirects {
	
	
	
	/**
	 * file_name
	 * 
	 * @access public
	 * @var string
	 **/
	var $file_name = 'thesinglewoman2.xml';
	
	
	
	/**
	 * redirect_string
	 * 
	 * @access public
	 * @var string
	 **/
	var $redirect_string = '%1$s';
	
	
	
	/**
	 * query
	 * 
	 * @access public
	 * @var array
	 **/
	var $query = array(
		'posts_per_page' => -1,
		'post_type' => 'post',
		'fields' => 'ids'
	);
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		$this->print_redirects();
		print_r($this);

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
	
	
	
	
	
	
	/**
	 * get_posts
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get_posts() {
		
		$this->set( 'wp_query', new WP_Query( $this->query ) );
		
	} // end function get_posts
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * parse
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function parse() {
		
		$this->set( 'file', home_url() . "/$this->file_name" );
		require_once( ABSPATH . "/wp-content/plugins/wordpress-importer/parsers.php" );
		$parser = new WXR_Parser();
		$this->results = $parser->parse( $this->file );
		
	} // end function parse
	
	
	
	
	
	
	/**
	 * print_redirects
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function print_redirects() {
		
		$this->get_posts();
		if ( isset( $this->wp_query->posts ) AND ! empty( $this->wp_query->posts ) ) {
			
			foreach ( $this->wp_query->posts as $this->k =>  ) {
				$this->redirect[$this->k] = sprintf( $this->redirect_string, $this->post_id ) ;
			}
			
		}
		
	} // end function print_redirects
	
	
	
} // end class Create301Redirects