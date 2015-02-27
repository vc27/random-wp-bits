<?php
/**
 * File Name FeaturedImageWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 07.09.13
 **/
####################################################################################################





/**
 * FeaturedImageWP
 **/
class FeaturedImageWP {
	
	
	
	/**
	 * image
	 * 
	 * @access public
	 * @var string
	 **/
	var $image = false;
	
	
	
	/**
	 * have_image
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_image = 0;
	
	
	
	/**
	 * post
	 * 
	 * @access public
	 * @var object
	 **/
	var $post = null;
	
	
	
	/**
	 * have_post
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_post = 0;
	
	
	
	/**
	 * args
	 * 
	 * @access public
	 * @var array
	 **/
	var $args = array();
	
	
	
	/**
	 * have_args
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_args = 0;
	
	
	
	/**
	 * defaults
	 * 
	 * @access public
	 * @var array
	 **/
	var $defaults = array(
		'post_id' => false,
		'title' => false,
		'before' => false,
		'after' => false,
		'class' => false,
		'permalink' => true,
		'target' => false,
		'post_thumbnail_size' => false,
		'post_meta' => false,
		'alt_image' => false,
		'height' => false,
		'width' => false,
		'post_type' => false,
		'multi_id' => false,
		'echo' => 1
		);
	
	
	
	/**
	 * open_a_tag
	 * 
	 * @access public
	 * @var string
	 **/
	var $open_a_tag = '';
	
	
	
	/**
	 * close_a_tag
	 * 
	 * @access public
	 * @var string
	 **/
	var $close_a_tag = '</a>';
	
	
	
	/**
	 * permalink
	 * 
	 * @access public
	 * @var string
	 **/
	var $permalink = null;
	
	
	
	/**
	 * have_permalink
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_permalink = 0;
	
	
	
	/**
	 * post_id
	 * 
	 * @access public
	 * @var int
	 **/
	var $post_id = 0;
	
	
	
	/**
	 * have_post_id
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_post_id = 0;
	
	
	
	/**
	 * post_meta
	 * 
	 * @access public
	 * @var string
	 **/
	var $post_meta = null;
	
	
	
	/**
	 * have_post_meta
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_post_meta = 0;
	
	
	
	/**
	 * post_meta_img
	 * 
	 * @access public
	 * @var string
	 **/
	var $post_meta_img = null;
	
	
	
	/**
	 * have_post_meta_img
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_post_meta_img = 0;
	
	
	
	/**
	 * alt_image
	 * 
	 * @access public
	 * @var string
	 **/
	var $alt_image = null;
	
	
	
	/**
	 * have_alt_image
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_alt_image = 0;
	
	
	
	/**
	 * image_url
	 * 
	 * @access public
	 * @var string
	 **/
	var $image_url = null;
	
	
	
	/**
	 * have_image_url
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_image_url = 0;
	
	
	
	/**
	 * image_html
	 * 
	 * @access public
	 * @var string
	 **/
	var $image_html = null;
	
	
	
	/**
	 * have_image_html
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_image_html = 0;
	
	
	
	/**
	 * title
	 * 
	 * @access public
	 * @var string
	 **/
	var $title = false;
	
	
	
	/**
	 * height
	 * 
	 * @access public
	 * @var string
	 **/
	var $height = false;
	
	
	
	/**
	 * have_height
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_height = 0;
	
	
	
	/**
	 * width
	 * 
	 * @access public
	 * @var string
	 **/
	var $width = false;
	
	
	
	/**
	 * have_width
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_width = 0;
	
	
	
	/**
	 * class
	 * 
	 * @access public
	 * @var string
	 **/
	var $class = false;
	
	
	
	/**
	 * multi_id
	 * 
	 * @access public
	 * @var string
	 **/
	var $multi_id = null;
	
	
	
	/**
	 * have_multi_id
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_multi_id = 0;
	
	
	
	/**
	 * post_type
	 * 
	 * @access public
	 * @var string
	 **/
	var $post_type = null;
	
	
	
	/**
	 * have_post_type
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_post_type = 0;
	
	
	
	/**
	 * post_thumbnail_size
	 * 
	 * @access public
	 * @var string
	 **/
	var $post_thumbnail_size = null;
	
	
	
	/**
	 * size
	 * 
	 * @access public
	 * @var string
	 **/
	var $size = '';
	
	
	
	/**
	 * have_post_thumbnail_size
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_post_thumbnail_size = 0;
	
	
	
	/**
	 * before
	 * 
	 * @access public
	 * @var string
	 **/
	var $before = false;
	
	
	
