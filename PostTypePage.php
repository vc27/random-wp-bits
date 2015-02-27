<?php
/**
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * PostTypePage
 **/
$PostTypePage = new PostTypePage();
class PostTypePage {



	/**
	 * post_type
	 *
	 * @access public
	 * @var string
	 **/
	var $post_type = 'page';



	/**
	 * name
	 *
	 * @access public
	 * @var string
	 **/
	var $name = 'Page';






	/**
	 * __construct
	 **/
	function __construct() {

		// hook method init
		add_action( 'init', array( &$this, 'init' ) );

	} // end function __construct






	/**
	 * init
	 **/
	function init() {
		add_action( 'the_post', array( &$this, 'the_post' ) );
	} // end function init






	/**
	 * set
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set






	####################################################################################################
	/**
	 * Register
	 **/
	####################################################################################################






	/**
	 * filter_localize_script
	 **/
	function filter_localize_script( $array ) {
		global $wp_query;

		if ( is_page() ) {
			$array['post'] = self::thePost($wp_query->post);
		}

		return $array;

	} // function filter_localize_script






	/**
	 * the_post
	 **/
	function the_post( $post ) {

		if ( isset( $post->post_type) AND $post->post_type == $this->post_type ) {
			$post = self::thePost($post);
		}

		return $post;

	} // end function the_post






	/**
	 * thePost
	 **/
	static function thePost( $post ) {

		if ( is_page_template('template-name.php') ) {
			// doo stuff
		}

		return $post;

	} // end function thePost



} // end class PostTypePage
