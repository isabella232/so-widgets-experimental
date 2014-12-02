<div>
<?php foreach( $networks as $network ) : ?>

	<?php
	$button_attributes = array();
	$button_attributes['class'] = "sow-social-media-icon-" . esc_attr( $network['name'] );
	if(!empty($instance['new_window'])) $button_attributes['target'] = '_blank';
	if(!empty($network['url'])) $button_attributes['href'] = esc_url($network['url']);
	?>

	<a <?php foreach($button_attributes as $name => $val) echo $name . '="' . $val . '" ' ?>>
			<span>
				<?php echo siteorigin_widget_get_icon('fontawesome-'.$network['name']); ?>
			</span>
	</a>
<?php endforeach; ?>
</div>