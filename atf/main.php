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

/**
 * ...
 */

/**
 * Customize Woocommerce and integrate.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/woo-customizing.php';

include 'components/shortcode-gallery-views.php';
include 'components/thumb-getting.php';
include 'components/wp_bootstrap_navwalker.php';
include 'components/breadcrumbs.php';

if ( ! function_exists( 'pagination' ) ) :
	include 'components/bootstrap_pagination.php';
endif;

include 'components/bootstrap_comments.php';

include_once 'components/login-page.php';

if (is_admin()) {
	include_once 'components/link-plugins.php';
}