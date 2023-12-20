<?php

/**
 * Enqueue parent and child styles
 */
function edubin_child_enqueue_styles() {
	wp_enqueue_style( 'edubin-parent', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'edubin-child', get_stylesheet_directory_uri() . '/style.css', array( 'edubin-parent' ) );
}

add_action( 'wp_enqueue_scripts', 'edubin_child_enqueue_styles', 11 );


