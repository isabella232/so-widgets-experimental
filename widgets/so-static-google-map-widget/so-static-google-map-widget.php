<?php

/*
Widget Name: Static Google Maps Widget
Description: A simple Google Map with customisable initial location and zoom level
Author: SiteOrigin
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_StaticGoogleMap_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'sow-static-google-map',
			__( 'SiteOrigin Static Google Map', 'siteorigin-widgets' ),
			array(
				'description' => __( 'A Static Google Maps widget.', 'siteorigin-widgets' ),
				'help'        => 'http://siteorigin.com/widgets-bundle/google-maps-widget-documentation/'
			),
			array(),
			array(
				'place'  => array(
					'type'  => 'text',
					'label' => __( 'Place', 'siteorigin-widgets' )
				),
				'width'  => array(
					'type'  => 'text',
					'label' => __( 'Width', 'siteorigin-widgets' )
				),
				'height' => array(
					'type'  => 'text',
					'label' => __( 'Height', 'siteorigin-widgets' )
				),
				'zoom'   => array(
					'type'  => 'text',
					'label' => __( 'Zoom Level', 'siteorigin-widgets' )
				)
			)
		);
	}

	function get_template_name( $instance ) {
		return 'static-map';
	}

	function get_style_name( $instance ) {
		return '';
	}

	function get_template_variables( $instance, $args ) {
		$width  = empty( $instance['width'] ) ? 600 : $instance['width'];
		$height = empty( $instance['height'] ) ? 450 : $instance['height'];

		$src_url = "https://maps.googleapis.com/maps/api/staticmap?";
		$src_url .= "center=" . $instance['place'];
		$src_url .= "&zoom=" . $instance['zoom'];
		$src_url .= "&size=" . $width . "x" . $height;

		return array(
			'src_url' => esc_url( $src_url )
		);
	}
}

siteorigin_widget_register( 'static-google-map', __FILE__ );