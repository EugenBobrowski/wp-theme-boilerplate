<?php


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