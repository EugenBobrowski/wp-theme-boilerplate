<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 12/11/13
 * Time: 7:21 PM
 */

function the_sc_post_thumbnail() {
	if (has_post_thumbnail()) {
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');

		$thumb_alt = trim(strip_tags( $attachment->post_excerpt ));
		$thumb_title = trim(strip_tags( $attachment->post_title ));

		echo '<img src="'.$thumb[0].'" alt="'.$thumb_alt.'" title="'.$thumb_title.'" class="featured-post-image"/>';
	}
	//echo get_the_post_thumbnail( null, $size, $attr );
}

function the_sc_post_thumbnail_as_css_bg() {
	if (has_post_thumbnail()) {
		global $attachment;
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');

		$thumb_alt = trim(strip_tags( $attachment->post_excerpt ));
		$thumb_title = trim(strip_tags( $attachment->post_title ));

		echo '<div style="background-image:url('.$thumb[0].')" class="featured-post-image-as-css-bg"/>';
		echo '<img src="'.$thumb[0].'" alt="'.$thumb_alt.'" title="'.$thumb_title.'"/>';
		echo '</div>';
	}
	//echo get_the_post_thumbnail( null, $size, $attr );
}

function get_atf_post_thumbnail($width = 900, $height = 400) {
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