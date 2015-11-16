<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
<div id="sidebar">
<div class="sidebar">

  <div class="h5show">
    <?php 
    global $post;
    $categories_shop = get_categories("echo=0&show_count=1&child_of=2&title_li=&orderby=count&order=ASC&hide_empty=0");
    foreach($categories_shop as $category) {
      if (in_category($category->cat_ID,$post)) {
        $type=$category->cat_ID;
      }
    }
    if($type == '') {$type=26;}
  //echo adrotate_group(1); ?>
  <a href="<?php echo get_category_link($type); ?>"><img src="<?php echo z_taxonomy_image_url($type); ?>" class="autoimg" /></a> 
  </div>
  <div class="gameabout">
    <div class="h5-head icon-square">相关游戏</div>
    <div class="kind-body">
      <ul class="cf">
<?php
global $post;
$cats = wp_get_post_categories($post->ID);
if ($cats) {
    if(($cats[0] ==100 || $cats[0] ==101 || $cats[0] ==102) && $cats[1])
    {
      $cats[0] = $cats[1];
    }
    $args = array(
          'category__in' => array( $cats[0] ),
          'post__not_in' => array( $post->ID ),
          'showposts' => 6,
          'caller_get_posts' => 1
      );
  query_posts($args);

  if (have_posts()) {
    while (have_posts()) {
      the_post(); update_post_caches($posts); ?>

 <li> <a href="<?php the_permalink() ?>"><span class="a-img" <?php if ( has_post_thumbnail()) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');echo 'style="background-image:url(' . $large_image_url[0] . ');"';}?>><img src="<?php echo get_template_directory_uri(); ?>/images/icon-default.png"></span><span class="a-text"><?php the_title(); ?></span></a> </li>

<?php
    }
  } 
  else {
    echo '暂无相关游戏';
  }
  wp_reset_query(); 
}
else {
  echo '暂无相关文章';
}
?>
      </ul>
    </div>
  </div>
  <div class="hotRanking">
    <div class="h5-head icon-square">热门排行</div>
    <div class="kind-body">
      <ul class="cf">
        <?php if (function_exists('get_most_viewed')): ?>
            <?php get_most_viewed('post',6,0,1); ?>
        <?php endif; ?>     

      </ul>
    </div>
  </div>
  <?php if(!in_category(33)) {
      global $wpdb;
      if(in_category(101,$post)) {
        $post_type = 1;
      } else if(in_category(100,$post)) {
        $post_type = 2;
      } else if(in_category(102,$post)) {
        $post_type = 3;   
      } else {
        $post_type = 0;
      }
      switch($post_type) {
        case 1: 
        $results = $wpdb->get_results("SELECT wp_post_score.level,wp_post_score.score,wp_myFavorite.name,wp_myFavorite.avatar,wp_myFavorite.nickname FROM `wp_post_score` LEFT JOIN `wp_myFavorite` ON wp_post_score.user_id=wp_myFavorite.user_id WHERE post_id=".$post->ID." ORDER BY wp_post_score.score DESC LIMIT 0,10");
        break;
        case 2:
        $results = $wpdb->get_results("SELECT wp_post_score.level,wp_post_score.score,wp_myFavorite.name,wp_myFavorite.avatar,wp_myFavorite.nickname FROM `wp_post_score` LEFT JOIN `wp_myFavorite` ON wp_post_score.user_id=wp_myFavorite.user_id WHERE post_id=".$post->ID." ORDER BY wp_post_score.level DESC LIMIT 0,10");
        break;
        case 3:
        $results = $wpdb->get_results("SELECT wp_post_score.level,wp_post_score.score,wp_myFavorite.name,wp_myFavorite.avatar,wp_myFavorite.nickname FROM `wp_post_score` LEFT JOIN `wp_myFavorite` ON wp_post_score.user_id=wp_myFavorite.user_id WHERE post_id=".$post->ID." ORDER BY wp_post_score.level DESC,wp_post_score.score DESC LIMIT 0,10");
        break;
        default:
        $results = '';
      }
      if($results) {
        echo '<div class="ranking"><div class="h5-head icon-square">排行榜</div><ul class=ranking-list>';
        $i = 1;
        foreach ($results as $result) {
          if(!$result->avatar) {
            $result->avatar="http://avatar.static.appgame.com/uploads/avatar/rq/Mg/4tzi.png";
          }
            echo '<li class="cf"><span class="ranking-num">'.$i++.'</span><img src="'.$result->avatar.'" alt="头像" /><div class="user-score"><h3>';
            if($result->nickname) {
              echo $result->nickname;
            } else { echo $result->name; }
            echo '</h3><span>';
            switch ($post_type) {
              case 1:
                echo $result->score."分";
                break;             
              case 2:
                echo $result->level."关";
                break;
              case 3:
                echo $result->level."关,".$result->score."分";
                break;
            }
            echo '</span></div></li>';
        }
        echo '</ul></div>';
      }
  }?>
</div>
</div>
<!-- #secondary .widget-area -->
<?php endif; ?>
