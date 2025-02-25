<?php
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
/**
 * Elementor image carousel widget.
 *
 * Elementor widget that displays a set of images in a rotating carousel or
 * slider.
 *
 * @since 1.0.0
 */ 
abstract class OSF_Elementor_Slick_Widget extends Widget_Base {
    public $image_control = true ;
    private $parsed_active_settings; 


    public function get_categories() {
        return array('opal-addons');
    }
    /**
     * Get widget name.
     *
     * Retrieve image carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'opal-slick';
    }

    /**
     * Get widget title.
     *
     * Retrieve image carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Opal Slick', 'opalelementor' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve image carousel widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-push';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'image', 'photo', 'visual', 'carousel', 'slider' , 'brand' ];
    }

    /**
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'jquery-wpopal-slick'];
    }

    public function get_style_depends() {
        return ['wpopal-slick'];
    }

    /**
     * Register image carousel widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    public function add_slick_controls( $condition , $slick_class ) {
       
        $slick_class = ' .elementor-opal-slick-slider ';
            
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label' => __('Carousel Options', 'opalelementor'),
                'type'  => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );


        $slides_to_show = range( 1, 10 );
        $slides_to_show = array_combine( $slides_to_show, $slides_to_show );

        $this->add_responsive_control(
            'slides_to_show',
            [
                'label' => __( 'Slides to Show', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Default', 'opalelementor' ),
                ] + $slides_to_show,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'label' => __( 'Slides to Scroll', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'description' => __( 'Set how many slides are scrolled per swipe.', 'opalelementor' ),
                'default' => '2',
                'options' => $slides_to_show,
                'condition' => [
                    'slides_to_show!' => '1',
                ],
                'frontend_available' => true,
            ]
        );

         

        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'both' => __( 'Arrows and Dots', 'opalelementor' ),
                    'arrows' => __( 'Arrows', 'opalelementor' ),
                    'dots' => __( 'Dots', 'opalelementor' ),
                    'none' => __( 'None', 'opalelementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __( 'View', 'opalelementor' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => __( 'Carousel Additional Options', 'opalelementor' ),
                'condition' => $condition
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => __( 'Pause on Hover', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'opalelementor' ),
                    'no' => __( 'No', 'opalelementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'opalelementor' ),
                    'no' => __( 'No', 'opalelementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', 'opalelementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => __( 'Infinite Loop', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'opalelementor' ),
                    'no' => __( 'No', 'opalelementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'effect',
            [
                'label' => __( 'Effect', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __( 'Slide', 'opalelementor' ),
                    'fade' => __( 'Fade', 'opalelementor' ),
                ],
                'condition' => [
                    'slides_to_show' => '1',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __( 'Animation Speed', 'opalelementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => __( 'Direction', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ltr',
                'options' => [
                    'ltr' => __( 'Left', 'opalelementor' ),
                    'rtl' => __( 'Right', 'opalelementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $a = array_merge( $condition, [
                    'navigation' => [ 'arrows', 'dots', 'both' 

                ] ] ) ; 
        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => __( 'Navigation', 'opalelementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => $a ,
            ]
        );

        $this->add_control(
            'heading_style_arrows',
            [
                'label' => __( 'Arrows', 'opalelementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'arrows_position',
            [
                'label' => __( 'Position', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inside',
                'options' => [
                    'inside' => __( 'Inside', 'opalelementor' ),
                    'outside' => __( 'Outside', 'opalelementor' ),
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'arrows_size',
            [
                'label' => __( 'Size', 'opalelementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$slick_class.'.slick-slider .slick-prev:before, {{WRAPPER}} '.$slick_class.'.slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label' => __( 'Color', 'opalelementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$slick_class.'.slick-slider .slick-prev:before, {{WRAPPER}} '.$slick_class.'.slick-slider .slick-next:before' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'heading_style_dots',
            [
                'label' => __( 'Dots', 'opalelementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label' => __( 'Position', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'outside',
                'options' => [
                    'outside' => __( 'Outside', 'opalelementor' ),
                    'inside' => __( 'Inside', 'opalelementor' ),
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label' => __( 'Size', 'opalelementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$slick_class.' .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __( 'Color', 'opalelementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$slick_class.' .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->end_controls_section();

        if( $this->image_control ){
            $this->add_image_control( $condition, $slick_class );
        }
       
    }

    public function add_image_control ( $condition, $slick_class ){
         $this->start_controls_section(
            'section_style_image',
            [
                'label' => __( 'Image', 'opalelementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => $condition
            ]
        );

        $this->add_control(
            'image_spacing',
            [
                'label' => __( 'Spacing', 'opalelementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Default', 'opalelementor' ),
                    'custom' => __( 'Custom', 'opalelementor' ),
                ],
                'default' => '',
                'condition' => [
                    'slides_to_show!' => '1',
                ],
            ]
        );

        $this->add_control(
            'image_spacing_custom',
            [
                'label' => __( 'Image Spacing', 'opalelementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'show_label' => false,
                'selectors' => [
                    '{{WRAPPER}} .slick-list' => 'margin-left: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slick-slide .slick-slide-inner' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'image_spacing' => 'custom',
                    'slides_to_show!' => '1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} '.$slick_class.' .slick-slide-image',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} '.$slick_class.' .slick-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register image carousel widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    public function get_settings_for_display( $setting_key = null ) {
        if ( ! $this->parsed_active_settings ) {
            $this->parsed_active_settings = $this->get_active_settings( $this->get_parsed_dynamic_settings(), $this->get_controls() );
        }

	    $settings = self::get_items( $this->parsed_active_settings, $setting_key );

        if ( isset($settings['enable_carousel']) && $settings['enable_carousel'] === 'yes' ) {
            $settings['column'] = 12;
        }
        return $settings;
    }

    /**
     * Register image carousel widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    public function get_settings_json(){
        $settings = $this->get_settings_for_display();
        $data = [
                "slides_to_show"    =>$settings['slides_to_show'],
                "slides_to_scroll" => $settings['slides_to_scroll'],
                "navigation"       => $settings['navigation'],
                "pause_on_hover"   => $settings['pause_on_hover'],
                "autoplay"         => $settings['autoplay'],
                "autoplay_speed"   => $settings['autoplay_speed'],
                "infinite"         => $settings['infinite'],
                "speed"            => $settings['speed'],
                "direction"        => $settings['direction']
        ];
        
        return wp_json_encode($data);
    }

    /**
     * Register image carousel widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    public function render_carousel_or_grid ( $settings, $content ) {

        if ( $settings['enable_carousel'] === 'yes' ) {
                
    //        echo '<pre>' . print_r( $settings , 1 ); die;
            $data = $this->get_settings_json();
            $this->add_render_attribute( 'wrapper', 'data-settings', $data );

            echo '<div class="elementor-opal-slick-slider elementor-slick-slider" ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
        }
        echo $content;
        if ($settings['enable_carousel'] === 'yes') {
            echo '</div>';
        }
    }
}
