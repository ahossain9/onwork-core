<?php
/**
 * onwork_core ccourse search widget for elementor
 * @package Onwork_Core
 * @since 1.0.0
 */
namespace Onwork_Core\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Course_Search extends Widget_Base {

    public function get_name() {
        return 'onwork-course-search';
    }

    public function get_title() {
        return esc_html__( 'Courses Search', 'onwork-core' );
    }

    public function get_icon() {
        return 'onwork-core-icon eicon-search-results';
    }

    public function get_categories() {
        return [ 'onwork_core' ];
    }

    public function get_keywords() {
        return [ 
            'search',
            'course search',
            'courses search',
            'onwork',
        ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'course_sec_settings',
            [
                'label' => esc_html__( 'Placeholder', 'onwork-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'pleceholder_text',
            [
                'label' => esc_html__( 'Placeholder Text', 'onwork-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Course Search...',
                'placeholder' => esc_html__( 'Placeholder Text', 'onwork-core' ),
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __( 'Input Box', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'course_search_input_padding',
            [
                'label' => esc_html__( 'Padding', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .course-search form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_search_input_height',
            [
                'label' => __( 'Height', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .course-search form input' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'course_search_input_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-search form input' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_search_input_color',
            [
                'label' => esc_html__( 'Text Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-search form input' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_search_placeholder_color',
            [
                'label' => esc_html__( 'Placeholder Text Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-search ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .course-search ::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .course-search ::-ms-input-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_search_input_typography',
                'label' => __( 'Typography', 'onwork-core' ),
                'selector' => '{{WRAPPER}} .course-search form input',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'course_search_input_box_shadow',
                'exclude' => [
                    'input_box_shadow',
                ],
                'selector' => '{{WRAPPER}} .course-search form',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'course_search_submit_btn',
            [
                'label' => __( 'Submit Button', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'course_search_btn_margin',
            [
                'label' => esc_html__( 'Margin', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .course-search form button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_search_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .course-search form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_search_btn_height',
            [
                'label' => __( 'Height', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .course-search form button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_search_btn_font_size',
            [
                'label' => __( 'Font Size', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .course-search form button' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'course_search_color_tabs'
        );
            $this->start_controls_tab(
                'course_search_color_normal_tab',
                [
                    'label' => __( 'Normal', 'onwork-core' )
                ]
            );

            $this->add_control(
                'course_search_btn_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-search form button' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'course_search_btn_icon_color',
                [
                    'label' => esc_html__( 'Icon Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-search form button i:before' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'course_search_color_hover_tab',
                [
                    'label' => __( 'Hover', 'onwork-core' ),
                ]
            );

            $this->add_control(
                'search_btn_hover_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-search form button:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'search_btn_icon_hover_color',
                [
                    'label' => esc_html__( 'Icon Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-search form button:hover i:before' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();        
        ?>
        <div class="course-search-wrap">   
            <div class="course-search">
                <form method="get" action="<?php echo esc_url( get_post_type_archive_link( 'courses' ) ); ?>">
                <input type="hidden" name="ref" value="course">
                    <input type="text" value="<?php echo esc_attr( get_search_query() );?>" name="s" placeholder="<?php echo esc_html($settings['pleceholder_text']);?>" class="form-control" />
                    <button type="submit"><i class="fas fa-search"></i></button>      
                </form>
            </div>
        </div>
    <?php }
}
