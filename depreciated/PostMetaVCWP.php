<?php
/**
 * File Name PostMetaVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.1
 * @updated 09.04.13
 *
 * Notes: 
 * This Class must be ran before admin_init in order to be used properly.
 **/
####################################################################################################




if ( class_exists( 'PostMetaVCWP' ) ) return;



/* 
Default Usage Array

$default_metabox = array(
	'id' => 'special_meta_box_test', // required
	'title' => 'Testing', 
	'context' => 'side', // options: normal, side
	'priority' => 'default', // ('high', 'core', 'default' or 'low')
	'desc' => 'my metabox desc',
	// 'save_action' => false, // defaults to 'save_post'
	'post_meta' => array( // array of post_meta fields
		array(
			'type' => 'text',
			'validation' => 'text',
			'title' => 'test 1',
			'name' => '_test_1', // post_meta name and field name
			'options' => false, // used for radio, checkbox, select
			'val' => false, // Default starting value
			'desc' => 'my cool description',
			),
		),
	);
*/





/**
 * PostMetaVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
class PostMetaVCWP {
	
	
	
	/**
	 * admin_init__priority
	 * 
	 * @access public
	 * @var array
	 **/
	var $admin_init__priority = 10;
	
	
	
	/**
	 * add_meta_boxes__priority
	 * 
	 * @access public
	 * @var array
	 **/
	var $add_meta_boxes__priority = 10;
	
	
	
	/**
	 * save_post__priority
	 * 
	 * @access public
	 * @var array
	 **/
	var $save_post__priority = 10;
	
	
	
	/**
	 * post_types
	 * 
	 * @access public
	 * @var array
	 **/
	var $post_types = array();
	
	
	
	/**
	 * have_post_types
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_post_types = 0;
	
	
	
	/**
	 * metabox
	 * 
	 * @access public
	 * @var array
	 **/
	var $metabox = array();
	
	
	
	/**
	 * have_metabox
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_metabox = 0;
	
	
	
	/**
	 * have_metabox_callback
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_metabox_callback = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		// do nothing

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 **/
	function after_setup_theme() {
		
		// 
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/init
	 * 
	 * Description:
	 * Runs after WordPress has finished loading but before any headers are sent.
	 **/
	function init() {
		
        //
		
	} // end function init
	
	
	
	
	
	
	/**
	 * admin_init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
	 * 
	 * Description:
	 * admin_init is triggered before any other hook when a user access the admin area.
	 * This hook doesn't provide any parameters, so it can only be used to callback a 
	 * specified function.
	 **/
	function admin_init() {
		
		// Add Custom Meta Boxes
		add_action( 'add_meta_boxes', array( &$this, 'add_custom_meta_boxes' ), $this->add_meta_boxes__priority );
		
		// Save Post
		add_action( 'save_post', array( &$this, 'save_post_meta' ), $this->save_post__priority, 2 );
		
	} // end function admin_init
	
	
	
	
	
	
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
	
	
	
	
	
	
	/**
	 * set_metabox_callback
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set_metabox_callback() {
		
		$this->metabox['callback'] = array( &$this, 'meta_box' );
		
	} // end function set_metabox_callback
	
	
	
	
	
	
	/**
	 * apply_filters__post_types
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function apply_filters__post_types() {
		
		$this->post_types = apply_filters( $this->metabox['id'] . "-included_post_types", $this->post_types );		
		
	} // end function apply_filters__post_types
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * register__post_meta
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function register__post_meta( $post_types = array(), $metabox = array() ) {
		
		$this->set( 'post_types', $post_types );
		$this->set( 'metabox', $metabox );
		
		if ( $this->have_post_types() AND $this->have_metabox() ) {
			
			// hook method admin_init
			add_action( 'admin_init', array( &$this, 'admin_init' ), $this->admin_init__priority );
			
		}
		
		return $this;
		
	} // end function register__post_meta
	
	
	
	
	
	
	/**
	 * Add Custom Fields Meta Boxes
	 *
	 * @uses add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function add_custom_meta_boxes( $post ) {
		
		// Filter post_types array to allow other post_type's to utilize this metabox
		$this->apply_filters__post_types();
		
		if ( ! $this->have_metabox_callback() ) {
			$this->set_metabox_callback();
		}
		
		foreach ( $this->post_types as $post_type ) {
			add_meta_box( $this->metabox['id'], $this->metabox['title'], $this->metabox['callback'], $post_type, $this->metabox['context'], $this->metabox['priority'], $this->metabox );
		}
		
		
	} // end function add_custom_meta_boxes
	
	
	
	
	
	
	/**
	 * meta_box
	 *
	 * @version 1.1
	 * @updated 09.04.13
	 **/
	function meta_box( $post, $metabox ) {
		
		if ( is_array( $metabox ) AND !empty( $metabox ) ) {
			
			// Set Meta Box Description
			if ( isset( $metabox['args']['desc'] ) and ! empty( $metabox['args']['desc'] ) ) 
				echo "<p class=\"description\">" . $metabox['args']['desc'] . "</p>";
			
			// 'normal', 'advanced', or 'side'
			switch ( $metabox['args']['context'] ) {
				
				case "side" :
					// Loop through fields
					foreach ( $metabox['args']['post_meta'] as $post_meta ) {
						
						// Desc
						if ( isset( $post_meta['desc'] ) AND ! empty( $post_meta['desc'] ) ) {
							$desc = $post_meta['desc'];
						} else {
							$desc = false;
						}
						
						// Name
						if ( isset( $post_meta['name'] ) AND ! empty( $post_meta['name'] ) ) {
							$name = $post_meta['name'];
						} else {
							$name = false;
						}
						
						// Options
						if ( isset( $post_meta['options'] ) AND ! empty( $post_meta['options'] ) ) {
							$options = $post_meta['options'];
						} else {
							$options = false;
						}
						
						$value = get_post_meta( $post->ID, $name, true );						
						if ( ! isset( $value ) OR empty( $value ) AND isset( $post_meta['value'] ) AND ! empty( $post_meta['value'] ) ) {
							$value = $post_meta['value'];
						}
						
						echo $this->before_form_fields( $post_meta, $metabox );
						
						if ( function_exists( 'form__field' ) ) {
							form__field( $post_meta['type'], $name, $value, $name, false, $desc, $options, $metabox['id'] . "-$post->post_type-add_settings_field", $post_meta );
						} else {
							echo "Required function form__field() is not available.";
						}
						
						echo $this->after_form_fields( $post_meta, $metabox );
						
					} // end foreach ( $metabox['args']['post_meta'] )
					break;
				case "normal" :
				case "advanced" :
				default :
					echo "<table class=\"form-table\">";
						// Loop through fields
						foreach ( $metabox['args']['post_meta'] as $post_meta ) {
							
							// Name
							if ( isset( $post_meta['name'] ) AND ! empty( $post_meta['name'] ) ) {
								$name = $post_meta['name'];
							} else {
								$name = false;
							}
							
							// Options
							if ( isset( $post_meta['options'] ) AND ! empty( $post_meta['options'] ) ) {
								$options = $post_meta['options'];
							} else {
								$options = false;
							}
							
							// Desc
							if ( isset( $post_meta['desc'] ) AND ! empty( $post_meta['desc'] ) ) {
								$desc = $post_meta['desc'];
							} else {
								$desc = false;
							}
							
							$value = get_post_meta( $post->ID, $name, true );
							if ( ! isset( $value ) OR empty( $value ) AND isset( $post_meta['value'] ) AND ! empty( $post_meta['value'] ) ) {
								$value = $post_meta['value'];
							}
							
							echo $this->before_form_fields( $post_meta, $metabox );
							
							if ( function_exists( 'form__field' ) ) {
								form__field( $post_meta['type'], $name, $value, $name, false, $desc, $options, $metabox['id'] . "-$post->post_type-add_settings_field", $post_meta );
							} else {
								echo "Required function form__field() is not available.";
							}
							
							echo $this->after_form_fields( $post_meta, $metabox );
							
						} // end foreach ( $metabox['args']['post_meta'] )
					echo "</table>";
					break;
				
			} // end switch ( $metabox['args']['context'] )
			
		}
		
		
		// wp_nonce_field( $action, $name, $referer, $echo )
		echo "<input type=\"hidden\" name=\"$post->post_type-nonce-vcwp\" value=\"" . wp_create_nonce( "$post->post_type-nonce-vcwp" ) . "\" />";
		
	} // end function meta_box
	
	
	
	
	
	
	/**
	 * Sanitize Post Meta
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function sanitize_post_meta( $new_instance, $post ) {
		
		foreach ( $this->metabox['post_meta'] as $post_meta ) {
			
			if ( isset( $post_meta['name'] ) AND ! empty( $post_meta['name'] ) AND isset( $new_instance[$post_meta['name']] ) AND ! empty( $new_instance[$post_meta['name']] ) ) {
				if ( function_exists( 'sanitize__value' ) ) {
					$instance[$post_meta['name']] = sanitize__value( $post_meta['validation'], $new_instance[$post_meta['name']], $this->metabox['id'] . "-$post->post_type-sanitize-post_meta", $post_meta );
				} else {
					$instance[$post_meta['name']] = 'Required function sanitize__value() is not available.';
				}
			}
			
			if ( isset( $post_meta['name'] ) AND ! empty( $post_meta['name'] ) AND ( ! isset( $new_instance[$post_meta['name']] ) OR empty( $new_instance[$post_meta['name']] ) ) ) {
				$instance[$post_meta['name']] = false;
			}
			
		}
		
		return apply_filters( "sanitize_post_meta-$post->post_type", $instance );
		
	} // end function sanitize_post_meta
	
	
	
	
	
	
	/**
	 * Update post_meta on save_post
	 *
	 * @version 1.2
	 * @updated 06.10.13
	 **/
	function save_post_meta( $post_id, $post ) {
		
		// Varify nonce -- check_admin_referer( $action, $query_arg )
		if ( ! isset( $_POST["$post->post_type-nonce-vcwp"] ) OR ! wp_verify_nonce( $_POST["$post->post_type-nonce-vcwp"], "$post->post_type-nonce-vcwp" ) ) {
			return $post_id;
		}
		
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
		
		if ( is_array( $new_instance ) ) {
			foreach ( $new_instance as $key => $val ) {

				$old = get_post_meta( $post_id, $key, true );
				
				if ( !empty( $val ) ) {
					update_post_meta( $post_id, $key, $val, $old );
				} elseif ( empty( $val ) ) {
					delete_post_meta( $post_id, $key, $val);
				}

			} // end foreach ( $new as $key => $val )
		}
		
		
	} // end function save_post_meta
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_post_types
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_post_types() {
		
		if ( isset( $this->post_types ) AND is_array( $this->post_types ) AND ! empty( $this->post_types ) ) {
			$this->set( 'have_post_types', 1 );
		} else {
			$this->set( 'have_post_types', 0 );
		}
		
		return $this->have_post_types;
		
	} // end function have_post_types 
	
	
	
	
	
	
	/**
	 * have_metabox
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_metabox() {
		
		if ( 
			isset( $this->metabox ) AND is_array( $this->metabox ) AND ! empty( $this->metabox ) 
			AND isset( $this->metabox['id'] ) AND ! empty( $this->metabox['id'] ) 
			AND isset( $this->metabox['title'] ) AND ! empty( $this->metabox['title'] )
			AND isset( $this->metabox['context'] ) AND ! empty( $this->metabox['context'] )
			AND isset( $this->metabox['priority'] ) AND ! empty( $this->metabox['priority'] )
			) {
			$this->set( 'have_metabox', 1 );
		} else {
			$this->set( 'have_metabox', 0 );
		}
		
		return $this->have_metabox;
		
	} // end function have_metabox 
	
	
	
	
	
	
	/**
	 * have_metabox_callback
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_metabox_callback() {
		
		if ( isset( $this->metabox['callback'] ) AND ! empty( $this->metabox['callback'] ) ) {
			$this->set( 'have_metabox_callback', 1 );
		} else {
			$this->set( 'have_metabox_callback', 0 );
		}
		
		return $this->have_metabox_callback;
		
	} // end function have_metabox
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Helper Functions
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Before form_fields
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function before_form_fields( $post_meta, $metabox ) {
		
		// 'normal', 'advanced', or 'side'
		switch ( $metabox['args']['context'] ) {
			
			case "side" :
				if ( $post_meta['type'] == 'title' ) {
					$output = "<div class=\"form-field-vc\"><h4>" . $post_meta['title'] . "</h4>";
					if ( $post_meta['desc'] ) {
						$output .= "<p>" . $post_meta['desc'] . "</p>";
					}
				} else {
					$output = "<div class=\"form-field-vc\">" . $post_meta['title'] . "&nbsp;";
				}
				break;
			case "normal" :
			case "advanced" :
			default :
				if ( $post_meta['type'] == 'title' ) {
					$output = "</table><h4>" . $post_meta['title'] . "</h4>";
					if ( $post_meta['desc'] ) {
						$output .= "<p>" . $post_meta['desc'] . "</p>";
					}
					$output .= "<table class=\"form-table\">";
				} else if ( in_array( $post_meta['type'], array( 'text_editor', 'simple_text_editor' ) ) ) {
					$output = "</table><h4>" . $post_meta['title'] . "</h4><div class=\"text-editor-wrap\">";
				} else {
					$output = "<tr class=\"form-field\"><th scope=\"row\" valign=\"top\">" . $post_meta['title'] . "</th><td>";
				}
				break;
			
		} // end switch ( $metabox['args']['context'] )
		
		return $output;
		
	} // end function before_form_fields
	
	
	
	
	
	
	/**
	 * After form_fields
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function after_form_fields( $post_meta, $metabox ) {
		
		// 'normal', 'advanced', or 'side'
		switch ( $metabox['args']['context'] ) {
			
			case "side" :
				$output = "</div>";
				break;
			case "normal" :
			case "advanced" :
			default :
				if ( in_array( $post_meta['type'], array( 'text_editor', 'simple_text_editor' ) ) ) {
					$output = "</div><table class=\"form-table\">";
				}
				else
					$output = "</td></tr>";
				break;
			
		} // end switch ( $metabox['args']['context'] )
		
		return $output;
		
	} // end function after_form_fields
	
	
	
} // end class PostMetaVCWP