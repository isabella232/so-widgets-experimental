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
				'place'             => array(
					'type'        => 'text',
					'label'       => __( 'Place', 'siteorigin-widgets' ),
					'description' => __( 'The name of a place, town, city, or even a country. Can be an exact address too.', 'siteorigin-widgets' )
				),
				'height'            => array(
					'type'  => 'text',
					'label' => __( 'Height', 'siteorigin-widgets' )
				),
				'zoom'              => array(
					'type'        => 'text',
					'label'       => __( 'Zoom Level', 'siteorigin-widgets' ),
					'description' => __( 'A value from 0 (the world) to 21 (street level).', 'siteorigin-widgets' )
				),
				'scroll_zoom'       => array(
					'type'        => 'checkbox',
					'default'     => true,
					'label'       => __( 'Enable scroll to zoom', 'siteorigin-widgets' ),
					'description' => __( 'Allow scrolling over the map to zoom in or out.', 'siteorigin-widgets' )
				),
				'marker_icon'       => array(
					'type'        => 'media',
					'default'     => '',
					'label'       => __( 'Marker Icon', 'siteorigin-widgets' ),
					'description' => __( 'Replaces the default map marker with your own image.' )
				),
				'marker_draggable'  => array(
					'type'    => 'checkbox',
					'default' => true,
					'label'   => __( 'Draggable marker', 'siteorigin-widgets' )
				),
				'custom_map_styles' => array(
					'type'      => 'repeater',
					'label'     => __( 'Custom Map Styles', 'siteorigin-widgets' ),
					'item_name' => __( 'Style', 'siteorigin-widgets' ),
					'item_label_selector' => "[name*='map_feature'] :selected",
					'item_label_update_event' => 'change',
					'fields'    => array(
						'map_feature' => array(
							'type'    => 'select',
							'label'   => __( 'Select map feature to style', 'siteorigin-widgets' ),
							'options' => array(
								'water'                       => __( 'Water', 'siteorigin-widgets' ),
								'road_highway'                => __( 'Highways', 'siteorigin-widgets' ),
								'road_arterial'               => __( 'Arterial roads', 'siteorigin-widgets' ),
								'road_local'                  => __( 'Local roads', 'siteorigin-widgets' ),
								'transit_line'                => __( 'Transit lines', 'siteorigin-widgets' ),
								'transit_station'             => __( 'Transit stations', 'siteorigin-widgets' ),
								'landscape_man-made'          => __( 'Man-made landscape', 'siteorigin-widgets' ),
								'landscape_natural_landcover' => __( 'Natural landscape landcover', 'siteorigin-widgets' ),
								'landscape_natural_terrain'   => __( 'Natural landscape terrain', 'siteorigin-widgets' ),
								'poi_attraction'              => __( 'Point of interest - Attractions', 'siteorigin-widgets' ),
								'poi_business'                => __( 'Point of interest - Business', 'siteorigin-widgets' ),
								'poi_government'              => __( 'Point of interest - Government', 'siteorigin-widgets' ),
								'poi_medical'                 => __( 'Point of interest - Medical', 'siteorigin-widgets' ),
								'poi_park'                    => __( 'Point of interest - Parks', 'siteorigin-widgets' ),
								'poi_place-of-worship'        => __( 'Point of interest - Places of worshipr', 'siteorigin-widgets' ),
								'poi_school'                  => __( 'Point of interest - Schools', 'siteorigin-widgets' ),
								'poi_sports-complex'          => __( 'Point of interest - Sports complexes', 'siteorigin-widgets' ),
							)
						),
						'visibility'  => array(
							'type'    => 'checkbox',
							'default' => true,
							'label'   => __( 'Visible', 'siteorigin-widgets' )
						),
						'color'       => array(
							'type'  => 'color',
							'label' => __( 'Color', 'siteorigin-widgets' )
						)
					)
				)
