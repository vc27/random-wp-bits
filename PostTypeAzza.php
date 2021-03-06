<?php
/**
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * PostTypeAzza
 **/
$PostTypeAzza = new PostTypeAzza();
class PostTypeAzza {



	/**
	 * post_type
	 *
	 * @access public
	 * @var string
	 **/
	var $post_type = 'azza';



	/**
	 * slug
	 *
	 * @access public
	 * @var string
	 **/
	var $slug = 'azza';



	/**
	 * name
	 *
	 * @access public
	 * @var string
	 **/
	var $name = 'Azza';






	/**
	 * __construct
	 **/
	function __construct() {

		$this->register_post_type();

		// hook method init
		add_action( 'init', array( &$this, 'init' ) );

		// hook method admin_init
		// add_action( 'admin_init', array( &$this, 'admin_init' ) );

	} // end function __construct






	/**
	 * init
	 **/
	function init() {
		add_action( 'the_post', array( &$this, 'the_post' ) );
		// add_filter( 'pre_get_posts', array( &$this, 'pre_get_posts' ) );
	} // end function init






	/**
	 * admin_init
	 **/
	// function admin_init() {

		// add_filter( 'manage_edit-' . $this->post_type . '_columns', array( &$this, 'edit_columns' ) );
		// add_action( 'manage_posts_custom_column', array( &$this, 'custom_columns' ) );
		// add_filter( 'manage_edit-' . $this->post_type . '_sortable_columns', array( &$this, 'column_register_sortable' ) );
		// add_filter( 'request', array( &$this, 'column_orderby' ) );

	// } // end function admin_init






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
	 * register_post_type
	 **/
	function register_post_type() {

		register_post_type( $this->post_type, apply_filters( "register_post_type-$this->post_type", array(
			'labels' => array(
				'name' => __( $this->name, 'childtheme' ),
				'singular_name' => __( $this->name, 'childtheme' ),
				'add_new' => __( 'Add New', 'childtheme' ),
				'add_new_item' => __( 'Add New', 'childtheme' ),
				'edit_item' => __( "Edit $this->name", 'childtheme' ),
				'new_item' => __( "New $this->name", 'childtheme' ),
				'view_item' => __( "View $this->name", 'childtheme' ),
				'search_items' => __( "Search $this->name", 'childtheme' ),
				'not_found' => __( "No $this->name found", 'childtheme' ),
				'not_found_in_trash' => __( "No $this->name found in Trash", 'childtheme' ),
				'parent_item_colon' => '',
				'menu_name' => __( $this->name, 'childtheme' )
			),

			// 'description' => '',
			'public' => true,
			// 'publicly_queryable'	=> true,
			// 'exclude_from_search'	=> false,
			'show_ui' => true,
			'show_in_menu' => true, // edit.php?post_type=page
			// 'menu_position' => null,
			// 'menu_icon' => get_stylesheet_directory_uri() . "/addons/PostTypes/images/" . $this->post_type . "-16x16.png", // is set in class construct
			'capability_type' => 'post', // requires 'page' to call in post_parent
			// 'capabilities' => array(), --> See codex for detailed description
			// 'map_meta_cap' => false,
			// 'hierarchical' => true, // requires manage_pages_custom_column for custom_columns add_action // requires 'true' to call in post_parent

			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				// 'trackbacks',
				'custom-fields',
				'comments',
				'revisions',
				'page-attributes', //  (menu order, hierarchical must be true to show Parent option)
				// 'post-formats',
			),

			// 'register_meta_box_cb' => '', --> managed via class method add_meta_boxes()
			// 'taxonomies' => array('post_tag', $this->post_type . '-tax-hierarchal'), // array of registered taxonomies
			// 'permalink_epmask' => 'EP_PERMALINK',
			// 'has_archive' => true, // Enables post type archives. Will use string as archive slug.

			'rewrite' => array( // Permalinks
				'slug' => $this->slug,
				// 'with_front' => '', // set this to false to over-write a wp-admin-permalink structure
				// 'feeds' => '', // default to has_archive value
				// 'pages' => true,
			),

			'query_var' => $this->post_type, // This goes to the WP_Query schema
			'can_export' => true,
			// 'show_in_nav_menus' => '', // value of public argument
			'_builtin' => false,
			'_edit_link' => 'post.php?post=%d',

		) )  );

	} // end function register_post_type






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

		$post->permalink = get_permalink( $post->ID );

		return $post;

	} // end function thePost






	/**
	 * filter_localize_script
	 **/
	function filter_localize_script( $array ) {
		global $wp_query;

		if (
			is_single()
			AND isset( $wp_query->post )
			AND isset( $wp_query->post->post_type )
			AND $wp_query->post->post_type == $this->post_type
		) {
			$array['post'] = self::thePost($wp_query->post);
		}

		return $array;

	} // function filter_localize_script






	/**
	 * template_redirect
	 **/
	function template_redirect() {
		global $wp_query, $post;

		if ( is_home() AND get_post_type() == $this->post_type ) {
			require_once( get_stylesheet_directory() . '/archive.php');
			die();
		}

	} // end function template_redirect






	/**
	 * pre_get_posts
	 **/
	function pre_get_posts( $wp_query ) {

		if ( isset( $wp_query->query['post_type'] ) AND $wp_query->query['post_type'] == $this->post_type ) {
			$wp_query->set( 'posts_per_page', 8 );
		}

	} // end function pre_get_posts






	####################################################################################################
	/**
	 * Admin Management
	 **/
	####################################################################################################






	/**
	 * column_register_sortable
	 **/
	function column_register_sortable( $columns ) {

		// $columns['featured'] = 'featured';

		return $columns;

	} // end function column_register_sortable






	/**
	 * column_orderby
	 **/
	function column_orderby( $vars ) {

		// Sorting by post_meta numeric values
		if ( isset( $vars['orderby'] ) AND $vars['post_type'] == $this->post_type ) {

			$vars['meta_compare'] = '>';
			$vars['meta_value'] = 0;

			switch ( $vars['orderby'] ) {
				case "featured" :
					$vars['meta_key'] = '_books__featured_order';
					break;
			}

			$vars['orderby'] = 'meta_value_num';

		} // end if ( isset( $vars['orderby'] ) )

		return $vars;

	} // end function column_orderby






	/**
	 * edit_columns
	 **/
	function edit_columns( $columns ) {

		$columns['image'] = __( 'Image', 'childtheme' );

		return $columns;

	} // end edit_columns






	/**
	 * custom_columns
	 **/
	function custom_columns( $column ) {
		global $post;

		if ( $post->post_type == $this->post_type ) {

			switch ( $column ) {

				case "image":
					if ( has_post_thumbnail( $post->ID ) )
						echo get_the_post_thumbnail( $post->ID, array( 50, 50 ) );
					break;

			} // end switch

		} // end if

	} // end custom_columns



} // end class PostTypeAzza
