<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.0.0
 **/
####################################################################################################





/**
 * EventsCalProWP
 * @since 0.0.0
 **/
$EventsCalProWP = new EventsCalProWP();
class EventsCalProWP {
	
	
	
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

		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );
		add_action( 'init', array( &$this, 'init' ) );
		// add_action( 'admin_init', array( &$this, 'admin_init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 * @since 0.0.0
	 **/
	function after_setup_theme() {
		
		// 
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 * @since 0.0.0
	 **/
	function init() {
		
		add_action( 'the_post', array( &$this, 'the_post' ) );
		
	} // end function init
	
	
	
	
	
	
	/**
	 * admin_init
	 * @since 0.0.0
	 **/
	function admin_init() {
		
		// 
		
	} // end function admin_init
	
	
	
	
	
	
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
	 * the_post
	 * @since 0.0.0
	 **/
	function the_post( $post ) {
		
		// Events
		if ( !is_admin() AND $post->post_type == 'tribe_events' ) {
			
			// Get Venue ID
			$post->_EventVenueID = get_post_meta( $post->ID, '_EventVenueID', true );
			
			// Venue Post
			$post->venue = get_post( $post->_EventVenueID );
			if ( isset( $post->venue ) AND is_object( $post->venue ) AND isset( $post->venue->ID ) ) {
				$post->_VenueCity = get_post_meta( $post->venue->ID, '_VenueCity', true );
				$post->_VenueState = get_post_meta( $post->venue->ID, '_VenueState', true );
			}
			
			// Event URL
			$post->_EventURL = get_post_meta( $post->ID, '_EventURL', true );
			
			// Event Date
			$post->_EventStartDate = get_post_meta( $post->ID, '_EventStartDate', true );
			$post->_EventEndDate = get_post_meta( $post->ID, '_EventEndDate', true );			
			
			$post->date = date( 'F d, Y', strtotime( $post->_EventStartDate ) );
			$post->time = date( 'g:ia', strtotime( $post->_EventStartDate ) );
			
		}
		
		return $post;
		
	} // end function the_post
	
	
	
	
	
	
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
	
	
	
} // end class EventsCalProWP