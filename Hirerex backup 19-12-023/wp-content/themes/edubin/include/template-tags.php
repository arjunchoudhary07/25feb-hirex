<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Edubin
 */

if ( ! function_exists( 'edubin_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function edubin_posted_on() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		
		'<span class="author vcard">
		<i class="flaticon-user-4"></i>
		<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ). '</a></span>'
	);

	// Finally, let's write all of this to the page.
	echo '<li class="byline list-inline-item"> '
	 . $byline . '</li><li class="posted-on list-inline-item"><i class="flaticon-calendar-1"></i>' . edubin_time_link() . '</li>';
}
endif;

// Posted author
if ( ! function_exists( 'edubin_posted_author' ) ) :
/**
 * Prints HTML with meta information for the current author
 */
function edubin_posted_author() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		
		'<span class="author vcard">
		<i class="flaticon-user-4"></i>
		<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ). '</a></span>'
	);

	// Finally, let's write all of this to the page.
	echo '<li class="byline list-inline-item"> ' . $byline . '</li>';
}
endif;

// Posted date
if ( ! function_exists( 'edubin_posted_date' ) ) :
/**
 * Prints HTML with meta information for the current date
 */
function edubin_posted_date() {
	// Finally, let's write all of this to the page.
	echo '<li class="posted-on list-inline-item"><i class="flaticon-calendar-1"></i>' . edubin_time_link() . '</li>';
}
endif;


if ( ! function_exists( 'edubin_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function edubin_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	$archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d'); 
	
	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'edubin' ),
		'<a href="' . esc_url( get_day_link( $archive_year, $archive_month, $archive_day) ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;


if ( ! function_exists( 'edubin_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function edubin_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'edubin' );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '' );

	// We don't want to output .edubin-entry-footer if it will be empty, so make sure its not.
	if ( (  $tags_list ) || get_edit_post_link() ) {

			$defaults = edubin_generate_defaults();
			$blog_single_tags_show = get_theme_mod( 'blog_single_tags_show', $defaults['blog_single_tags_show'] );

			if ( 'post' === get_post_type() && $blog_single_tags_show) {
				if ( $tags_list ) {
		echo '<footer class="edubin-entry-footer">';
					echo '<div class="cat-tags-links">';

						if ( $tags_list && ! is_wp_error( $tags_list ) ) {
							echo '<span class="tags-links">' . esc_html__( 'Post Tags ', 'edubin' ) . '<span class="screen-reader-text">' . esc_html__( 'Post Tags', 'edubin' ) . '</span>' . '</span>' . $tags_list;
						}

					echo '</div>';
		echo '</footer> <!-- .edubin-entry-footer -->';
				}
			}
	}
}
endif;


if ( ! function_exists( 'edubin_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function edubin_edit_link() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'edubin' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Display a front page section.
 *
 * @param WP_Customize_Partial $partial Partial associated with a selective refresh request.
 * @param integer              $id Front page section to display.
 */
function edubin_front_page_section( $partial = null, $id = 0 ) {
	if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
		// Find out the id and set it up during a selective refresh.
		global $edubincounter;
		$id = str_replace( 'panel_', '', $partial->id );
		$edubincounter = $id;
	}

	global $post; // Modify the global post object before setting up post data.
	if ( get_theme_mod( 'panel_' . $id ) ) {
		$post = get_post( get_theme_mod( 'panel_' . $id ) );
		setup_postdata( $post );
		set_query_var( 'panel', $id );

		get_template_part( 'template-parts/page/content', 'front-page-panels' );

		wp_reset_postdata();
	} elseif ( is_customize_preview() ) {
		// The output placeholder anchor.
		echo '<article class="panel-placeholder panel edubin-panel edubin-panel' . $id . '" id="panel' . $id . '"><span class="edubin-panel-title">' . sprintf( __( 'Front Page Section %1$s Placeholder', 'edubin' ), $id ) . '</span></article>';
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function edubin_categorized_blog() {
	$category_count = get_transient( 'edubin_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'edubin_categories', $category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}

/**
 * Flush out the transients used in edubin_categorized_blog.
 */
function edubin_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'edubin_categories' );
}
add_action( 'edit_category', 'edubin_category_transient_flusher' );
add_action( 'save_post',     'edubin_category_transient_flusher' );
