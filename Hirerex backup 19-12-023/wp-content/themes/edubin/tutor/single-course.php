<?php
/**
 * Template for displaying single course
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */
    $defaults = edubin_generate_defaults();
    $tutor_single_page_layout = get_theme_mod( 'tutor_single_page_layout', $defaults['tutor_single_page_layout']);

    if ($tutor_single_page_layout == '2') :
        get_template_part( 'tutor/single', 'course_2');  
    else :
        get_template_part( 'tutor/single', 'course_1');                
    endif; //End single page layout


