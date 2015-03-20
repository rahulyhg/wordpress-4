<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability = $product->get_availability();

	if ($availability['availability']) :
		echo apply_filters( 'woocommerce_stock_html', '<span class="single-product-stock  ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</span>', $availability['availability'] );
    endif;
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart form-cart" method="post" enctype='multipart/form-data'>

	 	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	 	<?php
	 		if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) );
	 	?>

	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

		<?php if ( is_product() ) { ?>
			<div class="push--top">
				<button type="submit" class="btn  btn--medium"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce' ), $product->product_type); ?></button>
			</div>				
		<?php } else { ?>
			<div class="push--top">
				<button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', '<i class="pixcode  pixcode--icon  icon-shopping-cart"></i>', $product->product_type); ?></button>
			</div>
		<?php } ?>

	 	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>