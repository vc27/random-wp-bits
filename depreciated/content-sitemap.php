<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */


?>

<div id="section-sitemap" class="loop layout-sitemap">
	<div class="display-list display-list-pages">
		<div class="h3"><?php echo __( 'Pages', 'parenttheme' ); ?></div>
		<ul>
			<?php wp_list_pages( array( 'depth' => 0, 'sort_column' => 'menu_order', 'title_li' => '' ) ); ?>		
		</ul>
	</div>

	<div class="display-list display-list-categories">
		<div class="h3"><?php echo __( 'Categories', 'parenttheme' ); ?></div>
		<ul>
			<?php wp_list_categories( array( 'title_li' => '', 'hierarchical' => 0, 'show_count' => 1 ) ) ?>
		</ul>
	</div>

	<div class="display-list display-list-post-per-cat">
		<div class="h3"><?php echo __( 'Posts per category', 'parenttheme' ); ?></div>

		<?php

		echo "<ul id=\"404-category-list-posts\" class=\"category-list-posts\">";

			$terms = get_terms( 'category' );

			foreach ( $terms as $term ) {

				$query = array(
					'cat' => $term->term_id,
					'post_type' => 'post',
					'posts_per_page' => 5,
				);

				// New wp_query
				$wp_query = new WP_Query();
				$wp_query->query( $query );

				if ( $wp_query->have_posts() ) {

					echo "<li class=\"list-posts-$term->slug\">";

						echo "<div class=\"h4\"><a href=\"" . get_term_link( $term->slug, 'category' ) . "\">$term->name</a></div>";

						echo "<ul class=\"category-list-posts\">";

							while ( $wp_query->have_posts() ) { 
								$wp_query->the_post(); 

								echo "<li><a href=\"" . get_permalink( $wp_query->post->ID ) . "\" title=\"" . $wp_query->post->post_title . "\">" . $wp_query->post->post_title . "</a></li>";
							
							} // end while
							wp_reset_postdata();

						echo "</ul>";

					echo "</li>";

				} // end if ( $wp_query->have_posts() )

			} // End foreach ( $terms as $term )
			wp_reset_query();

		echo "</ul>";

		?>
	</div>
	<div class="clear"></div>
</div>