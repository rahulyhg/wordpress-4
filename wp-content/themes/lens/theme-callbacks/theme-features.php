<?php

function wpgrade_callback_custom_theme_features() {
	add_theme_support('automatic-feed-links');

	//load editor-style.css if present in parent and/or child theme
	add_editor_style(array('theme-content/css/editor-style.css', 'editor-style.css'));
}

add_action('after_setup_theme', 'wpgrade_callback_custom_theme_features');

/**
 * @see wpgrade-config.php -> body-classes
 * @return boolean true if page may have the class 'header-transparent'
 */
function wpgrade_callback_has_featured_image_class() {
	if (is_singular() && (has_post_thumbnail() || get_post_format() == 'gallery' || get_post_format() == 'image')) {
		return false;
	} elseif (is_page() || is_archive() || is_home()) {
		if (is_page_template('template-portfolio.php') && wpgrade::option('portfolio_header_image')) {
			return true;
		}

		if (is_tax('portfolio_cat') && wpgrade::option('portfolio_header_image') ) {
			return true;
		}

		if (is_page_template('template-front-page.php') && wpgrade::option('homepage_use_slider')) {
			return true;
		}

		if ((is_archive() || is_home() || is_page_template( 'template-blog-archive.php' )) && wpgrade::option('blog_header_image')) {
			return true;
		}
	}

	return false;
}
add_action('wp_head', 'wpgrade_callbacks_html5_shim');

//function wpgrade_callback_sort_query_by_post_in( $sortby, $thequery ) {
//	if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
//		$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";
//
//	return $sortby;
//}
//add_filter( 'posts_orderby', 'wpgrade_callback_sort_query_by_post_in', 10, 2 );

add_action('wp_head', 'wpgrade_add_desktop_icons');
function wpgrade_add_desktop_icons(){

	if ( wpgrade::image_src( 'favicon' ) ) {
		echo "<link rel='icon' href=\"".wpgrade::image_src( 'favicon' )."\" >\n";
	}

	if ( wpgrade::image_src( 'apple_touch_icon' ) ) {
		echo "<link rel=\"apple-touch-icon\" href=\"".wpgrade::image_src( 'apple_touch_icon' )."\" >\n";
	}

	if ( wpgrade::image_src( 'metro_icon' ) ) {
		echo "<meta name=\"msapplication-TileColor\" content=\"#f01d4f\">\n";
		echo "<meta name=\"msapplication-TileImage\" content=\"".wpgrade::image_src( 'metro_icon' )."\" >\n";
	}

}

add_action('admin_head', 'wpgrade_add_admin_favicon');
function wpgrade_add_admin_favicon() {
	if ( wpgrade::image_src( 'favicon' ) ) {
		echo "<link rel='icon' href=\"" . wpgrade::image_src( 'favicon' ) . "\" >\n";
	}
}

function wpgrade_prepare_password_for_custom_post_types(){

	global $wpgrade_private_post;
	$wpgrade_private_post = lens::is_password_protected();

}

add_action('wp', 'wpgrade_prepare_password_for_custom_post_types');