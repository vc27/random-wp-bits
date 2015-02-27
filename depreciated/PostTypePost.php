<?php
/**
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * PostTypePost
 **/
$PostTypePost = new PostTypePost();
class PostTypePost {
	
	
	
	/**
	 * post_type
	 * 
	 * @access public
	 * @var string
	 **/
	var $post_type = 'post';
	
	
	
	/**
	 * name
	 * 
	 * @access public
	 * @var string
	 **/
	var $name = 'Post';
	
	
	
	
	
	
	/**
	 * __construct
	 **/
	function __construct() {
		
		// hook method after_setup_theme
		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );

		// hook method init
		add_action( 'init', array( &$this, 'init' ) );

		// hook method admin_init
		// add_action( 'admin_init', array( &$this, 'admin_init' ) );
		
		// Add a metabox to this post-type
		// add_filter( 'tester_metabox_id-included_post_types', array( &$this, 'add_external_metaboxes' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 **/
	// function after_setup_theme() {} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 **/
	function init() {
		add_action( 'the_post', array( &$this, 'the_post' ) );
		add_action( 'template_redirect', array( &$this, 'template_redirect' ) );
		add_filter( 'parenttheme-localize_script', array( &$this, 'filter_localize_script' ), 11 );
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
	
	
	
	
	
	
	/**
	 * add_external_metaboxes
	 * 
	 * Description:
	 * Works in conjunction with existing filter used with in
	 * post-meta-vc.php. It will add the post type to the metabox
	 * that is being specified.
	 **/
	function add_external_metaboxes( $post_types ) {
		
		$post_types[] = $this->post_type;
		return $post_types;
		
	} // end function add_external_metaboxes
	
	
	
	
	
	
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
		
		if ( 
			is_single() 
			AND isset( $wp_query->post ) 
			AND isset( $wp_query->post->post_type )
			AND $wp_query->post->post_type == $this->post_type
		) {
			$array['post'] = $this->the_post($wp_query->post);
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
	 * the_post
	 **/
	function the_post( $post ) {
		
		if ( isset( $post->post_type) AND $post->post_type == $this->post_type ) {
			
			$post->permalink = get_permalink( $post->ID );
			if ( has_post_thumbnail( $post->ID ) ) {
				$featuredHeroImage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
				if ( isset( $featuredHeroImage[0] ) AND ! empty( $featuredHeroImage[0] ) ) {
					$post->featuredHeroImage = $featuredHeroImage[0];
				} else {
					$post->featuredHeroImage = 0;
				}
			} else {
				$post->featuredHeroImage = 0;
			}
			$post->content = apply_filters( 'the_content', $post->post_content );
			$post->contentShort = wpautop( wp_trim_words( strip_tags($post->content), 25, ' &hellip;' ) );
			$post = $this->the_post__category( $post );
		}
		
		return $post;
		
	} // end function the_post
	
	
	
	
	
	
	/**
	 * the_post__category
	 **/
	function the_post__category( $post ) {
		
		$post->category = array();
		$terms = wp_get_post_terms( $post->ID, 'category' );
		foreach ( $terms as $term ) {
			$post->category[] = "<a href=\"" . get_term_link( $term, 'category' ) . "\">$term->name</a>";
		}
		
		return $post;
		
	} // end function the_post__category
	
	
	
	
	
	
	/**
	 * pre_get_posts
	 **/
	function pre_get_posts( $wp_query ) {
		
		if ( isset( $wp_query->query['post_type'] ) AND $wp_query->query['post_type'] == $this->post_type ) {
			$wp_query->set( 'posts_per_page', 8 );
		}
		
	} // end function pre_get_posts 
	
	
	
	
	
	
	/**
	 * singlePostRelatedPostsArray
	 **/
	static function singlePostRelatedPostsArray( $args = array() ) {
		global $wp_query, $post;

		$query = array_merge( array(
			'posts_per_page' => 3
			,'post_type' => 'post'
			,'post_status' => 'publish'
		), $args );

		$wp_query = new WP_Query();
		$wp_query->query($query);
		$output = array();
		if ( have_posts() ) {

			while ( have_posts() ) {
				the_post();
				$output[] = $post;
			}

		}
		wp_reset_postdata();
		wp_reset_query();

		return $output;

	} // end static function singlePostRelatedPostsArray
	
	
	
	
	
	
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
	
	
	
} // end class PostTypePost