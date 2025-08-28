<?php
/**
 * @package   anber-elementor-addon
 * @since 1.0.1
 * 
 *
 * 
 */
namespace AnberElementorAddons;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use ELementor\Repeater;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Anber_elementor_addon_banner extends Widget_Base {


    public function get_name() {
        return 'anber-ea-banner';
    }

    public function get_title() {
        return __('Anber Banner', 'anber-elementor-addon');
    }


    public function get_icon() {
        return 'eicon-banner';
    }


    public function get_categories() {
        return ['anbar-category'];
    }

    public function get_script_depends() {
        return ['anber-elementor-addon'];
    }

    public function get_style_depends() {
        return ['adon-comon-style'];
    }


    protected function register_controls() {
        $this->start_controls_section(
                'section_select_layout',
                [
                    'label' => __('Banner Layout', 'anber-elementor-addon'),
                ]
        );

        $this->add_control(
                'layout',
                [
                    'label' => __('Select Layout', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'layout-1' => __('Layout 1', 'anber-elementor-addon'),
                    ],
                    'default' => 'layout-1',
                    'toggle' => true,
                ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
                '_section_banner_content',
                [
                    'label' => __('Banner Content', 'anber-elementor-addon'),
                ]
        );
        $this->add_control(
                'banner_title',
                [
                    'label' => esc_html__('Banner Title', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'types' => ['classic', 'gradient', 'video'],
                    'selector' => '{{WRAPPER}} .anber_ea_banner',
                ]
        );

        $this->add_control(
                'banner_content',
                [
                    'label' => esc_html__('Banner Content', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'label_block' => true,
                ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'button_title',
                [
                    'label' => esc_html__('Button Text', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('Contact', 'anber-elementor-addon'),
                    'label_block' => true,
                ]
        );

        $repeater->add_control(
                'button_link',
                [
                    'label' => esc_html__('Link', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'options' => ['url', 'is_external', 'nofollow'],
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'label_block' => true,
                ]
        );

        $repeater->add_control(
                'icon',
                [
                    'label' => esc_html__('Icon', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-right',
                        'library' => 'fa-solid',
                    ],
                ]
        );

        $repeater->add_responsive_control(
                'icon_width',
                [
                    'label' => esc_html__('Icon Width', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .anbar_ea_banner_icon_wrapper i' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .anbar_ea_banner_icon_wrapper svg' => 'width: {{SIZE}}{{UNIT}};', // For SVG icons
                    ],
                ]
        );

        $repeater->add_control(
                'icon_gap',
                [
                    'label' => esc_html__('Icon Gap', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_cta_button' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        // Start Tabs
        $repeater->start_controls_tabs('style_tabs');

        // Normal Tab
        $repeater->start_controls_tab(
                'normal_tab',
                [
                    'label' => __('Normal', 'anber-elementor-addon'),
                ]
        );

        $repeater->add_control(
                'normal_text_color',
                [
                    'label' => __('Text Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .anbar_ea_banner_icon_wrapper i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .anbar_ea_banner_icon_wrapper svg' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $repeater->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'normal_background',
                    'label' => __('Background', 'anber-elementor-addon'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                ]
        );

        $repeater->end_controls_tab(); // End Normal Tab
        // Hover Tab
        $repeater->start_controls_tab(
                'hover_tab',
                [
                    'label' => __('Hover', 'anber-elementor-addon'),
                ]
        );

        $repeater->add_control(
                'hover_text_color',
                [
                    'label' => __('Text Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}}:hover .anbar_ea_banner_icon_wrapper i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}}:hover .anbar_ea_banner_icon_wrapper svg' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $repeater->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'hover_background',
                    'label' => __('Background', 'anber-elementor-addon'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
                ]
        );

        $repeater->end_controls_tab(); // End Hover Tab
        $repeater->end_controls_tabs(); // Close Tabs

        $this->add_control(
                'button_list',
                [
                    'label' => esc_html__('Buttons', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'button_title' => esc_html__('Button #1', 'anber-elementor-addon'),
                            'button_link' => [
                                'url' => '#',
                                'is_external' => false,
                                'nofollow' => false,
                            ],
                        ],
                        [
                            'button_title' => esc_html__('Button #2', 'anber-elementor-addon'),
                            'button_link' => [
                                'url' => '#',
                                'is_external' => false,
                                'nofollow' => false,
                            ],
                        ],
                    ],
                    'title_field' => '{{{ button_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'banner_style',
                [
                    'label' => esc_html__('General Style', 'anber-elementor-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'banner_width',
                [
                    'label' => esc_html__('Wrapper Width', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_title_wrap' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_control(
                'banner_alignment',
                [
                    'label' => esc_html__('Alignment', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'anber-elementor-addon'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'anber-elementor-addon'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'anber-elementor-addon'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .banner_title_wrap' => 'text-align: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'banner_control_margin',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Padding', 'anber-elementor-addon'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .anber_ea_banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_control(
                'item_gap',
                [
                    'label' => esc_html__('Item Gap', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_title_wrap' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'overlayer_switcher',
                [
                    'label' => esc_html__('Show Overlay', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-elementor-addon'),
                    'label_off' => esc_html__('Hide', 'anber-elementor-addon'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'overlayer_color',
                [
                    'label' => esc_html__('Overlay Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .overlayer' => 'background: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
                'banner_title_style',
                [
                    'label' => esc_html__('Title Style', 'anber-elementor-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'banner_title_control_color',
                [
                    'label' => esc_html__('Title Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .anbar_banner_title' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => '_subtitle_control_typo',
                    'label' => esc_html__('Title Typography', 'anber-elementor-addon'),
                    'selector' => '{{WRAPPER}} .anbar_banner_title',
                ]
        );
        $this->add_responsive_control(
                'banner_control_title_margin',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Margin', 'anber-elementor-addon'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .anbar_banner_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'banner_content_style',
                [
                    'label' => esc_html__('Content Style', 'anber-elementor-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'banner_content_control_color',
                [
                    'label' => esc_html__('Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .banner_content' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_control_typo',
                    'label' => esc_html__('Title Typography', 'anber-elementor-addon'),
                    'selector' => '{{WRAPPER}} .banner_content',
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'button_content_style',
                [
                    'label' => esc_html__('Button Style', 'anber-elementor-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_control_typo',
                    'label' => esc_html__('Button Typography', 'anber-elementor-addon'),
                    'selector' => '{{WRAPPER}} .banner_cta_button',
                ]
        );
        $this->add_control(
                'button_wrwpper_align',
                [
                    'label' => esc_html__('Alignment', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => esc_html__('Left', 'anber-elementor-addon'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'anber-elementor-addon'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'anber-elementor-addon'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .button_wrapper' => 'justify-content: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'button_control_alignment',
                [
                    'label' => esc_html__('Button Direction', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'row' => [
                            'title' => esc_html__('Row', 'anber-elementor-addon'),
                            'icon' => 'eicon-arrow-down',
                        ],
                        'column' => [
                            'title' => esc_html__('Column', 'anber-elementor-addon'),
                            'icon' => 'eicon-arrow-right',
                        ],
                    ],
                    'default' => 'column',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .button_wrapper' => 'flex-direction: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'button_gap',
                [
                    'label' => esc_html__('Button Gap', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .button_wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'button_control_padding',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Padding', 'anber-elementor-addon'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'default' => [
                        'top' => 10,
                        'right' => 10,
                        'bottom' => 10,
                        'left' => 10,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_cta_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_control(
                'button_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'default' => [
                        'top' => 5,
                        'right' => 5,
                        'bottom' => 5,
                        'left' => 5,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_cta_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        ?>

        <?php

        include dirname(__FILE__) . '/layout-1.php';
    }
}


 \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Anber_elementor_addon_banner());