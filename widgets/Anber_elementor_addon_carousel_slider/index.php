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

class Anber_elementor_addon_carousel_slider extends Widget_Base {

    public function get_name() {
        return 'Anber_carousel_slider';
    }

    public function get_title() {
        return __('Anber Carousel/Slider', 'anber-elementor-addon');
    }

    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return ['anbar-category'];
    }

    public function get_script_depends() {
        return ['anber-carousel-script'];
    }

    public function get_style_depends() {
        return ['adon-comon-style', 'anber-carousel-style', 'anber-carousel'];
    }

    protected function register_controls() {
        $this->start_controls_section(
                '_section_carousel_slider',
                [
                    'label' => __('Carousel Items', 'anber-elementor-addon'),
                ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'carousel_title',
                [
                    'label' => esc_html__('Title', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('Title', 'anber-elementor-addon'),
                    'label_block' => true,
                ]
        );

        $repeater->add_control(
                'item_content',
                [
                    'label' => esc_html__('Item Content', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'label_block' => true,
                ]
        );

        $repeater->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'types' => ['classic', 'gradient', 'video'],
                    'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .carosul_item',
                ]
        );

        $repeater->add_responsive_control(
                'item_wrap_padding',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Padding', 'anber-elementor-addon'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .item_content_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $repeater->add_control(
                'button_options',
                [
                    'label' => esc_html__('Button Options', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );

        $repeater->add_control(
                'show_button',
                [
                    'label' => esc_html__('Show Button', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-elementor-addon'),
                    'label_off' => esc_html__('Hide', 'anber-elementor-addon'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );

        $repeater->add_control(
                'button_title',
                [
                    'label' => esc_html__('Button Text', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                    'condition' => [
                        'show_button' => ['yes']
                    ],
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
                    'condition' => [
                        'show_button' => ['yes']
                    ],
                ]
        );

        $repeater->add_control(
                'icon',
                [
                    'label' => esc_html__('Button Icon', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-right',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'show_button' => ['yes']
                    ],
                ]
        );

        $repeater->add_responsive_control(
                'icon_width',
                [
                    'label' => esc_html__('Button Icon Width', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .my-icon-wrapper i' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .my-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}};', // For SVG icons
                    ],
                    'condition' => [
                        'show_button' => ['yes']
                    ],
                ]
        );

        $repeater->add_control(
                'icon_color',
                [
                    'label' => esc_html__('Button Icon Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .my-icon-wrapper i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .my-icon-wrapper svg' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_button' => ['yes']
                    ],
                ]
        );

        $repeater->add_control(
                'icon_gap',
                [
                    'label' => esc_html__('Button Icon Gap', 'anber-elementor-addon'),
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
                    'condition' => [
                        'show_button' => ['yes']
                    ],
                ]
        );

        $this->add_control(
                'item_list',
                [
                    'label' => esc_html__('Carousel/Slider Items', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'title_field' => '{{{ carousel_title }}}',
                ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
                'section_select_layout',
                [
                    'label' => __('Carousel Controler', 'anber-elementor-addon'),
                ]
        );

        $this->add_control(
                'layout',
                [
                    'label' => __('Select Layout', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'hero_slider' => __('Hero Slider', 'anber-elementor-addon'),
                    ],
                    'default' => 'hero_slider',
                    'toggle' => true,
                ]
        );
        $this->add_responsive_control(
                'carousel_item',
                [
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'label' => esc_html__('Item Number', 'anber-elementor-addon'),
                    'size_units' => [], // Optional, can leave empty
                    'range' => [
                        'px' => [// Using 'px' as an example; adjust according to your needs
                            'min' => 1,
                            'max' => 10,
                            'step' => 1,
                        ],
                    ],
                    'devices' => ['desktop', 'tablet', 'mobile'], // Ensures values for all devices
                    'desktop_default' => [
                        'size' => 3, // Default for desktop
                    ],
                    'tablet_default' => [
                        'size' => 2, // Default for tablet
                    ],
                    'mobile_default' => [
                        'size' => 1, // Default for mobile
                    ],
                ]
        );

        $this->add_control(
                'navigation_options',
                [
                    'label' => esc_html__('Navigation Options', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );
        $this->add_control(
                'carousel_control',
                [
                    'label' => esc_html__('Button Style', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'both',
                    'options' => [
                        'both' => esc_html__('Default', 'anber-elementor-addon'),
                        'nav' => esc_html__('Nave', 'anber-elementor-addon'),
                        'dots' => esc_html__('Dots', 'anber-elementor-addon'),
                    ],
                ]
        );
        $this->add_control(
                'previous_icon',
                [
                    'label' => esc_html__('Next Icon', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-right',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'carousel_control' => ['both', 'nav']
                    ],
                ]
        );
        $this->add_control(
                'next_icon',
                [
                    'label' => esc_html__('Previous Icon', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-angle-left',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'carousel_control' => ['both', 'nav']
                    ],
                ]
        );
        $this->add_control(
                'icon_color',
                [
                    'label' => esc_html__('Icon Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .owl-nav svg' => 'fill: {{VALUE}}',
                        '{{WRAPPER}} .owl-nav svg path' => 'fill: {{VALUE}}',
                    ],
                    'condition' => [
                        'carousel_control' => ['both', 'nav']
                    ],
                ]
        );
        $this->add_control(
                'icon_width',
                [
                    'label' => esc_html__('Width', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-nav svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'carousel_control' => ['both', 'nav']
                    ],
                ]
        );
        $this->add_control(
                'dot_options',
                [
                    'label' => esc_html__('Dot Options', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'carousel_control' => ['both', 'dots']
                    ],
                ]
        );
        $this->add_control(
                'dot_width',
                [
                    'label' => esc_html__('Dot Width', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 100,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'carousel_control' => ['both', 'dots']
                    ],
                ]
        );
        $this->add_control(
                'dot_icon_color',
                [
                    'label' => esc_html__('Dot Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .owl-dot span' => 'background: {{VALUE}}',
                    ],
                    'condition' => [
                        'carousel_control' => ['both', 'dots']
                    ],
                ]
        );
        $this->add_control(
                'dot_active_color',
                [
                    'label' => esc_html__('Dot Active Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .owl-dot.active span' => 'background: {{VALUE}} !important',
                    ],
                    'condition' => [
                        'carousel_control' => ['both', 'dots']
                    ],
                ]
        );
        $this->add_control(
                'dot_position',
                [
                    'label' => esc_html__('Dot Position', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 100,
                        ],
                        '%' => [
                            'min' => -50,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'carousel_control' => ['both', 'dots']
                    ],
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

        $this->add_responsive_control(
                'banner_width',
                [
                    'label' => esc_html__('Wrapper Width', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'devices' => ['desktop', 'tablet', 'mobile'],
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
                    'desktop_default' => [
                        'unit' => '%',
                        'size' => 90,
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                        'size' => 90,
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .item_content_wrap' => 'width: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .item_content_wrap' => 'text-align: {{VALUE}};',
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
        $this->add_control(
                'same_height_column',
                [
                    'label' => esc_html__('Same height column', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-elementor-addon'),
                    'label_off' => esc_html__('Hide', 'anber-elementor-addon'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
                'carousel_title_style',
                [
                    'label' => esc_html__('Title Style', 'anber-elementor-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'carousel_title_control_color',
                [
                    'label' => esc_html__('Title Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .carousel_title' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => '_subtitle_control_typo',
                    'label' => esc_html__('Title Typography', 'anber-elementor-addon'),
                    'selector' => '{{WRAPPER}} .carousel_title',
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
                        '{{WRAPPER}} .item_content' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_control_typo',
                    'label' => esc_html__('Title Typography', 'anber-elementor-addon'),
                    'selector' => '{{WRAPPER}} .item_content',
                ]
        );
        $this->add_responsive_control(
                'item_content_margin',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Margin', 'anber-elementor-addon'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .item_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
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
        // Start Tabs
        $this->start_controls_tabs('style_tabs');

        // Normal Tab
        $this->start_controls_tab(
                'normal_tab',
                [
                    'label' => __('Normal', 'anber-elementor-addon'),
                ]
        );

        $this->add_control(
                'normal_text_color',
                [
                    'label' => __('Text Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .banner_cta_button' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .banner_cta_button .my-icon-wrapper svg path' => 'fill: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'normal_background',
                    'label' => __('Background', 'anber-elementor-addon'),
                    'types' => ['classic', 'gradient', 'video'],
                    'selector' => '{{WRAPPER}} .banner_cta_button',
                    'exclude' => ['image'],
                    'fields_options' => [
                        'background' => [
                            'default' => 'classic',
                        ],
                        'color' => [
                            'default' => '#fff',
                        ],
                    ],
                ]
        );

        $this->end_controls_tab(); // End Normal Tab
        // Hover Tab
        $this->start_controls_tab(
                'hover_tab',
                [
                    'label' => __('Hover', 'anber-elementor-addon'),
                ]
        );

        $this->add_control(
                'hover_text_color',
                [
                    'label' => __('Text Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .banner_cta_button:hover' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .banner_cta_button:hover .my-icon-wrapper svg path' => 'fill: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'hover_background',
                    'label' => __('Background', 'anber-elementor-addon'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .banner_cta_button:hover',
                ]
        );

        $this->end_controls_tab(); // End Hover Tab
        $this->end_controls_tabs(); // Close Tabs
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
                    'default' => 'row',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .button_wrapper' => 'flex-direction: {{VALUE}};',
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
                        'right' => 30,
                        'bottom' => 10,
                        'left' => 30,
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

        include dirname(__FILE__) . '/carousel_slider.php';
    }
}

 \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Anber_elementor_addon_carousel_slider());