<?php

/*
Widget Name: Social media buttons widget
Description: Customizable buttons which link to all your social media profiles.
Author: SiteOrigin
Author URI: http://siteorigin.com
*/


class SiteOrigin_Widget_SocialMediaButtons_Widget extends SiteOrigin_Widget {

	private $networks;

	function __construct() {

		$this->networks = include plugin_dir_path( __FILE__ ) . 'networks.php';

		$network_names = array();
		foreach ( $this->networks as $key => $value ) {
			$network_names[ $key ] = $value['label'];
		}

		$form_options = array(
			'networks' => array(
				'type'       => 'repeater',
				'label'      => __( 'Networks', 'siteorigin-widgets' ),
				'item_name'  => __( 'Network', 'siteorigin-widgets' ),
				'item_label' => array(
					'selector'     => "[id*='networks-name'] :selected",
					'update_event' => 'change',
					'value_method' => 'text'
				),
				'fields'     => array(
					'name'         => array(
						'type'    => 'select',
						'label'   => __( '', 'siteorigin-widgets' ),
						'prompt'  => __( 'Select network', 'siteorigin-widgets' ),
						'options' => $network_names
					),
					'url'          => array(
						'type'  => 'text',
						'label' => __( 'URL', 'siteorigin-widgets' )
					),
					'icon_color'   => array(
						'type'  => 'color',
						'label' => __( 'Icon color', 'siteorigin-widgets' )
					),
					'button_color' => array(
						'type'  => 'color',
						'label' => __( 'Background color', 'siteorigin-widgets' )
					)
				)
			),
			'design'   => array(
				'type'   => 'section',
				'label'  => __( 'Design and layout' ),
				'hide'   => true,
				'fields' => array(
					'new_window' => array(
						'type'    => 'checkbox',
						'label'   => __( 'Open in a new window', 'siteorigin-widgets' ),
						'default' => true
					),
					'theme'      => array(
						'type'    => 'select',
						'label'   => __( 'Button theme', 'siteorigin-widgets' ),
						'default' => 'atom',
						'options' => array(
							'atom' => __( 'Atom', 'siteorigin-widgets' ),
							'flat' => __( 'Flat', 'siteorigin-widgets' ),
							'wire' => __( 'Wire', 'siteorigin-widgets' ),
						),
					),
					'hover'      => array(
						'type'    => 'checkbox',
						'label'   => __( 'Use hover effects' ),
						'default' => true
					),
					'icon_size'  => array(
						'type'    => 'select',
						'label'   => __( 'Icon size', 'siteorigin-widgets' ),
						'options' => array(
							'1'    => __( 'Normal', 'siteorigin-widgets' ),
							'1.33' => __( 'Medium', 'siteorigin-widgets' ),
							'1.66' => __( 'Large', 'siteorigin-widgets' ),
							'2'    => __( 'Extra large', 'siteorigin-widgets' )
						)
					),
					'rounding'   => array(
						'type'    => 'select',
						'label'   => __( 'Rounding', 'siteorigin-widgets' ),
						'default' => '0.25',
						'options' => array(
							'0'    => __( 'None', 'siteorigin-widgets' ),
							'0.25' => __( 'Slightly rounded', 'siteorigin-widgets' ),
							'0.5'  => __( 'Very rounded', 'siteorigin-widgets' ),
							'1.5'  => __( 'Completely rounded', 'siteorigin-widgets' ),
						),
					),
					'padding'    => array(
						'type'    => 'select',
						'label'   => __( 'Padding', 'siteorigin-widgets' ),
						'default' => '1',
						'options' => array(
							'0.5' => __( 'Low', 'siteorigin-widgets' ),
							'1'   => __( 'Medium', 'siteorigin-widgets' ),
							'1.4' => __( 'High', 'siteorigin-widgets' ),
							'1.8' => __( 'Very high', 'siteorigin-widgets' ),
						),
					),
					'align'      => array(
						'type'    => 'select',
						'label'   => __( 'Align', 'siteorigin-widgets' ),
						'default' => 'left',
						'options' => array(
							'left'    => __( 'Left', 'siteorigin-widgets' ),
							'right'   => __( 'Right', 'siteorigin-widgets' ),
							'center'  => __( 'Center', 'siteorigin-widgets' ),
							'justify' => __( 'Justify', 'siteorigin-widgets' ),
						),
					),
					'margin'     => array(
						'type'    => 'select',
						'label'   => __( 'Margin', 'siteorigin-widgets' ),
						'default' => '0.1',
						'options' => array(
							'0.1' => __( 'Low', 'siteorigin-widgets' ),
							'0.2' => __( 'Medium', 'siteorigin-widgets' ),
							'0.3' => __( 'High', 'siteorigin-widgets' ),
							'0.4' => __( 'Very high', 'siteorigin-widgets' ),
						),
					),
				)
			),
		);

		$form_options = apply_filters('sow_social_media_buttons_form_options', $form_options);

		parent::__construct(
			'sow-social-media-buttons',
			__( 'SiteOrigin Social Media Buttons', 'siteorigin-widgets' ),
			array(
				'description' => __( 'A social media buttons widget.', 'siteorigin-widgets' ),
				'help'        => 'http://siteorigin.com/widgets-bundle/social-media-buttons-widget-documentation/'
			),
			array(),
			$form_options
		);
	}

	function get_javascript_variables() {
		$so_social_media_widget_variables = array( 'networks' => $this->networks );
		wp_localize_script( 'sow-social-media-buttons', 'SiteOrigin_Widget_SocialMediaButtons_Widget', $so_social_media_widget_variables );

		return $so_social_media_widget_variables;
	}

	function enqueue_admin_scripts() {
		wp_enqueue_script( 'sow-social-media-buttons', siteorigin_widget_get_plugin_dir_url( 'social-media-buttons' ) . 'js/social-media-buttons-admin.js', array( 'jquery' ), SOW_BUNDLE_VERSION );
	}

	function get_template_name( $instance ) {
		return 'social-media-buttons';
	}

	function get_style_name( $instance ) {
		if ( empty( $instance['design']['theme'] ) ) {
			return 'atom';
		}

		return $instance['design']['theme'];
	}

	function get_less_variables( $instance ) {
		$design = $instance['design'];
		$m      = $design['margin'];
		$top = $right = $bottom = $left = $m . 'em';
		switch ( $design['align'] ) {
			case 'left':
				$left = '0';
				break;
			case 'right':
				$right = '0';
				break;
			case 'center':
				$left = $right = ( $m * 0.5 ) . 'em';
				break;
		}
		$margin = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;

		return array(
			'icon_size' => $design['icon_size'] . 'em',
			'rounding'  => $design['rounding'] . 'em',
			'padding'   => $design['padding'] . 'em',
			'align'     => $design['align'],
			'margin'    => $margin
		);
	}

	function less_generate_calls_to( $instance, $args ) {
		$networks = isset( $instance['networks'] ) && ! empty( $instance['networks'] ) ? $instance['networks'] : array();
		$calls    = array();
		foreach ( $networks as $network ) {
			$calls[] = $args[0] . '(' . $network['name'] . ', ' . $network['icon_color'] . ', ' . $network['button_color'] . ');';
		}

		return implode( "\n", $calls );
	}

	function get_template_variables( $instance, $args ) {
		return array(
			'networks' => isset( $instance['networks'] ) ? $instance['networks'] : array()
		);
	}
}

siteorigin_widget_register( 'social-media-buttons', __FILE__ );