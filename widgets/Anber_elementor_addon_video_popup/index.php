<?php

namespace AnberElementorAddons;
//namespace Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use ELementor\Repeater;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Anber_elementor_addon_video_popup extends Widget_Base {

    public function get_name() {
        return 'Anber elementor addon video popup';
    }

    public function get_title() {
        return __('Anber Video Popup', 'anber-elementor-addon');
    }

    public function get_icon() {
        return 'eicon-video-playlist';
    }

    public function get_categories() {
        return ['anbar-category'];
    }

    public function get_script_depends() {
        return ['anber-comon-script'];
    }

    public function get_style_depends() {
        return ['adon-comon-style'];
    }

    protected function register_controls() {
        $this->start_controls_section(
                'section_select_layout',
                [
                    'label' => __('Layout', 'anber-elementor-addon'),
                ]
        );
        $this->add_control(
                'poster_image',
                [
                    'label' => __('Poster Image', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
//                    'default' => [
//                        'url' => \Elementor\Utils::get_placeholder_image_src(),
//                    ],
                ]
        );
        $this->add_control(
                'video_type',
                [
                    'label' => esc_html__('Video Type', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'youtube',
                    'options' => [
                        'youtube' => esc_html__('Youtube', 'anber-elementor-addon'),
                        'vimo' => esc_html__('Vimo', 'anber-elementor-addon'),
                       
                    ],
                    
                ]
        );
        $this->add_control(
                'video_url',
                [
                    'label' => esc_html__('Video ID', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
        );
        $this->add_control(
                'video_title',
                [
                    'label' => esc_html__('Video Title Text', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                '_button_style',
                [
                    'label' => esc_html__('Button Style', 'anber-elementor-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                '_button_control_alignment',
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
                    'default' => 'left',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .vpop' => 'text-align: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                '_button_control_margin',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Margin', 'anber-elementor-addon'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .vpop_img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
                '_title_style',
                [
                    'label' => esc_html__('Title Style', 'anber-elementor-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                '_title_control_color',
                [
                    'label' => esc_html__('Title Color', 'anber-elementor-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .video-title' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => '_subtitle_control_typo',
                    'label' => esc_html__('Title Typography', 'anber-elementor-addon'),
                    'selector' => '{{WRAPPER}} .video-title',
                ]
        );
    }

    protected function render() {

        $settings = $this->get_settings();

        include dirname(__FILE__) . '/popupbox.php';
    }
}

 \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Anber_Elementor_Addon_Video_Popup());
