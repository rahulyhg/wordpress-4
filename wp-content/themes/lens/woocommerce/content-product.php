<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-big');
$image_ratio = 70; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
if (isset($image[1]) && isset($image[2]) && $image[1] > 0) {
	$image_ratio = $image[2] * 100/$image[1];
}
?>
<article <?php post_class('masonry__item  article--product  product--shop'); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		<div class="product__container">
			<a href="<?php the_permalink(); ?>" class="product__link  flexbox">
				<div class="flexbox__item">
					<h2 class="product__title  flush"><?php the_title(); ?></h2>
					<?php if ( $price_html = $product->get_price_html() ) : ?>
						<span class="product__price"><?php echo $price_html; ?></span>
					<?php endif;

					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

				</div>
			</a>
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div>


</article>
