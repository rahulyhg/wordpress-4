<?php

$sections = array();
$debug    = '';

if ( isset( $_GET[ 'debug_mod' ] ) && $_GET[ 'debug_mod' ] === 'true' ) {
	$debug = 'debug_on';
}

// General Options
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'   => 'icon-database-1',
	'title'  => __( 'General', wpgrade::textdomain() ),
	'desc'   => sprintf( '<p class="description">' . __( 'General settings contains options that have a site-wide reach like defining your site dynamics or branding (including logo and other icons).', wpgrade::textdomain() ) . '</p>', wpgrade::themename() ),
	'fields' => array(
		array(
			'id'       => 'use_smooth_scroll',
			'type'     => 'switch',
			'title'    => __( 'Smooth Scrolling', wpgrade::textdomain() ),
			'subtitle' => __( 'Enable / Disable smooth scrolling.', wpgrade::textdomain() ),
			'default'  => '1'
		),
		array(
			'id'       => 'use_ajax_loading',
			'type'     => 'switch',
			'title'    => __( 'Ajax Loading', wpgrade::textdomain() ),
			'subtitle' => __( 'Enable / Disable ajax loading', wpgrade::textdomain() ),
			'default'  => '1'
		),
		array(
			'id'       => 'show_title_caption_popup',
			'type'     => 'switch',
			'title'    => __( 'Show Title and Caption In Pop-up and Sliders', wpgrade::textdomain() ),
			'subtitle' => __( 'Display the image title and caption in gallery & portfolio pop-ups and sliders. <br />Both title and caption are optional and will only be shown if set.', wpgrade::textdomain() ),
			'default'  => '1'
		),
		array(
			'id'       => 'enable_copyright_overlay',
			'type'     => 'switch',
			'title'    => __( 'Right-Click Protection?', wpgrade::textdomain() ),
			'subtitle' => __( 'Prevent right-click saving for images and display a tooltip instead.', wpgrade::textdomain() ),
			'default'  => '0',
		),
		array(
			'id'       => 'copyright_overlay_text',
			'type'     => 'text',
			'required' => array( 'enable_copyright_overlay', '=', 1 ),
			'title'    => __( 'Right click protection text', wpgrade::textdomain() ),
			'default'  => 'This content is &copy; 2014 ' . wpgrade::themename() . ' | All rights reserved.',
		),
		array(
			'id'   => 'branding-header-90821',
			'desc' => '<h3>' . __( 'Branding', wpgrade::textdomain() ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'main_logo',
			'type'     => 'media',
			'title'    => __( 'Main Logo', wpgrade::textdomain() ),
			'subtitle' => __( 'If there is no image uploaded, plain text will be used instead (generated from the site\'s name).', wpgrade::textdomain() ),
		),
		array(
			'id'       => 'use_retina_logo',
			'type'     => 'switch',
			'title'    => __( '2x Retina Logo', wpgrade::textdomain() ),
			'subtitle' => __( 'To be Retina-ready you need to add a 2x size logo image.', wpgrade::textdomain() ),
		),
		array(
			'id'       => 'retina_main_logo',
			'type'     => 'media',
			'title'    => __( 'Retina Logo', wpgrade::textdomain() ),
			'class'    => 'js-class-hook image--small',
			'required' => array( 'use_retina_logo', 'equals', 1 )
		),
		array(
			'id'       => 'favicon',
			'type'     => 'media',
			'class'    => 'js-class-hook image--small',
			'title'    => __( 'Favicon', wpgrade::textdomain() ),
			'subtitle' => __( 'Upload a 16 x 16px image that will be used as a favicon.', wpgrade::textdomain() ),
		),
		array(
			'id'       => 'apple_touch_icon',
			'type'     => 'media',
			'class'    => 'js-class-hook image--small',
			'title'    => __( 'Apple Touch Icon', wpgrade::textdomain() ),
			'subtitle' => __( 'You can customize the icon for the Apple touch shortcut to your website. The size of this icon must be 77x77px.', wpgrade::textdomain() )
		),
		array(
			'id'       => 'metro_icon',
			'type'     => 'media',
			'class'    => 'js-class-hook image--small',
			'title'    => __( 'Metro Icon', wpgrade::textdomain() ),
			'subtitle' => __( 'The size of this icon must be 144x144px.', wpgrade::textdomain() )
		)
	)
);


