<?php
//determine what page we are on, if any
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

if ( wpgrade::option('galleries_enable_pagination') && wpgrade::option('galleries_per_page') ) {
	$projects_number = wpgrade::option('galleries_per_page');
} else {
	$projects_number = -1;
}

if ( is_front_page() ) {
	$projects_number_meta = get_post_meta(lens::lang_page_id(get_the_ID()), wpgrade::prefix() . 'homepage_projects_number', true);
	if ( !empty( $projects_number_meta ) && is_numeric($projects_number_meta) ) {
		$projects_number = $projects_number_meta;
	} else {
		$projects_number = -1;
	}
}

$args = array(
	'post_type' => 'lens_gallery',
	'orderby' => 'menu_order date',
	'order' => 'DESC',
	'paged' => $paged,
	'posts_per_page' => $projects_number,
	'meta_query' => array(
		'relation' => 'OR',
		array(
			'key' => wpgrade::prefix() . 'exclude_gallery',
			'value' => true,
			'compare' => '!='
		),
		array(
			'key' => wpgrade::prefix() . 'exclude_gallery',
			'compare' => 'NOT EXISTS',
			'value' => ''
		),
	),
);

$query = new WP_Query( $args );

//infinite scrolling
$mosaic_classes = '';
$classes = '';
if (wpgrade::option('galleries_infinitescroll')) {
	$mosaic_classes .= ' infinite_scroll';
	$classes .=' inf_scroll';

//	if (wpgrade::option('galleries_infinitescroll_show_button')) {
//		$mosaic_classes .= ' infinite_scroll_with_button';
//	}
}

