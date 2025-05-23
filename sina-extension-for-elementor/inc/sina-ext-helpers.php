<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_ext_remove_chars($text) {
	return preg_replace('/[^A-Za-z0-9 @!.]/', '', $text);
}

function sina_ext_remove_pass_chars($text) {
	return preg_replace('/[^A-Za-z0-9-_]/', '', $text);
}

function sina_ext_escape_tags($tag, $default = 'h2', $extra = []) {
	$supports = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p'];

	$supports = array_merge($supports, $extra);

	if (!in_array($tag, $supports, true)) {
		return $default;
	}

	return $tag;
}

function sina_ext_escape_in_anims($anim, $default = 'fadeIn', $extra = []) {
	$supports = [
			'fadeIn',
			'fadeInUp',
			'fadeInDown',
			'fadeInLeft',
			'fadeInRight',
			'zoomIn',
			'zoomInLeft',
			'zoomInRight',
			'zoomInDown',
			'zoomInUp',
			'bounce',
			'bounceIn',
			'bounceInDown',
			'bounceInLeft',
			'bounceInRight',
			'bounceInUp',
			'slideInDown',
			'slideInLeft',
			'slideInRight',
			'slideInUp',
			'rotateIn',
			'rotateInDownLeft',
			'rotateInDownRight',
			'rotateInUpLeft',
			'rotateInUpRight',
			'flipInX',
			'flipInY',
			'lightSpeedIn',
			'flash',
			'pulse',
			'rubberBand',
			'shake',
			'headShake',
			'swing',
			'tada',
			'wobble',
			'jello',
			'rollIn'
		];

	$supports = array_merge($supports, $extra);

	if (!in_array($anim, $supports, true)) {
		return $default;
	}

	return $anim;
}

function sina_ext_custom_css($desktop_css = '', $tablet_css = '', $tablet_break = 1024) {
	$output_css = $desktop_css;
	if ( $tablet_css ) {
		$output_css .= '@media (max-width: '. $tablet_break .'px) {'. $tablet_css .'}';
	}
	?>
	<style type="text/css">
		<?php echo esc_attr( $output_css ); ?>
	</style>
	<?php
}

function sina_get_page_lists() {
	$page_ids = get_all_page_ids();
	$page_lists = [];
	foreach ($page_ids as $id) {
		if ( !in_array($id, $page_lists) ) {
			$page_title = get_the_title( $id );
			$page_lists[$id] = $page_title;
		}
	}
	return $page_lists;
}

function sina_get_term_lists( $tax ) {
	$terms = get_terms(
		[
			'taxonomy' => $tax,
			'hide_empty' => false,
		]
	);
	$term_lists = [];
	foreach ($terms as $term) {
		if ( is_object($term) && !in_array($term->term_taxonomy_id, $term_lists) ) {
			$term_lists[$term->term_taxonomy_id] = ucfirst(str_replace('_', ' ', $term->name));
		}
	}
	return $term_lists;
}

function sina_get_taxonomy_lists() {
	$terms = get_terms();
	$term_lists = [];
	$exclude_terms = [
		'nav_menu',
		'elementor_library_type',
	];
	foreach ($terms as $term) {
		if ( is_object($term) && !in_array($term->taxonomy, $exclude_terms) ) {
			if ( !in_array($term->taxonomy, $term_lists) ) {
				$term_lists[$term->taxonomy] = ucfirst(str_replace('_', ' ', $term->taxonomy));
			}
		}
	}
	return $term_lists;
}

function sina_get_portfolio_cat( $portfolio ) {
	$category_in = [];

	foreach ( $portfolio as $item ) {
		if ( $item['category'] ) {
			$cat_explode = explode( ',', $item['category'] );

			foreach ( $cat_explode as $name ) {
				$category = strtolower( str_replace( ' ', '_', $name ) );

				if ( !in_array($category, $category_in) ) {
					$category_in[] = $category;
				}
			}
		}
	}
	return $category_in;
}

function sina_get_user_roles() {
	global $wp_roles;
	$all = $wp_roles->roles;
	$all_roles = [];

	if (!empty($all)) {
		foreach ($all as $key => $value) {
			$all_roles[$key] = $all[$key]['name'];
		}
	}
	return $all_roles;
}

function sina_get_category_ids(){
	$terms = get_terms( [ 
		'taxonomy' => 'category',
		'hide_empty' => false,
	] );

	$options = [];
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		foreach ( $terms as $term ) {
			$options[ $term->term_id ] = $term->name;
		}
	}
	return $options;
}

function sina_get_tag_ids(){
	$terms = get_terms( [ 
		'taxonomy' => 'post_tag',
		'hide_empty' => false,
	] );

	$options = [];
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		foreach ( $terms as $term ) {
			$options[ $term->term_id ] = $term->name;
		}
	}
	return $options;
}

function sina_get_categories(){
	$terms = get_terms( [ 
		'taxonomy' => 'category',
		'hide_empty' => false,
	] );

	$options = [];
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		foreach ( $terms as $term ) {
			$options[ $term->name ] = $term->name;
		}
	}
	return $options;
}

function sina_get_page_templates(){
	$page_templates = get_posts( [
		'post_type'         => 'elementor_library',
		'posts_per_page'    => -1
	] );

	$options = [];

	if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
		foreach ( $page_templates as $template ) {
			$options[ $template->ID ] = $template->post_title;
		}
	}
	return $options;
}

function sina_get_templates_data($id, $frontend){
	if (current_user_can( 'edit_others_posts' )) {
		return $frontend->get_builder_content( $id, true );
	} elseif ( 'publish' == get_post_status($id) ) {
		return $frontend->get_builder_content( $id, true );
	}
}