// Style Options
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'       => "icon-params",
	'icon_class' => '',
	'title'      => __( 'Style', wpgrade::textdomain() ),
	'desc'       => '<p class="description">' . __( 'The style options control the general styling of the site, like accent color and Google Web Fonts. You can choose custom fonts for various typography elements with font weight, character set, size and/or line height. You also have a live preview for your chosen fonts.', wpgrade::textdomain() ) . '</p>',
	'fields'     => array(
		array(
			'id'          => 'main_color',
			'type'        => 'color',
			'title'       => __( 'Main Color', wpgrade::textdomain() ),
			'subtitle'    => __( 'Use the color picker to change the main color of the site to match your brand color.', wpgrade::textdomain() ),
			'default'     => '#fffc00',
			'validate'    => 'color',
			'compiler'    => true,
			'transparent' => false
		),
		array(
			'id'   => 'typography-header-908212',
			'desc' => '<h3>' . __( 'Typography', wpgrade::textdomain() ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'use_google_fonts',
			'type'     => 'switch',
			'title'    => __( 'Do you need custom web fonts?', wpgrade::textdomain() ),
			'subtitle' => __( 'Tap into the massive <a href="http://www.google.com/fonts/">Google Fonts</a> collection (with Live preview).', wpgrade::textdomain() ),
			'default'  => '0',
			'compiler' => true,
		),
		// Headings Font
		array(
			'id'             => 'google_main_font',
			'type'           => 'typography',
			'color'          => false,
			'font-size'      => false,
			'line-height'    => false,
			'text-transform' => false,
			'letter-spacing' => false,
			'text-align'     => false,
			'all-styles'     => true,
			'google'         => true,
			'required'       => array( 'use_google_fonts', '=', 1 ),
			'title'          => __( 'Main Heading Font', wpgrade::textdomain() ),
			'subtitle'       => __( 'Select a font for the main titles.', wpgrade::textdomain() ),
			'compiler'       => true
		),
		// Navigation Font
		array(
			'id'             => 'google_body_font',
			'type'           => 'typography',
			'color'          => false,
			'font-size'      => false,
			'line-height'    => false,
			'text-transform' => false,
			'letter-spacing' => false,
			'text-align'     => false,
			'all-styles'     => true,
			'google'         => true,
			'required'       => array( 'use_google_fonts', '=', 1 ),
			'title'          => __( 'Body Font', wpgrade::textdomain() ),
			'subtitle'       => __( 'Select a font for content and other general areas.', wpgrade::textdomain() ),
			'compiler'       => true
		),
		// Body Font
		array(
			'id'             => 'google_menu_font',
			'type'           => 'typography',
			'color'          => false,
			'font-size'      => false,
			'line-height'    => false,
			'text-transform' => false,
			'letter-spacing' => false,
			'text-align'     => false,
			'all-styles'     => true,
			'google'         => true,
			'required'       => array( 'use_google_fonts', '=', 1 ),
			'title'          => __( 'Menu Font', wpgrade::textdomain() ),
			'subtitle'       => __( 'Select a font for menu.', wpgrade::textdomain() ),
			'compiler'       => true
		),
		array(
			'id'       => 'header_inverse',
			'type'     => 'switch',
			'title'    => __( 'Inverse Left Sidebar Contrast', wpgrade::textdomain() ),
			'subtitle' => __( 'Change the left sidebar contrast: black text, white background.', wpgrade::textdomain() ),
			'default'  => '0',
		),
	)
);

