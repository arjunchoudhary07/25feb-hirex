<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Edubin_Elementor_Widget_LP_Course_Carousel extends Widget_Base {

    public function get_name() {
        return 'edubin-lpcourse-addons';
    }
    
    public function get_title() {
        return __( 'Courses (LearnPress)', 'edubin-core' );
    }
    public function get_keywords() {
        return [ 'LearnPress', 'learnpress course', 'courses', 'learnpress lms'];
    }
    public function get_icon() {
        return 'edubin-icon eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    public function get_script_depends() {
        return [
            // 'slick',
            'edubin-widgets-scripts',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'learnpress_courses',
            [
                'label' => __( 'Courses', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'course_style',
            [
                'label' => __( 'Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'edubin-core' ),
                    '2'   => __( 'Style 2', 'edubin-core' ),
                    '3'   => __( 'Style 3', 'edubin-core' ),
                    '4'   => __( 'Style 4', 'edubin-core' ),
                    '5'   => __( 'Style 5', 'edubin-core' ),
                ],
            ]
        );
        $this->add_control(
            'posts_column',
            [
                'label' => __('Items Column', 'edubin-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '2' => __('6 Column', 'edubin-core'),
                    '3' => __('4 Column', 'edubin-core'),
                    '4' => __('3 Column', 'edubin-core'),
                    '6' => __('2 Column', 'edubin-core'),
                    '12' => __('1 Column', 'edubin-core'),
                ],
                'condition'=>[
                    'carousel_on_off!'=> 'yes',
                ]
            ]
        );

        $this->add_control(
            'carusel_items_column',
            [
                'label' => esc_html__( 'Items Column', 'edubin-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 3,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'post_limit',
            [
                'label' => __('Number of Course', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );
        $this->add_control(
            'learnpress_courses_categories',
            [
                'label' => __('Select Category', 'edubin-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => edubin_learpress_get_taxonomies(),
                'multiple' => true,
            ]
        );
        $this->add_control(
            'custom_order',
            [
                'label' => esc_html__( 'Custom Order', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'postorder',
            [
                'label' => esc_html__( 'Order', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => esc_html__('Descending','edubin-core'),
                    'ASC'   => esc_html__('Ascending','edubin-core'),
                ],
                'condition' => [
                    'custom_order!' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Orderby', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'none'          => esc_html__('None','edubin-core'),
                    'ID'            => esc_html__('ID','edubin-core'),
                    'date'          => esc_html__('Date','edubin-core'),
                    'name'          => esc_html__('Name','edubin-core'),
                    'title'         => esc_html__('Title','edubin-core'),
                    'comment_count' => esc_html__('Comment count','edubin-core'),
                    'rand'          => esc_html__('Random','edubin-core'),
                ],
                'condition' => [
                    'custom_order' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'carousel_on_off',
            [
                'label' => esc_html__( 'Carousel', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
                'separator'=>'before',
            ]
        );
        $this->add_control(
            'title_length',
            [
                'label' => __( 'Title Length', 'edubin-core' ),
                'type' => Controls_Manager::NUMBER,
                'step' => 1,
                'default' => 15,
                'separator'=>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'large',
                'separator' => 'none',
            ]
        );
        $this->add_responsive_control(
            'lp_image_height',
            [
                'label' => __( 'Image Height', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 300,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course-1 .thum .image img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-single-course-2 .image img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-course .course-thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Carousel setting
        $this->start_controls_section(
            'carousel_option',
            [
                'label' => esc_html__( 'Carousel Option', 'edubin-core' ),
                 'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'slarrows',
            [
                'label' => esc_html__( 'Nav Arrow', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                 'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'nav_arrow_style',
            [
                'label' => __( 'Nav Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'edubin-core' ),
                    '2'   => __( 'Style 2', 'edubin-core' ),
                ],
                'condition' => [
                     'slarrows'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'slprevicon',
            [
                'label' => __( 'Previous icon', 'edubin-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'flaticon-back',
                'condition' => [
                    'slarrows' => 'yes',
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'slnexticon',
            [
                'label' => __( 'Next icon', 'edubin-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'flaticon-next',
                'condition' => [
                    'slarrows' => 'yes',
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'sldots',
            [
                'label' => esc_html__( 'Dots', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
                 'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'slpause_on_hover',
            [
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'edubin-core'),
                'label_on' => __('Yes', 'edubin-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'label' => __('Pause on Hover?', 'edubin-core'),
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'slautolay',
            [
                'label' => esc_html__( 'Auto play', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator' => 'before',
                'default' => 'no',
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'slautoplay_speed',
            [
                'label' => __('Autoplay speed', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );


        $this->add_control(
            'slanimation_speed',
            [
                'label' => __('Autoplay animation speed', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'slscroll_columns',
            [
                'label' => __('Slider item to scroll', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 1,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'heading_tablet',
            [
                'label' => __( 'Tablet', 'edubin-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'sltablet_display_columns',
            [
                'label' => __('Slider Items', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 8,
                'step' => 1,
                'default' => 1,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'sltablet_scroll_columns',
            [
                'label' => __('Slider item to scroll', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 8,
                'step' => 1,
                'default' => 1,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'sltablet_width',
            [
                'label' => __('Tablet Resolution', 'edubin-core'),
                'description' => __('The resolution to tablet.', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 769,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'heading_mobile',
            [
                'label' => __( 'Mobile Phone', 'edubin-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'slmobile_display_columns',
            [
                'label' => __('Slider Items', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 4,
                'step' => 1,
                'default' => 1,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'slmobile_scroll_columns',
            [
                'label' => __('Slider item to scroll', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 4,
                'step' => 1,
                'default' => 1,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'slmobile_width',
            [
                'label' => __('Mobile Resolution', 'edubin-core'),
                'description' => __('The resolution to mobile.', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 480,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->end_controls_section(); // Option end

        $this->start_controls_section(
            'course_meta_option',
            [
                'label' => __( 'Meta', 'edubin-core' ),
            ]
        );
        $this->add_control(
            'show_price',
            [
                'label' => esc_html__( 'Price', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );   
        $this->add_control(
            'show_full_price',
            [
                'label' => esc_html__( 'Show Price .00', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'course_style' => '1',
                ]
            ]
        );     
        $this->add_control(
            'show_review',
            [
                'label' => esc_html__( 'Review', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_review_text',
            [
                'label' => esc_html__( 'Review Text', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_instructor_img',
            [
                'label' => esc_html__( 'Instructor Image', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );        
        $this->add_control(
            'show_instructor_name',
            [
                'label' => esc_html__( 'Instructor Name', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_enroll',
            [
                'label' => esc_html__( 'Enroll', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'course_style!' => '4',
                ]
            ]
        );
        $this->add_control(
            'show_cat',
            [
                'label' => esc_html__( 'Category', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'course_style!' => '4',
                ]
            ]
        );
        $this->add_control(
            'show_lesson',
            [
                'label' => esc_html__( 'Lesson', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'course_style!' => '4',
                ]
            ]
        );
        $this->add_control(
            'show_quiz',
            [
                'label' => esc_html__( 'Quiz', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'course_style!' => '4',
                ]
            ]
        );
        $this->add_control(
            'show_comments',
            [
                'label' => esc_html__( 'Comments', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'course_style!' => '4',
                ]
            ]
        );

        $this->end_controls_section(); // Option End


        // Pagination 
        $this->start_controls_section(
        'pagination_section',
            [
                'label' => __( 'Pagination', 'edubin-core' ),
            ]
        );

        $this->add_control(
        'pagi_on_off',
            [
                'label' => esc_html__( 'Pagination', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        ); 
        $this->add_responsive_control(
        'pagi_align',
            [
                'label'         => esc_html__( 'Alignment', 'edubin-core' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title'=> esc_html__( 'Left', 'edubin-core' ),
                        'icon' => 'fa fa-align-left',
                        ],
                    'center'    => [
                        'title'=> esc_html__( 'Center', 'edubin-core' ),
                        'icon' => 'fa fa-align-center',
                        ],
                    'right'     => [
                        'title'=> esc_html__( 'Right', 'edubin-core' ),
                        'icon' => 'fa fa-align-right',
                        ],
                    ],
                'toggle'        => false,
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} nav.navigation.pagination' => 'text-align: {{VALUE}};',
                    ],
            ]
        );
        $this->add_control(
            'pagi_end_size',
            [
                'label' => __('End Size', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2,
            ]
        );  
        $this->add_control(
        'pagi_mid_size',
            [
                'label' => __('Mid Size', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
            ]
        );  

        $this->add_control(
        'pagi_show_all',
            [   
                'label' => esc_html__( 'Show All', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'edubin-core'),
                'label_on' => __('Yes', 'edubin-core'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->end_controls_section();


        // Style Title tab section
        $this->start_controls_section(
            'lp_course_title_style_section',
            [
                'label' => __( 'Title', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_review'=>'yes',
                ]
            ]
        );
            
            $this->start_controls_tabs('title_style_tabs');

                $this->start_controls_tab(
                    'title_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );

                    $this->add_control(
                        'title_color',
                        [
                            'label' => __( 'Color', 'edubin-core' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'',
                            'selectors' => [
                                '{{WRAPPER}} .edubin-single-course-1 .course-content .course-title a' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .edubin-single-course-2 .content .course-title a' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .edubin-course .course-title' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .edubin-course .course__title a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography',
                            'label' => __( 'Typography', 'edubin-core' ),
                            'global' => [
                                'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                            ],
                            'selector' => '{{WRAPPER}} .edubin-single-course-1 .course-content .course-title a, .edubin-single-course-2 .content .course-title a, .edubin-course .course-title, .edubin-course .course__title a',
                        ]
                    );

                    $this->add_responsive_control(
                        'title_padding',
                        [
                            'label' => __( 'Padding', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .edubin-single-course-1 .course-content .course-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .edubin-single-course-2 .content .course-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .edubin-course .course-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'title_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'edubin-core' ),
                    ]
                );
                $this->add_control(
                    'title_hover_color',
                    [
                        'label' => __( 'Color', 'edubin-core' ),
                        'type' => Controls_Manager::COLOR,
                        'default'=>'',
                        'selectors' => [
                            '{{WRAPPER}} .edubin-single-course-1 .course-content .course-title a:hover' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .edubin-single-course-2 .content .course-title:hover a' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .edubin-course .course-title:hover' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .edubin-course .course__title a:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Meta tab section
        $this->start_controls_section(
            'post_meta_style_section',
            [
                'label' => __( 'Meta', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'meta_color',
            [
                'label' => __( 'Icon Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course-1 .course-bottom .admin ul li i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-course .course__content--meta span i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'course_style!' => '4',
                ]
            ]
        );

        $this->add_control(
            'meta_text_color',
            [
                'label' => __( 'Meta Text Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course-1 .course-bottom .admin ul li span.enroll-users' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-1 .course-bottom .admin ul li a span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'course_style!' => '4',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'label' => __( 'Instructor Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .edubin-single-course-1 .course-bottom .name .ins-name a, .edubin-single-course-2>.thum .course-teacher .name h6 a, .edubin-course .course-info .course-instructor a',
            ]
        );
        $this->add_control(
            'author_color',
            [
                'label' => __( 'Instructor Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course-1 .course-bottom .name .ins-name a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-2>.thum .course-teacher .name h6 a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-course .course-info .course-instructor a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => __( 'Price Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-single-course-1 .thum .edubin-course-price-1 span, .edubin-single-course-1 .thum .edubin-course-price-2 span, .edubin-single-course-1 .thum .edubin-course-price-3 span, .edubin-single-course-2 > .thum .edubin-course-price-4 span, .edubin-course .course__content--meta .price',
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course-1 .thum .edubin-course-price-1 span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-1 .thum .edubin-course-price-2 span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-1 .thum .edubin-course-price-3 span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-2 > .thum .edubin-course-price-4 span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-course .course__content--meta .price' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'price_bg_color',
            [
                'label' => __( 'Price Background', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course-1 .thum .edubin-course-price-1 span' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-1 .thum .edubin-course-price-2 span' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-1 .thum .edubin-course-price-3 span' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-2 > .thum .edubin-course-price-4 span' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_bg_size',
            [
                'label' => __( 'Price Background Size', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'after',
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course-1 .thum .edubin-course-price-1 span, .edubin-single-course-2>.thum .edubin-course-price-4 span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'review_typography',
                'label' => __( 'Review Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-single-course-1 .course-content span.course-reviews',
            ]
        );
        $this->add_control(
            'review_color',
            [
                'label' => __( 'Review Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course-1 .star-rating span:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course .star-rating:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-2 .star-rating:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-2 .star-rating span:before' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();


        // Style Slider arrow style start
        $this->start_controls_section(
            'lp_course_arrow_style',
            [
                'label'     => __( 'Arrow', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'slarrows'  => 'yes',
                    'carousel_on_off'=>'yes',
                ],

            ]
        );
        
            $this->start_controls_tabs( 'lp_course_arrow_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'lp_course_arrow_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );

                    $this->add_control(
                        'arrow_color',
                        [
                            'label' => __( 'Icon Color', 'edubin-core' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .edubin-lp-courses-addons.edubin-nav-button-2 .edubin-carousel-activation button.slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'arrow_position',
                        [
                            'label' => __( 'Position', 'edubin-core' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                    'step' => 1,
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .edubin-lp-courses-addons.edubin-nav-button-1 .edubin-carousel-activation button.slick-arrow' => 'top: -{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'arrow_bg_color',
                        [
                            'label' => __( 'Background', 'edubin-core' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'course_arrow_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'course_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'lp_course_arrow_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'edubin-core' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label' => __( 'Color', 'edubin-core' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'slider_arrow_hover_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'slider_arrow_hover_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style arrow style end

        // Style Dot section
        $this->start_controls_section(
            'course_dot_style_section',
            [
                'label' => __( 'Dot', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                 'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'dot_color',
            [
                'label' => __( 'Dot Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-activation .slick-dots li button' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-carousel-activation .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dot_size',
            [
                'label' => __( 'Dot Size', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-activation .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dot_position',
            [
                'label' => __( 'Position', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-activation .slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_space_between',
            [
                'label' => __( 'Space Between', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-activation .slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Course body style
        $this->start_controls_section(
            'course_style_section',
            [
                'label' => __( 'Style', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'courses_align',
                [
                    'label' => __( 'Alignment', 'edubin-core' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'edubin-core' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'edubin-core' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'edubin-core' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'edubin-core' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-single-course-1' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-single-course-2' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-single-course-3' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-course' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );
            $this->start_controls_tabs('body_box_tabs');

                $this->start_controls_tab(
                    'body_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'box_shadow',
                        'selector' => '{{WRAPPER}} .edubin-single-course, .edubin-single-course-2, .edubin-course',
                    ]
                );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'body_box_hover_tab',
                    [
                        'label' => __( 'Hover', 'edubin-core' ),
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [   'label' => __( 'Box Shadow Hover', 'edubin-core' ),
                        'name' => 'box_shadow_hover',
                        'selector' => '{{WRAPPER}} .edubin-single-course:hover, .edubin-single-course-2:hover, .edubin-course:hover',
                    ]
                );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();
            
         $this->add_control(
            'course_bg_color',
            [
                'label' => __( 'Background', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course .course-content' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-2' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-single-course-1' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-course' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $custom_order_ck    = $this->get_settings_for_display('custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');

        // Course Column
        $this->add_render_attribute( 'edubin_posts_column', 'class', 'col-sm-'.$settings['slmobile_display_columns'].' col-md-'.$settings['sltablet_display_columns'].' col-lg-'.$settings['posts_column'] );

        // Button style
        $this->add_render_attribute( 'edubin_carousel_btn_style', [ 'id' => 'edubin-lp-courses-addons', 'class' => 'edubin-lp-courses-addons edubin-nav-button-'.$settings['nav_arrow_style'] ] );

        // Price style
        $this->add_render_attribute( 'edubin_price_style', 'class', 'edubin-course-price-'.$settings['course_style'] );

        // Carusel options
        $this->add_render_attribute( 'edubin_course_carousel_attr', 'class',  ($settings['carousel_on_off'] ? 'edubin-carousel-activation' : 'row') );

            $slider_settings = [
                'arrows' => ('yes' === $settings['slarrows']),
                'arrow_prev_txt' => $settings['slprevicon'],
                'arrow_next_txt' => $settings['slnexticon'],
                'dots' => ('yes' === $settings['sldots']),
                'autoplay' => ('yes' === $settings['slautolay']),
                'autoplay_speed' => absint($settings['slautoplay_speed']),
                'animation_speed' => absint($settings['slanimation_speed']),
                'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
            ];

            $slider_responsive_settings = [
                'display_columns' => $settings['carusel_items_column'],
                'scroll_columns' => $settings['slscroll_columns'],
                'tablet_width' => $settings['sltablet_width'],
                'tablet_display_columns' => $settings['sltablet_display_columns'],
                'tablet_scroll_columns' => $settings['sltablet_scroll_columns'],
                'mobile_width' => $settings['slmobile_width'],
                'mobile_display_columns' => $settings['slmobile_display_columns'],
                'mobile_scroll_columns' => $settings['slmobile_scroll_columns'],

            ];

            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );

            $this->add_render_attribute( 'edubin_course_carousel_attr', 'data-settings', wp_json_encode( $slider_settings ) );
       
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        // Query
        $args = array(
            'post_type'             => 'lp_course',
            'post_status'           => 'publish',
            'paged'                 => $paged,
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 3,
            'order'                 => $postorder
        );

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }
        if( !empty($settings['learnpress_courses_categories']) ){
            $get_categories = $settings['learnpress_courses_categories'];
        }else{
           $get_categories = $settings['learnpress_courses_categories'];
        }

            $carousel_cats = str_replace(' ', '', $get_categories);

            if (  !empty( $get_categories ) ) {
                if( is_array($carousel_cats) && count($carousel_cats) > 0 ){
                    $field_name = is_numeric( $carousel_cats[0] ) ? 'term_id' : 'slug';
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'course_category',
                            'terms' => $carousel_cats,
                            'field' => $field_name,
                            'include_children' => false
                        )
                );
             }
        }

        $carousel_post = new \WP_Query( $args );
       
        ?>
    <div class="edubin-lp-course-wrapper-<?php echo esc_attr($settings['course_style']); ?>">
            <div <?php echo $this->get_render_attribute_string( 'edubin_carousel_btn_style' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'edubin_course_carousel_attr' ); ?>>
                    
                    <?php
                        if( $carousel_post->have_posts() ):
                        while( $carousel_post->have_posts() ): $carousel_post->the_post();

                            $course    = learn_press_get_course();
                            $course_id = get_the_ID();
                            $count =  (int)learn_press_get_course()->count_students();
                        ?>
              

                    <?php if(!$settings['carousel_on_off'] == 'yes' ): ?>
                        <div <?php echo $this->get_render_attribute_string( 'edubin_posts_column' ); ?> >
                    <?php endif; ?>

                    <?php if ($settings['course_style'] == '1' || $settings['course_style'] == '2' || $settings['course_style'] == '3') : ?>

                        <div <?php echo $this->get_render_attribute_string( 'edubin_post_slider_item_attr' ); ?> >
                            <div class="edubin-single-course-1 mb-30">
                                <div class="thum">
                                    <?php if ( has_post_thumbnail() ):?>
                                        <figure class="image">
                                            <a href="<?php the_permalink(); ?>">
                                                 <?php the_post_thumbnail($settings['image_size']);?>
                                            </a>

                                <?php if ( $settings['show_cat'] == 'yes' ): ?>
                                    <div class="course__categories ">
                                      <?php echo get_the_term_list(get_the_ID(), 'course_category'); ?>
                                    </div>
                               <?php endif; ?>

                                        </figure>
                                    <?php else : ?>
                                    <?php $placholder_img = plugins_url('/edubin-core/assets/img/course-ph.png'); ?>
                                        <figure class="image">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                                            </a>
                                            
                                <?php if ( $settings['show_cat'] == 'yes' ): ?>
                                    <div class="course__categories ">
                                      <?php echo get_the_term_list(get_the_ID(), 'course_category'); ?>
                                    </div>
                               <?php endif; ?>

                                        </figure>
                                    <?php endif; ?>
                                    <?php if($settings['show_price'] == 'yes') : ?>
                                        
                                        <div <?php echo $this->get_render_attribute_string( 'edubin_price_style' ); ?>>
                                            <?php if ( $price_html = $course->get_price_html() ) : ?>

                                                <?php if ($settings['course_style'] == 2 || $settings['course_style'] == 3) : ?>
                                                    <?php $origin_price_html = $course->get_origin_price_html(); ?>
                                                 <span>
                                                      <?php if ($origin_price_html !== $price_html) : ?>
                                                    <?php echo '<del>' . $origin_price_html . '</del>'; ?>
                                                        <?php if($origin_price_html) : echo '/'; endif; ?>
                                                     <?php endif; ?> 

                                                     <?php echo $price_html; ?>
                                                 </span>

                                                <?php else : ?>

                                                    <?php if ($settings['show_full_price']) : ?>
                                                        <span><?php echo $price_html; ?></span>
                                                    <?php else : ?>
                                                        <span><?php $new_price = preg_replace('/.00/', '', $price_html); echo $new_price; ?></span>
                                                    <?php endif; ?> 

                                                <?php endif; ?> 

                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="course-content">

                                    <?php if (class_exists('LP_Addon_Course_Review_Preload') & $settings['show_review'] == 'yes'): ?>
                                    <div class="edubin-course-rate">
                                         <?php  
                                            $course_id       = get_the_ID();
                                            $course_rate_res = learn_press_get_course_rate( $course_id, false );
                                            $course_rate     = $course_rate_res['rated'];
                                            $total           = $course_rate_res['total'];

                                            learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) ); 

                                            $total_text = ('1' == $total) ? esc_html__('Review', 'edubin-core') : esc_html__('reviews', 'edubin-core');

                                            ?>

                                          <?php if ($settings['show_review_text'] == 'yes') :?>
                                              <span class="course-reviews">
                                                <?php echo esc_attr('(') ?>
                                                <?php echo esc_html($total); ?> 
                                                <?php echo esc_html($total_text); ?>
                                                <?php echo esc_attr(')') ?>
                                              </span>
                                          <?php endif; ?><!--  End review text-->
                                    </div>
                                    <?php endif; ?><!--  End review -->

                                     <h4 class="course-title"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a></h4>

                                    <?php if($settings['show_instructor_img'] == 'yes' || $settings['show_instructor_name'] || $settings['show_enroll'] == 'yes' || $settings['show_comments'] == 'yes') : ?>
                                    <div class="course-bottom">
                                    <?php if($settings['show_instructor_img'] == 'yes') : ?>
                                        <div class="thum">
                                             <a href="<?php echo esc_url( learn_press_user_profile_link( get_the_author_meta( 'ID' ) ) ); ?>" class="instructor-img">
                                                <?php echo $course->get_instructor()->get_profile_picture(); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?><!--  End instructor image -->

                                    <?php if($settings['show_instructor_name'] == 'yes') : ?>
                                        <div class="name">
                                           <h6 class="ins-name"><?php echo $course->get_instructor_html(); ?></h6>
                                        </div>
                                    <?php endif; ?><!--  End instructor name -->

                                        <div class="admin">
                                            <ul>
                                               <?php if($settings['show_enroll'] == 'yes') : ?>
                                                <li><i class="flaticon-user-4"></i><span class="enroll-users"><?php echo esc_html( $count ); ?></span></li>
                                                <?php endif; ?><!--  End enroll -->
                                                <?php if($settings['show_comments'] == 'yes') : ?>
                                                <li><a href="<?php the_permalink();?>"><i class="flaticon-chat-1"></i><span><?php echo get_comments_number(); ?></span></a></li>
                                                 <?php endif; ?><!--  End comments -->
                                            </ul>
                                        </div>
                                    </div>
                                    <?php endif; ?><!--  End course bottom -->
                                </div>
                            </div> <!-- single course -->
                        </div>

                    <?php elseif ($settings['course_style'] == '4') : ?>

                        <div <?php echo $this->get_render_attribute_string( 'edubin_post_slider_item_attr' ); ?> >
                            <div class="edubin-single-course-2">
                                <div class="thum">
                                    <?php if ( has_post_thumbnail() ):?>
                                        <figure class="image">
                                            <a href="<?php the_permalink(); ?>">
                                                  <?php the_post_thumbnail($settings['image_size']);?>
                                            </a>
                                        </figure>

                                    <?php else : ?>
                                        
                                    <?php $placholder_img = plugins_url('/edubin-core/assets/img/course-ph.png'); ?>
                                        <figure class="image">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url($placholder_img); ?>" alt="placeholder">
                                            </a>
                                        </figure>
                                    <?php endif; ?>

                                    <?php if($settings['show_price'] == 'yes') : ?>
                                        
                                            <div <?php echo $this->get_render_attribute_string( 'edubin_price_style' ); ?>>
                                            <?php if ( $price_html = $course->get_price_html() ) : ?>

                                                <?php if ($settings['course_style'] == 2 || $settings['course_style'] == 3) : ?>
                                                    <?php $origin_price_html = $course->get_origin_price_html(); ?>
                                                 <span>
                                                    <?php echo '<del>' . $origin_price_html . '</del>'; ?>
                                                     <?php if($origin_price_html) : echo '/'; endif; ?>
                                                     <?php echo $price_html; ?>
                                                 </span>
                                                <?php else : ?>
                                                    <span><?php $new_price = preg_replace('/.00/', '', $price_html); echo $new_price; ?></span>
                                                <?php endif; ?> 

                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="course-teacher">

                                        <?php if( $settings['show_instructor_img'] == 'yes') : ?>
                                            <div class="thum">
                                                 <a href="<?php echo esc_url( learn_press_user_profile_link( get_the_author_meta( 'ID' ) ) ); ?>" class="instructor-img">
                                                    <?php echo $course->get_instructor()->get_profile_picture(); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?><!--  End instructor image -->

                                        <?php if($settings['show_instructor_name'] == 'yes') : ?>
                                            <div class="name">
                                               <h6 class="ins-name"><?php echo $course->get_instructor_html(); ?></h6>
                                            </div>
                                        <?php endif; ?><!--  End instructor name -->

                                        <?php if (class_exists('LP_Addon_Course_Review_Preload') & $settings['show_review'] == 'yes'): ?>
                                        <div class="edubin-course-rate">
                                             <?php  
                                                $course_id       = get_the_ID();
                                                $course_rate_res = learn_press_get_course_rate( $course_id, false );
                                                $course_rate     = $course_rate_res['rated'];
                                                $total           = $course_rate_res['total'];

                                                learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) ); 

                                                $total_text = ('1' == $total) ? esc_html__('Review', 'edubin-core') : esc_html__('reviews', 'edubin-core');

                                                ?>

                                              <?php if ($settings['show_review_text'] == 'yes') :?>
                                                  <span class="course-reviews">
                                                    <?php echo esc_attr('(') ?>
                                                    <?php echo esc_html($total); ?> 
                                                    <?php echo esc_html($total_text); ?>
                                                    <?php echo esc_attr(')') ?>
                                                  </span>
                                              <?php endif; ?><!--  End review text-->
                                        </div>
                                        <?php endif; ?><!--  End review -->
                                    </div>
                                </div>
                                <div class="content">
                                  <h4 class="course-title"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a></h4>
                                </div>
                            </div> <!-- single course -->
                        </div>

                    <?php elseif ($settings['course_style'] == '5') : ?>
                      <div class="edubin-course">
                        <div class="course__container">

                          <?php if ( has_post_thumbnail() ):?>
                            <div class="course__media">

                                <a class="course__media-link" href="<?php the_permalink(); ?>">
                                 <?php the_post_thumbnail($settings['image_size']);?>
                                </a>
                               <?php if ( $settings['show_cat'] == 'yes' ): ?>
                                <div class="course__categories ">
                                  <?php echo get_the_term_list(get_the_ID(), 'course_category'); ?>
                                </div>
                               <?php endif; ?>
                            </div>
                          <?php endif; ?>


                          <div class="course__content">
                            <div class="course__content--info">

                              <h4 class="course__title">
                                <a href="<?php the_permalink(); ?>" class="course__title-link">
                                  <?php the_title(); ?>
                                </a>
                              </h4>

                              <?php if ($settings['show_instructor_img'] == 'yes' || $settings['show_instructor_name'] == 'yes' ): ?>
                                    <div class="author__name">
                                      <?php if ( $settings['show_instructor_img'] == 'yes' ): ?>
                                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                                      <?php endif; ?>

                                    <?php if ( $settings['show_instructor_name'] ): ?>
                                        <?php the_author() ?>
                                     <?php endif; ?>
                                    </div>
                              <?php endif; ?>

                           
                            </div>
                            <div class="course__content--meta"> 
                                <?php if ( $settings['show_enroll'] ):       
                                  $students = (int)learn_press_get_course()->count_students();?>
                                  <span class="course-enroll"><i class="flaticon-user-4"></i> <?php echo $students; ?></span>
                                 <?php endif; ?>

                          <?php if ( $settings['show_lesson'] ):       
                                  $course = \LP_Global::course();
                                  $lessons = $course->get_items('lp_lesson', false) ? count($course->get_items('lp_lesson', false)) : 0;
                                  printf('<span class="course-lessons"><i class="flaticon-book-1"></i> %s </span>', $lessons);
                           endif; ?>


                          <?php if ( $settings['show_quiz'] ):       
                                  $course = \LP_Global::course();
                                  $lessons = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
                                  printf('<span class="course-lessons"><i class="flaticon-question"></i> %s </span>', $lessons);
                           endif; ?>

                                
                          <?php if ( $settings['show_price'] ): ?>
                            <div class="price">
                              <?php get_template_part('learnpress/edubin_price'); ?>
                              </div>
                            <?php endif ?>
                            </div>
                          </div>

                        </div>
                      </div>
                    <?php endif; ?>

            <?php if(!$settings['carousel_on_off'] == 'yes' ): ?>
                </div>
            <?php endif; ?>

            <?php endwhile; wp_reset_postdata(); wp_reset_query(); 

                if ($settings['pagi_on_off']) : ?>

                    <nav class="navigation pagination" role="navigation" aria-label="Posts">
                        <div class="nav-links">
                            <?php 
                                echo paginate_links( array(
                                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                    'total'        => $carousel_post->max_num_pages,
                                    'current'      => max( 1, get_query_var( 'paged' ) ),
                                    'format'       => '?paged=%#%',
                                    'show_all'     => $settings['pagi_show_all'],
                                    'type'         => 'plain',
                                    'end_size'     => $settings['pagi_end_size'],
                                    'mid_size'     => $settings['pagi_mid_size'],
                                    'prev_next'    => true,
                                    'prev_text' => '<i class="flaticon-back" aria-hidden="true"></i>',
                                    'next_text' => '<i class="flaticon-next" aria-hidden="true"></i>',
                                    'add_args'     => false,
                                    'add_fragment' => '',
                                ) );
                            ?>
                        </div> <!-- row -->  
                    </nav>
                <?php endif; //end pagination ?>

        <?php endif; ?>

            </div>
        </div>
    </div>

<?php

    }

}

