<?php
/**
 * onwork_core course category image box widget for elementor
 * @package Onwork_Core
 * @since 1.0.0
 */

namespace Onwork_Core\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Category_Image_Box extends Widget_Base {

	public function get_name() {
        return 'onwork-category-image-box';
    }
    
    public function get_title() {
        return __( 'Category Image Box', 'onwork-core' );
    }

    public function get_icon() {
        return 'onwork-core-icon eicon-single-page';
    }

    public function get_categories() {
        return [ 'onwork_core' ];
    }

    public function get_keywords() {
        return [
            'category',
            'course category image box',
            'course category',
            'onwork',
        ];
    }

	protected function register_controls() {
	
		$this->start_controls_section(
			'section_cat_image',
			[
				'label' => __( 'Image', 'onwork-core' ),
			]
		);

		$this->add_control(
			'cat_image',
			[
				'label' => __( 'Choose Image', 'onwork-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'onwork-core' ),
			]
		);

		$this->add_control(
			'cat_title_text',
			[
				'label' => __( 'Category Name', 'onwork-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Web Design', 'onwork-core' ),
				'placeholder' => __( 'Enter category title', 'onwork-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'cat_number_text',
			[
				'label' => __( 'Number of Courses', 'onwork-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '2 Courses', 'onwork-core' ),
				'placeholder' => __( 'Enter number of courses', 'onwork-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_link',
			[
				'label' => __( 'Title Link', 'onwork-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'onwork-core' ),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cat_button',
			[
				'label' => __( 'Button', 'onwork-core' ),
			]
		);

		$this->add_control(
			'cat_btn_text',
			[
				'label' => __( 'Text', 'onwork-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'onwork-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'cat_btn_link',
			[
				'label' => __( 'Link', 'onwork-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'onwork-core' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_global',
			[
				'label' => __( 'General', 'onwork-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'cat_img_box_global_padding',
			[
				'label' => __( 'Padding', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'cat_img_box_global_tabs_style' );

		$this->start_controls_tab(
			'cat_img_box_global_style_normal',
			[
				'label' => __( 'Normal', 'onwork-core' ),
			]
		);

		$this->add_control(
			'cat_img_box_global_bg',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_img_box_global_border',
				'selector' => '{{WRAPPER}} .course-category-img-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_img_box_global_shadow',
				'selector' => '{{WRAPPER}} .course-category-img-box',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cat_img_box_global_hover',
			[
				'label' => __( 'Hover', 'onwork-core' ),
			]
		);

		$this->add_control(
			'cat_img_box_global_bg_hover_color',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_img_box_global_hover_border',
				'selector' => '{{WRAPPER}} .course-category-img-box:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_img_box_hover_global_shadow',
				'selector' => '{{WRAPPER}} .course-category-img-box:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'cat_img_box_goabal_border_radius',
			[
				'label' => __( 'Border Radius', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'onwork-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'cat_img_margin',
			[
				'label' => __( 'Margin', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cat_img_width',
			[
				'label' => __( 'Width', 'onwork-core' ) . ' (%)',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_img_border',
				'selector' => '{{WRAPPER}} .course-category-img-box img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cat_img_border_radius',
			[
				'label' => __( 'Border Radius', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_img_box_shadow',
				'selector' => '{{WRAPPER}} .course-category-img-box img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'onwork-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'cat_content_align',
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
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cat_heading_title',
			[
				'label' => __( 'Category Name', 'onwork-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cat_title_space',
			[
				'label' => __( 'Spacing', 'onwork-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cat_title_color',
			[
				'label' => __( 'Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box h4 a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .course-category-img-box h4' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'cat_title_hover_color',
			[
				'label' => __( 'Hover Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box h4:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .course-category-img-box h4 a:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_title_typography',
				'selector' => '{{WRAPPER}} .course-category-img-box h4, {{WRAPPER}} .course-category-img-box h4 a',
			]
		);

		$this->add_control(
			'cat_heading_desc',
			[
				'label' => __( 'Number of Courses', 'onwork-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cat_desc_color',
			[
				'label' => __( 'Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .course-category-img-box p' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_desc_typography',
				'selector' => '{{WRAPPER}} .course-category-img-box p',
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'section_style_btn',
			[
				'label' => __( 'Button', 'onwork-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_btn_typography',
				'selector' => '{{WRAPPER}} .course-cat-img-box-btn a'
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_btn_normal',
			[
				'label' => __( 'Normal', 'onwork-core' ),
			]
		);

		$this->add_control(
			'cat_btn_text_color',
			[
				'label' => __( 'Text Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .course-cat-img-box-btn a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cat_btn_bg',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-cat-img-box-btn a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_btn_border',
				'selector' => '{{WRAPPER}} .course-cat-img-box-btn a'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => __( 'Hover', 'onwork-core' ),
			]
		);

		$this->add_control(
			'cat_btn_hover_color',
			[
				'label' => __( 'Text Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-cat-img-box-btn a:hover, {{WRAPPER}} .course-cat-img-box-btn a:focus' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'cat_btn_bg_hover_color',
			[
				'label' => __( 'Background Color', 'onwork-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-cat-img-box-btn a:hover, {{WRAPPER}} .course-cat-img-box-btn a:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_btn_hover_border',
				'selector' => '{{WRAPPER}} .course-cat-img-box-btn a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'cat_btn_border_radius',
			[
				'label' => __( 'Border Radius', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .course-cat-img-box-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_btn_box_shadow',
				'selector' => '{{WRAPPER}} .course-cat-img-box-btn a',
			]
		);

		$this->add_responsive_control(
			'cat_btn_text_padding',
			[
				'label' => __( 'Padding', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-cat-img-box-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cat_btn_text_margin',
			[
				'label' => __( 'Margin', 'onwork-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-cat-img-box-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function render() { 

		$settings = $this->get_settings_for_display();
		$target = $settings['title_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['title_link']['nofollow'] ? ' rel="nofollow"' : '';
		?>
		
        <div class="course-category-img-box">
			<?php if(! empty($settings['cat_image']['url'])):?>
				<?php if(! empty($settings['title_link']['url'])):?>
				<div class="course-category-img">
				<a href="<?php echo esc_attr($settings['title_link']['url'])?>" <?php echo esc_attr($target .' '. $nofollow);?>>
					<img src="<?php echo esc_attr($settings['cat_image']['url'])?>" alt="">
				</a>
				</div>
				<?php else:?>
				<div class="course-category-img">
					<img src="<?php echo esc_attr($settings['cat_image']['url'])?>" alt="">
				</div>
				<?php endif;?>
			<?php endif;?>
			<?php if(! empty($settings['cat_title_text'])):?>
            <div class="course-category-img-box-content">
				<?php if(! empty($settings['cat_title_text'])):?>
					<?php if(! empty($settings['title_link']['url'])):?>
                	<h4><?php echo '<a href="' . esc_attr($settings['title_link']['url']). '"' . $target . $nofollow . '>'.esc_html($settings['cat_title_text']).'</a>';?></h4>
					<?php else:?>
					<h4><?php echo esc_html($settings['cat_title_text']);?></h4>
					<?php endif;?>
				<?php endif;?>
				<?php if(! empty($settings['cat_number_text'])):?>
				<p><?php echo esc_html($settings['cat_number_text']);?></p>
				<?php endif;?>
            </div>
			<?php endif;?>
			<?php if(! empty($settings['cat_btn_text'])):?>
			<div class="course-cat-img-box-btn">
				<?php
				$target = $settings['cat_btn_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $settings['cat_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
				$btn_attr = '';
				if(! empty($settings['cat_btn_link']['url'])){
					$btn_attr = $settings['cat_btn_link']['url'];
				}
				?>
				<a href="<?php echo esc_attr($btn_attr);?>" <?php echo $target .' '. $nofollow;?>><?php echo esc_html($settings['cat_btn_text']);?></a>
			</div>
			<?php endif;?>
        </div>
        <?php

	}

}