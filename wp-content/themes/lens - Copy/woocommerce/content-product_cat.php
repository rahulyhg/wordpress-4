<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;
?>
<article <?php post_class('masonry__item  article--product  product--shop'); ?>>

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>


	<div class="product__image-wrapper" style="padding-top: 100%;">
		<div>
			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>			
		</div>		
	</div>

	<div class="product__container">
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="product__link  flexbox">
			<div class="flexbox__item">

			<h2 class="product__title  flush">
				<?php
					echo $category->name;

					if ( $category->count > 0 )
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <span>(' . $category->count . ')</span>', $category );
				?>
			</h2>

			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>

			</div>
		</a>
	</div>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</article>