// Header/Footer Options
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'   => 'icon-note-1',
	'title'  => __( 'Sidebar', wpgrade::textdomain() ),
	'desc'   => '<p class="description">' . __( 'Change sidebar related options from here.', wpgrade::textdomain() ) . '</p>',
	'fields' => array(
		array(
			'id'       => 'do_social_footer_menu',
			'type'     => 'switch',
			'title'    => __( 'Social Footer Menu', wpgrade::textdomain() ),
			'subtitle' => __( 'Show social icons in the footer. The links and order are taken from the Social and SEO Options tabs.', wpgrade::textdomain() ),
			'default'  => '1',
		),
		array(
			'id'       => 'social_footer_menu_title',
			'type'     => 'text',
			'title'    => __( 'Social Footer Menu Title', wpgrade::textdomain() ),
			'default'  => 'We Are Social',
			'required' => array( 'do_social_footer_menu', '=', 1 ),
		),
		array(
			'id'       => 'social_icons',
			'type'     => 'text_sortable',
			'title'    => __( 'Social Links', wpgrade::textdomain() ),
			'subtitle' => sprintf( __( 'Define and reorder your social pages links.<br /><b>Note:</b> These will be displayed in the "%s Social Links" widget so you can put them anywhere on your site. Only those filled will appear.<br /><br /><strong> You need to input the <strong>complete</strong> URL (ie. http://twitter.com/username)</strong>', wpgrade::textdomain() ), wpgrade::themename() ),
			'desc'     => __( 'Icons provided by <strong>FontAwesome</strong> and <strong>Entypo</strong>.', wpgrade::textdomain() ),
			'required' => array( 'do_social_footer_menu', '=', 1 ),
			'options'  => array(
				'flickr'        => __( 'Flickr', wpgrade::textdomain() ),
				'tumblr'        => __( 'Tumblr', wpgrade::textdomain() ),
				'pinterest'     => __( 'Pinterest', wpgrade::textdomain() ),
				'instagram'     => __( 'Instagram', wpgrade::textdomain() ),
				'behance'       => __( 'Behance', wpgrade::textdomain() ),
				'fivehundredpx' => __( '500px', wpgrade::textdomain() ),
				'deviantart'    => __( 'DeviantART', wpgrade::textdomain() ),
				'dribbble'      => __( 'Dribbble', wpgrade::textdomain() ),
				'twitter'       => __( 'Twitter', wpgrade::textdomain() ),
				'facebook'      => __( 'Facebook', wpgrade::textdomain() ),
				'gplus'         => __( 'Google+', wpgrade::textdomain() ),
				'youtube'       => __( 'Youtube', wpgrade::textdomain() ),
				'vimeo'         => __( 'Vimeo', wpgrade::textdomain() ),
				'linkedin'      => __( 'LinkedIn', wpgrade::textdomain() ),
				'tumblr'        => __( 'Tumblr', wpgrade::textdomain() ),
				'skype'         => __( 'Skype', wpgrade::textdomain() ),
				'soundcloud'    => __( 'SoundCloud', wpgrade::textdomain() ),
				'digg'          => __( 'Digg', wpgrade::textdomain() ),
				'lastfm'        => __( 'Last.FM', wpgrade::textdomain() ),
				'rdio'          => __( 'Rdio', wpgrade::textdomain() ),
				'sina-weibo'    => __( 'Sina Weibo', wpgrade::textdomain() ),
				'vkontakte'     => __( 'VKontakte', wpgrade::textdomain() ),
				'appnet'        => __( 'App.net', wpgrade::textdomain() ),
				'rss'           => __( 'RSS Feed', wpgrade::textdomain() ),
			)
		),
		array(
			'id'       => 'social_icons_target_blank',
			'type'     => 'switch',
			'title'    => __( 'Open Social Links In a New Tab?', wpgrade::textdomain() ),
			'subtitle' => __( 'Do you want to open social links in a new tab?', wpgrade::textdomain() ),
			'default'  => '1',
			'required' => array( 'do_social_footer_menu', '=', 1 ),
		),
		array(
			'id'       => 'copyright_text',
			'type'     => 'editor',
			'title'    => __( 'Copyright Text', wpgrade::textdomain() ),
			'subtitle' => sprintf( __( 'Text that will appear in footer left area (eg. Copyright 2013 %s | All Rights Reserved).', wpgrade::textdomain() ), wpgrade::themename() ),
			'default'  => '2014 &copy; Handcrafted with love by <a href="#">PixelGrade</a> Team',
			'rows'     => 3,
		)
	)
);

// Galleries Options
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'       => 'icon-photo',
	'icon_class' => '',
	'title'      => __( 'Galleries Options', wpgrade::textdomain() ),
	'desc'       => sprintf( '<p class="description">' . __( 'General settings for gallery items.', wpgrade::textdomain() ) . '</p>', wpgrade::themename() ),
	'fields'     => array(
		array(
			'title'    => __( 'Galleries Archive Grid Thumbnail Orientation', wpgrade::textdomain() ),
			'subtitle' => __( 'Horizontal thumbnails or vertical thumbnails', wpgrade::textdomain() ),
			'id'       => 'galleries_thumb_orientation',
			'type'     => 'select',
			'options'  => array(
				'landscape' => __( 'Landscape', wpgrade::textdomain() ),
				'portrait'  => __( 'Portrait', wpgrade::textdomain() ),
			),
			'default'  => 'landscape'
		),
		array(
			'id'       => 'galleries_enable_pagination',
			'type'     => 'switch',
			'title'    => __( 'Enable Pagination', wpgrade::textdomain() ),
			'subtitle' => __( 'Enable galleries archive pagination (classic or with infinite scroll).', wpgrade::textdomain() ),
			'default'  => '0',
		),
		array(
			'id'       => 'galleries_per_page',
			'type'     => 'text',
			'title'    => __( 'Galleries Per Page', wpgrade::textdomain() ),
			'subtitle' => __( 'Set the number of galleries to display on each archive page.', wpgrade::textdomain() ),
			'default'  => '9',
			'required' => array( 'galleries_enable_pagination', '=', 1 ),
		),
		array(
			'id'       => 'galleries_infinitescroll',
			'type'     => 'switch',
			'title'    => __( 'Infinite Scroll', wpgrade::textdomain() ),
			'sub_desc' => __( 'Replace the regular pagination with AJAX loading new items on scroll (will load at once the number of galleries specified above).', wpgrade::textdomain() ),
			'default'  => '0',
			'required' => array( 'galleries_enable_pagination', '=', 1 ),
		),
		array(
			'id'       => 'galleries_archive_filtering',
			'type'     => 'switch',
			'title'    => __( 'Enable Galleries Filtering', wpgrade::textdomain() ),
			'subtitle' => __( 'Display a Filter button on Galleries Archive Page', wpgrade::textdomain() ),
			'default'  => '1',
		),
		array(
			'id'       => 'galleries_show_archive_title',
			'type'     => 'switch',
			'title'    => __( 'Show Galleries Archive Title', wpgrade::textdomain() ),
			'subtitle' => __( 'Enable this to display the archive title on the galleries archives (categories, tags, etc).', wpgrade::textdomain() ),
			'default'  => '1',
		),
	)
);

