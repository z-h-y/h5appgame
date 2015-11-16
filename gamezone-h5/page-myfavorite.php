<?php 
/* Template Name: page-myfavorite */
?>
<?php
/**
 * The template for displaying all page-myfavorite.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<div class="h5-b2">
  <div class="h5-block">
    <div class="h5-block-nav h5-myfavorite-nav">
      <ul class="cf">
        <li class="active">收藏列表</li>
        <li class="no-border">历史记录</li>
      </ul>
    </div>
    <div class="h5-body myfavorite cf">
      <div class="norecord">暂无收藏</div>
    </div>
    <div class="h5-body myhistory hide cf">
      <div class="norecord">暂无记录</div>
    </div>
    <div class="loadimg hide"><i class="ico-loading-64"></i></div>
  </div>
</div>
<?php get_footer(); ?>