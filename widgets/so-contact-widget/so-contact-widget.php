<?php
/*
Widget Name: Contact Form Widget
Description: Let your users contact you.
Author: SiteOrigin
Author URI: http://siteorigin.com
*/

/**
 * A basic contact form widget.
 *
 * Class SiteOrigin_Widgets_Contact_Widget
 */
class SiteOrigin_Widget_Contact_Widget extends SiteOrigin_Widget {
	/**
	 *
	 */
	function __construct(){
		parent::__construct(
			'sow-contact',
		    __('SiteOrigin Contact Form', 'siteorigin-widgets'),
			array(
				'description' => __( 'A very simple contact form.', 'siteorigin-widgets' ),
				'help'        => 'http://siteorigin.com/widgets-bundle/headline-widget-documentation/',
				'instance_storage' => true,
			),
			array(

			),
			array(
				'to_email' => array(
					'label' => __('To Email Address', 'siteorigin-widgets'),
					'type' => 'text',
					'sanitize' => 'email',
				),

				'bucket' => array(
					'label' => __('Bucket', 'siteorigin-widgets'),
					'type' => 'bucket',
				)
			)
		);
	}

	/**
	 * Handle sending a contact message.
	 *
	 * @TODO this should send the user an error message
	 */
	static function send_handler(){
		// Check the nonce
		if( !isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'sow_contact_form') ) exit();

		// Check all the user entered fields
		if( empty($_POST['name']) ) exit();
		if( empty($_POST['email']) ) exit();
		if( empty($_POST['subject']) ) exit();
		if( empty($_POST['message']) ) exit();

		// TODO check the content of this message with Akismet spam filter.

		// Save this as an entry in the bucket
		$widget = new SiteOrigin_Widget_Contact_Widget();
		$instance = $widget->get_stored_instance( $_POST['storage_hash'] );

		if( !empty($instance['bucket']) ) {
			$bucket = new SiteOrigin_Widgets_Bucket($widget, $instance['bucket']);
			$bucket->save( array(
				'to' => $instance['to_email'],
				'from_email' => $_POST['email'],
				'from_name' => $_POST['name'],
				'subject' => $_POST['subject'],
				'message' => $_POST['message']
			) );
		}

		// Send the actual email
//		wp_mail(
//			$instance['to_email'],
//			$_POST['subject'],
//			$_POST['message'],
//			'From: ' . $_POST['name'] . ' <' . sanitize_email($_POST['email']) . '>' . "\r\n"
//		);

		exit();
	}

	/**
	 * @param $instance
	 *
	 * @return mixed|string
	 */
	function get_style_name($instance){
		return 'default';
	}

	/**
	 * @param $instance
	 *
	 * @return mixed|string
	 */
	function get_template_name($instance){
		return 'contact';
	}

	/**
	 *
	 *
	 * @param $instance
	 *
	 * @return array|mixed
	 */
	function filter_stored_instance($instance) {
		$stored_instance = array();
		$stored_instance['to_email'] = $instance['to_email'];
		$stored_instance['bucket'] = $instance['bucket'];
		return $stored_instance;
	}
}

siteorigin_widget_register('contact', __FILE__);

// Add the event handlers for sending emails
add_action( 'wp_ajax_nopriv_sow_contact_form', array('SiteOrigin_Widget_Contact_Widget', 'send_handler') );
add_action( 'wp_ajax_sow_contact_form', array('SiteOrigin_Widget_Contact_Widget', 'send_handler') );