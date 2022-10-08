<?php
/**
 * onwork_core skill bar widget for elementor
 * @package Onwork_Core
 * @since 1.0.0
 */
namespace Onwork_Core\Widgets;

use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Skill_Bar extends Widget_Base {

    public function get_name() {
        return 'onwork-skill-bar';
    }
    
    public function get_title() {
        return __( 'Skill Bar', 'onwork-core' );
    }

    public function get_icon() {
        return 'onwork-core-icon eicon-skill-bar';
    }

    public function get_categories() {
        return [ 'onwork_core' ];
    }

    public function get_keywords() {
        return [ 
            'skill bar',
            'progress bar',
            'skill',
            'bar',
            'progress',
            'onwork',
        ];
    }

	protected function register_controls() {
        $this->start_controls_section(
            '_section_skills',
            [
                'label' => __( 'Skills', 'onwork-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __( 'Name', 'onwork-core' ),
                'default' => __( 'Design', 'onwork-core' ),
                'placeholder' => __( 'Type a skill name', 'onwork-core' ),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => __( 'Level (Out Of 100)', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 95
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
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
                'description' => __( 'You can customize this skill bar color from here or customize from Style tab', 'onwork-core' ),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .skill-info' => 'color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'level_color',
            [
                'label' => __( 'Level Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .skill-level' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => __( 'Base Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.skill' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'Design',
                        'level' => ['size' => 97, 'unit' => '%']
                    ],
                    [
                        'name' => 'UX',
                        'level' => ['size' => 88, 'unit' => '%']
                    ],
                    [
                        'name' => 'Coding',
                        'level' => ['size' => 92, 'unit' => '%']
                    ],
                    [
                        'name' => 'Speed',
                    ],
                    [
                        'name' => 'Passion',
                        'level' => ['size' => 100, 'unit' => '%']
                    ]
                ]
            ]
        );

        $this->add_control(
            'view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Text Position', 'onwork-core' ),
                'separator' => 'before',
                'default' => 'inside',
                'options' => [
                    'inside' => __( 'Text Inside', 'onwork-core' ),
                    'outside' => __( 'Text Outside', 'onwork-core' ),
                ],
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_bars',
            [
                'label' => __( 'Skill Bars', 'onwork-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => __( 'Height', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .skill--outside' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .skill--inside' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'spacing',
            [
                'label' => __( 'Spacing Between', 'onwork-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .skill--outside' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .skill--inside:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'onwork-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .skill, {{WRAPPER}} .skill-level' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .skill'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_content',
            [
                'label' => __( 'Content', 'onwork-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skill-info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'level_color',
            [
                'label' => __( 'Level Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skill-level' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'base_color',
            [
                'label' => __( 'Base Color', 'onwork-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skill' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .skill-info'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'info_text_shadow',
                'selector' => '{{WRAPPER}} .skill-info',
            ]
        );
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! is_array( $settings['skills'] ) ) {
            return;
        }

        foreach ( $settings['skills'] as $index => $skill ) :
            $name_key = $this->get_repeater_setting_key( 'name', 'bars', $index );
            $this->add_inline_editing_attributes( $name_key, 'none' );
            $this->add_render_attribute( $name_key, 'class', 'skill-name' );
            ?>
            <div class="skill skill--<?php echo esc_attr( $settings['view'] ); ?> elementor-repeater-item-<?php echo $skill['_id']; ?>">
                <div class="skill-level" data-level="<?php echo esc_attr( $skill['level']['size'] ); ?>">
                    <div class="skill-info"><span <?php echo $this->get_render_attribute_string( $name_key ); ?>><?php echo esc_html( $skill['name'] ); ?></span><span class="skill-level-text"></span></div>
                </div>
            </div>
            <?php
        endforeach;
    }

    protected function _content_template() {
        ?>
        <#
        if (_.isArray(settings.skills)) {
            _.each(settings.skills, function(skill, index) {
            var nameKey = view.getRepeaterSettingKey( 'name', 'skills', index);
            view.addInlineEditingAttributes( nameKey, 'none' );
            view.addRenderAttribute( nameKey, 'class', 'skill-name' );
            #>
            <div class="skill skill--{{settings.view}} elementor-repeater-item-{{skill._id}}">
                <div class="skill-level" data-level="{{skill.level.size}}">
                    <div class="skill-info"><span {{{view.getRenderAttributeString( nameKey )}}}>{{skill.name}}</span><span class="skill-level-text"></span></div>
                </div>
            </div>
            <# });
        } #>
        <?php
    }
}
