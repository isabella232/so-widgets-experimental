<?php

/*
Widget Name: Google Maps Widget
Description: A simple Google Map with customisable initial location and zoom level
Author: SiteOrigin
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_JsGoogleMap_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'sow-js-google-map',
			__( 'SiteOrigin Google Map', 'siteorigin-widgets' ),
			array(
				'description' => __( 'A Google Maps widget.', 'siteorigin-widgets' ),
				'help'        => 'http://siteorigin.com/widgets-bundle/google-maps-widget-documentation/'
			),
			array(),
			array(
				'place'  => array(
					'type'        => 'text',
					'label'       => __( 'Place', 'siteorigin-widgets' ),
					'description' => __( 'The name of a place, town, city, or even a country. Can be an exact address too.', 'siteorigin-widgets' )
				),
				'height' => array(
					'type'  => 'text',
					'label' => __( 'Height', 'siteorigin-widgets' )
				),
				'zoom'   => array(
					'type'  => 'text',
					'label' => __( 'Zoom Level', 'siteorigin-widgets' ),
					'description' => __('A value from 0 (the world) to 21 (street level).', 'siteorigin-widgets')
				),
				'scroll_zoom' => array(
					'type'  => 'checkbox',
					'default' => false,
					'label' => __('Enable scroll to zoom', 'siteorigin-widgets'),
					'description' => __('Allow scrolling over the map to zoom in or out.', 'siteorigin-widgets')
				)
			)
		);
	}

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'sow-js-google-map', siteorigin_widget_get_plugin_dir_url( 'js-google-map' ) . 'js/js-map.js', array( 'jquery' ), SOW_BUNDLE_VERSION );
	}

	function get_template_name( $instance ) {
		return 'js-map';
	}

	function get_style_name( $instance ) {
		return 'js-map';
	}

	function get_template_variables( $instance, $args ) {
		return array(
			'place'  => esc_attr( $instance['place'] ),
			'map_id' => md5( $instance['place'] ),
			'height' => empty( $instance['height'] ) ? 450 : esc_attr( $instance['height'] ),
			'zoom'   => esc_attr( $instance['zoom'] ),
			'scroll_zoom' => esc_attr( $instance['scroll_zoom'] )
		);
	}
}

siteorigin_widget_register( 'js-google-map', __FILE__ );