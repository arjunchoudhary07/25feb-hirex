<?php

        $settings   = $this->get_settings_for_display();

    if (function_exists('tutor')) : // Check tutor lms active

        $disable_course_duration = get_tutor_option('disable_course_duration');
        $disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
        $disable_update_date = get_tutor_option('disable_course_update_date');
        $course_duration = get_tutor_course_duration_context();
        
?>

        <div <?php echo $this->get_render_attribute_string( 'edubin_posts_column' ); ?> >

            <?php if ($settings['course_style'] == '1') : 
                echo '<div class="edubin-tutor-courses-column-area">';
                    require EDUBIN_ADDONS_PL_PATH . 'includes/widgets/templates/tutor_course_layout_1.php'; 
                echo '</div>';
                elseif ($settings['course_style'] == '2') : 
                echo '<div class="edubin-tutor-courses-column-area">';
                    require EDUBIN_ADDONS_PL_PATH . 'includes/widgets/templates/tutor_course_layout_2.php';
                echo '</div>';
                elseif ($settings['course_style'] == '3') :
                    require EDUBIN_ADDONS_PL_PATH . 'includes/widgets/templates/tutor_course_layout_3.php';
                elseif ($settings['course_style'] == '4') :
                    require EDUBIN_ADDONS_PL_PATH . 'includes/widgets/templates/tutor_course_layout_4.php';
            endif; ?>

        </div>
<?php endif; ?>