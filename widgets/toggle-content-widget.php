<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Elementor_Toggle_Content_Widget extends Widget_Base {

    public function get_name() {
        return 'toggle_content_widget';
    }

    public function get_title() {
        return __('Toggle Content', 'plugin-name');
    }

    public function get_icon() {
        return 'eicon-toggle';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
        // Content controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'plugin-name'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => __('Heading', 'plugin-name'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Lorem ipsum dolor sit amet.', 'plugin-name'),
            ]
        );

        $this->add_control(
            'residential_button_text',
            [
                'label' => __('Residential Button Text', 'plugin-name'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Residential', 'plugin-name'),
            ]
        );

        $this->add_control(
            'commercial_button_text',
            [
                'label' => __('Commercial Button Text', 'plugin-name'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Commercial', 'plugin-name'),
            ]
        );

        $this->add_control(
            'residential_content',
            [
                'label' => __('Residential Content', 'plugin-name'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Content for Residential', 'plugin-name'),
            ]
        );

        $this->add_control(
            'commercial_content',
            [
                'label' => __('Commercial Content', 'plugin-name'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Content for Commercial', 'plugin-name'),
            ]
        );

        $this->end_controls_section();

        // Heading Styles
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => __('Heading', 'plugin-name'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __('Heading Typography', 'plugin-name'),
                'selector' => '{{WRAPPER}} .head-toggle-left h2',
            ]
        );

        $this->add_control(
            'heading_text_color',
            [
                'label' => __('Heading Text Color', 'plugin-name'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .head-toggle-left h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_width',
            [
                'label' => __('Heading Width', 'plugin-name'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .head-toggle-left h2' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Button Styles
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __('Buttons', 'plugin-name'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggle_button_group_background',
            [
                'label' => __('Toggle Button Group Background', 'plugin-name'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .toggle-button-group' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'toggle_button_typography',
                'label' => __('Toggle Button Typography', 'plugin-name'),
                'selector' => '{{WRAPPER}} .toggle-button',
            ]
        );

        $this->add_control(
            'toggle_button_text_color',
            [
                'label' => __('Toggle Button Text Color', 'plugin-name'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .toggle-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_active_background',
            [
                'label' => __('Active Toggle Button Background', 'plugin-name'),
                'type' => Controls_Manager::COLOR,
                'default' => '#800080',
                'selectors' => [
                    '{{WRAPPER}} .toggle-button.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_active_text_color',
            [
                'label' => __('Active Toggle Button Text Color', 'plugin-name'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .toggle-button.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="toggle-cont">
            <div class="head-toggle">
                <div class="head-toggle-left">
                    <h2><?php echo esc_html($settings['heading']); ?></h2>
                </div>
                <div class="head-toggle-right">
                    <div class="toggle-button-group">
                        <button class="toggle-button active" data-target="residential-content">
                            <?php echo esc_html($settings['residential_button_text']); ?>
                        </button>
                        <button class="toggle-button" data-target="commercial-content">
                            <?php echo esc_html($settings['commercial_button_text']); ?>
                        </button>
                    </div>
                </div>
            </div>

            <div class="toggle-content">
                <div class="toggle-content-item residential-content active">
                    <?php echo wp_kses_post($settings['residential_content']); ?>
                </div>
                <div class="toggle-content-item commercial-content">
                    <?php echo wp_kses_post($settings['commercial_content']); ?>
                </div>
            </div>
        </div>
        <?php
    }

   
}
