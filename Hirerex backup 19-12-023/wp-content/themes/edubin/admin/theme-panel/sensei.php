<?php
// Archive page
$wp_customize->add_section('sensei_archive_page_section',
    array(
        'title' => esc_html__('Archive Page', 'edubin'),
        'panel' => 'sensei_panel',
    )
);

// Style
$wp_customize->add_setting('sensei_course_archive_style',
    array(
        'default'           => $this->defaults['sensei_course_archive_style'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);

$wp_customize->add_control('sensei_course_archive_style',
    array(
        'label'   => esc_html__('Courses Style', 'edubin'),
        'section' => 'sensei_archive_page_section',
        'type'    => 'select',
        'choices' => array(
            '1' => esc_html__('Style 1', 'edubin'),
            '2' => esc_html__('Style 2', 'edubin'),
        ),
    )
);

// Column
$wp_customize->add_setting('sensei_course_archive_clm',
    array(
        'default'           => $this->defaults['sensei_course_archive_clm'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);
$wp_customize->add_control('sensei_course_archive_clm',
    array(
        'label'   => esc_html__('Courses Column', 'edubin'),
        'section' => 'sensei_archive_page_section',
        'type'    => 'select',
        'choices' => array(
            '6' => esc_html__('Column 2', 'edubin'),
            '4' => esc_html__('Column 3', 'edubin'),
            '3' => esc_html__('Column 4', 'edubin'),
        ),
    )
);
// Archive image size
$wp_customize->add_setting( 'sensei_archive_image_size',
    array(
        'default' => $this->defaults['sensei_archive_image_size'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_text_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Dropdown_Select2_Custom_Control( $wp_customize, 'sensei_archive_image_size',
    array(
        'label' => __( 'Image Size', 'edubin' ),
        'section' => 'sensei_archive_page_section',
        'input_attrs' => array(
            'placeholder' => __( 'Select image size', 'edubin' ),
            'multiselect' => false,
        ),
        'choices' => get_intermediate_image_sizes(),
    )
) );
// Price
$wp_customize->add_setting('sensei_hide_archive_text',
    array(
        'default'           => $this->defaults['sensei_hide_archive_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_hide_archive_text',
    array(
        'label'   => esc_html__('Hide Archive: Text', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));
// Price
$wp_customize->add_setting('sensei_price_show',
    array(
        'default'           => $this->defaults['sensei_price_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_price_show',
    array(
        'label'   => esc_html__('Price', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));

// Lesson
$wp_customize->add_setting('sensei_lesson_show',
    array(
        'default'           => $this->defaults['sensei_lesson_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_lesson_show',
    array(
        'label'   => esc_html__('Lessons', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));

// Lesson Text
$wp_customize->add_setting('sensei_lesson_text_show',
    array(
        'default'           => $this->defaults['sensei_lesson_text_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_lesson_text_show',
    array(
        'label'   => esc_html__('Lesson Text', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));

// Topic
$wp_customize->add_setting('sensei_topic_show',
    array(
        'default'           => $this->defaults['sensei_topic_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_topic_show',
    array(
        'label'   => esc_html__('Topic', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));

// Topic
$wp_customize->add_setting('sensei_topic_text_show',
    array(
        'default'           => $this->defaults['sensei_topic_text_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_topic_text_show',
    array(
        'label'   => esc_html__('Topic Text', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));

// Category
$wp_customize->add_setting('sensei_cat_show',
    array(
        'default'           => $this->defaults['sensei_cat_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_cat_show',
    array(
        'label'   => esc_html__('Category', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));
// Avatar
$wp_customize->add_setting('sensei_instructor_name_on_off',
    array(
        'default'           => $this->defaults['sensei_instructor_name_on_off'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_instructor_name_on_off',
    array(
        'label'   => esc_html__('Create by Avatar', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));

// Name
$wp_customize->add_setting('sensei_instructor_name_on_off',
    array(
        'default'           => $this->defaults['sensei_instructor_name_on_off'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_instructor_name_on_off',
    array(
        'label'   => esc_html__('Create by Name', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));

// Views
$wp_customize->add_setting('sensei_views_show',
    array(
        'default'           => $this->defaults['sensei_views_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_views_show',
    array(
        'label'   => esc_html__('Views', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));

// Comment
$wp_customize->add_setting('sensei_comment_show',
    array(
        'default'           => $this->defaults['sensei_comment_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_comment_show',
    array(
        'label'   => esc_html__('Comments', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));
// progress bar
$wp_customize->add_setting('sensei_progress_bar_show',
    array(
        'default'           => $this->defaults['sensei_progress_bar_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_progress_bar_show',
    array(
        'label'   => esc_html__('Progress Bar', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));

// custom_closed_btn_url
$wp_customize->add_setting('custom_closed_btn_url',
    array(
        'default'           => $this->defaults['custom_closed_btn_url'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'custom_closed_btn_url',
    array(
        'label'   => esc_html__('Custom Closed Button URL', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));
// See more Button
$wp_customize->add_setting('see_more_btn',
    array(
        'default'           => $this->defaults['see_more_btn'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'see_more_btn',
    array(
        'label'   => esc_html__('See More Button', 'edubin'),
        'section' => 'sensei_archive_page_section',
    )
));
// Read more button text
$wp_customize->add_setting('sensei_see_more_btn_text',
    array(
        'default'           => $this->defaults['sensei_see_more_btn_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('sensei_see_more_btn_text',
    array(
        'label'   => esc_html__('See More Button - Custom Text', 'edubin'),
        'type'    => 'text',
        'section' => 'sensei_archive_page_section',
    )
);
// Free custom text
$wp_customize->add_setting('free_custom_text',
    array(
        'default'           => $this->defaults['free_custom_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('free_custom_text',
    array(
        'label'   => esc_html__('Free - Custom Text', 'edubin'),
        'type'    => 'text',
        'section' => 'sensei_archive_page_section',
    )
);
// Free custom text
$wp_customize->add_setting('enrolled_custom_text',
    array(
        'default'           => $this->defaults['enrolled_custom_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('enrolled_custom_text',
    array(
        'label'   => esc_html__('Enrolled - Custom Text', 'edubin'),
        'type'    => 'text',
        'section' => 'sensei_archive_page_section',
    )
);
// Free custom text
$wp_customize->add_setting('completed_custom_text',
    array(
        'default'           => $this->defaults['completed_custom_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('completed_custom_text',
    array(
        'label'   => esc_html__('Completed - Custom Text', 'edubin'),
        'type'    => 'text',
        'section' => 'sensei_archive_page_section',
    )
);
// learndash single page
$wp_customize->add_section('sensei_single_page_section',
    array(
        'title' => esc_html__('Single Page', 'edubin'),
        'panel' => 'sensei_panel',
    )
);
$wp_customize->add_setting('sensei_intro_video_position',
    array(
        'default'           => $this->defaults['sensei_intro_video_position'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization',
    )
);
$wp_customize->add_control('sensei_intro_video_position',
    array(
        'label'   => esc_html__('Intro Video Position', 'edubin'),
        'section' => 'sensei_single_page_section',
        'type'    => 'select',
        'choices' => array(
            'intro_video_content' => esc_html__('Content', 'edubin'),
            'intro_video_sidebar' => esc_html__('Sidebar', 'edubin'),
        ),
    )
);
// Sidebar
$wp_customize->add_setting('sensei_sidebar_single_show',
    array(
        'default'           => $this->defaults['sensei_sidebar_single_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_sidebar_single_show',
    array(
        'label'   => esc_html__('Sidebar', 'edubin'),
        'section' => 'sensei_single_page_section',
    )
));

// Featured image
$wp_customize->add_setting('sensei_featured_image',
    array(
        'default'           => $this->defaults['sensei_featured_image'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_featured_image',
    array(
        'label'   => esc_html__('Featured Image', 'edubin'),
        'section' => 'sensei_single_page_section',
    )
));
// Related
$wp_customize->add_setting('sensei_related_course_show',
    array(
        'default'           => $this->defaults['sensei_related_course_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_related_course_show',
    array(
        'label'       => esc_html__('Related Course', 'edubin'),
        'description' => esc_html__('Show hide your sidebar you may like course section', 'edubin'),
        'section'     => 'sensei_single_page_section',
    )
));
// Related Course heading
$wp_customize->add_setting('sensei_related_course_heading',
    array(
        'default'           => $this->defaults['sensei_related_course_heading'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);

$wp_customize->add_control('sensei_related_course_heading',
    array(
        'label'   => esc_html__('Related Course Heading', 'edubin'),
        'type'    => 'text',
        'section' => 'sensei_single_page_section',
    )
);
// views
$wp_customize->add_setting('sensei_related_course_views',
    array(
        'default'           => $this->defaults['sensei_related_course_views'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_related_course_views',
    array(
        'label'   => esc_html__('Related Course Views', 'edubin'),
        'section' => 'sensei_single_page_section',
    )
));
// Price
$wp_customize->add_setting('sensei_related_course_price',
    array(
        'default'           => $this->defaults['sensei_related_course_price'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'sensei_related_course_price',
    array(
        'label'   => esc_html__('Related Course Price', 'edubin'),
        'section' => 'sensei_single_page_section',
    )
));

// Learndash other settings start
$wp_customize->add_section('sensei_course_others_section',
    array(
        'title' => esc_html__('Utilities', 'edubin'),
        'panel' => 'sensei_panel',
    )
);
// Custom placeholder image
$wp_customize->add_setting('sensei_custom_placeholder_image', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'edubin_radio_sanitization',
    'transport'         => 'refresh',
    'default'           => $this->defaults['sensei_custom_placeholder_image'],
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sensei_custom_placeholder_image', array(
    'label'   => esc_html__('Custom Placeholder Image', 'edubin'),
    'section' => 'sensei_course_others_section',
)));
