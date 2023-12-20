<?php 
     $wp_customize->add_panel( 'blog_panel',
        array(
            'title' => esc_html__( 'Blog', 'edubin' ),
            'priority'   => 100,
        )
    );
    // List page
    $wp_customize->add_section( 'blog_list_section',
        array(
            'title' => esc_html__( 'Blog Page', 'edubin' ),
            'panel' => 'blog_panel',
        )
    );

    // Blog sidebar position 
    $wp_customize->add_setting( 'blog_sidebar',
        array(
            'default' => $this->defaults['blog_sidebar'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_radio_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Image_Radio_Button_Custom_Control( $wp_customize, 'blog_sidebar',
        array(
            'label' => esc_html__( 'Sidebar', 'edubin' ),
            'description' => esc_html__( 'Select your sidebar position', 'edubin' ),
            'section' => 'blog_list_section',
            'choices' => array(
                'sidebarleft' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'admin/assets/images/sidebar-left.png',
                    'name' => esc_html__( 'Left Sidebar', 'edubin' )
                ),
                'sidebarnone' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'admin/assets/images/sidebar-none.png',
                    'name' => esc_html__( 'No Sidebar', 'edubin' )
                ),
                'sidebarright' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'admin/assets/images/sidebar-right.png',
                    'name' => esc_html__( 'Right Sidebar', 'edubin' )
                )
            )
        )
    ) );

    // Author
    $wp_customize->add_setting( 'blog_author_show',
        array(
            'default' => $this->defaults['blog_author_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_author_show',
        array(
            'label' => esc_html__( 'Author', 'edubin' ),
            'section' => 'blog_list_section'
        )
    ) );

    // Date
    $wp_customize->add_setting( 'blog_date_show',
        array(
            'default' => $this->defaults['blog_date_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_date_show',
        array(
            'label' => esc_html__( 'Post Date', 'edubin' ),
            'section' => 'blog_list_section'
        )
    ) );

    // Category
    $wp_customize->add_setting( 'blog_category_show',
        array(
            'default' => $this->defaults['blog_category_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_category_show',
        array(
            'label' => esc_html__( 'Category', 'edubin' ),
            'section' => 'blog_list_section'
        )
    ) );

    // Comment
    $wp_customize->add_setting( 'blog_comment_show',
        array(
            'default' => $this->defaults['blog_comment_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_comment_show',
        array(
            'label' => esc_html__( 'Comment', 'edubin' ),
            'section' => 'blog_list_section'
        )
    ) );
    // post view
    $wp_customize->add_setting( 'blog_view_show',
        array(
            'default' => $this->defaults['blog_view_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_view_show',
        array(
            'label' => esc_html__( 'Post view', 'edubin' ),
            'section' => 'blog_list_section'
        )
    ) );

    // Single page
    $wp_customize->add_section( 'blog_single_section',
        array(
            'title' => esc_html__( 'Single Page', 'edubin' ),
            'panel' => 'blog_panel'
        )
    );;
    
    // Blog single sidebar position 
    $wp_customize->add_setting( 'blog_single_sidebar',
        array(
            'default' => $this->defaults['blog_single_sidebar'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_radio_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Image_Radio_Button_Custom_Control( $wp_customize, 'blog_single_sidebar',
        array(
            'label' => esc_html__( 'Sidebar', 'edubin' ),
            'description' => esc_html__( 'Select your sidebar position', 'edubin' ),
            'section' => 'blog_single_section',
            'choices' => array(
                'sidebarleft' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'admin/assets/images/sidebar-left.png',
                    'name' => esc_html__( 'Left Sidebar', 'edubin' )
                ),
                'sidebarnone' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'admin/assets/images/sidebar-none.png',
                    'name' => esc_html__( 'No Sidebar', 'edubin' )
                ),
                'sidebarright' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'admin/assets/images/sidebar-right.png',
                    'name' => esc_html__( 'Right Sidebar', 'edubin' )
                )
            )
        )
    ) );
    // Author
    $wp_customize->add_setting( 'blog_single_author_show',
        array(
            'default' => $this->defaults['blog_single_author_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_single_author_show',
        array(
            'label' => esc_html__( 'Author', 'edubin' ),
            'section' => 'blog_single_section'
        )
    ) );

    // Date
    $wp_customize->add_setting( 'blog_single_date_show',
        array(
            'default' => $this->defaults['blog_single_date_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_single_date_show',
        array(
            'label' => esc_html__( 'Post Date', 'edubin' ),
            'section' => 'blog_single_section'
        )
    ) );

    // Category
    $wp_customize->add_setting( 'blog_single_category_show',
        array(
            'default' => $this->defaults['blog_single_category_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_single_category_show',
        array(
            'label' => esc_html__( 'Category', 'edubin' ),
            'section' => 'blog_single_section'
        )
    ) );

    // Comment
    $wp_customize->add_setting( 'blog_single_comment_show',
        array(
            'default' => $this->defaults['blog_single_comment_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_single_comment_show',
        array(
            'label' => esc_html__( 'Comment', 'edubin' ),
            'section' => 'blog_single_section'
        )
    ) );
    // post view
    $wp_customize->add_setting( 'blog_single_view_show',
        array(
            'default' => $this->defaults['blog_single_view_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_single_view_show',
        array(
            'label' => esc_html__( 'Post view', 'edubin' ),
            'section' => 'blog_single_section'
        )
    ) );
    // Tags view
    $wp_customize->add_setting( 'blog_single_tags_show',
        array(
            'default' => $this->defaults['blog_single_tags_show'],
            'transport' => 'refresh',
            'sanitize_callback' => 'edubin_switch_sanitization'
        )
    );
    $wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'blog_single_tags_show',
        array(
            'label' => esc_html__( 'Tags view', 'edubin' ),
            'section' => 'blog_single_section'
        )
    ) );