<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */
global $PageWidgetVCWP;



$wp_query = new WP_Query();
$wp_query->query( $PageWidgetVCWP->query );
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		if ( $PageWidgetVCWP->title_display == 'Post Title' ) {
			$PageWidgetVCWP->title = str_replace( '%post_title%', $post->post_title, $PageWidgetVCWP->title );
		}
		echo $PageWidgetVCWP->before_widget . $PageWidgetVCWP->title;
		echo "<ul class=\"loop widget-loop-page\">";
			echo "<li "; post_class('clearfix'); echo ">";
				// Featured Image
				if ( $PageWidgetVCWP->show__featured_image() ) {
					featured__image( $post, array( 
						'post_thumbnail_size' => $PageWidgetVCWP->featured_image_size 
					) );
				}
				// Content
				if ( $PageWidgetVCWP->full_post() ) {
					the__content( $post );
				// Excerpt
				} else {
					the__excerpt( $post, array( 
						'count' => $PageWidgetVCWP->word_count, 
						'strip_tags' => $PageWidgetVCWP->strip_tags, 
						'read_more' => $PageWidgetVCWP->read_more, 
						'kill_read_more' => $PageWidgetVCWP->kill_read_more,
					) );
				}
			echo "</li>";
		echo "</ul>";
		echo $PageWidgetVCWP->after_widget;
		wp_reset_postdata();
	} // end while ( have_posts() )
} // end if ( have_posts() )
wp_reset_query();