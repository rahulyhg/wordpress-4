<?php

/**
 * Get the image for the google+ and facebook
 */
function wpgrade_get_socialimage() {
	global $post;
	$social_img    = '';
	$default_image = wpgrade::image_src( 'social_share_default_image' );
	$logo_src      = wpgrade::image_src( 'main_logo' );

	//if we are dealing with a post or a page
	if ( ! empty( $post ) ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '', '' );

		//we use the featured image id defined
		if ( has_post_thumbnail( $post->ID ) ) {
			$social_img = $src[0];
		} elseif ( ( is_home() || is_front_page() ) ) {
			if ( ! empty( $default_image ) ) {
				//if this is the front page we get the logo if no featured image is assigned
				$social_img = $default_image;

			} elseif ( ! empty( $logo_src ) ) {
				$social_img = $logo_src;
			}
		} else {
			// ! has_post_thumbnail and no front page
			// find the first image in the content
			preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
			if ( array_key_exists( 1, $matches ) && array_key_exists( 0, $matches[1] ) ) {
				$social_img = $matches [1] [0];
			}
		}

		if ( empty( $social_img ) ) {
			if ( is_attachment() ) {
				$temp       = wp_get_attachment_image_src( $post->ID, "full" );
				$social_img = $temp[0];
			} else {
				// ! is_attachment
				// try to get the first attached image
				$files = get_children( 'post_parent=' . $post->ID . '&post_type=attachment&post_mime_type=image&order=desc' );

				if ( $files ) {
					$keys       = array_reverse( array_keys( $files ) );
					$social_img = wp_get_attachment_url( $keys[0] );
				} else {
					// ! $files (use a default image)
					// check if we have one uploaded in the theme options
					if ( ! empty( $default_image ) ) {
						$social_img = $default_image;
					} else {
						// ! social_share_default_image (use the default thumb gif)
						$social_img = wpgrade::uri( '/theme-utilities/assets/social-and-seo/nothumb.png' );
					}
				}
			}
		}

		return $social_img;

	} else { // empty $post
		return $default_image;
	}
}

/**
 * General SEO
 */
function wpgrade_callback_general_seo() {
	include wpgrade::themefilepath( 'theme-utilities/assets/social-and-seo/general-seo' . EXT );
}

/**
 * Facebook share correct image fix (thanks to yoast).
 */
function wpgrade_callback_facebook_opengraph() {
	include wpgrade::themefilepath( 'theme-utilities/assets/social-and-seo/facebook-opengraph' . EXT );
}

/**
 * Google +1 meta info.
 */
function wpgrade_callback_google_metas() {
	include wpgrade::themefilepath( 'theme-utilities/assets/social-and-seo/google-plus-one' . EXT );
}

/**
 * Twitter card meta info
 */
function wpgrade_callback_twitter_card() {
	include wpgrade::themefilepath( 'theme-utilities/assets/social-and-seo/twitter-card-tags' . EXT );
}

function load_social_share() {
	if ( wpgrade::option( 'prepare_for_social_share' ) ) {
		add_action( 'wp_head', 'wpgrade_callback_general_seo' );
		add_action( 'wp_head', 'wpgrade_callback_facebook_opengraph' );
		add_action( 'wp_head', 'wpgrade_callback_google_metas' );
		add_action( 'wp_head', 'wpgrade_callback_twitter_card' );
	}
}

add_action( 'init', 'load_social_share', 5 );

/**
 * Adding the rel=me thanks to yoast.
 */
function wpgrade_callback_yoast_allow_rel() {
	global $allowedtags;
	$allowedtags['a']['rel'] = array();
}

add_action( 'wp_loaded', 'wpgrade_callback_yoast_allow_rel' );

/**
 * Adding facebook, twitter, & google+ links to the user profile
 */
function wpgrade_callback_add_user_fields( $contactmethods ) {
	$contactmethods['user_fb']        = 'Facebook';
	$contactmethods['user_tw']        = 'Twitter';
	$contactmethods['google_profile'] = 'Google Profile URL';

	return $contactmethods;
}

add_filter( 'user_contactmethods', 'wpgrade_callback_add_user_fields', 10, 1 );

//some SEO optimization functions
function clean_static_files() {
	if ( wpgrade::option( 'remove_parameters_from_static_res' ) ) {
		add_filter( 'the_generator', 'wpgrade_remove_version_info' );
		add_filter( 'script_loader_src', 'wpgrade_remove_script_version', 15, 1 );
		add_filter( 'style_loader_src', 'wpgrade_remove_script_version', 15, 1 );
	}
}

add_action( 'init', 'clean_static_files', 5 );

function wpgrade_remove_version_info() {
	return '';
}

function wpgrade_remove_script_version( $src ) {
	$parts = explode( '?ver', $src );

	return $parts[0];
}
	