// Portfolio Options
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'       => 'icon-camera-1',
	'icon_class' => '',
	'title'      => __( 'Portfolio Options', wpgrade::textdomain() ),
	'desc'       => sprintf( '<p class="description">' . __( 'General settings for portfolio items.', wpgrade::textdomain() ) . '</p>', wpgrade::themename() ),
	'fields'     => array(
		array(
			'title'    => __( 'Portfolio Grid Thumbnail Orientation', wpgrade::textdomain() ),
			'subtitle' => __( 'Horizontal thumbnails or vertical thumbnails', wpgrade::textdomain() ),
			'id'       => 'portfolio_thumb_orientation',
			'type'     => 'select',
			'options'  => array(
				'landscape' => __( 'Landscape', wpgrade::textdomain() ),
				'portrait'  => __( 'Portrait', wpgrade::textdomain() ),
			),
			'default'  => 'landscape'
		),
		array(
			'id'       => 'portfolio_enable_pagination',
			'type'     => 'switch',
			'title'    => __( 'Enable Pagination', wpgrade::textdomain() ),
			'subtitle' => __( 'Enable portfolio pagination (classic or with infinite scroll).', wpgrade::textdomain() ),
			'default'  => '0',
		),
		array(
			'id'       => 'portfolio_projects_per_page',
			'type'     => 'text',
			'title'    => __( 'Projects Per Page', wpgrade::textdomain() ),
			'subtitle' => __( 'Set the number of projects to display on each archive page.', wpgrade::textdomain() ),
			'default'  => '9',
			'required' => array( 'portfolio_enable_pagination', '=', 1 ),
		),
		array(
			'id'       => 'portfolio_infinitescroll',
			'type'     => 'switch',
			'title'    => __( 'Infinite Scroll', wpgrade::textdomain() ),
			'subtitle' => __( 'Replace the regular pagination with AJAX loading new items on scroll (we will load at once the number of projects set above).', wpgrade::textdomain() ),
			'default'  => '0',
			'required' => array( 'portfolio_enable_pagination', '=', 1 ),
		),
		array(
			'id'       => 'portfolio_projects_filtering',
			'type'     => 'switch',
			'title'    => __( 'Enable Projects Filtering', wpgrade::textdomain() ),
			'subtitle' => __( 'Display a Filter button on the Portfolio Archive Page', wpgrade::textdomain() ),
			'default'  => '1',
		),
		array(
			'id'       => 'portfolio_show_archive_title',
			'type'     => 'switch',
			'title'    => __( 'Show Portfolio Archive Title', wpgrade::textdomain() ),
			'subtitle' => __( 'Enable this to display the archive title on the portfolio archives (categories, tags, etc).', wpgrade::textdomain() ),
			'default'  => '1',
		),
		array(
			'id'   => 'portfolio_single_info_alert',
			'type' => 'info',
			'desc' => __( '<h2>Single Project Options</h2>', wpgrade::textdomain() )
		),
		array(
			'id'       => 'portfolio_single_show_share_links',
			'type'     => 'switch',
			'title'    => __( 'Show Share Links', wpgrade::textdomain() ),
			'subtitle' => __( 'Do you want to show the share links bellow the projects?', wpgrade::textdomain() ),
			'default'  => '1',
		),
		array(
			'id'       => 'portfolio_single_share_links_twitter',
			'type'     => 'switch',
			'title'    => __( 'Twitter Share Link', wpgrade::textdomain() ),
			'default'  => '1',
			'required' => array( 'portfolio_single_show_share_links', '=', 1 ),
		),
		array(
			'id'       => 'portfolio_single_share_links_facebook',
			'type'     => 'switch',
			'title'    => __( 'Facebook Share Link', wpgrade::textdomain() ),
			'subtitle' => '',
			'default'  => '1',
			'required' => array( 'portfolio_single_show_share_links', '=', 1 ),
		),
		array(
			'id'       => 'portfolio_single_share_links_googleplus',
			'type'     => 'switch',
			'title'    => __( 'Google+ Share Link', wpgrade::textdomain() ),
			'subtitle' => '',
			'default'  => '1',
			'required' => array( 'portfolio_single_show_share_links', '=', 1 ),
		),
		array(
			'id'       => 'portfolio_single_share_links_pinterest',
			'type'     => 'switch',
			'title'    => __( 'Pinterest Share Link', wpgrade::textdomain() ),
			'subtitle' => '',
			'default'  => '1',
			'required' => array( 'portfolio_single_show_share_links', '=', 1 ),
		),
	)
);

