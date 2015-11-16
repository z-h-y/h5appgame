<li class="h5-game-recommend">
  <a href="<?php the_permalink($post->ID) ?>">
  	<img src="<?php if ( has_post_thumbnail()) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');echo $large_image_url[0];}?>" alt="<?php the_title(); ?>" />
  	<span class="game-name">
        <?php the_title(); ?>
    </span>
  </a>
</li>