<?php
namespace Sina_Extension;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Plugin;

class Sina_Ext_Shortcode_Generator{
	const POST_TYPE = 'elementor_library';

	private static $instance = null;

	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_filter( 'manage_'.self::POST_TYPE.'_posts_columns', [ $this, 'add_column' ] );
		add_action( 'manage_'.self::POST_TYPE.'_posts_custom_column', [ $this, 'render_column' ], 10, 2 );
		add_action( 'admin_footer', [ $this, 'print_script' ] );

		add_shortcode( 'sina_ext_shortcode', [ $this, 'render_shortcode' ] );
	}

	public function render_shortcode( $atts ) {
		$atts = shortcode_atts( [ 'id' => 0 ], $atts );
		$id   = absint( $atts['id'] );

		if ( !$id ) {
			return '';
		}

		return Plugin::instance()->frontend->get_builder_content_for_display( $id );
	}

	public function add_column( array $columns ) {
		$new = [];

		foreach ( $columns as $key => $label ) {
			$new[ $key ] = $label;

			if ( 'title' === $key ) {
				$new['sina_ext_shortcode'] = esc_html__( 'Sina Shortcode', 'sina-ext' );
			}
		}

		return $new;
	}

	public function render_column( string $column, int $post_id ) {
		if ( 'sina_ext_shortcode' !== $column ) {
			return;
		}

		$shortcode = sprintf( '[sina_ext_shortcode id="%d"]', $post_id );
		?>
		<div class="sina_ext_shortcode-wrap">
			<code class="sina_ext_shortcode-code"><?php echo esc_html( $shortcode ); ?></code>
			<button type="button" class="sina_ext_shortcode-btn button button-small" data-shortcode="<?php echo esc_attr( $shortcode ); ?>" aria-label="<?php echo esc_attr__( 'Copy shortcode', 'sina-ext' ); ?>">
				<?php echo esc_html__( 'Copy', 'sina-ext' ); ?>
			</button>
			<span class="sina_ext_shortcode-copied" aria-live="polite"><?php echo esc_html__( 'Copied!', 'sina-ext' ); ?></span>
		</div>
		<?php
	}

	public function print_script() {
		$screen = get_current_screen();

		if ( !$screen || 'edit' !== $screen->base || self::POST_TYPE !== $screen->post_type ) {
			return;
		}
		?>
		<style>
			.sina_ext_shortcode-wrap{display:flex;align-items:center;gap:6px;flex-wrap:wrap}.sina_ext_shortcode-code{border-radius:4px;user-select:all}.sina_ext_shortcode-copied{color:#00a32a;display:none}.sina_ext_shortcode-copied.sina_ext_shortcode-visible{display:inline}
		</style>

		<script>
			!function(){function e(e){e.classList.add("sina_ext_shortcode-visible"),setTimeout(function(){e.classList.remove("sina_ext_shortcode-visible")},2e3)}document.querySelectorAll(".sina_ext_shortcode-btn").forEach(function(t){t.addEventListener("click",function(){var o=t.getAttribute("data-shortcode"),i=t.nextElementSibling;if(navigator.clipboard&&navigator.clipboard.writeText)navigator.clipboard.writeText(o).then(function(){e(i)});else{var n=document.createElement("textarea");n.value=o,n.style.position="fixed",n.style.opacity="0",document.body.appendChild(n),n.focus(),n.select();try{document.execCommand("copy")}catch(e){}document.body.removeChild(n),e(i)}})})}();
		</script>
		<?php
	}
}

Sina_Ext_Shortcode_Generator::init();