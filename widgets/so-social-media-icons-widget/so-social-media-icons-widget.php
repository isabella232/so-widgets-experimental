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
				'label' => __( 'Facebook', 'siteorigin-widgets' ),
				'base_url' => 'https://www.facebook.com/',
				'logo' => 'facebook-logo'
			),
			'twitter'     => array(
				'label' => __( 'Twitter', 'siteorigin-widgets' ),
				'base_url' => 'https://www.twitter.com/',
				'logo' => 'twitter-logo'
			),
			'google_plus' => array(
				'label' => __( 'Google+', 'siteorigin-widgets' ),
				'base_url' => 'https://plus.google.com/',
				'logo' => 'twitter-logo'
			),
			'rss'         => array(
				'label' => __( 'RSS', 'siteorigin-widgets' ),
				'base_url' => '',
				'logo' => 'rss-logo'
			),
			'linkedin'    => array(
				'label' => __( 'LinkedIn', 'siteorigin-widgets' ),
				'base_url' => 'https://www.linkedin.com/',
				'logo' => 'linkedin-logo'
			),
			'pinterest'   => array(
				'label' => __( 'Pinterest', 'siteorigin-widgets' ),
				'base_url' => 'https://www.pinterest.com/',
				'logo' => 'pinterest-logo'
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
						'name'    => array(
							'type'    => 'select',
							'label'   => __( '', 'siteorigin-widgets'),
							'prompt' => __('Select network', 'siteorigin-widgets'),
							'options' => $network_names
						),
						'url'      => array(
							'type'  => 'text',
							'label' => __( 'URL', 'siteorigin-widgets' )
						),
						'size'       => array(
							'type'    => 'select',
							'label'   => __( 'Icon size', 'siteorigin-widgets' ),
							'options' => array(
								'small'  => __( 'Small', 'siteorigin-widgets' ),
								'medium' => __( 'Medium', 'siteorigin-widgets' ),
								'large'  => __( 'Large', 'siteorigin-widgets' )
							)
						),
						'new_window' => array(
							'type'    => 'checkbox',
							'label'   => __( 'Open in a new window', 'siteorigin-widgets' ),
							'default' => true
						),
						'logo_color' => array(
							'type' => 'color',
							'label' => __('Logo color', 'siteorigin-widgets')
						),
						'background_color' => array(
							'type' => 'color',
							'label' => __('Background color', 'siteorigin-widgets')
						)
					)
				)
			)
		);
	}

	function get_javascript_variables(){
		$so_social_media_widget_variables = array( 'networks' => $this->networks );
		wp_localize_script( 'sow-social-media-icons', 'SiteOrigin_Widget_SocialMediaIcons_Widget', $so_social_media_widget_variables );
		return $so_social_media_widget_variables;
	}

	function enqueue_admin_scripts() {
			wp_enqueue_script( 'sow-social-media-icons', siteorigin_widget_get_plugin_dir_url( 'social-media-icons' ) . 'js/social-media-icons-admin.js', array( 'jquery' ), SOW_BUNDLE_VERSION . "sd");
	}

	function get_template_name( $instance ) {
		return 'social-media-icons';
	}

	function get_style_name( $instance ) {
		return 'social-media-icons';
	}

	function get_less_variables($instance){
		$less_vars = array_map(
			function($ntwk) {
				return $ntwk['name'] . ' ' . $ntwk['logo_color'] . ' ' . $ntwk['background_color'];
			},
			$instance['networks']
		);

		return array('networks' => $less_vars );
	}

	function get_template_variables( $instance, $args ) {
		return array(
			'icons' => $instance['networks']
		);
	}
}

siteorigin_widget_register( 'social-media-icons', __FILE__ );