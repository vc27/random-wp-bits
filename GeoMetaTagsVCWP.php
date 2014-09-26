<?php
/**
 * File Name GeoMetaTagsVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * GeoMetaTagsVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$GeoMetaTagsVCWP = new GeoMetaTagsVCWP();
class GeoMetaTagsVCWP {
	
	
	
	/**
	 * geo_tags
	 * 
	 * @access public
	 * @var array
	 **/
	var $geo_tags = array(
		'_geo_tag__icbm' => array( 'attr' => 'name', 'type' => 'ICBM' ), // 40.75,-73.99
		'_geo_tag__geo_position' => array( 'attr' => 'name', 'type' => 'geo.position' ), // 40.75,-73.99
		'_geo_tag__geo_placename' => array( 'attr' => 'name', 'type' => 'geo.placename' ), // New York, New York, NY, us
		'_geo_tag__geo_region' => array( 'attr' => 'name', 'type' => 'geo.region' ), // US-NY
		'_geo_tag__og_locality' => array( 'attr' => 'property', 'type' => 'og:locality' ), // Boston
		'_geo_tag__og_country_name' => array( 'attr' => 'property', 'type' => 'og:country-name' ), // us
		'_geo_tag__og_region' => array( 'attr' => 'property', 'type' => 'og:region' ), // MA
		'_geo_tag__og_postal_code' => array( 'attr' => 'property', 'type' => 'og:postal-code' ), // 02119
		'_geo_tag__og_latitude' => array( 'attr' => 'property', 'type' => 'og:latitude' ), // 42.29
		'_geo_tag__og_longitude' => array( 'attr' => 'property', 'type' => 'og:longitude' ), // -71.05
	);
	
	
	
	/**
	 * tags
	 * 
	 * @access public
	 * @var array
	 **/
	var $tags = array();
	
	
	
	/**
	 * tag_html
	 * 
	 * @access public
	 * @var array
	 **/
	var $tag_html = '<meta %1$s="%2$s" content="%3$s" />';
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

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
	 * set__post_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__post_id() {		
		
		if ( ! $this->have_post_id() AND $this->have_wp_query_post_id() ) {
			global $wp_query;		
			$this->set( 'post_id', $wp_query->post->ID );
		}
		
	} // end function set__post_id
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * set_meta_tags
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set_meta_tags() {
		
		$this->set__post_id();
		
		$this->set( 'geo_tags', apply_filters( 'pre_set_meta_tags', $this->geo_tags, $this->post_id ) );
		
		if ( is_singular() AND $this->have_geo_tags() AND $this->have_post_id() ) {
			
			foreach ( $this->geo_tags as $this->key => $this->tag ) {
				
				if ( isset( $this->tag['val'] ) AND ! empty( $this->tag['val'] ) ) {
					
					$this->set( 'val', $this->tag['val'] );
					$this->append_tags();
					
				} else if ( $this->val = get_post_meta( $this->post_id , $this->key, true ) ) {
					
					$this->append_tags();
					
				}
				
			}
			
		} // end if ( $this->have_geo_tags() )
		
	} // end function set_meta_tags
	
	
	
	
	
	
	/**
	 * get_meta_tags
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get_meta_tags( $post_id = false ) {
		
		$this->set( 'post_id', $post_id );
		$this->set_meta_tags();
		
		if ( $this->have_tags() ) {
			$output = $this->tags;
		} else {
			$output = false;
		}
		
		return apply_filters( 'get_meta_tags', $output );
		
	} // end function get_meta_tags
	
	
	
	
	
	
	/**
	 * append_tags
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append_tags() {
		
		$this->tags[$this->key] = sprintf( $this->tag_html, $this->tag['attr'], $this->tag['type'], $this->val );
		
	} // end function append_tags
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_geo_tags
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_geo_tags() {
		
		if ( isset( $this->geo_tags ) AND is_array( $this->geo_tags ) AND ! empty( $this->geo_tags ) ) {
			$this->set( 'have_geo_tags', 1 );
		} else {
			$this->set( 'have_geo_tags', 0 );
		}
		
		return $this->have_geo_tags;
		
	} // end function have_geo_tags 
	
	
	
	
	
	
	/**
	 * have_post_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_post_id() {
		
		if ( isset( $this->post_id ) AND ! empty( $this->post_id ) AND is_numeric( $this->post_id ) ) {
			$this->set( 'have_post_id', 1 );
		} else {
			$this->set( 'have_post_id', 0 );
		}
		
		return $this->have_post_id;
		
	} // end function have_post_id
	
	
	
	
	
	
	/**
	 * have_wp_query_post_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_wp_query_post_id() {
		global $wp_query;
		
		if ( isset( $wp_query->post->ID ) AND ! empty( $wp_query->post->ID ) AND is_numeric( $wp_query->post->ID ) ) {
			$this->set( 'have_wp_query_post_id', 1 );
		} else {
			$this->set( 'have_wp_query_post_id', 0 );
		}
		
		return $this->have_wp_query_post_id;
		
	} // end function have_wp_query_post_id
	
	
	
	
	
	
	/**
	 * have_tags
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_tags() {
		
		if ( isset( $this->tags ) AND is_array( $this->tags ) AND ! empty( $this->tags ) ) {
			$this->set( 'have_tags', 1 );
		} else {
			$this->set( 'have_tags', 0 );
		}
		
		return $this->have_tags;
		
	} // end function have_tags
	
	
	
} // end class GeoMetaTagsVCWP