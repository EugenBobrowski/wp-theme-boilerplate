<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 12/5/13
 * Time: 6:42 PM
 */

add_shortcode('gallery', 'jcarousel_gallery_shortcode');

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function jcarousel_gallery_shortcode($attr) {

	$post = get_post();

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 */
	wp_enqueue_script( 'jqury-jcarousel', get_template_directory_uri() . '/js/jquery.jcarousel.min.js');
	wp_enqueue_script( 'jqury-jcarousel-conected', get_template_directory_uri() . '/js/jcarousel.connected-carousels.js');




	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery'));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}


	$output = '';
	$navList = '';
	$largeImgList = '';
	foreach ( $attachments as $id => $attachment ) {

		$thumb = wp_get_attachment_image_src($id, 'thumbnail');

		$navList .= '<li><img src="'.$thumb[0].'" width="75" height="75" alt=""></li>';


		$largeImg = wp_get_attachment_image_src($id, 'large');

		$orientation = '';
		if ( isset( $largeImg[1], $largeImg[2] ) )
			$orientation = ( $largeImg[2] > $largeImg[1] ) ? 'portrait' : 'landscape';
		$largeImgList .= '<li><img src="'.$largeImg[0].'" alt="" class="'.$orientation.'">';

		if ( trim($attachment->post_excerpt) ) {
			$largeImgList .= '<div class="caption">' . wptexturize($attachment->post_excerpt) . '</div>';
		}
		$largeImgList .= '</li>';


	}

	$output .= '<div class="connected-carousels">';
	$output .= '    <div class="navigation clearfix">';
	$output .= '        <div class="carousel carousel-navigation">';
	$output .= '            <ul>';

	$output .= $navList;

	$output .= '            </ul>';
	$output .= '		</div>';
	$output .= '		<a href="#" class="prev prev-navigation"><span class="glyphicon glyphicon-chevron-left"></span></a>
						<a href="#" class="next next-navigation"><span class="glyphicon glyphicon-chevron-right"></span></a>';

	$output .= '		</div>';
	$output .= '	<div class="stage">';
	$output .= '		<div class="carousel carousel-stage">';
	$output .= '			<ul>';

	$output .= $largeImgList;

	$output .= '			</ul>';
	$output .= '        </div>';
//	$output .= '        <p class="photo-credits">Photos by <a href="http://www.mw-fotografie.de">Marc Wiegelmann</a></p>';
	$output .= '		<a href="#" class="prev prev-stage"><span><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a href="#" class="next next-stage"><span><span class="glyphicon glyphicon-chevron-right"></span></a>';
	$output .= '	</div>
				</div>';

	return $output;
}

function bootstrap_gallery_shortcode_for_sidebar($attr) {

	$post = get_post();

	require_once get_template_directory().'/atf/external/aq_resize.php';

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery'));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$sliderOpts = getAtfOptions('portfolioSidebar');

	$output = '';
	$navList = '';
	$largeImgList = '';
	$i = 0;
	$carouselId = 'bootstrap-carousel-'.generatePassword();
	foreach ( $attachments as $id => $attachment ) {

		if ($i == 0) {
			$active = 'active';
		} else {
			$active = '';
		}

		$img = wp_get_attachment_image_src($id, 'full');

		$bigImg = aq_resize($img[0], $sliderOpts['img_width'], $sliderOpts['img_height'], true, true, true);
		$smallImg = aq_resize($img[0], $sliderOpts['thumb_width'], $sliderOpts['thumb_height'], true, true, true);

		$largeImgList .= '<div class="item '.$active.'">';
		$largeImgList .= '      <img src="'.$bigImg.'" alt="">';
		$largeImgList .= '</div>';

		$navList .= '<li data-target="#'.$carouselId.'" data-slide-to="'.$i.'" class="'.$active.'">';
		$navList .= '      <img src="'.$smallImg.'" alt="">';
		$navList .= '</li>';

		$i++;


	}


	$output .= '<div id="'.$carouselId.'" class="carousel slide" data-ride="carousel" data-interval="'. $sliderOpts['interval']*1000 .'">';
	$output .= '    <div class="carousel-inner">';
	$output .=          $largeImgList;
	$output .= '    </div>';
	$output .= '    <ol class="carousel-indicators">';
	$output .=          $navList;
	$output .= '    </ol>';
	$output .= '    <a class="left carousel-control" href="#'.$carouselId.'" role="button" data-slide="prev"></a>';
	$output .= '	<a class="right carousel-control" href="#'.$carouselId.'" role="button" data-slide="next"></a>';
	$output .= '</div>';

	return $output;
}

function generatePassword($length = 8){
	$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
	$numChars = strlen($chars);
	$string = '';
	for ($i = 0; $i < $length; $i++) {
		$string .= substr($chars, rand(1, $numChars) - 1, 1);
	}
	return $string;
}