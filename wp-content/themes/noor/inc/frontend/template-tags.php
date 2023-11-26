<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Noor
 */

if ( ! function_exists( 'noor_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function noor_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'noor' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'noor_posted_in' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function noor_posted_in() {
        // $categories_list = get_the_category_list( esc_html__( ' ', 'noor' ) );
        $categories_list = preg_replace('/<a /', '<a class="hover"', get_the_category_list( esc_html__( ' ', 'noor' ) ));
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            $posted_in = sprintf( esc_html__( '%1$s', 'noor' ), $categories_list ); // WPCS: XSS OK.
        }

        echo '<div class="post-cates text-line">' . $posted_in . '</div>'; // WPCS: XSS OK.

    };
endif;

if ( ! function_exists( 'noor_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function noor_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'noor' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'noor_post_meta' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function noor_post_meta() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x( '%s', 'post date', 'noor' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="uil uil-calendar-alt"></i>' . $time_string . '</a>'
        );

        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x( '%s', 'post author', 'noor' ),
            '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="uil uil-user"></i>' . esc_html( get_the_author() ) . '</a>'
        );

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'noor' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            $tag_with = sprintf( '<span class="tags-links">' . esc_html__( '%1$s', 'noor' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
        $metas = noor_get_option( 'post_entry_meta' );
        if ( ! empty( $metas ) ) :
            echo "<ul class='post-meta dflex'>";
            if( in_array('date', $metas) ) echo '<li class="post-date">' . $posted_on . '</li>';
            if( in_array('author', $metas) ) echo '<li class="post-author">' . $byline . '</li>';
            if( in_array('comm', $metas) ) { 
                echo '<li class="post-comments"><i class="uil uil-comment"></i>';
                comments_number( esc_html__('0 Comments', 'noor'), esc_html__('1 Comment', 'noor'), esc_html__(  '% Comments', 'noor') );
                echo '</a></li></a>';
            }
            echo "</ul>";
        endif;

    }
endif;

if ( ! function_exists( 'noor_portfolio_meta' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function noor_portfolio_meta() {

        $cates = get_the_terms( get_the_ID(), 'portfolio_cat' );
        
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        
        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x( '%s', 'post date', 'noor' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="uil uil-calendar-alt"></i>' . $time_string . '</a>'
        );

        echo '<li class="post-date">' . $posted_on . '</li>'; // WPCS: XSS OK.

        if ( ! is_wp_error( $cates ) && ! empty( $cates ) ) :
            echo '<li class="post-cates">';  
            foreach ( $cates as $key => $term ) {
                $icon_html = '';
                if($key == 0) $icon_html = '<i class="uil uil-file-alt"></i>';
                // The $term is an object, so we don't need to specify the $taxonomy.
                $term_link = get_term_link( $term );
                // If there was an error, continue to the next term.
                if ( is_wp_error( $term_link ) ) {
                    continue;
                }
                // We successfully got a link. Print it out.
                echo '<a href="' . esc_url( $term_link ) . '">' . $icon_html . $term->name . '</a>';
            }
            echo '</li>';    
        endif; 
    }
endif;

if ( ! function_exists( 'noor_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function noor_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() || 'noor_portfolio' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'noor' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="wp-block-tag-cloud">' . esc_html__( '%1$s', 'noor' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}

            $share = noor_get_option( 'post_socials' );
            if ( $share ) : 
                echo '<div class="share-post">';
                echo '<a class="share-btn octf-btn"><i class="uil uil-share-alt"></i>'.esc_html__('Share','noor').'</a>';
                echo '<div class="sdropdown">';

                if( in_array('twit', $share) ) echo '<a class="twit" target="_blank" href="https://twitter.com/intent/tweet?text=' .get_the_title(). '&url=' .get_the_permalink(). '" title="Twitter"><i class="uil uil-twitter"></i>Twitter</a>';
                if( in_array('face', $share) ) echo '<a class="face" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' .get_the_permalink(). '" title="Facebook"><i class="uil uil-facebook-f"></i>Facebook</a>';
                if( in_array('link', $share) ) echo '<a class="linked" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' .get_the_permalink(). '&title=' .get_the_title(). '&summary=' .esc_url( get_home_url('/') ). '&source=' .get_bloginfo( 'name' ). '" title="LinkedIn"><i class="uil uil-linkedin"></i>LinkedIn</a>';
                if( in_array('google', $share) ) echo ' <a class="google" target="_blank" href="https://plus.google.com/share?url=' .get_the_permalink(). '" title="Google Plus"><i class="uil uil-google"></i>Google +</a>';
                if( in_array('tumblr', $share) ) echo ' <a class="tumblr" target="_blank" href="http://www.tumblr.com/share/link?url=' .get_the_permalink(). '&name=' .get_the_title(). '&description=' .get_the_excerpt(). '" title="Tumblr"><i class="uil uil-tumblr"></i>Tumblr</a>';
                if( in_array('reddit', $share) ) echo '<a class="reddit" href="http://reddit.com/submit?url=' .get_the_permalink(). '&title=' .get_the_title(). '" target="_blank" title="Reddit"><i class="uil uil-reddit-alien-alt" aria-hidden="true"></i>Reddit</a>';
                if( in_array('vk', $share) ) echo '<a class="vk" href="http://vk.com/share.php?url=' .get_the_permalink(). '" target="_blank" title="VK"><i class="uil uil-vk"></i>VK</a>';

                echo '</div></div>';
            endif;
		}

	}
endif;

/** Posts Navigation **/
if ( ! function_exists( 'noor_posts_navigation' ) ) :
    function noor_posts_navigation($prev = '<i class="uil uil-arrow-left"></i>', $next = '<i class="uil uil-arrow-right"></i>', $pages='') {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        if($pages==''){
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }
        $pagination = array(
            'base'          => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
            'format'        => '',
            'current'       => max( 1, get_query_var('paged') ),
            'total'         => $pages,
            'prev_text'     => $prev,
            'next_text'     => $next,
            'type'          => 'list',
            'end_size'      => 3,
            'mid_size'      => 3
        );
        $return =  paginate_links( $pagination );
        echo str_replace( "<ul class='page-numbers'>", '<ul class="page-pagination none-style">', $return );
    }
endif;

/** Excerpt Section Blog Post **/
if ( ! function_exists( 'noor_excerpt' ) ) :
    function noor_excerpt($limit) {
    
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    
        return $excerpt;
    };
endif;

/** custom comment list **/
if ( ! function_exists( 'noor_comment_list' ) ) :
    function noor_comment_list($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment; ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-item'); ?>>
            <article class="comment-wrap clearfix">
                <div class="comment-content">
                    <div class="comment-meta dflex">
                        <div class="dflex">
                            <div class="gravatar">
                                <?php echo get_avatar( $comment, 60 ); ?>
                            </div>
                            <div>
                                <h6 class="comment-author"><?php printf(__('%s','noor'), get_comment_author()) ?></h6>
                                <span class="comment-time"><i class="uil uil-calendar-alt"></i><?php comment_time( get_option( 'date_format' ) ); ?></span>
                            </div>
                        </div>
                        <div class="comment-reply"><?php echo preg_replace( '/comment-reply-link/', 'comment-reply-link octf-btn', get_comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))); ?></div>
                    </div>
                    <div class="comment-text">
                        <?php if ($comment->comment_approved == '0'){ ?>
                            <em><?php esc_html_e('Your comment is awaiting moderation.','noor') ?></em>
                        <?php }else{ ?>
                            <?php comment_text() ?>
                        <?php } ?>
                    </div>
                </div>

            </article>
        </li>

        <?php
    }
endif;

//Generate custom search form
function noor_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    <input type="search" id="search-field" class="search-field" placeholder="' . esc_attr__( 'Type keyword and hit enter', 'noor' ) . '" value="' . get_search_query() . '" name="s" />
	<button type="submit" class="search-submit"><i class="uil uil-search"></i></button>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'noor_search_form' );

