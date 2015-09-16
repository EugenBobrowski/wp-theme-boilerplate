<?php
/**
 * User: Eugen Bobrowski (eugen)
 * Date: 9/17/13
 * Time: 1:45 PM
 * To change this template use File | Settings | File Templates.
 */
define ('ATF_VERSION', '1.0');





function atf_admin_notice($message) {
	echo $message;
}

include 'components/atf-less.php';
include 'components/atf-tgmpa.php';

include 'options/options.php';





// Register Custom Navigation Walker

register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'THEMENAME' ),
) );


/**
 * ...
 */

//include 'components/user-frontend/user-frontend.php';
include 'components/jcarousel-gallery.php';
include 'components/thumb-getting.php';
include 'components/wp_bootstrap_navwalker.php';
include 'components/breadcrumbs.php';

if ( ! function_exists( 'pagination' ) ) :
	include 'components/bootstrap_pagination.php';
endif;


include 'components/bootstrap_comments.php';

//include 'inc/background.php';


if ( ! function_exists( 'pagination' ) ) :
	include 'inc/bootstrap_pagination.php';
endif;

function custom_login_logo() {
	$headerOpt = getAtfOptions('general');
	if( $headerOpt['logo'] !=''){
		$custom_logo = $headerOpt['logo'];
		echo '<style type="text/css">
	    body.login{background:#fff;}
	    h1 a { background-image:url('. $custom_logo .') !important; height: auto !important; min-height: 70px !important; width: 160px !important; background-size: contain !important; background-position: center center !important;} </style>';
	}
}
add_action('login_head', 'custom_login_logo', 99);

function currsiteurl($login_header_url) {
    return home_url();
}
add_filter('login_headerurl', 'currsiteurl');