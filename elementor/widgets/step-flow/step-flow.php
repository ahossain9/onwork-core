<?php
/**
 * onwork_core step flow widget for elementor
 * @package Onwork_Core
 * @since 1.0.0
 */
namespace Onwork_Core\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Text_Shadow;

defined( 'ABSPATH' ) || die();

class Step_Flow extends Widget_Base {
    
    public function get_name() {
        return 'onwork-step-flow';
    }
    
    public function get_title() {
        return __( 'Step Flow', 'onwork-core' );
    }

    public function get_icon() {
        return 'onwork-core-icon eicon-theme-builder';
    }

    public function get_categories() {
        return [ 'onwork_core' ];
    }

    public function get_keywords() {
        return [
            'step',
            'flow',
            'stepflow',
            'step flow',
            'onwork stepflow',
            'onwork step flow',
            'onwork'
        ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            '_section_step',
            [
                'label' => __( 'Step Flow', 'onwork-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => __( 'Icon', 'onwork-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
					'value' => 'fas fa-layer-group',
					'library' => 'solid',
				],
            ]
        );

        $this->add_control(
            'badge',
            [
                'label' => __( 'Badge', 'onwork-core' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Badge', 'onwork-core' ),
                'description' => __( 'Keep it blank, if you want to remove the Badge', 'onwork-core' ),
                'default' => __( 'Step 1', 'onwork-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'onwork-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Title', 'onwork-core' ),
                'default' => __( 'Start Marketing', 'onwork-core' ),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'onwork-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Description', 'onwork-core' ),
                'default' => 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'onwork-core' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://siteurl.com/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'onwork-core' ),
                'type' => Controls_Manager::CHOOSE,
                'separator' => 'before',
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'onwork-core' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'onwork-core' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'onwork-core' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'onwork-core' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'onwork-core' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'onwork-core' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'content_alignment',
            [
                'label' => __( 'Alignment', 'onwork-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'onwork-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'onwork-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'onwork-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .stepflow-wrap' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'show_indicator',
            [
                'label' => __( 'Show Direction', 'onwork-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'onwork-core' ),
                'label_off' => __( 'No', 'onwork-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __( 'General', 'emexso-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
      
        $this->add_responsive_control(
            'global_padding',
            [
                'label' => __( 'Padding', 'emexso-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .step-flow .stepflow-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
 
        $this->start_controls_section(
            '_section_icon_style',
            [
                'label' => __( 'Icon', 'onwork-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => __( 'Padding', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __( 'Bottom Spacing', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __( 'Border', 'onwork-core' ),
                'selector' => '{{WRAPPER}} .steps-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => __( 'Border Radius', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .steps-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .steps-icon',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .steps-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background_color',
            [
                'label' => __( 'Background Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .steps-icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_badge_style',
            [
                'label' => __('Badge', 'onwork-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'badge!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label' => __( 'Padding', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'badge!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'label' => __( 'Border', 'onwork-core' ),
                'selector' => '{{WRAPPER}} .steps-label',
                'condition' => [
                    'badge!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => __( 'Border Radius', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'badge!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'badge!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_background_color',
            [
                'label' => __( 'Background Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'badge!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-label' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'selector' => '{{WRAPPER}} .steps-label',
                'condition' => [
                    'badge!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title_style',
            [
                'label' => __( 'Title & Description', 'onwork-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'onwork-core' ),
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .steps-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .steps-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_link_color',
            [
                'label' => __( 'Link Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'link[url]!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Hover Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'link[url]!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'selector' => '{{WRAPPER}} .steps-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .steps-title',
            ]
        );

        $this->add_control(
            '_heading_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'onwork-core' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .step-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'description_shadow',
                'selector' => '{{WRAPPER}} .step-description',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .step-description',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_direction_style',
            [
                'label' => __( 'Direction', 'onwork-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'direction_style',
            [
                'label' => __( 'Style', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => __( 'Solid', 'onwork-core' ),
                    'dotted' => __( 'Dotted', 'onwork-core' ),
                    'dashed' => __( 'Dashed', 'onwork-core' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .step-arrow, {{WRAPPER}} .step-arrow:after' => 'border-top-style: {{VALUE}};',
                    '{{WRAPPER}} .step-arrow:after' => 'border-right-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'direction_width',
            [
                'label' => __( 'Width', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-arrow' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'direction_offset_toggle',
            [
                'label' => __( 'Offset', 'onwork-core' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'onwork-core' ),
                'label_on' => __( 'Custom', 'onwork-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'direction_offset_y',
            [
                'label' => __( 'Offset Top', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'direction_offset_toggle' => 'yes'
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .step-arrow' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'direction_offset_x',
            [
                'label' => __( 'Offset Left', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'direction_offset_toggle' => 'yes'
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .step-arrow' => 'left: calc( 100% + {{SIZE}}{{UNIT}} );',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'direction_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .step-arrow' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .step-arrow:after' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'title', 'class', 'steps-title' );
        $this->add_render_attribute( 'description', 'class', 'step-description' );
        $this->add_render_attribute( 'badge', 'class', 'steps-label' );

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'link', $settings['link'] );
            $this->add_inline_editing_attributes( 'link', 'basic', 'title' );

            $title = sprintf( '<a %s>%s</a>',
                $this->get_render_attribute_string( 'link' ),
                esc_html( $settings['title'] )
            );
        } else {
            $this->add_inline_editing_attributes( 'title', 'basic' );
            $title = esc_html( $settings['title'] );
        }
        ?>
        <div class="step-flow">
            <div class="stepflow-wrap">
                <div class="steps-icon">
                    <?php if ( $settings['show_indicator'] === 'yes' ) : ?>
                        <div class="step-arrow"></div>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) :?>
                        <span><?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );?></span>
                    <?php endif; ?>

                    <?php if ( $settings['badge'] ) : ?>
                        <span <?php $this->print_render_attribute_string( 'badge' ); ?>><?php echo esc_html( $settings['badge'] ); ?></span>
                    <?php endif; ?>
                </div>

                <?php
                printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['title_tag'] ),
                    $this->get_render_attribute_string( 'title' ),
                    $title
                );
                ?>

                <?php if ( $settings['description'] ) : ?>
                    <p <?php $this->print_render_attribute_string( 'description' ); ?>><?php echo esc_html( $settings['description'] ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

}
