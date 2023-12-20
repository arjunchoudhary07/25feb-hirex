<?php
/**
 * Template for displaying title of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/title.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();

$defaults = edubin_generate_defaults();
$lp_single_page_layout = get_theme_mod('lp_single_page_layout', $defaults['lp_single_page_layout']); 

if ($lp_single_page_layout == '2') : // The section visible only for layout 2

?>

<h1 class="course-title"><?php the_title(); ?></h1>

<?php endif; // End section only visible for layout 2 ?>