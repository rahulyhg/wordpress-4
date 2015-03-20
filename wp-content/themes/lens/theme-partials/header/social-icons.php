<div class="header__social-section">
	<?php
	$social_icons = wpgrade::option( 'social_icons' );
	$target       = '';
	$title        = wpgrade::option( 'social_footer_menu_title' );
	if ( wpgrade::option( 'social_icons_target_blank' ) ) {
		$target = ' target="_blank"';
	}
	if ( count( $social_icons ) ): ?>
		<?php if ( $title ): ?><h4 class="widget__title"><?php echo $title; ?></h4><?php endif; ?>
		<ul class="site-social-links">
			<?php foreach ( $social_icons as $domain => $icon ):
				if (isset($icon['value'] ) && !empty($icon['value']) ) : ?>
					<li class="site-social-links__social-link">
						<a href="<?php echo $icon['value'] ?>"<?php echo $target ?>>
							<i class="pixcode  pixcode--icon  icon-e-<?php echo $domain; ?>"></i>
						</a>
					</li>
				<?php endif;
			endforeach ?>
		</ul>
	<?php endif; ?>
</div>