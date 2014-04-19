<?php
/**
 * File Name RewriteRules.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * RewriteRules	
 * 
 * @version 1.0
 * @updated 00.00.13
 **/
$RewriteRules = new RewriteRules();
class RewriteRules {
	
	
	
	/**
	 * add_query_vars
	 * 
	 * @access public
	 * @var array
	 **/
	var $add_query_vars = array();
	
	
	
	/**
	 * rewrite_rules
	 * 
	 * @access public
	 * @var array
	 **/
	var $rewrite_rules = array(
		array(
			'rule' => '^search/page/([0-9]+)/?',
			'rewrite' => 'post_type=page&pagename=search&page=$matches[1]'
			) );
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		// hook method init
		add_action( 'init', array( &$this, 'init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/init
	 * 
	 * Description:
	 * Runs after WordPress has finished loading but before any headers are sent.
	 **/
	function init() {
		
		$this->add_rewrite_rules();
		$this->add_query_var();
		
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
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Add Rewrite Rules
	 * 
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function add_rewrite_rules() {
		global $wp;
		
		if ( isset( $this->rewrite_rules ) AND is_array( $this->rewrite_rules ) AND ! empty( $this->rewrite_rules ) ) {
			foreach ( $this->rewrite_rules as $rewrite_rule ) {
				add_rewrite_rule( $rewrite_rule['rule'], 'index.php?' . $rewrite_rule['rewrite'], 'top' );
			}
		}
	
	} // end function add_rewrite_rules 
	
	
	
	
	
	
	/**
	 * add_query_var
	 * 
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function add_query_var() {
		global $wp;
		
		if ( isset( $this->add_query_vars ) AND is_array( $this->add_query_vars ) AND ! empty( $this->add_query_vars ) ) {
			foreach ( $this->add_query_vars as $add_query_var ) { 
				$wp->add_query_var( $add_query_var ); 
			}
		}
	
	} // end function add_query_var
	
	
	
} // end class RewriteRules