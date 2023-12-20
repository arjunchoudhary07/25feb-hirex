<?php

// The event calender archive page
$wp_customize->add_section('edubin_tribe_events_archive_page',
    array(
        'title' => esc_html__('Archive Page', 'edubin'),
        'panel' => 'edubin_tribe_customizer_panel',
    )
);
// price 
$wp_customize->add_setting( 'tbe_price',
    array(
        'default' => $this->defaults['tbe_price'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_price',
    array(
        'label' => esc_html__( 'Price', 'edubin' ),
        'section' => 'edubin_tribe_events_archive_page'
    )
) ); 

// Archive word hidden 
$wp_customize->add_setting( 'tbe_archive_word_hide',
    array(
        'default' => $this->defaults['tbe_archive_word_hide'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_archive_word_hide',
    array(
        'label' => esc_html__( 'Hide Archive: Word', 'edubin' ),
        'section' => 'edubin_tribe_events_archive_page'
    )
) ); 

// Meta 
$wp_customize->add_setting( 'tbe_archive_meta',
    array(
        'default' => $this->defaults['tbe_archive_meta'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_archive_meta',
    array(
        'label' => esc_html__( 'Meta', 'edubin' ),
        'section' => 'edubin_tribe_events_archive_page'
    )
) ); 

// ===== The event calender single page =====
$wp_customize->add_section('edubin_tribe_events_single_page',
    array(
        'title' => esc_html__('Single Page', 'edubin'),
        'panel' => 'edubin_tribe_customizer_panel',
    )
);

// Layout
$wp_customize->add_setting( 'edubin_tribe_events_layout',
    array(
        'default' => $this->defaults['edubin_tribe_events_layout'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_radio_sanitization'
    )
);
$wp_customize->add_control( 'edubin_tribe_events_layout',
    array(
        'label' => esc_html__( 'Page Layout', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page',
        'type' => 'select',
        'choices' => array(
            'default' => esc_html__( 'Default', 'edubin' ),
            'layout_1' => esc_html__( 'Layout 1', 'edubin' ),
            'layout_2' => esc_html__( 'Layout 2', 'edubin' ),
        )
    )
);
// Countdown 
$wp_customize->add_setting( 'tbe_event_countdown',
    array(
        'default' => $this->defaults['tbe_event_countdown'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_event_countdown',
    array(
        'label' => esc_html__( 'Countdown', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 
// Maps 
$wp_customize->add_setting( 'tbe_event_maps',
    array(
        'default' => $this->defaults['tbe_event_maps'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_event_maps',
    array(
        'label' => esc_html__( 'Maps', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 
// event_date 
$wp_customize->add_setting( 'tbe_event_cost',
    array(
        'default' => $this->defaults['tbe_event_cost'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_event_cost',
    array(
        'label' => esc_html__( 'Event Cost', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 

// start_time 
$wp_customize->add_setting( 'tbe_start_time',
    array(
        'default' => $this->defaults['tbe_start_time'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_start_time',
    array(
        'label' => esc_html__( 'Start Time', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 
// end_time 
$wp_customize->add_setting( 'tbe_end_time',
    array(
        'default' => $this->defaults['tbe_end_time'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_end_time',
    array(
        'label' => esc_html__( 'End Time', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) );  
// website 
$wp_customize->add_setting( 'tbe_website',
    array(
        'default' => $this->defaults['tbe_website'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_website',
    array(
        'label' => esc_html__( 'Website', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 
// phone 
$wp_customize->add_setting( 'tbe_phone',
    array(
        'default' => $this->defaults['tbe_phone'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_phone',
    array(
        'label' => esc_html__( 'Phone', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 
// tbe_email 
$wp_customize->add_setting( 'tbe_email',
    array(
        'default' => $this->defaults['tbe_email'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_email',
    array(
        'label' => esc_html__( 'Email', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 
// tbe_organizer
$wp_customize->add_setting( 'tbe_organizer_ids',
    array(
        'default' => $this->defaults['tbe_organizer_ids'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_organizer_ids',
    array(
        'label' => esc_html__( 'Organizer', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 

// Location 
$wp_customize->add_setting( 'tbe_location',
    array(
        'default' => $this->defaults['tbe_location'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_location',
    array(
        'label' => esc_html__( 'Location', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 
// Content before massage 
$wp_customize->add_setting( 'tbe_content_before_massage',
    array(
        'default' => $this->defaults['tbe_content_before_massage'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_content_before_massage',
    array(
        'label' => esc_html__( 'Before Content', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 
// Content after massage 
$wp_customize->add_setting( 'tbe_content_after_massage',
    array(
        'default' => $this->defaults['tbe_content_after_massage'],
        'transport' => 'refresh',
        'sanitize_callback' => 'edubin_switch_sanitization'
    )
);
$wp_customize->add_control( new Edubin_Toggle_Switch_Custom_control( $wp_customize, 'tbe_content_after_massage',
    array(
        'label' => esc_html__( 'After Content', 'edubin' ),
        'section' => 'edubin_tribe_events_single_page'
    )
) ); 