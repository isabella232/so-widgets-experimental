<div class="sow-contact">
	<form action="<?php echo admin_url('admin-ajax.php?action=sow_contact_form') ?>" method="post">

		<div class="field">
			<label><?php _e('Your Name', 'siteorigin-widgets') ?></label>
			<input type="text" name="name" />
		</div>

		<div class="field">
			<label><?php _e('Your Email', 'siteorigin-widgets') ?></label>
			<input type="text" name="email" />
		</div>

		<div class="field">
			<label><?php _e('Subject', 'siteorigin-widgets') ?></label>
			<input type="text" name="subject" />
		</div>

		<div class="field">
			<label><?php _e('Message', 'siteorigin-widgets') ?></label>
			<textarea name="message"></textarea>
		</div>

		<div class="field">
			<?php wp_nonce_field('sow_contact_form') ?>
			<input type="submit" name="submit" value="<?php esc_attr_e('Submit', 'siteorigin-widgets') ?>" />
			<input type="hidden" name="ref" value="<?php echo esc_url( add_query_arg(false, false) ) ?>" />
			<input type="hidden" name="storage_hash" value="<?php echo esc_attr($storage_hash) ?>" />
		</div>
	</form>
</div>