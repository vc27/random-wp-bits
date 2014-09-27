<?php
/**
 * File Name Breadcrumb_Navigation_VC.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.3
 * @updated 04.03.13
 **/
#################################################################################################### */


if ( class_exists( 'Breadcrumb_Navigation_VC' ) ) return;






/**
 * Breadcrumb_Navigation_VC Class
 *
 * @version 0.0.1
 * @updated 05.04.12
 **/
class Breadcrumb_Navigation_VC {
	
	
	
	
	/**
	 * Navigation Breadcrumb Page
	 *
	 * @version 0.0.1
	 * @updated 05.04.12
	 **/
	function init() {
		
		add_action( 'inner_wrap_top', array( &$this, 'breadcrumb_navigation' ) );
		
	} // function init
	
	
	
	
	
	
	/**
	 * Navigation Breadcrumb Page
	 *
	 * @version 0.2
	 * @updated 11.16.12
	 **/
	function breadcrumb_navigation( $args = array() ) {
		global $wp_query;
		
		if ( ! get__option( 'post_display', 'childpage_breadcrumb' ) ) return;
		
		$defaults = array(
			'home_text' => 'Home',
			'spacer' => '&nbsp;&raquo;&nbsp;',
			'before' => '',
			'after' => '',
			'switch_case' => $this->switch_case()
			);
		
		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		
		$home = "<a class=\"menu-item menu-item-home\" href=\"" . home_url() . "\">$home_text</a>$spacer";
		
		echo "<div id=\"navigation-breadcrumb\">$before";
		
			// Switch Case for anything...
			switch ( $switch_case ) {

				case "search" :
					echo "$home<span class=\"menu-item menu-item-search current-menu-item\">Search</span>";
					break; 
				case "page" :
					echo $home;
					echo $this->ancestors( $wp_query->post, array(
						'echo' => 1,
						'spacer' => $spacer,
						'after' => $spacer
						) );
					echo "<span class=\"menu-item menu-item-page current-menu-item\">" . get_the_title() . "</span>";
					break;
				default :
					if ( isset( $wp_query->post ) AND ! empty( $wp_query->post ) ) {
						do_action( 'navigation-breadcrumb', $r, $wp_query->post );
					}
					break;

			} // end switch ( $wp_query->post->post_type )

			echo "$after<div class=\"clear\"></div>";
		echo "</div>";
		

	} // end function add_breadcrumb_navigation
	
	
	
	
	
	
	/**
	 * Set Case
	 *
	 * @version 0.0.1
	 * @updated 05.04.12
	 **/
	function switch_case() {
		global $s, $wp_query;
		
		if ( $s ) {
			return 'search';
		} else if ( is_page_template() ) {
			return 'is_page_template';
		} else if ( is_home() ) {
			return 'is_home';
		} else if ( is_front_page() ) {
			return 'is_front_page';
		} else if ( isset( $wp_query->post->post_type ) AND ! empty( $wp_query->post->post_type ) ) {
			return $wp_query->post->post_type;
		} else {
			return false;
		}
		
	} // end function set_case
	
	
	
	
	
	
	/**
	 * Ancestors
	 *
	 * @version 0.0.1
	 * @updated 05.04.12
	 **/
	function ancestors( $post, $args = '' ) {
		
		if ( ! $this->has_ancestors( $post ) ) return false;

		$defaults = array(
			'before'	=> '',
			'after'		=> '',
			'spacer'	=> '&nbsp;/&nbsp;',
			'echo'		=> 0,
			);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		if ( count( $post->ancestors ) < 1 )
			$spacer = false;
		
		$i = 0;
		$ancestors = array_reverse( $post->ancestors );
		
		$output = $before;

		foreach ( $ancestors as $post_id ) {
			
			$i++;
			if ( $i == count( $ancestors ) )
				$spacer = false;

			$output .= "<a class=\"menu-item\" href=\"" . get_permalink( $post_id ) . "\" title=\"" . get_the_title( $post_id ) . "\">" . get_the_title( $post_id ) . "</a> $spacer ";
		
		}
		
		$output .= $after;


		if ( $echo )
			echo $output;
		else
			return $output;


	} // end function ancestors
	
	
	
	
	
	
	/**
	 * Ancestors
	 *
	 * @version 0.0.1
	 * @updated 05.04.12
	 **/
	function has_ancestors( $post ) {
		
		if ( is_array( $post->ancestors ) AND ! empty( $post->ancestors ) )
			return true;
		else
			return false;
		
	} // end function has_ancestors
	
	
	
} // end class Breadcrumb_Navigation_VC