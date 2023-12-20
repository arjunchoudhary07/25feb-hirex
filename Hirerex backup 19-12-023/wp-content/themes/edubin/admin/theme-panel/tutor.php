<?php
    // Archive page
    $wp_customize->add_section('tutor_archive_page_section',
        array(
            'title' => esc_html__('Course Archive', 'edubin'),
            'panel' => 'tutor_panel',
        )
    );
    // Course Style
    $wp_customize->add_setting( 'tutor_course_archive_style',
        array(
            'default' => $this->defaults['tutor_course_archive_style'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_radio_sanitization'
        )
    );
    $wp_customize->add_control( 'tutor_course_archive_style',
        array(
            'label' => esc_html__( 'Course Styles', 'edubin' ),
            'section' => 'tutor_archive_page_section',
            'type' => 'select',
            'choices' => array(
                '1' => esc_html__( 'Style 1', 'edubin' ),
                '2' => esc_html__( 'Style 2', 'edubin' ),
                '3' => esc_html__( 'Style 3', 'edubin' ),
                '4' => esc_html__( 'Style 4', 'edubin' ),
            )
        )
    );
    // Instructor image
    $wp_customize->add_setting( 'tutor_instructor_img_on_off',
        array(
            'default' => $this->defaults['tutor_instructor_img_on_off'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tutor_instructor_img_on_off',
        array(
            'label' => esc_html__( 'Instructor Image', 'edubin' ),
            'section' => 'tutor_archive_page_section'
        )
    ) );    
    // Instructor name
    $wp_customize->add_setting( 'tutor_instructor_name_on_off',
        array(
            'default' => $this->defaults['tutor_instructor_name_on_off'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tutor_instructor_name_on_off',
        array(
            'label' => esc_html__( 'Instructor Name', 'edubin' ),
            'section' => 'tutor_archive_page_section'
        )
    ) );
    // Category
    $wp_customize->add_setting( 'tutor_cat_show',
        array(
            'default' => $this->defaults['tutor_cat_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tutor_cat_show',
        array(
            'label' => esc_html__( 'Category', 'edubin' ),
            'section' => 'tutor_archive_page_section'
        )
    ) );  
   // tutor_enroll_show
    $wp_customize->add_setting( 'tutor_enroll_show',
        array(
            'default' => $this->defaults['tutor_enroll_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tutor_enroll_show',
        array(
            'label' => esc_html__( 'Enroll', 'edubin' ),
            'section' => 'tutor_archive_page_section'
        )
    ) );  

   // tutor_lesson_show
    $wp_customize->add_setting( 'tutor_lesson_show',
        array(
            'default' => $this->defaults['tutor_lesson_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tutor_lesson_show',
        array(
            'label' => esc_html__( 'Lesson', 'edubin' ),
            'section' => 'tutor_archive_page_section'
        )
    ) );  
    // tutor_lesson_text
    $wp_customize->add_setting( 'tutor_lesson_text',
        array(
            'default' => $this->defaults['tutor_lesson_text'],
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_filter_nohtml_kses'
        )
    );

    $wp_customize->add_control( 'tutor_lesson_text',
        array(
            'label' => esc_html__( 'Lesson - Custom Text', 'edubin' ),
            'type' => 'text',
            'section' => 'tutor_course_filter_section'
        )
    );
    // tutor_lessons_text
    $wp_customize->add_setting( 'tutor_lessons_text',
        array(
            'default' => $this->defaults['tutor_lessons_text'],
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_filter_nohtml_kses'
        )
    );

    $wp_customize->add_control( 'tutor_lessons_text',
        array(
            'label' => esc_html__( 'Lessons - Custom Text', 'edubin' ),
            'type' => 'text',
            'section' => 'tutor_course_filter_section'
        )
    );
    // tutor_duration_show
    $wp_customize->add_setting( 'tutor_duration_show',
        array(
            'default' => $this->defaults['tutor_duration_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tutor_duration_show',
        array(
            'label' => esc_html__( 'Duration', 'edubin' ),
            'section' => 'tutor_archive_page_section'
        )
    ) );  

    // Price
    $wp_customize->add_setting( 'tutor_price_show',
        array(
            'default' => $this->defaults['tutor_price_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tutor_price_show',
        array(
            'label' => esc_html__( 'Price', 'edubin' ),
            'section' => 'tutor_archive_page_section'
        )
    ) );  

// Top filter bar
$wp_customize->add_setting('tutor_hide_archive_text',
    array(
        'default'           => $this->defaults['tutor_hide_archive_text'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_hide_archive_text',
    array(
        'label'   => esc_html__('Hide Archive: Text', 'edubin'),
        'section' => 'tutor_archive_page_section',
    )
));
// Course image fix size
$wp_customize->add_setting( 'tutor_course_fix_img_height',
    array(
        'default' => $this->defaults['tutor_course_fix_img_height'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_sanitize_integer'

    )
);
$wp_customize->add_control( new Edubin_Slider_Custom_Control( $wp_customize, 'tutor_course_fix_img_height',
    array(
        'label' => esc_html__( 'Fix Image Height', 'edubin' ),
        'section' => 'tutor_archive_page_section', 
        'input_attrs' => array(
            'min' => 100, 
            'max' => 450, 
            'step' => 1, 
        ),
    )
) );
// Course title fix size
$wp_customize->add_setting( 'tutor_course_fix_title_height',
    array(
        'default' => $this->defaults['tutor_course_fix_title_height'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_sanitize_integer'

    )
);
$wp_customize->add_control( new Edubin_Slider_Custom_Control( $wp_customize, 'tutor_course_fix_title_height',
    array(
        'label' => esc_html__( 'Fix Title Height', 'edubin' ),
        'section' => 'tutor_archive_page_section', 
        'input_attrs' => array(
            'min' => 10, 
            'max' => 120, 
            'step' => 1, 
        ),
    )
) );
// Top filter bar
$wp_customize->add_setting('top_course_filter',
    array(
        'default'           => $this->defaults['top_course_filter'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'top_course_filter',
    array(
        'label'   => esc_html__('Course Filter Bar', 'edubin'),
        'section' => 'tutor_archive_page_section',
    )
));

// Search & Filter plugin
$wp_customize->add_setting('search_filter_plugin',
    array(
        'default'           => $this->defaults['search_filter_plugin'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'search_filter_plugin',
    array(
        'label'   => esc_html__('Filter by (Search & Filter plugin)', 'edubin'),
        'section' => 'tutor_archive_page_section',
    )
));
// Price text 
$wp_customize->add_setting( 'search_filter_plugin_shortcode',
    array(
        'default' => $this->defaults['search_filter_plugin_shortcode'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    )
);

$wp_customize->add_control( 'search_filter_plugin_shortcode',
    array(
        'label' => esc_html__( 'Search & Filter Plugin Shortcode', 'edubin' ),
        'section' => 'tutor_archive_page_section',
    )
);

// ========= Start filter settings =======
$wp_customize->add_section('tutor_course_filter_section',
    array(
        'title' => esc_html__('Course Filter', 'edubin'),
        'panel' => 'tutor_panel',
    )
);
// Filter course per page
$wp_customize->add_setting( 'tutor_course_filter_per_page',
    array(
        'default' => $this->defaults['tutor_course_filter_per_page'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_sanitize_integer'

    )
);
$wp_customize->add_control( new Edubin_Slider_Custom_Control( $wp_customize, 'tutor_course_filter_per_page',
    array(
        'label' => esc_html__( 'Course Filter Per Page', 'edubin' ),
        'section' => 'tutor_course_filter_section', 
        'priority'       => 6,
        'input_attrs' => array(
            'min' => 3, 
            'max' => 21, 
            'step' => 1, 
        ),
    )
) );
// Filter course column
$wp_customize->add_setting( 'tutor_course_filter_column',
    array(
        'default' => $this->defaults['tutor_course_filter_column'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_sanitize_integer'

    )
);
$wp_customize->add_control( new Edubin_Slider_Custom_Control( $wp_customize, 'tutor_course_filter_column',
    array(
        'label' => esc_html__( 'Course Filter Column', 'edubin' ),
        'section' => 'tutor_course_filter_section', 
        'input_attrs' => array(
            'min' => 2, 
            'max' => 4, 
            'step' => 1, 
        ),
    )
) );
// Course search
$wp_customize->add_setting('filter_course_search_show',
    array(
        'default'           => $this->defaults['filter_course_search_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'filter_course_search_show',
    array(
        'label'   => esc_html__('Course Search', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));

// Results show
$wp_customize->add_setting('tutor_filter_results_show',
    array(
        'default'           => $this->defaults['tutor_filter_results_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_filter_results_show',
    array(
        'label'   => esc_html__('Filter Results', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));

// Select show
$wp_customize->add_setting('tutor_filter_select_show',
    array(
        'default'           => $this->defaults['tutor_filter_select_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_filter_select_show',
    array(
        'label'   => esc_html__('Filter Select', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));

// Top filter bar
$wp_customize->add_setting('tutor_sidebar_filter_show',
    array(
        'default'           => $this->defaults['tutor_sidebar_filter_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_sidebar_filter_show',
    array(
        'label'   => esc_html__('Sidebar Filter', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));
// Sidebar positon
$wp_customize->add_setting( 'tutor_filter_sidebar_position',
    array(
        'default' => $this->defaults['tutor_filter_sidebar_position'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization'
    )
);
$wp_customize->add_control( 'tutor_filter_sidebar_position',
    array(
        'label' => esc_html__( 'Sidebar Position', 'edubin' ),
        'section' => 'tutor_course_filter_section',
        'type' => 'select',
        'choices' => array(
            'left' => esc_html__( 'Left', 'edubin' ),
            'right' => esc_html__( 'Right', 'edubin' ),
        )
    )
);
// Course category count
$wp_customize->add_setting('tutor_course_cat_count',
    array(
        'default'           => $this->defaults['tutor_course_cat_count'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_course_cat_count',
    array(
        'label'   => esc_html__('Courses Count', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));
// Price
$wp_customize->add_setting('tutor_filter_price_show',
    array(
        'default'           => $this->defaults['tutor_filter_price_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_filter_price_show',
    array(
        'label'   => esc_html__('Price', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));
// Price text 
$wp_customize->add_setting( 'tutor_filter_custom_price_text',
    array(
        'default' => $this->defaults['tutor_filter_custom_price_text'],
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    )
);

$wp_customize->add_control( 'tutor_filter_custom_price_text',
    array(
        'label' => esc_html__( 'Price - Custom Text', 'edubin' ),
        'type' => 'text',
        'section' => 'tutor_course_filter_section'
    )
);
// Level
$wp_customize->add_setting('tutor_filter_level_show',
    array(
        'default'           => $this->defaults['tutor_filter_level_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_filter_level_show',
    array(
        'label'   => esc_html__('Level', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));
// Level 
$wp_customize->add_setting( 'tutor_filter_custom_level_text',
    array(
        'default' => $this->defaults['tutor_filter_custom_level_text'],
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    )
);

$wp_customize->add_control( 'tutor_filter_custom_level_text',
    array(
        'label' => esc_html__( 'Level - Custom Text', 'edubin' ),
        'type' => 'text',
        'section' => 'tutor_course_filter_section'
    )
);

// Category
$wp_customize->add_setting('tutor_filter_category_show',
    array(
        'default'           => $this->defaults['tutor_filter_category_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_filter_category_show',
    array(
        'label'   => esc_html__('Category', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));
// Category title
$wp_customize->add_setting( 'tutor_filter_custom_cat_text',
    array(
        'default' => $this->defaults['tutor_filter_custom_cat_text'],
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    )
);
$wp_customize->add_control( 'tutor_filter_custom_cat_text',
    array(
        'label' => esc_html__( 'Category - Custom Text', 'edubin' ),
        'type' => 'text',
        'section' => 'tutor_course_filter_section'
    )
);
// Topic
$wp_customize->add_setting('tutor_filter_topic_show',
    array(
        'default'           => $this->defaults['tutor_filter_topic_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_filter_topic_show',
    array(
        'label'   => esc_html__('Topic', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));
// Topic title
$wp_customize->add_setting( 'tutor_filter_custom_topic_text',
    array(
        'default' => $this->defaults['tutor_filter_custom_topic_text'],
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    )
);
$wp_customize->add_control( 'tutor_filter_custom_topic_text',
    array(
        'label' => esc_html__( 'Topic - Custom Text', 'edubin' ),
        'type' => 'text',
        'section' => 'tutor_course_filter_section'
    )
);

// Pagination
$wp_customize->add_setting('tutor_course_pagination',
    array(
        'default'           => $this->defaults['tutor_course_pagination'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_course_pagination',
    array(
        'label'   => esc_html__('Pagination', 'edubin'),
        'section' => 'tutor_course_filter_section',
    )
));

// ========= End filter settings =======

// Tutor single page
$wp_customize->add_section('tutor_single_page_section',
    array(
        'title' => esc_html__('Single Page', 'edubin'),
        'panel' => 'tutor_panel',
    )
);
    // Course Style
    $wp_customize->add_setting( 'tutor_single_page_layout',
        array(
            'default' => $this->defaults['tutor_single_page_layout'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_radio_sanitization'
        )
    );
    $wp_customize->add_control( 'tutor_single_page_layout',
        array(
            'label' => esc_html__( 'Single Page Layout', 'edubin' ),
            'section' => 'tutor_single_page_section',
            'type' => 'select',
            'choices' => array(
                '1' => esc_html__( 'Layout 1', 'edubin' ),
                '2' => esc_html__( 'Layout 2', 'edubin' ),
            )
        )
    );

// Double course title
$wp_customize->add_setting('course_title_show',
    array(
        'default'           => $this->defaults['course_title_show'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'course_title_show',
    array(
        'label'   => esc_html__('Double Course Title', 'edubin'),
        'section' => 'tutor_single_page_section',
    )
));
// Tutor single page
$wp_customize->add_section('tutor_login_page_section',
    array(
        'title' => esc_html__('Login Page', 'edubin'),
        'panel' => 'tutor_panel',
    )
);
// Header page title align
$wp_customize->add_setting('tutor_login_form_widget_align',
    array(
        'default'           => $this->defaults['tutor_login_form_widget_align'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_text_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Text_Radio_Button_Custom_Control($wp_customize, 'tutor_login_form_widget_align',
    array(
        'label'    => __('Widget Align'),
        'section'  => 'tutor_login_page_section',
        'choices'  => array(
            'left'   => __('Left'),
            'center' => __('Centered'),
            'right'  => __('Right'),
        ),
    )
));

      // Learnpress other settings start
   $wp_customize->add_section( 'tutor_course_others_section',
        array(
            'title' => esc_html__( 'Utilities', 'edubin' ),
            'panel' => 'tutor_panel'
        )
    );
// Use Tutor LMS settings color
$wp_customize->add_setting('tutor_settings_color',
    array(
        'default'           => $this->defaults['tutor_settings_color'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_settings_color',
    array(
        'label'   => esc_html__('Use Tutor Settings Color', 'edubin'),
        'section' => 'tutor_course_others_section',
    )
));

// tutor_hide_profile_page_header
$wp_customize->add_setting('tutor_hide_profile_page_header',
    array(
        'default'           => $this->defaults['tutor_hide_profile_page_header'],
        'transport'         => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization',
    )
);
$wp_customize->add_control(new Edubin_Toggle_Switch_Custom_control($wp_customize, 'tutor_hide_profile_page_header',
    array(
        'label'   => esc_html__('Hide Profile Page Header', 'edubin'),
        'section' => 'tutor_course_others_section',
    )
));

