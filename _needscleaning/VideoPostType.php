<?php
/**
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * VideoPostType
 **/
$VideoPostType = new VideoPostType();
class VideoPostType {
	
	
	
	/**
	 * registered
	 * 
	 * @access public
	 * @var array
	 **/
	var $registered = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {
		
		add_image_size( 'video-image', 1280, 960, true );
				
		$this->register_taxonomy();
		$this->register_post_type();
		
		// hook method after_setup_theme
		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );

		// hook method init
		// add_action( 'init', array( &$this, 'init' ) );

		// hook method admin_init
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		
		// Add a metabox to this post-type
		add_filter( 'oembed-included_post_types', array( &$this, 'add_external_metaboxes' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function after_setup_theme() {
		
		// 
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function init() {
		
        //
		
	} // end function init
	
	
	
	
	
	
	/**
	 * admin_init
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function admin_init() {
		
		// Add Filters for Custom Manage Columns
		add_filter(	'manage_edit-' . $this->registered->_post_type . '_columns', array( &$this, 'edit_columns' ) );
		
		// Add management for capability_type
		if ( 
			( isset( $this->registered->post_type['post_type']['hierarchical'] ) AND ! empty( $this->registered->post_type['post_type']['hierarchical'] ) ) 
			AND 
			( isset( $this->registered->post_type['post_type']['capability_type'] ) AND ! empty( $this->registered->post_type['post_type']['capability_type'] ) AND $this->registered->post_type['post_type']['capability_type'] == 'page' ) 
		) {
			$this->manage_custom_column = 'manage_pages_custom_column';
		} else {
			$this->manage_custom_column = 'manage_posts_custom_column'; // "manage_" . $this->post_type . "_custom_column";
		}
		
		add_action(	$this->manage_custom_column, array( &$this, 'custom_columns' ) );
		
		// Add column specific filtering
		// add_filter( 'manage_edit-' . $this->registered->_post_type . '_sortable_columns', array( &$this, 'column_register_sortable' ) );
		add_filter( 'request', array( &$this, 'column_orderby' ) );
		
		// Added for taxonomy filtering
		if ( $this->registered->have_tax_filters ) {
			add_action( 'restrict_manage_posts', array( &$this, 'restrict_manage_html_filters' ) );
			add_filter( 'pre_get_posts', array( &$this, 'post_type_parse_query' ) );
		}
		
	} // end function admin_init
	
	
	
	
	
	
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
	 * add_external_metaboxes
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 * 
	 * Description:
	 * Works in conjunction with existing filter used with in
	 * post-meta-vc.php. It will add the post type to the metabox
	 * that is being specified.
	 **/
	function add_external_metaboxes( $post_types ) {
		
		$post_types[] = $this->registered->_post_type;
		return $post_types;
		
	} // end function add_external_metaboxes
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Register
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * register_post_type
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function register_post_type() {
		
		$this->registered = register__post_type( array(
			'post_type' => array(
				'labels' => array(
					'name' => __( 'Video', 'childtheme' ),
					'singular_name' => __( 'Video', 'childtheme' ),
					'add_new' => __( 'Add New', 'childtheme' ),
					'add_new_item' => __( 'Add New', 'childtheme' ),
					'edit_item' => __( 'Edit Video', 'childtheme' ),
					'new_item' => __( 'New Video', 'childtheme' ),
					'view_item' => __( 'View Video', 'childtheme' ),
					'search_items' => __( 'Search Video', 'childtheme' ),
					'not_found' => __( 'No Video found', 'childtheme' ),
					'not_found_in_trash' => __( 'No Video found in Trash', 'childtheme' ),
					'parent_item_colon' => '',
					'menu_name' => __( 'Video', 'childtheme' )
				),

				// 'description' => '',
				'public' => false,
				// 'publicly_queryable'	=> true,
				// 'exclude_from_search'	=> false,
				'show_ui' => true,
				'show_in_menu' => 'upload.php',
				// 'menu_position' => null,
				// 'menu_icon' => get_stylesheet_directory_uri() . "/addons/PostTypes/images/video-16x16.png", // is set in class construct
				'capability_type' => 'post', // requires 'page' to call in post_parent
				// 'capabilities' => array(), --> See codex for detailed description
				// 'map_meta_cap' => false,
				// 'hierarchical' => true, // requires manage_pages_custom_column for custom_columns add_action // requires 'true' to call in post_parent

				'supports' => array( 
					'title',
					// 'editor',
					// 'author',
					'thumbnail',
					// 'excerpt',
					// 'trackbacks',
					// 'custom-fields',
					// 'comments',
					// 'revisions',
					'page-attributes', //  (menu order, hierarchical must be true to show Parent option)
					// 'post-formats',
				),

				// 'register_meta_box_cb' => '', --> managed via class method add_meta_boxes()
				'taxonomies' => array( 'video-cat' ), // array of registered taxonomies
				// 'permalink_epmask' => 'EP_PERMALINK',
				// 'has_archive' => true, // Enables post type archives. Will use string as archive slug.

				'rewrite' => array( // Permalinks
					'slug' => 'video',
					// 'with_front' => '', // set this to false to over-write a wp-admin-permalink structure
					// 'feeds' => '', // default to has_archive value
					// 'pages' => true,
				),

				'query_var' => 'video', // This goes to the WP_Query schema
				'can_export' => true,
				// 'show_in_nav_menus' => '', // value of public argument
				'_builtin' => false, 
				'_edit_link' => 'post.php?post=%d',

			), // end 'post_type'

		) );
		
	} // end function register_post_type
	
	
	
	
	
	
	/**
	 * register_taxonomy
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function register_taxonomy() {
		
		register_taxonomy( 'video-cat', '', array(
			'label' => __( 'Video Category', 'childtheme' ),
			'labels' => array(
				'name' => __( 'Video Category', 'childtheme' ),
				'singular_name' => __( 'Video Category', 'childtheme' ),
				'search_items' => __( 'Search Video Category', 'childtheme' ),
				// 'popular_items' => null,
				'parent_item' => __( 'Parent Video Category', 'childtheme' ),
				'parent_item_colon' => __( 'Parent Video Category:', 'childtheme' ),
				'edit_item' => __( 'Video Category Details', 'childtheme' ),
				'update_item' => __( 'Update Video Category', 'childtheme' ),
				'add_new_item' => __( 'Add New Video Category', 'childtheme' ),
				'new_item_name' => __( 'New Video Category Name', 'childtheme' ),
				// 'separate_items_with_commas' => null,
				// 'add_or_remove_items' => null,
				// 'choose_from_most_used' => null,
				'menu_name' => __( 'Video Category', 'childtheme' ),
			),
			'public' => false,
			// 'show_in_nav_menus' => true, // defaults to value of public argument
			'show_ui' => true, // defaults to value of public argument
			// 'show_tagcloud' => true, // defaults to value of show_ui argument
			'hierarchical' => true,
			// 'update_count_callback' => 'None';
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'video-cat',
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
		
	} // end function register_taxonomy
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Admin Management
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Register the column as sortable
	 * 
	 * @version 1.2
	 * @updated 00.00.13
	 **/
	function column_register_sortable( $columns ) {
		
		// $columns['featured'] = 'featured';

		return $columns;
		
	} // end function column_register_sortable
	
	
	
	
	
	
	/** 
	 * Filter request for ordering
	 * 
	 * @version 1.2
	 * @updated 00.00.13
	 **/
	function column_orderby( $vars ) {
		
		// Sorting by post_meta numeric values
		if ( isset( $vars['orderby'] ) AND $vars['orderby'] == $this->registered->_post_type ) {
			
			$key_val_compair = array(
				'meta_compare'	=> '>',
				'meta_value'	=> 0,
				'orderby'		=> 'meta_value_num'
				);
				
			switch ( $vars['orderby'] ) {
				
				case "featured" :
					
					$key_val_compair['meta_key'] = 'vc_featured_priority';
					$vars = array_merge( $vars, $key_val_compair );
					
				break;
				
			} // end switch ( $vars['orderby'] )
			
		} // end if ( $vars['post_type'] == $this->post_type AND isset( $vars['orderby'] ) )

		return $vars;
		
	} // end function column_orderby
	
	
	
	
	
	
	/**
	 * Add Columns Manage Page
	 * 
	 * @version 1.3
	 * @updated 00.00.13
	 **/
	function edit_columns( $columns ) {
		
		$columns['video-url'] = __( 'Video URL', 'childtheme' );
		$columns['video-cat'] = __( 'Category', 'childtheme' );
		$columns['image'] = __( 'Image', 'childtheme' );
		$columns['video-image'] = __( 'Video Image', 'childtheme' );
		$columns['order'] = __( 'Order', 'childtheme' );
		
		unset( $columns['date'] );
		
		return $columns;
	
	} // end edit_columns
	
	
	
	
	
	
	/**
	 * Add Columns Details
	 * 
	 * @version 1.2
	 * @updated 00.00.13
	 **/
	function custom_columns( $column ) {
		global $post;
		
		if ( $post->post_type == $this->registered->_post_type ) {
			$video_url_oembed = get_post_meta( $post->ID, '_video_url_oembed', true );
			$video_thumbnail_oembed = get_post_meta( $post->ID, '_video_thumbnail_oembed', true );
			
			switch ( $column ) {

				case "order" :
					echo $post->menu_order;
					break;
				case "image":
					if ( has_post_thumbnail( $post->ID ) )
						echo get_the_post_thumbnail( $post->ID, array( 50, 50 ) );
					break;
				case "video-image" : 
					if ( isset( $video_thumbnail_oembed ) AND ! empty( $video_thumbnail_oembed ) ) {
						echo "<img style=\"max-width:50px;height:auto;\" src=\"$video_thumbnail_oembed\" alt=\"\" />";
					}
					break;
				case "video-url" :
					if ( isset( $video_url_oembed ) AND ! empty( $video_url_oembed ) ) {
						echo "<a href=\"$video_url_oembed\" target=\"_blank\">$video_url_oembed</a>";
					}
					break;
				case "video-cat" :
					$terms = wp_get_post_terms( $post->ID, 'video-cat' );
					foreach ( $terms as $term ) {
						$_terms[] = $term->name;
					}
					echo implode( ', ', $_terms );
					break;
					
			} // end switch
			
		} // end if
	
	} // end custom_columns
	
	
	
} // end class VideoPostType