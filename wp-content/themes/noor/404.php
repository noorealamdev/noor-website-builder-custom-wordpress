<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<?php

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	noor_404_builder();
}

//$username = esc_sql($_REQUEST['username']);
//$password = esc_sql($_REQUEST['password']);
//$remember = esc_sql($_REQUEST['rememberme']);
//$username = 'admin';
//$password = '123456';
//$remember = false;
//$remember = ($remember) ? "true" : "false";
//$login_data = array();
//$login_data['user_login'] = $username;
//$login_data['user_password'] = $password;
//$login_data['remember'] = $remember;
//$user_verify = wp_signon($login_data, true);
//if (is_wp_error($user_verify)) {
//    echo 'Invalid username or password. Please try again!';
//} else {
//    wp_clear_auth_cookie();
//    wp_set_current_user($user_verify->ID);
//    wp_set_auth_cookie($user_verify->ID);
//    wp_redirect(home_url() . '/wp-admin');
//    //exit;
//}

?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>