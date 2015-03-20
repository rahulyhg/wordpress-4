<?php global $post; ?>


<div class="entry__header">
    <h2 class="entry__title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <hr class="separator separator--dotted grow">
</div>
<div class="entry__content"><?php the_excerpt(); ?></div>

<div class="entry__featured-image">
    <?php echo lens::gallery_slideshow($post); ?>
</div>