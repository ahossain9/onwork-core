<?php
/**
 * onwork_core testimonial carousel widget for elementor
 * @package Onwork_Core
 * @since 1.0.0
 */
namespace Onwork_Core\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Testimonial_Carousel extends Widget_Base {

    public function get_name() {
        return 'onwork-testimonial-carousel';
    }
    
    public function get_title() {
        return __( 'Testimonial Carousel', 'onwork-core' );
    }

    public function get_icon() {
        return 'onwork-core-icon eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'onwork_core' ];
    }

    public function get_keywords() {
        return [ 
            'testimonial',
            'testimonial carousel',
            'testimonial slider',
            'carousel',
            'feedback',
            'review',
            'onwork',
        ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'onwork-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
   
		$repeater = new Repeater();

		$repeater->add_control(
			'testi_name', [
				'label' => __( 'Name', 'onwork-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Adam Smith' , 'onwork-core' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'testi_image',
			[
				'label' => __( 'Client Image', 'onwork-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
        $repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'testi_image_size',
				'default' => 'large',
			]
		);
        $repeater->add_control(
			'testi_desig', [
				'label' => __( 'Designation', 'onwork-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Web Developer' , 'onwork-core' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'testi_rating',
			[
				'label' => __( 'Rating', 'onwork-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 3,
				'max' => 5,
				'step' => 0.5,
				'default' => 5,
                'condition' => [
                    'show_rating' => 'yes',
                ]
			]
		);
		$repeater->add_control(
			'testi_content', [
				'label' => __( 'Content', 'onwork-core' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.' , 'onwork-core' ),
				'show_label' => false,
			]
		);
		$this->add_control(
			'testi_item',
			[
				'label' => __( 'Testimonial Item', 'onwork-core' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'testi_name' => __( 'Testimonial 1', 'onwork-core' ),
						'testi_desig' => __( 'Designation 1', 'onwork-core' ),
						'testi_content' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'onwork-core' ),
					],
					[
						'testi_name' => __( 'Testimonial 2', 'onwork-core' ),
						'testi_desig' => __( 'Designation 2', 'onwork-core' ),
						'testi_content' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'onwork-core' ),
					],
                    [
						'testi_name' => __( 'Testimonial 3', 'onwork-core' ),
						'testi_desig' => __( 'Designation 3', 'onwork-core' ),
						'testi_content' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'onwork-core' ),
					],
				],
				'title_field' => '{{{ testi_name }}}',
			]
		);
		$this->end_controls_section();
        
        // Slider setting
        $this->start_controls_section(
            'testimonial_slider_option',
            [
                'label' => esc_html__( 'Slider Option', 'onwork-core' ),
            ]
        );
        $this->add_control(
			'quote_switcher',
			[
				'label' => __( 'Quote', 'onwork-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'onwork-core' ),
				'label_off' => __( 'Hide', 'onwork-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'rating_switcher',
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
			'rating_position',
			[
				'label' => __( 'Rating Position', 'onwork-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before'  => __( 'Before Content', 'onwork-core' ),
					'after' => __( 'After Content', 'onwork-core' )
				],
				'condition' => [
                    'rating_switcher' => 'yes',
                ]
			]
		);

        $this->add_control(
			'testimonial_design',
			[
				'label' => __( 'Design', 'onwork-core' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'default' => __( 'Default', 'onwork-core' ),
					'bubble' => __( 'Bubble', 'onwork-core' ),
				],
				'default' => 'default'
			]
		);

        $this->add_control(
			'image_position',
			[
				'label' => __( 'Image Position', 'onwork-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'aside',
				'options' => [
					'aside'  => __( 'Aside', 'onwork-core' ),
					'top' => __( 'Top', 'onwork-core' )
				]
			]
		);

        $this->add_control(
            'testi_items',
            [
                'label' => esc_html__( 'Slider Items', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 3
            ]
        );
        $this->add_control(
            'testi_arrows',
            [
                'label' => esc_html__( 'Slider Arrow', 'onwork-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );
        $this->add_control(
            'testi_dots',
            [
                'label' => esc_html__( 'Slider Dots', 'onwork-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'testi_pause_on_hover',
            [
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'onwork-core'),
                'label_on' => __('Yes', 'onwork-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'label' => __('Pause on Hover?', 'onwork-core'),
            ]
        );
        $this->add_control(
            'testi_centermode',
            [
                'label' => esc_html__( 'Center Mode', 'onwork-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'testi_centerpadding',
            [
                'label' => esc_html__( 'Center padding', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => 50,
                'condition' => [
                    'slcentermode' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'testi_autolay',
            [
                'label' => esc_html__( 'Slider Autoplay', 'onwork-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator' => 'before',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'testi_autoplay_speed',
            [
                'label' => __('Autoplay Speed', 'onwork-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
                'condition' => [
                    'testi_autolay' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'testi_animation_speed',
            [
                'label' => __('Autoplay Animation speed', 'onwork-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
        $this->add_control(
            'heading_tablet',
            [
                'label' => __( 'Tablet', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'testi_tablet_display_items',
            [
                'label' => __('Slider Items', 'onwork-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control( 
            'testi_heading_mobile',
            [
                'label' => __( 'Mobile Phone', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'testi_mobile_display_items',
            [
                'label' => __('Slider Items', 'onwork-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 4,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->end_controls_section();
        
        // Style tab
		$this->start_controls_section(
            'section_general_style',
            [
                'label' => __( 'General', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'testi_global_align',
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
                    '{{WRAPPER}} .testi-single' => 'text-align: {{VALUE}};',
                ],
                'toggle' => false,
                'default' => 'center',
				'prefix_class' => 'testi-align-',
            ]
        );

        $this->add_responsive_control(
            'testi_global_padding',
            [
                'label' => __( 'Padding', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testi_global_margin',
            [
                'label' => __( 'Margin', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-single.default' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
					'testimonial_design' => 'default'
				]
            ]
        );

        $this->add_responsive_control(
            'testi_global_inner_padding',
            [
                'label' => __( 'Inner Padding', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-single .testi-content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
					'testimonial_design' => 'bubble'
				]
            ]
        );

        $this->add_responsive_control(
            'testi_global_inner_margin',
            [
                'label' => __( 'Inner Margin', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-single .testi-content-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
					'testimonial_design' => 'bubble'
				]
            ]
        );
        
        $this->start_controls_tabs(
            'testi_global_tabs'
        );

            $this->start_controls_tab(
                'testi_global_normal_tab',
                [
                    'label' => __( 'Normal', 'onwork-core' ),
                ]
            );

                $this->add_control(
                    'testi_global_bg_color',
                    [
                        'label' => __( 'Background Color', 'onwork-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .testi-single' => 'background-color: {{VALUE}}',
                            '{{WRAPPER}} .testi-single.bubble .testi-content-inner' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'testi_global_border',
                        'label' => __( 'Border', 'onwork-core' ),
                        'selector' => '{{WRAPPER}} .testi-single, {{WRAPPER}} .testi-single.bubble .testi-content-inner',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'testi_global_normal_box_shadow',
                        'label' => __( 'Box Shadow', 'onwork-core' ),
                        'selector' => '{{WRAPPER}} .testi-single, {{WRAPPER}} .testi-single.bubble .testi-content-inner',
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'testi_global_hover_tab',
                [
                    'label' => __( 'Hover', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'testi_global_hover_bg_color',
                    [
                        'label' => __( 'Background Color', 'onwork-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .testi-single:hover' => 'background-color: {{VALUE}}',
                            '{{WRAPPER}} .testi-single.bubble .testi-content-inner:hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'testi_global_hover_border',
                        'label' => __( 'Border', 'onwork-core' ),
                        'selector' => '{{WRAPPER}} .testi-single:hover, {{WRAPPER}} .testi-single.bubble .testi-content-inner:hover',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'testi_global_hover_box_shadow',
                        'label' => __( 'Box Shadow', 'onwork-core' ),
                        'selector' => '{{WRAPPER}} .testi-single:hover, {{WRAPPER}} .testi-single.bubble .testi-content-inner:hover',
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'testi_global_radius',
            [
                'label' => __( 'Border Radius', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testi-single.bubble .testi-content-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
        'section_image_style',
            [
                'label' => __( 'Image', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'testi_image_width',
            [
                'label'      => __( 'Width', 'onwork-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .testi-client-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Spacing', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.testi-align-left .testi-client-info.aside .testi-client-img' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.testi-align-center .testi-client-info.aside .testi-client-img' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.testi-align-right .testi-client-info.aside .testi-client-img' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testi-client-info.top .testi-client-img' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'testi_image_border',
                'label' => __( 'Border', 'onwork-core' ),
                'selector' => '{{WRAPPER}} .testi-client-img img',
            ]
        );
        $this->add_responsive_control(
            'testi_image_radius',
            [
                'label' => __( 'Border Radius', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-client-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
         $this->add_control(
            'testi_content',
            [
                'label' => __( 'Content', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testi_content_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testi_content_typography',
                'selector' => '{{WRAPPER}} .testi-content',
            ]
        );
        $this->add_responsive_control(
            'testi_content_spacing',
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
                    '{{WRAPPER}} .testi-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'testi_name',
            [
                'label' => __( 'Name', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testi_name_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-single h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testi_name_typography',
                'selector' => '{{WRAPPER}} .testi-single h4',
            ]
        );
        $this->add_responsive_control(
            'testi_name_spacing',
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
                    '{{WRAPPER}} .testi-single h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'testi_designation',
            [
                'label' => __( 'Designation', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testi_desig_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-single h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testi_desig_typography',
                'selector' => '{{WRAPPER}} .testi-single h6',
            ]
        );
        $this->add_responsive_control(
            'testi_desig_spacing',
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
                    '{{WRAPPER}} .testi-single h6' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'testi_rating',
            [
                'label' => __( 'Rating', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testi_rating_icon_color',
            [
                'label' => __( 'Icon Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-rating i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
			'rating_size',
			[
				'label' => __( 'Icon Size', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testi-rating i' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
        $this->add_responsive_control(
            'testi_rating_spacing',
            [
                'label' => __( 'Spacing', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-rating i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
        'section_quote_style',
            [
                'label' => __( 'Quote', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'testi_quote',
            [
                'label' => __( 'Quote', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testi_quote_icon_color',
            [
                'label' => __( 'Icon Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-quote i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
			'testi_quote_size',
			[
				'label' => __( 'Icon Size', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testi-quote i' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
        $this->add_responsive_control(
            'testi_quote_spacing',
            [
                'label' => __( 'Spacing', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
					'{{WRAPPER}} .testi-quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_testi_nav_style',
            [
                'label' => __( 'Navigation', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
			'testi_nav_arrow_size',
			[
				'label' => __( 'Icon Size', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testi-carousel.owl-carousel .owl-nav > div i' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
        $this->start_controls_tabs(
            'testi_nav_tabs'
        );
            $this->start_controls_tab(
                'testi_nav_normal_tab',
                [
                    'label' => __( 'Normal', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'testi_nav_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .testi-carousel.owl-carousel .owl-nav > div i' => 'color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'testi_nav_hover_tab',
                [
                    'label' => __( 'Hover', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'testi_nav_hover_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .testi-carousel.owl-carousel .owl-nav > div i:hover' => 'color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_testi_dot_style',
            [
                'label' => __( 'Dots', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'testi_dots_spacing',
            [
                'label'      => __( 'Dots Wrapper Spacing', 'onwork-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 200,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel .owl-dots' => 'bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testi_dot_width',
            [
                'label'      => __( 'Width', 'onwork-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel .owl-dot' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testi_dot_height',
            [
                'label'      => __( 'Height', 'onwork-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel .owl-dot' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testi_dot_item_spacing',
            [
                'label' => __( 'Dot Item Margin', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => [ 'right', 'left' ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel .owl-dot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'testi_dot_tabs'
        );
            $this->start_controls_tab(
                'testi_dot_normal_tab',
                [
                    'label' => __( 'Normal', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'testi_dot_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .testi-carousel .owl-dot' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'testi_dot_active_tab',
                [
                    'label' => __( 'Active', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'testi_dot_active_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .testi-carousel .owl-dot.active' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $slider_settings = [
            'arrows' => ('yes' === $settings['testi_arrows']),
            'dots' => ('yes' === $settings['testi_dots']),
            'autoplay' => ('yes' === $settings['testi_autolay']),
            'center_mode' => ('yes' === $settings['testi_centermode']),
            'autoplay_speed' => absint($settings['testi_autoplay_speed']),
            'animation_speed' => absint($settings['testi_animation_speed']),
            'pause_on_hover' => ('yes' === $settings['testi_pause_on_hover']),
        ];

        $slider_responsive_settings = [
            'display_items' => $settings['testi_items'],
            'tablet_display_items' => $settings['testi_tablet_display_items'],
            'mobile_display_items' => $settings['testi_mobile_display_items'],
        ];
        
        $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
        
        $this->add_render_attribute( 'testimonial_area_attr', 'class', 'testi-carousel owl-carousel' );   
        $this->add_render_attribute( 'testimonial_area_attr', 'data-settings', wp_json_encode( $slider_settings ) );   
        ?>
        <div <?php echo $this->get_render_attribute_string( 'testimonial_area_attr' ); ?>>
           <?php
            if ( $settings['testi_item'] ) :
                foreach ( $settings['testi_item'] as $testimonial_item ):
            ?>
            <div class="testi-single <?php echo esc_attr( $settings['testimonial_design'] );?>">
                <div class="testi-content-inner">
                    <div class="testi-quote <?php echo esc_attr($settings['quote_switcher'] == 'yes' ? 'show': 'hide' );?>">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <div class="testi-rating before-rating <?php echo esc_attr( ($settings['rating_position']) . ($settings['rating_switcher'] == 'yes' ? ' show': 'hide' ));?>">
                        <?php
                        $rating_data = $testimonial_item['testi_rating'];
                        $stars_html = '';
            
                        if ( $rating_data == 5 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
                        } elseif ( $rating_data == 4.5 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>';
                        } elseif ( $rating_data == 4 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
                        } elseif ( $rating_data == 3.5 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>';
                        } elseif ( $rating_data == 3 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
                        } else {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
                        }
                        echo $stars_html;
                        ?>
                    </div>
                    <?php if(!empty($testimonial_item['testi_content'])):?>
                        <div class="testi-content">
                            <?php echo $testimonial_item['testi_content'];?>
                        </div>
                    <?php endif;?>
                    <div class="testi-rating after-rating <?php echo esc_attr( ($settings['rating_position']) . ($settings['rating_switcher'] == 'yes' ? ' show': 'hide' ));?>">
                        <?php
                        $rating_data = $testimonial_item['testi_rating'];
                        $stars_html = '';
            
                        if ( $rating_data == 5 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
                        } elseif ( $rating_data == 4.5 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>';
                        } elseif ( $rating_data == 4 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
                        } elseif ( $rating_data == 3.5 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>';
                        } elseif ( $rating_data == 3 ) {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
                        } else {
                            $stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
                        }
                        echo $stars_html;
                        ?>
                    </div>
                </div>
                <div class="testi-client-info <?php echo esc_attr($settings['image_position']);?>">
                    <?php if(Group_Control_Image_Size::get_attachment_image_html( $testimonial_item, 'testi_image_size', 'testi_image' )):?>
                    <div class="testi-client-img">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $testimonial_item, 'testi_image_size', 'testi_image' );?>
                    </div>
                    <?php endif;?>
                    <?php if(!empty($testimonial_item['testi_name'] || $testimonial_item['testi_desig'])):?>
                        <div class="testi-client-details">
                        <?php if($testimonial_item['testi_name']):?>
                            <h4><?php echo esc_html($testimonial_item['testi_name']);?></h4>
                            <?php endif?>
                            <?php if($testimonial_item['testi_desig']):?>
                            <h6><?php echo esc_html($testimonial_item['testi_desig']);?></h6>
                            <?php endif?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php
		
	}

}