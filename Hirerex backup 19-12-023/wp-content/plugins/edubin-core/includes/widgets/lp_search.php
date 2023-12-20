<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Edubin_Elementor_Widget_LP_Search extends Widget_Base {

    public function get_name() {
        return 'edubin-lp-search';
    }
    
    public function get_title() {
        return __( 'Course Search (LearnPress)', 'edubin-core' );
    }
   public function get_keywords() {
        return [ 'LearnPress', 'learnpress course', 'courses search', 'learnpress lms'];
    }
    public function get_icon() {
        return 'edubin-icon eicon-search';
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    public function get_script_depends() {
        return [''];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Content', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'btn_text',
            [
              'label' => __( 'Button Text', 'edubin-core' ),
              'type'  => Controls_Manager::TEXT,
              'default' => '',
              'label_block' => true,
          ]
      );

        $this->add_control(
            'placeholder',
            [
              'label' => __( 'Placeholder', 'edubin-core' ),
              'type'  => Controls_Manager::TEXT,
              'default' => 'What do you want to learn?',
              'label_block' => true,
          ]
      );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimoni',
            [
                'label' => __( 'Style', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'froms_height',
            [
                'label'  => __( 'Height', 'edubin-core' ),
                'type'   => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                ],
                'range'  => [
                    'px' => [
                        'min' => 42,
                        'max' => 120,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} form.lp-course-form-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'froms_submit_width',
            [
                'label'  => __( 'Submit Button Width', 'edubin-core' ),
                'type'   => Controls_Manager::SLIDER,
                'range'  => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper .lp-course-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'froms_border_radious',
            [
                'label'  => __( 'Border Radius', 'edubin-core' ),
                'type'   => Controls_Manager::SLIDER,
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-courses-searching' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label'     => __( 'Input Text', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper .lp-course-input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_border_color',
            [
                'label'     => __( 'Input Border', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper .lp-course-input' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label'     => __( 'Input Background', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper .lp-course-input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label'     => __( 'Submit Background', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper .lp-course-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover_color',
            [
                'label'     => __( 'Submit Background Hover', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper .lp-course-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_border_color',
            [
                'label'     => __( 'Submit Border', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper .lp-course-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'submit_typography',
                'label'    => __( 'Submit Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
                'selector' => '{{WRAPPER}} .lp-course-form-wrapper .lp-course-btn',
            ]
        );
        
        $this->add_control(
            'input_placholder_color',
            [
                'label'     => __( 'Placeholder', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper input::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_text_color',
            [
                'label'     => __( 'Submit Text', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper .lp-course-btn' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'btn_text_hover_color',
            [
                'label'     => __( 'Submit Text Hover', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-form-wrapper .lp-course-btn:hover' => 'color: {{VALUE}};',

                ],
            ]
        );
        $this->end_controls_section();

    } // End options

    protected function render( $instance = [] ) {
        
        $settings = $this->get_settings();
        ?>
        <div class="edubin-courses-searching">

            <form class="lp-course-form-wrapper" method="get" action="<?php echo esc_url( get_post_type_archive_link('lp_course') ); ?>">

                <input type="text" value="" name="s" placeholder="<?php echo $settings['placeholder']; ?>" class="lp-course-input" autocomplete="off" />
                <input type="hidden" value="course" name="ref" />
                <button class="lp-course-btn" type="submit"><?php if ($settings['btn_text']) : echo $settings['btn_text']; else : ?> <i class="fas fa-search"></i><?php endif; ?></button>
                <span class="widget-search-close"></span>

            </form>
        </div>

        <?php

    }

}

