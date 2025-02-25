<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Background;


class OSF_Elementor_Price_table_Widget extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-price-table';
    }

    public function get_title() {
        return __('Opal Price Table', 'opalelementor');
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_header',
            [
                'label' => __('Header', 'opalelementor'),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => __('Title', 'opalelementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Pricing Table', 'opalelementor'),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' => __('Subtitle', 'opalelementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('I am subtitle', 'opalelementor'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing',
            [
                'label' => __('Pricing', 'opalelementor'),
            ]
        );

        $this->add_control(
            'currency_symbol',
            [
                'label' => __('Currency Symbol', 'opalelementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('None', 'opalelementor'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'opalelementor'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'opalelementor'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'opalelementor'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'opalelementor'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'opalelementor'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'opalelementor'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'opalelementor'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'opalelementor'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'opalelementor'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'opalelementor'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'opalelementor'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'opalelementor'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'opalelementor'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'opalelementor'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'opalelementor'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'opalelementor'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'opalelementor'),
                    'custom' => __('Custom', 'opalelementor'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_symbol_custom',
            [
                'label' => __('Custom Symbol', 'opalelementor'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency_symbol' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('Price', 'opalelementor'),
                'type' => Controls_Manager::TEXT,
                'default' => '39.99',
            ]
        );

        $this->add_control(
            'currency_format',
            [
                'label' => __('Currency Format', 'opalelementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => '1,234.56 (Default)',
                    ',' => '1.234,56',
                ],
            ]
        );

        $this->add_control(
            'sale',
            [
                'label' => __('Sale', 'opalelementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('On', 'opalelementor'),
                'label_off' => __('Off', 'opalelementor'),
                'default' => '',
            ]
        );

        $this->add_control(
            'original_price',
            [
                'label' => __('Original Price', 'opalelementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => '59',
                'condition' => [
                    'sale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __('Period', 'opalelementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Monthly', 'opalelementor'),
            ]
        );
        $this->add_control(
            'logo',
            [
                'label' => __('Logo', 'opalelementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('On', 'opalelementor'),
                'label_off' => __('Off', 'opalelementor'),
                'default' => '',
                
            ]
        );
        $this->add_control(
            'image_logo',
            [
                'label' => __( 'Choose Image', 'opalelementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'logo' => 'yes'
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_features',
            [
                'label' => __('Features', 'opalelementor'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label' => __('Text', 'opalelementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('List Item', 'opalelementor'),
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => __('Icon', 'opalelementor'),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-check-circle',
            ]
        );

        $repeater->add_control(
            'item_icon_color',
            [
                'label' => __('Icon Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_text' => __('List Item #1', 'opalelementor'),
                        'item_icon' => 'fa fa-check-circle',
                    ],
                    [
                        'item_text' => __('List Item #2', 'opalelementor'),
                        'item_icon' => 'fa fa-check-circle',
                    ],
                    [
                        'item_text' => __('List Item #3', 'opalelementor'),
                        'item_icon' => 'fa fa-check-circle',
                    ],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer',
            [
                'label' => __('Footer', 'opalelementor'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'opalelementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Click Here', 'opalelementor'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link', 'opalelementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'opalelementor'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'footer_additional_info',
            [
                'label' => __('Additional Info', 'opalelementor'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('This is text element', 'opalelementor'),
                'rows' => 2,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ribbon',
            [
                'label' => __('Ribbon', 'opalelementor'),
            ]
        );

        $this->add_control(
            'show_ribbon',
            [
                'label' => __('Show', 'opalelementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ribbon_title',
            [
                'label' => __('Title', 'opalelementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Popular', 'opalelementor'),
                'condition' => [
                    'show_ribbon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ribbon_horizontal_position',
            [
                'label' => __('Horizontal Position', 'opalelementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'opalelementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'opalelementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'condition' => [
                    'show_ribbon' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_header_style',
            [
                'label' => __('Header', 'opalelementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'header_bg_color',
            [
                'label' => __('Background Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' => __('Padding', 'opalelementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_alignment',
            [
                'label' => __('Alignment', 'opalelementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'opalelementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'opalelementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'opalelementor'),
                        'icon' => 'eicon-h-align-righ',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_heading_style',
            [
                'label' => __('Title', 'opalelementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__heading',
            ]
        );

        $this->add_control(
            'heading_sub_heading_style',
            [
                'label' => __('Sub Title', 'opalelementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => __('Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__subheading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__subheading',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_element_style',
            [
                'label' => __('Pricing', 'opalelementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'pricing_element_bg_color',
            [
                'label' => __('Background Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__price' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_element_padding',
            [
                'label' => __('Padding', 'opalelementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __('Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency, {{WRAPPER}} .elementor-price-table__integer-part, {{WRAPPER}} .elementor-price-table__fractional-part' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__price',
            ]
        );

        $this->add_control(
            'pricing_alignment',
            [
                'label' => __('Alignment', 'opalelementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'opalelementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'opalelementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'opalelementor'),
                        'icon' => 'eicon-h-align-righ',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__price' => 'text-align: {{VALUE}};justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_currency_style',
            [
                'label' => __('Currency Symbol', 'opalelementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'currency_symbol!' => '',
                ],
            ]
        );

        $this->add_control(
            'currency_size',
            [
                'label' => __('Size', 'opalelementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency' => 'font-size: calc({{SIZE}}em/100)',
                ],
                'condition' => [
                    'currency_symbol!' => '',
                ],
            ]
        );

        $this->add_control(
            'currency_vertical_position',
            [
                'label' => __('Vertical Position', 'opalelementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'opalelementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'opalelementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'opalelementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency' => 'align-self: {{VALUE}}',
                ],
                'condition' => [
                    'currency_symbol!' => '',
                ],
            ]
        );

        $this->add_control(
            'fractional_part_style',
            [
                'label' => __('Fractional Part', 'opalelementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fractional-part_size',
            [
                'label' => __('Size', 'opalelementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__fractional-part' => 'font-size: calc({{SIZE}}em/100)',
                ],
            ]
        );

        $this->add_control(
            'fractional_part_vertical_position',
            [
                'label' => __('Vertical Position', 'opalelementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'opalelementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'opalelementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'opalelementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__after-price' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_original_price_style',
            [
                'label' => __('Original Price', 'opalelementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'sale' => 'yes',
                    'original_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'original_price_color',
            [
                'label' => __('Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__original-price' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'sale' => 'yes',
                    'original_price!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'original_price_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__original-price',
                'condition' => [
                    'sale' => 'yes',
                    'original_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'original_price_vertical_position',
            [
                'label' => __('Vertical Position', 'opalelementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'opalelementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'opalelementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'opalelementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'default' => 'bottom',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__original-price' => 'align-self: {{VALUE}}',
                ],
                'condition' => [
                    'sale' => 'yes',
                    'original_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_period_style',
            [
                'label' => __('Period', 'opalelementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => __('Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__period' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__period',
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->add_control(
            'period_position',
            [
                'label' => __('Position', 'opalelementor'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'below' => 'Below',
                    'beside' => 'Beside',
                ],
                'default' => 'below',
                'condition' => [
                    'period!' => '',
                ],
            ]
        );
        $this->add_control(
            'heading_logo_style',
            [
                'label' => __('Logo', 'opalelementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'logo' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'logo_size',
            [
                'label' => __('Size', 'opalelementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__logo' => 'width: {{SIZE}}px; height: auto;',
                ],
                'condition' => [
                    'logo' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features_list_style',
            [
                'label' => __('Features', 'opalelementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'features_list_bg_color',
            [
                'label' => __('Background Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_padding',
            [
                'label' => __('Padding', 'opalelementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_list_color',
            [
                'label' => __('Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__features-list li',
            ]
        );

        $this->add_control(
            'features_list_alignment',
            [
                'label' => __('Alignment', 'opalelementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'opalelementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'opalelementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'opalelementor'),
                        'icon' => 'eicon-h-align-righ',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_width',
            [
                'label' => __('Width', 'opalelementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 25,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__feature-inner' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
                ],
            ]
        );

        $this->add_control(
            'list_divider',
            [
                'label' => __('Divider', 'opalelementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'divider_style',
            [
                'label' => __('Style', 'opalelementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => __('Solid', 'opalelementor'),
                    'double' => __('Double', 'opalelementor'),
                    'dotted' => __('Dotted', 'opalelementor'),
                    'dashed' => __('Dashed', 'opalelementor'),
                ],
                'default' => 'solid',
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li' => 'border-top-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => __('Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ddd',
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_weight',
            [
                'label' => __('Weight', 'opalelementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'divider_width',
            [
                'label' => __('Width', 'opalelementor'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
                ],
            ]
        );

        $this->add_control(
            'divider_gap',
            [
                'label' => __('Gap', 'opalelementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li' => 'padding-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'freatures_boder',
            [
                'label' => __('Boder', 'opalelementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'freatures_color',
            [
                'label' => __('Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ddd',
                'condition' => [
                    'freatures_boder' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'freatures_style',
            [
                'label' => __('Style', 'opalelementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => __('Solid', 'opalelementor'),
                    'double' => __('Double', 'opalelementor'),
                    'dotted' => __('Dotted', 'opalelementor'),
                    'dashed' => __('Dashed', 'opalelementor'),
                ],
                'default' => 'solid',
                'condition' => [
                    'freatures_boder' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'features_border_width',
            [
                'label' => __('Border Width', 'opalelementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'condition' => [
                    'freatures_boder' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer_style',
            [
                'label' => __('Footer', 'opalelementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'footer_bg_color',
            [
                'label' => __('Background Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'footer_padding',
            [
                'label' => __('Padding', 'opalelementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'footer_list_alignment',
            [
                'label' => __('Alignment', 'opalelementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'opalelementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'opalelementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'opalelementor'),
                        'icon' => 'eicon-h-align-righ',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_footer_button',
            [
                'label' => __('Button', 'opalelementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __('Size', 'opalelementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => [
                    'xs' => __('Extra Small', 'opalelementor'),
                    'sm' => __('Small', 'opalelementor'),
                    'md' => __('Medium', 'opalelementor'),
                    'lg' => __('Large', 'opalelementor'),
                    'xl' => __('Extra Large', 'opalelementor'),
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'opalelementor'),
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__button',
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background_gradient',
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .elementor-price-table__button',    
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'button_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-price-table__button',
                'condition' => [
                    'button_text!' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'opalelementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_text_padding',
            [
                'label' => __('Text Padding', 'opalelementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'opalelementor'),
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __('Background Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background_gradient_hover',
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .elementor-price-table__button:hover',    
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __('Animation', 'opalelementor'),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'heading_additional_info',
            [
                'label' => __('Additional Info', 'opalelementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'footer_additional_info!' => '',
                ],
            ]
        );

        $this->add_control(
            'additional_info_color',
            [
                'label' => __('Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__additional_info' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'footer_additional_info!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'additional_info_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__additional_info',
                'condition' => [
                    'footer_additional_info!' => '',
                ],
            ]
        );

        $this->add_control(
            'additional_info_margin',
            [
                'label' => __('Margin', 'opalelementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 15,
                    'right' => 30,
                    'bottom' => 0,
                    'left' => 30,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__additional_info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition' => [
                    'footer_additional_info!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ribbon_style',
            [
                'label' => __('Ribbon', 'opalelementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
                'condition' => [
                    'show_ribbon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ribbon_bg_color',
            [
                'label' => __('Background Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__ribbon-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

        $this->add_responsive_control(
            'ribbon_distance',
            [
                'label' => __('Distance', 'opalelementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__ribbon-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
                ],
            ]
        );

        $this->add_control(
            'ribbon_text_color',
            [
                'label' => __('Text Color', 'opalelementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__ribbon-inner' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ribbon_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__ribbon-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .elementor-price-table__ribbon-inner',
            ]
        );

        $this->end_controls_section();
    }

    private function get_currency_symbol($symbol_name) {
        $symbols = [
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'pound' => '&#163;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'baht' => '&#3647;',
            'yen' => '&#165;',
            'won' => '&#8361;',
            'guilder' => '&fnof;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'rupee' => '&#8360;',
            'indian_rupee' => '&#8377;',
            'real' => 'R$',
            'krona' => 'kr',
        ];
        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    protected function _render_image_icon( $settings ){
        $image_html = '';
   
        if(!empty($settings['image_logo']['url'])){
            $image_url = $settings['image_logo']['url']; 
            $path_parts = pathinfo($image_url);
            if ($path_parts['extension'] === 'svg') {
                $pathSvg = get_attached_file( $settings['image_logo']['id'] );
                return osf_elementor_get_icon_svg($pathSvg);
            }  
             $image_html = Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image_logo' );
        }
        return $image_html; 
    }

    protected function render() {
        $settings = $this->get_settings();

        $image_html = $this->_render_image_icon($settings);

        $symbol = '';

        if (!empty($settings['currency_symbol'])) {
            if ('custom' !== $settings['currency_symbol']) {
                $symbol = $this->get_currency_symbol($settings['currency_symbol']);
            } else {
                $symbol = $settings['currency_symbol_custom'];
            }
        }
        $currency_format = empty($settings['currency_format']) ? '.' : $settings['currency_format'];
        $price = explode($currency_format, $settings['price']);
        $intpart = $price[0];
        $fraction = '';
        if (2 === count($price)) {
            $fraction = $price[1];
        }

        $this->add_render_attribute('button_text', 'class', [
            'elementor-price-table__button',
            'elementor-button',
            'elementor-size-' . $settings['button_size'],
        ]);

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('button_text', 'href', $settings['link']['url']);

            if (!empty($settings['link']['is_external'])) {
                $this->add_render_attribute('button_text', 'target', '_blank');
            }
        }

        if (!empty($settings['button_hover_animation'])) {
            $this->add_render_attribute('button_text', 'class', 'elementor-animation-' . $settings['button_hover_animation']);
        }

        $this->add_render_attribute('heading', 'class', 'elementor-price-table__heading');
        $this->add_render_attribute('sub_heading', 'class', 'elementor-price-table__subheading');
        $this->add_render_attribute('period', 'class', ['elementor-price-table__period', 'elementor-typo-excluded']);
        $this->add_render_attribute('footer_additional_info', 'class', 'elementor-price-table__additional_info');
        $this->add_render_attribute('ribbon_title', 'class', 'elementor-price-table__ribbon-inner');

        $this->add_inline_editing_attributes('heading', 'none');
        $this->add_inline_editing_attributes('sub_heading', 'none');
        $this->add_inline_editing_attributes('period', 'none');
        $this->add_inline_editing_attributes('footer_additional_info');
        $this->add_inline_editing_attributes('button_text');
        $this->add_inline_editing_attributes('ribbon_title');

        $period_position = $settings['period_position'];
        $period_element = '<span ' . $this->get_render_attribute_string('period') . '>' . $settings['period'] . '</span>';
        ?>

        <div class="elementor-price-table">
            <?php if ($settings['heading'] || $settings['sub_heading']) : ?>
                <div class="elementor-price-table__header">
                    <?php if (!empty($settings['heading'])) : ?>
                        <h3 <?php echo $this->get_render_attribute_string('heading'); ?>><?php echo $settings['heading']; ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($settings['sub_heading'])) : ?>
                        <span <?php echo $this->get_render_attribute_string('sub_heading'); ?>><?php echo $settings['sub_heading']; ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="elementor-price-table__price">
                <?php if ('yes' === $settings['sale'] && !empty($settings['original_price'])) : ?>
                    <div class="elementor-price-table__original-price elementor-typo-excluded"><?php echo $symbol . $settings['original_price']; ?></div>
                <?php endif; ?>
                <?php if (!empty($symbol)) : ?>
                    <span class="elementor-price-table__currency"><?php echo $symbol; ?></span>
                <?php endif; ?>
                <?php if (!empty($intpart) || 0 <= $intpart) : ?>
                    <span class="elementor-price-table__integer-part"><?php echo $intpart; ?></span>
                <?php endif; ?>

                <?php if ('' !== $fraction || (!empty($settings['period']) && 'beside' === $period_position)) : ?>
                    <div class="elementor-price-table__after-price">
                        <span class="elementor-price-table__fractional-part"><?php echo $fraction; ?></span>
                        <?php if (!empty($settings['period']) && 'beside' === $period_position) : ?>
                            <?php echo $period_element; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['period']) && 'below' === $period_position) : ?>
                    <?php echo $period_element; ?>
                <?php endif; ?>
                <?php if( !empty($settings['image_logo'] ) && $settings['logo'] === 'yes' ) :  ?> 
                    <span class="elementor-price-table__logo"><?php echo $image_html; ?></span>
                <?php endif; ?>
            </div>

            <?php if (!empty($settings['features_list'])) : ?>
                <ul class="elementor-price-table__features-list">
                    <?php foreach ($settings['features_list'] as $index => $item) :
                        $repeater_setting_key = $this->get_repeater_setting_key('item_text', 'features_list', $index);
                        $this->add_inline_editing_attributes($repeater_setting_key);
                        ?>
                        <li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
                            <div class="elementor-price-table__feature-inner">
                                <?php if (!empty($item['item_icon'])) : ?>
                                    <i class="<?php echo esc_attr($item['item_icon']); ?>" aria-hidden="true"></i>
                                <?php endif; ?>
                                <?php if (!empty($item['item_text'])) : ?>
                                    <span <?php echo $this->get_render_attribute_string($repeater_setting_key); ?>>
										<?php echo $item['item_text']; ?>
									</span>
                                <?php else :
                                    echo '&nbsp;';
                                endif;
                                ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($settings['button_text']) || !empty($settings['footer_additional_info'])) : ?>
                <div class="elementor-price-table__footer">
                    <?php if (!empty($settings['button_text'])) : ?>
                        <a <?php echo $this->get_render_attribute_string('button_text'); ?>><?php echo $settings['button_text']; ?></a>
                    <?php endif; ?>

                    <?php if (!empty($settings['footer_additional_info'])) : ?>
                        <div <?php echo $this->get_render_attribute_string('footer_additional_info'); ?>><?php echo $settings['footer_additional_info']; ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ('yes' === $settings['show_ribbon'] && !empty($settings['ribbon_title'])) :
            $this->add_render_attribute('ribbon-wrapper', 'class', 'elementor-price-table__ribbon');

            if (!empty($settings['ribbon_horizontal_position'])) :
                $this->add_render_attribute('ribbon-wrapper', 'class', 'elementor-ribbon-' . $settings['ribbon_horizontal_position']);
            endif;

            ?>
            <div <?php echo $this->get_render_attribute_string('ribbon-wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('ribbon_title'); ?>><?php echo $settings['ribbon_title']; ?></div>
            </div>
        <?php endif;
    }

    protected function content_template() {
        ?>
        <#
        var symbols = {
        dollar: '&#36;',
        euro: '&#128;',
        franc: '&#8355;',
        pound: '&#163;',
        ruble: '&#8381;',
        shekel: '&#8362;',
        baht: '&#3647;',
        yen: '&#165;',
        won: '&#8361;',
        guilder: '&fnof;',
        peso: '&#8369;',
        peseta: '&#8359;',
        lira: '&#8356;',
        rupee: '&#8360;',
        indian_rupee: '&#8377;',
        real: 'R$',
        krona: 'kr'
        };

        var symbol = '';

        if ( settings.currency_symbol ) {
        if ( 'custom' !== settings.currency_symbol ) {
        symbol = symbols[ settings.currency_symbol ] || '';
        } else {
        symbol = settings.currency_symbol_custom;
        }
        }

        if ( settings.button_hover_animation ) {
        buttonClasses += ' elementor-animation-' + settings.button_hover_animation;
        }

        var buttonClasses = 'elementor-price-table__button elementor-button elementor-size-' + settings.button_size;

        view.addRenderAttribute( 'heading', 'class', 'elementor-price-table__heading' );
        view.addRenderAttribute( 'sub_heading', 'class', 'elementor-price-table__subheading' );
        view.addRenderAttribute( 'period', 'class', ['elementor-price-table__period', 'elementor-typo-excluded'] );
        view.addRenderAttribute( 'footer_additional_info', 'class', 'elementor-price-table__additional_info'  );
        view.addRenderAttribute( 'button_text', 'class', buttonClasses  );
        view.addRenderAttribute( 'ribbon_title', 'class', 'elementor-price-table__ribbon-inner'  );

        view.addInlineEditingAttributes( 'heading', 'none' );
        view.addInlineEditingAttributes( 'sub_heading', 'none' );
        view.addInlineEditingAttributes( 'period', 'none' );
        view.addInlineEditingAttributes( 'footer_additional_info' );
        view.addInlineEditingAttributes( 'button_text' );
        view.addInlineEditingAttributes( 'ribbon_title' );

        var currencyFormat = settings.currency_format || '.',
        price = settings.price.split( currencyFormat ),
        intpart = price[0],
        fraction = price[1],

        periodElement = '<span ' + view.getRenderAttributeString( "period" ) + '>' + settings.period + '</span>';


        #>
        <div class="elementor-price-table">
            <# if ( settings.heading || settings.sub_heading ) { #>
            <div class="elementor-price-table__header">
                <# if ( settings.heading ) { #>
                <h3 {{{ view.getRenderAttributeString( 'heading' ) }}}>{{{ settings.heading }}}</h3>
                <# } #>
                <# if ( settings.sub_heading ) { #>
                <span {{{ view.getRenderAttributeString( 'sub_heading' ) }}}>{{{ settings.sub_heading }}}</span>
                <# } #>
            </div>
            <# } #>

            <div class="elementor-price-table__price">
                <# if ( settings.sale && settings.original_price ) { #>
                <div class="elementor-price-table__original-price elementor-typo-excluded">{{{ symbol +
                    settings.original_price }}}
                </div>
                <# } #>

                <# if ( ! _.isEmpty( symbol ) ) { #>
                <span class="elementor-price-table__currency">{{{ symbol }}}</span>
                <# } #>
                <# if ( intpart ) { #>
                <span class="elementor-price-table__integer-part">{{{ intpart }}}</span>
                <# } #>
                <div class="elementor-price-table__after-price">
                    <# if ( fraction ) { #>
                    <span class="elementor-price-table__fractional-part">{{{ fraction }}}</span>
                    <# } #>
                    <# if ( settings.period && 'beside' === settings.period_position ) { #>
                    {{{ periodElement }}}
                    <# } #>
                </div>

                <# if ( settings.period && 'below' === settings.period_position ) { #>
                {{{ periodElement }}}
                <# } #>

                <# if ( settings.image_logo && 'yes' === settings.logo ) { #>
                    <span class="elementor-price-table__logo">
                        <img src=" {{ settings.image_logo.url }} " title="" alt="">
                    </span>
                <# } #>
            </div>

            <# if ( settings.features_list ) { #>
            <ul class="elementor-price-table__features-list">
                <# _.each( settings.features_list, function( item, index ) {

                var featureKey = view.getRepeaterSettingKey( 'item_text', 'features_list', index );

                view.addInlineEditingAttributes( featureKey ); #>

                <li class="elementor-repeater-item-{{ item._id }}">
                    <div class="elementor-price-table__feature-inner">
                        <# if ( item.item_icon ) { #>
                        <i class="{{ item.item_icon }}" aria-hidden="true"></i>
                        <# } #>
                        <# if ( ! _.isEmpty( item.item_text.trim() ) ) { #>
                        <span {{{ view.getRenderAttributeString( featureKey ) }}}>{{{ item.item_text }}}</span>
                        <# } else { #>
                        &nbsp;
                        <# } #>
                    </div>
                </li>
                <# } ); #>
            </ul>
            <# } #>

            <# if ( settings.button_text || settings.footer_additional_info ) { #>
            <div class="elementor-price-table__footer">
                <# if ( settings.button_text ) { #>
                <a href="#" {{{ view.getRenderAttributeString( 'button_text' ) }}}>{{{ settings.button_text }}}</a>
                <# } #>
                <# if ( settings.footer_additional_info ) { #>
                <p {{{ view.getRenderAttributeString( 'footer_additional_info' ) }}}>{{{ settings.footer_additional_info
                }}}</p>
                <# } #>
            </div>
            <# } #>
        </div>

        <# if ( 'yes' === settings.show_ribbon && settings.ribbon_title ) {
        var ribbonClasses = 'elementor-price-table__ribbon';
        if ( settings.ribbon_horizontal_position ) {
        ribbonClasses += ' elementor-ribbon-' + settings.ribbon_horizontal_position;
        } #>
        <div class="{{ ribbonClasses }}">
            <div {{{ view.getRenderAttributeString(
            'ribbon_title' ) }}}>{{{ settings.ribbon_title }}}
        </div>
        </div>
        <# } #>
        <?php
    }
}
