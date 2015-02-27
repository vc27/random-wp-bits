<?php
/**
 * File Name TypeKitWP.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * TypeKitWP
 **/
$TypeKitWP = new TypeKitWP();
class TypeKitWP {



	/**
	 * typekit
	 *
	 * @access public
	 * @var string
	 **/
	var $handle = 'typekit';



	/**
	 * src
	 *
	 * @access public
	 * @var string
	 **/
	var $src = '//use.typekit.net/nci0ykc.js';




	/**
	 * load
	 *
	 * @access public
	 * @var string
	 **/
	var $load = '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';






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

		$this->register_style_and_scripts();

		add_action( 'wp_head', array( &$this, 'wp_head' ), 11 );

		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ), 11 );

	} // end function init






	/**
	 * wp_head
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function wp_head() {

		echo "\n\n$this->load\n\n";

	} // end function wp_head






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
	 * Register Styles and Scripts
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function register_style_and_scripts() {

		wp_register_script( $this->handle, $this->src );

	} // end function register_style_and_scripts






	/**
	 * Enqueue Scripts
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function wp_enqueue_scripts() {

		wp_enqueue_script( $this->handle );

	} // function wp_enqueue_scripts



} // end class TypeKitWP
