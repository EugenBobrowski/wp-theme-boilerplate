<?php
/**
 * Plugin Name: Events Calendar
 * Plugin URI: http://example.com/widget
 * Description: A widget that serves as an example for developing more advanced widgets.
 * Version: 0.1
 * Author: dianuj
 * Author URI: http://stackoverflow.com/users/853360/dianuj
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
//die('Callfffsdfsd');

define('EVENTS_ASSETS_URL', plugin_dir_url(__FILE__) . 'assets/');
define('EVENTS_VERSION', '1.0');
// custom post type for Events calendar module



add_action("admin_init", "atfolio_customfields");
add_action('save_post', 'save_atfolio_product_details');
//add_action('init', 'atfolio_categories');
add_action('init', 'atfolio_register');


function atfolio_register() {

	$labels = array(
		'name'               => __( 'Portfolios' , 'atf' ),
		'singular_name'      => __( 'Portfolio' , 'atf' ),
		'add_new'            => __( 'Add New' , 'atf' ),
		'add_new_item'       => __( 'Add New Portfolio item' , 'atf' ),
		'edit_item'          => __( 'Edit Portfolio item' , 'atf' ),
		'new_item'           => __( 'New Portfolio item' , 'atf' ),
		'all_items'          => __( 'All Portfolio items' , 'atf' ),
		'view_item'          => __( 'View Portfolio item' , 'atf' ),
		'search_items'       => __( 'Search Portfolios item' , 'atf' ),
		'not_found'          => __( 'No products found' , 'atf' ),
		'not_found_in_trash' => __( 'No products found in the Trash' , 'atf' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Portfolios'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'tags', 'sticky', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'menu_icon'     => get_template_directory_uri() . '/atf/assets/imgs/portfolio-20px.png',
		'taxonomies'    => array('post_tag', 'atfolio_categories'),
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'portfolio'),
	  );
	register_post_type( 'atfolio' , $args );
}



//function atfolio_categories(){
//	$labels = array(
//	    'name' => _x( 'Portfolio Categories', 'taxonomy general name' ),
//	    'singular_name' => _x( 'Products Category', 'taxonomy singular name' ),
//	    'search_items' =>  __( 'Search Product Categories' ),
//	    'all_items' => __( 'All Products Categories' ),
//	    'parent_item' => __( 'Parent Category' ),
//	    'parent_item_colon' => __( 'Parent Category:' ),
//	    'edit_item' => __( 'Edit Product Category' ),
//	    'update_item' => __( 'Update Product Category' ),
//	    'add_new_item' => __( 'Add Product Category' ),
//	    'new_item_name' => __( 'New Product Category' ),
//	    'menu_name' => __( 'Product Categories' ),
//	  );
//	$args = array(
//		'hierarchical' => true,
//		'labels' => $labels,
//		'publicly_queryable' => true,
//		'public' => true,
//		'query_var' => true,
//		'rewrite' => array('slug' => 'portfolios'),
//	);
//	register_taxonomy('atfolio_categories', 'atfolio products', $args);
//}


function atfolio_customfields(){
  add_meta_box("ProductsDetails", __("Products Details"), "set_atfolio_details", "atfolio", "normal", "default");
}

function set_atfolio_details( $post ) {



	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'atfolio_meta_box', 'atfolio_meta_box_nonce' );
	wp_enqueue_script('jquery');

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */

	$atfolioDetails = get_post_meta( $post->ID, "atfolioDetails", true );

	foreach (returnMetaboxFields() as $field) {
		?>
		<div>
			<label><span class="etd-label">
				<?php echo $field['label'];?>:
				</span>
				<input type="text" class="" name="atfolioDetails[<?php echo $field['name'];?>]" value="<?php echo (isset($atfolioDetails[$field['name']])) ? $atfolioDetails[$field['name']] : ''; ?>" /></label>
		</div>
		<?php
	}

	?>



	<script type="text/javascript">
	    jQuery(function($) {
//		    var $ = jQuery;
		    $('.etd-label').css('display', 'inline-block');
		    var maxWidth = 0
		    $('.etd-label').each(function(){
			    cur = $(this).width();
			    if (cur > maxWidth) {
				    maxWidth = cur
			    }
		    });
			$('.etd-label').width(maxWidth);
	    });
	</script>
  <?php

}
function save_atfolio_product_details($post_id){



	// Check if our nonce is set.
	if ( ! isset( $_POST['atfolio_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['atfolio_meta_box_nonce'], 'atfolio_meta_box' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	// Make sure that it is set.
	if ( ! isset( $_POST['atfolioDetails'] ) ) {
		return;
	}

	$atfolioDetails = array();
	foreach (returnMetaboxFields() as $field) {
		// Sanitize user input.
		$atfolioDetails[$field['name']] = sanitize_text_field( $_POST["atfolioDetails"][$field['name']] );
	}

	update_post_meta($post_id, "atfolioDetails", $atfolioDetails );

}
function returnMetaboxFields() {
	return array(
		array(
			'name' => 'customer',
			'type' => 'text',
			'label' => __('Customer', 'atf'),
		),
		array(
			'name' => 'place',
			'type' => 'text',
			'label' => __('Place', 'atf'),
		),

	);
}