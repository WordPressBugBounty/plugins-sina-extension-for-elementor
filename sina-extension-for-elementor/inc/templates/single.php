<?php
/**
 * Single Template.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div <?php post_class(); ?>>
	<?php do_action( 'sina_ext_single_builder_content' ); ?>
</div>
<?php
get_footer();

