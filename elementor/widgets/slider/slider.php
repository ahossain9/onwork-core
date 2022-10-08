<?php
/**
 * onwork_core step flow widget for elementor
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
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;
// Exit if accessed directly

class Slider extends Widget_Base {

    public function get_name() {
        return 'onwork-slider';
    }

    public function get_title() {
        return __( 'Slider', 'onwork-core' );
    }

    public function get_icon() {
        return 'emexso-icon eicon-slides';
    }

    public function get_categories() {
        return [ 'onwork_core' ];
    }

    public function get_script_depends() {
        return [
            'onwork-script',
        ];
    }

    public function get_keywords() {
        return [
            'slider',
            'carousel',
            'onwork slider',
            'slider show',
            'slidershow',
            'onwork'
        ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'slider_image',
            [
                'label' => __( 'Image', 'onwork-core' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'slider_image_size',
                'default' => 'large',
            ]
        );
        $repeater->add_control(
			'show_slider_bg_image',
			[
				'label' => __( 'Show Background Image', 'onwork-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'onwork-core' ),
				'label_off' => __( 'Hide', 'onwork-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $repeater->add_control(
            'slider_bg_image',
            [
                'label' => __( 'Background Image', 'onwork-core' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'show_slider_bg_image' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'slider_sub_title', [
                'label'       => __( 'Sub Title', 'onwork-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Limited Time Offer', 'onwork-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'slider_title', [
                'label'       => __( 'Title', 'onwork-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Best Fashionable Digital Watch.', 'onwork-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'slider_description', [
                'label'      => __( 'Description', 'onwork-core' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'onwork-core' ),
                'show_label' => false,
            ]
        );
        $repeater->add_control(
			'left_button_text', [
				'label'       => __( 'Left Button Text', 'onwork-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Button Text' , 'onwork-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'left_button_link',
			[
				'label'         => __( 'Left Button Url', 'plugin-domain' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'onwork-core' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);
        $repeater->add_control(
			'right_button_text', [
				'label'       => __( 'Right Button Text', 'onwork-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Button Text' , 'onwork-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'right_button_link',
			[
				'label'         => __( 'Right Button Url', 'plugin-domain' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'onwork-core' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);
        $this->add_control(
            'slider_item',
            [
                'label'   => __( 'Slider Item', 'onwork-core' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'slider_sub_title'   => __( 'Slider Sub Title 1', 'onwork-core' ),
                        'slider_title'       => __( 'Slider Title 1', 'onwork-core' ),
                        'slider_description' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'onwork-core' ),
                    ],
                    [
                        'slider_sub_title'   => __( 'Slider Sub Title 2', 'onwork-core' ),
                        'slider_title'       => __( 'Slider Title 2', 'onwork-core' ),
                        'slider_description' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'onwork-core' ),
                    ],
                ],
                'title_field' => '{{{ slider_title }}}',
            ]
        );
        $this->end_controls_section();

        // Slider setting
        $this->start_controls_section(
            'slider_options',
            [
                'label' => esc_html__( 'Slider Options', 'onwork-core' ),
            ]
        );
        $this->add_control(
            'slider_in_animation',
            [
                'label' => __( 'In Animation', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','onwork-core' ),
                    'fadeInDown'         => __( 'Fade In Down','onwork-core' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','onwork-core' ),
                    'fadeInLeft'         => __( 'Fade In Left','onwork-core' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','onwork-core' ),
                    'fadeInRight'        => __( 'Fade In Right','onwork-core' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','onwork-core' ),
                    'fadeInUp'           => __( 'Fade In Up','onwork-core' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','onwork-core' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','onwork-core' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','onwork-core' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','onwork-core' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','onwork-core' ),
                    'fadeOut'            => __( 'Fade Out','onwork-core' ),
                    'fadeOutDown'        => __( 'Fade Out Down','onwork-core' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','onwork-core' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','onwork-core' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','onwork-core' ),
                    'fadeOutRight'       => __( 'Fade Out Right','onwork-core' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','onwork-core' ),
                    'fadeOutUp'          => __( 'Fade Out Up','onwork-core' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','onwork-core' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','onwork-core' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','onwork-core' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','onwork-core' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','onwork-core' ),
                    'bounce'             => __( 'Bounce','onwork-core' ),
                    'flash'              => __( 'Flash','onwork-core' ),
                    'pulse'              => __( 'Pulse','onwork-core' ),
                    'rubberBand'         => __( 'Rubber Band','onwork-core' ),
                    'shakeX'             => __( 'ShakeX','onwork-core' ),
                    'shakeY'             => __( 'ShakeY','onwork-core' ),
                    'headShake'          => __( 'Head Shake','onwork-core' ),
                    'swing'              => __( 'Swing','onwork-core' ),
                    'tada'               => __( 'Tada','onwork-core' ),
                    'wobble'             => __( 'Wobble','onwork-core' ),
                    'heartBeat'          => __( 'Heart Beat','onwork-core' ),
                    'backInDown'         => __( 'Back In Down','onwork-core' ),
                    'backInLeft'         => __( 'Back In Left','onwork-core' ),
                    'backInRight'        => __( 'Back In Right','onwork-core' ),
                    'backInUp'           => __( 'Back In Up','onwork-core' ),
                    'backOutDown'        => __( 'Back Out Down','onwork-core' ),
                    'backOutLeft'        => __( 'Back Out Left','onwork-core' ),
                    'backOutRight'       => __( 'Back Out Right','onwork-core' ),
                    'backOutUp'          => __( 'Back Out Up','onwork-core' ),
                    'bounceIn'           => __( 'Bounce In','onwork-core' ),
                    'bounceInDown'       => __( 'Bounce In Down','onwork-core' ),
                    'bounceInLeft'       => __( 'Bounce In Left','onwork-core' ),
                    'bounceInRight'      => __( 'bounceInRight','onwork-core' ),
                    'bounceInUp'         => __( 'Bounce In Up','onwork-core' ),
                    'bounceOut'          => __( 'Bounce Out','onwork-core' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','onwork-core' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','onwork-core' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','onwork-core' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','onwork-core' ),
                    'flip'               => __( 'Flip','onwork-core' ),
                    'flipInX'            => __( 'Flip In X','onwork-core' ),
                    'flipInY'            => __( 'Flip In Y','onwork-core' ),
                    'flipOutX'           => __( 'Flip Out X','onwork-core' ),
                    'flipOutY'           => __( 'Flip Out Y','onwork-core' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','onwork-core' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','onwork-core' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','onwork-core' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','onwork-core' ),
                    'rotateIn'           => __( 'Rotate In','onwork-core' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','onwork-core' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','onwork-core' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','onwork-core' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','onwork-core' ),
                    'rotateOut'          => __( 'Rotate Out','onwork-core' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','onwork-core' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','onwork-core' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','onwork-core' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','onwork-core' ),
                    'hinge'              => __( 'Hinge','onwork-core' ),
                    'jackInTheBox'       => __( 'Jack In The Box','onwork-core' ),
                    'rollIn'             => __( 'Roll In','onwork-core' ),
                    'rollOut'            => __( 'Roll Out','onwork-core' ),
                    'zoomIn'             => __( 'Zoom In','onwork-core' ),
                    'zoomInDown'         => __( 'Zoom In Down','onwork-core' ),
                    'zoomInLeft'         => __( 'Zoom In Left','onwork-core' ),
                    'zoomInRight'        => __( 'Zoom In Right','onwork-core' ),
                    'zoomInUp'           => __( 'Zoom In Up','onwork-core' ),
                    'zoomOut'            => __( 'Zoom Out','onwork-core' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','onwork-core' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','onwork-core' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','onwork-core' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','onwork-core' ),
                    'slideInDown'        => __( 'Slide In Down','onwork-core' ),
                    'slideInLeft'        => __( 'Slide In Left','onwork-core' ),
                    'slideInRight'       => __( 'Slide In Right','onwork-core' ),
                    'slideInUp'          => __( 'Slide In Up','onwork-core' ),
                    'slideOutDown'       => __( 'Slide Out Down','onwork-core' ),
                    'slideOutLeft'       => __( 'Slide Out Left','onwork-core' ),
                    'slideOutRight'      => __( 'Slide Out Right','onwork-core' ),
                    'slideOutUp'         => __( 'Slide Out Up','onwork-core' ),
                ],
                'condition' => [
                    'show_desc_animation' => 'yes',
                ],
                'default'   => 'fadeIn',
            ]
        );
        $this->add_control(
            'slider_out_animation',
            [
                'label' => __( 'Out Animation', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','onwork-core' ),
                    'fadeInDown'         => __( 'Fade In Down','onwork-core' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','onwork-core' ),
                    'fadeInLeft'         => __( 'Fade In Left','onwork-core' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','onwork-core' ),
                    'fadeInRight'        => __( 'Fade In Right','onwork-core' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','onwork-core' ),
                    'fadeInUp'           => __( 'Fade In Up','onwork-core' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','onwork-core' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','onwork-core' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','onwork-core' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','onwork-core' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','onwork-core' ),
                    'fadeOut'            => __( 'Fade Out','onwork-core' ),
                    'fadeOutDown'        => __( 'Fade Out Down','onwork-core' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','onwork-core' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','onwork-core' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','onwork-core' ),
                    'fadeOutRight'       => __( 'Fade Out Right','onwork-core' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','onwork-core' ),
                    'fadeOutUp'          => __( 'Fade Out Up','onwork-core' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','onwork-core' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','onwork-core' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','onwork-core' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','onwork-core' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','onwork-core' ),
                    'bounce'             => __( 'Bounce','onwork-core' ),
                    'flash'              => __( 'Flash','onwork-core' ),
                    'pulse'              => __( 'Pulse','onwork-core' ),
                    'rubberBand'         => __( 'Rubber Band','onwork-core' ),
                    'shakeX'             => __( 'ShakeX','onwork-core' ),
                    'shakeY'             => __( 'ShakeY','onwork-core' ),
                    'headShake'          => __( 'Head Shake','onwork-core' ),
                    'swing'              => __( 'Swing','onwork-core' ),
                    'tada'               => __( 'Tada','onwork-core' ),
                    'wobble'             => __( 'Wobble','onwork-core' ),
                    'heartBeat'          => __( 'Heart Beat','onwork-core' ),
                    'backInDown'         => __( 'Back In Down','onwork-core' ),
                    'backInLeft'         => __( 'Back In Left','onwork-core' ),
                    'backInRight'        => __( 'Back In Right','onwork-core' ),
                    'backInUp'           => __( 'Back In Up','onwork-core' ),
                    'backOutDown'        => __( 'Back Out Down','onwork-core' ),
                    'backOutLeft'        => __( 'Back Out Left','onwork-core' ),
                    'backOutRight'       => __( 'Back Out Right','onwork-core' ),
                    'backOutUp'          => __( 'Back Out Up','onwork-core' ),
                    'bounceIn'           => __( 'Bounce In','onwork-core' ),
                    'bounceInDown'       => __( 'Bounce In Down','onwork-core' ),
                    'bounceInLeft'       => __( 'Bounce In Left','onwork-core' ),
                    'bounceInRight'      => __( 'bounceInRight','onwork-core' ),
                    'bounceInUp'         => __( 'Bounce In Up','onwork-core' ),
                    'bounceOut'          => __( 'Bounce Out','onwork-core' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','onwork-core' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','onwork-core' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','onwork-core' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','onwork-core' ),
                    'flip'               => __( 'Flip','onwork-core' ),
                    'flipInX'            => __( 'Flip In X','onwork-core' ),
                    'flipInY'            => __( 'Flip In Y','onwork-core' ),
                    'flipOutX'           => __( 'Flip Out X','onwork-core' ),
                    'flipOutY'           => __( 'Flip Out Y','onwork-core' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','onwork-core' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','onwork-core' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','onwork-core' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','onwork-core' ),
                    'rotateIn'           => __( 'Rotate In','onwork-core' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','onwork-core' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','onwork-core' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','onwork-core' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','onwork-core' ),
                    'rotateOut'          => __( 'Rotate Out','onwork-core' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','onwork-core' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','onwork-core' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','onwork-core' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','onwork-core' ),
                    'hinge'              => __( 'Hinge','onwork-core' ),
                    'jackInTheBox'       => __( 'Jack In The Box','onwork-core' ),
                    'rollIn'             => __( 'Roll In','onwork-core' ),
                    'rollOut'            => __( 'Roll Out','onwork-core' ),
                    'zoomIn'             => __( 'Zoom In','onwork-core' ),
                    'zoomInDown'         => __( 'Zoom In Down','onwork-core' ),
                    'zoomInLeft'         => __( 'Zoom In Left','onwork-core' ),
                    'zoomInRight'        => __( 'Zoom In Right','onwork-core' ),
                    'zoomInUp'           => __( 'Zoom In Up','onwork-core' ),
                    'zoomOut'            => __( 'Zoom Out','onwork-core' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','onwork-core' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','onwork-core' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','onwork-core' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','onwork-core' ),
                    'slideInDown'        => __( 'Slide In Down','onwork-core' ),
                    'slideInLeft'        => __( 'Slide In Left','onwork-core' ),
                    'slideInRight'       => __( 'Slide In Right','onwork-core' ),
                    'slideInUp'          => __( 'Slide In Up','onwork-core' ),
                    'slideOutDown'       => __( 'Slide Out Down','onwork-core' ),
                    'slideOutLeft'       => __( 'Slide Out Left','onwork-core' ),
                    'slideOutRight'      => __( 'Slide Out Right','onwork-core' ),
                    'slideOutUp'         => __( 'Slide Out Up','onwork-core' ),
                ],
                'condition' => [
                    'show_desc_animation' => 'yes',
                ],
                'default'   => 'fadeOut',
            ]
        );
        $this->add_control(
            'slider_items',
            [
                'label'   => esc_html__( 'Slider Items', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 5,
                'step'    => 1,
                'default' => 1
            ]
        );
        $this->add_control(
            'slider_arrows',
            [
                'label'        => esc_html__( 'Slider Arrow', 'onwork-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );
        $this->add_control(
            'slider_dots',
            [
                'label' => esc_html__( 'Slider Dots', 'onwork-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'slider_pause_on_hover',
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
            'slider_centermode',
            [
                'label'        => esc_html__( 'Center Mode', 'onwork-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'slider_centerpadding',
            [
                'label'     => esc_html__( 'Center padding', 'onwork-core' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 500,
                'step'      => 1,
                'default'   => 50,
                'condition' => [
                    'slcentermode' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'slider_autolay',
            [
                'label'        => esc_html__( 'Slider Autoplay', 'onwork-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator'    => 'before',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => __( 'Autoplay Speed', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
        $this->add_control(
            'slider_animation_speed',
            [
                'label'   => __( 'Autoplay Animation speed', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
        $this->add_control(
            'heading_tablet',
            [
                'label'     => __( 'Tablet', 'onwork-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'slider_tablet_display_items',
            [
                'label'   => __( 'Slider Items', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 3,
                'step'    => 1,
                'default' => 1,
            ]
        );
        $this->add_control(
            'slider_heading_mobile',
            [
                'label'     => __( 'Mobile Phone', 'onwork-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'slider_mobile_display_items',
            [
                'label'   => __( 'Slider Items', 'onwork-core' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 4,
                'step'    => 1,
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
            'slider_global_padding',
            [
                'label'      => __( 'Padding', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_global_bg_color',
            [
                'label' => __( 'Background Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-single' => 'background-color: {{VALUE}}',
                ],
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
        $this->add_control(
            'slider_img_title_heading',
            [
                'label' => __( 'Slide Image', 'onwork-core' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_responsive_control(
            'slider_img_padding',
            [
                'label'      => __( 'Padding', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_img_border',
            [
                'label'      => __( 'Border Radius', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slider_bg_img_title_heading',
            [
                'label' => __( 'Background Image', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'slider_bg_image_size',
            [
                'label' => __( 'Background Size', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => __( 'Cover', 'onwork-core' ),
                    'contain' => __( 'Contain', 'onwork-core' ),
                    'auto' => __( 'Auto', 'onwork-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-single' => 'background-size: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'slider_bg_image_position',
            [
                'label' => __( 'Position', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'left top' => __( 'left top','onwork-core' ),
                    'left center' => __( 'left center', 'onwork-core' ),
                    'left bottom' => __( 'left bottom', 'onwork-core' ),
                    'right top' => __( 'right top', 'onwork-core' ),
                    'right center' => __( 'right center', 'onwork-core' ),
                    'right bottom' => __( 'right bottom', 'onwork-core' ),
                    'center top' => __( 'center top', 'onwork-core' ),
                    'center center' => __( 'center center', 'onwork-core' ),
                    'center bottom' => __( 'center bottom', 'onwork-core' ),
                    'initial' => __( 'initial', 'onwork-core' ),
                    'inherit' => __( 'inherit', 'onwork-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-single' => 'background-position: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'show_slider_bg_img_overlay',
            [
                'label' => __( 'Background Overlay', 'onwork-core' ),
                'type' => Controls_Manager::SWITCHER,
                // 'separator' => 'before',
                'label_on' => __( 'Show', 'onwork-core' ),
				'label_off' => __( 'Hide', 'onwork-core' ),
				'return_value' => 'yes',
				'default' => 'no',
            ]
        );
        $this->add_control(
            'slider_bg_img_overlay_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-single:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_slider_bg_img_overlay' => 'yes',
                ]
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
            'slider_content_padding',
            [
                'label'      => __( 'Padding', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_content_align',
            [
                'label'   => __( 'Alignment', 'onwork-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'onwork-core' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __( 'Center', 'onwork-core' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'onwork-core' ),
                        'icon'  => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .slider-content.image-none' => 'text-align: {{VALUE}};',
                ],
                'default'   => 'left',
            ]
        );
        $this->add_responsive_control(
            'content_width',
            [
                'label'      => __( 'Width', 'onwork-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content.image' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slider-content.image-none' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_sub_title_heading',
            [
                'label' => __( 'Sub Title', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'slider_sub_title_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-content h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_sub_title_typography',
                'label' => __( 'Typography', 'onwork-core' ),
                'selector' => '{{WRAPPER}} .slider-content h4',
            ]
        );
        $this->add_responsive_control(
            'slider_sub_title_spacing',
            [
                'label' => __( 'Spacing', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .slider-content h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'show_sub_title_animation',
			[
				'label' => __( 'Show Animation', 'onwork-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'onwork-core' ),
				'label_off' => __( 'Hide', 'onwork-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'slider_sub_title_animation',
            [
                'label' => __( 'Animation', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','onwork-core' ),
                    'fadeInDown'         => __( 'Fade In Down','onwork-core' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','onwork-core' ),
                    'fadeInLeft'         => __( 'Fade In Left','onwork-core' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','onwork-core' ),
                    'fadeInRight'        => __( 'Fade In Right','onwork-core' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','onwork-core' ),
                    'fadeInUp'           => __( 'Fade In Up','onwork-core' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','onwork-core' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','onwork-core' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','onwork-core' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','onwork-core' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','onwork-core' ),
                    'fadeOut'            => __( 'Fade Out','onwork-core' ),
                    'fadeOutDown'        => __( 'Fade Out Down','onwork-core' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','onwork-core' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','onwork-core' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','onwork-core' ),
                    'fadeOutRight'       => __( 'Fade Out Right','onwork-core' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','onwork-core' ),
                    'fadeOutUp'          => __( 'Fade Out Up','onwork-core' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','onwork-core' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','onwork-core' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','onwork-core' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','onwork-core' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','onwork-core' ),
                    'bounce'             => __( 'Bounce','onwork-core' ),
                    'flash'              => __( 'Flash','onwork-core' ),
                    'pulse'              => __( 'Pulse','onwork-core' ),
                    'rubberBand'         => __( 'Rubber Band','onwork-core' ),
                    'shakeX'             => __( 'ShakeX','onwork-core' ),
                    'shakeY'             => __( 'ShakeY','onwork-core' ),
                    'headShake'          => __( 'Head Shake','onwork-core' ),
                    'swing'              => __( 'Swing','onwork-core' ),
                    'tada'               => __( 'Tada','onwork-core' ),
                    'wobble'             => __( 'Wobble','onwork-core' ),
                    'heartBeat'          => __( 'Heart Beat','onwork-core' ),
                    'backInDown'         => __( 'Back In Down','onwork-core' ),
                    'backInLeft'         => __( 'Back In Left','onwork-core' ),
                    'backInRight'        => __( 'Back In Right','onwork-core' ),
                    'backInUp'           => __( 'Back In Up','onwork-core' ),
                    'backOutDown'        => __( 'Back Out Down','onwork-core' ),
                    'backOutLeft'        => __( 'Back Out Left','onwork-core' ),
                    'backOutRight'       => __( 'Back Out Right','onwork-core' ),
                    'backOutUp'          => __( 'Back Out Up','onwork-core' ),
                    'bounceIn'           => __( 'Bounce In','onwork-core' ),
                    'bounceInDown'       => __( 'Bounce In Down','onwork-core' ),
                    'bounceInLeft'       => __( 'Bounce In Left','onwork-core' ),
                    'bounceInRight'      => __( 'bounceInRight','onwork-core' ),
                    'bounceInUp'         => __( 'Bounce In Up','onwork-core' ),
                    'bounceOut'          => __( 'Bounce Out','onwork-core' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','onwork-core' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','onwork-core' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','onwork-core' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','onwork-core' ),
                    'flip'               => __( 'Flip','onwork-core' ),
                    'flipInX'            => __( 'Flip In X','onwork-core' ),
                    'flipInY'            => __( 'Flip In Y','onwork-core' ),
                    'flipOutX'           => __( 'Flip Out X','onwork-core' ),
                    'flipOutY'           => __( 'Flip Out Y','onwork-core' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','onwork-core' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','onwork-core' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','onwork-core' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','onwork-core' ),
                    'rotateIn'           => __( 'Rotate In','onwork-core' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','onwork-core' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','onwork-core' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','onwork-core' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','onwork-core' ),
                    'rotateOut'          => __( 'Rotate Out','onwork-core' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','onwork-core' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','onwork-core' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','onwork-core' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','onwork-core' ),
                    'hinge'              => __( 'Hinge','onwork-core' ),
                    'jackInTheBox'       => __( 'Jack In The Box','onwork-core' ),
                    'rollIn'             => __( 'Roll In','onwork-core' ),
                    'rollOut'            => __( 'Roll Out','onwork-core' ),
                    'zoomIn'             => __( 'Zoom In','onwork-core' ),
                    'zoomInDown'         => __( 'Zoom In Down','onwork-core' ),
                    'zoomInLeft'         => __( 'Zoom In Left','onwork-core' ),
                    'zoomInRight'        => __( 'Zoom In Right','onwork-core' ),
                    'zoomInUp'           => __( 'Zoom In Up','onwork-core' ),
                    'zoomOut'            => __( 'Zoom Out','onwork-core' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','onwork-core' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','onwork-core' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','onwork-core' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','onwork-core' ),
                    'slideInDown'        => __( 'Slide In Down','onwork-core' ),
                    'slideInLeft'        => __( 'Slide In Left','onwork-core' ),
                    'slideInRight'       => __( 'Slide In Right','onwork-core' ),
                    'slideInUp'          => __( 'Slide In Up','onwork-core' ),
                    'slideOutDown'       => __( 'Slide Out Down','onwork-core' ),
                    'slideOutLeft'       => __( 'Slide Out Left','onwork-core' ),
                    'slideOutRight'      => __( 'Slide Out Right','onwork-core' ),
                    'slideOutUp'         => __( 'Slide Out Up','onwork-core' ),
                ],
                'condition' => [
                    'show_sub_title_animation' => 'yes',
                ],
                'default'   => 'fadeInUp',
            ]
        );
        $this->add_control(
            'slider_sub_title_anim_duartion',
            [
                'label' => __( 'Animation Duration', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'show_sub_title_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_sub_title_anim_delay',
            [
                'label' => __( 'Animation Delay', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 200,
                'condition' => [
                    'show_sub_title_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_title_heading',
            [
                'label' => __( 'Title', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'slider_title_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-content h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_title_typography',
                'label' => __( 'Typography', 'onwork-core' ),
                'selector' => '{{WRAPPER}} .slider-content h2',
            ]
        );
        $this->add_responsive_control(
            'slider_title_spacing',
            [
                'label' => __( 'Spacing', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .slider-content h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'show_title_animation',
			[
				'label' => __( 'Show Animation', 'onwork-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'onwork-core' ),
				'label_off' => __( 'Hide', 'onwork-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'slider_title_animation',
            [
                'label' => __( 'Animation', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','onwork-core' ),
                    'fadeInDown'         => __( 'Fade In Down','onwork-core' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','onwork-core' ),
                    'fadeInLeft'         => __( 'Fade In Left','onwork-core' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','onwork-core' ),
                    'fadeInRight'        => __( 'Fade In Right','onwork-core' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','onwork-core' ),
                    'fadeInUp'           => __( 'Fade In Up','onwork-core' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','onwork-core' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','onwork-core' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','onwork-core' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','onwork-core' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','onwork-core' ),
                    'fadeOut'            => __( 'Fade Out','onwork-core' ),
                    'fadeOutDown'        => __( 'Fade Out Down','onwork-core' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','onwork-core' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','onwork-core' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','onwork-core' ),
                    'fadeOutRight'       => __( 'Fade Out Right','onwork-core' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','onwork-core' ),
                    'fadeOutUp'          => __( 'Fade Out Up','onwork-core' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','onwork-core' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','onwork-core' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','onwork-core' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','onwork-core' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','onwork-core' ),
                    'bounce'             => __( 'Bounce','onwork-core' ),
                    'flash'              => __( 'Flash','onwork-core' ),
                    'pulse'              => __( 'Pulse','onwork-core' ),
                    'rubberBand'         => __( 'Rubber Band','onwork-core' ),
                    'shakeX'             => __( 'ShakeX','onwork-core' ),
                    'shakeY'             => __( 'ShakeY','onwork-core' ),
                    'headShake'          => __( 'Head Shake','onwork-core' ),
                    'swing'              => __( 'Swing','onwork-core' ),
                    'tada'               => __( 'Tada','onwork-core' ),
                    'wobble'             => __( 'Wobble','onwork-core' ),
                    'heartBeat'          => __( 'Heart Beat','onwork-core' ),
                    'backInDown'         => __( 'Back In Down','onwork-core' ),
                    'backInLeft'         => __( 'Back In Left','onwork-core' ),
                    'backInRight'        => __( 'Back In Right','onwork-core' ),
                    'backInUp'           => __( 'Back In Up','onwork-core' ),
                    'backOutDown'        => __( 'Back Out Down','onwork-core' ),
                    'backOutLeft'        => __( 'Back Out Left','onwork-core' ),
                    'backOutRight'       => __( 'Back Out Right','onwork-core' ),
                    'backOutUp'          => __( 'Back Out Up','onwork-core' ),
                    'bounceIn'           => __( 'Bounce In','onwork-core' ),
                    'bounceInDown'       => __( 'Bounce In Down','onwork-core' ),
                    'bounceInLeft'       => __( 'Bounce In Left','onwork-core' ),
                    'bounceInRight'      => __( 'bounceInRight','onwork-core' ),
                    'bounceInUp'         => __( 'Bounce In Up','onwork-core' ),
                    'bounceOut'          => __( 'Bounce Out','onwork-core' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','onwork-core' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','onwork-core' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','onwork-core' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','onwork-core' ),
                    'flip'               => __( 'Flip','onwork-core' ),
                    'flipInX'            => __( 'Flip In X','onwork-core' ),
                    'flipInY'            => __( 'Flip In Y','onwork-core' ),
                    'flipOutX'           => __( 'Flip Out X','onwork-core' ),
                    'flipOutY'           => __( 'Flip Out Y','onwork-core' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','onwork-core' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','onwork-core' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','onwork-core' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','onwork-core' ),
                    'rotateIn'           => __( 'Rotate In','onwork-core' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','onwork-core' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','onwork-core' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','onwork-core' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','onwork-core' ),
                    'rotateOut'          => __( 'Rotate Out','onwork-core' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','onwork-core' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','onwork-core' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','onwork-core' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','onwork-core' ),
                    'hinge'              => __( 'Hinge','onwork-core' ),
                    'jackInTheBox'       => __( 'Jack In The Box','onwork-core' ),
                    'rollIn'             => __( 'Roll In','onwork-core' ),
                    'rollOut'            => __( 'Roll Out','onwork-core' ),
                    'zoomIn'             => __( 'Zoom In','onwork-core' ),
                    'zoomInDown'         => __( 'Zoom In Down','onwork-core' ),
                    'zoomInLeft'         => __( 'Zoom In Left','onwork-core' ),
                    'zoomInRight'        => __( 'Zoom In Right','onwork-core' ),
                    'zoomInUp'           => __( 'Zoom In Up','onwork-core' ),
                    'zoomOut'            => __( 'Zoom Out','onwork-core' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','onwork-core' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','onwork-core' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','onwork-core' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','onwork-core' ),
                    'slideInDown'        => __( 'Slide In Down','onwork-core' ),
                    'slideInLeft'        => __( 'Slide In Left','onwork-core' ),
                    'slideInRight'       => __( 'Slide In Right','onwork-core' ),
                    'slideInUp'          => __( 'Slide In Up','onwork-core' ),
                    'slideOutDown'       => __( 'Slide Out Down','onwork-core' ),
                    'slideOutLeft'       => __( 'Slide Out Left','onwork-core' ),
                    'slideOutRight'      => __( 'Slide Out Right','onwork-core' ),
                    'slideOutUp'         => __( 'Slide Out Up','onwork-core' ),
                ],
                'condition' => [
                    'show_title_animation' => 'yes',
                ],
                'default'   => 'fadeInUp',
            ]
        );
        $this->add_control(
            'slider_title_anim_duartion',
            [
                'label' => __( 'Animation Duration', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'show_title_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_title_anim_delay',
            [
                'label' => __( 'Animation Delay', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 400,
                'condition' => [
                    'show_title_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_desc_heading',
            [
                'label' => __( 'Description', 'onwork-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'slider_desc_padding',
            [
                'label'      => __( 'Padding', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_desc_color',
            [
                'label' => __( 'Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-description' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_desc_typography',
                'label' => __( 'Typography', 'onwork-core' ),
                'selector' => '{{WRAPPER}} .slider-description,{{WRAPPER}} .slider-description p',
            ]
        );
        $this->add_responsive_control(
            'slider_desc_spacing',
            [
                'label' => __( 'Spacing', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .slider-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'show_desc_animation',
			[
				'label' => __( 'Show Animation', 'onwork-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'onwork-core' ),
				'label_off' => __( 'Hide', 'onwork-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'slider_desc_animation',
            [
                'label' => __( 'Animation', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','onwork-core' ),
                    'fadeInDown'         => __( 'Fade In Down','onwork-core' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','onwork-core' ),
                    'fadeInLeft'         => __( 'Fade In Left','onwork-core' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','onwork-core' ),
                    'fadeInRight'        => __( 'Fade In Right','onwork-core' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','onwork-core' ),
                    'fadeInUp'           => __( 'Fade In Up','onwork-core' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','onwork-core' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','onwork-core' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','onwork-core' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','onwork-core' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','onwork-core' ),
                    'fadeOut'            => __( 'Fade Out','onwork-core' ),
                    'fadeOutDown'        => __( 'Fade Out Down','onwork-core' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','onwork-core' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','onwork-core' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','onwork-core' ),
                    'fadeOutRight'       => __( 'Fade Out Right','onwork-core' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','onwork-core' ),
                    'fadeOutUp'          => __( 'Fade Out Up','onwork-core' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','onwork-core' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','onwork-core' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','onwork-core' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','onwork-core' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','onwork-core' ),
                    'bounce'             => __( 'Bounce','onwork-core' ),
                    'flash'              => __( 'Flash','onwork-core' ),
                    'pulse'              => __( 'Pulse','onwork-core' ),
                    'rubberBand'         => __( 'Rubber Band','onwork-core' ),
                    'shakeX'             => __( 'ShakeX','onwork-core' ),
                    'shakeY'             => __( 'ShakeY','onwork-core' ),
                    'headShake'          => __( 'Head Shake','onwork-core' ),
                    'swing'              => __( 'Swing','onwork-core' ),
                    'tada'               => __( 'Tada','onwork-core' ),
                    'wobble'             => __( 'Wobble','onwork-core' ),
                    'heartBeat'          => __( 'Heart Beat','onwork-core' ),
                    'backInDown'         => __( 'Back In Down','onwork-core' ),
                    'backInLeft'         => __( 'Back In Left','onwork-core' ),
                    'backInRight'        => __( 'Back In Right','onwork-core' ),
                    'backInUp'           => __( 'Back In Up','onwork-core' ),
                    'backOutDown'        => __( 'Back Out Down','onwork-core' ),
                    'backOutLeft'        => __( 'Back Out Left','onwork-core' ),
                    'backOutRight'       => __( 'Back Out Right','onwork-core' ),
                    'backOutUp'          => __( 'Back Out Up','onwork-core' ),
                    'bounceIn'           => __( 'Bounce In','onwork-core' ),
                    'bounceInDown'       => __( 'Bounce In Down','onwork-core' ),
                    'bounceInLeft'       => __( 'Bounce In Left','onwork-core' ),
                    'bounceInRight'      => __( 'bounceInRight','onwork-core' ),
                    'bounceInUp'         => __( 'Bounce In Up','onwork-core' ),
                    'bounceOut'          => __( 'Bounce Out','onwork-core' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','onwork-core' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','onwork-core' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','onwork-core' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','onwork-core' ),
                    'flip'               => __( 'Flip','onwork-core' ),
                    'flipInX'            => __( 'Flip In X','onwork-core' ),
                    'flipInY'            => __( 'Flip In Y','onwork-core' ),
                    'flipOutX'           => __( 'Flip Out X','onwork-core' ),
                    'flipOutY'           => __( 'Flip Out Y','onwork-core' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','onwork-core' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','onwork-core' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','onwork-core' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','onwork-core' ),
                    'rotateIn'           => __( 'Rotate In','onwork-core' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','onwork-core' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','onwork-core' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','onwork-core' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','onwork-core' ),
                    'rotateOut'          => __( 'Rotate Out','onwork-core' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','onwork-core' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','onwork-core' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','onwork-core' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','onwork-core' ),
                    'hinge'              => __( 'Hinge','onwork-core' ),
                    'jackInTheBox'       => __( 'Jack In The Box','onwork-core' ),
                    'rollIn'             => __( 'Roll In','onwork-core' ),
                    'rollOut'            => __( 'Roll Out','onwork-core' ),
                    'zoomIn'             => __( 'Zoom In','onwork-core' ),
                    'zoomInDown'         => __( 'Zoom In Down','onwork-core' ),
                    'zoomInLeft'         => __( 'Zoom In Left','onwork-core' ),
                    'zoomInRight'        => __( 'Zoom In Right','onwork-core' ),
                    'zoomInUp'           => __( 'Zoom In Up','onwork-core' ),
                    'zoomOut'            => __( 'Zoom Out','onwork-core' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','onwork-core' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','onwork-core' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','onwork-core' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','onwork-core' ),
                    'slideInDown'        => __( 'Slide In Down','onwork-core' ),
                    'slideInLeft'        => __( 'Slide In Left','onwork-core' ),
                    'slideInRight'       => __( 'Slide In Right','onwork-core' ),
                    'slideInUp'          => __( 'Slide In Up','onwork-core' ),
                    'slideOutDown'       => __( 'Slide Out Down','onwork-core' ),
                    'slideOutLeft'       => __( 'Slide Out Left','onwork-core' ),
                    'slideOutRight'      => __( 'Slide Out Right','onwork-core' ),
                    'slideOutUp'         => __( 'Slide Out Up','onwork-core' ),
                ],
                'condition' => [
                    'show_desc_animation' => 'yes',
                ],
                'default'   => 'fadeInUp',
            ]
        );
        $this->add_control(
            'slider_desc_anim_duartion',
            [
                'label' => __( 'Animation Duration', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'show_desc_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_desc_anim_delay',
            [
                'label' => __( 'Animation Delay', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'condition' => [
                    'show_desc_animation' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label' => __( 'Button', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'section_button_common_style',
            [
                'label'     => __( 'Common Style', 'onwork-core' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control(
            'slider_btn_spacing',
            [
                'label'      => __( 'Spacing', 'onwork-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-btn .slider_left_btn' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_button_typography',
                'label'    => __( 'Typography', 'onwork-core' ),
                'selector' => '{{WRAPPER}} .slider-btn a',
            ]
        );
        $this->start_controls_tabs(
            'slider_button_tabs'
        );
            $this->start_controls_tab(
                'slider_button_normal_tab',
                [
                    'label' => __( 'Normal', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'slider_button_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn a' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_button_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn a' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'slider_button_hover_tab',
                [
                    'label' => __( 'Hover', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'slider_button_hover_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn a:hover' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_button_hover_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn a:hover' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'slider_button_border',
                'label'     => __( 'Border', 'onwork-core' ),
                'selector'  => '{{WRAPPER}} .slider-btn a',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'slider_button_radius',
            [
                'label'      => __( 'Border Radius', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'slider_button_shadow',
                'label'    => __( 'Box Shadow', 'onwork-core' ),
                'selector' => '{{WRAPPER}} .slider-btn a',
            ]
        );

        $this->add_responsive_control(
            'slider_button_padding',
            [
                'label'      => __( 'Padding', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .slider-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
			'show_button_animation',
			[
				'label' => __( 'Show Animation', 'onwork-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'onwork-core' ),
				'label_off' => __( 'Hide', 'onwork-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'slider_button_animation',
            [
                'label' => __( 'Animation', 'onwork-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','onwork-core' ),
                    'fadeInDown'         => __( 'Fade In Down','onwork-core' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','onwork-core' ),
                    'fadeInLeft'         => __( 'Fade In Left','onwork-core' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','onwork-core' ),
                    'fadeInRight'        => __( 'Fade In Right','onwork-core' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','onwork-core' ),
                    'fadeInUp'           => __( 'Fade In Up','onwork-core' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','onwork-core' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','onwork-core' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','onwork-core' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','onwork-core' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','onwork-core' ),
                    'fadeOut'            => __( 'Fade Out','onwork-core' ),
                    'fadeOutDown'        => __( 'Fade Out Down','onwork-core' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','onwork-core' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','onwork-core' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','onwork-core' ),
                    'fadeOutRight'       => __( 'Fade Out Right','onwork-core' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','onwork-core' ),
                    'fadeOutUp'          => __( 'Fade Out Up','onwork-core' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','onwork-core' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','onwork-core' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','onwork-core' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','onwork-core' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','onwork-core' ),
                    'bounce'             => __( 'Bounce','onwork-core' ),
                    'flash'              => __( 'Flash','onwork-core' ),
                    'pulse'              => __( 'Pulse','onwork-core' ),
                    'rubberBand'         => __( 'Rubber Band','onwork-core' ),
                    'shakeX'             => __( 'ShakeX','onwork-core' ),
                    'shakeY'             => __( 'ShakeY','onwork-core' ),
                    'headShake'          => __( 'Head Shake','onwork-core' ),
                    'swing'              => __( 'Swing','onwork-core' ),
                    'tada'               => __( 'Tada','onwork-core' ),
                    'wobble'             => __( 'Wobble','onwork-core' ),
                    'heartBeat'          => __( 'Heart Beat','onwork-core' ),
                    'backInDown'         => __( 'Back In Down','onwork-core' ),
                    'backInLeft'         => __( 'Back In Left','onwork-core' ),
                    'backInRight'        => __( 'Back In Right','onwork-core' ),
                    'backInUp'           => __( 'Back In Up','onwork-core' ),
                    'backOutDown'        => __( 'Back Out Down','onwork-core' ),
                    'backOutLeft'        => __( 'Back Out Left','onwork-core' ),
                    'backOutRight'       => __( 'Back Out Right','onwork-core' ),
                    'backOutUp'          => __( 'Back Out Up','onwork-core' ),
                    'bounceIn'           => __( 'Bounce In','onwork-core' ),
                    'bounceInDown'       => __( 'Bounce In Down','onwork-core' ),
                    'bounceInLeft'       => __( 'Bounce In Left','onwork-core' ),
                    'bounceInRight'      => __( 'bounceInRight','onwork-core' ),
                    'bounceInUp'         => __( 'Bounce In Up','onwork-core' ),
                    'bounceOut'          => __( 'Bounce Out','onwork-core' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','onwork-core' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','onwork-core' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','onwork-core' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','onwork-core' ),
                    'flip'               => __( 'Flip','onwork-core' ),
                    'flipInX'            => __( 'Flip In X','onwork-core' ),
                    'flipInY'            => __( 'Flip In Y','onwork-core' ),
                    'flipOutX'           => __( 'Flip Out X','onwork-core' ),
                    'flipOutY'           => __( 'Flip Out Y','onwork-core' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','onwork-core' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','onwork-core' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','onwork-core' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','onwork-core' ),
                    'rotateIn'           => __( 'Rotate In','onwork-core' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','onwork-core' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','onwork-core' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','onwork-core' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','onwork-core' ),
                    'rotateOut'          => __( 'Rotate Out','onwork-core' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','onwork-core' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','onwork-core' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','onwork-core' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','onwork-core' ),
                    'hinge'              => __( 'Hinge','onwork-core' ),
                    'jackInTheBox'       => __( 'Jack In The Box','onwork-core' ),
                    'rollIn'             => __( 'Roll In','onwork-core' ),
                    'rollOut'            => __( 'Roll Out','onwork-core' ),
                    'zoomIn'             => __( 'Zoom In','onwork-core' ),
                    'zoomInDown'         => __( 'Zoom In Down','onwork-core' ),
                    'zoomInLeft'         => __( 'Zoom In Left','onwork-core' ),
                    'zoomInRight'        => __( 'Zoom In Right','onwork-core' ),
                    'zoomInUp'           => __( 'Zoom In Up','onwork-core' ),
                    'zoomOut'            => __( 'Zoom Out','onwork-core' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','onwork-core' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','onwork-core' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','onwork-core' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','onwork-core' ),
                    'slideInDown'        => __( 'Slide In Down','onwork-core' ),
                    'slideInLeft'        => __( 'Slide In Left','onwork-core' ),
                    'slideInRight'       => __( 'Slide In Right','onwork-core' ),
                    'slideInUp'          => __( 'Slide In Up','onwork-core' ),
                    'slideOutDown'       => __( 'Slide Out Down','onwork-core' ),
                    'slideOutLeft'       => __( 'Slide Out Left','onwork-core' ),
                    'slideOutRight'      => __( 'Slide Out Right','onwork-core' ),
                    'slideOutUp'         => __( 'Slide Out Up','onwork-core' ),
                ],
                'condition' => [
                    'show_button_animation' => 'yes',
                ],
                'default'   => 'fadeInUp',
            ]
        );
        $this->add_control(
            'slider_button_anim_duartion',
            [
                'label' => __( 'Animation Duration', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'show_button_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_button_anim_delay',
            [
                'label' => __( 'Animation Delay', 'onwork-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 800,
                'condition' => [
                    'show_button_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'section_right_button_style',
            [
                'label'     => __( 'Right Button', 'onwork-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs(
            'slider_right_button_tabs'
        );
            $this->start_controls_tab(
                'slider_right_button_normal_tab',
                [
                    'label' => __( 'Normal', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'slider_right_button_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn .slider_right_btn' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_right_button_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn .slider_right_btn' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'slider_right_button_hover_tab',
                [
                    'label' => __( 'Hover', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'slider_right_button_hover_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn .slider_right_btn:hover' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_right_button_hover_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn .slider_right_btn:hover' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_nav_style',
            [
                'label' => __( 'Navigation', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'slider_left_arrow_spacing',
            [
                'label' => __( 'Left Arrow Spacing', 'onwork-core' ),
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
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_right_arrow_spacing',
            [
                'label' => __( 'Right Arrow Spacing', 'onwork-core' ),
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
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'arrow_size',
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
					'{{WRAPPER}} .slider.owl-carousel .owl-nav > div i' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
        $this->start_controls_tabs(
            'slider_nav_tabs'
        );
            $this->start_controls_tab(
                'slider_nav_normal_tab',
                [
                    'label' => __( 'Normal', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'slider_nav_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div i' => 'color: {{VALUE}}'
                        ],
                    ]
                );

                $this->add_control(
                    'slider_nav_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'slider_nav_hover_tab',
                [
                    'label' => __( 'Hover', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'slider_nav_hover_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div i:hover' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_nav_hover_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div:hover' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'slider_nav_border',
                'label'     => __( 'Border', 'onwork-core' ),
                'selector'  => '{{WRAPPER}} .slider.owl-carousel .owl-nav > div',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'slider_nav_radius',
            [
                'label'      => __( 'Border Radius', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_nav_padding',
            [
                'label'      => __( 'Padding', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_dot_style',
            [
                'label' => __( 'Dots', 'onwork-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'slider_dot_width',
            [
                'label' => __( 'Width', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider .owl-dots .owl-dot' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_dot_height',
            [
                'label' => __( 'Height', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider .owl-dots .owl-dot' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_dot_spacing',
            [
                'label' => __( 'Spacing', 'onwork-core' ),
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
                    '{{WRAPPER}} .slider .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'slider_dot_tabs'
        );
            $this->start_controls_tab(
                'slider_dot_normal_tab',
                [
                    'label' => __( 'Normal', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'slider_dot_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'color: {{VALUE}}'
                        ],
                    ]
                );

                $this->add_control(
                    'slider_dot_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'slider_dot_hover_tab',
                [
                    'label' => __( 'Hover', 'onwork-core' ),
                ]
            );
                $this->add_control(
                    'slider_dot_hover_color',
                    [
                        'label'     => __( 'Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div:hover' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_dot_hover_bg_color',
                    [
                        'label'     => __( 'Background Color', 'onwork-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div:hover' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'slider_dot_border',
                'label'     => __( 'Border', 'onwork-core' ),
                'selector'  => '{{WRAPPER}} .slider.owl-carousel .owl-nav > div',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'slider_dot_radius',
            [
                'label'      => __( 'Border Radius', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_dot_padding',
            [
                'label'      => __( 'Padding', 'onwork-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $slider_settings = [
            'in_animation'    => $settings['slider_in_animation'],
            'out_animation'   => $settings['slider_out_animation'],
            'arrows'          => ( 'yes' === $settings['slider_arrows'] ),
            'dots'            => ( 'yes' === $settings['slider_dots'] ),
            'autoplay'        => ( 'yes' === $settings['slider_autolay'] ),
            'center_mode'     => ( 'yes' === $settings['slider_centermode'] ),
            'autoplay_speed'  => absint( $settings['slider_autoplay_speed'] ),
            'animation_speed' => absint( $settings['slider_animation_speed'] ),
            'pause_on_hover'  => ( 'yes' === $settings['slider_pause_on_hover'] ),
        ];

        $slider_responsive_settings = [
            'display_items'        => $settings['slider_items'],
            'tablet_display_items' => $settings['slider_tablet_display_items'],
            'mobile_display_items' => $settings['slider_mobile_display_items'],
        ];

        $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
        $this->add_render_attribute( 'slider_area_attr', 'class', 'slider owl-carousel' );
        $this->add_render_attribute( 'slider_area_attr', 'data-settings', wp_json_encode( $slider_settings ) );

        ?>
        <style>
            <?php if($settings['show_sub_title_animation'] == 'yes'):?>
            .owl-item.active .slider-content h4 {
                -webkit-animation: <?php echo $settings['slider_sub_title_anim_duartion'].'ms '.$settings['slider_sub_title_anim_delay'].'ms '.$settings['slider_sub_title_animation'];?> both;
                animation: <?php echo $settings['slider_sub_title_anim_duartion'].'ms '.$settings['slider_sub_title_anim_delay'].'ms '.$settings['slider_sub_title_animation'];?> both;
            }
            <?php endif;?>
            <?php if($settings['show_title_animation'] == 'yes'):?>
            .owl-item.active .slider-content h2 {
                -webkit-animation: <?php echo $settings['slider_title_anim_duartion'].'ms '.$settings['slider_title_anim_delay'].'ms '.$settings['slider_title_animation'];?> both;
                animation: <?php echo $settings['slider_title_anim_duartion'].'ms '.$settings['slider_title_anim_delay'].'ms '.$settings['slider_title_animation'];?> both;
            }
            <?php endif;?>
            <?php if($settings['show_desc_animation'] == 'yes'):?>
            .owl-item.active .slider-content .slider-description {
                -webkit-animation: <?php echo $settings['slider_desc_anim_duartion'].'ms '.$settings['slider_desc_anim_delay'].'ms '.$settings['slider_desc_animation'];?> both;
                animation: <?php echo $settings['slider_desc_anim_duartion'].'ms '.$settings['slider_desc_anim_delay'].'ms '.$settings['slider_desc_animation'];?> both;
            }
            <?php endif;?>
            <?php if($settings['show_button_animation'] == 'yes'):?>
            .owl-item.active .slider-content .slider-btn {
                -webkit-animation: <?php echo $settings['slider_button_anim_duartion'].'ms '.$settings['slider_button_anim_delay'].'ms '.$settings['slider_button_animation'];?> both;
                animation: <?php echo $settings['slider_button_anim_duartion'].'ms '.$settings['slider_button_anim_delay'].'ms '.$settings['slider_button_animation'];?> both;
            }
            <?php endif;?>
        </style>
        <div <?php echo $this->get_render_attribute_string( 'slider_area_attr' );?>>
            <?php
            if ( $settings['slider_item'] ) :
            foreach ( $settings['slider_item'] as $slider_item ):
            ?>
            <div class="slider-single" style="background-image: url(<?php if(isset($slider_item['slider_bg_image']['url'])){ echo $slider_item['slider_bg_image']['url'];}?>)">
                <?php if ( Group_Control_Image_Size::get_attachment_image_html( $slider_item, 'slider_image_size', 'slider_image' ) ):?>
                <div class = "slider-image">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $slider_item, 'slider_image_size', 'slider_image' );
                    ?>
                </div>
                <?php endif;?>
                <div class="slider-content <?php echo esc_attr($slider_item['slider_image']['url'] == '' ? 'image-none': 'image');?>">
                    <?php if ( !empty($slider_item['slider_sub_title'] )):?>
                    <h4><?php echo esc_html($slider_item['slider_sub_title']);?></h4>
                    <?php endif;?>
                    <?php if ( !empty($slider_item['slider_title'] )):?>
                    <h2><?php echo esc_html($slider_item['slider_title']);?></h2>
                    <?php endif;?>
                    <div class="slider-description">
                        <?php echo $slider_item['slider_description'];?>
                    </div>
                    <div class="slider-btn">
                      <?php
                        $eft_btn_target = $slider_item['left_button_link']['is_external'] ? ' target="_blank"' : '';
                        $left_btn_nofollow = $slider_item['left_button_link']['nofollow'] ? ' rel="nofollow"' : '';
                        $right_btn_target = $slider_item['right_button_link']['is_external'] ? ' target="_blank"' : '';
                        $right_btn_nofollow = $slider_item['right_button_link']['nofollow'] ? ' rel="nofollow"' : '';
                        ?>
                        <a class="slider_left_btn" href="<?php echo esc_attr($slider_item['left_button_link']['url']);?>" <?php echo $eft_btn_target.' '.$left_btn_nofollow;?>><?php echo esc_html($slider_item['left_button_text']);?></a>
                        <a class="slider_right_btn" href="<?php echo esc_attr($slider_item['right_button_link']['url']);?>" <?php echo $right_btn_target.' '.$right_btn_nofollow;?>><?php echo esc_html($slider_item['right_button_text']);?></a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>
        <?php
     
    }

}