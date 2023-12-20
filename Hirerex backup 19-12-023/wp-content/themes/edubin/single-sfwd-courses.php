
<?php
/**
 * The template for displaying learndash single page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package edubin
 */

$post_id = edubin_get_id();

if (function_exists('edubinGetPostViewsCustom')) {edubinSetPostViewsCustom(get_the_ID());}

get_header();?>

<?php get_template_part('template-parts/page/learndash', 'page');?>

<?php
get_footer();
