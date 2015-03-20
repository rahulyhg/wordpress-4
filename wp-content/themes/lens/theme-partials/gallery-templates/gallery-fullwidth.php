<div id="main" class="content djax-updatable">
    <?php
	$gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'main_gallery', true );
	if (!empty($gallery_ids)) {
		$gallery_ids = explode(',',$gallery_ids);
	} else {
		$gallery_ids = array();
	}

	if ( !empty($gallery_ids) ) {
		$attachments = get_posts( array(
			'post_type' => 'attachment',
			'posts_per_page' => -1,
			'orderby' => "post__in",
			'post__in'     => $gallery_ids
		) );
	} else {
		$attachments = array();
	}

    $image_scale_mode = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_image_scale_mode', true);
	$slider_visiblenearby = get_post_meta(get_the_ID(), wpgrade::prefix() . 'post_slider_visiblenearby', true);
    $slider_transition = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_slider_transition', true);
    $slider_autoplay = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_slider_autoplay', true);
    if($slider_autoplay)
        $slider_delay = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_slider_delay', true);

    if ( $attachments ) : ?>
        <div class="pixslider js-pixslider  pixslider--gallery-fs" 
            data-customarrows="right" 
            data-fullscreen  
            data-imagealigncenter  
            data-imagescale="<?php echo $image_scale_mode; ?>" 
            data-slidertransition="<?php echo $slider_transition; ?>"

            <?php if ($slider_autoplay) {
                echo 'data-sliderautoplay="" ';
                echo 'data-sliderdelay="'. $slider_delay.'" ';
            } 
			if ($slider_visiblenearby) {
				echo ' data-visiblenearby ';
			}
			if (wpgrade::option('show_title_caption_popup') == 1) {
				echo "data-enablecaption ";
			}
			?> >
            <?php 
            foreach ( $attachments as $attachment ) :
                $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                $thumbimg = wp_get_attachment_image_src($attachment->ID, 'big');
                $attachment_fields = get_post_custom( $attachment->ID );

                //whether or not to show the title and caption in slides
                $img_title = '';
                $img_caption = '';
                $caption_text = '';

                if (wpgrade::option('show_title_caption_popup') == 1) {
                    $img_title = '<span class="rsCaption__title">'.$attachment->post_title.'</span>';
                    $img_caption = '<span class="rsCaption__desc">'.$attachment->post_excerpt.'</span>';

                    $caption_text = ' <figure class="rsCaption">'.$img_title.' '.$img_caption.'</figure>';
                }

                // check if this attachment has a video url
                $video_url = ( isset($attachment_fields['_video_url'][0] ) && !empty( $attachment_fields['_video_url'][0]) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';

                //  if there is a video let royal slider know about it
                if ( !empty($video_url) ) { ?>
					<div class="gallery-item video">
						<a href="<?php echo $thumbimg[0]; ?>" class="rsImg" data-rsVideo="<?php echo $video_url; ?>" ><?php echo $attachment->post_title; ?></a>
						<?php echo $caption_text; ?>
					</div>
				<?php } else { ?>
					<div class="gallery-item" itemscope itemtype="http://schema.org/ImageObject">
						<a href="<?php echo $thumbimg[0]; ?>" class="attachment-blog-big rsImg" itemprop="contentURL" ><?php echo $attachment->post_title; ?></a>
						<?php echo $caption_text; ?>
					</div>
            <?php }
            endforeach; ?>
        </div>
    <?php endif; ?>        
</div>