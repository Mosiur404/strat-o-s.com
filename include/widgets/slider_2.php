<?php

namespace Inc;

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;


use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class AsystemMobile extends Widget_Base
{

    public static $slug = 'stratos';

    public function get_name()
    {
        return 'stratos-slider-mobile';
    }

    public function get_title()
    {
        return __('Custom Slider Mobile', self::$slug);
    }
    public function get_keywords()
    {
        return ['slider', 'swiper', 'scroll'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Icon Box', 'stratos'),
            ]
        );

        //start repeater
        $repeater = new Repeater();
        $repeater->add_control(
            'selected_icon',
            [
                'label' => esc_html__('Icon', 'stratos'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'title_text',
            [
                'label' => esc_html__('Title & Description', 'stratos'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__('This is the heading', 'stratos'),
                'placeholder' => esc_html__('Enter your title', 'stratos'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description_text',
            [
                'label' => '',
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'stratos'),
                'placeholder' => esc_html__('Enter your description', 'stratos'),
                'rows' => 10,
                'separator' => 'none',
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'stratos'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'stratos'),
                'separator' => 'before',
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
                        'title_text' => __('Title #1', 'stratos'),
                    ],
                ],
                'title_field' => '{{{ title_text }}}',
            ]
        );
        //end repeater
        $this->add_control(
            'view',
            [
                'label' => esc_html__('View', 'stratos'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__('Default', 'stratos'),
                    'stacked' => esc_html__('Stacked', 'stratos'),
                    'framed' => esc_html__('Framed', 'stratos'),
                ],
                'default' => 'default',
                'prefix_class' => 'elementor-view-',
            ]
        );

        $this->add_control(
            'column_per_row',
            [
                'label' => esc_html__('Slide Per Row', 'stratos'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'elementor-col-100' => '1',
                    'elementor-col-50' => '2',
                    'elementor-col-33' => '3',
                    'elementor-col-25' => '4',
                    'elementor-col-20' => '5',
                    'elementor-col-16' => '6',

                ],
                'default' => 'elementor-col-25',
            ]
        );
        $this->add_control(
            'title_size',
            [
                'label' => esc_html__('Title HTML Tag', 'stratos'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__('Icon', 'stratos'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('icon_colors');

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => esc_html__('Normal', 'stratos'),
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => esc_html__('Primary Color', 'stratos'),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'secondary_color',
            [
                'label' => esc_html__('Secondary Color', 'stratos'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_colors_hover',
            [
                'label' => esc_html__('Hover', 'stratos'),
            ]
        );

        $this->add_control(
            'hover_primary_color',
            [
                'label' => esc_html__('Primary Color', 'stratos'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_secondary_color',
            [
                'label' => esc_html__('Secondary Color', 'stratos'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => esc_html__('Hover Animation', 'stratos'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_space',
            [
                'label' => esc_html__('Spacing', 'stratos'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'stratos'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => esc_html__('Padding', 'stratos'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );

        $this->add_control(
            'rotate',
            [
                'label' => esc_html__('Rotate', 'stratos'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => esc_html__('Border Width', 'stratos'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'view' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'stratos'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__('Content', 'stratos'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__('Alignment', 'stratos'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'stratos'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'stratos'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'stratos'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'stratos'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_vertical_alignment',
            [
                'label' => esc_html__('Vertical Alignment', 'stratos'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__('Top', 'stratos'),
                    'middle' => esc_html__('Middle', 'stratos'),
                    'bottom' => esc_html__('Bottom', 'stratos'),
                ],
                'default' => 'top',
                'prefix_class' => 'elementor-vertical-align-',
            ]
        );
        $this->add_control(
            'box_padding',
            [
                'label' => __('Box Padding', 'stratos'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'stratos'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label' => esc_html__('Spacing', 'stratos'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'stratos'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-title' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-title, {{WRAPPER}} .elementor-icon-box-title a',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'selector' => '{{WRAPPER}} .elementor-icon-box-title',
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label' => esc_html__('Description', 'stratos'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'stratos'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-description' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-description',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'description_shadow',
                'selector' => '{{WRAPPER}} .elementor-icon-box-description',
            ]
        );

        $this->end_controls_section();
        //navigation
        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => esc_html__('Navigation', 'stratos'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'navigation_color',
            [
                'label' => esc_html__('Color', 'stratos'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button-next' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-swiper-button-prev' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render icon box widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();


        $this->add_render_attribute('icon', 'class', ['elementor-icon', 'elementor-animation-' . $settings['hover_animation']]);

        $icon_tag = 'span';

        if (!isset($settings['icon'])) {
            // add old default
            $settings['icon'] = 'fa fa-star';
        }

        $has_icon = !empty($settings['icon']);


        if ($settings['list']) :
            echo '<div  id="asystemMobile-slider" class="swiper-container d-flex">';
            echo '<div class="swiper-wrapper">';
            foreach ($settings['list'] as $key => $value) :
                echo '<div class="swiper-slide elementor-column ' . $settings['column_per_row'] . '">';


                if (!empty($value['link']['url'])) {
                    $icon_tag = 'a';

                    $this->add_link_attributes('link', $value['link']);
                }

                if ($has_icon) {
                    $this->add_render_attribute('i', 'class', $settings['icon']);
                    $this->add_render_attribute('i', 'aria-hidden', 'true');
                }

                $this->add_render_attribute('description_text', 'class', 'elementor-icon-box-description');

                $this->add_inline_editing_attributes('title_text', 'none');
                $this->add_inline_editing_attributes('description_text');
                if (!$has_icon && !empty($value['selected_icon']['value'])) {
                    $has_icon = true;
                }
                $is_new = !isset($value['icon']) && Icons_Manager::is_migration_allowed();

?>
                <div class="elementor-icon-box-wrapper">
                    <?php if ($has_icon) : ?>
                        <div class="elementor-icon-box-icon">
                            <<?php Utils::print_validated_html_tag($icon_tag); ?> <?php $this->print_render_attribute_string('icon'); ?> <?php $this->print_render_attribute_string('link'); ?>>
                                <?php
                                if ($is_new) {
                                    Icons_Manager::render_icon($value['selected_icon'], ['aria-hidden' => 'true']);
                                } elseif (!empty($settings['icon'])) {
                                ?><i <?php $this->print_render_attribute_string('i'); ?>></i><?php
                                                                                            }
                                                                                                ?>
                            </<?php Utils::print_validated_html_tag($icon_tag); ?>>
                        </div>
                    <?php endif; ?>
                    <div class="elementor-icon-box-content">
                        <<?php Utils::print_validated_html_tag($settings['title_size']); ?> class="elementor-icon-box-title">
                            <<?php Utils::print_validated_html_tag($icon_tag); ?> <?php $this->print_render_attribute_string('link'); ?> <?php $this->print_render_attribute_string('title_text'); ?>>
                                <?php echo $value['title_text']  ?>
                            </<?php Utils::print_validated_html_tag($icon_tag); ?>>
                        </<?php Utils::print_validated_html_tag($settings['title_size']); ?>>
                        <?php if (!Utils::is_empty($value['description_text'])) : ?>
                            <p class="elementor-icon-box-description"><?php echo $value['description_text']  ?></p>
                        <?php endif; ?>
                    </div>
                </div>
<?php echo '</div>';
            endforeach;
            echo '</div>';
            echo '<div class="elementor-swiper-button elementor-swiper-button-prev">
                <i class="eicon-chevron-left" aria-hidden="true"></i>
                <span class="elementor-screen-only">Previous</span>
            </div>';
            echo '<div class="elementor-swiper-button elementor-swiper-button-next">
                <i class="eicon-chevron-right" aria-hidden="true"></i>
                <span class="elementor-screen-only">Next</span>
            </div>';
            echo '</div>';
        endif;
    }
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new AsystemMobile());
