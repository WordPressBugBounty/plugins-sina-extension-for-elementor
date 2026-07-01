<?php
	$toggleHTML  = '';
	$reverseIcon = [
		'up' => 'down',
		'right' => 'left',
		'down' => 'up',
		'left' => 'right',
	];
	if ( 'yes' == $settings['sidebar_toggle']) {
		$toggleIcon = $settings['sidebar_toggle_open_icon'];
		$toggleText = $settings['sidebar_toggle_open_text'];

		$toggleHTML = $toggleIcon ? '<i class="'.esc_attr($toggleIcon).'"></i>' : ($toggleText ? '<span>'.esc_html($toggleText).'</span>' : '<i class="icofont icofont-rounded-'.esc_attr($reverseIcon[$settings['sidebar_position']]).'"></i>');
	}
?>
<div id="sina-ext-sidebar-<?php echo esc_attr( $template_id ) ?>" class="sina-ext-sidebar sina-ext-sidebar-<?php echo esc_attr($settings['sidebar_position']); ?>" data-settings='<?php echo wp_json_encode( $settings ); ?>'>
	<div class="sina-ext-sidebar-inner">
		<div class="sina-ext-sidebar-toggle-btn"><?php printf('%s', $toggleHTML ); ?></div>
		<div class="sina-ext-sidebar-close-btn"><i class="icofont icofont-close"></i></div>
		<div class="sina-ext-sidebar-content">
			<?php echo $content ?>
		</div>
	</div>
</div>