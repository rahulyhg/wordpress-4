<?php

	/**
	 * Invoked in wpgrade-config.php
	 */
	function wpgrade_callback_contact_script() {
		if (is_page_template('template-contact.php')) {
			wp_enqueue_script('contact-scripts');
		}
	}

	/**
	 * Invoked in wpgrade-config.php
	 */
	function wpgrade_callback_thread_comments_scripts() {
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}

/**
 * Load google fonts appropriate script block.
 *
 * This callback is invoked by wpgrade_callback_enqueue_dynamic_css
 */
function wpgrade_callback_load_google_fonts_old() {
	if (wpgrade::option('use_google_fonts')) {

		$fonts_array = array
		(
			'google_main_font',
			'google_second_font',
			'google_menu_font',
			'google_body_font'
		);

		$families = array();
		foreach ($fonts_array as $font) {
			$clean_font = wpgrade::get_google_font_name($font);

			if ( ! empty($clean_font)) {
				$families[] = $clean_font;
			}
		}

		if ( ! empty($families)) {
			// any variables in scope will be available in the partial
			include wpgrade::themefilepath('wpgrade-core/resources/views/google-fonts-script'.EXT);
		}
	}
}

/**
 * This callback is invoked by wpgrade_callback_themesetup.
 */
function wpgrade_callback_enqueue_dynamic_css_old() {
	$style_query = array();

	if (wpgrade::option('main_color')) {
		$main_color = wpgrade::option('main_color');
		$main_color = str_replace('#', '', $main_color);
		$style_query['color'] = $main_color;
	}

	if (wpgrade::option('use_google_fonts')) {
		add_action('wp_head', 'wpgrade_callback_load_google_fonts_old');

		$fonts_array = array
		(
			'google_main_font',
			'google_second_font',
			'google_menu_font',
			'google_body_font'
		);

		foreach ($fonts_array as $font) {
			$the_font = wpgrade::get_the_typo($font);
			if ( ! empty($the_font)) {
				$style_query['fonts'][$font] = $the_font;
			}
		}
	}

	if (wpgrade::option('portfolio_text_color')) {
		$port_color = wpgrade::option('portfolio_text_color');
		$port_color = str_replace('#', '', $port_color);
		$style_query['port_color'] = $port_color;
	}

	if ( wpgrade::option('inject_custom_css') == 'file' ){
		wp_enqueue_style('wpgrade-custom-style', get_template_directory_uri() . '/theme-content/css/custom.css' );
	}
}

function wpgrade_callback_inlined_custom_style_lens() {

	ob_start();
	include wpgrade::corepartial('inline-custom-css'.EXT);
	$custom_css = ob_get_clean();
	$style = 'wpgrade-main-style';
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$style = 'wpgrade-woocommerce';
	}
	wp_add_inline_style( $style, $custom_css );

}

/**
 * Enqueue our custom css on admin panel
 */
function wpgrade_add_admin_custom_style() {
	// this is our custom field and it wont get loaded by redux
	//		wp_register_script(
	//			'redux-field-text-sortable-js',
	//			wpgrade::coremoduleuri('redux3') . 'inc/fields/text_sortable/field_text_sortable.js',
	//			array('jquery'),
	//			time(),
	//			true
	//		);

//	wp_enqueue_style(
//		'theme-custom-css',
//		wpgrade::resourceuri('css/admin/admin-panel.css'),
//		array(), // Be sure to include redux-css so it's appended after the core css is applied
//		time(),
//		'all'
//	);

//	wp_enqueue_script('wp-ajax-response');
//
//	wp_enqueue_script(
//		'theme-custom-js',
//		wpgrade::resourceuri('js/admin/admin-panel.js'),
//		array('jquery' ), // Be sure to include redux-css so it's appended after the core css is applied
//		time(),
//		true
//	);
}
// This example assumes your opt_name is set to redux, replace with your opt_name value
//add_action('redux/page/'. wpgrade::shortname() .'_options/enqueue', 'wpgrade_add_admin_custom_style',0);
