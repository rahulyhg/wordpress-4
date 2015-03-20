<?php


// theme activation
function wpgrade_callback_geting_active() {

	// Lens really needs these settings off
	update_option( 'shop_catalog_image_size', array( 800, null, 0 ) ); // Product category thumbs
	update_option( 'shop_single_image_size', array( 800, null, 0 ) ); // Single product image
	update_option( 'shop_thumbnail_image_size', array( 800, null, 0 ) );

	update_option( 'woocommerce_enable_lightbox', 'no' );

	/**
	 * Create custom post types, taxonomies and metaboxes
	 * These will be taken by pixtypes plugin and converted in their own options
	 */
	$types_options = get_option( 'pixtypes_themes_settings' );
	if ( empty( $types_options ) ) {
		$types_options = array();
	}
	$theme_key                                   = wpgrade::shortname() . '_pixtypes_theme';
	$types_options[ $theme_key ]                 = array();
	$types_options[ $theme_key ][ 'post_types' ] = array(
		'lens_portfolio' => array(
			'labels'        => array(
				'name'               => __( 'Project', wpgrade::textdomain() ),
				'singular_name'      => __( 'Project', wpgrade::textdomain() ),
				'add_new'            => __( 'Add New', wpgrade::textdomain() ),
				'add_new_item'       => __( 'Add New Project', wpgrade::textdomain() ),
				'edit_item'          => __( 'Edit Project', wpgrade::textdomain() ),
				'new_item'           => __( 'New Project', wpgrade::textdomain() ),
				'all_items'          => __( 'All Projects', wpgrade::textdomain() ),
				'view_item'          => __( 'View Project', wpgrade::textdomain() ),
				'search_items'       => __( 'Search Projects', wpgrade::textdomain() ),
				'not_found'          => __( 'No Project found', wpgrade::textdomain() ),
				'not_found_in_trash' => __( 'No Project found in Trash', wpgrade::textdomain() ),
				'menu_name'          => __( 'Projects', wpgrade::textdomain() ),
			),
			'public'        => true,
			'rewrite'       => array(
				'slug'       => 'lens_portfolio',
				'with_front' => false,
			),
			'has_archive'   => 'portfolio-archive',
			'menu_icon'     => 'report.png',
			'menu_position' => null,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt', 'comments' ),
			'yarpp_support' => true,
		),
		'lens_gallery'   => array(
			'labels'        => array(
				'name'               => __( 'Gallery', wpgrade::textdomain() ),
				'singular_name'      => __( 'Gallery', wpgrade::textdomain() ),
				'add_new'            => __( 'Add New', wpgrade::textdomain() ),
				'add_new_item'       => __( 'Add New Gallery', wpgrade::textdomain() ),
				'edit_item'          => __( 'Edit Gallery', wpgrade::textdomain() ),
				'new_item'           => __( 'New Gallery', wpgrade::textdomain() ),
				'all_items'          => __( 'All Galleries', wpgrade::textdomain() ),
				'view_item'          => __( 'View Gallery', wpgrade::textdomain() ),
				'search_items'       => __( 'Search Galleries', wpgrade::textdomain() ),
				'not_found'          => __( 'No Gallery found', wpgrade::textdomain() ),
				'not_found_in_trash' => __( 'No Gallery found in Trash', wpgrade::textdomain() ),
				'menu_name'          => __( 'Galleries', wpgrade::textdomain() ),
			),
			'public'        => true,
			'rewrite'       => array(
				'slug'       => 'lens_galleries',
				'with_front' => false,
			),
			'has_archive'   => 'galleries-archive',
			'menu_icon'     => 'slider.png',
			'menu_position' => null,
			'supports'      => array( 'title', 'thumbnail', 'page-attributes', 'excerpt' ),
			'yarpp_support' => true,
		),
	);
	$types_options[ $theme_key ][ 'taxonomies' ] = array(
		'lens_portfolio_categories' => array(
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => __( 'Portfolio Categories', wpgrade::textdomain() ),
				'singular_name'     => __( 'Portfolio Category', wpgrade::textdomain() ),
				'search_items'      => __( 'Search Portfolio Category', wpgrade::textdomain() ),
				'all_items'         => __( 'All Portfolio Categories', wpgrade::textdomain() ),
				'parent_item'       => __( 'Parent Portfolio Category', wpgrade::textdomain() ),
				'parent_item_colon' => __( 'Parent Portfolio Category: ', wpgrade::textdomain() ),
				'edit_item'         => __( 'Edit Portfolio Category', wpgrade::textdomain() ),
				'update_item'       => __( 'Update Portfolio Category', wpgrade::textdomain() ),
				'add_new_item'      => __( 'Add New Portfolio Category', wpgrade::textdomain() ),
				'new_item_name'     => __( 'New Portfolio Category Name', wpgrade::textdomain() ),
				'menu_name'         => __( 'Portfolio Categories', wpgrade::textdomain() ),
			),
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'portfolio-category', 'with_front' => false ),
			'sort'              => true,
			'post_types'        => array( 'lens_portfolio' )
		),
		'lens_gallery_categories'   => array(
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => __( 'Gallery Categories', wpgrade::textdomain() ),
				'singular_name'     => __( 'Gallery Category', wpgrade::textdomain() ),
				'search_items'      => __( 'Search Gallery Category', wpgrade::textdomain() ),
				'all_items'         => __( 'All Gallery Categories', wpgrade::textdomain() ),
				'parent_item'       => __( 'Parent Gallery Category', wpgrade::textdomain() ),
				'parent_item_colon' => __( 'Parent Gallery Category: ', wpgrade::textdomain() ),
				'edit_item'         => __( 'Edit Gallery Category', wpgrade::textdomain() ),
				'update_item'       => __( 'Update Gallery Category', wpgrade::textdomain() ),
				'add_new_item'      => __( 'Add New Gallery Category', wpgrade::textdomain() ),
				'new_item_name'     => __( 'New Gallery Category Name', wpgrade::textdomain() ),
				'menu_name'         => __( 'Gallery Categories', wpgrade::textdomain() ),
			),
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'gallery-category', 'with_front' => false ),
			'sort'              => true,
			'post_types'        => array( 'lens_gallery' )
		),
	);
	$types_options[ $theme_key ][ 'metaboxes' ]  = array(
		'post_video_format'       => array(
			'id'         => 'post_format_metabox_video',
			'title'      => __( 'Video Settings', wpgrade::textdomain() ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Embed Code', wpgrade::textdomain() ),
					'desc' => __( 'Enter here a Youtube, Vimeo (or other online video services) embed code here. The width should be a minimum of 640px. We will use this if filled, not the selfhosted options bellow!', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'video_embed',
					'type' => 'textarea_small',
					'std'  => '',
				),
			)
		),
		'post_gallery_format'     => array(
			'id'         => 'post_format_metabox_gallery',
			'title'      => __( 'Gallery Settings', wpgrade::textdomain() ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Images', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'main_gallery',
					'type' => 'gallery',
				),
				array(
					'name'    => __( 'Image Scaling', wpgrade::textdomain() ),
					'desc'    => __( '<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
<p class="cmb_metabox_description"><strong>Fit if Smaller</strong> scales image to fit only if size of slider container is less than size of image.</p>
<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'post_image_scale_mode',
					'type'    => 'select',
					'show_on' => array(
						'key'   => 'select_value',
						'value' => array(
							'project_template' => 'fullwidth',
							'project_template' => 'sidebar'
						),
					),
					'options' => array(
						array(
							'name'  => __( 'Fit', wpgrade::textdomain() ),
							'value' => 'fit'
						),
						array(
							'name'  => __( 'Fill', wpgrade::textdomain() ),
							'value' => 'fill'
						),
						array(
							'name'  => __( 'Fit if Smaller', wpgrade::textdomain() ),
							'value' => 'fit-if-smaller'
						)
					),
					'std'     => 'fill'
				),
				array(
					'name'    => __( 'Show Nearby Images', wpgrade::textdomain() ),
					'desc'    => __( 'Enable this if you want to avoid having empty space on the sides of the image when using mostly portrait images.', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'post_slider_visiblenearby',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', wpgrade::textdomain() ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', wpgrade::textdomain() ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name'    => __( 'Slider transition', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'post_slider_transition',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Slide/Move', wpgrade::textdomain() ),
							'value' => 'move'
						),
						array(
							'name'  => __( 'Fade', wpgrade::textdomain() ),
							'value' => 'fade'
						)
					),
					'std'     => 'move'
				),
				array(
					'name'    => __( 'Slider autoplay', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'post_slider_autoplay',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', wpgrade::textdomain() ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', wpgrade::textdomain() ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name' => __( 'Autoplay delay between slides (in milliseconds)', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'post_slider_delay',
					'type' => 'text_small',
					'std'  => '1000'
				)
			)
		),
		'post_quote_format'       => array(
			'id'         => 'post_format_metabox_quote',
			'title'      => __( 'Quote Settings', wpgrade::textdomain() ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name'    => __( 'Quote Content', wpgrade::textdomain() ),
					'desc'    => __( 'Please type the text of your quote here.', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'quote',
					'type'    => 'wysiwyg',
					'std'     => '',
					'options' => array(
						'textarea_rows' => 4,
					),
				),
				array(
					'name' => __( 'Author Name', wpgrade::textdomain() ),
					'desc' => '',
					'id'   => wpgrade::prefix() . 'quote_author',
					'type' => 'text',
					'std'  => '',
				),
				array(
					'name' => __( 'Author Title', wpgrade::textdomain() ),
					'desc' => '',
					'id'   => wpgrade::prefix() . 'quote_author_title',
					'type' => 'text',
					'std'  => '',
				),
				array(
					'name' => __( 'Author Link', wpgrade::textdomain() ),
					'desc' => __( 'Insert here an url if you want the author name to be linked to that address.', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'quote_author_link',
					'type' => 'text',
					'std'  => '',
				),
			)
		),
		'post_audio_format'       => array(
			'id'         => 'post_format_metabox_audio',
			'title'      => __( 'Audio Settings', wpgrade::textdomain() ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Embed Code', wpgrade::textdomain() ),
					'desc' => __( 'Enter here a embed code here. The width should be a minimum of 640px.', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'audio_embed',
					'type' => 'textarea_small',
					'std'  => '',
				),
				array(
					'name' => __( 'MP3 File URL', wpgrade::textdomain() ),
					'desc' => __( 'Please enter in the URL to the .mp3 file', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'audio_mp3',
					'type' => 'file',
					'std'  => ''
				),
				array(
					'name' => __( 'M4A File URL', wpgrade::textdomain() ),
					'desc' => __( 'Please enter in the URL to the .m4a file', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'audio_m4a',
					'type' => 'file',
					'std'  => ''
				),
				array(
					'name' => __( 'OGA File URL', wpgrade::textdomain() ),
					'desc' => __( 'Please enter in the URL to the .ogg or .oga file', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'audio_ogg',
					'type' => 'file',
					'std'  => ''
				),
				array(
					'name' => __( 'Poster Image', wpgrade::textdomain() ),
					'desc' => __( 'This will be the image displayed above the audio controls. The image should be at least 640px wide. Click the "Upload" button to open the Media Manager, and click "Use as Poster Image" once you have uploaded or chosen an image from the media library.', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'audio_poster',
					'type' => 'file',
					'std'  => ''
				),
			)
		),
		'lens_portfolio_gallery'  => array(
			'id'         => 'portfolio_gallery',
			'title'      => __( 'Gallery', wpgrade::textdomain() ),
			'pages'      => array( 'lens_portfolio' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name'   => __( 'Images', wpgrade::textdomain() ),
					'id'     => wpgrade::prefix() . 'portfolio_gallery',
					'type'   => 'gallery',
					'hidden' => true,
				),
			)
		),
		//		'lens_portfolio_video' => array(
		//			'id' => 'portfolio_video',
		//			'title' => __('Video Settings (optional)', wpgrade::textdomain()),
		//			'pages'      => array( 'lens_portfolio' ), // Post type
		//			'context'    => 'normal',
		//			'priority'   => 'high',
		//			'show_names' => true, // Show field names on the left
		//			'fields' => array(
		//				array(
		//					'name' => __('Video Image', wpgrade::textdomain()),
		//					'desc' => __('Choose an image for your video.', wpgrade::textdomain()),
		//					'id' => wpgrade::prefix() . 'portfolio_video_image',
		//					'type' => 'attachment',
		//					'std' => '',
		//				),
		//				array(
		//					'name' => __('YouTube Embed Code', wpgrade::textdomain()),
		//					'desc' => __('Enter here a YouTube embed code. This video will be shown as one of the gallery items (first by default).', wpgrade::textdomain()),
		//					'id' => wpgrade::prefix() . 'portfolio_video_youtube',
		//					'type' => 'textarea_small',
		//					'std' => '',
		//				),
		//				array(
		//					'name' => __('Vimeo Embed Code', wpgrade::textdomain()),
		//					'desc' => __('Enter here a Vimeo embed code. This video will be shown as one of the gallery items (first by default).<br /><i>If you have entered a YouTube video link, this will be ignored!</i>', wpgrade::textdomain()),
		//					'id' => wpgrade::prefix() . 'portfolio_video_vimeo',
		//					'type' => 'textarea_small',
		//					'std' => '',
		//				),
		//			)
		//		),
		'lens_portfolio_metadata' => array(
			'id'         => 'portfolio_metadata',
			'title'      => __( 'Project Details', wpgrade::textdomain() ),
			'pages'      => array( 'lens_portfolio' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Client Name', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'portfolio_client_name',
					'type' => 'text_medium',
				),
				array(
					'name' => __( 'Client Link', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'portfolio_client_link',
					'type' => 'text_medium',
				),
				array(
					'name'    => __( 'Template Style', wpgrade::textdomain() ),
					'desc'    => __( 'Select the template you want for this project.', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'project_template',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Full Width Slider', wpgrade::textdomain() ),
							'value' => 'fullwidth'
						),
						array(
							'name'  => __( 'Sidebar Right', wpgrade::textdomain() ),
							'value' => 'sidebar'
						),
						array(
							'name'  => __( 'Classic', wpgrade::textdomain() ),
							'value' => 'classic'
						),
					),
					'std'     => 'fullwidth',
				),
				array(
					'name'    => __( 'Image Scaling', wpgrade::textdomain() ),
					'desc'    => __( '<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
<p class="cmb_metabox_description"><strong>Fit if Smaller</strong> scales image to fit only if size of slider container is less than size of image.</p>
<p class="cmb_metabox_description"><strong>Auto Height</strong> scales the container to fit the full size image.</p>
<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'portfolio_image_scale_mode',
					'type'    => 'select',
					'show_on' => array(
						'key'   => 'select_value',
						'value' => array(
							'project_template' => 'fullwidth',
							'project_template' => 'sidebar'
						),
					),
					'options' => array(
						array(
							'name'  => __( 'Fit', wpgrade::textdomain() ),
							'value' => 'fit'
						),
						array(
							'name'  => __( 'Fill', wpgrade::textdomain() ),
							'value' => 'fill'
						),
						array(
							'name'  => __( 'Fit if Smaller', wpgrade::textdomain() ),
							'value' => 'fit-if-smaller'
						),
						array(
							'name'  => __( 'Auto Height', wpgrade::textdomain() ),
							'value' => 'auto'
						),
					),
					'std'     => 'fill'
				),
				array(
					'name'    => __( 'Show Nearby Images', wpgrade::textdomain() ),
					'desc'    => __( 'Enable this if you want to avoid having empty space on the sides of the image when using mostly portrait images.', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'post_slider_visiblenearby',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', wpgrade::textdomain() ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', wpgrade::textdomain() ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name'    => __( 'Slider transition', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'portfolio_slider_transition',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Slide/Move', wpgrade::textdomain() ),
							'value' => 'move'
						),
						array(
							'name'  => __( 'Fade', wpgrade::textdomain() ),
							'value' => 'fade'
						)
					),
					'std'     => 'move'
				),
				array(
					'name'    => __( 'Slider autoplay', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'portfolio_slider_autoplay',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', wpgrade::textdomain() ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', wpgrade::textdomain() ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name' => __( 'Autoplay delay between slides (in milliseconds)', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'portfolio_slider_delay',
					'type' => 'text_small',
					'std'  => '1000'
				),
				array(
					'name'    => __( 'Exclude From Archives', wpgrade::textdomain() ),
					'desc'    => __( 'Exclude this project from portfolio archives.', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'exclude_project',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'No', wpgrade::textdomain() ),
							'value' => false
						),
						array(
							'name'  => __( 'Yes', wpgrade::textdomain() ),
							'value' => true
						)
					),
					'std'     => false
				),
			)
		),
		'lens_gallery'            => array(
			'id'         => 'lens_gallery',
			'title'      => __( 'Gallery Detail', wpgrade::textdomain() ),
			'pages'      => array( 'lens_gallery' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Images', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'main_gallery',
					'type' => 'gallery',
				),
				array(
					'name'    => __( 'Template Style', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'gallery_template',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Grid Thumbnails', wpgrade::textdomain() ),
							'value' => 'masonry'
						),
						array(
							'name'  => __( 'Masonry Thumbnails', wpgrade::textdomain() ),
							'value' => 'masonry-plus'
						),
						array(
							'name'  => __( 'Full Width Slider', wpgrade::textdomain() ),
							'value' => 'fullwidth'
						),
						array(
							'name'  => __( 'Full Screen Slider', wpgrade::textdomain() ),
							'value' => 'fullscreen'
						)
					),
					'std'     => 'fullwidth',
				),
				array(
					'name'    => __( 'Image Scaling', wpgrade::textdomain() ),
					'desc'    => __( '<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
<p class="cmb_metabox_description"><strong>Fit if Smaller</strong> scales image to fit only if size of slider container is less than size of image.</p>
<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'gallery_image_scale_mode',
					'type'    => 'select',
					'show_on' => array(
						'key'   => 'select_value',
						'value' => array(
							'gallery_template' => 'fullwidth',
							'gallery_template' => 'sidebar'
						)
					),
					'options' => array(
						array(
							'name'  => __( 'Fit', wpgrade::textdomain() ),
							'value' => 'fit'
						),
						array(
							'name'  => __( 'Fill', wpgrade::textdomain() ),
							'value' => 'fill'
						),
						array(
							'name'  => __( 'Fit if Smaller', wpgrade::textdomain() ),
							'value' => 'fit-if-smaller'
						),
					),
					'std'     => 'fill'
				),
				array(
					'name'    => __( 'Show Nearby Images', wpgrade::textdomain() ),
					'desc'    => __( 'Enable this if you want to avoid having empty space on the sides of the image when using mostly portrait images.', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'post_slider_visiblenearby',
					'show_on' => array(
						'key'   => 'select_value',
						'value' => array(
							'gallery_template' => 'fullwidth',
							'gallery_template' => 'fullscreen'
						)
					),
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', wpgrade::textdomain() ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', wpgrade::textdomain() ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name'    => __( 'Slider transition', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'gallery_slider_transition',
					'show_on' => array( 'key' => 'select_value', 'value' => array( 'gallery_template' => 'grid' ) ),
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Slide/Move', wpgrade::textdomain() ),
							'value' => 'move'
						),
						array(
							'name'  => __( 'Fade', wpgrade::textdomain() ),
							'value' => 'fade'
						)
					),
					'std'     => 'move'
				),
				array(
					'name'    => __( 'Slider autoplay', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'gallery_slider_autoplay',
					'show_on' => array(
						'key'   => 'select_value',
						'value' => array(
							'gallery_template' => 'fullwidth',
							'gallery_template' => 'fullscreen'
						),
					),
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', wpgrade::textdomain() ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', wpgrade::textdomain() ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name'    => __( 'Autoplay delay between slides (in milliseconds)', wpgrade::textdomain() ),
					'show_on' => array(
						'key'   => 'select_value',
						'value' => array(
							'gallery_template' => 'fullwidth',
							'gallery_template' => 'fullscreen'
						),
					),
					'id'      => wpgrade::prefix() . 'gallery_slider_delay',
					'type'    => 'text_small',
					'std'     => '1000'
				),
				array(
					'name'    => __( 'Grid Thumbnails Orientation', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'thumb_orientation',
					'show_on' => array(
						'key'   => 'select_value',
						'value' => array(
							'gallery_template' => 'fullwidth',
							'gallery_template' => 'fullscreen'
						),
					),
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Landscape', wpgrade::textdomain() ),
							'value' => 'landscape'
						),
						array(
							'name'  => __( 'Portrait', wpgrade::textdomain() ),
							'value' => 'portrait'
						)
					),
					'std'     => 'landscape'
				),
				array(
					'name'    => __( 'Gallery Title Box', wpgrade::textdomain() ),
					'desc'    => __( 'Show the title of the gallery in a thumbnail box or not.', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'show_gallery_title',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Show', wpgrade::textdomain() ),
							'value' => true
						),
						array(
							'name'  => __( 'Hide', wpgrade::textdomain() ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name'    => __( 'Exclude From Archives', wpgrade::textdomain() ),
					'desc'    => __( 'Exclude this gallery from galleries archives.', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'exclude_gallery',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'No', wpgrade::textdomain() ),
							'value' => false
						),
						array(
							'name'  => __( 'Yes', wpgrade::textdomain() ),
							'value' => true
						)
					),
					'std'     => false
				),
			)
		),
		'lens_homepage_chooser'   => array(
			'id'         => 'lens_homepage_chooser',
			'title'      => __( 'Choose Your Home Page', wpgrade::textdomain() ),
			'pages'      => array( 'page' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_on'    => array( 'key' => 'page-template', 'value' => array( 'template-homepage.php' ), ),
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name'    => __( 'Choose:', wpgrade::textdomain() ),
					'desc'    => __( 'Select what would you like to be your home page. If you want to have a static page as your homepage simply go the WP classic way and set it up in Settings > Reading (instead of this one).', wpgrade::textdomain() ),
					'id'      => wpgrade::prefix() . 'custom_homepage',
					'type'    => 'radio',
					'options' => array(
						array(
							'name'  => __( 'Portfolio Archive', wpgrade::textdomain() ),
							'value' => wpgrade::shortname() . '_portfolio',
						),
						array(
							'name'  => __( 'Portfolio Category', wpgrade::textdomain() ),
							'value' => wpgrade::shortname() . '_portfolio_cat',
						),
						array(
							'name'  => __( 'Project', wpgrade::textdomain() ),
							'value' => wpgrade::shortname() . '_project',
						),
						array(
							'name'  => __( 'Galleries Archive', wpgrade::textdomain() ),
							'value' => wpgrade::shortname() . '_galleries_archive',
						),
						array(
							'name'  => __( 'Galleries Category', wpgrade::textdomain() ),
							'value' => wpgrade::shortname() . '_galleries_cat',
						),
						array(
							'name'  => __( 'Gallery', wpgrade::textdomain() ),
							'value' => wpgrade::shortname() . '_gallery',
						),
					),
					'std'     => 'lens_portfolio',
				),
				array(
					'name'       => __( 'Select a portfolio category', wpgrade::textdomain() ),
					'desc'       => __( 'Select a portfolio category and we will show it on your homepage.', wpgrade::textdomain() ),
					'id'         => wpgrade::prefix() . 'homepage_portfolio_category',
					'type'       => 'select_cpt_term',
					'taxonomy'   => 'lens_portfolio_categories',
					'options'    => array(//						'hidden' => true,
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'custom_homepage',
							'value' => wpgrade::shortname() . '_portfolio_cat'
						)
					),
				),
				array(
					'name'       => __( 'Select a project', wpgrade::textdomain() ),
					'desc'       => __( 'Select a project and we will show it on your homepage.', wpgrade::textdomain() ),
					'id'         => wpgrade::prefix() . 'homepage_project',
					'type'       => 'select_cpt_post',
					'options'    => array(
						'args' => array(
							'post_type' => wpgrade::shortname() . '_portfolio',
						),
						//'hidden' => true,
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'custom_homepage',
							'value' => wpgrade::shortname() . '_project'
						)
					),
				),
				array(
					'name'       => __( 'Select a galleries category', wpgrade::textdomain() ),
					'desc'       => __( 'Select a galleries category and we will show it on your homepage.', wpgrade::textdomain() ),
					'id'         => wpgrade::prefix() . 'homepage_galleries_category',
					'type'       => 'select_cpt_term',
					'taxonomy'   => 'lens_gallery_categories',
					'options'    => array(//						'hidden' => true,
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'custom_homepage',
							'value' => wpgrade::shortname() . '_galleries_cat'
						)
					),
				),
				array(
					'name'       => __( 'Select a gallery', wpgrade::textdomain() ),
					'desc'       => __( 'Select a gallery and we will show it on your homepage.', wpgrade::textdomain() ),
					'id'         => wpgrade::prefix() . 'homepage_gallery',
					'type'       => 'select_cpt_post',
					'options'    => array(
						'args' => array(
							'post_type' => 'lens_gallery',
						),
						//						'hidden' => true,
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'custom_homepage',
							'value' => wpgrade::shortname() . '_gallery'
						)
					),
				),
				array(
					'name' => __( 'Number of items', wpgrade::textdomain() ),
					'desc' => __( 'Select a number of items (projects or galleries) to show on your homepage. For unlimited items keep it empty', wpgrade::textdomain() ),
					'id'   => wpgrade::prefix() . 'homepage_projects_number',
					'type' => 'text_small',
				)
			)
		),
	);

	update_option( 'pixtypes_themes_settings', $types_options );

	// prepare yarpp
	$current_yarpp = get_option( 'yarpp' );

	if ( empty( $current_yarpp ) ) {

		$plugins_url   = plugins_url();
		$yarp_settings = array(
			'threshold'                 => '4',
			'limit'                     => '6',
			'excerpt_length'            => '10',
			'recent'                    => false,
			'before_title'              => '<li>',
			'after_title'               => '</li>',
			'before_post'               => ' <small>',
			'after_post'                => '</small>',
			'before_related'            => '<h3>Related posts:</h3><ol>',
			'after_related'             => '</ol>',
			'no_results'                => '<p>No related posts.</p>',
			'order'                     => 'score DESC',
			'rss_limit'                 => '3',
			'rss_excerpt_length'        => '10',
			'rss_before_title'          => '<li>',
			'rss_after_title'           => '</li>',
			'rss_before_post'           => ' <small>',
			'rss_after_post'            => '</small>',
			'rss_before_related'        => '<h3>Related posts:</h3><ol>',
			'rss_after_related'         => '</ol>',
			'rss_no_results'            => '<p>No related posts.</p>',
			'rss_order'                 => 'score DESC',
			'past_only'                 => false,
			'show_excerpt'              => false,
			'rss_show_excerpt'          => false,
			'template'                  => 'yarpp-template-portfolio.php',
			'rss_template'              => false,
			'show_pass_post'            => false,
			'cross_relate'              => false,
			'rss_display'               => false,
			'rss_excerpt_display'       => true,
			'promote_yarpp'             => false,
			'rss_promote_yarpp'         => false,
			'myisam_override'           => false,
			'exclude'                   => '',
			'weight'                    => array(
				'title' => 1,
				'body'  => 1,
				'tax'   => array(
					'category' => 1,
					'post_tag' => 1,
				),
			),
			'require_tax'               => array(),
			'optin'                     => true,
			'thumbnails_heading'        => 'Related posts:',
			'thumbnails_default'        => $plugins_url . '/yet-another-related-posts-plugin/default.png',
			'rss_thumbnails_heading'    => 'Related posts:',
			'rss_thumbnails_default'    => $plugins_url . '/yet-another-related-posts-plugin/default.png',
			'display_code'              => false,
			'auto_display_archive'      => false,
			'auto_display_post_types'   => array(),
			'pools'                     => array(),
			'manually_using_thumbnails' => false,
		);

		update_option( 'yarpp', $yarp_settings );
	}
	// flush permalinks rules on theme activation
	//		flush_rewrite_rules();
	//		global $wp_rewrite;
	//		$wp_rewrite->generate_rewrite_rules();
	//		flush_rewrite_rules();

	/**
	 * http://wordpress.stackexchange.com/questions/36152/flush-rewrite-rules-not-working-on-plugin-deactivation-invalid-urls-not-showing
	 * nothing from above works in plugin so ...
	 */
	delete_option( 'rewrite_rules' );
}