//Add span to category post count
function noor_cat_count_span($links) {
    $links = str_replace('</a> (', '</a> <span class="posts-count">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('wp_list_categories', 'noor_cat_count_span');

//Add span to archive post count
function noor_archive_count_span($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="posts-count">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('get_archives_link', 'noor_archive_count_span');

/** Add Contact Methods in the User Profile **/
function noor_user_contact_methods( $user_contact ) {
    $user_contact['facebook']   = esc_html__( 'Facebook URL', 'noor' );
    $user_contact['skype']      = esc_html__( 'Skype Username', 'noor' );
    $user_contact['twitter']    = esc_html__( 'Twitter Handle', 'noor' );
    $user_contact['youtube']    = esc_html__( 'Youtube Channel', 'noor' );
    $user_contact['dribbble']   = esc_html__( 'Dribbble', 'noor' );
    $user_contact['googleplus'] = esc_html__( 'Google +', 'noor' );
    $user_contact['pinterest']  = esc_html__( 'Pinterest', 'noor' );
    $user_contact['instagram']  = esc_html__( 'Instagram', 'noor' );
    $user_contact['github']     = esc_html__( 'Github Profile', 'noor' ); 
    return $user_contact; 
};
add_filter( 'user_contactmethods', 'noor_user_contact_methods' );

function noor_author_info_box() {

    global $post;

    $author_details = '';
    // Get author's display name - NB! changed display_name to first_name. Error in code.
    $display_name = get_the_author_meta( 'display_name', $post->post_author );
    $user_name = get_the_author_meta( 'nickname', $post->post_author );

    // If display name is not available then use nickname as display name
    if ( empty( $display_name ) )
    $display_name = get_the_author_meta( 'nickname', $post->post_author );

    // Get author's biographical information or description
    $user_description   = get_the_author_meta( 'user_description', $post->post_author );
    $user_twitter       = get_the_author_meta('twitter', $post->post_author);
    $user_facebook      = get_the_author_meta('facebook', $post->post_author);
    $user_skype         = get_the_author_meta('skype', $post->post_author);
    $user_dribbble      = get_the_author_meta('dribbble', $post->post_author);
    $user_youtube       = get_the_author_meta('youtube', $post->post_author);
    $user_googleplus    = get_the_author_meta('googleplus', $post->post_author);
    $user_pinterest     = get_the_author_meta('pinterest', $post->post_author);
    $user_instagram     = get_the_author_meta('instagram', $post->post_author);
    $user_github        = get_the_author_meta('github', $post->post_author);

    // Get link to the author archive page
    $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
    if ( ! empty( $display_name ) )
    // Author avatar - - the number 90 is the px size of the image.
    $author_details .= '<div class="dflex author-header mb-3">';
    $author_details .= '<div class="dflex ">';
    $author_details .= '<div class="author-image">'.get_avatar( get_the_author_meta('ID') , 60 ).'</div>';
    $author_details .= '<div class="author-info">';
    $author_details .= '<h6>' . $display_name . '</h6>';
    $author_details .= '<span>' . $user_name . '</span>';
    $author_details .= '</div>';
    $author_details .= '</div>';
    $author_details .= '<div class="btn-allpost"><a class="octf-btn" href="' . esc_url( $user_posts ) . '"><i class="uil uil-file-alt"></i>' . esc_html__( 'All Posts', 'noor' ) . '</a></div>';
    $author_details .= '</div>';
    $author_details .= '<p class="des">' . get_the_author_meta( 'description' ). '</p>';
    $author_details .= '<div class="author-socials">';

    // Check if author has Twitter in their profile
    if ( ! empty( $user_twitter ) ) {
        $author_details .= ' <a href="' . $user_twitter .'" target="_blank" rel="nofollow" title="Twitter"><i class="uil uil-twitter"></i> </a>';
    }

    if ( ! empty( $user_facebook ) ) {
        $author_details .= ' <a href="' . $user_facebook .'" target="_blank" rel="nofollow" title="Facebook"><i class="uil uil-facebook-f"></i> </a>';
    }

    if ( ! empty( $user_skype ) ) {
        $author_details .= ' <a href="' . $user_skype .'" target="_blank" rel="nofollow" title="Skype"><i class="uil uil-skype"></i> </a>';
    }

    if ( ! empty( $user_dribbble ) ) {
        $author_details .= ' <a href="' . $user_dribbble .'" target="_blank" rel="nofollow" title="Dribbble"><i class="uil uil-dribbble"></i> </a>';
    }

    if ( ! empty( $user_instagram ) ) {
        $author_details .= ' <a href="' . $user_instagram .'" target="_blank" rel="nofollow" title="Instagram"><i class="uil uil-instagram"></i> </a>';
    }

    if ( ! empty( $user_youtube ) ) {
        $author_details .= ' <a href="' . $user_youtube .'" target="_blank" rel="nofollow" title="Youtube"><i class="uil uil-youtube"></i> </a>';
    }

    if ( ! empty( $user_googleplus ) ) {
        $author_details .= ' <a href="' . $user_googleplus .'" target="_blank" rel="nofollow" title="Google+"><i class="uil uil-google-plus"></i> </a>';
    }

    if ( ! empty( $user_pinterest ) ) {
        $author_details .= ' <a href="' . $user_pinterest .'" target="_blank" rel="nofollow" title="Pinterest"><i class="uil uil-pinterest"></i> </a>';
    }

    $author_details .= '</div>';

    // Pass all this info to post content 
    echo '<div class="author-bio center-line" >' . $author_details . '</div>';
}
/** Allow HTML in author bio section **/
remove_filter('pre_user_description', 'wp_filter_kses');

/** Related Posts **/
function noor_related_posts() {

    global $post;

    $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 5, 'post__nnoor_in' => array($post->ID) ) );
    if( $related ) : 

    echo '<div class="related-posts center-line">';
    echo '<h3 class="mb-6">'.esc_html__( 'You Might Also Like', 'noor' ).'</h3>';
    echo '<div class="slide-posts ot-carousel owl-carousel owl-theme">';
    foreach( $related as $post ) {
    setup_postdata($post); ?>
    
    <div class="post-item">
        <?php if(has_post_thumbnail()) { ?>
        <div class="entry-media mb-4">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
                <?php if(noor_get_option('blog_read_more')) { echo '<div class="bg-overlay"><h5>'.noor_get_option('blog_read_more').'</h5></div>'; } ?>
            </a>
        </div>
        <?php } ?>
        <div class="post-header">

            <?php noor_posted_in(); ?>

            <?php the_title( '<h2 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

        </div>
        <div class="entry-meta">
            <?php if( noor_get_option( 'post_entry_meta' ) ) { noor_post_meta(); } ?>
        </div>
    </div>

    <?php } wp_reset_postdata();

    echo '</div>';
    echo '</div>';

    endif;
};

/** Single Post Navigation**/
if ( ! function_exists( 'noor_single_post_nav' ) ) :

    function noor_single_post_nav(){
                            
        if ( get_previous_post() ) {
            $ppost  = get_previous_post();
            $ptitle = get_the_title( $ppost->ID );
            previous_post_link( '%link', '<i class="uil uil-arrow-left"></i> Prev Post' );
        }

        if ( get_next_post() ) {
            $npost  = get_next_post();
            $ntitle = get_the_title( $npost->ID );
            next_post_link( '%link', 'Next Post <i class="uil uil-arrow-right"></i>' );
        }
    }
endif;

/* Get_previous_posts_link add class wordpress */
function add_class_next_post_link($html){
    $html = str_replace('<a','<a class="octf-btn octf-btn-icon-right post-next"',$html);
    return $html;
}
add_filter('next_post_link','add_class_next_post_link',10,1);
 
function add_class_previous_post_link($html){
    $html = str_replace('<a','<a class="octf-btn octf-btn-icon-left post-prev"',$html);
    return $html;
}
add_filter('previous_post_link','add_class_previous_post_link',10,1);

/** custom widget recent post **/
require get_template_directory() . '/inc/frontend/widgets/recent-posts.php';
/** custom login/register form **/
require get_template_directory() . '/inc/frontend/signin-signup-form.php';