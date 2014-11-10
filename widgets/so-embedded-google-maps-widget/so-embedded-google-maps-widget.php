<?php

/*
Widget Name: Embedded Google Maps Widget
Description: A simple embedded Google Map with customisable initial location
Author: SiteOrigin
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_EmbeddedGoogleMaps_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'sow-embedded-google-maps',
			__( 'SiteOrigin Embedded Google Maps', 'siteorigin-widgets' ),
			array(
				'description' => __( 'An embedded Google Maps widget.', 'siteorigin-widgets' ),
				'help'        => 'http://siteorigin.com/widgets-bundle/google-maps-widget-documentation/'
			),
			array(),
			array(
//				TODO: add link to API Key instructions. remind users to set allowed referers to their domain.
//              be very specific about using their exact domains if they're using something like *.wordpress.com
				'api_key'    => array(
					'type'  => 'text',
					'label' => __( 'API Key', 'siteorigin-widgets' )
				),
				'width'      => array(
					'type'  => 'text',
					'label' => __( 'Width (min 200)', 'siteorigin-widgets' )
				),
				'height'     => array(
					'type'  => 'text',
					'label' => __( 'Height (min 200)', 'siteorigin-widgets' )
				),
				'mode'       => array(
					'type'    => 'select',
					'label'   => __( 'Mode', 'siteorigin-widgets' ),
					'default' => 'place',
					'options' => array(
						'place'      => __( 'Place', 'siteorigin-widgets' ),
						'directions' => __( 'Directions', 'siteorigin-widgets' ),
						'search'     => __( 'Search', 'siteorigin-widgets' ),
						'view'       => __( 'View', 'siteorigin-widgets' ),
					)
				),
				//for 'place' mode
				'place'      => array(
					'type'   => 'section',
					'label'  => __( 'Place Mode', 'siteorigin-widgets' ),
					'hide'   => true,
					'fields' => array(
						'query'               => array(
							'type'  => 'text',
							'label' => __( 'Place Query', 'siteorigin-widgets' )
						),
						'attribution_source'  => array(
							'type'  => 'text',
							'label' => __( 'Attribution Source', 'siteorigin-widgets' )
						),
						'attribution_web_url' => array(
							'type'  => 'text',
							'label' => __( 'Attribution Web Url', 'siteorigin-widgets' )
						)
					)
				),
				//for 'directions' mode
				'directions' => array(
					'type'   => 'section',
					'label'  => __( 'Directions Mode', 'siteorigin-widgets' ),
					'hide'   => true,
					'fields' => array(
						'origin'         => array(
							'type'  => 'text',
							'label' => __( 'Origin', 'siteorigin-widgets' )
						),
						'destination'    => array(
							'type'  => 'text',
							'label' => __( 'Destination', 'siteorigin-widgets' )
						),
						'waypoints'      => array(
							'type'  => 'text',
							'label' => __( 'Waypoints', 'siteorigin-widgets' )
						),
						'travel_mode'    => array(
							'type'    => 'select',
							'label'   => __( 'Travel Mode', 'siteorigin-widgets' ),
//					        'default' => 'driving',
							'options' => array(
								'driving'   => __( 'Driving', 'siteorigin-widgets' ),
								'walking'   => __( 'Walking', 'siteorigin-widgets' ),
								'bicycling' => __( 'Bicycling', 'siteorigin-widgets' ),
								'transit'   => __( 'Transit', 'siteorigin-widgets' ),
								'flying'    => __( 'Flying', 'siteorigin-widgets' ),
							)
						),
						'avoid_tolls'    => array(
							'type'  => 'checkbox',
							'label' => __( 'Avoid Tolls', 'siteorigin-widgets' ),
						),
						'avoid_ferries'  => array(
							'type'  => 'checkbox',
							'label' => __( 'Avoid Ferries', 'siteorigin-widgets' ),
						),
						'avoid_highways' => array(
							'type'  => 'checkbox',
							'label' => __( 'Avoid Highways', 'siteorigin-widgets' ),
						),
						'units'          => array(
							'type'    => 'select',
							'label'   => __( 'Units of Measurement', 'siteorigin-widgets' ),
							'default' => 'metric',
							'options' => array(
								'metric'   => __( 'Metric', 'siteorigin-widgets' ),
								'imperial' => __( 'Imperial', 'siteorigin-widgets' )
							)
						)
					)
				),
				'search'     => array(
					'type'   => 'section',
					'label'  => __( 'Search Mode', 'siteorigin-widgets' ),
					'hide'   => true,
					'fields' => array(
						'query' => array(
							'type'  => 'text',
							'label' => __( 'Search Query', 'siteorigin-widgets' )
						)
					)
				),
				'view'       => array(
					'type'   => 'section',
					'label'  => __( 'View Mode', 'siteorigin-widgets' ),
					'hide'   => true,
					'fields' => array(
						'center' => array(
							'type'  => 'text',
							'label' => __( 'Map Centre', 'siteorigin-widgets' )
						)
					)
				),
				'center'     => array(
					'type'  => 'text',
					'label' => __( 'Map Centre', 'siteorigin-widgets' )
				),
				'zoom'       => array(
					'type'  => 'text',
					'label' => __( 'Zoom Level (0 - 21)', 'siteorigin-widgets' )
				),
				'maptype'    => array(
					'type'    => 'select',
					'label'   => __( 'Map Type', 'siteorigin-widgets' ),
					'default' => 'roadmap',
					'options' => array(
						'roadmap'   => __( 'Roadmap', 'siteorigin-widgets' ),
						'satellite' => __( 'Satellite', 'siteorigin-widgets' )
					)
				),
				//might leave these last two out...
				'language'   => array(
					'type'  => 'text',
					'label' => __( 'Language', 'siteorigin-widgets' )
				),
				'region'     => array(
					'type'  => 'text',
					'label' => __( 'Region', 'siteorigin-widgets' )
				)
			)
		);
	}

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return '';
	}

	function get_template_variables( $instance, $args ) {

		$urlParams = array();
		switch ( $instance['mode'] ) {
			case 'place':
				$place          = $instance['place'];
				$urlParams['q'] = $place['query'];
				if ( ! empty( $place['attribution_source'] ) ) {
					$urlParams['attribution_source'] = $place['attribution_source'];
				}
				if ( ! empty( $place['attribution_web_url'] ) ) {
					$urlParams['attribution_web_url'] = $place['attribution_web_url'];
				}
				break;
			case 'directions':
				$directions               = $instance['directions'];
				$urlParams['origin']      = $directions['origin'];
				$urlParams['destination'] = $directions['destination'];
				if ( ! empty( $directions['waypoints'] ) ) {
					$urlParams['waypoints'] = $directions['waypoints'];
				}
				if ( ! empty( $directions['travel_mode'] ) ) {
					$urlParams['mode'] = $directions['travel_mode'];
				}

				if ( ! empty( $directions['avoid_tolls'] ) || ! empty( $directions['avoid_ferries'] ) || ! empty( $directions['avoid_highways'] ) ) {
					$avoid = '';
					if ( ! empty( $directions['avoid_tolls'] ) ) {
						$avoid .= ( empty( $avoid ) ? '' : '|' ) . 'tolls';
					}
					if ( ! empty( $directions['avoid_ferries'] ) ) {
						$avoid .= ( empty( $avoid ) ? '' : '|' ) . 'ferries';
					}
					if ( ! empty( $directions['avoid_highways'] ) ) {
						$avoid .= ( empty( $avoid ) ? '' : '|' ) . 'highways';
					}
					$urlParams['avoid'] = $avoid;
				}
				if ( ! empty( $directions['units'] ) ) {
					$urlParams['units'] = $directions['units'];
				}
				break;
			case 'search':
				$urlParams['q'] = $instance['search']['query'];
				break;
			case 'view':
				$urlParams['center'] = $instance['view']['center'];
				break;
		}

		if ( ! empty( $instance['center'] ) && empty( $urlParams['center'] ) ) {
			$urlParams['center'] = $instance['center'];
		}
		if ( ! empty( $instance['zoom'] ) ) {
			$urlParams['zoom'] = $instance['zoom'];
		}
		if ( ! empty( $instance['maptype'] ) ) {
			$urlParams['maptype'] = $instance['maptype'];
		}
		if ( ! empty( $instance['language'] ) ) {
			$urlParams['language'] = $instance['language'];
		}
		if ( ! empty( $instance['region'] ) ) {
			$urlParams['region'] = $instance['region'];
		}

		$urlVars = '';
		foreach ( $urlParams as $name => $val ) {
			$urlVars .= '&' . $name . '=' . urlencode( $val );
		}

		$src_url = 'https://www.google.com/maps/embed/v1/' . $instance['mode'] . '?key=' . $instance['api_key'] . $urlVars;

		return array(
			'width'   => empty( $instance['width'] ) ? 600 : $instance['width'],
			'height'  => empty( $instance['height'] ) ? 450 : $instance['height'],
			'src_url' => $src_url
		);
	}
}

siteorigin_widget_register( 'embedded-google-maps', __FILE__ );