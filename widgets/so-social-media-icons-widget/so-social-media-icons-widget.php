<?php

/*
Widget Name: Social Media Icons Widget
Description: A simple social media icons widget.
Author: Greg Priday
Author URI: http://siteorigin.com
*/


class SiteOrigin_Widget_SocialMediaIcons_Widget extends SiteOrigin_Widget {

	private $networks;

	function __construct() {

		$this->networks = array(
			'facebook'    => array(
				'label'    => __( 'Facebook', 'siteorigin-widgets' ),
				'base_url' => 'https://www.facebook.com/',
				'icon_color' => '#FFFFFF',
				'background_color' => '#3A5795'
			),
			'twitter'     => array(
				'label'    => __( 'Twitter', 'siteorigin-widgets' ),
				'base_url' => 'https://www.twitter.com/',
				'icon_color' => '#FFFFFF',
				'background_color' => '#78BDF1'
			),
			'google-plus' => array(
				'label'    => __( 'Google+', 'siteorigin-widgets' ),
				'base_url' => 'https://plus.google.com/',
				'icon_color' => '#FFFFFF',
				'background_color' => '#DD4B39'
			),
			'rss'         => array(
				'label'    => __( 'RSS', 'siteorigin-widgets' ),
				'base_url' => get_bloginfo('rss_url'),
				'icon_color' => '#FFFFFF',
				'background_color' => '#FAA21B'
			),
			'linkedin'    => array(
				'label'    => __( 'LinkedIn', 'siteorigin-widgets' ),
				'base_url' => 'https://www.linkedin.com/',
				'icon_color' => '#FFFFFF',
				'background_color' => '#0177B4'
			),
			'pinterest'   => array(
				'label'    => __( 'Pinterest', 'siteorigin-widgets' ),
				'base_url' => 'https://www.pinterest.com/',
				'icon_color' => '#FFFFFF',
				'background_color' => '#DB7C83'
			)
		);

		$network_names = array();
		foreach ( $this->networks as $key => $value ) {
			$network_names[ $key ] = $value['label'];
		}

		parent::__construct(
			'sow-social-media-icons',
			__( 'SiteOrigin Social Media Icons', 'siteorigin-widgets' ),
			array(
				'description' => __( 'A social media icons widget.', 'siteorigin-widgets' ),
				'help'        => 'http://siteorigin.com/widgets-bundle/social-media-icons-widget-documentation/'
			),
			array(),
			array(
				'networks'   => array(
					'type'       => 'repeater',
					'label'      => __( 'Networks', 'siteorigin-widgets' ),
					'item_name'  => __( 'Network', 'siteorigin-widgets' ),
					'item_label' => array(
						'selector'     => "[id*='networks-name'] :selected",
						'update_event' => 'change',
						'value_method' => 'text'
					),
					'fields'     => array(
						'name'             => array(
							'type'    => 'select',
							'label'   => __( '', 'siteorigin-widgets' ),
							'prompt'  => __( 'Select network', 'siteorigin-widgets' ),
							'options' => $network_names
						),
						'url'              => array(
							'type'  => 'text',
							'label' => __( 'URL', 'siteorigin-widgets' )
						),
						'icon_color'       => array(
							'type'  => 'color',
							'label' => __( 'Icon color', 'siteorigin-widgets' )
						),
						'background_color' => array(
							'type'  => 'color',
							'label' => __( 'Background color', 'siteorigin-widgets' )
						)
					)
				),
				'new_window' => array(
					'type'    => 'checkbox',
					'label'   => __( 'Open in a new window', 'siteorigin-widgets' ),
					'default' => true
				),
				'theme'      => array(
					'type'    => 'select',
					'label'   => __( 'Icon Theme', 'siteorigin-widgets' ),
					'default' => 'atom',
					'options' => array(
						'atom' => __( 'Atom', 'siteorigin-widgets' ),
						'flat' => __( 'Flat', 'siteorigin-widgets' ),
						'wire' => __( 'Wire', 'siteorigin-widgets' ),
					),
				),
				'icon_size'  => array(
					'type'    => 'select',
					'label'   => __( 'Icon size', 'siteorigin-widgets' ),
					'options' => array(
						'1'    => __( 'Normal', 'siteorigin-widgets' ),
						'1.15' => __( 'Medium', 'siteorigin-widgets' ),
						'1.3'  => __( 'Large', 'siteorigin-widgets' ),
						'1.45' => __( 'Extra Large', 'siteorigin-widgets' )
					)
				),
				'rounding'   => array(
					'type'    => 'select',
					'label'   => __( 'Rounding', 'siteorigin-widgets' ),
					'default' => '0.25',
					'options' => array(
						'0'    => __( 'None', 'siteorigin-widgets' ),
						'0.25' => __( 'Slight Rounding', 'siteorigin-widgets' ),
						'0.5'  => __( 'Very Rounded', 'siteorigin-widgets' ),
						'1.5'  => __( 'Completely Rounded', 'siteorigin-widgets' ),
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
						'1.8' => __( 'Very High', 'siteorigin-widgets' ),
					),
				),
			)
		);
	}

	function get_javascript_variables() {
		$so_social_media_widget_variables = array( 'networks' => $this->networks );
		wp_localize_script( 'sow-social-media-icons', 'SiteOrigin_Widget_SocialMediaIcons_Widget', $so_social_media_widget_variables );

		return $so_social_media_widget_variables;
	}

	function enqueue_admin_scripts() {
		wp_enqueue_script( 'sow-social-media-icons', siteorigin_widget_get_plugin_dir_url( 'social-media-icons' ) . 'js/social-media-icons-admin.js', array( 'jquery' ), SOW_BUNDLE_VERSION );
	}

	function get_template_name( $instance ) {
		return 'social-media-icons';
	}

	function get_style_name( $instance ) {
		if ( empty( $instance['theme'] ) ) {
			return 'atom';
		}

		return $instance['theme'];
	}

	function get_less_variables( $instance ) {
		$networks = isset( $instance['networks'] ) && ! empty( $instance['networks'] ) ? $instance['networks'] : array();
		$network_vars = array_map(
			function ( $ntwk ) {
				$pluck_keys = array( 'name', 'icon_color', 'background_color');
				$ntwk_vars  = '';
				foreach ( $pluck_keys as $i => $pluck_key ) {
					$ntwk_vars .= $ntwk[ $pluck_key ];
					$ntwk_vars .= $i < count( $pluck_keys ) ? ' ' : '';
				}

				return $ntwk_vars;
			},
			$networks
		);

		return array(
			'networks' => $network_vars,
			'icon_size' => $instance['icon_size'] . 'em',
			'rounding' => $instance['rounding'] . 'em',
			'padding' => $instance['padding'] . 'em'
		);
	}

	function get_template_variables( $instance, $args ) {
		return array(
			'networks' => isset($instance['networks']) ? $instance['networks'] : array()
		);
	}
}

siteorigin_widget_register( 'social-media-icons', __FILE__ );