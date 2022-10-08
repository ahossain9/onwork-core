<?php
/**
 * onwork_core team member widget for elementor
 * @package Onwork_Core
 * @since 1.0.0
 */
namespace Onwork_Core\Widgets;

use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Happy_Addons\Elementor\Traits\Button_Renderer;

defined( 'ABSPATH' ) || die();

class Team_Member extends Widget_Base {

	public function get_name() {
        return 'onwork-team-member';
    }
    
    public function get_title() {
        return __( 'Teacher', 'onwork-core' );
    }

    public function get_icon() {
        return 'onwork-core-icon eicon-person';
    }

    public function get_categories() {
        return [ 'onwork_core' ];
    }

    public function get_keywords() {
        return [ 
            'team',
            'team member',
            'team members',
            'member',
            'members',
            'teacher',
            'teachers',
            'onwork',
        ];
    }

	protected static function get_profile_names() {
		return [
			'500px'          => __( '500px', 'onwork-core' ),
			'apple'          => __( 'Apple', 'onwork-core' ),
			'behance'        => __( 'Behance', 'onwork-core' ),
			'bitbucket'      => __( 'BitBucket', 'onwork-core' ),
			'codepen'        => __( 'CodePen', 'onwork-core' ),
			'delicious'      => __( 'Delicious', 'onwork-core' ),
			'deviantart'     => __( 'DeviantArt', 'onwork-core' ),
			'digg'           => __( 'Digg', 'onwork-core' ),
			'dribbble'       => __( 'Dribbble', 'onwork-core' ),
			'email'          => __( 'Email', 'onwork-core' ),
			'facebook'       => __( 'Facebook', 'onwork-core' ),
			'flickr'         => __( 'Flicker', 'onwork-core' ),
			'foursquare'     => __( 'FourSquare', 'onwork-core' ),
			'github'         => __( 'Github', 'onwork-core' ),
			'houzz'          => __( 'Houzz', 'onwork-core' ),
			'instagram'      => __( 'Instagram', 'onwork-core' ),
			'jsfiddle'       => __( 'JS Fiddle', 'onwork-core' ),
			'linkedin'       => __( 'LinkedIn', 'onwork-core' ),
			'medium'         => __( 'Medium', 'onwork-core' ),
			'pinterest'      => __( 'Pinterest', 'onwork-core' ),
			'product-hunt'   => __( 'Product Hunt', 'onwork-core' ),
			'reddit'         => __( 'Reddit', 'onwork-core' ),
			'slideshare'     => __( 'Slide Share', 'onwork-core' ),
			'snapchat'       => __( 'Snapchat', 'onwork-core' ),
			'soundcloud'     => __( 'SoundCloud', 'onwork-core' ),
			'spotify'        => __( 'Spotify', 'onwork-core' ),
			'stack-overflow' => __( 'StackOverflow', 'onwork-core' ),
			'tripadvisor'    => __( 'TripAdvisor', 'onwork-core' ),
			'tumblr'         => __( 'Tumblr', 'onwork-core' ),
			'twitch'         => __( 'Twitch', 'onwork-core' ),
			'twitter'        => __( 'Twitter', 'onwork-core' ),
			'vimeo'          => __( 'Vimeo', 'onwork-core' ),
			'vk'             => __( 'VK', 'onwork-core' ),
			'website'        => __( 'Website', 'onwork-core' ),
			'whatsapp'       => __( 'WhatsApp', 'onwork-core' ),
			'wordpress'      => __( 'WordPress', 'onwork-core' ),
			'xing'           => __( 'Xing', 'onwork-core' ),
			'yelp'           => __( 'Yelp', 'onwork-core' ),
			'youtube'        => __( 'YouTube', 'onwork-core' ),
		];
	}

