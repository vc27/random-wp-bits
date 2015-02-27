<?php
/**
 * File Name PageWidgetVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 07.16.13
 **/
####################################################################################################





/**
 * PageWidgetVCWP
 *
 * @version 1.1
 * @updated 07.16.13
 **/
class PageWidgetVCWP extends WP_Widget {
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.1
	 * @updated 07.16.13
	 **/
	function __construct() {

		$this->set( 'title_display', array( 
			__( 'Post Title', 'parenttheme' ),
			__( 'Text', 'parenttheme' ), 
			__( 'Image', 'parenttheme' ), 
			__( 'Off' , 'parenttheme' )
		) );
		
		$this->set( 'name', __( 'Page Widget', 'parenttheme' ) );
		$this->set( 'id', 'vc_page_widgets' );
		
		$this->set( 'control_ops', array(
			// 'width' => 400,
			// 'height' => 350,
			'id_base' => $this->id
			) );
		
		$this->set( 'widget_ops', array(
			'classname' => $this->id,
			'description' => __( 'Use a Widget to display Page Content.', 'parenttheme' )
			) );
		
		
		$this->WP_Widget( $this->id, $this->name, $this->widget_ops, $this->control_ops );

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
	 * set__page_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__page_id() {
		
		if ( isset( $this->instance['_page_id'] ) AND ! empty( $this->instance['_page_id'] ) AND is_numeric( $this->instance['_page_id'] ) ) {
			$this->set( 'page_id', $this->instance['_page_id'] );
		} else {
			$this->set( 'page_id', false );
		}
		
	} // end function set__page_id
	
	
	
	
	
	
	/**
	 * set__link
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__link() {
		
		if ( isset( $this->instance['link'] ) AND ! empty( $this->instance['link'] ) ) {
			$this->set( 'link', $this->instance['link'] );			
		} else {
			$this->set( 'link', get_permalink( $this->page_id ) );
		}
		
	} // end function set__link
	
	
	
	
	
	
	/**
	 * set__title
	 *
	 * @version 1.1
	 * @updated 07.16.13
	 **/
	function set__title() {
		
		if ( isset( $this->instance['title_display'] ) ) {
			
			
			// Set Title
			$this->set( 'text_title', $this->instance['text_title'] );
			
			if ( __( 'Off', 'parenttheme' ) == $this->instance['title_display'] ) {
				
				$this->set( 'title', false );
				
			} else if ( __( 'Post Title', 'parenttheme' ) == $this->instance['title_display'] ) {
				
				$this->set( 'title', '%post_title%' );
				
			} else if ( ! empty( $this->text_title ) ) {
				
				$this->set( 'title', $this->text_title );
				
			} else {
				
				$this->set( 'title', false );
				
			}
			
			// Set Title link
			if ( isset( $this->link ) AND ! empty( $this->link ) AND ! empty( $this->title ) AND ( ! isset( $this->instance['no_link'] ) OR $this->instance['no_link'] != 'on' ) ) {
				
				$this->set( 'a_', "<a href=\"$this->link\" title=\"" . esc_attr( strip_tags( $this->text_title ) ) . "\">" );
				$this->set( '_a', "</a>" );
				
				if ( isset( $this->args['before_title'] ) AND ! empty( $this->args['before_title'] ) ) {
					$this->set( 'before_title', $this->args['before_title'] );
				} else {
					$this->set( 'before_title', false );
				}
				
				if ( isset( $this->args['after_title'] ) AND ! empty( $this->args['after_title'] ) ) {
					$this->set( 'after_title', $this->args['after_title'] );
				} else {
					$this->set( 'after_title', false );
				}
				
				$this->set( 'title', $this->before_title . $this->a_ . $this->title . $this->_a . $this->after_title );
				
			}
			
		} // end if ( isset( $this->instance['title_display'] ) )

	} // end function set__title
	
	
	
	
	
	
	/**
	 * set__before_widget
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__before_widget() {
		
		if ( isset( $this->args['before_widget'] ) AND ! empty( $this->args['before_widget'] ) ) {
			$this->set( 'before_widget', $this->args['before_widget'] );
		} else {
			$this->set( 'before_widget', '' );
		}
		
	} // end function set__before_widget
	
	
	
	
	
	
	/**
	 * set__after_widget
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__after_widget() {
		
		if ( isset( $this->args['after_widget'] ) AND ! empty( $this->args['after_widget'] ) ) {
			$this->set( 'after_widget', $this->args['after_widget'] );
		} else {
			$this->set( 'after_widget', '' );
		}
		
	} // end function set__after_widget
	
	
	
	
	
	
	/**
	 * set__query
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__query() {
		
		// Term slug
		$this->query['page_id'] = $this->page_id;		
		$this->query['post_type'] = 'page';
		
	} // end function set__query 
	
	
	
	
	
	
	/**
	 * set__featured_image_size
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__featured_image_size() {
		
		if ( isset( $this->instance['featured_image_size'] ) AND ! empty( $this->instance['featured_image_size'] ) ) {
			$this->set( 'featured_image_size', $this->instance['featured_image_size'] );
		} else {
			$this->set( 'featured_image_size', '' );
		}
		
	} // end function set__featured_image_size 
	
	
	
	
	
	
	/**
	 * set__vc_excerpt__array_items
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__vc_excerpt__array_items() {
		
		if ( isset( $this->instance['word_count'] ) AND ! empty( $this->instance['word_count'] ) ) {
			$this->set( 'word_count', $this->instance['word_count'] );
		} else {
			$this->set( 'word_count', false );
		}
		
		if ( isset( $this->instance['strip_tags'] ) AND ! empty( $this->instance['strip_tags'] ) ) {
			$this->set( 'strip_tags', $this->instance['strip_tags'] );
		} else {
			$this->set( 'strip_tags', false );
		}
		
		if ( isset( $this->instance['read_more'] ) AND ! empty( $this->instance['read_more'] ) ) {
			$this->set( 'read_more', $this->instance['read_more'] );
		} else {
			$this->set( 'read_more', false );
		}
		
		if ( isset( $this->instance['kill_read_more'] ) AND ! empty( $this->instance['kill_read_more'] ) ) {
			$this->set( 'kill_read_more', $this->instance['kill_read_more'] );
		} else {
			$this->set( 'kill_read_more', false );
		}
		
	} // end function set__vc_excerpt__array_items
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Widget 
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function widget( $args, $instance ) {
		global $PageWidgetVCWP;
		
		$this->set( 'args', $args );
		$this->set( 'instance', $instance );
		$this->set__page_id();
		
		if ( is_numeric( $this->page_id ) AND $this->page_id > 0 ) {
			
			$this->set__link();
			$this->set__title();
			$this->set__before_widget();
			$this->set__after_widget();
			$this->set__featured_image_size();
			$this->set__query();
			$this->set__vc_excerpt__array_items();		

			$PageWidgetVCWP = $this;

			get_template_part( 'loop', 'w-page' );
			
		}
		
	} // end function widget
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * show__featured_image
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function show__featured_image() {
		
		if ( isset( $this->instance['show_thumbnail'] ) AND ! empty( $this->instance['show_thumbnail'] ) ) {
			$this->set( 'show__featured_image', 1 );
		} else {
			$this->set( 'show__featured_image', 0 );
		}
		
		return $this->show__featured_image;
		
	} // end function show__featured_image 
	
	
	
	
	
	
	/**
	 * hide_entry
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function hide_entry() {
		
		if ( isset( $this->instance['hide_entry'] ) AND ! empty( $this->instance['hide_entry'] ) ) {
			$this->set( 'hide_entry', 1 );
		} else {
			$this->set( 'hide_entry', 0 );
		}
		
		return $this->hide_entry;
		
	} // end function hide_entry 
	
	
	
	
	
	
	/**
	 * full_post
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function full_post() {
		
		if ( isset( $this->instance['full_post'] ) AND ! empty( $this->instance['full_post'] ) ) {
			$this->set( 'full_post', 1 );
		} else {
			$this->set( 'full_post', 0 );
		}
		
		return $this->full_post;
		
	} // end function full_post
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Admin
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Update Widget data
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title_display'] = $new_instance['title_display'];
		$instance['text_title'] = $new_instance['text_title'];
		$instance['link'] = $new_instance['link'];
		$instance['_page_id'] = $new_instance['_page_id'];
		$instance['full_post'] = $new_instance['full_post'];
		$instance['post_count'] = $new_instance['post_count'];
		$instance['word_count'] = $new_instance['word_count'];
		$instance['read_more'] = $new_instance['read_more'];
		$instance['kill_read_more'] = $new_instance['kill_read_more'];
		$instance['show_thumbnail'] = $new_instance['show_thumbnail'];
		$instance['featured_image_size'] = $new_instance['featured_image_size'];
		$instance['strip_tags'] = $new_instance['strip_tags'];
		$instance['alt_thumb_link'] = $new_instance['alt_thumb_link'];
		$instance['thumb_caption'] = $new_instance['thumb_caption'];
		$instance['no_link'] = $new_instance['no_link'];
		
		return $instance;
	
	} // end function update
	
	
	
	
	
	
	/**
	 * Widget Form
	 *
	 * @version 1.1
	 * @updated 07.16.13
	 **/
	function form( $instance ) {
		
		//Defaults
		$defaults = array(
			'title_display' => __( 'Text', 'parenttheme' ),
			'text_title' => '',
			'link' => '',
			'_page_id' => false,
			'full_post' => '',
			'word_count' => 75,
			'read_more' => __( 'Read more', 'parenttheme' ),
			'kill_read_more' => '',
			'strip_tags' => '<p>',
			'show_thumbnail' => '',
			'featured_image_size' => '',
			);
		
		$r = wp_parse_args( $instance, $defaults );
		extract( $r, EXTR_SKIP );
		
		
		// Get pages
		$pages = get_pages();
		
		
		?>
		<!-- Title Display Select -->
		<p>
			<label for="<?php echo $this->get_field_id('title_display'); ?>"><?php _e( 'Title Display:', 'parenttheme' ); ?></label>
			<select style="width:125px;" name="<?php echo $this->get_field_name('title_display'); ?>">
			<?php
			
			foreach ( $this->title_display as $value ) {
				
				if ( $title_display == $value )
					$sel = 'selected="selected"';
				else
					$sel = '';
					
				echo "<option $sel value=\"$value\">$value</option>";
			
			}
			
			?>
			</select>
		</p>
		
		
		<!-- Text Title -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Text Title:', 'parenttheme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('text_title'); ?>" type="text" value="<?php echo $text_title; ?>" />
		</p>
		
		
		<!-- Link - Hide Link -->
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Link:', 'parenttheme' ); ?></label> &nbsp;&nbsp;&nbsp; <input type="checkbox" <?php checked( $no_link, 'on' ); ?> id="<?php echo $this->get_field_id('no_link'); ?>" name="<?php echo $this->get_field_name('no_link'); ?>"/> <label for="<?php echo $this->get_field_id('no_link'); ?>"><small><em><?php echo __( 'Disable Link completely.', 'parenttheme' ); ?></em></small></label>
			<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
		</p>
		
		
		<!-- Select Page -->
		<p>
			<label for="<?php echo $this->get_field_id('_page_id'); ?>"><?php _e( 'Page:', 'parenttheme' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('_page_id'); ?>" name="<?php echo $this->get_field_name('_page_id'); ?>">
				<option value=""><?php echo __( 'Select a Page', 'parenttheme' ); ?></option>
				<?php

				foreach ( $pages as $page ) {
					if( $_page_id == $page->ID )
						$sel = 'selected="selected"';
					else
						$sel = '';

					echo "<option $sel value=\"$page->ID\">" . htmlentities( $page->post_title ) . "</option>";
				}

				?>
			</select>
		</p>
		
		
		<!-- Display Full Posts -->
		<p>
			<input type="checkbox" <?php checked( $full_post, 'on' ); ?> id="<?php echo $this->get_field_id('full_post'); ?>" name="<?php echo $this->get_field_name('full_post'); ?>"/>
			<label for="<?php echo $this->get_field_id('full_post'); ?>"><?php _e( 'Show Full Page:', 'parenttheme' ); ?></label>
		</p>
		<?php
		
		if ( $full_post )
			echo "<p><small style=\"color:red;\">" . __( 'Showing full post will nullify Word Count, Read More, Strip Tags, Show Thumbnail, Show Video.', 'parenttheme' ); ?></small></p>";
		
		?>
		
		
		
		<!-- Word Count -->
		<p>
			<label for="<?php echo $this->get_field_id('word_count'); ?>"><?php _e( 'Word Count:', 'parenttheme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('word_count'); ?>" name="<?php echo $this->get_field_name('word_count'); ?>" type="text" value="<?php echo $word_count; ?>" />
		</p>
		
		
		<!-- Read More -->
		<p>
			<label for="<?php echo $this->get_field_id('read_more'); ?>"><?php _e( 'Read More:', 'parenttheme' ); ?></label> - <label for="<?php echo $this->get_field_id('kill_read_more'); ?>"><input type="checkbox" <?php checked( $kill_read_more, 'on' ); ?> id="<?php echo $this->get_field_id('kill_read_more'); ?>" name="<?php echo $this->get_field_name('kill_read_more'); ?>"/> <small><em><?php echo __( 'Hide "read more" completely', 'parenttheme' ); ?></em></small></label>
			<input class="widefat" id="<?php echo $this->get_field_id('read_more'); ?>" name="<?php echo $this->get_field_name('read_more'); ?>" type="text" value="<?php echo $read_more; ?>" />
		</p>
		
		
		<!-- Strip Tags -->
		<p>
			<label for="<?php echo $this->get_field_id('strip_tags'); ?>"><?php _e( 'Strip Tags:', 'parenttheme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('strip_tags'); ?>" name="<?php echo $this->get_field_name('strip_tags'); ?>" type="text" value="<?php echo $strip_tags; ?>" />
			<small>example: &#60;a&#62; or &#60;img&#62;</small>
		</p>
		
		
		<?php 
		
		// If Featured_Image_VC Plugin is installed
		if ( function_exists( 'featured_image__form_select' ) ) { 
			
		?>
		
		<!-- Show Featured Image -->
		<p class="show_thumbnail">
			<input type="checkbox" <?php checked( $show_thumbnail, 'on' ); ?> id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>"/> 
			<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e( 'Show Featured Image:', 'parenttheme' ); ?></label>
		</p>
				
		<!-- Select Featured Image -->
		<p class="featured_image_sizes">
			<label for="<?php echo $this->get_field_id('featured_image_size'); ?>"><?php _e( 'Featured Image Size:', 'parenttheme' ); ?></label>
			<?php
			
			featured_image__form_select( array(
				'val' => $featured_image_size,
				'id' => $this->get_field_id('featured_image_size'),
				'name' => $this->get_field_name('featured_image_size'),
				) );
			
			?>
		</p>
				
		<?php } // End Featured_Image_VC ?>
		
		<?php
	
	
	} // end function form
	
	
	
} // end class PageWidgetVCWP