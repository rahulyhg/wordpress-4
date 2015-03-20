<div id="main" class="content djax-updatable">
	<?php
	$client_name = '';
	$client_name = get_post_meta( get_the_ID(), wpgrade::prefix() . 'portfolio_client_name', true );
	
    $client_link = get_post_meta( get_the_ID(), wpgrade::prefix() . 'portfolio_client_link', true );
    if($client_link == '') $client_link = '#';
    
	?>
    <div class="page-content">        
        <div class="page-main">
            <article id="post-<?php the_ID(); ?>" <?php post_class('entry__body'); ?> >
                <header class="entry-header">
                    <h1 class="entry__title"><?php the_title(); ?></h1>
                </header>
                <div class="entry__content project-entry-content js-project-gallery">
                    <?php the_content(); ?>
                </div><!-- .entry__content -->
                <hr class="separator--dotted separator--full-left" />
                <footer class="entry__meta entry__meta--project cf">
                    <?php if($client_name != '') : ?>
                        <div class="entry__meta-box meta-box--client">
                            <span class="meta-box__box-title"><?php _e("Client", wpgrade::textdomain()); ?>: </span>
                            <a href="<?php echo $client_link; ?>" target="_blank"><?php echo $client_name; ?></a>
                        </div>
                    <?php endif; ?>
                    <?php
                    $categories = get_the_terms($post->ID, 'lens_portfolio_categories');
                    if ($categories && !is_wp_error($categories)): ?>
                        <div class="entry__meta-box meta-box--categories span-12 hand-span-6">
                            <span class="meta-box__box-title"><?php _e("Filed under", wpgrade::textdomain()); ?>: </span>
                            <?php foreach ($categories as $cat): ?>
                                    <a href="<?php echo get_category_link($cat); ?>" rel="category"><?php echo $cat->name; ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </footer><!-- .entry__meta .entry__meta--project -->
                <hr class="separator separator--striped separator--full-left"/>
                <footer class="entry__meta  flexbox">
                    <?php
                    if (function_exists( 'display_pixlikes' )) {
                        display_pixlikes(array('class' => 'likes-box  likes-box--footer  flexbox__item'));
                    }
            
                    if (wpgrade::option('portfolio_single_show_share_links')): ?>
						<script type="text/javascript">/* --- MAKE POPUPS --- */function popitup(url, title) {newwindow=window.open(url,title,'height=300,width=600');if (window.focus) {newwindow.focus()}	return false; } </script>
						
                        <div class="social-links  flexbox__item  text--right">
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
                </footer><!-- .entry__meta -->
                
                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                       if ( comments_open() || '0' != get_comments_number() )
                          comments_template();
                ?>
            </article><!-- #post -->
            
            <?php
            $yarpp_active = false;
	        if ( function_exists('related_posts') ) {
		        $yarpp_active = true;
	        } ?>
            
            <section class="related-projects_container entry__body">
                <header class="related-projects_header">
                    <?php if($yarpp_active) : ?>
                    <h4 class="related-projects_title"><?php _e("Related projects", wpgrade::textdomain()); ?></h4>
                    <?php endif; ?>
                   <nav class="projects_nav">
                       <ul class="projects_nav-list">
                           <li class="projects_nav-item">
                                <?php next_post_link('%link', '<span class="prev">&#8592;</span>' . __('Previous', wpgrade::textdomain()) ); ?>
                            </li>
                           <li class="projects_nav-item">
                                <a href="<?php echo get_portfolio_page_link(); ?>">
                                    <?php _e("All projects", wpgrade::textdomain()); ?>
                                </a>
                            </li>
                            <li class="projects_nav-item">
                                <?php previous_post_link('%link', __('Next', wpgrade::textdomain()). '<span class="next">&#8594;</span>'); ?>
                            </li>
                       </ul>
                   </nav>
                </header>        
                <?php 
                    if ($yarpp_active) {
						yarpp_related(
							array(
								// Pool options: these determine the "pool" of entities which are considered
								'post_type' => array('lens_portfolio'), // my cpt
								'show_pass_post' => false, // show password-protected posts
							),
							$post->ID, // second argument: (optional) the post ID. If not included, it will use the current post.
							true // third argument: (optional) true to echo the HTML block; false to return it
						);
                    }
                ?>
            </section>
        </div><!-- .page-main -->
    </div><!-- .page-content -->
</div><!-- .content -->