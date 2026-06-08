<?php

/**
 * Sidebar Builder.
 *
 * @since 3.10.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;

class Sina_Sidebar_Builder extends \Elementor\Modules\Library\Documents\Page{
	public function get_name() {
		return 'sina_sidebar';
	}

	public static function get_type() {
		return 'sina_sidebar';
	}

	public static function get_title() {
		return esc_html__( 'Sina Sidebar', 'sina-ext' );
	}

	public function get_css_wrapper_selector() {
		return '#sina-ext-sidebar-'.$this->get_main_id();
	}

	public function get_container_attributes() {
		$attributes = parent::get_container_attributes();
		$attributes['id'] = 'sina-ext-sidebar-' . $this->get_main_id();
		return $attributes;
	}

	public function get_toggle_icons() {
		return [
			'icofont icofont-arrow-down' => 'Arrow Down',
			'icofont icofont-arrow-left' => 'Arrow Left',
			'icofont icofont-arrow-right' => 'Arrow Right',
			'icofont icofont-arrow-up' => 'Arrow Up',
			'icofont icofont-caret-down' => 'Caret Down',
			'icofont icofont-caret-left' => 'Caret Left',
			'icofont icofont-caret-right' => 'Caret Right',
			'icofont icofont-caret-up' => 'Caret Up',
			'icofont icofont-rounded-down' => 'Rounded Down',
			'icofont icofont-rounded-left' => 'Rounded Left',
			'icofont icofont-rounded-right' => 'Rounded Right',
			'icofont icofont-rounded-up' => 'Rounded Up',
			'icofont icofont-simple-down' => 'Simple Down',
			'icofont icofont-simple-left' => 'Simple Left',
			'icofont icofont-simple-right' => 'Simple Right',
			'icofont icofont-simple-up' => 'Simple Up',
			'icofont icofont-swoosh-down' => 'Swoosh Down',
			'icofont icofont-swoosh-left' => 'Swoosh Left',
			'icofont icofont-swoosh-right' => 'Swoosh Right',
			'icofont icofont-swoosh-up' => 'Swoosh Up',
			'icofont icofont-double-left' => 'Double Left',
			'icofont icofont-double-right' => 'Double Right',
			'icofont icofont-rounded-double-left' => 'Rounded Double Left',
			'icofont icofont-rounded-double-right' => 'Rounded Double Right',
			'icofont icofont-plus' => 'Plus',
			'icofont icofont-minus' => 'Minus',
		];
	}

	protected function register_controls() {
		// Start Sidebar Settings
		// =======================
			$this->start_controls_section(
				'sidebar_settings',
				[
					'label' => esc_html__( 'Sidebar Settings', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_SETTINGS,
				]
			);

				$this->add_control(
					'sidebar_close_esc',
					[
						'label' => esc_html__( 'Close to press ESC', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
					]
				);
				$this->add_control(
					'sidebar_toggle',
					[
						'label' => esc_html__( 'Toggle Button', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
						'selectors_dictionary' => [
							'' => 'display: none;',
						],
						'selectors' => [
							'{{WRAPPER}} .sina-ext-sidebar-toggle-btn' => '{{VALUE}}',
						],
					]
				);

				$this->add_control(
					'sidebar_toggle_open_icon',
					[
						'label' => esc_html__( 'Open Toggle Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $this->get_toggle_icons(),
						'condition' => [
							'sidebar_toggle' => 'yes',
						]
					]
				);
				$this->add_control(
					'sidebar_toggle_close_icon',
					[
						'label' => esc_html__( 'Close Toggle Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $this->get_toggle_icons(),
						'condition' => [
							'sidebar_toggle' => 'yes',
						]
					]
				);
				$this->add_control(
					'sidebar_toggle_open_text',
					[
						'label' => esc_html__( 'Open Toggle Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Enter Text', 'sina-ext' ),
						'condition' => [
							'sidebar_toggle' => 'yes',
							'sidebar_toggle_open_icon' => '',
							'sidebar_toggle_close_icon' => '',
						]
					]
				);
				$this->add_control(
					'sidebar_toggle_close_text',
					[
						'label' => esc_html__( 'Close Toggle Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Enter Text', 'sina-ext' ),
						'condition' => [
							'sidebar_toggle' => 'yes',
							'sidebar_toggle_open_icon' => '',
							'sidebar_toggle_close_icon' => '',
						]
					]
				);

				$this->add_control(
					'sidebar_trigger',
					[
						'label'   => esc_html__( 'Open Trigger', 'sina-ext' ),
						'type'    => Controls_Manager::SELECT,
						'options' => [
							'none' => esc_html__( 'None', 'sina-ext' ),
							'always-show' => esc_html__( 'Always Show', 'sina-ext' ),
							'custom' => esc_html__( 'Custom Element', 'sina-ext' ),
						],
						'default' => 'none',
					]
				);
				$this->add_control(
					'sidebar_custom_trigger',
					[
						'label' => esc_html__( 'Element Selector', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'description' => esc_html__( 'Enter CSS Selector. Like: .sina-extension, #sina-extension. If clicks the selector element(s) the Sidebar will show.', 'sina-ext' ),
						'dynamic' => [
							'active' => true,
						],
						'condition' => [
							'sidebar_trigger' => 'custom',
						]
					]
				);

				$this->add_control(
					'close_element',
					[
						'label' => esc_html__( 'Close Trigger', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'none' => esc_html__( 'None', 'sina-ext' ),
							'default' => esc_html__( 'Close Button', 'sina-ext' ),
							'outside' => esc_html__( 'Click Outside', 'sina-ext' ),
							'default-outside' => esc_html__( 'Close Button or Click Outside', 'sina-ext' ),
							'custom' => esc_html__( 'Custom Element', 'sina-ext' ),
						],
						'default' => 'none',
						'selectors_dictionary' => [
							'none' => 'display: none;',
							'outside' => 'display: none;',
							'custom' => 'display: none;',
						],
						'selectors' => [
							'{{WRAPPER}} .sina-ext-sidebar-close-btn' => '{{VALUE}}',
						],
					]
				);
				$this->add_control(
					'close_element_selector',
					[
						'label' => esc_html__( 'Element Selector', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'description' => esc_html__( 'Enter CSS Selector. Like: .sina-extension, #sina-extension. If clicks the selector element(s) the Sidebar will close.'),
						'condition' => [
							'close_element' => 'custom',
						]
					]
				);

			$this->end_controls_section();
		// End Sidebar Settings
		// =====================


		Sina_Common_Data::sidebar_style( $this );


		// Start Toggle Button Icon Style
		// ===============================
			$selector = '{{WRAPPER}} .sina-ext-sidebar-toggle-btn';
			$this->start_controls_section(
				'toggle_btn_icon_style',
				[
					'label' => esc_html__( 'Toggle Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'sidebar_toggle' => 'yes',
						'sidebar_toggle_open_icon!' => '',
						'sidebar_toggle_close_icon!' => '',
					]
				]
			);
				$this->add_control(
					'toggle_btn_icon_note',
					[
						'type' => Controls_Manager::RAW_HTML,
						'raw' => __( 'NOTICE: If you change the <strong>Dimension</strong> then re-setup the sidebar <strong>Position</strong> OR <strong>Refresh</strong> the page to seeing the actual result.', 'sina-ext' ),
						'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					]
				);
				Sina_Common_Data::icon_style( $this, $selector.' i', 'toggle_btn_icon' );
			$this->end_controls_section();
		// End Toggle Button Icon Style
		// =============================


		// Start Toggle Button Text Style
		// ===============================
			$this->start_controls_section(
				'toggle_btn_text_style',
				[
					'label' => esc_html__( 'Toggle Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'sidebar_toggle' => 'yes',
						'sidebar_toggle_open_text!' => '',
						'sidebar_toggle_close_text!' => '',
						'sidebar_toggle_open_icon' => '',
						'sidebar_toggle_close_icon' => '',
					]
				]
			);

				$this->add_control(
					'toggle_btn_text_note',
					[
						'type' => Controls_Manager::RAW_HTML,
						'raw' => __( 'NOTICE: If you change the <strong>Dimension</strong> then re-setup the sidebar <strong>Position</strong> OR <strong>Refresh</strong> the page to seeing the actual result.', 'sina-ext' ),
						'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					]
				);
				Sina_Common_Data::sidebar_toggle_style( $this, $selector.' span' );

			$this->end_controls_section();
		// End Toggle Button Text Style
		// =============================


		// Start Close Button Style
		// =========================
			$selector = '{{WRAPPER}} .sina-ext-sidebar-close-btn';
			$this->start_controls_section(
				'close_btn_style',
				[
					'label' => esc_html__( 'Close Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'close_element' => ['default', 'default-outside'],
					]
				]
			);

				$this->add_control(
					'close_btn_hr_align',
					[
						'label' => esc_html__( 'Horizontal Align', 'sina-ext' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'sina-ext' ),
								'icon' => 'eicon-h-align-left',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'sina-ext' ),
								'icon' => 'eicon-h-align-right',
							],
						],
						'toggle' => false,
						'default' => 'left',
					]
				);
				$this->add_control(
					'close_btn_vr_align',
					[
						'label' => esc_html__( 'Vertical Align', 'sina-ext' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'top' => [
								'title' => esc_html__( 'Top', 'sina-ext' ),
								'icon' => 'eicon-v-align-top',
							],
							'bottom' => [
								'title' => esc_html__( 'Bottom', 'sina-ext' ),
								'icon' => 'eicon-v-align-bottom',
							],
						],
						'toggle' => false,
						'default' => 'top',
					]
				);
				$this->add_responsive_control(
					'close_btn_hr_spacing',
					[
						'label' => esc_html__( 'Horizontal Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => '5',
						],
						'selectors' => [
							$selector => 'left: inherit !important;{{close_btn_hr_align.VALUE || left}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'close_btn_vr_spacing',
					[
						'label' => esc_html__( 'Vertical Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => '5',
						],
						'selectors' => [
							$selector => 'top: inherit !important;{{close_btn_vr_align.VALUE || top}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				Sina_Common_Data::icon_style( $this, $selector.' i', 'close_btn' );

			$this->end_controls_section();
		// End Close Button Style
		// =======================
	}
}