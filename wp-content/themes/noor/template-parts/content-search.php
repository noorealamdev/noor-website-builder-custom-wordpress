<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Noor
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box'); ?>>
    <div class="post-inner">

        <?php if ( has_post_thumbnail() ) { ?>
        <div class="entry-media hover-scale">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
        <?php } ?>
        <div class="inner-post">
            <div class="post-header">

                <?php the_title( '<h2 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

            </div><!-- .entry-header -->

            <div class="entry-summary the-excerpt">

                <?php the_excerpt(); ?>

            </div><!-- .entry-content -->
        </div>
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php if( noor_get_option( 'post_entry_meta' ) ) { noor_post_meta(); } ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
