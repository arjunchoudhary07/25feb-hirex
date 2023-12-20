<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

$disable_course_duration = get_tutor_option('disable_course_duration');
$disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
$disable_update_date = get_tutor_option('disable_course_update_date');
$course_duration = get_tutor_course_duration_context();

$defaults = edubin_generate_defaults();
$tutor_course_archive_style = get_theme_mod( 'tutor_course_archive_style', $defaults['tutor_course_archive_style']);
$tutor_instructor_img_on_off = get_theme_mod( 'tutor_instructor_img_on_off', $defaults['tutor_instructor_img_on_off']);
$tutor_instructor_name_on_off = get_theme_mod( 'tutor_instructor_name_on_off', $defaults['tutor_instructor_name_on_off']);
$tutor_price_show = get_theme_mod( 'tutor_price_show', $defaults['tutor_price_show']);



$user_name = sanitize_text_field( get_query_var( 'tutor_profile_username' ) );
$get_user  = tutor_utils()->get_user_by_login( $user_name );
$user_id   = $get_user->ID;

$pageposts = tutor_utils()->get_courses_by_instructor( $user_id );
?>
<div class="tutor-grid tutor-grid-3 edubin__tutor___enrolled-courses">
	<?php
	if ( $pageposts ) {
		global $post;
		
		foreach ( $pageposts as $post ) {
			setup_postdata( $post );

			/**
			 * @hook tutor_course/archive/before_loop_course
			 * @type action
			 * Usage Idea, you may keep a loop within a wrap, such as bootstrap col
			 */
			do_action( 'tutor_course/archive/before_loop_course' );

		    echo '<div class="layout__'.$tutor_course_archive_style.'">';

		        if ($tutor_course_archive_style == '2') :        
		            get_template_part( 'tutor/loop/layout', '2'); 
		        elseif ($tutor_course_archive_style == '3') :
		            get_template_part( 'tutor/loop/layout', '3'); 
		        elseif ($tutor_course_archive_style == '4') :
		            get_template_part( 'tutor/loop/layout', '4');
		        else :       
		        	tutor_load_template('loop.course');           
		        endif; //End course style

			echo '</div>';

			/**
			 * @hook tutor_course/archive/after_loop_course
			 * @type action
			 * Usage Idea, If you start any div before course loop, you can end it here, such as </div>
			 */
			do_action( 'tutor_course/archive/after_loop_course' );
		}
	} else {
		?>
			<p><?php _e( 'No course yet.', 'edubin' ); ?></p>
		<?php
	}
	?>
</div>