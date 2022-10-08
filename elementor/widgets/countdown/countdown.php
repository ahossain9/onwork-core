<?php
/**
 * onwork_core countdown widget for elementor
 * @package Onwork_Core
 * @since 1.0.0
 */

namespace Onwork_Core\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Control_Media;

defined('ABSPATH') || die();

class Countdown extends Widget_Base {

	public function get_name() {
        return 'onwork-countdown';
    }
    
    public function get_title() {
        return __( 'Countdown', 'onwork-core' );
    }

    public function get_icon() {
        return 'onwork-core-icon eicon-countdown';
    }

    public function get_categories() {
        return [ 'onwork_core' ];
    }

    public function get_keywords() {
        return [
            'countdown',
            'onwork countdown',
            'onwork',
        ];
    }

	protected function register_controls() {
		// Time Section Start
		$this->start_controls_section(
			'_section_time',
			[
				'label' => __('Time', 'onwork-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'due_date',
			[
				'label' => __('Time', 'onwork-core'),
				'type' => Controls_Manager::DATE_TIME,
				'default' => date("Y-m-d", strtotime("+ 1 day")),
				'description' => esc_html__('Set the due date and time', 'onwork-core'),
			]
		);
		$this->end_controls_section();

		// Countdown Settings Section Start
		$this->start_controls_section(
			'_section_countdown_settings',
			[
				'label' => __('Countdown Settings', 'onwork-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'label_position',
			[
				'label' => __('Label Position', 'onwork-core'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'right' => [
						'title' => __('Right', 'onwork-core'),
						'icon' => 'eicon-h-align-right',
					],
					'bottom' => [
						'title' => __('Bottom', 'onwork-core'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => false,
				'default' => 'bottom',
				'prefix_class' => 'countdown-label-',
                'style_transfer' => true,
			]
		);
		$this->add_control(
			'label_space',
			[
				'label' => __('Label Space', 'onwork-core'),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'label_position' => 'right',
				],
                'style_transfer' => true,
			]
		);
		$this->start_popover();
		$this->add_control(
			'label_space_top',
			[
				'label' => __('Label Space Top', 'onwork-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.countdown-label-right .countdown-item .countdown-label' => 'top: {{SIZE || 0}}{{UNIT}};',
				],
				'condition' => [
					'label_position' => 'right',
				],
                'style_transfer' => true,
			]
		);

		$this->add_control(
			'label_space_left',
			[
				'label' => __('Label Space Left', 'onwork-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.countdown-label-right .countdown-item .countdown-label' => 'left: {{SIZE || 0}}{{UNIT}};',
				],
				'condition' => [
					'label_position' => 'right',
				],
                'style_transfer' => true,
			]
		);
		$this->end_popover(); //End Prover

		$this->add_control(
			'show_label_days',
			[
				'label' => esc_html__('Show Label Days?', 'onwork-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
                'style_transfer' => true,
			]
		);
		$this->add_control(
			'label_days',
			[
				'label' => esc_html__('Label Days', 'onwork-core'),
				'description' => esc_html__('Set the label for days.', 'onwork-core'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Days', 'onwork-core'),
				'default' => 'Days',
				'condition' => [
					'show_label_days' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_label_hours',
			[
				'label' => esc_html__('Show Label Hours?', 'onwork-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
                'style_transfer' => true,
			]
		);
		$this->add_control(
			'label_hours',
			[
				'label' => esc_html__('Label Hours', 'onwork-core'),
				'description' => esc_html__('Set the label for hours.', 'onwork-core'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Hours', 'onwork-core'),
				'default' => 'Hours',
				'condition' => [
					'show_label_hours' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_label_minutes',
			[
				'label' => esc_html__('Show Label Minutes?', 'onwork-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
                'style_transfer' => true,
			]
		);
		$this->add_control(
			'label_minutes',
			[
				'label' => esc_html__('Label Minutes', 'onwork-core'),
				'description' => esc_html__('Set the label for minutes.', 'onwork-core'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Minutes', 'onwork-core'),
				'default' => 'Minutes',
				'condition' => [
					'show_label_minutes' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_label_seconds',
			[
				'label' => esc_html__('Show Label Seconds?', 'onwork-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
                'style_transfer' => true,
			]
		);
		$this->add_control(
			'label_seconds',
			[
				'label' => esc_html__('Label Seconds', 'onwork-core'),
				'description' => esc_html__('Set the label for seconds.', 'onwork-core'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Seconds', 'onwork-core'),
				'default' => 'Seconds',
				'condition' => [
					'show_label_seconds' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'align',
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
					'{{WRAPPER}} .countdown-wrap' => 'text-align: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'show_separator',
			[
				'label' => esc_html__('Show Separator?', 'onwork-core'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'on',
				'default' => '',
				'separator' => 'before',
                'style_transfer' => true,
			]
		);
		$this->add_control(
			'separator',
			[
				'label' => __('Separator', 'onwork-core'),
				'type' => Controls_Manager::TEXT,
				'default' => ':',
				'condition' => [
					'show_separator' => 'on',
				],
			]
		);
		$this->add_control(
			'separator_color',
			[
				'label' => __('Separator Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-item.countdown-separator-on .countdown-separator' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_separator' => 'on',
				],
                'style_transfer' => true,
			]
		);
		$this->add_responsive_control(
			'separator_font',
			[
				'label' => __('Separator Font Size', 'onwork-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .countdown-item.countdown-separator-on .countdown-separator' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_separator' => 'on',
				],
                'style_transfer' => true,
			]
		);
		$this->add_control(
			'separator_position',
			[
				'label' => __('Separator Position', 'onwork-core'),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'show_separator' => 'on',
				],
                'style_transfer' => true,
			]
		);

		$this->start_popover();
		$this->add_control(
			'separator_position_top',
			[
				'label' => __('Position Top', 'onwork-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .countdown-item.countdown-separator-on .countdown-separator' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_separator' => 'on'
				],
                'style_transfer' => true,
			]
		);

		$this->add_control(
			'separator_position_right',
			[
				'label' => __('Position Right', 'onwork-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .countdown-item.countdown-separator-on .countdown-separator' => 'right: {{SIZE || -16}}{{UNIT}};',
				],
				'condition' => [
					'show_separator' => 'on'
				],
                'style_transfer' => true,
			]
		);
		$this->end_popover();
		$this->end_controls_section();

		// End Action Section Start
		$this->start_controls_section(
			'_section_end_action',
			[
				'label' => __('End Action', 'onwork-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'end_action_type',
			[
				'label' => esc_html__('End Action Type', 'onwork-core'),
				'label_block' => false,
				'type' => Controls_Manager::SELECT,
				'description' => esc_html__('Choose which action you want to at the end of countdown.', 'onwork-core'),
				'options' => [
					'none' => esc_html__('None', 'onwork-core'),
					'message' => esc_html__('Message', 'onwork-core'),
					'url' => esc_html__('Redirection Link', 'onwork-core'),
					'img' => esc_html__('Image', 'onwork-core'),
				],
				'default' => 'none'
			]
		);
		$this->add_control(
			'end_message',
			[
				'label' => __('Countdown End Message', 'onwork-core'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('Countdown End!', 'onwork-core'),
				'placeholder' => __('Type your message here', 'onwork-core'),
				'condition' => [
					'end_action_type' => 'message'
				],
			]
		);
		$this->add_control(
			'end_redirect_link',
			[
				'label' => __('Redirection Link', 'onwork-core'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('https://siteurl.com/', 'onwork-core'),
				'condition' => [
					'end_action_type' => 'url'
				],
			]
		);

		$this->add_control(
			'end_image',
			[
				'label' => __('Image', 'onwork-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'end_action_type' => 'img'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'end_image_size',
				'default' => 'large',
				'separator' => 'none',
				'condition' => [
					'end_action_type' => 'img'
				],
			]
		);
		$this->end_controls_section();

		// Style Section Start
		$this->start_controls_section(
			'_section_common_style',
			[
				'label' => __('Countdown Common Style', 'onwork-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_width',
			[
				'label' => __('Box Width', 'onwork-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .countdown-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_height',
			[
				'label' => __('Box Height', 'onwork-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .countdown-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'common_box_bg',
				'label' => __('Background', 'onwork-core'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .countdown-item',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __('Box Border', 'onwork-core'),
				'selector' => '{{WRAPPER}} .countdown-item',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' => __('Border Radius', 'onwork-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'label' => __('Box Shadow', 'onwork-core'),
				'selector' => '{{WRAPPER}} .countdown-item',
			]
		);
		$this->add_control(
			'common_box_time_color',
			[
				'label' => __('Time Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-time' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'common_box_time_typography',
				'selector' => '{{WRAPPER}} .countdown-time',
			]
		);
		$this->add_control(
			'common_box_label_color',
			[
				'label' => __('Label Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-label' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'common_box_label_typography',
				'selector' => '{{WRAPPER}} .countdown-label',
			]
		);
		$this->add_responsive_control(
			'common_box_spacing',
			[
				'label' => __('Spacing Between Box', 'onwork-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .countdown-item' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};'
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Box Padding', 'onwork-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//days style section
		$this->start_controls_section(
			'_section_days_style',
			[
				'label' => __('Days Style', 'onwork-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'days_bg',
				'label' => __('Background', 'onwork-core'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .countdown-item.countdown-item-days',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'days_border',
				'label' => __('Box Border', 'onwork-core'),
				'selector' => '{{WRAPPER}} .countdown-item.countdown-item-days',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'days_time_color',
			[
				'label' => __('Time Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-item-days .countdown-time' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'days_time_typography',
				'selector' => '{{WRAPPER}} .countdown-item-days .countdown-time',
			]
		);
		$this->add_control(
			'days_label_color',
			[
				'label' => __('Label Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-item-days .countdown-label' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'days_label_typography',
				'selector' => '{{WRAPPER}} .countdown-item-days .countdown-label',
			]
		);
		$this->end_controls_section();

		//hours style section
		$this->start_controls_section(
			'_section_hours_style',
			[
				'label' => __('Hours Style', 'onwork-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hours_bg',
				'label' => __('Background', 'onwork-core'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .countdown-item.countdown-item-hours',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hours_border',
				'label' => __('Box Border', 'onwork-core'),
				'selector' => '{{WRAPPER}} .countdown-item.countdown-item-hours',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'hours_time_color',
			[
				'label' => __('Time Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-item-hours .countdown-time' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hours_time_typography',
				'selector' => '{{WRAPPER}} .countdown-item-hours .countdown-time',
			]
		);
		$this->add_control(
			'hours_label_color',
			[
				'label' => __('Label Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-item-hours .countdown-label' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hours_label_typography',
				'selector' => '{{WRAPPER}} .countdown-item-hours .countdown-label',
			]
		);
		$this->end_controls_section();

		//minutes style section
		$this->start_controls_section(
			'_section_minutes_style',
			[
				'label' => __('Minutes Style', 'onwork-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'minutes_bg',
				'label' => __('Background', 'onwork-core'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .countdown-item.countdown-item-minutes',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'minutes_border',
				'label' => __('Box Border', 'onwork-core'),
				'selector' => '{{WRAPPER}} .countdown-item.countdown-item-minutes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'minutes_time_color',
			[
				'label' => __('Time Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-item-minutes .countdown-time' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'minutes_time_typography',
				'selector' => '{{WRAPPER}} .countdown-item-minutes .countdown-time',
			]
		);
		$this->add_control(
			'minutes_label_color',
			[
				'label' => __('Label Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-item-minutes .countdown-label' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'minutes_label_typography',
				'selector' => '{{WRAPPER}} .countdown-item-minutes .countdown-label',
			]
		);
		$this->end_controls_section();

		//seconds style section
		$this->start_controls_section(
			'_section_seconds_style',
			[
				'label' => __('Seconds Style', 'onwork-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'seconds_bg',
				'label' => __('Background', 'onwork-core'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .countdown-item.countdown-item-seconds',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'seconds_border',
				'label' => __('Box Border', 'onwork-core'),
				'selector' => '{{WRAPPER}} .countdown-item.countdown-item-seconds',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'seconds_time_color',
			[
				'label' => __('Time Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-item-seconds .countdown-time' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'seconds_time_typography',
				'selector' => '{{WRAPPER}} .countdown-item-seconds .countdown-time',
			]
		);
		$this->add_control(
			'seconds_label_color',
			[
				'label' => __('Label Color', 'onwork-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-item-seconds .countdown-label' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'seconds_label_typography',
				'selector' => '{{WRAPPER}} .countdown-item-seconds .countdown-label',
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$due_date = date("M d Y G:i:s", strtotime($settings['due_date']));
		$this->add_render_attribute('countdown', 'class', 'countdown');
		$this->add_render_attribute('countdown', 'data-date', esc_attr($due_date));
		$this->add_render_attribute('countdown', 'data-end-action', esc_attr($settings['end_action_type']));
		if ('url' === $settings['end_action_type'] && $settings['end_redirect_link']) {
			$this->add_render_attribute('countdown', 'data-redirect-link', esc_url($settings['end_redirect_link']));
		}
		$this->add_render_attribute('days', 'class', 'countdown-item countdown-item-days');
		$this->add_render_attribute('hours', 'class', 'countdown-item countdown-item-hours');
		$this->add_render_attribute('minutes', 'class', 'countdown-item countdown-item-minutes');
		$this->add_render_attribute('seconds', 'class', 'countdown-item countdown-item-seconds');
		if ('on' == $settings['show_separator']) {
			$this->add_render_attribute('days', 'class', 'countdown-separator-on');
			$this->add_render_attribute('hours', 'class', 'countdown-separator-on');
			$this->add_render_attribute('minutes', 'class', 'countdown-separator-on');
			$this->add_render_attribute('seconds', 'class', 'countdown-separator-on');
		}
		?>
		<?php if (!empty($due_date)): ?>
			<div class="countdown-wrap">
				<div <?php $this->print_render_attribute_string('countdown'); ?>>
					<div <?php $this->print_render_attribute_string('days'); ?>>
						<span data-days class="countdown-time countdown-days">0</span>
						<?php if ('yes' == $settings['show_label_days'] && !empty($settings['label_days'])): ?>
							<span
								class="countdown-label countdown-label-days"><?php echo esc_html($settings['label_days']); ?></span>
						<?php endif; ?>
						<?php if ('on' == $settings['show_separator'] && !empty($settings['separator'])): ?>
							<span class="countdown-separator"><?php echo esc_attr($settings['separator']); ?></span>
						<?php endif; ?>
					</div>
					<div <?php $this->print_render_attribute_string('hours'); ?>>
						<span class="countdown-time countdown-hours" data-hours>0</span>
						<?php if ('yes' == $settings['show_label_hours'] && !empty($settings['label_hours'])): ?>
							<span
								class="countdown-label countdown-label-hours"><?php echo esc_html($settings['label_hours']); ?></span>
						<?php endif; ?>
						<?php if ('on' == $settings['show_separator'] && !empty($settings['separator'])): ?>
							<span class="countdown-separator"><?php echo esc_attr($settings['separator']); ?></span>
						<?php endif; ?>
					</div>
					<div <?php $this->print_render_attribute_string('minutes'); ?>>
						<span class="countdown-time countdown-minutes" data-minutes>0</span>
						<?php if ('yes' == $settings['show_label_minutes'] && !empty($settings['label_minutes'])): ?>
							<span
								class="countdown-label countdown-label-minutes"><?php echo esc_html($settings['label_minutes']); ?></span>
						<?php endif; ?>
						<?php if ('on' == $settings['show_separator'] && !empty($settings['separator'])): ?>
							<span class="countdown-separator"><?php echo esc_attr($settings['separator']); ?></span>
						<?php endif; ?>
					</div>
					<div <?php $this->print_render_attribute_string('seconds'); ?>>
						<span class="countdown-time countdown-seconds" data-seconds>0</span>
						<?php if ('yes' == $settings['show_label_seconds'] && !empty($settings['label_seconds'])): ?>
							<span
								class="countdown-label countdown-label-seconds"><?php echo esc_html($settings['label_seconds']); ?></span>
						<?php endif; ?>
					</div>
					<!--End action markup-->
					<?php if ('none' != $settings['end_action_type'] && !empty($settings['end_action_type'])): ?>
						<div class="countdown-end-action">
							<?php if ('message' == $settings['end_action_type'] && $settings['end_message']) :
								echo '<div class="countdown-end-message">' . wpautop(wp_kses_post($settings['end_message'])) . '</div>';
							endif; ?>
							<?php if ('img' == $settings['end_action_type'] && ($settings['end_image']['url'] || $settings['end_image']['id'])) :
								$this->add_render_attribute('image', 'src', $settings['end_image']['url']);
								$this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['end_image']));
								$this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['end_image']));
								?>
								<figure class="countdown-end-action-image">
									<?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'end_image_size', 'end_image'); ?>
								</figure>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php

	}
}
