<?php
/**
 * File Name OEmbedPostMetaVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.1
 * @updated 08.13.13
 **/
####################################################################################################





/**
 * OEmbedPostMetaVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$OEmbedPostMetaVCWP = new OEmbedPostMetaVCWP();
class OEmbedPostMetaVCWP {
	
	
	
	/**
	 * included_post_types
	 * 
	 * @access public
	 * @var array
	 **/
	var $included_post_types = array( 'post', 'page' );
	
	
	
	/**
	 * filter_name
	 * 
	 * @access public
	 * @var array
	 **/
	var $filter_name = 'oembed-included_post_types';
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		add_action( 'add_meta_boxes', array( &$this, 'add_custom_meta_boxes' ) );
		
		// Save Post
		add_action( 'save_post', array( &$this, 'save_post_meta' ), 10, 2 );
		
		
		// Convert v1 to v2
		/*if ( is_admin() AND ! get_option('converted-OEmbed_Post_Meta_VC') ) {
			$this->convert_OEmbed_Post_Meta_VC();
		}*/

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
	 * @uses add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
	 *
	 * @version 2.0
	 * @updated 00.00.14
	 **/
	function add_custom_meta_boxes( $post ) {
		
		// Filter post_types array to allow other post_type's to utilize this metabox
		$this->included_post_types = apply_filters( $this->filter_name, $this->included_post_types );
		
		foreach ( $this->included_post_types as $post_type ) {
			if ( $post_type == 'video' ) {
				$priority = 'high';
			} else {
				$priority = 'default';
			}
			
			add_meta_box( 'video-meta-box', 'Video Embed', array( $this, 'meta_box' ), $post_type, 'normal', $priority );
		}
		
		
	} // end function add_custom_meta_boxes
	
	
	
	
	
	
	/**
	 * Custom Meta Box
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function meta_box( $post, $metabox ) {
		
		$oembed_video_url = get_post_meta( $post->ID, '_video_url_oembed', true );
		$oembed_video_thumbnail = get_post_meta( $post->ID, '_video_thumbnail_oembed', true );
		$oembed_video_data = get_post_meta( $post->ID, '_video_data_oembed', true );
		
		?>
		<p class="description">WordPress comes equipped with a number of auto embed features. This video embed feature takes advantage of the built in oembed for YouTube and Vimeo.</p>
		
		<table class="form-table">
			
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="_video_url_oembed">Video URL</label>
				</th>
				<td>
					<input id="_video_url_oembed" type="text" name="_video_url_oembed" value="<?php echo $oembed_video_url; ?>" />
					<?php 
					
					if ( !$oembed_video_url )
						echo "<p class=\"description\">Enter the video url and update the post. A shortcode will be made available and the video will be added attached to this post.</p>";
					
					?>
				</td>
			</tr>
			
			<?php 
			
			if ( $oembed_video_url ) {
				
				?>
				
				<tr class="form-field">
					<th scope="row" valign="top">
						<label>Video Shortcode</label>
					</th>
					<td>
						<input id="oembed_video_url" name="oembed_video_url" type="text" disabled="disabled" value='[embed]<?php echo $oembed_video_url; ?>[/embed]' />
						<p><input style="width:100px;cursor:pointer" type="button" name="send-to-editor" value="Send to editor" /></p>
						<p class="description">You may add a specific width and height to the embed code after it has been sent to the editor.<br />e.g. [embed width="123" height="456"]<?php echo $oembed_video_url; ?>[/embed]</p>
						<script type="text/javascript">
							jQuery(document).ready(function($) {

								$('input[name="send-to-editor"]').click(function() {
									window.send_to_editor( $('input[name="oembed_video_url"]').val() );
								});

							});
						</script>
					</td>
				</tr>
				
				<?php
				
			} // end if ( $oembed_video_url )
			
			if ( $oembed_video_thumbnail ) {
				
				?>
				
				<tr class="form-field">
					<th scope="row" valign="top">
						<label>Video Thumbnail</label>
					</th>
					<td>
						<p><img style="max-width:80%;height:auto;" src="<?php echo $oembed_video_thumbnail; ?>" alt="" /></p>
						<p class="description">This image is pulled directly from video data associated with the given url. If you would like to update this image you must <a href="<?php echo $oembed_video_url; ?>" target="_blank">manage it through the associated video platform</a> then return here and update this page.</p>
					</td>
				</tr>
				
				<?php
				
			} // end if ( $oembed_video_thumbnail )
			
			?>
			
		</table>
		
		<?php

		echo "<input type=\"hidden\" name=\"$post->post_type-nonce-vcwp\" value=\"" . wp_create_nonce( "$post->post_type-nonce-vcwp" ) . "\" />";
		
	} // end function vc_custom_page_meta
	
	
	
	
	
	
	/**
	 * Sanitize Post Meta
	 *
	 * @version 1.4
	 * @updated 01.19.13
	 **/
	function sanitize_post_meta( $new_instance, $post ) {
		
		if ( $post->post_type != 'revision' AND isset( $new_instance['_video_url_oembed'] ) AND ! empty( $new_instance['_video_url_oembed'] ) AND wp_verify_nonce( $_POST["$post->post_type-nonce-vcwp"], "$post->post_type-nonce-vcwp" ) ) {
			
			$oembed_video_url = get_post_meta( $post->ID, '_video_url_oembed', true );
			$oembed_video_data = get_post_meta( $post->ID, '_video_data_oembed', true );
			
			if ( $new_instance['_video_url_oembed'] != $oembed_video_url OR empty( $oembed_video_data ) ) {
				$instance = $this->embed_oembed_html( $new_instance['_video_url_oembed'], $post->ID );
				$instance['_video_url_oembed'] = $new_instance['_video_url_oembed'];
			} else {
				$instance = false;
			}
		
		} else if ( empty( $new_instance['_video_url_oembed'] ) ) {
			
			delete_post_meta( $post->ID, '_video_url_oembed' );
			delete_post_meta( $post->ID, '_video_thumbnail_oembed' );
			delete_post_meta( $post->ID, '_video_data_oembed' );
			$instance = false;
			
		} else {
			
			$instance = false;
			
		}
		
		return $instance;
		
	} // end function sanitize_post_meta
	
	
	
	
	
	
	/**
	 * Filter embed_oembed_html
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * based on filter 'embed_oembed_html', $html, $url, $attr, $post_ID )
	 **/
	function embed_oembed_html( $url, $post_ID ) {
		
		if ( ! class_exists( 'WP_oEmbed' ) ) {
			require_once( ABSPATH . WPINC . '/class-oembed.php' );
		}
		
		$WP_oEmbed = new WP_oEmbed();
		$provider = $WP_oEmbed->discover( $url );
		$data = $WP_oEmbed->fetch( $provider, $url );
		
		if ( isset( $data ) AND $data != false ) {
			$output['_video_thumbnail_oembed'] = $data->thumbnail_url;
			$output['_video_data_oembed'] = $data;
			return $output;
		} else {
			$output['_video_thumbnail_oembed'] = false;
			$output['_video_data_oembed'] = false;
			return $output;
		}

	} // end function embed_oembed_html
	
	
	
	
	
	
	/**
	 * Update post_meta on save_post
	 *
	 * @version 2.0
	 * @updated 04.22.14
	 **/
	function save_post_meta( $post_id, $post ) {
		
		// Varify nonce
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
	 * Convert OEmbed_Post_Meta_VC custom fields
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * convert_OEmbed_Post_Meta_VC
	 *
	 * @version 0.1
	 * @updated 03.29.12
	 **/
	function convert_OEmbed_Post_Meta_VC() {
		global $wpdb;
		
		$update_oembed_video_url = $wpdb->query( "UPDATE $wpdb->postmeta SET $wpdb->postmeta.meta_key = replace( $wpdb->postmeta.meta_key, '_oembed_video_url', '_video_url_oembed' )" );
		$update_oembed_video_thumbnail = $wpdb->query( "UPDATE $wpdb->postmeta SET $wpdb->postmeta.meta_key = replace( $wpdb->postmeta.meta_key, '_oembed_video_thumbnail', '_video_thumbnail_oembed' )" );
		$update_oembed_video_data = $wpdb->query( "UPDATE $wpdb->postmeta SET $wpdb->postmeta.meta_key = replace( $wpdb->postmeta.meta_key, '_oembed_video_data', '_video_data_oembed' )" );
		
		update_option( 'converted-OEmbed_Post_Meta_VC', 1 );
		
	} // end function convert_OEmbed_Post_Meta_VC
	
	
	
} // end class OEmbedPostMetaVCWP