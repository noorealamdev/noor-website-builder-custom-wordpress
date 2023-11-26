<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Noor
 */

get_header();

$pheader_bgimage = '';
$white_text = '';
$is_bg = '';
if ( !function_exists( 'rwmb_meta' ) ) {
    $pheader_bgimage .= noor_get_option( 'single_post_bg_top_page' );
} else {
	$images = rwmb_meta( 'pheader_bg_image', 'type=image');

    if ( !$images ) {
        $pheader_bgimage .= noor_get_option( 'single_post_bg_top_page' );
    } else {
        foreach ( $images as $image ) {
            $pheader_bgimage .= $image['full_url'];
            break; 
        }
    }
}
if ( noor_get_option( 'white_text' ) == 'yes' ){
	$white_text = ' white-text';
}
if ( $pheader_bgimage == '' ){
	$is_bg = ' no-bg';
}

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="single-page-header post-box<?php echo esc_attr($white_text.$is_bg); ?>" <?php if ( $pheader_bgimage != '' ) { ?> style="background-image: url(<?php echo esc_url( $pheader_bgimage ); ?>);" <?php } ?> >
    <div class="sing-page-header-content">
    	<div class="container">
		    <div class="post-header">			        
		    	<?php noor_posted_in(); ?>
		        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		        <?php if ( 'post' === get_post_type() ) : if ( noor_get_option( 'post_entry_meta' ) ) { ?>
			        
			    <?php noor_post_meta(); ?>
			        
		        <?php } endif; ?>
		    </div>
		</div>
    </div>
</div>
<?php endwhile; endif; ?>

<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) { ?>
	<div class="entry-content">
		<div class="container">
			<div class="row">
				<div id="primary" class="content-area single-post <?php noor_content_columns(); ?>">
					<main id="main" class="site-main">
								<?php
								while ( have_posts() ) :
									the_post();

									get_template_part( 'template-parts/content', 'single' );

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

								endwhile; // End of the loop.
								?>
							</div>
							</div>
						</article>
					</main><!-- #main -->
				</div><!-- #primary -->
				
				<?php get_sidebar(); ?>
			</div>
		</div>	
	</div>
<?php }

get_footer();
