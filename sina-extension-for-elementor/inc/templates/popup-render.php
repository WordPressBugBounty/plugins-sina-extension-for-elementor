<div id="sina-ext-popup-<?php echo esc_attr( $template_id ) ?>" class="sina-ext-popup" data-settings='<?php echo wp_json_encode( $settings ) ?>'>
	<div class="sina-ext-popup-overlay"></div>
	<div class="sina-ext-popup-inner animated">
		<div class="sina-ext-popup-close-btn"><i class="icofont icofont-close"></i></div>
		<div class="sina-ext-popup-content">
			<?php echo $content; ?>
		</div>
	</div>
</div>