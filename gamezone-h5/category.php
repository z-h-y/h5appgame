<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<?php if ( have_posts() ) : ?>

<div class="h5-block">
  <div class="h5-head icon-arcade"><?php printf( __( '%s', 'twentyeleven' ), '<span>' . single_cat_title( '', false ) . '</span>' );?></div>
  <div class="h5-body h5-game-oneThird">
    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						
					?>
    <?php include 'h5-game-quarter.php'; ?>
    <?php endwhile; ?>
    <?php //twentyeleven_content_nav( 'nav-below' ); ?>
    <div class="clearfix"></div>
  </div>
  <div class="loadimg hide"><i class="ico-loading-64"></i></div>
</div>
<?php endif; ?>
<?php get_footer(); ?>
