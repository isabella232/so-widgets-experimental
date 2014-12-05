<?php foreach( $networks as $network ) :
	$classes = array();
	if( !empty($instance['hover']) ) $classes[] = 'ow-button-hover';
	$classes[] = "sow-social-media-icon-" . esc_attr( $network['name'] );
	$button_attributes = array(
		'class' => esc_attr(implode(' ', $classes))
	);
	if(!empty($instance['new_window'])) $button_attributes['target'] = '_blank';
	if(!empty($network['url'])) $button_attributes['href'] = esc_url($network['url']);
	?>

	<a <?php foreach($button_attributes as $name => $val) echo $name . '="' . $val . '" ' ?>>
			<span>
				<?php echo siteorigin_widget_get_icon('fontawesome-'.$network['name']); ?>
			</span>
	</a>
<?php endforeach; ?>