// Blog Options
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'   => 'icon-pencil-1',
	'title'  => __( 'Blog Options', wpgrade::textdomain() ),
	'desc'   => sprintf( '<p class="description">' . __( 'Change blog archive and single post related options here.', wpgrade::textdomain() ) . '</p>', wpgrade::themename() ),
	'fields' => array(
		array(
			'id'       => 'blog_excerpt_length',
			'type'     => 'text',
			'title'    => __( 'Excerpt Length', wpgrade::textdomain() ),
			'subtitle' => __( 'Set here the excerpt length for the blog archive (number of words).', wpgrade::textdomain() ),
			'default'  => '100',
		),
		array(
			'id'       => 'blog_single_show_share_links',
			'type'     => 'switch',
			'title'    => __( 'Show Share Links', wpgrade::textdomain() ),
			'subtitle' => __( 'Do you want to show the share links bellow the article?', wpgrade::textdomain() ),
			'default'  => '1',
		),
		array(
			'id'       => 'blog_single_share_links_twitter',
			'type'     => 'switch',
			'title'    => __( 'Twitter Share Link', wpgrade::textdomain() ),
			'std'      => '1',
			'required' => array( 'blog_single_show_share_links', '=', 1 ),
		),
		array(
			'id'       => 'blog_single_share_links_facebook',
			'type'     => 'switch',
			'title'    => __( 'Facebook Share Link', wpgrade::textdomain() ),
			'default'  => '1',
			'required' => array( 'blog_single_show_share_links', '=', 1 ),
		),
		array(
			'id'       => 'blog_single_share_links_googleplus',
			'type'     => 'switch',
			'title'    => __( 'Google+ Share Link', wpgrade::textdomain() ),
			'default'  => '1',
			'required' => array( 'blog_single_show_share_links', '=', 1 ),
		),
		array(
			'id'       => 'blog_single_share_links_pinterest',
			'type'     => 'switch',
			'title'    => __( 'Pinterest Share Link', wpgrade::textdomain() ),
			'default'  => '0',
			'required' => array( 'blog_single_show_share_links', '=', 1 ),
		),
	)
);

// Contact Page
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'       => "icon-mail-1",
	'icon_class' => '',
	'title'      => __( 'Contact Page', wpgrade::textdomain() ),
	'desc'       => __( '<p class="description">General settings for the contact page template!</p>', wpgrade::textdomain() ),
	'fields'     => array(
		array(
			'id'       => 'contact_gmap_link',
			'type'     => 'textarea',
			'title'    => __( 'Google Maps Link', wpgrade::textdomain() ),
			'subtitle' => __( 'Paste here the the URL that you\'ve got from Google Maps, after navigating to your location.', wpgrade::textdomain() ),
		),
		array(
			'id'       => 'contact_gmap_custom_style',
			'type'     => 'switch',
			'title'    => __( 'Custom Styling for Map?', wpgrade::textdomain() ),
			'subtitle' => __( 'Allow us to change the map colors to better match your website.', wpgrade::textdomain() ),
			'default'  => '1',
		)
	)
);

$sections[ ] = array(
	'type' => 'divide',
);