//				'custom_map_styles' => array(
//					'type'   => 'section',
//					'label'  => __( 'Custom Map Styles', 'siteorigin-widgets' ),
//					'hide'   => true,
//					'fields' => array(
//						'road_highway'  => array(
//							'type'   => 'section',
//							'hide'   => true,
//							'label'  => __( 'Highways', 'siteorigin-widgets' ),
//							'fields' => array(
//								'visibility' => array(
//									'type'    => 'radio',
//									'default' => 'on',
//									'label'   => __( 'Visibility', 'siteorigin-widgets' ),
//									'options' => array(
//										'on'      => __( 'On', 'siteorigin-widgets' ),
//										'simplified' => __( 'Simplified', 'siteorigin-widgets' ),
//										'off'     => __( 'Off', 'siteorigin-widgets' )
//									)
//								),
//								'color'      => array(
//									'type'  => 'color',
//									'label' => __( 'Color', 'siteorigin-widgets' )
//								),
//							)
//						),
//						'road_arterial' => array(
//							'type'   => 'section',
//							'hide'   => true,
//							'label'  => __( 'Arterial roads', 'siteorigin-widgets' ),
//							'fields' => array(
//								'visibility' => array(
//									'type'    => 'radio',
//									'default' => 'on',
//									'label'   => __( 'Visibility', 'siteorigin-widgets' ),
//									'options' => array(
//										'on'      => __( 'On', 'siteorigin-widgets' ),
//										'simplified' => __( 'Simplified', 'siteorigin-widgets' ),
//										'off'     => __( 'Off', 'siteorigin-widgets' )
//									)
//								),
//								'color'      => array(
//									'type'  => 'color',
//									'label' => __( 'Color', 'siteorigin-widgets' )
//								),
//							)
//						),
//						'road_local'    => array(
//							'type'   => 'section',
//							'hide'   => true,
//							'label'  => __( 'Local roads', 'siteorigin-widgets' ),
//							'fields' => array(
//								'visibility' => array(
//									'type'    => 'radio',
//									'default' => 'on',
//									'label'   => __( 'Visibility', 'siteorigin-widgets' ),
//									'options' => array(
//										'on'      => __( 'On', 'siteorigin-widgets' ),
//										'simplified' => __( 'Simplified', 'siteorigin-widgets' ),
//										'off'     => __( 'Off', 'siteorigin-widgets' )
//									)
//								),
//								'color'      => array(
//									'type'  => 'color',
//									'label' => __( 'Color', 'siteorigin-widgets' )
//								),
//							)
//						),
//						'water'         => array(
//							'type'   => 'section',
//							'hide'   => true,
//							'label'  => __( 'Water', 'siteorigin-widgets' ),
//							'fields' => array(
//								'visibility' => array(
//									'type'    => 'radio',
//									'default' => 'on',
//									'label'   => __( 'Visibility', 'siteorigin-widgets' ),
//									'options' => array(
//										'on'      => __( 'On', 'siteorigin-widgets' ),
//										'simplified' => __( 'Simplified', 'siteorigin-widgets' ),
//										'off'     => __( 'Off', 'siteorigin-widgets' )
//									)
//								),
//								'color'      => array(
//									'type'  => 'color',
//									'label' => __( 'Color', 'siteorigin-widgets' )
//								)
//							)
//						)
//					)
//				),
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
		$mrkr_src      = wp_get_attachment_image_src( $instance['marker_icon'] );
		$styles_string = '';
		if ( !empty( $instance['custom_map_styles'] ) ) {
			$map_styles = $instance['custom_map_styles'];
			$styles     = array();
			foreach ( $map_styles as $style_item ) {
				$map_feature = $style_item['map_feature'];
				unset( $style_item['map_feature'] );

				$stylers = array();
				foreach ( $style_item as $style_name => $style_value ) {
					if ( $style_value !== '' && ! is_null( $style_value ) ) {
						$style_value = $style_value === false ? 'off' : $style_value;
						array_push( $stylers, array( $style_name => $style_value ) );
					}
				}
				$map_feature = str_replace( '_', '.', $map_feature );
				$map_feature = str_replace( '-', '_', $map_feature );
				array_push( $styles, array(
					'featureType' => $map_feature,
					'elementType' => 'geometry',
					'stylers'     => $stylers
				) );
			}

			$styles_string = json_encode( $styles );
		}
//		$map_styles    = $instance['custom_map_styles'];
//		$styles_object = array();
//		foreach ( $map_styles as $map_feature => $styles ) {
//			$stylers = array();
//			foreach ( $styles as $style_name => $style_value ) {
//				if ( $style_value !== '' && ! is_null( $style_value ) ) {
//					array_push( $stylers, array( $style_name => $style_value ) );
//				}
//			}
//
//			array_push( $styles_object, array(
//				'featureType' => str_replace( '_', '.', $map_feature ),
//				'elementType' => 'geometry',
//				'stylers'     => $stylers
//			) );
//		}

//		$styles_string = json_encode( $styles_object );

		return array(
			'place'            => esc_attr( $instance['place'] ),
			'map_id'           => md5( $instance['place'] ),
			'height'           => ! empty( $instance['height'] ) ? esc_attr( $instance['height'] ) : 450,
			'zoom'             => esc_attr( $instance['zoom'] ),
			'scroll_zoom'      => esc_attr( $instance['scroll_zoom'] ),
			'marker_icon'      => ! empty( $mrkr_src ) ? esc_attr( $mrkr_src[0] ) : '',
			'marker_draggable' => esc_attr( $instance['marker_draggable'] ),
			'map_styles'       => esc_attr( $styles_string )
		);
	}
}

siteorigin_widget_register( 'js-google-map', __FILE__ );