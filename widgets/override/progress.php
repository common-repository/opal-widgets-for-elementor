<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class OSF_Widget_Progress extends Widget_Progress {

	protected function register_controls() {
		$this->start_controls_section(
			'section_progress',
			[
				'label' => __( 'Progress Bar', 'opalelementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'opalelementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'opalelementor' ),
				'default' => __( 'My Skill', 'opalelementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'progress_type',
			[
				'label' => __( 'Type', 'opalelementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'opalelementor' ),
					'info' => __( 'Info', 'opalelementor' ),
					'success' => __( 'Success', 'opalelementor' ),
					'warning' => __( 'Warning', 'opalelementor' ),
					'danger' => __( 'Danger', 'opalelementor' ),
				],
			]
		);

		$this->add_control(
			'percent',
			[
				'label' => __( 'Percentage', 'opalelementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'label_block' => true,
			]
		);

        $this->add_control(
            'progress_height',
            [
                'label' => __( 'Height', 'opalelementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'min' => 1,
                    'max' => 50,
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-progress-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'progress_border_radius',
			[
				'label' => __( 'Border Radius', 'opalelementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'min' => 0,
					'max' => 50,
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-bar, {{WRAPPER}} .elementor-progress-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'enable_text_outside',
            [
                'label'     => __('Enable Outside', 'opalelementor'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Yes', 'opalelementor'),
                'label_off' => __('No', 'opalelementor'),
                //                'condition' => [
                //                    'layout' => 'carousel',
                //                ],
            ]
        );

		$this->add_control( 'display_percentage', [
			'label' => __( 'Display Percentage', 'opalelementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'show',
			'options' => [
				'show' => __( 'Show', 'opalelementor' ),
				'hide' => __( 'Hide', 'opalelementor' ),
			],
		] );

        $this->add_control(
            'inner_text',
            [
                'label' => __( 'Inner Text', 'opalelementor' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'e.g. Web Designer', 'opalelementor' ),
                'default' => __( 'Web Designer', 'opalelementor' ),
                'label_block' => true,
                'condition' => [
                    'enable_text_outside' => '',
                ],
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
			'section_progress_style',
			[
				'label' => __( 'Progress Bar', 'opalelementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bar_color',
			[
				'label' => __( 'Color', 'opalelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-wrapper .elementor-progress-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bar_bg_color',
			[
				'label' => __( 'Background Color', 'opalelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bar_inline_color',
			[
				'label' => __( 'Inner Text Color', 'opalelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-bar' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title Style', 'opalelementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'opalelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-title, {{WRAPPER}} .elementor-progress-outside .elementor-progress-percentage' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selectors' => [
                    '{{WRAPPER}} .elementor-progress-title',
                    '{{WRAPPER}} .elementor-progress-outside .elementor-progress-percentage'
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render progress widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', [
			'class' => 'elementor-progress-wrapper',
			'role' => 'progressbar',
			'aria-valuemin' => '0',
			'aria-valuemax' => '100',
            'aria-valuenow' => $settings['percent']['size'],
            'aria-valuetext' => $settings['inner_text'],
		] );

        $this->add_render_attribute('main-wrap', 'class', 'elementor-progress-main-wrap');
        if($settings['enable_text_outside'] === 'yes'){
            $this->add_render_attribute('main-wrap', 'class', 'elementor-progress-outside');
        }

		if ( ! empty( $settings['progress_type'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'progress-' . $settings['progress_type'] );
		}

		$this->add_render_attribute( 'progress-bar', [
			'class' => 'elementor-progress-bar',
			'data-max' => $settings['percent']['size'],
		] );
        ?>
        <div <?php echo $this->get_render_attribute_string('main-wrap') ?>>
        <?php
            if ( ! empty( $settings['title'] ) ) { ?>
                <span class="elementor-progress-title"><?php echo $settings['title']; ?></span>
            <?php } ?>
            <?php if($settings['enable_text_outside'] === 'yes'){ ?>
                <span class="elementor-progress-percentage"><?php echo $settings['percent']['size']; ?>%</span>
            <?php } ?>
            <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'progress-bar' ); ?>>
                    <?php if($settings['enable_text_outside'] !== 'yes'){ ?>
                        <span class="elementor-progress-text"><?php echo $settings['inner_text']; ?></span>
                        <?php if ( 'hide' !== $settings['display_percentage'] ) { ?>
                            <span class="elementor-progress-percentage"><?php echo $settings['percent']['size']; ?>%</span>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
	<?php
	}

	/**
	 * Render progress widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		view.addRenderAttribute( 'progressWrapper', {
			'class': [ 'elementor-progress-wrapper', 'progress-' + settings.progress_type ],
			'role': 'progressbar',
			'aria-valuemin': '0',
			'aria-valuemax': '100',
			'aria-valuenow': settings.percent.size,
			'aria-valuetext': settings.inner_text
		} );
		view.addInlineEditingAttributes( 'progressWrapper' );
        view.addRenderAttribute('main-wrap', 'class', 'elementor-progress-main-wrap');
        if ( settings.enable_text_outside === 'yes' ) {
            view.addRenderAttribute('main-wrap', 'class', 'elementor-progress-outside');
        }
		#>
        <div {{{ view.getRenderAttributeString( 'main-wrap' ) }}}>
            <# if ( settings.title ) { #>
            <span class="elementor-progress-title">{{{ settings.title }}}</span><#
            } #>

            <# if ( settings.enable_text_outside === 'yes' ) { #>
            <span class="elementor-progress-percentage">{{{ settings.percent.size }}}%</span><#
            } #>
            <div {{{ view.getRenderAttributeString( 'progressWrapper' ) }}}>
                <div class="elementor-progress-bar" data-max="{{ settings.percent.size }}">
                    <# if(settings.enable_text_outside !== 'yes'){ #>
                        <span class="elementor-progress-text">{{{ settings.inner_text }}}</span>
                        <# if ( 'hide' !== settings.display_percentage ) { #>
                        <span class="elementor-progress-percentage">{{{ settings.percent.size }}}%</span>
                        <# } #>
                    <# } #>
                </div>
            </div>
        </div>
		<?php
	}
}
