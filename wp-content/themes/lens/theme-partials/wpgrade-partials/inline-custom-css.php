<?php
	/* @var string $main_color */
	/* @var array  $fonts */
	/* @var string $port_color */
	/* @var string $rgb */


$main_color = wpgrade::option('main_color');
$rgb = implode(',', wpgrade::hex2rgb_array($main_color));
$fonts = array();

if (wpgrade::option('use_google_fonts')) {
	$fonts_array = array
	(
		'google_main_font',
		'google_second_font',
		'google_menu_font',
		'google_body_font'
	);



	foreach ($fonts_array as $font) {
		$the_font = wpgrade::get_the_typo($font);
		if ( isset($the_font['font-family'] ) && ! empty($the_font['font-family'])) {
			$fonts[$font] = $the_font;
		}
	}
//	var_export($fonts);
}

$port_color = '';
if (wpgrade::option('portfolio_text_color')) {
	$port_color = wpgrade::option('portfolio_text_color');
	$port_color = str_replace('#', '', $port_color);
}

function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
//     return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

if ( !empty($main_color) ){
$rgb = implode(",", hex2rgb($main_color)); ?>

.inverse a,
.highlighted,
blockquote:before,
.emphasized:before,
.menu-item--main:hover > a,
.menu-item--main:focus > a,
.menu-item--main:active > a,
.menu-item--main.current-menu-item > a,
.menu-item--main.current-menu-ancestor > a,
.menu-item--main.current-menu-parent > a,
.mosaic__filter-item.active, .mosaic__filter-item:hover,
.complete i,
.liked i,
.article-timestamp--single .article-timestamp__date,
a:hover > i.pixcode--icon,
.btn:hover, .wpcf7-submit:hover, .form-submit #comment-submit:hover,
.widget--header a:hover,
a.site-home-link, .site-navigation--mobile .menu-item:hover > a,
.site-navigation--mobile .menu-item.current-menu-ancestor > a, 
.site-navigation--mobile .menu-item.current-menu-parent > a,
.site-navigation--mobile .menu-item.current-menu-item > a,
.cart--widget .cart-link:hover,
.mosaic__pagination .prev:hover, .mosaic__pagination .next:hover {
    color: <?php echo $main_color; ?>;
}

.rsNavSelected,
.pin_ring--outer,
.liked i,
.btn, .wpcf7-submit, .form-submit #comment-submit,
.progressbar__progress,
.rsNavSelected,
.product__badge, .cart--widget .cart__btn .cart-size,
.woocommerce-page .woocommerce-message .pixcode--icon,
.woocommerce-page .woocommerce-info .pixcode--icon {
    background-color: <?php echo $main_color; ?>;
}

.image__item-meta, .mfp-video:hover .image__item-meta, .external_url:hover .image__item-meta, .article--product:hover .product__container {
    background-color: <?php echo $main_color; ?>;
    background-color: rgba(<?php echo $rgb; ?>, 0.8);
}

.mosaic__item--page-title-mobile .image__item-meta
.touch .mosaic__item--page-title .image__item-meta, .touch .mosaic__item--page-title-mobile .image__item-meta {
    background-color: rgba(<?php echo $rgb; ?>, 0.8);
}

.loading .pace .pace-activity,
.no-touch .arrow-button:hover {
    border-color: <?php echo $main_color; ?> ;
}

.loading .pace .pace-activity {
    border-top-color: transparent;
}

.menu-item--main.current-menu-item:after,
.menu-item--main.current-menu-ancestor:after,
.menu-item--main.current-menu-parent:after,
.menu-item--main:hover:after,
.menu-item--main:focus:after,
.menu-item--main:active:after,
.site-navigation--mobile .menu-item.current-menu-parent:after, 
.site-navigation--mobile .menu-item:hover:after, 
.site-navigation--mobile .menu-item:focus:after, 
.site-navigation--mobile .menu-item:active:after  {
    border-top-color: <?php echo $main_color; ?> ;
}

.header:before {
    background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(50%, <?php echo $main_color; ?>), color-stop(100%, #464a4d));
    background-image: -webkit-linear-gradient(<?php echo $main_color; ?> 50%, #464a4d);
    background-image: -moz-linear-gradient(<?php echo $main_color; ?> 50%, #464a4d);
    background-image: -o-linear-gradient(<?php echo $main_color; ?> 50%, #464a4d);
    background-image: linear-gradient(<?php echo $main_color; ?> 50%, #464a4d);
}

.lt-ie9 .header:before {
    filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0, startColorstr='#FFFFFC00', endColorstr='#FF464A4D');
}

@media only screen and (min-width: 1201px){
    .team-member__profile{
        background-color: rgba(<?php echo $rgb; ?>, .8);
    }
}

<?php }

if ( isset($fonts["google_body_font"]) ){ ?>

html,
.wpcf7-form-control:not([type="submit"]),
.wp-caption-text,
blockquote:before,
ol li,
.comment__timestamp,
.meta-box__box-title,
.header-quote-content blockquote .author_description,
.testimonial__author-title,
.widget-content {
	<?php wpgrade::display_font_params($fonts['google_body_font']); ?>
}

<?php }

if ( isset($fonts["google_main_font"]) ){ ?>
.count, .count sup,
.header-quote-content blockquote,
.article-timestamp,
.progressbar__title,
.progressbar__tooltip,
.testimonial__content,
.testimonial__author-name,
.tweet__meta,
.search-query,
.mfp-title,
.entry__content ul li,
.hN, .alpha, h1,
.beta, h2, .gamma, h3,
.masonry__item .entry__title,
.single-portfolio-fullwidth .entry__title,
.delta, h4, .epsilon, h5, .zeta, h6,
.comment__author-name,
.entry__meta-box a {
	<?php wpgrade::display_font_params($fonts['google_main_font']); ?>
}

<?php }

if ( isset($fonts["google_menu_font"]) ){ ?>
.image__plus-icon,
.image_item-description,
.image_item-category,
.btn, .wpcf7-submit, .form-submit #comment-submit,
.header,
.header .hN,
.header .alpha,
.header h1,
.header .beta,
.header h2,
.header .gamma,
.header h3,
.header .masonry__item .entry__title,
.masonry__item .header .entry__title,
.header .single-portfolio-fullwidth .entry__title,
.single-portfolio-fullwidth .header .entry__title,
.header .delta,
.header h4,
.header .epsilon,
.header h5,
.header .zeta,
.header h6,
.footer .hN,
.footer .alpha, .footer h1,
.footer .beta,
.footer h2,
.footer .gamma,
.footer h3,
.footer .masonry__item .entry__title,
.masonry__item .footer .entry__title,
.footer .single-portfolio-fullwidth .entry__title,
.single-portfolio-fullwidth .footer .entry__title,
.footer .delta,
.footer h4,
.footer .epsilon,
.footer h5,
.footer .zeta,
.footer h6,
.text-link,
.projects_nav-item a {
	<?php wpgrade::display_font_params($fonts['google_menu_font']); ?>
}
<?php } ?>

<?php if (wpgrade::option('custom_css')):
	echo wpgrade::option('custom_css');
endif; ?>