	/**
	 * after
	 * 
	 * @access public
	 * @var string
	 **/
	var $after = false;
	
	
	
	
	
	
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
	 * set__sanitied_attr
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__sanitied_attr( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = esc_attr( strip_tags( $val ) );
		}
		
	} // end function set__sanitied_attr 
	
	
	
	
	
	
	/**
	 * set__sanitied
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__sanitied( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = sanitize_title_with_dashes( $val );
		}
		
	} // end function set__sanitied
	
	
	
	
	
	
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
	 * set__post
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__post( $post = false ) {
		
		if ( is_object( $post ) ) {
			$this->set( 'post', $post );
		} else if ( is_numeric( $post ) AND $post > 0 ) {
			$this->set( 'post', get_post( $post ) );
		} else if ( isset( $args['post_id'] ) AND is_numeric( $args['post_id'] ) AND $args['post_id'] > 0 ) {
			$this->set( 'post', get_post( $args['post_id'] ) );
		}
		
	} // end function set__post
	
	
	
	
	
	
	/**
	 * set__args_array
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__args_array( $args = array() ) {
		
		if ( is_array( $args ) AND ! empty( $args ) ) {
			$this->set( 'args', wp_parse_args( $args, $this->defaults ) );
		}
		
	} // end function set__args_array
	
	
	
	
	
	
	/**
	 * set__args
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__args() {
		
		if ( is_array( $this->args ) AND ! empty( $this->args ) ) {
			
			foreach ( $this->args as $key => $val ) {
				$this->set( $key, $val );
			}
			
		}
		
	} // end function set__args
	
	
	
	
	
	
	/**
	 * set__backwards_compatible
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__backwards_compatible() {
		
		// Link
		if ( isset( $this->link ) AND ! empty( $this->link ) AND ! isset( $this->permalink ) ) {
			$this->set( 'permalink', $this->link );
		}
		
	} // end function set__backwards_compatible 
	
	
	
	
	
	
	/**
	 * set__post_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__post_id() {
		
		// Link
		if ( $this->have_post() AND ! $this->have_post_id() ) {
			$this->set( 'post_id', $this->post->ID );
		}
		
	} // end function set__post_id 
	
	
	
	
	
	
	/**
	 * set__post_type
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__post_type() {
		
		// Link
		if ( $this->have_post() AND ! $this->have_post_type() ) {
			$this->set( 'post_type', $this->post->post_type );
		}
		
	} // end function set__post_type
	
	
	
	
	
	
	/**
	 * set__permalink
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__permalink() {
		
		// Link
		if ( $this->permalink === true AND $this->have_post_id() ) {
			$this->set( 'permalink', get_permalink( $this->post_id ) );
		}
		
	} // end function set__permalink
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * image
	 *
	 * @version 1.3
	 * @updated 07.09.13
	 **/
	function image( $post, $args = array() ) {
		
		$this->set__post( $post );
		$this->set__args_array( $args );
		
		if ( $this->have_args() ) {
			$this->set__args();
			$this->set__backwards_compatible();
			
		}
		
		$this->set__post_id();
		$this->set__permalink();
		$this->set__post_type();
		$this->set__sanitied_attr( 'class', $this->class );
		$this->set__sanitied_attr( 'title_attr', $this->title );
		$this->set__sanitied( '_post_thumbnail_size', $this->post_thumbnail_size );

		// Set Link tag
		if ( $this->have_permalink() ) {
			$this->set( 'open_a_tag', "<a class=\"$this->class-wrap\" href=\"$this->permalink\" title=\"$this->title_attr\" target=\"$this->target\">" );
		} else {
			$this->set( 'close_a_tag', '' );
		}


		// Post Meta -- Allow to accept an alternate post meta name
		if ( $this->have_post_meta() AND $this->have_post_id() ) {
			$this->set( 'post_meta_img', get_post_meta( $this->post_id, $this->post_meta, true ) );
		} else {
			$this->set( 'post_meta_img', 0 );
		}



		// Build Alternate Image
		if ( $this->have_post_meta_img() OR $this->have_alt_image() ) {
			
			// alt_image or post_meta_img
			if ( $this->have_alt_image() ) {
				$this->set( 'image_url', $this->alt_image );
			} else if ( $this->have_post_meta_img() ) {
				$this->set( 'image_url', $this->post_meta_img );
			}

			if ( $this->have_image_url() ) {
				
				$this->set( 'image', $this->html_image( array(
					'content_id' => '',
					'title' => $this->title_attr,
					'src' => $this->image_url,
					'height' => $this->height,
					'width' => $this->width,
					'class' => $this->class,
					'alt_text' => sanitize_title_with_dashes( $this->title ),
					'echo' => 0,
					) ) );
				
			}

		// Featured Image
		} else if ( ( $this->have_post_id() AND has_post_thumbnail( $this->post_id ) ) OR ( $this->have_multi_id() AND $this->have_post_type() AND class_exists( 'MultiPostThumbnails' ) AND MultiPostThumbnails::has_post_thumbnail( $this->post_type, $this->multi_id, $this->post_id ) ) ) {
			

			// Size
			if ( $this->have_width() AND $this->have_height() ) {
				$this->set( 'size', array( $width, $height ) );
			} else if ( $this->have_post_thumbnail_size() ) {
				$this->set( 'size', $this->_post_thumbnail_size );
			}


			// Image Attributes
			$this->set( 'attr', array(
				'class' => "$this->class attachment-$this->_post_thumbnail_size",
				'alt' => $this->title_attr,
				'title' => $this->title_attr,
				) );


			// Set Image -- allows for plugin multi-post-thumbnails !!!
			if ( $this->have_multi_id() AND class_exists('MultiPostThumbnails') ) {
				$this->set( 'image', MultiPostThumbnails::get_the_post_thumbnail( $post->post_type, $this->multi_id, $this->post_id, $this->size, $this->attr ) );
			} else {
				$this->set( 'image', get_the_post_thumbnail( $this->post_id, $this->size, $this->attr ) );
			}
			
		}

		
		// Build final out put and echo / return
		if ( $this->have_image() ) {

			$this->set( 'image', $this->open_a_tag . $this->before . apply_filters( 'vc_featured_image', $this->image, $this->post, $this->args ) . $this->after . $this->close_a_tag );

			if ( $this->echo ) {
				echo $this->image;
			} else {
				return $this->image;
			}

		} else {

			return false;

		} // end if ( $image )
		
	} // end function image
	
	
	
	
	
	
	/**
	 * image_src
	 *
	 * @version 1.0
	 * @updated 06.28.14
	 **/
	static function image_src( $post, $args ) {
		
 		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $args['post_thumbnail_size'] );
		return $image[0];
		
	} // end function image_src
	
	
	
	
	
	
	/**
	 * html_image
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function html_image( $args ) {
		
		// Set Defaults
		$defaults = array(
			'content_id' => false,
			'content_id_attr' => false,
			'title' => false,
			'src' => false,
			'height' => false,
			'height_attr' => false,
			'width' => false,
			'width_attr' => false,
			'class' => false,
			'class_attr' => false,
			'alt_text' => false,
			'echo' => 1,
			);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

        // Build Image or return false
		if ( isset( $src ) AND ! empty( $src ) ) {
			
			// sanatize class sting
			$class = sanitize_title_with_dashes( $class );


			// Check for width and height
			if ( isset( $width ) AND is_numeric( $width ) AND isset( $height ) AND is_numeric( $height ) ) {
				$width_attr = "width=\"$width\"";
				$height_attr = "height=\"$height\"";
			}


			// Set html id
			if ( isset( $content_id ) AND ! empty( $content_id ) ) {
				$content_id_attr = "id=\"" . sanitize_title_with_dashes( $content_id ) . "\"";
			}

			// Set html class
			if ( isset( $class ) AND ! empty( $class ) ) {
				$class_attr = "class=\"$class\"";
			}
			
			$image = "<img $class_attr $content_id_attr title=\"" . esc_attr( strip_tags( $title ) ) . "\" alt=\"" . esc_attr( strip_tags( $alt_text ) ) . "\" src=\"$src\" $width_attr $height_attr />";
			
		} else {
			
			$image = false;
			
		}


		// Echo or return
		if ( $echo )
			echo $image;
		else
			return $image;
		
	} // end function html_image
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_post
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_post() {
		
		if ( isset( $this->post ) AND is_object( $this->post ) AND ! empty( $this->post ) AND isset( $this->post->ID ) AND is_numeric( $this->post->ID ) AND $this->post->ID > 0 ) {
			$this->set( 'have_post', 1 );
		} else {
			$this->set( 'have_post', 0 );
		}
		
		return $this->have_post;
		
	} // end function have_post
	
	
	
	
	
	
	/**
	 * have_args
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_args() {
		
		if ( isset( $this->args ) AND is_array( $this->args ) AND ! empty( $this->args ) ) {
			$this->set( 'have_args', 1 );
		} else {
			$this->set( 'have_args', 0 );
		}
		
		return $this->have_args;
		
	} // end function have_args 
	
	
	
	
	
	
	/**
	 * have_permalink
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_permalink() {
		
		if ( isset( $this->permalink ) AND ! empty( $this->permalink ) ) {
			$this->set( 'have_permalink', 1 );
		} else {
			$this->set( 'have_permalink', 0 );
		}
		
		return $this->have_permalink;
		
	} // end function have_permalink
	
	
	
	
	
	
	/**
	 * have_post_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_post_id() {
		
		if ( isset( $this->post_id ) AND ! empty( $this->post_id ) AND is_numeric( $this->post_id ) AND $this->post_id > 0 ) {
			$this->set( 'have_post_id', 1 );
		} else {
			$this->set( 'have_post_id', 0 );
		}
		
		return $this->have_post_id;
		
	} // end function have_post_id
	
	
	
	
	
	
	/**
	 * have_post_meta
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_post_meta() {
		
		if ( isset( $this->post_meta ) AND ! empty( $this->post_meta ) ) {
			$this->set( 'have_post_meta', 1 );
		} else {
			$this->set( 'have_post_meta', 0 );
		}
		
		return $this->have_post_meta;
		
	} // end function have_post_meta 
	
	
	
	
	
	
	/**
	 * have_post_meta_img
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_post_meta_img() {
		
		if ( isset( $this->post_meta_img ) AND ! empty( $this->post_meta_img ) ) {
			$this->set( 'have_post_meta_img', 1 );
		} else {
			$this->set( 'have_post_meta_img', 0 );
		}
		
		return $this->have_post_meta_img;
		
	} // end function have_post_meta_img 
	
	
	
	
	
	
	/**
	 * have_alt_image
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_alt_image() {
		
		if ( isset( $this->alt_image ) AND ! empty( $this->alt_image ) ) {
			$this->set( 'have_alt_image', 1 );
		} else {
			$this->set( 'have_alt_image', 0 );
		}
		
		return $this->have_alt_image;
		
	} // end function have_alt_image 
	
	
	
	
	
	
	/**
	 * have_image_url
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_image_url() {
		
		if ( isset( $this->image_url ) AND ! empty( $this->image_url ) ) {
			$this->set( 'have_image_url', 1 );
		} else {
			$this->set( 'have_image_url', 0 );
		}
		
		return $this->have_image_url;
		
	} // end function have_image_url 
	
	
	
	
	
	
	/**
	 * have_image_html
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_image_html() {
		
		if ( isset( $this->image_html ) AND ! empty( $this->image_html ) ) {
			$this->set( 'have_image_html', 1 );
		} else {
			$this->set( 'have_image_html', 0 );
		}
		
		return $this->have_image_html;
		
	} // end function have_image_html 
	
	
	
	
	
	
	/**
	 * have_multi_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_multi_id() {
		
		if ( isset( $this->multi_id ) AND ! empty( $this->multi_id ) ) {
			$this->set( 'have_multi_id', 1 );
		} else {
			$this->set( 'have_multi_id', 0 );
		}
		
		return $this->have_multi_id;
		
	} // end function have_multi_id 
	
	
	
	
	
	
	/**
	 * have_post_type
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_post_type() {
		
		if ( isset( $this->post_type ) AND ! empty( $this->post_type ) ) {
			$this->set( 'have_post_type', 1 );
		} else {
			$this->set( 'have_post_type', 0 );
		}
		
		return $this->have_post_type;
		
	} // end function have_post_type 
	
	
	
	
	
	
	/**
	 * have_height
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_height() {
		
		if ( isset( $this->height ) AND ! empty( $this->height ) ) {
			$this->set( 'have_height', 1 );
		} else {
			$this->set( 'have_height', 0 );
		}
		
		return $this->have_height;
		
	} // end function have_height
	
	
	
	
	
	
	/**
	 * have_width
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_width() {
		
		if ( isset( $this->width ) AND ! empty( $this->width ) ) {
			$this->set( 'have_width', 1 );
		} else {
			$this->set( 'have_width', 0 );
		}
		
		return $this->have_width;
		
	} // end function have_width 
	
	
	
	
	
	
	/**
	 * have_post_thumbnail_size
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_post_thumbnail_size() {
		
		if ( isset( $this->post_thumbnail_size ) AND ! empty( $this->post_thumbnail_size ) ) {
			$this->set( 'have_post_thumbnail_size', 1 );
		} else {
			$this->set( 'have_post_thumbnail_size', 0 );
		}
		
		return $this->have_post_thumbnail_size;
		
	} // end function have_post_thumbnail_size 
	
	
	
	
	
	
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
	
	
	
} // end class FeaturedImageWP