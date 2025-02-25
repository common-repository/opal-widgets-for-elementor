<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class OSF_Elementor_Metadata_Widget extends Elementor\Widget_Base {

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
        return 'opal-metadata';
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
        return __('Opal Portfolio Metadata', 'opalelementor');
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
        return 'eicon-columns';
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
            'section_metadata',
            [
                'label' => __('Data', 'opalelementor'),
            ]
        );


        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => array(
                    'horizontal' => esc_html__('Horizontal', 'opalelementor'),
                    'vertical' => esc_html__('Vertical', 'opalelementor'),
                ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'label',
            [
                'label'   => __('Label', 'opalelementor'),
                'default' => 'Client',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'value',
            [
                'label'   => __('Value', 'opalelementor'),
                'default' => 'Google',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'data',
            [
                'label'       => __('Meta Item', 'opalelementor'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{label}}}',
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
        if (!empty($settings['data']) && is_array($settings['data'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-metadata-wrapper');
            $this->add_render_attribute('wrapper', 'class', $settings['style']);

            ?>
            <ul <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <?php foreach ($settings['data'] as $data): ?>
                    <li>
                        <span class="label"><?php echo esc_html($data['label']);?></span>:
                        <span class="value"><?php echo esc_html($data['value']);?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php
        }
    }
}
