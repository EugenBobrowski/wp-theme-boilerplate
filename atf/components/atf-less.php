<?php

function atf_enqueue_less_style ( $handle, $srcStyle = false, $srcLess  = false, $compile = false) {
	$fileLessPath = get_template_directory().$srcLess;
	$fileCssPath = get_template_directory().$srcStyle;
	$fileCssUrl = get_template_directory_uri().$srcStyle;
	if ((defined('ATF_LESS') && ATF_LESS == true) || !file_exists($fileCssPath) || $compile) {
		if (file_exists($fileLessPath)) {
			require_once get_template_directory()."/atf/external/less.php/Less.php";
			$less = new Less_Parser();
            $less->parseFile($fileLessPath);
			file_put_contents($fileCssPath, $less->getCss());

			//Notices
			if (is_admin()) {
				$message = '<b>LESS:</b> file <em>'.$srcLess.'</em> compiled to <em>'.$srcStyle.'</em>';
				add_action('admin_notices', 'atf_admin_notice', 10, 1);
				do_action('admin_notices', "<div class='updated below-h2'><p>".$message."</p></div>");
			}
		} else {
			//Notices
			if (is_admin()) {
				$message = '<b>LESS:</b> file <em>'.$srcLess.'</em> not exist';
				add_action('admin_notices', 'atf_admin_notice', 10, 1);
				do_action('admin_notices', "<div class='error below-h2'><p>".$message."</p></div>");
			}
		}

	}
	wp_enqueue_style( $handle, $fileCssUrl);
}

