<?php
/**
 * Archive Template.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

do_action( 'sina_ext_others_builder_content' );

get_footer();
