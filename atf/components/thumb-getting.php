<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 12/11/13
 * Time: 7:21 PM
 */

function get_atf_post_thumbnail($width = 900, $height = 400, $crop=true) {
	if (has_post_thumbnail()) {
		global $attachment;
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

		require_once get_template_directory().'/atf/external/aq_resize.php';

		$newUrl = aq_resize($thumb[0], $width, $height, true, true, true);

		return $newUrl;
	}
}

function the_thumbnail_link($size=false, $post_id = null) {
	echo get_thumbnail_link($size, $post_id);
}
function get_thumbnail_link($size=false, $post_id = null) {
	if (has_post_thumbnail()) {
		if (!$size) {
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'post-thumbnail');
			return $thumb[0];
		} else {
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
			return $thumb[0];
		}

	}
}