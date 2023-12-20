<?php
/**
 * The sidebar containing the main widget area
 * @package Edubin
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}

?>

<aside id="secondary" class="widget-area">
    <?php 
        if ( 'sfwd-courses' == get_post_type() || 'sfwd-lessons' == get_post_type() || 'sfwd-quiz' == get_post_type() || 'sfwd-topic' == get_post_type() || 'sfwd-certificates' == get_post_type() || 'groups' == get_post_type() || 'groups-lessons' == get_post_type() || 'groups-quiz' == get_post_type() || 'groups-topic' == get_post_type() || 'groups-certificates' == get_post_type() )  :    
                dynamic_sidebar( 'ld-course-sidebar-1' );
        else :
            dynamic_sidebar( 'sidebar-1' );
        endif;
    ?>
</aside><!-- #secondary -->