?>
<div id="main" class="content djax-updatable <?php echo $classes; ?>">
	<?php
    if(wpgrade::option('galleries_archive_filtering') == 1) {
        lens::display_filter_box( 'lens_gallery_categories' );
    } ?>
	<div class="mosaic <?php echo $mosaic_classes ?>" data-maxpages="<?php echo $query->max_num_pages ?>">
		<?php
		$thumb_orientation = '';
        if(wpgrade::option('galleries_thumb_orientation') == 'portrait') {
            $thumb_orientation = ' mosaic__item--portrait ';
        }

		// let's grab the page title first
		$title = get_the_title();

		$has_post_thumbnail = has_post_thumbnail();
		if ($has_post_thumbnail) {
			if($thumb_orientation)
				$post_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-big-v', true);
			else
				$post_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-big', true);
			$post_featured_image = $post_featured_image[0];
		} ?>
		<?php if (wpgrade::option('galleries_show_archive_title') && $paged == 1): ?>
		<div class="mosaic__item  mosaic__item--page-title-mobile <?php echo $thumb_orientation; echo $has_post_thumbnail ? "" : " js--is-loaded "; echo lens::get_terms_as_string('lens_gallery_categories', 'slug'); ?> ">
			<div class="image__item-link">
				<div class="image__item-wrapper">
					<?php if ($has_post_thumbnail) : ?>
						<img
							class="js-lazy-load"
							src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
							data-src="<?php echo $post_featured_image; ?>"
							alt=""
							/>
					<?php endif; ?>
				</div>
				<div class="image__item-meta">
					<div class="image_item-table">
						<div class="image_item-cell">
							<h1><?php echo $title; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $query->have_posts() ) :

			$idx = 0;
			while ( $query->have_posts() ) : $query->the_post();
				$idx++;
				$gallery_ids = array();
				$gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'main_gallery', true );
				if (!empty($gallery_ids)) {
					$gallery_ids = explode(',',$gallery_ids);
				}

				$attachments = get_posts( array(
					'post_type' => 'attachment',
					'posts_per_page' => -1,
					'orderby' => "post__in",
					'post__in' => $gallery_ids
				) );

				$featured_image = "";
				if (has_post_thumbnail()) {
					if($thumb_orientation)
						$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-big-v');
					else
						$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-big');
					$featured_image = $featured_image[0];
				} else {
					if ($gallery_ids != "") {
						$attachments = get_posts( array(
							'post_type' => 'attachment',
							'posts_per_page' => -1,
							'orderby' => "post__in",
							'post__in' => $gallery_ids
						) );
					} else {
						$attachments = get_posts( array(
							'post_type' => 'attachment',
							'posts_per_page' => -1,
							'post_status' =>'any',
							'post_parent' => $post->ID
						) );
					}

					if ( $attachments ) {
						foreach ( $attachments as $attachment ) {
							if($thumb_orientation)
								$featured_image = wp_get_attachment_image_src($attachment->ID, 'portfolio-big-v');
							else
								$featured_image = wp_get_attachment_image_src($attachment->ID, 'portfolio-big');
							$featured_image = $featured_image[0];
							break;
						}
					}
				}

				$categories = get_the_terms($post->ID, 'lens_gallery_categories'); ?>
				<div class="mosaic__item <?php  echo $thumb_orientation . ' '; if($categories) foreach($categories as $cat) { echo strtolower($cat->slug) . ' '; } ?> ">
					<a href="<?php the_permalink(); ?>" class="image__item-link">
						<div class="image__item-wrapper">
							<?php if ($featured_image != ""): ?>
								<img
									class="js-lazy-load"
									src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
									data-src="<?php echo $featured_image; ?>"
									alt=""
									/>
							<?php else: ?>
								<img
									class="js-lazy-load"
									src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
									data-src="<?php
									if($thumb_orientation)
										echo get_template_directory_uri().'/theme-content/img/camera-v.png';
									else
										echo get_template_directory_uri().'/theme-content/img/camera.png';
									?>"
									alt=""
								/>
							<?php endif ?>
						</div>
						<div class="image__item-meta image_item-meta--portfolio">
							<div class="image_item-table">
								<div class="image_item-cell image_item--block image_item-cell--top">
									<h3 class="image_item-title"><?php the_title(); //short_text(get_the_title($post->ID), 20, 20); ?></h3>
									<span class="image_item-description"><?php short_text(get_the_excerpt(), 50, 50); ?></span>
								</div>
								<div class="image_item-cell image_item--block image_item-cell--bottom">
									<div class="image_item-meta grid">
										<ul class="image_item-categories grid__item one-half">
											<?php $categories = get_the_terms($post->ID, 'lens_gallery_categories');
											if ($categories): ?>
												<li class="image_item-cat-icon"><i class="icon-folder-open"></i></li>
												<?php
												$categories_index = 1;
												foreach ($categories as $cat):
													if($categories_index < 3) :
														?>
														<li class="image_item-category"><?php echo $cat->name; ?></li>
													<?php
													else : break;
													endif;
													$categories_index++;
												endforeach;
											endif; ?>
										</ul><!--
		                                    --><?php
										// if (function_exists( 'display_pixlikes' )) {
										//     display_pixlikes(array('display_only' => 'true', 'class' => 'image_item-like-box likes-box grid__item one-half' ));
										// }
										?>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<?php
				// if we added 3 it's now time to add the page title box
				if ($idx == 3 && wpgrade::option('galleries_show_archive_title')  && $paged == 1) : ?>
					<div class="mosaic__item  mosaic__item--page-title <?php echo $thumb_orientation; echo $has_post_thumbnail ? "" : " js--is-loaded "; echo lens::get_terms_as_string('lens_gallery_categories', 'slug'); ?>">
						<div class="image__item-link">
							<div class="image__item-wrapper">
								<?php if ($has_post_thumbnail) : ?>
									<img
										class="js-lazy-load"
										src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
										data-src="<?php echo $post_featured_image; ?>"
										alt=""
										/>
								<?php endif; ?>
							</div>
							<div class="image__item-meta">
								<div class="image_item-table">
									<div class="image_item-cell">
										<h1><?php echo $title; ?></h1>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif;

			endwhile;

			// if there were less than 3 items, still add the title box
			if ($idx < 3 && wpgrade::option('galleries_show_archive_title')  && $paged == 1) : ?>
				<div class="mosaic__item  mosaic__item--page-title <?php echo $thumb_orientation; echo $has_post_thumbnail ? "" : " js--is-loaded "; echo lens::get_terms_as_string('lens_gallery_categories', 'slug'); ?>">
					<div class="image__item-link">
						<div class="image__item-wrapper">
							<?php if ($has_post_thumbnail) : ?>
								<img
									class="js-lazy-load"
									src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
									data-src="<?php echo $post_featured_image; ?>"
									alt=""
									/>
							<?php endif; ?>
						</div>
						<div class="image__item-meta">
							<div class="image_item-table">
								<div class="image_item-cell">
									<h1><?php echo $title; ?></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif;
		endif;
		/* Restore original Post Data */
		wp_reset_postdata(); ?>
	</div><!-- .mosaic -->
	<?php
	$pagination =  wpgrade::pagination($query,'galleries');
	if (!empty($pagination)) {
		echo '<div class="mosaic__pagination">'.$pagination.'</div>';
	} ?>
</div><!-- .content -->