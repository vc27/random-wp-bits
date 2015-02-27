<?php
/**
 * File Name AzzaOptionsPageVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.1
 * @updated 02.17.14
 **/
####################################################################################################





/**
 * AzzaOptionsPageVCWP
 **/
$AzzaOptionsPageVCWP = new AzzaOptionsPageVCWP();
class AzzaOptionsPageVCWP {
	
	
	
	/**
	 * Option name
	 * 
	 * @access public
	 * @var string
	 * Description:
	 * Used for various purposes when an import may be adding content to an option.
	 **/
	var $option_name = 'azza_page_options';
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 02.16.13
	 **/
	function __construct() {

		// hook method after_setup_theme
		add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );

		// hook method init
		// add_action( 'init', array( &$this, 'init' ) );

		// hook method admin_init
		// add_action( 'admin_init', array( &$this, 'admin_init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 *
	 * @version 1.0
	 * @updated 02.16.13
	 *
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 **/
	function after_setup_theme() {
		
		$this->add_options_page();
		$this->add_actions_for_options();
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 02.10.13
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
	 * add_options_page
	 *
	 * @version 1.0
	 * @updated 02.17.14
	 **/
	function add_options_page() {
		
		create__options_page( array(

			'version' => '1.0',

			'option_name' => "_$this->option_name",
			'option_group' => $this->option_name,

			'add_submenu_page' => array(
				'parent_slug' => 'options-general.php',
				'page_title' => __( 'Azza Options', 'childtheme' ),
				'menu_title' => __( 'Azza Options', 'childtheme' ),
				'capability' => 'administrator',
			),

			// 'options_page_title' => false,
			// 'options_page_desc' => 'Options page description and general information here.',

			// Metaboxs and Optionns
			'options' => array(
                
				// Default Metabox and Options
				'general' => array(

					// Metabox
					'meta_box' => array(
						'title' => __( 'General Settings', 'childtheme' ),
						'context' => 'normal',
						'priority' => 'core',
						// 'desc' => 'Description.',
						// 'callback' => array( &$this, 'custom_meta_box_option' ),
						'save_all_settings' => __( 'Save', 'childtheme' ), // uses value as button text & sanitize_title_with_dashes(save_all_settings) for value
					),

					// settings and options
					'settings' => array(

						// Single setting and option
						'test' => array(
							'type' => 'blank',
							'validation' => 'blank',
							'title' => __( 'Blank', 'childtheme' ),
						),
					),
				), // end Default Metabox and Options

			), // end options
			
		) ); // end default_settings array
	} // end function add_options_page
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Add Settings Field
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function add_actions_for_options() {
		
		add_action( "_$this->option_name-add_settings_field", array( &$this, 'add_settings_field' ), 10, 2 );
		add_action( "_$this->option_name-sanitize-option", array( &$this, 'sanitize_callback' ), 10, 2 );

	} // end function add_actions_for_options






	/**
	 * Options Version Update
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * ToDo:
	 * Add switch case for version control
	 **/
	function options_version_update( $settings ) {

		// nothing here yet

	} // end function options_version_update






	/**
	 * Add Settings Field
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function add_settings_field( $field, $raw_option ) {
		
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
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function sanitize_callback( $new_option, $option_args ) {

		switch ( $option_args['validation'] ) {

			case "blank" :
				$new_option = "$new_option-blank";
				break;

		}

		return $new_option;

	} // end function sanitize_callback






	/**
	 * Create Post meta form, Meta box content
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function custom_meta_box_option( $options, $metabox ) {
        
		echo "options<br />";
		print_r($options);
		
		echo "<br /><br />metabox<br />";
		print_r($metabox);

	} // end function custom_meta_box
	
	
	
} // end class AzzaOptionsPageVCWP