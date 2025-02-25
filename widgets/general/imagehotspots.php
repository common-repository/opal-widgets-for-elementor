<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
class OSF_Elementor_Imagehotspots_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'opal-image-hotspots';
	}

 	/**
     * Get widget title.
     *
     * Retrieve google maps widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Opal Image Hotspots', 'opalelementor' );
    }

    public function get_script_depends() {
		return [
			'tooltipster',
		];
	}

	public function get_style_depends() {
		return [
			'tooltipster',
		];
	}

    /**
     * Get widget icon.
     *
     * Retrieve google maps widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-google-maps';
    }
 

	 /**
     * Get widget categories.
     *
     * Retrieve the list of categories the google maps widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'opal-addons' ];
    }

	protected function register_controls() {

		/**START Background Image Section  **/
		$this->start_controls_section( 'image_hotspots_image_section',
			[
				'label' => esc_html__( 'Image', 'opalelementor' ),
			]
		);

		$this->add_control( 'image_hotspots_image',
			[
				'label'       => __( 'Choose Image', 'opalelementor' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'label_block' => true
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'background_image', // Actually its `image_size`.
				'default' => 'full'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'image_hotspots_icons_settings',
			[
				'label' => esc_html__( 'Hotspots', 'opalelementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control( 'image_hotspots_icon_type_switch',
			[
				'label'       => esc_html__( 'Display On', 'opalelementor' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'font_awesome_icon' => esc_html__( 'Font Awesome Icon', 'opalelementor' ),
					'custom_image'      => esc_html__( 'Custom Image', 'opalelementor' ),
					'text'              => esc_html__( 'Text', 'opalelementor' ),
				],
				'default'     => 'font_awesome_icon',
				'label_block' => true,
			] );

		$repeater->add_control( 'image_hotspots_font_awesome_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'opalelementor' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-map-marker',
				'condition' => [
					'image_hotspots_icon_type_switch' => 'font_awesome_icon',
				]
			]
		);

		$repeater->add_control( 'image_hotspots_custom_image',
			[
				'label'     => esc_html__( 'Custom Image', 'opalelementor' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'image_hotspots_icon_type_switch' => 'custom_image',
				]
			]
		);

		$repeater->add_control( 'image_hotspots_text',
			[
				'label'     => esc_html__( 'Text', 'opalelementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [ 'active' => true ],
				'condition' => [
					'image_hotspots_icon_type_switch' => 'text',
				]
			] );

		$repeater->add_responsive_control( 'preimum_image_hotspots_main_icons_horizontal_position',
			[
				'label'      => esc_html__( 'Horizontal Position', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'default'    => [
					'size' => 50,
					'unit' => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.opal-image-hotspots-main-icons' => 'left: {{SIZE}}{{UNIT}}'
				]
			]
		);

		$repeater->add_responsive_control( 'preimum_image_hotspots_main_icons_vertical_position',
			[
				'label'      => esc_html__( 'Vertical Position', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'default'    => [
					'size' => 50,
					'unit' => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.opal-image-hotspots-main-icons' => 'top: {{SIZE}}{{UNIT}}'
				]
			]
		);

		if ( otf_is_woocommerce_activated() ) {
			$repeater->add_control( 'image_hotspots_content',
				[
					'label'   => esc_html__( 'Content to Show', 'opalelementor' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'text_editor'         => esc_html__( 'Text Editor', 'opalelementor' ),
						'elementor_templates' => esc_html__( 'Elementor Template', 'opalelementor' ),
						'elementor_product'   => esc_html__( 'Product', 'opalelementor' ),
					],
					'default' => 'text_editor'
				]
			);
		} else {
			$repeater->add_control( 'image_hotspots_content',
				[
					'label'   => esc_html__( 'Content to Show', 'opalelementor' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'text_editor'         => esc_html__( 'Text Editor', 'opalelementor' ),
						'elementor_templates' => esc_html__( 'Elementor Template', 'opalelementor' ),
					],
					'default' => 'text_editor'
				]
			);
		}

		$repeater->add_control( 'image_hotspots_tooltips_texts',
			[
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => 'Lorem ipsum',
				'dynamic'     => [ 'active' => true ],
				'label_block' => true,
				'condition'   => [
					'image_hotspots_content' => 'text_editor'
				]
			] );

		$repeater->add_control( 'image_hotspots_tooltips_temp',
			[
				'label'     => esc_html__( 'Teamplate ID', 'opalelementor' ),
				'type'      => Controls_Manager::NUMBER,
				'condition' => [
					'image_hotspots_content' => 'elementor_templates'
				],
			] );
		$repeater->add_control( 'image_hotspots_tooltips_product',
			[
				'label'     => __( 'Product id', 'opalelementor' ),
				'type'      => Controls_Manager::SELECT2,
				'options'   => $this->get_products_id(),
				'condition' => [
					'image_hotspots_content' => 'elementor_product'
				],
			]
		);

		$repeater->add_control( 'image_hotspots_product_detail',
			[
				'label'       => esc_html__( 'Product Detail', 'opalelementor' ),
				'type'        => Controls_Manager::SWITCHER,
				'condition' => [
					'image_hotspots_content' => 'elementor_product'
				],
			] );

		$repeater->add_control( 'image_hotspots_link_switcher',
			[
				'label'       => esc_html__( 'Link', 'opalelementor' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'Add a custom link or select an existing page link', 'opalelementor' ),
			] );

		$repeater->add_control( 'image_hotspots_link_type',
			[
				'label'       => esc_html__( 'Link/URL', 'opalelementor' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'url'  => esc_html__( 'URL', 'opalelementor' ),
					'link' => esc_html__( 'Existing Page', 'opalelementor' ),
				],
				'default'     => 'url',
				'condition'   => [
					'image_hotspots_link_switcher' => 'yes',
				],
				'label_block' => true,
			] );

//		$repeater->add_control( 'image_hotspots_existing_page',
//			[
//				'label'       => esc_html__( 'Existing Page', 'strollik-core' ),
//				'type'        => Controls_Manager::SELECT2,
//				'description' => esc_html__( 'Active only when tooltips trigger is set to hover', 'strollik-core' ),
//				'options'     => $this->getTemplateInstance()->get_all_post(),
//				'multiple'    => false,
//				'condition'   => [
//					'image_hotspots_link_switcher' => 'yes',
//					'image_hotspots_link_type'     => 'link',
//				],
//				'label_block' => true,
//			] );

		$repeater->add_control( 'image_hotspots_url',
			[
				'label'       => esc_html__( 'URL', 'opalelementor' ),
				'type'        => Controls_Manager::URL,
				'condition'   => [
					'image_hotspots_link_switcher' => 'yes',
					'image_hotspots_link_type'     => 'url',
				],
				'placeholder' => 'https://wpopal.com/',
				'label_block' => true
			] );

		$repeater->add_control( 'image_hotspots_link_text',
			[
				'label'       => esc_html__( 'Link Title', 'opalelementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'condition'   => [
					'image_hotspots_link_switcher' => 'yes',
				],
				'label_block' => true
			] );

		$this->add_control( 'image_hotspots_icons',
			[
				'label'  => esc_html__( 'Hotspots', 'opalelementor' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->add_control( 'image_hotspots_icons_animation',
			[
				'label' => esc_html__( 'Radar Animation', 'opalelementor' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'image_hotspots_tooltips_section',
			[
				'label' => esc_html__( 'Tooltips', 'opalelementor' ),
			]
		);

		$this->add_control(
			'image_hotspots_trigger_type',
			[
				'label'   => esc_html__( 'Trigger', 'opalelementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'click' => esc_html__( 'Click', 'opalelementor' ),
					'hover' => esc_html__( 'Hover', 'opalelementor' ),
				],
				'default' => 'hover'
			]
		);

		$this->add_control(
			'image_hotspots_arrow',
			[
				'label'     => esc_html__( 'Show Arrow', 'opalelementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'opalelementor' ),
				'label_off' => esc_html__( 'Hide', 'opalelementor' ),
			]
		);

		$this->add_control(
			'image_hotspots_tooltips_position',
			[
				'label'       => esc_html__( 'Positon', 'opalelementor' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => [
					'top'    => esc_html__( 'Top', 'opalelementor' ),
					'bottom' => esc_html__( 'Bottom', 'opalelementor' ),
					'left'   => esc_html__( 'Left', 'opalelementor' ),
					'right'  => esc_html__( 'Right', 'opalelementor' ),
				],
				'description' => esc_html__( 'Sets the side of the tooltip. The value may one of the following: \'top\', \'bottom\', \'left\', \'right\'. It may also be an array containing one or more of these values. When using an array, the order of values is taken into account as order of fallbacks and the absence of a side disables it', 'opalelementor' ),
				'default'     => [ 'top', 'bottom' ],
				'label_block' => true,
				'multiple'    => true
			]
		);

		$this->add_control( 'image_hotspots_tooltips_distance_position',
			[
				'label'   => esc_html__( 'Spacing', 'opalelementor' ),
				'type'    => Controls_Manager::NUMBER,
				'title'   => esc_html__( 'The distance between the origin and the tooltip in pixels, default is 6', 'opalelementor' ),
				'default' => 6,
			]
		);

		$this->add_control( 'image_hotspots_min_width',
			[
				'label'       => esc_html__( 'Min Width', 'opalelementor' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 800,
					],
				],
				'description' => esc_html__( 'Set a minimum width for the tooltip in pixels, default: 0 (auto width)', 'opalelementor' ),
			]
		);

		$this->add_control( 'image_hotspots_max_width',
			[
				'label'       => esc_html__( 'Max Width', 'opalelementor' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 800,
					],
				],
				'description' => esc_html__( 'Set a maximum width for the tooltip in pixels, default: null (no max width)', 'opalelementor' ),
			]
		);

		$this->add_responsive_control( 'image_hotspots_tooltips_wrapper_height',
			[
				'label'       => esc_html__( 'Height', 'opalelementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', 'em', '%' ],
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
					]
				],
				'label_block' => true,
				'selectors'   => [
					'.tooltipster-box.tooltipster-box-{{ID}}' => 'height: {{SIZE}}{{UNIT}} !important;'
				]
			]
		);

		$this->add_control( 'image_hotspots_anim',
			[
				'label'       => esc_html__( 'Animation', 'opalelementor' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'fade'  => esc_html__( 'Fade', 'opalelementor' ),
					'grow'  => esc_html__( 'Grow', 'opalelementor' ),
					'swing' => esc_html__( 'Swing', 'opalelementor' ),
					'slide' => esc_html__( 'Slide', 'opalelementor' ),
					'fall'  => esc_html__( 'Fall', 'opalelementor' ),
				],
				'default'     => 'fade',
				'label_block' => true,
			]
		);

		$this->add_control( 'image_hotspots_anim_dur',
			[
				'label'   => esc_html__( 'Animation Duration', 'opalelementor' ),
				'type'    => Controls_Manager::NUMBER,
				'title'   => esc_html__( 'Set the animation duration in milliseconds, default is 350', 'opalelementor' ),
				'default' => 350,
			]
		);

		$this->add_control( 'image_hotspots_delay',
			[
				'label'   => esc_html__( 'Delay', 'opalelementor' ),
				'type'    => Controls_Manager::NUMBER,
				'title'   => esc_html__( 'Set the animation delay in milliseconds, default is 10', 'opalelementor' ),
				'default' => 10,
			]
		);

		$this->add_control( 'image_hotspots_hide',
			[
				'label'        => esc_html__( 'Hide on Mobiles', 'opalelementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => 'Show',
				'label_off'    => 'Hide',
				'description'  => esc_html__( 'Hide tooltips on mobile phones', 'opalelementor' ),
				'return_value' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'image_hotspots_image_style_settings',
			[
				'label' => esc_html__( 'Image', 'opalelementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_hotspots_image_border',
				'selector' => '{{WRAPPER}} .opal-image-hotspots-container .opal-addons-image-hotspots-ib-img',
			]
		);

		$this->add_control( 'image_hotspots_image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-container .opal-addons-image-hotspots-ib-img' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control( 'image_hotspots_image_padding',
			[
				'label'      => esc_html__( 'Padding', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-container .opal-addons-image-hotspots-ib-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'image_hotspots_image_align',
			[
				'label'     => __( 'Text Alignment', 'opalelementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'opalelementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'opalelementor' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'opalelementor' ),
						'icon'  => 'eicon-h-align-righ',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .opal-image-hotspots-container' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'image_hotspots_Hotspots_style_settings',
			[
				'label' => esc_html__( 'Hotspots', 'opalelementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'image_hotspots_main_icons_active_borders_style_tabs' );

		$this->start_controls_tab( 'image_hotspots_main_icons_style_tab',
			[
				'label' => esc_html__( 'Icon', 'opalelementor' ),
			]
		);

		$this->add_control( 'image_hotspots_main_icons_color',
			[
				'label'     => __( 'Color', 'opalelementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-icon' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control( 'preimum_image_hotspots_main_icons_size',
			[
				'label'      => esc_html__( 'Size', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control( 'image_hotspots_main_icons_background_color',
			[
				'label'     => __( 'Background Color', 'opalelementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-icon' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_hotspots_main_icons_border',
				'selector' => '{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-icon'
			]
		);

		$this->add_control( 'image_hotspots_main_icons_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-icon' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'label'    => esc_html__( 'Shadow', 'opalelementor' ),
				'name'     => 'image_hotspots_main_icons_shadow',
				'selector' => '{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-icon'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'image_hotspots_main_icons_shadow',
				'selector'  => '{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-icon',
				'condition' => [
					'image_hotspots_icons_animation!' => 'yes'
				]
			]
		);

		$this->add_responsive_control( 'image_hotspots_main_icons_margin',
			[
				'label'      => esc_html__( 'Margin', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			] );

		$this->add_responsive_control( 'image_hotspots_main_icons_padding',
			[
				'label'      => esc_html__( 'Padding', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'image_hotspots_main_images_style_tab',
			[
				'label' => esc_html__( 'Image', 'opalelementor' ),
			]
		);

		$this->add_responsive_control( 'preimum_image_hotspots_main_images_size',
			[
				'label'      => esc_html__( 'Size', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-image-icon' => 'width:{{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control( 'preimum_image_hotspots_main_images_background',
			[
				'label'     => __( 'Background Color', 'opalelementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-image-icon' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'preimum_image_hotspots_main_images_border',
				'selector' => '{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-image-icon'
			]
		);

		$this->add_control( 'preimum_image_hotspots_main_images_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-image-icon' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'image_hotspots_main_images_shadow',
				'selector'  => '{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-image-icon',
				'condition' => [
					'image_hotspots_icons_animation!' => 'yes'
				]
			]
		);

		$this->add_responsive_control( 'image_hotspots_main_images_margin',
			[
				'label'      => esc_html__( 'Margin', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-image-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			] );

		$this->add_responsive_control( 'image_hotspots_main_images_padding',
			[
				'label'      => esc_html__( 'Padding', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-image-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'image_hotspots_main_text_style_tab',
			[
				'label' => esc_html__( 'Text', 'opalelementor' ),
			]
		);

		$this->add_control(
			'image_hotspots_main_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'opalelementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-text' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'image_hotspots_main_text_typo',
				'selector' => '{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-text'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'image_hotspots_main_text_shadow',
				'selector' => '{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-text'
			]
		);

		$this->add_control(
			'image_hotspots_main_text_background_color',
			[
				'label'     => __( 'Background Color', 'opalelementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-text' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_hotspots_main_text_border',
				'selector' => '{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-text'
			]
		);

		$this->add_control( 'image_hotspots_main_text_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-text' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'image_hotspots_main_text_shadow',
				'selector'  => '{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-text',
				'condition' => [
					'image_hotspots_icons_animation!' => 'yes'
				]
			]
		);

		$this->add_responsive_control( 'image_hotspots_main_text_margin',
			[
				'label'      => esc_html__( 'Margin', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			] );

		$this->add_responsive_control( 'image_hotspots_main_text_padding',
			[
				'label'      => esc_html__( 'Padding', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons .opal-image-hotspots-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'image_hotspots_radar_background',
			[
				'label'     => __( 'Radar Background Color', 'opalelementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'image_hotspots_icons_animation' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons.opal-image-hotspots-anim::before' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_control( 'image_hotspots_radar_border_radius',
			[
				'label'      => esc_html__( 'Radar Border Radius', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'condition'  => [
					'image_hotspots_icons_animation' => 'yes'
				],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons.opal-image-hotspots-anim::before' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'image_hotspots_main_icons_opacity',
			[
				'label'     => esc_html__( 'Hotspots Opacity', 'opalelementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .opal-image-hotspots-main-icons' => 'opacity: {{SIZE}};',
				],
				'separator' => 'before'
			]
		);


		$this->add_control( 'preimum_image_hotspots_main_icons_hover_animation',
			[
				'label' => __( 'Hover Animation', 'opalelementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'image_hotspots_tooltips_style_settings',
			[
				'label' => esc_html__( 'Tooltips', 'opalelementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control( 'image_hotspots_tooltips_wrapper_color',
			[
				'label'     => esc_html__( 'Text Color', 'opalelementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.tooltipster-box.tooltipster-box-{{ID}} .opal-image-hotspots-tooltips-text' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'image_hotspots_tooltips_wrapper_typo',
				'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .opal-image-hotspots-tooltips-text'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'image_hotspots_tooltips_content_text_shadow',
				'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .opal-image-hotspots-tooltips-text'
			]
		);

		$this->add_control( 'image_hotspots_tooltips_wrapper_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'opalelementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'                                      => 'background: {{VALUE}};',
					'.opal-tooltipster-base.tooltipster-top .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'    => 'border-top-color: {{VALUE}};',
					'.opal-tooltipster-base.tooltipster-bottom .tooltipster-arrow-{{ID}} .tooltipster-arrow-background' => 'border-bottom-color: {{VALUE}};',
					'.opal-tooltipster-base.tooltipster-right .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'  => 'border-right-color: {{VALUE}};',
					'.opal-tooltipster-base.tooltipster-left .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'   => 'border-left-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_hotspots_tooltips_wrapper_border',
				'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
			]
		);

		$this->add_control( 'image_hotspots_tooltips_wrapper_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content' => 'border-radius: {{SIZE}}{{UNIT}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_hotspots_tooltips_wrapper_box_shadow',
				'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
			]
		);

		$this->add_responsive_control( 'image_hotspots_tooltips_wrapper_margin',
			[
				'label'      => esc_html__( 'Margin', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content, .tooltipster-arrow-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

//        $this->add_responsive_control('image_hotspots_tooltips_wrapper_padding',
//            [
//                'label'         => esc_html__('Padding', 'strollik-core'),
//                'type'          => Controls_Manager::DIMENSIONS,
//                'size_units'    => [ 'px', 'em', '%' ],
//				'selectors'     => [
//                  '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
//                ]
//            ]
//        );

		$this->end_controls_section();

		$this->start_controls_section( 'img_hotspots_container_style',
			[
				'label' => esc_html__( 'Container', 'opalelementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control( 'img_hotspots_container_background',
			[
				'label'     => esc_html__( 'Background Color', 'opalelementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .opal-image-hotspots-container' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'img_hotspots_container_border',
				'selector' => '{{WRAPPER}} .opal-image-hotspots-container',
			]
		);

		$this->add_control( 'img_hotspots_container_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'opalelementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-container' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'img_hotspots_container_box_shadow',
				'selector' => '{{WRAPPER}} .opal-image-hotspots-container',
			]
		);

		$this->add_responsive_control( 'img_hotspots_container_margin',
			[
				'label'      => esc_html__( 'Margin', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control( 'img_hotspots_container_padding',
			[
				'label'      => esc_html__( 'Paddding', 'opalelementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .opal-image-hotspots-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function get_products_id() {  
		$args     = array(
			'limit' => -1,
		);
		$results  = array();
		if(class_exists('WooCommerce')){
			$products = wc_get_products( $args );
			if ( ! is_wp_error( $products ) ) {
				foreach ( $products as $product ) {
					$results[ $product->get_id() ] = $product->get_name();
				}
			}
		}

		return $results;
	}


	protected function render( $instance = [] ) {  
		// get our input from the widget settings.
		$settings        = $this->get_settings_for_display();
		$animation_class = '';
		if ( $settings['image_hotspots_icons_animation'] == 'yes' ) {
			$animation_class = 'opal-image-hotspots-anim';
		}

		$image_src = $settings['image_hotspots_image'];

		$image_src_size = Group_Control_Image_Size::get_attachment_image_src( $image_src['id'], 'background_image', $settings );
		if ( empty( $image_src_size ) ) : $image_src_size = $image_src['url'];
		else: $image_src_size = $image_src_size; endif;

		$image_hotspots_settings = [
			'anim'        => $settings['image_hotspots_anim'],
			'animDur'     => ! empty( $settings['image_hotspots_anim_dur'] ) ? $settings['image_hotspots_anim_dur'] : 350,
			'delay'       => ! empty( $settings['image_hotspots_anim_delay'] ) ? $settings['image_hotspots_anim_delay'] : 10,
			'arrow'       => ( $settings['image_hotspots_arrow'] == 'yes' ) ? true : false,
			'distance'    => ! empty( $settings['image_hotspots_tooltips_distance_position'] ) ? $settings['image_hotspots_tooltips_distance_position'] : 6,
			'minWidth'    => ! empty( $settings['image_hotspots_min_width']['size'] ) ? $settings['image_hotspots_min_width']['size'] : 0,
			'maxWidth'    => ! empty( $settings['image_hotspots_max_width']['size'] ) ? $settings['image_hotspots_max_width']['size'] : 'null',
			'side'        => ! empty( $settings['image_hotspots_tooltips_position'] ) ? $settings['image_hotspots_tooltips_position'] : array(
				'right',
				'left'
			),
			'hideMobiles' => ( $settings['image_hotspots_hide'] == true ) ? true : false,
			'trigger'     => $settings['image_hotspots_trigger_type'],
			'id'          => $this->get_id()
		];
		?>
        <div id="opal-image-hotspots-<?php echo esc_attr( $this->get_id() ); ?>"
             class="opal-image-hotspots-container"
             data-settings='<?php echo wp_json_encode( $image_hotspots_settings ); ?>'>
            <img class="opal-addons-image-hotspots-ib-img" alt="Background" src="<?php echo $image_src_size; ?>">
			<?php foreach ( $settings['image_hotspots_icons'] as $index => $item ) {
				$list_item_key = 'img_hotspot_' . $index;
				$this->add_render_attribute( $list_item_key, 'class',
					[
						$animation_class,
						'opal-image-hotspots-main-icons',
						'elementor-repeater-item-' . $item['_id'],
						'tooltip-wrapper',
						'opal-image-hotspots-main-icons-' . $item['_id']
					] );
				?>
                <div <?php echo $this->get_render_attribute_string( $list_item_key ); ?>
                        data-tooltip-content="#tooltip_content">
					<?php
					$link_type = $item['image_hotspots_link_type'];
					if ( $link_type == 'url' ) {
						$link_url = $item['image_hotspots_url']['url'];
					} elseif ( $link_type == 'link' ) {
						$link_url = get_permalink( $item['image_hotspots_existing_page'] );
					}
					if ( $item['image_hotspots_link_switcher'] == 'yes' && $settings['image_hotspots_trigger_type'] == 'hover' ) :
						?>
                        <a class="opal-image-hotspots-tooltips-link" href="<?php echo esc_url( $link_url ); ?>"
                           title="<?php echo $item['image_hotspots_link_text']; ?>"
						   <?php if ( ! empty( $item['image_hotspots_url']['is_external'] ) ) : ?>target="_blank"
						   <?php endif; ?><?php if ( ! empty( $item['image_hotspots_url']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>>
							<?php if ( $item['image_hotspots_icon_type_switch'] == 'font_awesome_icon' ) : ?>
                                <i class="opal-image-hotspots-icon <?php echo esc_attr( $item['image_hotspots_font_awesome_icon'] ); ?> elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>"></i>
							<?php elseif ( $item['image_hotspots_icon_type_switch'] == 'custom_image' ) : ?>
                                <div class="pica">
                                    <img alt="Hotspot Image"
                                         class="opal-image-hotspots-image-icon elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>"
                                         src="<?php echo $item['image_hotspots_custom_image']['url']; ?>">
                                </div>
							<?php elseif ( $item['image_hotspots_icon_type_switch'] == 'text' ) : ?>
                                <p class="opal-image-hotspots-text elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>"><?php echo esc_attr( $item['image_hotspots_text'] ); ?></p>

							<?php endif; ?>
                        </a>
					<?php else : ?>
						<?php if ( $item['image_hotspots_icon_type_switch'] == 'font_awesome_icon' ) : ?>
                            <i class="opal-image-hotspots-icon <?php echo esc_attr( $item['image_hotspots_font_awesome_icon'] ); ?> elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>"></i>
						<?php elseif ( $item['image_hotspots_icon_type_switch'] == 'custom_image' ) : ?>
                            <div class="pica elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>">
                                <img alt="Hotspot Image" class="opal-image-hotspots-image-icon"
                                     src="<?php echo $item['image_hotspots_custom_image']['url']; ?>">
                            </div>
						<?php elseif ( $item['image_hotspots_icon_type_switch'] == 'text' ) : ?>
                            <p class="opal-image-hotspots-text elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>"><?php echo esc_attr( $item['image_hotspots_text'] ); ?></p>

						<?php endif; ?>
					<?php endif; ?>
                    <div class="opal-image-hotspots-tooltips-wrapper">
                        <div id="tooltip_content" class="opal-image-hotspots-tooltips-text"><?php
							if ( $item['image_hotspots_content'] == 'elementor_templates' ) {
								$elementor_post_id = $item['image_hotspots_tooltips_temp'];
								$elements_frontend = new Frontend;
								echo $elements_frontend->get_builder_content( $elementor_post_id, true );
							} elseif ( ( $item['image_hotspots_content'] == 'elementor_product' ) && class_exists('WooCommerce') ) {
								$product = wc_get_product( $item['image_hotspots_tooltips_product'] );

								if( $product ) {
									echo '<a href="' . $product->get_permalink() . '" title="' . $product->get_title() . '">' . $product->get_image() . '</a>';
									if( $item['image_hotspots_product_detail'] == 'yes' ){
										echo '<h4><a href="' . $product->get_permalink() . '" title="' . $product->get_title() . '">' . $product->get_title() . '<h4></a>';

										if ( ! wc_review_ratings_enabled() ) {
											return;
										}
										$average  = $product->get_average_rating();

										echo '<div class="star-rating" title="'.sprintf(esc_attr__( 'Rated %s out of 5', 'opalelementor' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong class="rating">'.$average.'</strong> '.esc_html__( 'out of 5', 'opalelementor' ).'</span></div>'; 
										echo $product->get_price_html();
									}
								}	
							} else {
								echo $item['image_hotspots_tooltips_texts'];
							} ?></div>
                    </div>
                </div>
			<?php } ?>
        </div>

		<?php
	}
}