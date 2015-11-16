<div class="h5-game">
  <a href="<?php the_permalink() ?>" class="h5-game-content cf">
      <img class="h5-game-icon" src="<?php if ( has_post_thumbnail()) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');echo $large_image_url[0];}?>" alt="<?php the_title();?>" />
      <div class="h5-game-body">
        <h3 class="h5-game-name">
          <?php the_title();?>
        </h3>
        <span class="h5-game-kind">分类：任玩小测试 </span>
        <p class="h5-game-detail"><?php if(function_exists('the_views')) {the_views();} ?></p>
      </div>
  </a>
</div>