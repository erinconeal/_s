<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package _s
 */

/**
 * WooCommerce setup function.
 *
 * See: https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 *
 * @return void
 */
function _s_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', '_s_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets
 *
 * @return void
 */
function _s_woocommerce_scripts() {
	wp_enqueue_style( '_s-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );
}

add_action( 'wp_enqueue_scripts', '_s_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will 
 * protect you during WooCommerce core updates.
 *
 * See: https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag
 *
 * @param  array $classes css classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class
 */
function _s_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}

add_filter( 'body_class', '_s_woocommerce_active_body_class' );

/**
 * Products per page
 *
 * @return integer number of products
 */
function _s_woocommerce_products_per_page() {
	return intval( apply_filters( '_s_woocommerce_products_per_page', 12 ) );
}

add_filter( 'loop_shop_per_page', '_s_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns
 *
 * @return integer number of columns
 */
function _s_woocommerce_thumbnail_columns() {
	return intval( apply_filters( '_s_woocommerce_product_thumbnail_columns', 4 ) );
}

add_filter( 'woocommerce_product_thumbnails_columns', '_s_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives
 *
 * @return integer products per row
 */
function _s_woocommerce_loop_columns() {
	return intval( apply_filters( '_s_woocommerce_loop_columns', 3 ) );
}

add_filter( 'loop_shop_columns', '_s_woocommerce_loop_columns' );

/**
 * Related Products Args
 *
 * @param array $args related products args.
 * @return array $args related products args
 */
function _s_woocommerce_related_products_args( $args ) {
	$args = apply_filters( '_s_woocommerce_related_products_args', array(
		'posts_per_page' => 3,
		'columns'        => 3,
	) );

	return $args;
}

add_filter( 'woocommerce_output_related_products_args', '_s_woocommerce_related_products_args' );

if ( ! function_exists( '_s_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper
	 *
	 * @return  void
	 */
	function _s_woocommerce_product_columns_wrapper() {
		$columns = _s_woocommerce_loop_columns();
		echo '<div class="columns-' . $columns . '">';
	}
}

add_action( 'woocommerce_before_shop_loop', '_s_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( '_s_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close
	 *
	 * @return  void
	 */
	function _s_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}

add_action( 'woocommerce_after_shop_loop', '_s_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( '_s_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content
	 * Wraps all WooCommerce content in wrappers which match the theme markup
	 *
	 * @return void
	 */
	function _s_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
		<?php
	}
}

add_action( 'woocommerce_before_main_content', '_s_woocommerce_wrapper_before' );

if ( ! function_exists( '_s_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content
	 * Closes the wrapping divs
	 *
	 * @return void
	 */
	function _s_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}

add_action( 'woocommerce_after_main_content', '_s_woocommerce_wrapper_after' );

if ( ! function_exists( '_s_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments
	 * Ensure cart contents update when products are added to the cart via AJAX
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX
	 */
	function _s_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		_s_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

add_filter( 'woocommerce_add_to_cart_fragments', '_s_woocommerce_cart_link_fragment' );

if ( ! function_exists( '_s_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 */
	function _s_woocommerce_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', '_s' ); ?>">
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), '_s' ), WC()->cart->get_cart_contents_count() ) );?></span><?php echo _s_get_svg( array( 'icon' => 'expand' ) ); ?>
			</a>
		<?php
	}
}

if ( ! function_exists( '_s_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart
	 *
	 * @return void
	 */
	function _s_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php _s_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</li>
		</ul>
		<?php
	}
}