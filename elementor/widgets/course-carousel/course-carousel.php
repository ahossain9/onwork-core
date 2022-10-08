<?php
/**
 * onwork_core course carousel widget for elementor
 * @package Onwork_Core
 * @since 1.0.0
 */
namespace Onwork_Core\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Course_Carousel extends Widget_Base {

    public function get_name() {
        return 'onwork-course-carousel';
    }
    
    public function get_title() {
        return __( 'Course Carousel', 'onwork-core' );
    }

    public function get_icon() {
        return 'onwork-core-icon eicon-slider-full-screen';
    }

    public function get_categories() {
        return [ 'onwork_core' ];
    }

    public function get_keywords() {
        return [ 
            'course',
            'courses',
            'course carousel',
            'courses carousel',
            'onwork',
        ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'section_query',
            [
                'label' => __( 'Query', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'course_category',
            [
                'label' => __( 'Categories', 'onwork-core' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->course_category(),
                'multiple' => true,
            ]
        );
        
        $this->add_control(
            'course_orderby',
            [
                'label' => __( 'Order By', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => __( 'Date', 'onwork-core' ),
                    'title' => __( 'Title', 'onwork-core' ),
                    'rand' => __( 'Random', 'onwork-core' )
                ],
                'default' => 'date',
            ]
        );
        
        $this->add_control(
            'course_order',
            [
                'label' => __( 'Order', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => __( 'Ascending', 'onwork-core' ),
                    'DESC' => __( 'Desending', 'onwork-core' )
                ],
                'default' => 'DESC',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_meta',
            [
                'label' => __( 'Meta', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'course_pricing_switcher',
                [
                    'label' => __( 'Price', 'onwork-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'onwork-core' ),
                    'label_off' => __( 'Hide', 'onwork-core' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
            $this->add_control(
                'course_rating_switcher',
                [
                    'label' => __( 'Rating', 'onwork-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'onwork-core' ),
                    'label_off' => __( 'Hide', 'onwork-core' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'course_difficulty_level',
                [
                    'label' => __( 'Difficulty Level', 'onwork-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'onwork-core' ),
                    'label_off' => __( 'Hide', 'onwork-core' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
            $this->add_control(
                'course_meta_switcher',
                [
                    'label' => __( 'Meta', 'onwork-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'onwork-core' ),
                    'label_off' => __( 'Hide', 'onwork-core' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
        $this->end_controls_section();

        // carousel setting
        $this->start_controls_section(
            'carousel_options',
            [
                'label' => esc_html__( 'Options', 'onwork-core' ),
            ]
        );
        $this->add_control(
            'carousel_items',
            [
                'label'   => esc_html__( 'Number of Items', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 5,
                'step'    => 1,
                'default' => 3
            ]
        );
        $this->add_control(
            'carousel_arrows',
            [
                'label'        => esc_html__( 'Navigation Arrow', 'onwork-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );
        $this->add_control(
            'carousel_dots',
            [
                'label' => esc_html__( 'Navigation Dots', 'onwork-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'carousel_pause_on_hover',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label_off'    => __( 'No', 'onwork-core' ),
                'label_on'     => __( 'Yes', 'onwork-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'label'        => __( 'Pause on Hover?', 'onwork-core' ),
            ]
        );
        $this->add_control(
            'carousel_centermode',
            [
                'label'        => esc_html__( 'Center Mode', 'onwork-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'carousel_centerpadding',
            [
                'label'     => esc_html__( 'Center padding', 'onwork-core' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 500,
                'step'      => 1,
                'default'   => 50,
                'condition' => [
                    'carousel_centermode' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'carousel_autolay',
            [
                'label'        => esc_html__( 'Autoplay', 'onwork-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'carousel_autoplay_speed',
            [
                'label'   => __( 'Autoplay Speed', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
        $this->add_control(
            'carousel_animation_speed',
            [
                'label'   => __( 'Autoplay Animation Speed', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
        $this->add_control(
            'heading_tablet',
            [
                'label'     => __( 'Tablet', 'onwork-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'carousel_tablet_display_items',
            [
                'label'   => __( 'Number of Items', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 3,
                'step'    => 1,
                'default' => 1,
            ]
        );
        $this->add_control(
            'carousel_heading_mobile',
            [
                'label'     => __( 'Mobile Phone', 'onwork-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'carousel_mobile_display_items',
            [
                'label'   => __( 'Number of Items', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 4,
                'step'    => 1,
                'default' => 1,
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __( 'General', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_responsive_control(
                'course_global_align',
                [
                    'label' => __( 'Alignment', 'onwork-core' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left'    => [
                            'title' => __( 'Left', 'onwork-core' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'onwork-core' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'onwork-core' ),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'text-align: {{VALUE}}!important;',
                    ],
                    'default' => 'left',
                ]
            );
        
            $this->add_responsive_control(
                'course_global_padding',
                [
                    'label' => __( 'Padding', 'onwork-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_global_margin',
                [
                    'label' => __( 'Margin', 'onwork-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'course_global_border',
                    'label' => __( 'Border', 'onwork-core' ),
                    'selector' => '{{WRAPPER}} .course-card',
                ]
            );
        
            $this->add_responsive_control(
                'course_global_radius',
                [
                    'label' => __( 'Border Radius', 'onwork-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            
            $this->add_control(
                'global_background_color',
                [
                    'label' => __( 'Background Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
        
            $this->start_controls_tabs(
                'course_global_box_shadow_tabs'
            );
            
                $this->start_controls_tab(
                    'course_global_box_shadow_normal_tab',
                    [
                        'label' => __( 'Normal', 'onwork-core' ),
                    ]
                );
        
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'course_global_normal_box_shadow',
                            'label' => __( 'Box Shadow', 'onwork-core' ),
                            'selector' => '{{WRAPPER}} .course-card',
                        ]
                    );
        
                $this->end_controls_tab();
        
                $this->start_controls_tab(
                    'course_global_box_shadow_hover_tab',
                    [
                        'label' => __( 'Hover', 'onwork-core' ),
                    ]
                );
        
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'course_global_hover_box_shadow',
                            'label' => __( 'Hover Box Shadow', 'onwork-core' ),
                            'selector' => '{{WRAPPER}} .course-card:hover',
                        ]
                    );
        
                $this->end_controls_tab();
        
            $this->end_controls_tabs();
        
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __( 'Image', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_responsive_control(
                'course_image_width',
                [
                    'label' => __( 'Width', 'onwork-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
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
                        '{{WRAPPER}} .course-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'course_image_border',
                    'label' => __( 'Border', 'onwork-core' ),
                    'selector' => '{{WRAPPER}} .course-thumbnail img',
                ]
            );
        
            $this->add_responsive_control(
                'course_image_radius',
                [
                    'label' => __( 'Border Radius', 'onwork-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __( 'Content', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_responsive_control(
                'course_content_padding',
                [
                    'label' => __( 'Padding', 'onwork-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_control(
                'course_title_heading',
                [
                    'label' => __( 'Title', 'onwork-core' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
        
            $this->start_controls_tabs(
                'course_title_color_tabs'
            );
            
                $this->start_controls_tab(
                    'course_title_color_normal_tab',
                    [
                        'label' => __( 'Normal', 'onwork-core' ),
                    ]
                );
        
        
                    $this->add_control(
                        'course_title_color',
                        [
                            'label' => __( 'Color', 'onwork-core' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .course-title a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    
        
                $this->end_controls_tab();
        
                $this->start_controls_tab(
                    'course_title_color_hover_tab',
                    [
                        'label' => __( 'Hover', 'onwork-core' ),
                    ]
                );
        
                    $this->add_control(
                        'course_title_hover_color',
                        [
                            'label' => __( 'Hover Color', 'onwork-core' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .course-title a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
        
                $this->end_controls_tab();
        
            $this->end_controls_tabs();
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_title_typography',
                    'label' => __( 'Typography', 'onwork-core' ),
                    'selector' => '{{WRAPPER}} .course-title a',
                ]
            );
        
            $this->add_responsive_control(
                'course_title_spacing',
                [
                    'label' => __( 'Spacing', 'onwork-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'course_price',
                [
                    'label' => __( 'Price', 'onwork-core' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'course_pricing_switcher' => 'yes'
                    ]
                ]
            );
        
            $this->add_control(
                'course_price_color',
                [
                    'label' => __( 'Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-price span' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'course_pricing_switcher' => 'yes'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_price_typography',
                    'label' => __( 'Typography', 'onwork-core' ),
                    'selector' => '{{WRAPPER}} .course-price span',
                    'condition' => [
                        'course_pricing_switcher' => 'yes'
                    ]
                ]
            );

            $this->add_responsive_control(
                'course_price_spacing',
                [
                    'label' => __( 'Spacing', 'onwork-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'course_pricing_switcher' => 'yes'
                    ]
                ]
            );
        
        
        $this->add_control(
            'course_rating',
            [
                'label' => __( 'Rating', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'course_rating_switcher' => 'yes'
                ]
            ]
        );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_rating_typography',
                    'label' => __( 'Typography', 'onwork-core' ),
                    'selector' => '{{WRAPPER}} .course-rating .course-rating-count',
                    'condition' => [
                        'course_rating_switcher' => 'yes'
                    ]
                ]
            );
        
            $this->add_control(
                'course_rating_icon_color',
                [
                    'label' => __( 'Icon Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-rating .tutor-star-rating-group i' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'course_rating_switcher' => 'yes'
                    ]
                ]
            );
        
            $this->add_responsive_control(
                'course_rating_icon_sizing',
                [
                    'label' => __( 'Icon Size', 'onwork-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-rating .tutor-star-rating-group i' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                    'condition' => [
                        'course_rating_switcher' => 'yes'
                    ]
                ]
            );
        
            $this->add_responsive_control(
                'course_rating_icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'onwork-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-rating .tutor-star-rating-group i' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
                    ],
                    'condition' => [
                        'course_rating_switcher' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'course_level',
                [
                    'label' => __( 'Difficulty Level', 'onwork-core' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );
        
            $this->add_control(
                'course_level_color',
                [
                    'label' => __( 'Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-card .course-difficulty-level' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'course_level_bg_color',
                [
                    'label' => __( 'Background Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-card .course-difficulty-level' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_level_typography',
                    'label' => __( 'Typography', 'onwork-core' ),
                    'selector' => '{{WRAPPER}} .course-card .course-difficulty-level',
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );

            $this->add_responsive_control(
                'course_level_padding',
                [
                    'label' => __( 'Padding', 'onwork-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card .course-difficulty-level' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );

            $this->add_responsive_control(
                'course_level_margin',
                [
                    'label' => __( 'Margin', 'onwork-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card .course-difficulty-level' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_meta_style',
            [
                'label' => __( 'Meta', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_meta_switcher' => 'yes'
                ]
            ]
        );

            $this->add_responsive_control(
                'course_meta_padding',
                [
                    'label' => __( 'Padding', 'onwork-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_meta_margin',
                [
                    'label' => __( 'Margin', 'onwork-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'course_meta_border',
                    'label' => __( 'Border', 'onwork-core' ),
                    'selector' => '{{WRAPPER}} .course-content-footer',
                ]
            );

            $this->add_responsive_control(
                'course_meta_icon_size',
                [
                    'label' => __( 'Icon Size', 'onwork-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content-footer li i' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_responsive_control(
                'course_meta_icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'onwork-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 20,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content-footer li i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_control(
                'course_meta_text_color',
                [
                    'label' => __( 'Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}  .course-content-footer li' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $this->add_control(
                'course_meta_icon_color',
                [
                    'label' => __( 'Icon Color', 'onwork-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}  .course-content-footer li i' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_meta_typography',
                    'label' => __( 'Typography', 'onwork-core' ),
                    'selector' => '{{WRAPPER}} .course-content-footer li',
                ]
            );
            
        $this->end_controls_section();

        $this->start_controls_section(
            'section_navigation_style',
            [
                'label' => __( 'Navigation Arrow', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'carousel_arrows'  => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'arrow_font_size',
            [
                'label' => __( 'Font Size', 'onwork-core' ),
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
                    '{{WRAPPER}} .course-carousel-wrap .owl-nav > div' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'left_arrow_postion',
            [
                'label' => __( 'Left Arrow Position', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .course-carousel-wrap .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'right_arrow_postion',
            [
                'label' => __( 'Right Arrow Position', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .course-carousel-wrap .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'arrow_tabs'
        );
        
            $this->start_controls_tab(
                'arrow_normal_tab',
                [
                    'label' => __( 'Normal', 'onwork-core' ),
                ]
            );

                $this->add_control(
                    'arrow_color',
                    [
                        'label' => __( 'Color', 'onwork-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .course-carousel-wrap .owl-nav > div' => 'color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'arrow_background_color',
                    [
                        'label' => __( 'Background Color', 'onwork-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .course-carousel-wrap .owl-nav > div' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'arrow_border',
                        'label' => __( 'Border', 'onwork-core' ),
                        'selector' => '{{WRAPPER}} .course-carousel-wrap .owl-nav > div',
                    ]
                );
    
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'arrow_box_shadow',
                        'label' => __( 'Box Shadow', 'onwork-core' ),
                        'selector' => '{{WRAPPER}} .course-carousel-wrap .owl-nav > div',
                    ]
                );
    
            $this->end_controls_tab();
    
            $this->start_controls_tab(
                'arrow_hover_tab',
                [
                    'label' => __( 'Hover', 'onwork-core' ),
                ]
            );
    
                $this->add_control(
                    'arrow_hover_color',
                    [
                        'label' => __( 'Color', 'onwork-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .course-carousel-wrap .owl-nav > div:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'arrow_hover_bg_color',
                    [
                        'label' => __( 'Background Color', 'onwork-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .course-carousel-wrap .owl-nav > div:hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'arrow_hover_border',
                        'label' => __( 'Border', 'onwork-core' ),
                        'selector' => '{{WRAPPER}} .course-carousel-wrap .owl-nav > div:hover',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'arrow_hover_box_shadow',
                        'label' => __( 'Box Shadow', 'onwork-core' ),
                        'selector' => '{{WRAPPER}} .course-carousel-wrap .owl-nav > div:hover',
                    ]
                );
    
            $this->end_controls_tab();
    
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => __( 'Border Radius', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => [ 'px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .course-carousel-wrap .owl-nav > div' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_width',
            [
                'label' => __( 'Width', 'onwork-core' ),
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
                    '{{WRAPPER}} .course-carousel-wrap .owl-nav > div' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_height',
            [
                'label' => __( 'Height', 'onwork-core' ),
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
                    '{{WRAPPER}} .course-carousel-wrap .owl-nav > div' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_line_height',
            [
                'label' => __( 'Line Height', 'onwork-core' ),
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
                    '{{WRAPPER}} .course-carousel-wrap .owl-nav > div' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_padding',
            [
                'label' => __( 'Padding', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .course-carousel-wrap .owl-nav > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        
    }

    protected function course_category() {
        $terms = get_terms( array(
            'taxonomy' => 'course-category',
            'hide_empty' => false,
        ) );

        $cats = [];

        if( !empty($terms) && ! is_wp_error($terms) ) {
            foreach($terms as $term) {
                $cats[$term->slug] = $term->name;
            }
        }

        return $cats;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $carousel_settings = [
            'arrows' => ( 'yes' === $settings['carousel_arrows'] ),
            'dots' => ( 'yes' === $settings['carousel_dots'] ),
            'autoplay' => ( 'yes' === $settings['carousel_autolay'] ),
            'center_mode' => ( 'yes' === $settings['carousel_centermode'] ),
            'autoplay_speed' => absint( $settings['carousel_autoplay_speed'] ),
            'animation_speed' => absint( $settings['carousel_animation_speed'] ),
            'pause_on_hover' => ( 'yes' === $settings['carousel_pause_on_hover'] ),
            'display_items' => $settings['carousel_items'],
            'tablet_display_items' => $settings['carousel_tablet_display_items'],
            'mobile_display_items' => $settings['carousel_mobile_display_items'],
        ];

        $this->add_render_attribute( 'carousel_area_attr', 'class', 'course-carousel-wrap course-carousel owl-carousel' );
        $this->add_render_attribute( 'carousel_area_attr', 'data-settings', wp_json_encode( $carousel_settings ) );

        $args = [
            'post_type'      => 'courses',
            'posts_per_page' => -1,
            'orderby'        => $settings['course_orderby'],
            'order'          => $settings['course_order'],
        ];
    
        if( !empty( $settings['course_category'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy'  => 'course-category',
                    'field'     => 'slug',
                    'terms'     => $settings['course_category']
                ]
            ];
        }
    
        $the_query = new \WP_Query($args);
        if( $the_query->have_posts() ) :
        ?>
        <div <?php echo $this->get_render_attribute_string( 'carousel_area_attr' );?>>
            <?php
            while( $the_query->have_posts() ) : $the_query->the_post();
            $course_duration = get_tutor_course_duration_context();
            $course_students = tutor_utils()->count_enrolled_users_by_course();
            $course_students = !empty($course_students) ? $course_students : 0;
            $course_rating = tutor_utils()->get_course_rating();
            $review_count = $course_rating->rating_count > 1 ? 'Reviews' : 'Review';
            ?>
            <div class="course-card course-card-<?php echo esc_attr(get_the_ID()); ?>">
                <div class="course-header">
                    <?php if ("yes" == $settings['course_difficulty_level']):?>
                        <span class="course-difficulty-level"><?php echo esc_html(get_tutor_course_level());?></span>
                    <?php endif;?>
                    <?php if(has_post_thumbnail()):?>
                    <div class="course-thumbnail">
                        <a href="<?php echo esc_attr(get_the_permalink());?>"><?php the_post_thumbnail();?></a>
                    </div>
                    <?php endif;?>
                </div>
                <div class="course-content">
                    <?php if('yes' == $settings['course_pricing_switcher']):?>
                    <div class="course-price">
                        <?php
                        $course_id = get_the_ID();
                        $price_html = '<span>'.__('Free', 'onwork-insignt').'</span>';
                        if (tutor_utils()->is_course_purchasable()) {
                            $product_id = tutor_utils()->get_course_product_id($course_id);
                            $product    = wc_get_product( $product_id );
                            if ( $product ) {
                                $price_html = '<span> '.$product->get_price_html() . '</span> ';
                            }
                        }
                            echo $price_html;
                        ?>
                    </div>
                    <?php endif;?>
                    <div class="course-title">
                        <h3><a href="<?php echo esc_attr(get_the_permalink());?>"><?php the_title(); ?></a></h3>
                    </div>
                    <?php if('yes' == $settings['course_rating_switcher']):?>
                    <div class="course-rating">
                        <?php
                        
                        tutor_utils()->star_rating_generator($course_rating->rating_avg);
                        ?>
                        <span class="course-rating-count">
                            <?php
                            echo '<span>(' . apply_filters('tutor_course_rating_count', $course_rating->rating_count) .' <span>'.$review_count.')</span></span>';
                            ?>
                        </span>
                    </div>
                    <?php endif;?>
                    <?php if('yes' == $settings['course_meta_switcher']):?>
                    <div class="course-content-footer">
                        <ul>
                            <li class="course-duration"><i class="fa fa-clock-o"></i> <?php echo $course_duration;?></li>
                            <li class="course-user"><i class="fa fa-user-o"></i> <?php echo $course_students;?></li>
                        </ul>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        ?>
        </div>
        <?php endif;?>
        <?php
        
    }
}
