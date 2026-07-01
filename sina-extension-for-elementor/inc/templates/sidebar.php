<?php
/**
 * Sidebar Template.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$elementor_instance = \Elementor\Plugin::$instance;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
	<?php if ( !current_theme_supports( 'title-tag' ) ) : ?>
		<title><?php echo esc_html(wp_get_document_title()); ?></title>
	<?php endif; ?>
	<style>
		body{background-color: #00000080 !important;}
	</style>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
		$template_id = get_the_ID();
		$settings 	 = sina_get_the_sidebar_settings($template_id);
		$toggleHTML  = '';
		if ( 'yes' == $settings['sidebar_toggle']) {
			$toggleIcon = $settings['sidebar_toggle_close_icon'];
			$toggleText = $settings['sidebar_toggle_close_text'];

			$toggleHTML = $toggleIcon ? '<i class="'.esc_attr($toggleIcon).'"></i>' : ($toggleText ? '<span>'.esc_html($toggleText).'</span>' : '<i class="icofont icofont-rounded-'.esc_attr($settings['sidebar_position']).'"></i>');
		}
	?>
	<div id="sina-ext-sidebar-<?php echo esc_attr($template_id); ?>" class="sina-ext-sidebar sina-ext-sidebar-show sina-ext-sidebar-<?php echo esc_attr($settings['sidebar_position']); ?>" data-settings='<?php echo wp_json_encode( $settings ); ?>'>
		<div class="sina-ext-sidebar-inner">
			<div class="sina-ext-sidebar-toggle-btn"><?php printf('%s', $toggleHTML ); ?></div>
			<div class="sina-ext-sidebar-close-btn"><i class="icofont icofont-close"></i></div>
			<div class="sina-ext-sidebar-content">
				<?php $elementor_instance->modules_manager->get_modules( 'page-templates' )->print_content(); ?>
			</div>
		</div>
	</div>

	<?php wp_footer(); ?>
</body>
</html>