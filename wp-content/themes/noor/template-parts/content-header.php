<!-- #site-header-open -->
<?php if( is_single() && 'post' == get_post_type() ){ ?>
<header id="site-header" class="site-header <?php noor_post_header_class(); ?>">

    <!-- #header-desktop-open -->
    <?php noor_post_header_builder(); ?>
    <!-- #header-desktop-close -->

    <!-- #header-mobile-open -->
    <?php noor_post_mobile_builder(); ?>
    <!-- #header-mobile-close -->

</header>
<?php }else{ ?>
<header id="site-header" class="site-header <?php noor_header_class(); ?>">

    <!-- #header-desktop-open -->
    <?php noor_header_builder(); ?>
    <!-- #header-desktop-close -->

    <!-- #header-mobile-open -->
    <?php noor_mobile_builder(); ?>
    <!-- #header-mobile-close -->

</header>
<?php } ?>
<!-- #site-header-close -->
<?php if ( !empty( noor_get_option('is_sidepanel') ) && noor_get_option('sidepanel_layout') != '' ) { ?>
<!-- #side-panel-open -->
    <div id="side-panel" class="side-panel <?php if( noor_get_option('panel_left') ) echo 'on-left'; ?>">
        <a href="#" class="side-panel-close otbtn-close"><i class="uil uil-times"></i></a>
        <div class="side-panel-block">
            <?php if ( did_action( 'elementor/loaded' ) ) noor_sidepanel_builder(); ?>
        </div>
    </div>
<!-- #side-panel-close -->
<?php } ?>

<?php 
$page_id = function_exists('rwmb_meta') ? rwmb_meta('promo_switch', "type=switch") : '';
if( noor_get_option('promo_switch') && $page_id ) { ?>
<!-- #promo-popup-open -->
<div class="popup-newsletter popup-form">
    <div class="popup-overlay"></div>
    <div class="popup-inner">
        <a href="#" class="popup-close otbtn-close"><i class="uil uil-times"></i></a>
        <?php if(noor_get_option('popup_img')) { ?>
            <figure class="mb-6"><img src="<?php echo esc_url(noor_get_option('popup_img')); ?>" alt="" /></figure>
        <?php } echo '<h3>'.noor_get_option('popup_title').'</h3>'; ?>
        <?php echo '<p class="mb-6">'.noor_get_option('popup_des').'</p>'; ?>
        <?php echo do_shortcode(''.noor_get_option('code_form').''); ?>
    </div>
</div>
<!-- #promo-popup-close -->
<?php } ?>

<!-- #user-popup-open -->
<?php if( noor_get_option('user_switch') ) { 
    $user_form = ''; 
    if ( function_exists('rwmb_meta') ) $user_form = rwmb_meta('user_switch', "type=switch"); 
    if( is_home() || is_archive() || is_search() || is_singular('post') ){
        $user_form = rwmb_meta('user_switch', "type=switch", get_option( 'page_for_posts' ));
    }
    if( $user_form ){
        echo '<div class="popup-login popup-form"><div class="popup-overlay"></div>'.do_shortcode('[noor_login]').'</div>'; 
        echo '<div class="popup-regis popup-form"><div class="popup-overlay"></div>'.do_shortcode('[noor_register]').'</div>'; 
    }
} ?>
<!-- #user-popup-close -->