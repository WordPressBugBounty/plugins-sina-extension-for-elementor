<?php
namespace Sina_Extension;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Sina_Icofont_Icons{

	/**
	 * Get icons.
	 *
	 * Retrieve all the available icons.
	 *
	 * @since 3.10.1
	 * @access public
	 * @static
	 *
	 * @return array Available icons.
	 */

	public static function add_icofont_icons_tab( $tabs ) {
		$tabs['sina-icofont'] = [
			'name' => 'sina-icofont',
			'label' => __( 'Sina IcoFont', 'sina-ext' ),
			'url' => SINA_EXT_URL .'admin/assets/css/icofont.min.css',
			'enqueue' => [ SINA_EXT_URL .'admin/assets/css/icofont.min.css' ],
			'prefix' => 'icofont-',
			'displayPrefix' => 'icofont',
			'labelIcon' => 'icofont icofont-heart-eyes',
			'ver' => SINA_EXT_VERSION,
			'fetchJson' => SINA_EXT_URL .'admin/assets/js/sina-icofont.js?v=' . SINA_EXT_VERSION,
			'native' => false,
		];

		return $tabs;
	}
}