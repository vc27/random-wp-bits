<?php
/**
 * File Name RemoveMenuItems.php
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * RemoveMenuItems
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$RemoveMenuItems = new RemoveMenuItems();
class RemoveMenuItems {
	
	
	
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
	 * errors
	 * 
	 * @access public
	 * @var array
	 **/
	var $errors = array();
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {
		
		add_action( 'init', array( &$this, 'init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * Initiate
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function init() {
		
		// Admin Menu and Links
		add_action( 'admin_menu', array( &$this, 'remove_menu_page' ), 99 );
		add_action( 'admin_menu', array( &$this, 'remove_submenus' ), 200 );
		
	} // end function init
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * error
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function error( $error_key ) {
		
		$this->errors[] = $error_key;
		
	} // end function error
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Remove Menu Pages
	 * 
	 * @version 0.1
	 * @updated 00.00.00
	 **/
    function remove_menu_page() {
		
		// remove_menu_page( 'edit.php' );
		remove_menu_page( 'link-manager.php' );
		// remove_menu_page( 'edit-comments.php' );
        
    } // end function remove_menu_page

	
	
	
	
	
	/**
	 * Remove Sub Menu Pages
	 * 
	 * @version 0.1
	 * @updated 00.00.00
	 **/
	function remove_submenus() {
		global $submenu;
		
		// print_r($submenu);
		
		// Dashboard menu
		// unset($submenu['index.php'][10]); // Removes Updates
		
		// Posts menu
		// unset($submenu['edit.php'][5]); // Leads to listing of available posts to edit
		// unset($submenu['edit.php'][10]); // Add new post
		// unset($submenu['edit.php'][15]); // Remove categories
		// unset($submenu['edit.php'][16]); // Removes Post Tags
		
		// Media Menu
		// unset($submenu['upload.php'][5]); // View the Media library
		// unset($submenu['upload.php'][10]); // Add to Media library
		
		// Links Menu
		//  unset($submenu['link-manager.php'][5]); // Link manager
		//  unset($submenu['link-manager.php'][10]); // Add new link
		//  unset($submenu['link-manager.php'][15]); // Link Categories
		
		// Pages Menu
		// unset($submenu['edit.php?post_type=page'][5]); // The Pages listing
		// unset($submenu['edit.php?post_type=page'][10]); // Add New page
		
		// Appearance Menu
		// unset($submenu['themes.php'][5]); // Removes 'Themes'
		// unset($submenu['themes.php'][7]); // Widgets
		unset($submenu['themes.php'][12]); // Removes Theme Editor
		
		// Plugins Menu
		// unset($submenu['plugins.php'][5]); // Plugin Manager
		// unset($submenu['plugins.php'][10]); // Add New Plugins
		unset($submenu['plugins.php'][15]); // Plugin Editor
		
		// Users Menu
		// unset($submenu['users.php'][5]); // Users list
		// unset($submenu['users.php'][10]); // Add new user
		// unset($submenu['users.php'][15]); // Edit your profile
		
		// Tools Menu
		unset($submenu['tools.php'][5]); // Tools area
		// unset($submenu['tools.php'][10]); // Import
		// unset($submenu['tools.php'][15]); // Export
		// unset($submenu['tools.php'][20]); // Upgrade plugins and core files
		
		// Settings Menu
		// unset($submenu['options-general.php'][10]); // General Options
		// unset($submenu['options-general.php'][15]); // Writing
		// unset($submenu['options-general.php'][20]); // Reading
		// unset($submenu['options-general.php'][25]); // Discussion
		// unset($submenu['options-general.php'][30]); // Media
		// unset($submenu['options-general.php'][35]); // Privacy
		// unset($submenu['options-general.php'][40]); // Permalinks
		// unset($submenu['options-general.php'][45]); // Misc
		
		// print_r($submenu);
		
	} // end function remove_submenus
	
	
	
} // end class RemoveMenuItems