add_action( 'after_switch_theme', 'wpgrade_callback_geting_active' );

/**
 * Updates between versions
 * Here we define functions which should be called between different versions updates
 * Simple rules:
 * == Define a function for each version update and comment what it should do
 * == To avoid conflicts between way to different versions we define a priority  for each function so they can be called in order
 * == The priority step should be 10

 */

/**
 * Convert Redux from redux2 to redux3
 */
add_action( 'after_switch_theme', 'convert_options_to_redux3', 10 );
function convert_options_to_redux3() {

	$did_conversion = get_option( wpgrade::get_shortname() . '_did_redux3_conversion' );

	if ( isset ( $did_conversion ) && $did_conversion == true ) {
		return;
	}

	// get some fonts
	global $wp_filesystem;
	$fonts_array = '';
	// Initialize the Wordpress filesystem, no more using file_put_contents function
	if ( empty( $wp_filesystem ) ) {
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
		$fonts_array = json_decode( $wp_filesystem->get_contents( wpgrade::corepath() . 'vendor/redux3/inc/fields/typography/googlefonts.json' ), true );
	}

	$sections = wpgrade::get_redux_sections();

	if ( ! is_array( $sections ) ) {
		return;
	}

	foreach ( $sections as $section_key => $section ) {

		if ( empty( $section[ 'fields' ] ) ) {
			continue;
		}

		foreach ( $section[ 'fields' ] as $field_key => $field ) {

			// if is a media field convert the value from a simple url to an array with metadata
			if ( $field[ 'type' ] === 'media' ) {
				$current_value = wpgrade::option( $field[ 'id' ] );

				if ( is_string( $current_value ) ) {

					$id = lens::get_attachment_id_from_src( $current_value );

					if ( ! empty( $id ) ) {

						$metadata         = wp_get_attachment_metadata( $id );
						$new_val          = array();
						$new_val[ 'url' ] = $current_value;
						$new_val[ 'id' ]  = $id;

						if ( isset( $metadata[ 'height' ] ) ) {
							$new_val[ 'height' ] = $metadata[ 'height' ];
						}

						if ( isset( $metadata[ 'width' ] ) ) {
							$new_val[ 'width' ] = $metadata[ 'width' ];
						}

						wpgrade::options()->set( $field[ 'id' ], $new_val );
					}
				}
			}

			if ( $field[ 'type' ] == 'typography' ) {

				$current_value = wpgrade::option( $field[ 'id' ] );

				if ( ! empty( $current_value ) && is_string( $current_value ) ) {

					$old_values      = explode( ':', $current_value );
					$old_values[ 0 ] = str_replace( '+', ' ', $old_values[ 0 ] );
					$new_val         = array();

					if ( isset( $old_values[ 0 ] ) ) {
						$new_val                  = array(
							'google'       => 'true',
							'font-style'   => '',
							'font-options' => '',
							'font-weight'  => '',
							'subsets'      => ''
						);
						$new_val[ 'font-family' ] = $old_values[ 0 ];
						if ( isset( $fonts_array[ $old_values[ 0 ] ] ) ) {
							$new_val[ 'font-options' ] = $fonts_array[ $old_values[ 0 ] ];
						}
					}

					if ( isset( $old_values[ 1 ] ) ) {
						if ( strpos( $old_values[ 1 ], "italic" ) || $old_values[ 1 ] == "italic" ) {
							$new_val[ 'font-style' ] = 'italic';
							$old_values[ 1 ]         = str_replace( "italic", '', $old_values[ 1 ] );
						}
						if ( strpos( $old_values[ 1 ], "regular" ) || $old_values[ 1 ] == "regular" ) {
							$new_val[ 'font-weight' ] = '400';
							$old_values[ 1 ]          = str_replace( "regular", '', $old_values[ 1 ] );
						} else {
							$new_val[ 'font-weight' ] = $old_values[ 1 ];
						}
					}

					wpgrade::options()->set( $field[ 'id' ], $new_val );
				}

			}

			if ( $field[ 'type' ] == 'text_sortable' ) {
				$current_value = wpgrade::option( $field[ 'id' ] );
				if ( ! empty( $current_value ) && is_array( $current_value ) ) {
					$new_icons = array();
					foreach ( $current_value as $icon => $value ) {
						if ( is_string( $value ) ) {
							$new_icons[ $icon ] = array( 'value' => $value );
						} elseif ( is_array( $value ) ) {
							//we already have the new format and for some strange reason we are running this again
							//do nothing
							$new_icons[ $icon ] = $value;
						}
					}
					wpgrade::options()->set( $field[ 'id' ], $new_icons );
				}
			}
		}
	}

	// this convertion needs to be done only once
	// we need to keep this separate from the redux options because these will be overwritten on each theme options save
	update_option( wpgrade::get_shortname() . '_did_redux3_conversion', true );

}