// Social and SEO options
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'       => "icon-sound-1",
	'icon_class' => '',
	'title'      => __( 'Social and SEO', wpgrade::textdomain() ),
	'desc'       => sprintf( '<p class="description">' . __( 'Social sharing stuff.', wpgrade::textdomain() ) . '</p>', wpgrade::themename() ),
	'fields'     => array(
		array(
			'id'       => 'prepare_for_social_share',
			'type'     => 'switch',
			'title'    => __( 'Add Social Meta Tags', wpgrade::textdomain() ),
			'subtitle' => __( 'Let us properly prepare your theme for the social sharing and discovery by adding the needed metatags in the <head> section.', wpgrade::textdomain() ),
			'default'  => '1',
		),
		array(
			'id'       => 'facebook_id_app',
			'type'     => 'text',
			'title'    => __( 'Facebook Application ID', wpgrade::textdomain() ),
			'subtitle' => __( 'Enter the Facebook Application ID of the Fan Page which is associated with this website. You can create one <a href="https://developers.facebook.com/apps">here</a>.', wpgrade::textdomain() ),
			'required' => array( 'prepare_for_social_share', '=', 1 ),
		),
		array(
			'id'       => 'facebook_admin_id',
			'type'     => 'text',
			'title'    => __( 'Facebook Admin ID', wpgrade::textdomain() ),
			'subtitle' => __( 'The id of the user that has administrative privileges to your Facebook App so you can access the <a href="https://www.facebook.com/insights/">Facebook Insights</a>.', wpgrade::textdomain() ),
			'required' => array( 'prepare_for_social_share', '=', 1 ),
		),
		array(
			'id'       => 'google_page_url',
			'type'     => 'text',
			'title'    => __( 'Google+ Publisher', wpgrade::textdomain() ),
			'subtitle' => __( 'Enter your Google Plus page ID (example: https://plus.google.com/<b>105345678532237339285</b>) here if you have set up a "Google+ Page".', wpgrade::textdomain() ),
			'required' => array( 'prepare_for_social_share', '=', 1 ),
		),
		array(
			'id'       => 'twitter_card_site',
			'type'     => 'text',
			'title'    => __( 'Twitter Site Username', wpgrade::textdomain() ),
			'subtitle' => __( 'The Twitter username of the entire site. The username for the author will be taken from the author\'s profile (skip the @)', wpgrade::textdomain() ),
			'required' => array( 'prepare_for_social_share', '=', 1 ),
		),
		array(
			'id'       => 'social_share_default_image',
			'type'     => 'media',
			'title'    => __( 'Default Social Share Image', wpgrade::textdomain() ),
			'subtitle' => __( 'If an image is uploaded, this will be used for content sharing if you don\'t upload a custom image with your content (at least 200px wide recommended).', wpgrade::textdomain() ),
		),
		array(
			'id'       => 'use_twitter_widget',
			'type'     => 'switch',
			'title'    => __( 'Use Twitter Widget', wpgrade::textdomain() ),
			'subtitle' => __( 'Just a widget to show your latest tweets (Twitter API v1.1 compatible). You can add it in your blog or footer sidebars.<div class="description">', wpgrade::textdomain() ),
			'default'  => '1',
		),
		array(
			'id'       => 'info_about_twitter_app',
			'type'     => 'info',
			'title'    => __( 'Important Note : ', wpgrade::textdomain() ),
			'desc'     => __( 'In order to use the Twitter widget you will need to create a Twitter application <a href="https://dev.twitter.com/apps/new" >here</a> and get your own key, secrets and access tokens. This is due to the changes that Twitter made to it\'s API (v1.1). Please note that these defaults are used on the ' . wpgrade::themename() . ' demo site but they might be disabled at any time, so we <strong>strongly</strong> recommend you to input your own bellow.git stat', wpgrade::textdomain() ),
			'required' => array( 'use_twitter_widget', '=', 1 ),
		),
		array(
			'id'       => 'twitter_consumer_key',
			'type'     => 'text',
			'title'    => __( 'Consumer Key', wpgrade::textdomain() ),
			'default'  => 'UGciUkPwjDpCRyEqcGsbg',
			'required' => array( 'use_twitter_widget', '=', 1 ),
		),
		array(
			'id'       => 'twitter_consumer_secret',
			'type'     => 'text',
			'title'    => __( 'Consumer Secret', wpgrade::textdomain() ),
			'default'  => 'nuHkqRLxKTEIsTHuOjr1XX5YZYetER6HF7pKxkV11E',
			'required' => array( 'use_twitter_widget', '=', 1 ),
		),
		array(
			'id'       => 'twitter_oauth_access_token',
			'type'     => 'text',
			'title'    => __( 'Oauth Access Token', wpgrade::textdomain() ),
			'default'  => '205813011-oLyghRwqRNHbZShOimlGKfA6BI4hk3KRBWqlDYIX',
			'required' => array( 'use_twitter_widget', '=', 1 ),
		),
		array(
			'id'       => 'twitter_oauth_access_token_secret',
			'type'     => 'text',
			'title'    => __( 'Oauth Access Token Secret', wpgrade::textdomain() ),
			'default'  => '4LqlZjf7jDqmxqXQjc6MyIutHCXPStIa3TvEHX9NEYw',
			'required' => array( 'use_twitter_widget', '=', 1 ),
		),
		array(
			'id'       => 'remove_parameters_from_static_res',
			'type'     => 'switch',
			'title'    => __( 'Remove Parameters From Static Resourses', wpgrade::textdomain() ),
			'subtitle' => 'Let us remove the GET parameters from your static resources (CSS and JS files mainly) so they are more cacheble and you get a higher Page Speed :)',
			'default'  => '1',
		),
	)
);

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	// WooCommerce
	// ------------------------------------------------------------------------
	$sections[ ] = array(
		'icon'       => "icon-shop",
		'icon_class' => '',
		'title'      => __( 'WooCommerce', wpgrade::textdomain() ),
		'desc'       => '<p class="description">' . __( 'WooCommerce options!', wpgrade::textdomain() ) . '</p>',
		'fields'     => array(
			array(
				'id'       => 'enable_woocommerce_support',
				'type'     => 'switch',
				'title'    => __( 'Enable WooCommerce Support', wpgrade::textdomain() ),
				'subtitle' => __( 'Turn this off to avoid loading the WooCommerce assets (CSS and JS).', wpgrade::textdomain() ),
				'default'  => '1',
			),
		)
	);
}