	/**
	 * Register content related controls
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'_section_info',
			[
				'label' => __( 'Information', 'onwork-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'onwork-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Name', 'onwork-core' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Adam Smith',
				'placeholder' => __( 'Type Member Name', 'onwork-core' ),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'job_title',
			[
				'label' => __( 'Designation', 'onwork-core' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Developer', 'onwork-core' ),
				'placeholder' => __( 'Type Member Job Title', 'onwork-core' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'bio',
			[
				'label' => __( 'Short Bio', 'onwork-core' ),
				'description' => onwork_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. ', 'onwork-core' ),
				'rows' => 5,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title_link', [
				'label' => __( 'Title Link', 'onwork-core' ),
				'placeholder' => __( 'Add your profile link', 'onwork-core' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'autocomplete' => false,
				'show_external' => false,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_social',
			[
				'label' => __( 'Social Icons', 'onwork-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label' => __( 'Profile Name', 'onwork-core' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'select2options' => [
					'allowClear' => false,
				],
				'options' => self::get_profile_names()
			]
		);

		$repeater->add_control(
			'link', [
				'label' => __( 'Profile Link', 'onwork-core' ),
				'placeholder' => __( 'Add your profile link', 'onwork-core' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'autocomplete' => false,
				'show_external' => false,
				'condition' => [
					'name!' => 'email'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'customize',
			[
				'label' => __( 'Want To Customize?', 'onwork-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'onwork-core' ),
				'label_off' => __( 'No', 'onwork-core' ),
				'return_value' => 'yes',
				'style_transfer' => true,
			]
		);

		$repeater->start_controls_tabs(
			'_tab_icon_colors',
			[
				'condition' => ['customize' => 'yes']
			]
		);
		$repeater->start_controls_tab(
			'_tab_icon_normal',
			[
				'label' => __( 'Normal', 'onwork-core' ),
			]
		);

		$repeater->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'_tab_icon_hover',
			[
				'label' => __( 'Hover', 'onwork-core' ),
			]
		);

		$repeater->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .member-links > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_bg_color',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .member-links > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_border_color',
			[
				'label' => __( 'Border Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .member-links > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'profiles',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
				'default' => [
					[
						'link' => ['url' => 'https://facebook.com/'],
						'name' => 'facebook'
					],
					[
						'link' => ['url' => 'https://twitter.com/'],
						'name' => 'twitter'
					],
					[
						'link' => ['url' => 'https://linkedin.com/'],
						'name' => 'linkedin'
					]
				],
			]
		);

		$this->add_control(
			'show_profiles',
			[
				'label' => __( 'Social Icons', 'onwork-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'onwork-core' ),
				'label_off' => __( 'Hide', 'onwork-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_global',
			[
				'label' => __( 'General', 'onwork-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'global_padding',
			[
				'label' => __( 'Padding', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'global_align',
			[
				'label' => __( 'Alignment', 'onwork-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
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
				'toggle' => true,
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .member-wrap' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->start_controls_tabs( 'team_tabs' );
		$this->start_controls_tab(
			'team_normal',
			[
				'label' => __( 'Normal', 'onwork-core' ),
			]
		);

		$this->add_control(
			'team_global_bg_color',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'team_global_border',
				'selector' => '{{WRAPPER}} .member-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_global_box_shadow',
				'selector' => '{{WRAPPER}} .member-wrap',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'testimonial_hover',
			[
				'label' => __( 'Hover', 'onwork-core' ),
			]
		);

		$this->add_control(
			'team_hover_global_bg_color',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-wrap:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'team_hover_global_border',
				'selector' => '{{WRAPPER}} .member-wrap:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_hover_global_box_shadow',
				'selector' => '{{WRAPPER}} .member-wrap:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'goabal_border_radius',
			[
				'label' => __( 'Border Radius', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .member-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_image',
			[
				'label' => __( 'Image', 'onwork-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'range' => [
					'%' => [
						'min' => 20,
						'max' => 100,
					],
					'px' => [
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .member-figure' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Bottom Spacing', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .member-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .member-figure img'
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .member-figure img'
			]
		);

		$this->add_control(
			'image_bg_color',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-figure img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => __( 'Name, Designation & Bio', 'onwork-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Name', 'onwork-core' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-name, .member-name a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Text Hover Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-name, .member-name a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .member-name, .member-name a'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .member-name, .member-name a',
			]
		);

		$this->add_control(
			'_heading_job_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Designation', 'onwork-core' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'job_title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_title_color',
			[
				'label' => __( 'Text Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-position' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_title_typography',
				'selector' => '{{WRAPPER}} .member-position',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'job_title_text_shadow',
				'selector' => '{{WRAPPER}} .member-position',
			]
		);

		$this->add_control(
			'_heading_bio',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Short Bio', 'onwork-core' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'bio_spacing',
			[
				'label' => __( 'Bottom Spacing', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-bio' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bio_color',
			[
				'label' => __( 'Text Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-bio' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'bio_typography',
				'selector' => '{{WRAPPER}} .member-bio',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'bio_text_shadow',
				'selector' => '{{WRAPPER}} .member-bio',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_social',
			[
				'label' => __( 'Social Icons', 'onwork-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'social_wrap_padding',
			[
				'label' => __( 'Area Padding', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-wrap .member-links' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'social_area_width',
			[
				'label' => __( 'Area Width', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-wrap .member-links' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_bottom_space',
			[
				'label' => __( 'Area Bottom Spacing', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-wrap:hover .member-links' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'social_are_bg_color',
			[
				'label' => __( 'Area Background', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-wrap .member-links' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_spacing',
			[
				'label' => __( 'Icon Spacing', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'links_width',
			[
				'label' => __( 'Icon Width', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_height',
			[
				'label' => __( 'Icon Height', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_line_height',
			[
				'label' => __( 'Icon Line Height', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_icon_size',
			[
				'label' => __( 'Icon Size', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'links_border',
				'selector' => '{{WRAPPER}} .member-links > a'
			]
		);

		$this->add_responsive_control(
			'links_border_radius',
			[
				'label' => __( 'Border Radius', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( '_tab_links_colors' );
		$this->start_controls_tab(
			'_tab_links_normal',
			[
				'label' => __( 'Normal', 'onwork-core' ),
			]
		);

		$this->add_control(
			'links_color',
			[
				'label' => __( 'Text Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_bg_color',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_links_hover',
			[
				'label' => __( 'Hover', 'onwork-core' ),
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label' => __( 'Text Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a:hover, {{WRAPPER}} .member-links > a:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'links_hover_bg_color',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a:hover, {{WRAPPER}} .member-links > a:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'links_hover_border_color',
			[
				'label' => __( 'Border Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a:hover, {{WRAPPER}} .member-links > a:focus' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'links_border_border!' => '',
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'member-name' );

		$this->add_inline_editing_attributes( 'job_title', 'basic' );
		$this->add_render_attribute( 'job_title', 'class', 'member-position' );

		$this->add_inline_editing_attributes( 'bio', 'intermediate' );
		$this->add_render_attribute( 'bio', 'class', 'member-bio' );
		?>

		<div class="member-wrap">
			<div class="member-image">
				<?php if ( $settings['image']['url'] || $settings['image']['id'] ) :
					$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
					?>
					<figure class="member-figure">
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
					</figure>
				<?php endif; ?>
				<?php if ( $settings['show_profiles' ] && is_array( $settings['profiles' ] ) ) : ?>
					<div class="member-links">
						<?php
						foreach ( $settings['profiles'] as $profile ) :
							$icon = $profile['name'];
							$url = $profile['link']['url'];

							if ( $profile['name'] === 'website' ) {
								$icon = 'globe far';
							} elseif ( $profile['name'] === 'email' ) {
								$icon = 'envelope far';
								$url = 'mailto:' . antispambot( $profile['email'] );
							} else {
								$icon .= ' fab';
							}

							printf( '<a target="_blank" rel="noopener" href="%s" class="elementor-repeater-item-%s"><i class="fa fa-%s" aria-hidden="true"></i></a>',
								$url,
								esc_attr( $profile['_id'] ),
								esc_attr( $icon )
							);
						endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="member-body">
				<?php
					$target = $settings['title_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $settings['title_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
				<?php if ( !empty($settings['title']) && !empty($settings['title_link']['url']) ) :?>
					<h4 class="member-name"><?php echo '<a href="' . esc_attr($settings['title_link']['url']). '"' . $target . $nofollow . '>'.esc_html($settings['title']).'</a>';?></h4>
				<?php else:?>
					<h4 class="member-name"><?php echo esc_html($settings['title'])?></h4>
				<?php endif; ?>

				<?php if ( $settings['job_title' ] ) : ?>
					<div <?php $this->print_render_attribute_string( 'job_title' ); ?>><?php echo onwork_kses_basic( $settings['job_title' ] ); ?></div>
				<?php endif; ?>

				<?php if ( $settings['bio'] ) : ?>
					<div <?php $this->print_render_attribute_string( 'bio' ); ?>>
						<p><?php echo onwork_kses_intermediate( $settings['bio'] ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
