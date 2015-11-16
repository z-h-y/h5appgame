<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<div class="h5-block">
  <div class="h5-head icon-arcade"><?php printf( __( '搜索: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></div>
  <div class="h5-body h5-game-oneThird">
    <?php if ( have_posts() ) : ?>
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
    <div class="clearfix"></div>
    <?php twentyeleven_content_nav( 'nav-below' ); ?>
    <?php else : ?>
    <?php endif; ?>
  </div>
</div>
<?php get_footer(); ?>