// Custom Code
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'   => "icon-database-1",
	'title'  => __( 'Custom Code', wpgrade::textdomain() ),
	'desc'   => '<p class="description">' . __( 'You can change the site style and behaviour by adding custom scripts to all pages within your site using the custom code areas below.', wpgrade::textdomain() ) . '</p>',
	'fields' => array(
		array(
			'id'       => 'custom_css',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom CSS', wpgrade::textdomain() ),
			'subtitle' => __( 'Use this area to make slight CSS changes. It will be included in the head section of the page.', wpgrade::textdomain() ),
			'desc'     => __( '', wpgrade::textdomain() ),
			'mode'     => 'css',
			'theme'    => 'chrome',
			//'validate' => 'html',
			'compiler' => true
		),
		array(
			'id'       => 'inject_custom_css',
			'type'     => 'select',
			'title'    => __( 'Apply Custom CSS', wpgrade::textdomain() ),
			'subtitle' => sprintf( __( 'Select how to insert the custom CSS into your pages.', wpgrade::textdomain() ), wpgrade::themename() ),
			'default'  => 'inline',
			'options'  => array(
				'inline' => __( 'Inline <em>(recommended)</em>', wpgrade::textdomain() ),
				'file'   => __( 'Write To File (might require file permissions)', wpgrade::textdomain() )
			),
			'select2'  => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'compiler' => true
		),
		array(
			'id'       => 'custom_js',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom JavaScript', wpgrade::textdomain() ),
			'subtitle' => __( 'Use this area to make custom JavaScript calls.This code will be loaded in <strong>head</strong> section.jQuery is available here as $', wpgrade::textdomain() ),
			'mode'     => 'text',
			'theme'    => 'chrome'
		),
		array(
			'id'       => 'google_analytics',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom JavaScript (footer) - Google Analytics', wpgrade::textdomain() ),
			'subtitle' => __( 'This javascript code will be loaded in the <strong>footer</strong>. You can paste here your <strong>Google Analytics tracking code</strong> (or for what matters any tracking code) and we will put it on every page.', wpgrade::textdomain() ),
			'mode'     => 'text',
			'theme'    => 'chrome'
		),
	)
);

