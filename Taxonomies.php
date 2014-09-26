<?php
/**
 * File Name AddTaxonomiesVCWP.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * AddTaxonomiesVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$AddTaxonomiesVCWP = new AddTaxonomiesVCWP();
class AddTaxonomiesVCWP {
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		$this->set__azza_tax_hierarchal();

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
	 * set__azza_tax_hierarchal
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__azza_tax_hierarchal() {
		
		register_taxonomy( 'azza-tax-hierarchal', '', array(
			'label' => 'Azza Tax',
			'labels' => array(
				'name' => 'Azza Tax',
				'singular_name' => 'Azza Tax',
				'search_items' => 'Search Azza Tax',
				// 'popular_items' => null,
				'parent_item' => 'Parent Azza Tax',
				'parent_item_colon' => 'Parent Azza Tax:',
				'edit_item' => 'Azza Tax Details',
				'update_item' => 'Update Azza Tax',
				'add_new_item' => 'Add New Azza Tax',
				'new_item_name' => 'New Azza Tax Name',
				// 'separate_items_with_commas' => null,
				// 'add_or_remove_items' => null,
				// 'choose_from_most_used' => null,
				'menu_name' => 'Azza Tax',
			),
			'public' => true,
			// 'show_in_nav_menus' => true, // defaults to value of public argument
			// 'show_ui' => true, // defaults to value of public argument
			// 'show_tagcloud' => true, // defaults to value of show_ui argument
			'hierarchical' => true,
			// 'update_count_callback' => 'None';
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'azza-tax-hierarchal',
				// 'with_front' => true, // allowing permalinks to be prepended with front base - defaults to true
				// 'hierarchical' => true, // true or false allow hierarchical urls
			),
			'capabilities' => array(
				'manage_terms',
				'edit_terms',
				'delete_terms',
				'assign_terms',
			),
		) );
		
	} // end function set__azza_tax_hierarchal
	
	
	
} // end class AddTaxonomiesVCWP