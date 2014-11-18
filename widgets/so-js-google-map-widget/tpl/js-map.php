<div
	class="google-map-canvas"
	style="height:<?php echo $height ?>px;"
	id="map-canvas-<?php echo $map_id ?>"
<?php foreach( $map_data as $key => $val ) : ?>
	<?php if ( ! empty( $val ) ) : ?>
	data-<?php echo $key . '="' . esc_attr( $val ) . '"'?>
	<?php endif ?>
<?php endforeach; ?>
></div>