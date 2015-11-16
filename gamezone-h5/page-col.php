<?php 
/* Template Name: page-col */
?>
<?php
/**
 * The template for displaying all pages.
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

<div id="primary">
  <div class="full" role="main">
    <div class="h5-block">
      <div class="h5-head icon-arcade">全部合集</div>
      <div class="h5-body" id="h5-col">
        <?php
$categories_shop = get_categories("echo=0&show_count=1&child_of=2&title_li=&orderby=count&order=ASC&hide_empty=0&number=14");
foreach($categories_shop as $category) { ?>
        <div class="h5-col">
          <div class="m-txt">
            <h3><?php echo get_cat_name( $category->cat_ID ) ?></h3>
            <a href="<?php echo get_category_link($category->cat_ID); ?>"><img src="<?php echo z_taxonomy_image_url($category->term_id); ?>" class="autoimg" /></a> </div>
          <?php $posts = get_posts( "category=".$category->cat_ID."&numberposts=3" ); ?>
          <?php if( $posts ) : ?>
          <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
          <?php include 'h5-game-quarter.php'; ?>
          <?php endforeach; ?>
          <?php endif; ?>
          <div class="more"><a href="<?php echo get_category_link($category->cat_ID); ?>">查看全部</a></div>
        </div>
        <?php 
}

 ?>
        <div class="cl"></div>
      </div>
    </div>
  </div>
  <!-- #content --> 
</div>
<!-- #primary -->
<?php get_footer(); ?>