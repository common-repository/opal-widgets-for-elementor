<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class OSF_Elementor_Text_carousel_Widget extends OSF_Elementor_Slick_Widget {

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'opal-text_carousel';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Opal Text Carousel', 'opalelementor');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_text_carousel',
            [
                'label' => __('Content', 'opalelementor'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => __('Title', 'opalelementor'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Title', 'opalelementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label'       => __('Sub Title', 'opalelementor'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Sub Title', 'opalelementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label'       => __('Content', 'opalelementor'),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                'label_block' => true,
                'rows'        => '10',
            ]
        );

        $this->add_control(
            'contents',
            [
                'label'       => __('Content Item', 'opalelementor'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'text_alignment',
            [
                'label'     => __('Alignment', 'opalelementor'),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'center',
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'opalelementor'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'opalelementor'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'opalelementor'),
                        'icon'  => 'eicon-h-align-righ',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label'   => __('HTML Tag', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_control(
            'subtitle_position',
            [
                'label'   => __('Subtitle Position', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'after'  => __('After Title', 'opalelementor'),
                    'before' => __('Before Title', 'opalelementor'),
                ],
            ]
        );


        $this->add_responsive_control(
            'column',
            [
                'label'   => __('Columns', 'opalelementor'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3],
            ]
        );


        $this->add_control(
            'enable_carousel',
            [
                'label' => __('Enable', 'opalelementor'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();


        $this->add_slick_controls(array('enable_carousel' => 'yes'), ' .product-slick-carousel ');

        // Style.
        $this->start_controls_section(
            'section_text_carousel_style',
            [
                'label' => __('Content', 'opalelementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Text Color', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-content',
            ]
        );

        $this->end_controls_section();

        // Title Style.
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'opalelementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->end_controls_section();

        // SubTitle Style.
        $this->start_controls_section(
            'section_subtitle_style',
            [
                'label' => __('Sub Title', 'opalelementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'     => __('Sub Title Color', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .subtitle',
            ]
        );

        $this->end_controls_section();


    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['contents']) && is_array($settings['contents'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-opal-slick-slider elementor-slick-slider');

            // Row
            $this->add_render_attribute('row', 'class', 'row-slick-items');

            // Item
            $this->add_render_attribute('item', 'class', 'elementor-content-item');
            $this->add_render_attribute('item', 'class', 'column-item');

            $this->add_render_attribute('meta', 'class', 'elementor-content-meta');

            $this->add_render_attribute('title', 'class', 'elementor-heading-title');

            $this->add_render_attribute('subtitle', 'class', $settings['subtitle_position']);
            $this->add_render_attribute('subtitle', 'class', 'subtitle');
            if ( $settings['enable_carousel'] === 'yes' ) {
                $data = $this->get_settings_json();
                $this->add_render_attribute('wrapper', 'data-settings', $data);
            }
            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['contents'] as $content): ?>
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>
                            <?php printf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string('title'), $content['title']); ?>
                            <?php if (!empty($content['subtitle'])): ?>
                                <div <?php echo $this->get_render_attribute_string('subtitle') ?>>
                                    <?php echo $content['subtitle'] ?>
                                </div>
                            <?php endif; ?>
                            <div class="elementor-content">
                                <?php echo $content['content']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }

}
