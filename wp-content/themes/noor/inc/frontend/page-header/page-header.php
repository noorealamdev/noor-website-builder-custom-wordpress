<?php
if ( ! function_exists( 'noor_page_header' ) ) {
    function noor_page_header (){
        $pheader = '';
        if ( function_exists('rwmb_meta') ) {
            $pheader = rwmb_meta('pheader_switch');
            if( is_home() || is_archive() || is_search() ){
                $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'page_for_posts' ));
            }
            if( class_exists( 'woocommerce' ) ){
                if( is_shop() || is_product_category() || is_product_tag() || is_product() ){
                    $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'woocommerce_shop_page_id' ));
                }
            }
            if( !$pheader ){
                return;
            }
        }
        if( !noor_get_option('pheader_switch') && !$pheader ) {
            return;
        }else{
            $bg     = '';
            $title  = '';
            $output = array();

            if ( is_home() ) {
                $title = get_the_title(get_option('page_for_posts'));
            } elseif ( is_search() ) {
                $title = esc_html__('Search Results for: ', 'noor') . get_search_query();
            } elseif ( is_archive() ) {
                $title = get_the_archive_title();
            } elseif ( is_singular('post') ) {
                $title = noor_get_option( 'ptitle_post' ) ? noor_get_option( 'ptitle_post' ) : get_the_title();
            }else {
                $title = get_the_title();
            }
            
            if (!function_exists('rwmb_meta')) {
                $bg = noor_get_option( 'pheader_img' );
            } else {
                if( is_home() || is_archive() || is_search() ) {
                    $images = rwmb_meta('pheader_bg_image', "type=image", get_option( 'page_for_posts' ));
                }elseif( class_exists( 'woocommerce' ) ){
                    if( is_shop() || is_product_category() || is_product_tag() || is_product() ){
                        $images = rwmb_meta('pheader_bg_image', "type=image", get_option( 'woocommerce_shop_page_id' ));
                    }else{
                        $images = rwmb_meta('pheader_bg_image', "type=image");
                    }
                }else{
                    $images = rwmb_meta('pheader_bg_image', "type=image");
                }
                if (!$images) {
                    $bg = noor_get_option( 'pheader_img' );
                } else {
                    foreach ($images as $image) {
                        $bg = $image['full_url'];
                        break;
                    }
                }
            }

            if ($title) {
                $output[] = sprintf('%s', $title);
            }
        ?>        
            <div class="page-header dtable <?php echo esc_attr( noor_get_option( 'pheader_align' ) ); ?>" <?php if ($bg) { ?> style="background-image: url(<?php echo esc_url($bg); ?>);" <?php } ?>>
                <div class="dcell">
                    <div class="container">
                        <?php if( class_exists( 'woocommerce' ) && is_woocommerce() ) { ?>
                            <?php if( !is_product() ){ ?>
                                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                                    <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                                <?php endif; ?>                            
                            <?php }else{ ?>
                                <h2 class="page-title"><?php echo esc_html( noor_get_option( 'page_title_product' ) ); ?></h2>
                            <?php } ?>    
                            <?php do_action( 'noor_woocommerce_breadcrumb' ); ?>
                        <?php }else{ ?>
                            <h1 class="page-title"><?php echo implode('', $output); ?></h1>
                        <?php 
                            if( is_home() || is_archive() || is_search() ){
                                if( noor_get_option( 'blog_subtitle' ) ) { 
                                    echo '<p class="lead">'.noor_get_option( 'blog_subtitle' ).'</p>'; 
                                }else{ 
                                    echo noor_breadcrumbs(); 
                                }
                            }else{
                                echo noor_breadcrumbs();
                            }
                        } ?>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}