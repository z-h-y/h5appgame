<?php 
/* Template Name: page-cece */
?>
<?php
/**
 * The template for displaying all page-cece.
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
    <div class="h5-body cf">
      <?php $posts = get_posts( "category=33&numberposts=15" ); ?>
      <?php if( $posts ) : ?>
      <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
      
      <?php include 'h5-game-normal.php'; ?>
      
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <div class="loadimg hide"><i class="ico-loading-64"></i></div>
  </div>
</div>
<?php get_footer(); ?>