// Utilities - Theme Auto Update + Import Demo Data
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'       => "icon-truck",
	'icon_class' => '',
	'title'      => __( 'Utilities', wpgrade::textdomain() ),
	'desc'       => '<p class="description">' . __( 'Utilities help you keep up-to-date with new versions of the theme. Also you can import the demo data from here.', wpgrade::textdomain() ) . '</p>',
	'fields'     => array(
		array(
			'id'   => 'theme-one-click-update-head',
			'desc' => __( '<h3>Theme One-Click Update</h3>
				<p class="description">' . __( 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click. Forget about manual updates!', wpgrade::textdomain() ) . '</p>', wpgrade::textdomain() ),
			'type' => 'info'
		),
		array(
			'id'       => 'themeforest_upgrade',
			'type'     => 'switch',
			'title'    => __( 'One-Click Update', wpgrade::textdomain() ),
			'subtitle' => __( 'Activate this to enter the info needed for the theme\'s one-click update to work.', wpgrade::textdomain() ),
			'default'  => true,
		),
		array(
			'id'       => 'marketplace_username',
			'type'     => 'text',
			'title'    => __( 'ThemeForest Username', wpgrade::textdomain() ),
			'subtitle' => __( 'Enter here your ThemeForest (or Envato) username account (i.e. pixelgrade).', wpgrade::textdomain() ),
			'required' => array( 'themeforest_upgrade', '=', 1 )
		),
		array(
			'id'       => 'marketplace_api_key',
			'type'     => 'text',
			'title'    => __( 'ThemeForest Secret API Key', wpgrade::textdomain() ),
			'subtitle' => __( 'Enter here the secret api key you\'ve created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', wpgrade::textdomain() ),
			'required' => array( 'themeforest_upgrade', '=', 1 )
		),
		array(
			'id'       => 'themeforest_upgrade_backup',
			'type'     => 'switch',
			'title'    => __( 'Backup Theme Before Upgrade?', wpgrade::textdomain() ),
			'subtitle' => __( 'Check this if you want us to automatically save your theme as a ZIP archive before an upgrade. The directory those backups get saved to is <code>wp-content/envato-backups</code>. However, if you\'re experiencing problems while attempting to upgrade, it\'s likely to be a permissions issue and you may want to manually backup your theme before upgrading. Alternatively, if you don\'t want to backup your theme you can disable this.', wpgrade::textdomain() ),
			'default'  => '0',
			'required' => array( 'themeforest_upgrade', '=', 1 )
		),
		array(
			'id'   => 'import-demodata-head',
			'desc' => __( '<h3>Import Demo Data</h3>
				<p class="description">' . __( 'Here you can import the demo data and get on your way of setting up the site like the theme demo (images not included due to copyright).', wpgrade::textdomain() ) . '</p>', wpgrade::textdomain() ),
			'type' => 'info'
		),
		array(
			'id'   => 'wpGrade_import_demodata_button',
			'type' => 'info',
			'desc' => '
					<input type="hidden" name="wpGrade-nonce-import-posts-pages" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_posts_pages' ) . '" />
						<input type="hidden" name="wpGrade-nonce-import-theme-options" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_theme_options' ) . '" />
						<input type="hidden" name="wpGrade-nonce-import-widgets" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_widgets' ) . '" />
						<input type="hidden" name="wpGrade_import_ajax_url" value="' . admin_url( "admin-ajax.php" ) . '" />

						<a href="#" class="button button-primary" id="wpGrade_import_demodata_button">
							' . __( 'Import demo data', wpgrade::textdomain() ) . '
						</a>

						<div class="wpGrade-loading-wrap hidden">
							<span class="wpGrade-loading wpGrade-import-loading"></span>
							<div class="wpGrade-import-wait">
								' . __( 'Please wait a few minutes (between 1 and 3 minutes usually, but depending on your hosting it can take longer) and <strong>don\'t reload the page</strong>. You will be notified as soon as the import has finished!', wpgrade::textdomain() ) . '
							</div>
						</div>

						<div class="wpGrade-import-results hidden"></div>
						<div class="hr"><div class="inner"><span>&nbsp;</span></div></div>
					',
		),
		array(
			'id'       => 'admin_panel_options',
			'type'     => 'switch',
			'title'    => __( 'Admin Panel Options', wpgrade::textdomain() ),
			'subtitle' => __( 'Here you can copy/download your current admin option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).', wpgrade::textdomain() ),
		),
		array(
			'id'       => 'theme_options_import',
			'type'     => 'import_export',
			'required' => array( 'admin_panel_options', '=', 1 )
		)
	)
);

// Help and Support
// ------------------------------------------------------------------------
$sections[ ] = array(
	'icon'       => "icon-cd-1",
	'icon_class' => '',
	'title'      => __( 'Help and Support', wpgrade::textdomain() ),
	'desc'       => '<p class="description">' . __( 'If you had anything less than a great experience with this theme please contact us now. You can also find answers in our community site, or official articles and tutorials in our knowledge base.', wpgrade::textdomain() ) . '</p>
		<ul class="help-and-support">
			<li>
				<a href="http://bit.ly/19G56H1">
					<span class="community-img"></span>
					<h4>Community Answers</h4>
					<span class="description">Get Help from other people that are using this theme.</span>
				</a>
			</li>
			<li>
				<a href="http://bit.ly/19G5cyl">
					<span class="knowledge-img"></span>
					<h4>Knowledge Base</h4>
					<span class="description">Getting started guides and useful articles to better help you with this theme.</span>
				</a>
			</li>
			<li>
				<a href="http://bit.ly/new-ticket">
					<span class="community-img"></span>
					<h4>Submit a Ticket</h4>
					<span class="description">File a ticket for a personal response from our support team.</span>
				</a>
			</li>
		</ul>
	',
	'fields'     => array()
);

return $sections;
