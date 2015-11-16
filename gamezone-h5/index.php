<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>
<div id="container" class="cf">

  <div id="slider" role="main">
      <section class="myslider">
        <div class="flexslider">
          <ul class="slides">
            <li>
              <a href="http://h5.appgame.com/category/heji/shejingbing" target="_blank" style="background-image:url(http://h5.appgame.com/wp-content/uploads/2015/10/banner1_shejingbing_ys.jpg);"><img src="http://h5.appgame.com/wp-content/themes/gamezone-h5-1/images/slider-default.png"></a>
            </li>
            <li>
              <a href="http://h5.appgame.com/category/heji/shejingbing" target="_blank" style="background-image:url(http://h5.appgame.com/wp-content/uploads/2015/10/celue1_ys.jpg);"><img src="http://h5.appgame.com/wp-content/themes/gamezone-h5-1/images/slider-default.png"></a>
            </li>
          </ul>
        </div>
      </section>
    </div>

  </div>
<div class="h5-b2">
  <div class="h5-block">
    <div class="h5-head icon-square">编辑推荐<a class="refresh disclick" href="javascript:void(0)"><i class="ico-refresh"></i>换一换</a></div>
    <div class="h5-body h5-game-oneThird">
    
    <?php $posts = get_posts( "category=16&numberposts=8&orderby=rand" ); ?>
		<?php if( $posts ) : ?>
    <ul class="recommend-list cf">
    <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
    
    
    <?php include 'h5-game-recommend.php'; ?>
      
    
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <i class="ico-loading-64 hide"></i>
    </div>
  </div>
  <div class="h5-block">
    <div class="h5-block-nav">
      <ul class="cf">
        <li class="active">最新发布</li>
        <li class="hot_li">热门</li>
        <li class="no-border">分类</li>
      </ul>
    </div>
    <div class="h5-body h5-body-first cf">
      <?php $posts = get_posts( "category=2,8&numberposts=9" ); ?>
			<?php if( $posts ) : ?>
      <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
      
      <?php include 'h5-game-quarter.php'; ?>
      
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <div class="h5-body h5-body-second cf hide">
      <?php if (function_exists('get_most_viewed')): ?>
          <?php //get_most_viewed('post',9); ?>
      <?php endif; ?>
    </div>
    <div class="loadimg hide"><i class="ico-loading-64"></i></div>
    <div class="h5-body hide">
      <div class="kind-list-body">
        <ul>
          <li><a href="http://h5.appgame.com/category/all/" class="icon_1">全部游戏</a></li>
          <li><a href="http://h5.appgame.com/game-col" class="icon_2"><i>专题合集</i></a></li>
          <li><a href="http://h5.appgame.com/category/arcade/" class="icon_3">街机游戏</a></li>
          <li><a href="http://h5.appgame.com/category/action/" class="icon_4">动作游戏</a></li>
          <li><a href="http://h5.appgame.com/category/sports/" class="icon_5">运动游戏</a></li>
          <li><a href="http://h5.appgame.com/category/shooting/" class="icon_6">射击游戏</a></li>
          <li><a href="http://h5.appgame.com/category/chess/" class="icon_7">棋牌游戏</a></li>
          <li><a href="http://h5.appgame.com/category/puzzle/" class="icon_8">益智游戏</a></li>
          <li><a href="http://h5.appgame.com/category/role/" class="icon_9">角色游戏</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>