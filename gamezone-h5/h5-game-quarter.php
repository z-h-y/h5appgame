<div class="h5-game">
  <a href="<?php the_permalink() ?>" class="h5-game-content cf">
    <img class="h5-game-icon" src="<?php if ( has_post_thumbnail()) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');echo $large_image_url[0];}?>" alt="<?php the_title();?>" />
    <div class="h5-game-body">
      <h3 class="h5-game-name">
        <?php the_title();?>
      </h3>
      <span class="h5-game-kind">分类：
        <?php if (in_category('18')) { ?>
        街机游戏
        <?php } else if(in_category('30')) {?>
        动作游戏
        <?php } else if(in_category('23')) {?>
        运动游戏
        <?php } else if(in_category('31')) {?>
        射击游戏
        <?php } else if(in_category('32')) {?>
        棋牌游戏
        <?php } else if(in_category('13')) {?>
        益智游戏
        <?php } else if(in_category('19')) {?>
        角色游戏
        <?php } else if(in_category('33')) {?>
        任玩小测试
        <?php } else {?>
        任玩小游戏
        <?php } ?>
      </span>
      <p class="h5-game-detail"><?php if(function_exists('the_views')) {the_views();} ?></p>    
    </div>
  </a> 
  <?php
  if(!in_category(33)) {
    $str = get_the_content();
    $start = '<a href="';
    $end = substr($str, strlen($start)+strpos($str, $start));
    $substr = substr($end, 0,(strlen($end) - strpos($end, '"'))*(-1));
    //$substr = substr($str, strlen($start)+strpos($str, $start),(strlen($str) - strpos($str, $end))*(-1));
      echo '<a href="';
      echo $substr.'" postid=';
      the_ID();
      echo ' class="h5-game-link" target="_blank">开始玩</a>';
  } 
  ?>
</div>