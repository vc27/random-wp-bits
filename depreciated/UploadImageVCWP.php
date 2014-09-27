<?php
/**
 * File Name UploadImageVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * UploadImageVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
class UploadImageVCWP {
	
	
	
	/**
	 * have_image
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_image = 0;
	
	
	
	/**
	 * image
	 * 
	 * @access public
	 * @var string
	 **/
	var $image = null;
	
	
	
	/**
	 * have_post_id
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_post_id = 0;
	
	
	
	/**
	 * post_id
	 * 
	 * @access public
	 * @var string
	 **/
	var $post_id = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		// 

	} // end function __construct
	
	
	
	
	
	
	/**
	 * require__wp_image_functions
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function require__wp_image_functions() {

		require_once( ABSPATH . "wp-admin/includes/image.php" );

	} // end function require__wp_image_functions
	
	
	
	
	
	
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
	 * set__attachment
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__attachment() {
		
		$this->attachment = array(
			'menu_order' => 1,
			'post_content' => '',
			'post_status' => 'inherit'
			);
		
		if ( $this->have_file_type('type') ) {
			$this->attachment['post_mime_type'] = $this->file_type['type'];
		}
		
		if ( $this->have_post_id() ) {
			$this->attachment['post_title'] = get_the_title( $this->post_id );
		}
		
		if ( $this->have_upload_dir_path('url') ) {
			$this->attachment['guid'] = $this->upload_dir['url'] . "/" . basename( $this->new_image );
		}
		
	} // end function set__attachment
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * upload_image
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function upload_image( $image, $post_id = '' ) {
		
		$this->set( 'image', $image );
		$this->set( 'post_id', $post_id );
		$this->set( 'errors', new WP_Error() );
		
		if ( $this->have_image() ) {
			
			$this->set( 'upload_dir', wp_upload_dir() );
			$this->set( 'file_name', sanitize_file_name( basename( $this->image ) ) );
			
			if ( $this->have_upload_dir_path('path') AND $this->have_file_name() ) {
				$this->set( 'new_image' = $this->upload_dir['path'] . "/$file_name";
				
				$this->curl();

				// Setup New Image
				$this->set( 'file_type', wp_check_filetype( basename( $this->new_image ), null ) );
				
				$this->set__attachment();
				$this->require__wp_image_functions();
				
				if ( function_exists( 'wp_insert_attachment' ) ) {
					
					$this->set( 'attach_id', wp_insert_attachment( $this->attachment, $this->new_image, $this->post_id ) );
					if ( $this->have_attach_id() ) {
						
						$this->set( 'attach_data', wp_generate_attachment_metadata( $this->attach_id, $this->new_file );
						
						if ( $this->have_attach_data() ) {
							$this->set( 'update_attachment_metadata', wp_update_attachment_metadata( $this->attach_id, $this->attach_data ) );
						} else {
							$this->errors->add( 'attach-data', 'wp_generate_attachment_metadata failed to general an array' );
						}
                        
						if ( $this->have_post_id() ) {
							$this->set( 'update_post_meta', update_post_meta( $this->post_id, "_thumbnail_id", $this->attach_id ) );
						}
						
					} else {
						
						$this->errors->add( 'wp-insert-attachment', 'wp_insert_attachment failed' );
						
					}
				
				} else {
					
					$this->errors->add( 'wp-image-functions', 'WordPress Image functions are missing - wp-admin/includes/image.php' );
					
				}
				
			} else {
				
				$this->errors->add( 'new-file', 'Your upload dir path or file name was missing or empty' );
				
			}
			
		} else {
			
			$this->errors->add( 'have-image', 'The image was missing or empty.' );
			
		}
		
		return $this;

	} // end function upload_image
	
	
	
	
	
	
	/**
	 * curl
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function curl() {
		
		$ch = curl_init( $this->image );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 10 );
		curl_setopt( $ch, CURLOPT_BINARYTRANSFER, 10 );
		$rawdata = curl_exec( $ch );
		curl_close( $ch );
		$fp = fopen( $this->new_image, 'w' );
		fwrite( $fp, $rawdata );
		fclose( $fp );
		
	} // end function curl
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_image
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_image() {
		
		if ( isset( $this->image ) AND ! empty( $this->image ) ) {
			$this->set( 'have_image', 1 );
		} else {
			$this->set( 'have_image', 0 );
		}
		
		return $this->have_image;
		
	} // end function have_image
	
	
	
	
	
	
	/**
	 * have_post_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_post_id() {
		
		if ( isset( $this->post_id ) AND ! empty( $this->post_id ) ) {
			$this->set( 'have_post_id', 1 );
		} else {
			$this->set( 'post_id', 0 );
			$this->set( 'have_post_id', 0 );
		}
		
		return $this->have_post_id;
		
	} // end function have_post_id 
	
	
	
	
	
	
	/**
	 * have_upload_dir_path
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_upload_dir_path( $key ) {
		
		if ( isset( $this->upload_dir ) AND is_array( $this->upload_dir ) AND ! empty( $this->upload_dir ) AND isset( $this->upload_dir[$key] ) AND ! empty( $this->upload_dir[$key] ) ) {
			$this->set( 'have_upload_dir_path', 1 );
		} else {
			$this->set( 'have_upload_dir_path', 0 );
		}
		
		return $this->have_upload_dir_path;
		
	} // end function have_upload_dir_path 
	
	
	
	
	
	
	/**
	 * have_file_name
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_file_name() {
		
		if ( isset( $this->file_name ) AND ! empty( $this->file_name ) ) {
			$this->set( 'have_file_name', 1 );
		} else {
			$this->set( 'have_file_name', 0 );
		}
		
		return $this->have_file_name;
		
	} // end function have_file_name
	
	
	
	
	
	
	/**
	 * have_file_type
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_file_type( $key ) {
		
		if ( isset( $this->file_type ) AND is_array( $this->file_type ) AND ! empty( $this->file_type ) AND isset( $this->file_type[$key] ) AND ! empty( $this->file_type[$key] ) ) {
			$this->set( 'have_file_type', 1 );
		} else {
			$this->set( 'have_file_type', 0 );
		}
		
		return $this->have_file_type;
		
	} // end function have_file_type 
	
	
	
	
	
	
	/**
	 * have_attach_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_attach_id() {
		
		if ( isset( $this->attach_id ) AND ! empty( $this->attach_id ) AND is_numeric( $this->attach_id ) ) {
			$this->set( 'have_attach_id', 1 );
		} else {
			$this->set( 'have_attach_id', 0 );
		}
		
		return $this->have_attach_id;
		
	} // end function have_attach_id 
	
	
	
	
	
	
	/**
	 * have_attach_data
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_attach_data() {
		
		if ( isset( $this->attach_data ) AND is_array( $this->attach_data ) AND ! empty( $this->attach_data ) ) {
			$this->set( 'have_attach_data', 1 );
		} else {
			$this->set( 'have_attach_data', 0 );
		}
		
		return $this->have_attach_data;
		
	} // end function have_attach_data
	
	
	
	
	
	
	/**
	 * have_errors
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_errors() {
		
		if ( is_wp_error( $this->errors ) ) {
			$this->set( 'have_errors', 1 );
		} else {
			$this->set( 'have_errors', 0 );
		}
		
		return $this->have_errors;
		
	} // end function have_errors
	
	
	
} // end class UploadImageVCWP