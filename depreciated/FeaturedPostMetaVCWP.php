<?php
/**
 * File Name FeaturedPostMetaVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 *
 * Description:
 * Add featured post meta boxes to selected post-types. Includes local and global post-type
 * recognition. Adds a custom column plus sorting. Includes filters to easy adding of post types or
 * add post-types from the class variable $included_post_types
 **/
####################################################################################################





/**
 * FeaturedPostMetaVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$FeaturedPostMetaVCWP = new FeaturedPostMetaVCWP();
class FeaturedPostMetaVCWP {
	
	
	
	/**
	 * included_post_types
	 * 
	 * @access public
	 * @var array
	 **/
	var $included_post_types = 	array(
		'page',
		'post',
		);
	
	
	
	/**
	 * filter_name
	 * 
	 * @access public
	 * @var array
	 **/
	var $filter_name = 'featured-content-metabox';
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		// Add Custom Meta Boxes
		add_action( 'add_meta_boxes', array( &$this, 'add_custom_meta_boxes' ) );
		
		// Save Post
		add_action( 'save_post', array( &$this, 'save_post_meta' ), 10, 2 );		
		
		// Post Type Filters
		add_action( 'admin_init', array( &$this, 'add_post_type_column_filters' ) );

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
	 * Add Custom Fields Meta Boxes
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * @uses add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
	 **/
	function add_custom_meta_boxes( $post ) {
		
		$this->included_post_types = apply_filters( $this->filter_name, $this->included_post_types );
		
		foreach ( $this->included_post_types as $post_type ) {
			add_meta_box( "global_featured_content_meta_box", __( 'Global Featured Content', 'childtheme' ), array( &$this, 'global_featured_content_meta_box' ), $post_type, 'side', 'low');
			add_meta_box( "local_featured_content_meta_box", __( 'Local Featured Content', 'childtheme' ), array( &$this, 'local_featured_content_meta_box' ), $post_type, 'side', 'low');
		}
		
	} // end function add_custom_meta_boxes
	
	
	
	
	
	
	/**
	 * Global Featured Content
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function global_featured_content_meta_box( $post ) {
		
		// get the post meta data
		$vc_featured = get_post_meta( $post->ID, '_vc_featured', true );
		$vc_featured_priority = get_post_meta( $post->ID, '_vc_featured_priority', true );

		?>
		
		<p>
			<input type="checkbox" id="vc_featured" name="_vc_featured" <?php checked( $vc_featured, 'on' ); ?>>
			<label for="vc_featured"><?php echo __( 'Featured', 'childtheme' ); ?></label>
		</p>
		
		<p>
			<input style="width:35px;" id="vc_featured_priority" name="_vc_featured_priority" type="text" value="<?php echo $vc_featured_priority; ?>" />
			<label for="vc_featured_priority"><?php echo __( 'Priority', 'childtheme' ); ?></label>
		</p>
		
		<p class="description"><?php echo __( 'Content that has been tagged with "Global Featured Content" will be featured with other post-type content.', 'childtheme' ); ?></p>
		
		<?php
		
		echo "<input type=\"hidden\" name=\"$post->post_type-nonce\" value=\"" . wp_create_nonce( "$post->post_type-nonce" ) . "\" />";
		
	} // end function global_featured_content_meta_box
	
	
	
	
	
	
	/**
	 * Local Featured Content
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function local_featured_content_meta_box( $post ) {
		
		// get the post meta data
		$vc_featured = get_post_meta( $post->ID, '_vc_' . $post->post_type . '_featured', true );
		$vc_featured_priority = get_post_meta( $post->ID, '_vc_' . $post->post_type . '_featured_priority', true );

		?>
		
		<p class="vc-<?php echo $post->post_type; ?>-featured">
			<input type="checkbox" id="vc_<?php echo $post->post_type; ?>_featured" name="_vc_<?php echo $post->post_type; ?>_featured" <?php checked( $vc_featured, 'on' ); ?>>
			<label for="vc_<?php echo $post->post_type; ?>_featured"><?php echo __( 'Local Featured', 'childtheme' ); ?></label>
		</p>
		
		<p class="vc-<?php echo $post->post_type; ?>-featured-priority">
			<input style="width:35px;" id="vc_<?php echo $post->post_type; ?>_featured_priority" name="_vc_<?php echo $post->post_type; ?>_featured_priority" type="text" value="<?php echo $vc_featured_priority; ?>" />
			<label for="vc_<?php echo $post->post_type; ?>_featured_priority"><?php echo __( 'Priority', 'childtheme' ); ?></label>
		</p>
		
		<p class="description"><?php echo __( 'Content that has been tagged with "Local Featured Content" will be local to this post-type content.', 'childtheme' ); ?></p>
		
		<?php
		
		echo "<input type=\"hidden\" name=\"$post->post_type-nonce\" value=\"" . wp_create_nonce( "$post->post_type-nonce" ) . "\" />";
		
	} // end function local_featured_content_meta_box
	
	
	
	
	
	
	/**
	 * Sanitize Post Meta
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function sanitize_post_meta( $new_instance, $post ) {
		
		// Sanitize Global Featured Priority
		if ( ( ! isset( $new_instance['_vc_featured_priority'] ) OR empty( $new_instance['_vc_featured_priority'] ) ) AND ( isset( $new_instance['_vc_featured'] ) AND ! empty( $new_instance['_vc_featured'] ) AND $new_instance['_vc_featured'] == 'on' ) ) {
			
			$instance['_vc_featured'] = $new_instance['_vc_featured'];
			$instance['_vc_featured_priority'] = "01";
			
		} else if ( ( isset( $new_instance['_vc_featured_priority'] ) AND is_numeric( $new_instance['_vc_featured_priority'] ) ) AND ( isset( $new_instance['_vc_featured'] ) AND ! empty( $new_instance['_vc_featured'] ) AND $new_instance['_vc_featured'] == 'on' ) ) {
			
			$instance['_vc_featured'] = $new_instance['_vc_featured'];
			$instance['_vc_featured_priority'] = $this->add_leading_zero( $new_instance['_vc_featured_priority'] );
			
		} else if ( ! isset( $new_instance['_vc_featured'] ) OR empty( $new_instance['_vc_featured'] ) OR $new_instance['_vc_featured'] != 'on' ) {
			
			$instance['_vc_featured'] = false;
			$instance['_vc_featured_priority'] = false;
			
		}
		
		
		// Sanitize Local Featured Priority
		if ( $post->post_type != 'revision' ) {
			$instance['_vc_' . $post->post_type . '_featured'] = false;
			$instance['_vc_' . $post->post_type . '_featured_priority'] = false;
		}
		
		if ( ( ! isset( $new_instance['_vc_' . $post->post_type . '_featured_priority'] ) OR empty( $new_instance['_vc_' . $post->post_type . '_featured_priority'] ) ) AND ( isset( $new_instance['_vc_' . $post->post_type . '_featured'] ) AND ! empty( $new_instance['_vc_' . $post->post_type . '_featured'] ) AND $new_instance['_vc_' . $post->post_type . '_featured'] == 'on' ) ) {
			
			$instance['_vc_' . $post->post_type . '_featured'] = $new_instance['_vc_' . $post->post_type . '_featured'];
			$instance['_vc_' . $post->post_type . '_featured_priority'] = "01";
			
		} else if ( ( isset( $new_instance['_vc_' . $post->post_type . '_featured_priority'] ) AND is_numeric( $new_instance['_vc_' . $post->post_type . '_featured_priority'] ) ) AND ( isset( $new_instance['_vc_' . $post->post_type . '_featured'] ) AND ! empty( $new_instance['_vc_' . $post->post_type . '_featured'] ) AND $new_instance['_vc_' . $post->post_type . '_featured'] == 'on' ) ) {
			
			$instance['_vc_' . $post->post_type . '_featured'] = $new_instance['_vc_' . $post->post_type . '_featured'];
			$instance['_vc_' . $post->post_type . '_featured_priority'] = $this->add_leading_zero( $new_instance['_vc_' . $post->post_type . '_featured_priority'] );
			
		} else if ( ! isset( $new_instance['_vc_' . $post->post_type . '_featured'] ) OR empty( $new_instance['_vc_' . $post->post_type . '_featured'] ) OR $new_instance['_vc_' . $post->post_type . '_featured'] != 'on' ) {
			
			$instance['_vc_' . $post->post_type . '_featured'] = false;
			$instance['_vc_' . $post->post_type . '_featured_priority'] = false;
			
		}
		
		return $instance;
		
	} // end function sanitize_custom_fields
	
	
	
	
	
	
	/**
	 * Update post_meta on save_post
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function save_post_meta( $post_id, $post ) {
		
		// Varify nonce
		if ( isset( $_POST["$post->post_type-nonce"] ) AND ! empty( $_POST["$post->post_type-nonce"] ) AND ! wp_verify_nonce( $_POST["$post->post_type-nonce"], "$post->post_type-nonce" ) )
			return $post_id;
		
		
		// Return if doing autosave
		if ( defined('DOING_AUTOSAVE') AND DOING_AUTOSAVE )  {
			return $post_id;
		}
		
		
		if ( defined('DOING_AJAX') AND DOING_AJAX ) {
			return $post_id;
		}
		
		
		// Restrict User
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
			
		
		// New
		$new_instance = $this->sanitize_post_meta( $_POST, $post );

		foreach ( $new_instance as $key => $val ) {

			$old = get_post_meta( $post_id, $key, true );
			if ( !empty( $val ) )
				update_post_meta( $post_id, $key, $val, $old );
			elseif ( empty( $val ) )
				delete_post_meta( $post_id, $key, $val);

		} // end foreach ( $new as $key => $val )
		
		
	} // end function save_post_meta
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Post Type filters
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Filter post-type columns
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function add_post_type_column_filters() {
		
		$this->included_post_types = apply_filters( $this->filter_name, $this->included_post_types );
		
		foreach ( $this->included_post_types as $post_type ) {
			
			// Add column specific order filtering to Post & Page manage table
			add_filter( 'manage_edit-' . $post_type . '_sortable_columns', array( &$this, 'column_register_sortable' ) );

			// Add Column to Post & Page manage table
			add_filter( 'manage_edit-' . $post_type . '_columns', array( &$this, "edit_columns" ) );
			
		}
		
		// Add Columns content to Post & Page manage table
		add_action( "manage_pages_custom_column", array( &$this, "custom_columns" ) );
		add_action( "manage_posts_custom_column", array( &$this, "custom_columns" ) );
		
		
		add_filter( 'request', array( &$this, 'column_orderby' ) );
		
		
		// Added for taxonomy filtering
		add_action( 'restrict_manage_posts', array( &$this, 'restrict_manage_html_filters' ) );
		add_filter( 'pre_get_posts', array( &$this, 'post_type_parse_query' ) );
		
	} // end function add_post_type_column_filters






	/**
	 * Register the column as sortable
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function column_register_sortable( $columns ) {

		$columns['featured'] = 'featured';

		return $columns;
	
	} // end function column_register_sortable






	/** 
	 * filter request for ordering
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function column_orderby( $vars ) {
		
		// Sorting by vc_featured_priority
		if ( isset( $vars['orderby'] ) AND $vars['orderby'] == 'featured' ) {

			$new_vars = array(
				'meta_key'		=> '_vc_' . $vars['post_type'] . '_featured_priority',
				'meta_compare'	=> '>',
				'meta_value'	=> 0,
				'orderby'		=> 'meta_value_num'
				);

			$vars = array_merge( $vars, $new_vars );

		}

		return $vars;
	
	} // end function column_orderby






	/**
	 * Add Featured Image to the Post and Page section of the WP admin edit 
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function edit_columns( $columns ) {
		global $post;

		if ( in_array( $post->post_type, apply_filters( $this->filter_name, $this->included_post_types ) ) )
			$columns['featured'] = 'Featured';

		return $columns;

	} // end function edit_columns





	/**
	 * Add Custom Columns to Post & Page
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function custom_columns( $column ) {
		global $post;

		if ( in_array( $post->post_type, apply_filters( $this->filter_name, $this->included_post_types ) ) ) {

			switch ( $column ) {

				case 'featured':
					if ( $priority = get_post_meta( $post->ID, '_vc_' . $post->post_type . '_featured_priority', true ) )
						echo "<span style=\"color:green;\">&#8730; <strong>$priority</strong></span>";
					else
						echo "<span style=\"color:red;\">&#8709;</span>";
					break;

			} // end switch

		} // endif
	
	} // end function custom_columns
	
	
	
	
	
	
	/**
	 * Add html for dropdown select containing taxonomies
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * Notes:
	 * There are no parameters, but there are two globals available
	 * Available:
	 * $post_type_object->taxonomies
	 * $post_type_object->query_var
	 **/
	function restrict_manage_html_filters() {
		global $post_type_object, $cat;
		
		if ( isset( $post_type_object ) AND in_array( $post_type_object->name, apply_filters( $this->filter_name, $this->included_post_types ) ) ) {
			
			if ( ! isset( $_GET['global-featured-vc'] ) )
				echo " &nbsp;<input type=\"submit\" class=\"button-secondary\" name=\"global-featured-vc\" value=\"" . esc_attr__( 'Display Global Featured', 'childtheme' ) . "\" />&nbsp; ";
			else
				echo " &nbsp;<a style=\"display:inline !important;\" class=\"button-secondary\" href=\"" . home_url() . "/wp-admin/edit.php?post_type=" . $post_type_object->name . "\">" . __( 'Display All', 'childtheme' ) . "</a>&nbsp; ";
			
		} // end if ( in_array () )
		
	} // end restrict_manage_html_filters
	
	
	
	
	
	
	/**
	 * Filter results of page based on the "restrict_manage" variable
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function post_type_parse_query( $query ) {
		global $pagenow;
		
		// Make sure we are filtering the edit.php query
		if ( is_admin() AND $pagenow == 'edit.php' AND isset( $_GET['global-featured-vc'] ) ) {
			
			$query->set( 'meta_key', '_vc_featured_priority' );
			$query->set( 'meta_compare', '>' );
			$query->set( 'meta_value', 0 );
			$query->set( 'orderby', 'meta_value_num' );
			
		}
	
	} // end function post_type_parse_query
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Added Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Add Leading "0"
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function add_leading_zero( $number ) {
		
		// Add leading "0" to numbers below 10
		if ( $number > 0 AND $number < 10 AND strlen( $number ) == 1 )
			$number = "0" . $number;
		
		return $number;
		
	} // end function add_leading_zero
	
	
	
} // end class FeaturedPostMetaVCWP