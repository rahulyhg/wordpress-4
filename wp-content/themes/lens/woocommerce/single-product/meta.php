<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>

<hr class="separator separator--striped">
<footer class="entry__meta entry__meta--project row cf  push--top  push--bottom">
	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option( 'woocommerce_enable_sku' ) == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo $product->get_sku(); ?></span>.</span>
	<?php endif;

		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo $product->get_categories( ' ', '<div class="entry__meta-box meta-box--categories col-12 hand-col-6">' . _n( '<span class="meta-box__box-title">Category:</span>', '<span class="meta-box__box-title">Categories:</span>', $size, 'woocommerce' ) . '', '</div>' );

		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ' ', '<div class="entry__meta-box meta-box--categories col-12 hand-col-6">' . _n( '<span class="meta-box__box-title">Tag:</span>', '<span class="meta-box__box-title">Tags:</span>', $size, 'woocommerce' ) . '', '</div>' );

		if (wpgrade::option('portfolio_single_show_share_links')): ?>
			<script type="text/javascript">/* --- MAKE POPUPS --- */function popitup(url, title) {newwindow=window.open(url,title,'height=300,width=600');if (window.focus) {newwindow.focus()}	return false; } </script>
			
			<div class="social-links  col-12 hand-col-6">
				<span class="social-links__message"><?php _e("Share", wpgrade::textdomain()); ?>: </span>
				<ul class="social-links__list">
					<?php if (wpgrade::option('portfolio_single_share_links_twitter')): ?>
						<li>
							<a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(get_permalink(get_the_ID()))?>&amp;source=tweetbutton&amp;text=<?php echo urlencode(get_the_title())?>&amp;url=<?php echo urlencode(get_permalink(get_the_ID()))?>&amp;via=<?php echo wpgrade::option( 'twitter_card_site' ) ?>" onclick="return popitup(this.href, this.title)"
							   title="<?php _e('Share on Twitter!', wpgrade::textdomain()) ?>">
								<i class="icon-e-twitter-circled"></i>
							</a>
						</li>
					<?php endif;
					if (wpgrade::option('portfolio_single_share_links_facebook')): ?>
						<li>
							<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)"
							   title="<?php _e('Share on Facebook!', wpgrade::textdomain()) ?>">
								<i class="icon-e-facebook-circled"></i>
							</a>
						</li>
					<?php endif;
					if (wpgrade::option('portfolio_single_share_links_googleplus')): ?>
						<li>
							<a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)"
							   title="<?php _e('Share on Google+!', wpgrade::textdomain()) ?>">
								<i class="icon-e-gplus-circled"></i>
							</a>
						</li>
					<?php endif;
					if (wpgrade::option('portfolio_single_share_links_pinterest')):
						$image = '';
						if (has_post_thumbnail(get_the_ID() ) ) {
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
							$image = $image[0];
						} ?>
						<li>
							<a href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink(get_the_ID()))?>&media=<?php echo urlencode($image) ?>&description=<?php echo urlencode(wpgrade_better_excerpt('',false)); ?>" onclick="return popitup(this.href, this.title)"
							   title="<?php _e('Pin it!', wpgrade::textdomain()) ?>">
								<i class="icon-e-pinterest-circled"></i>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		<?php endif; ?>


	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</footer><!-- .entry__meta .entry__meta-project -->