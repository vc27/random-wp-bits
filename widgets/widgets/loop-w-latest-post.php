<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */
global $LatestPostWidgetVCWP;



$wp_query = new WP_Query();
$wp_query->query( $LatestPostWidgetVCWP->query );
if ( have_posts() ) { 
	echo $LatestPostWidgetVCWP->before_widget . $LatestPostWidgetVCWP->title;
	echo "<ul class=\"loop widget-loop-post\">";
	while ( have_posts() ) { 
		the_post();
		echo "<li "; post_class('clearfix'); echo ">";
			if ( $LatestPostWidgetVCWP->show__featured_image() ) {
				featured__image( $post, array( 
					'post_thumbnail_size' => $LatestPostWidgetVCWP->featured_image_size 
				) );
			}
			the__title( $post, array( 
				'permalink' => true
				,'element' => 'div'
				,'class' => 'h4'
			) );
			the__date( $post );
			if ( ! $LatestPostWidgetVCWP->hide_entry() ) {
				if ( $LatestPostWidgetVCWP->full_post() ) {
					the__content( $post );
					echo '<div class="meta_data">';
						the__tags( $post, array( 
							'before' => __( 'Posted Under: ', 'parenttheme' )
						) );
						the__author( array( 
							'before' => __( 'Written By: ', 'parenttheme' )
						) );
						the__time( $post );
					echo '</div>';
				} else {
					the__excerpt( $post, array(
						'count' => $LatestPostWidgetVCWP->word_count,
						'strip_tags' => $LatestPostWidgetVCWP->strip_tags,
						'read_more' => $LatestPostWidgetVCWP->read_more,
						'kill_read_more' => $LatestPostWidgetVCWP->kill_read_more
					) );
				} // end if ( $full_post )
			} // end if ( !$hide_entry )
		echo "</li>";
	} // endwhile
	wp_reset_postdata();
	echo "</ul>";
	echo $LatestPostWidgetVCWP->after_widget;
} // endif have posts
wp_reset_query();