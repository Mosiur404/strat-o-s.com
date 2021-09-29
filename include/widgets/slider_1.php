<?php

namespace Inc;

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class AsystemSlider extends Widget_Base
{

    public static $slug = 'stratos';

    public function get_name()
    {
        return 'stratos-slider';
    }

    public function get_title()
    {
        return __('Custom Slider', self::$slug);
    }
    public function get_keywords()
    {
        return ['slider', 'swiper', 'scroll'];
    }
    public function get_icon()
    {
        return 'eicon-slider-3d';
    }

    public function get_categories()
    {
        return ['general'];
    }

    //control

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __(
                    'List',
                    self::$slug
                ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //control

        $this->add_control(
            'main_title',
            [
                'label' => __('Main Title', 'stratos'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Title', 'stratos'),
                'label_block' => true,
            ]
        );
        //repeater
        $repeater = new Repeater();
        $repeater->add_control(
            'list_image',
            [
                'label' => __('Choose Image', 'elementor'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'list_title',
            [
                'label' => __('Title', 'stratos'),
                'type' => Controls_Manager::TEXT,
                'default' => __('List Item', 'stratos'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_description',
            [
                'label' => __('Description', 'stratos'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 3,
                'default' => __('Default description', 'stratos'),
                'placeholder' => __('Type your description here', 'stratos'),
            ]
        );
        $repeater->add_control(
            'list_btn_title',
            [
                'label' => __('Button text', 'stratos'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Button text', 'stratos'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'list_btn_url',
            [
                'label' => __('Link', 'stratos'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'stratos'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->add_control(
            'list',
            [
                'label' => __('Repeater List', 'stratos'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __('Title #1', 'stratos'),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );
        //repeater
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
                'separator' => 'none',
            ]
        );
        $this->end_controls_section();

        // style

        //main title style
        $this->start_controls_section(
            'section_main_title_style',
            [
                'label' => __('Main Title', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'main_title_color',
            [
                'label' => __('Main Title Color', 'stratos'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ass-main-title h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'main_title_padding',
            [
                'label' => __('Main Title Padding', 'stratos'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ass-main-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'main-title-typography',
                'label' => __('Main Title Typography', 'stratos'),
                'selector' => '{{WRAPPER}} .ass-main-title h2',
            ]
        );
        $this->end_controls_section();

        // title style
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'stratos'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ass-titles h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ass-wrapper h3.sm-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label' => __('Title Hover Color', 'stratos'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ass-titles h3:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ass-wrapper h3.sm-title:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ass-titles > a.active > h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list-title-typography',
                'label' => __('Title Typography', 'stratos'),
                'selector' => '{{WRAPPER}} .ass-titles h3,{{WRAPPER}} .ass-wrapper h3.sm-title',
            ]
        );

        $this->add_control(
            'list_title',
            [
                'label' => __('Title Margin', 'stratos'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ass-titles' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // style desc 
        $this->start_controls_section(
            'section_desc_style',
            [
                'label' => __('Description', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_desc_color',
            [
                'label' => __('Description Color', 'stratos'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ass-description p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list-desc-typography',
                'label' => __('Description Typography', 'stratos'),
                'selector' => '{{WRAPPER}} .list-desc',
            ]
        );
        $this->add_responsive_control(
            'list_desc',
            [
                'label' => __('Content Margin', 'stratos'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ass-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //image style
        $this->start_controls_section(
            'section_img_style',
            [
                'label' => __('Image', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image Width', 'stratos'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'rem'],
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
                    '{{WRAPPER}} .ass-wrapper .ass-content .ass-image' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // style btn
        $this->start_controls_section(
            'section_btn_style',
            [
                'label' => __('Button', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => __('Button Color', 'stratos'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ass-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Button Hover Color', 'stratos'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ass-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list-button-typography',
                'label' => __('Title Typography', 'stratos'),
                'selector' => '{{WRAPPER}} .ass-btn',
            ]
        );
        $this->add_control(
            'list_btn_margin',
            [
                'label' => __('Button Padding', 'stratos'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ass-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render()

    {
        $settings = $this->get_settings_for_display();

?>

        <?php if ($settings['list']) : ?>

            <div class="ass-wrapper">

                <div class="ass-titles">
                    <div class="ass-main-title">
                        <h2><?php echo $settings['main_title']; ?></h2>
                    </div>
                    <?php foreach ($settings['list'] as $key => $value) : ?>
                        <a id="asystemTitle" <?php if($key == 0) echo 'class="active"'; ?>
                         href="<?php echo $value['list_btn_url']['url']; ?>">
                            <h3><?php echo $value['list_title']; ?></h3>
                        </a>
                    <?php endforeach; ?>
                </div>
                <div id="asystem-slider" class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['list'] as $key => $value) : ?>
                            <div class="swiper-slide">
                                <div class="pagination-next">
                                    <i class="eicon-chevron-right" aria-hidden="true"></i>
                                </div>
                                <div class="ass-content">
                                    <a class="ass-image" href="<?php echo $value['list_btn_url']['url']; ?>">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html($value, 'thumbnail', 'list_image') ?>
                                    </a>
                                    <div class="ass-description">
                                        <a href="<?php echo $value['list_btn_url']['url']; ?>">
                                            <h3 class="sm-title"><?php echo $value['list_title']; ?></h3>
                                        </a>
                                        <p><?php echo $value['list_description']; ?></p>
                                        <a href="#<?php echo $value['list_btn_url']['url']; ?>" class="ass-btn">
                                            <?php echo $value['list_btn_title']; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


        <?php endif; ?>




<?php
    }
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new AsystemSlider());
