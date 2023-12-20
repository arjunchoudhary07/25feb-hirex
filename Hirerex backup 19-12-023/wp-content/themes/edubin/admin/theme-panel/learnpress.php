<?php
// Archive page
$wp_customize->add_section('learnpress_archive_page_section',
    array(
        'title' => esc_html__('Archive Page', 'edubin'),
        'panel' => 'learnpress_panel',
    )
);

// Style
$wp_customize->add_setting('lp_course_archive_style',
    array(
        'default'           => $this->defaults['lp_course_archive_style'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);
$wp_customize->add_control('lp_course_archive_style',
    array(
        'label'   => esc_html__('Courses Style', 'edubin'),
        'section' => 'learnpress_archive_page_section',
        'type'    => 'select',
        'choices' => array(
            '1' => esc_html__('Style 1', 'edubin'),
            '2' => esc_html__('Style 2', 'edubin'),
            '3' => esc_html__('Style 3', 'edubin'),
            '4' => esc_html__('Style 4', 'edubin'),
            '5' => esc_html__('Style 5', 'edubin'),
        ),
    )
);

// Column
$wp_customize->add_setting('lp_course_archive_clm',
    array(
        'default'           => $this->defaults['lp_course_archive_clm'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);
$wp_customize->add_control('lp_course_archive_clm',
    array(
        'label'   => esc_html__('Courses Column', 'edubin'),
        'section' => 'learnpress_archive_page_section',
        'type'    => 'select',
        'choices' => array(
            '6' => esc_html__('Column 2', 'edubin'),
            '4' => esc_html__('Column 3', 'edubin'),
            '3' => esc_html__('Column 4', 'edubin'),
        ),
    )
);
// Hide archive: text
$wp_customize->add_setting('lp_hide_archive_text',
    array(
        'default'           => $this->defaults['lp_hide_archive_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_hide_archive_text',
    array(
        'label'   => esc_html__('Hide Archive: Text', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// LP top bar
$wp_customize->add_setting('lp_header_top',
    array(
        'default'           => $this->defaults['lp_header_top'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_header_top',
    array(
        'label'   => esc_html__('Top Bar', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Price
$wp_customize->add_setting('lp_price_show',
    array(
        'default'           => $this->defaults['lp_price_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_price_show',
    array(
        'label'   => esc_html__('Price', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Full Price
$wp_customize->add_setting('lp_full_price_show',
    array(
        'default'           => $this->defaults['lp_full_price_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_full_price_show',
    array(
        'label'   => esc_html__('Show Price .00', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Review
$wp_customize->add_setting('lp_review_on_off',
    array(
        'default'           => $this->defaults['lp_review_on_off'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_review_on_off',
    array(
        'label'   => esc_html__('Review', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Review Text
$wp_customize->add_setting('lp_review_text_on_off',
    array(
        'default'           => $this->defaults['lp_review_text_on_off'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_review_text_on_off',
    array(
        'label'   => esc_html__('Review Text', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Instructor image
$wp_customize->add_setting('lp_instructor_img_on_off',
    array(
        'default'           => $this->defaults['lp_instructor_img_on_off'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_instructor_img_on_off',
    array(
        'label'   => esc_html__('Instructor Image', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Instructor name
$wp_customize->add_setting('lp_instructor_name_on_off',
    array(
        'default'           => $this->defaults['lp_instructor_name_on_off'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_instructor_name_on_off',
    array(
        'label'   => esc_html__('Instructor Name', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Enroll
$wp_customize->add_setting('lp_enroll_on_off',
    array(
        'default'           => $this->defaults['lp_enroll_on_off'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_enroll_on_off',
    array(
        'label'   => esc_html__('Enroll', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));

// Comment
$wp_customize->add_setting('lp_comment_show',
    array(
        'default'           => $this->defaults['lp_comment_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_comment_show',
    array(
        'label'   => esc_html__('Comments', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Lesson
$wp_customize->add_setting('lp_lesson_show',
    array(
        'default'           => $this->defaults['lp_lesson_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_lesson_show',
    array(
        'label'   => esc_html__('Lesson', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Quiz
$wp_customize->add_setting('lp_quiz_show',
    array(
        'default'           => $this->defaults['lp_quiz_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_quiz_show',
    array(
        'label'   => esc_html__('Quiz', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Categories
$wp_customize->add_setting('lp_cat_show',
    array(
        'default'           => $this->defaults['lp_cat_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_cat_show',
    array(
        'label'   => esc_html__('Categories', 'edubin'),
        'section' => 'learnpress_archive_page_section',
    )
));
// Logo size
$wp_customize->add_setting('lp_archive_image_height',
    array(
        'default'           => $this->defaults['lp_archive_image_height'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_sanitize_integer',

    )
);
$wp_customize->add_control(new Edubin_Slider_Custom_Control($wp_customize, 'lp_archive_image_height',
    array(
        'label'       => esc_html__('Image Height', 'edubin'),
        'section'     => 'learnpress_archive_page_section',
        'input_attrs' => array(
            'min'  => 100,
            'max'  => 300,
            'step' => 1,
        ),
    )
));

// Archive image size
$wp_customize->add_setting( 'lp_archive_image_size',
    array(
        'default' => $this->defaults['lp_archive_image_size'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_text_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Dropdown_Select2_Custom_Control( $wp_customize, 'lp_archive_image_size',
    array(
        'label' => __( 'Image Size', 'edubin' ),
        'section' => 'learnpress_archive_page_section',
        'input_attrs' => array(
            'placeholder' => __( 'Select image size', 'edubin' ),
            'multiselect' => false,
        ),
        'choices' => get_intermediate_image_sizes(),
    )
) );

// ====== Star LearnPress single page settings =======
$wp_customize->add_section('learnpress_single_page_section',
    array(
        'title' => esc_html__('Single Page', 'edubin'),
        'panel' => 'learnpress_panel',
    )
);
$wp_customize->add_setting('lp_single_page_layout',
    array(
        'default'           => $this->defaults['lp_single_page_layout'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);
$wp_customize->add_control('lp_single_page_layout',
    array(
        'label'   => esc_html__('Layout', 'edubin'),
        'section' => 'learnpress_single_page_section',
        'type'    => 'select',
        'choices' => array(
            '1' => esc_html__('Layout 1', 'edubin'),
            '2' => esc_html__('Layout 2', 'edubin'),
        ),
    )
);
$wp_customize->add_setting('lp_intro_video_position',
    array(
        'default'           => $this->defaults['lp_intro_video_position'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);
$wp_customize->add_control('lp_intro_video_position',
    array(
        'label'   => esc_html__('Intro Video Position', 'edubin'),
        'section' => 'learnpress_single_page_section',
        'type'    => 'select',
        'choices' => array(
            'intro_video_content' => esc_html__('Content', 'edubin'),
            'intro_video_sidebar' => esc_html__('Sidebar', 'edubin'),
        ),
    )
);
// Instructor
$wp_customize->add_setting('lp_instructor_single',
    array(
        'default'           => $this->defaults['lp_instructor_single'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_instructor_single',
    array(
        'label'   => esc_html__('Instructor', 'edubin'),
        'section' => 'learnpress_single_page_section',
    )
));

// Category
$wp_customize->add_setting('lp_cat_single',
    array(
        'default'           => $this->defaults['lp_cat_single'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_cat_single',
    array(
        'label'   => esc_html__('Category', 'edubin'),
        'section' => 'learnpress_single_page_section',
    )
));
// Review
$wp_customize->add_setting('lp_review_single',
    array(
        'default'           => $this->defaults['lp_review_single'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);

$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_review_single',
    array(
        'label'   => esc_html__('Review', 'edubin'),
        'section' => 'learnpress_single_page_section',
    )
));

// Custom price text
$wp_customize->add_setting('lp_course_price_text',
    array(
        'default'           => $this->defaults['lp_course_price_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_price_text',
    array(
        'label'   => esc_html__('Price - Custom Text', 'edubin'),
        'type'    => 'text',
        'section' => 'learnpress_single_page_section',
    )
);
// Custom buy now btn
$wp_customize->add_setting('lp_course_buy_now_btn',
    array(
        'default'           => $this->defaults['lp_course_buy_now_btn'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_buy_now_btn',
    array(
        'label'   => esc_html__('Buy Now - Custom Button Text', 'edubin'),
        'type'    => 'text',
        'section' => 'learnpress_single_page_section',
    )
);
// custom enroll btb
$wp_customize->add_setting('lp_course_enroll_btn',
    array(
        'default'           => $this->defaults['lp_course_enroll_btn'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_enroll_btn',
    array(
        'label'   => esc_html__('Enroll - Custom Button Text', 'edubin'),
        'type'    => 'text',
        'section' => 'learnpress_single_page_section',
    )
);

// Learnpress Course information
$wp_customize->add_section('course_features_section',
    array(
        'title' => esc_html__('Course Features', 'edubin'),
        'panel' => 'learnpress_panel',
    )
);
// Course features title
$wp_customize->add_setting('lp_course_feature_title',
    array(
        'default'           => $this->defaults['lp_course_feature_title'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_title',
    array(
        'label'   => esc_html__('Custom Course Features Title', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);
// Learnpress custom meta position
$wp_customize->add_setting('lp_custom_features_position',
    array(
        'default'           => $this->defaults['lp_custom_features_position'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);
$wp_customize->add_control('lp_custom_features_position',
    array(
        'label'   => esc_html__('Custom Features List Position', 'edubin'),
        'section' => 'course_features_section',
        'type'    => 'select',
        'choices' => array(
            'top'    => esc_html__('Top', 'edubin'),
            'bottom' => esc_html__('Buttom', 'edubin'),
        ),
    )
);
// Course enroll
$wp_customize->add_setting('lp_course_feature_enroll_show',
    array(
        'default'           => $this->defaults['lp_course_feature_enroll_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_enroll_show',
    array(
        'label'   => esc_html__('Enrolled', 'edubin'),
        'section' => 'course_features_section',
    )
));
$wp_customize->add_setting('lp_course_feature_enroll',
    array(
        'default'           => $this->defaults['lp_course_feature_enroll'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_enroll',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);
// Course duration
$wp_customize->add_setting('lp_course_feature_duration_show',
    array(
        'default'           => $this->defaults['lp_course_feature_duration_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_duration_show',
    array(
        'label'   => esc_html__('Duration', 'edubin'),
        'section' => 'course_features_section',
    )
));
$wp_customize->add_setting('lp_course_feature_duration',
    array(
        'default'           => $this->defaults['lp_course_feature_duration'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_duration',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);
// Course Lessons
$wp_customize->add_setting('lp_course_feature_lessons_show',
    array(
        'default'           => $this->defaults['lp_course_feature_lessons_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_lessons_show',
    array(
        'label'   => esc_html__('Lessons', 'edubin'),
        'section' => 'course_features_section',
    )
));
$wp_customize->add_setting('lp_course_feature_lessons',
    array(
        'default'           => $this->defaults['lp_course_feature_lessons'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_lessons',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);
// Course max student
$wp_customize->add_setting('lp_course_feature_max_students_show',
    array(
        'default'           => $this->defaults['lp_course_feature_max_students_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_max_students_show',
    array(
        'label'   => esc_html__('Max Students', 'edubin'),
        'section' => 'course_features_section',
    )
));
$wp_customize->add_setting('lp_course_feature_max_tudents',
    array(
        'default'           => $this->defaults['lp_course_feature_max_tudents'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_max_tudents',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);

// Course quizzes
$wp_customize->add_setting('lp_course_feature_quizzes_show',
    array(
        'default'           => $this->defaults['lp_course_feature_quizzes_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_quizzes_show',
    array(
        'label'   => esc_html__('Quizzes', 'edubin'),
        'section' => 'course_features_section',
    )
));

$wp_customize->add_setting('lp_course_feature_quizzes',
    array(
        'default'           => $this->defaults['lp_course_feature_quizzes'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_quizzes',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);
// Course retake count
$wp_customize->add_setting('lp_course_feature_retake_count_show',
    array(
        'default'           => $this->defaults['lp_course_feature_retake_count_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_retake_count_show',
    array(
        'label'   => esc_html__('Re-take', 'edubin'),
        'section' => 'course_features_section',
    )
));
$wp_customize->add_setting('lp_course_feature_retake_count',
    array(
        'default'           => $this->defaults['lp_course_feature_retake_count'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_retake_count',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);
// Course Assessments
$wp_customize->add_setting('lp_course_feature_assessments_show',
    array(
        'default'           => $this->defaults['lp_course_feature_assessments_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_assessments_show',
    array(
        'label'   => esc_html__('Assessments', 'edubin'),
        'section' => 'course_features_section',
    )
));
$wp_customize->add_setting('lp_course_feature_assessments',
    array(
        'default'           => $this->defaults['lp_course_feature_assessments'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_assessments',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);

// Course Skill Level
$wp_customize->add_setting('lp_course_feature_skill_level_show',
    array(
        'default'           => $this->defaults['lp_course_feature_skill_level_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_skill_level_show',
    array(
        'label'   => esc_html__('Skill Level', 'edubin'),
        'section' => 'course_features_section',
    )
));
$wp_customize->add_setting('lp_course_feature_skill_level',
    array(
        'default'           => $this->defaults['lp_course_feature_skill_level'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_skill_level',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);
// Course Cat
$wp_customize->add_setting('lp_course_feature_cat_show',
    array(
        'default'           => $this->defaults['lp_course_feature_cat_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_cat_show',
    array(
        'label'   => esc_html__('Category', 'edubin'),
        'section' => 'course_features_section',
    )
));
$wp_customize->add_setting('lp_course_feature_cat',
    array(
        'default'           => $this->defaults['lp_course_feature_cat'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_cat',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);
// Course Language
$wp_customize->add_setting('lp_course_feature_language_show',
    array(
        'default'           => $this->defaults['lp_course_feature_language_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_course_feature_language_show',
    array(
        'label'   => esc_html__('Language', 'edubin'),
        'section' => 'course_features_section',
    )
));
$wp_customize->add_setting('lp_course_feature_language',
    array(
        'default'           => $this->defaults['lp_course_feature_language'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('lp_course_feature_language',
    array(
        'label'   => esc_html__('Custom Level', 'edubin'),
        'type'    => 'text',
        'section' => 'course_features_section',
    )
);

// Learnpress other settings start
$wp_customize->add_section('lp_course_others_section',
    array(
        'title' => esc_html__('Utilities', 'edubin'),
        'panel' => 'learnpress_panel',
    )
);
// Course features title
$wp_customize->add_setting('lp_double_breadcrumbs',
    array(
        'default'           => $this->defaults['lp_double_breadcrumbs'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'lp_double_breadcrumbs',
    array(
        'label'   => esc_html__('Hide Duplicate Term in Breadcrumb', 'edubin'),
        'section' => 'lp_course_others_section',
    )
));
$wp_customize->add_setting('lp_course_feature_assessments',
    array(
        'default'           => $this->defaults['lp_course_feature_assessments'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);
