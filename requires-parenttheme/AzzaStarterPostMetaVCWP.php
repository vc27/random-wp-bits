<?php
/**
 * File Name AzzaStarterPostMetaVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * AzzaStarterPostMetaVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$AzzaStarterPostMetaVCWP = new AzzaStarterPostMetaVCWP();
class AzzaStarterPostMetaVCWP {
	
	
	
	/**
	 * post_types
	 * 
	 * @access public
	 * @var array
	 **/
	var $post_types = array( 
		'post', 
		'page' 
	);
	
	
	
	
	
	
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
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function register__postmeta() {
		
		if ( is_admin() ) {
			
			$options = array(
				'id' => 'tester_metabox_id', // required
				'title' => 'Metabox Name', 
				'context' => 'normal', // options: normal, side
				'priority' => 'high', // ('high', 'core', 'default' or 'low')
				'desc' => 'Metabox description can go here.',
				// 'callback' => array( &$this, 'custom_meta_box_option' ),
				'post_meta' => array( // array of post_meta fields
					array(
						'type' => 'text',
						'validation' => 'text',
						'title' => __( 'Text', 'childtheme' ),
						'name' => '_text_multi',
						'desc' => __( 'In et enim sapien, sed interdum nisi. Aenean sagittis turpis porttitor leo mollis adipiscing.', 'childtheme' ),
					),
				),
			);

			$this->registered = register__postmeta( $this->post_types, $options );
			
			
			
			/*$options = array(
				'id' => '__tester_metabox_id', // required
				'title' => 'anohter Metabox Name', 
				'context' => 'normal', // options: normal, side
				'priority' => 'high', // ('high', 'core', 'default' or 'low')
				'desc' => 'Metabox description can go here.',
				// 'callback' => array( &$this, 'custom_meta_box_option' ),
				'post_meta' => array( // array of post_meta fields
					array(
						'type' => 'select_post',
						'validation' => 'select',
						'title' => __( 'Text', 'childtheme' ),
						'name' => '__select_post',
						'desc' => __( 'In et enim sapien, sed interdum nisi. Aenean sagittis turpis porttitor leo mollis adipiscing.', 'childtheme' ),
						'options' => array(
							'post_type' => 'post',
						),
					),
				),
			);

			$this->registered = register__postmeta( $this->post_types, $options );
			*/
			/*if ( isset( $this->registered->metabox['id'] ) AND ! empty( $this->registered->metabox['id'] ) ) {
				$this->add_actions_for_meta_boxes( $this->registered->metabox['id'], $this->post_types );
			}*/
			
		} // end if ( is_admin() )
		
	} // end function register__postmeta
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Add filtering for additional post meta
	 **/
	####################################################################################################






	/**
	 * Add Settings Field
	 * 
	 * @version	0.0.1
	 * @updated 02.15.12
	 **/
	function add_actions_for_meta_boxes( $id, $post_types ) {

		foreach ( $post_types as $post_type ) {

			add_action( "$id-$post_type-add_settings_field", array( &$this, 'add_settings_field' ), 10, 2 );
			add_action( "$id-$post_type-sanitize-post_meta", array( &$this, 'sanitize_callback' ), 10, 2 );

		}

	} // end function add_actions_for_options






	/**
	 * Add Settings Field
	 * 
	 * @version	0.0.1
	 * @updated 02.15.12
	 **/
	function add_settings_field( $field, $metabox ) {

		if ( is_array( $field ) AND ! empty( $field ) ) {
			extract( $field, EXTR_SKIP );
		} else {
			return;
		}
		
		// Options
		if ( isset( $field['options'] ) AND ! empty( $field['options'] ) ) {
			$options = $field['options'];
		} else {
			$options = false;
		}
		
		// Desc
		if ( isset( $field['desc'] ) AND ! empty( $field['desc'] ) ) {
			$desc = $field['desc'];
		} else {
			$desc = false;
		}
		
		// Desc
		if ( isset( $field['val'] ) AND ! empty( $field['val'] ) ) {
			$val = $field['val'];
		} else {
			$val = false;
		}
		
		switch ( $type ) {

			case "blank" :
				echo "<input type=\"text\" name=\"$name\" value=\"$val\" id=\"$id\" class=\"large-text\">";
				if ( $desc ) echo "<p class=\"description\">$desc</p>";
				break;

		}

	} // end function add_settings_field






	/**
	 * Sanitize Callback
	 * 
	 * @version	0.0.1
	 * @updated 02.15.12
	 **/
	function sanitize_callback( $new_instance, $post_meta ) {
		
		switch ( $post_meta['validation'] ) {

			case "blank" :
				$new_instance = "$new_instance-blank";
				break;

		}

		return $new_instance;

	} // end function sanitize_callback






	/**
	 * Create Post meta form, Meta box content
	 * 
	 * @version	0.0.1
	 * @updated 02.15.12
	 **/
	function custom_meta_box_option( $options, $metabox ) {

		echo "options<br />";
		print_r($options);
		
		echo "<br /><br />metabox<br />";
		print_r($metabox);

	} // end function custom_meta_box
	
	
	
} // end class AzzaStarterPostMetaVCWP