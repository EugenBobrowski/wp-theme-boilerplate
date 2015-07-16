<?php
/**
 * @package WordPress
 * @subpackage ATF
 */
//die('Callfffsdfsd');

define('EVENTS_ASSETS_URL', plugin_dir_url(__FILE__) . 'assets/');
define('EVENTS_VERSION', '1.0');
// custom post type for Events calendar module



add_action("admin_init", "atfolio_customfields");
add_action('save_post', 'save_atfolio_product_details');
add_action('init', 'atfolio_register');
add_action('init', 'atfolio_categories');

function atfolio_register() {

	$labels = array(
		'name'               => __( 'Portfolios' , 'dfd' ),
		'singular_name'      => __( 'Portfolio' , 'dfd' ),
		'add_new'            => __( 'Add New' , 'dfd' ),
		'add_new_item'       => __( 'Add New Portfolio item' , 'dfd' ),
		'edit_item'          => __( 'Edit Portfolio item' , 'dfd' ),
		'new_item'           => __( 'New Portfolio item' , 'dfd' ),
		'all_items'          => __( 'All Portfolio items' , 'dfd' ),
		'view_item'          => __( 'View Portfolio item' , 'dfd' ),
		'search_items'       => __( 'Search Portfolios item' , 'dfd' ),
		'not_found'          => __( 'No products found' , 'dfd' ),
		'not_found_in_trash' => __( 'No products found in the Trash' , 'dfd' ),
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
		'taxonomies'    => array('post_tag', 'atfolio_categories')
	  );
	register_post_type( 'atfolio' , $args );
}



function atfolio_categories(){
	$labels = array(
	    'name' => _x( 'Portfolio Categories', 'taxonomy general name' ),
	    'singular_name' => _x( 'Products Category', 'taxonomy singular name' ),
	    'search_items' =>  __( 'Search Product Categories' ),
	    'all_items' => __( 'All Products Categories' ),
	    'parent_item' => __( 'Parent Category' ),
	    'parent_item_colon' => __( 'Parent Category:' ),
	    'edit_item' => __( 'Edit Product Category' ),
	    'update_item' => __( 'Update Product Category' ),
	    'add_new_item' => __( 'Add Product Category' ),
	    'new_item_name' => __( 'New Product Category' ),
	    'menu_name' => __( 'Product Categories' ),
	  );
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
	);
	register_taxonomy('atfolio_categories', 'atfolio', $args);
}


function atfolio_customfields(){
  add_meta_box("ProductsDetails", __("Products Details"), "set_atfolio_details", "atfolio", "normal", "default");
}
function set_atfolio_details( $post ) {



	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'envantoProduct_meta_box', 'envantoProduct_meta_box_nonce' );
	wp_enqueue_script('jquery');

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */

	$envantoProductDetails = get_post_meta( $post->ID, 'envantoProductDetails', true );

	?>



	<div>
		<label><span class="etd-label">
				<?php echo __('Product ID', 'dfd');?>:
				</span>
		</span>
		<input type="text" class="" name="envantoProductDetails[envID]" value="<?php echo (isset($envantoProductDetails['envID'])) ? $envantoProductDetails['envID'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Short name of theme', 'dfd');?>:
				</span>
		</span>
		<input type="text" class="" name="envantoProductDetails[shortName]" value="<?php echo (isset($envantoProductDetails['shortName'])) ? $envantoProductDetails['shortName'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Theme note', 'dfd');?>:
				</span>
		</span>
		<input type="text" class="" name="envantoProductDetails[note]" value="<?php echo (isset($envantoProductDetails['note'])) ? $envantoProductDetails['note'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Comments on ThemeForest Number', 'dfd');?>:
				</span>
		</span>
		<input type="text" class="" name="envantoProductDetails[commentsNum]" value="<?php echo (isset($envantoProductDetails['commentsNum'])) ? $envantoProductDetails['commentsNum'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Live prewiew link', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[liveLink]" value="<?php echo (isset($envantoProductDetails['liveLink'])) ? $envantoProductDetails['liveLink'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Free Download link', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[freeVersionDownload]" value="<?php echo (isset($envantoProductDetails['freeVersionDownload'])) ? $envantoProductDetails['freeVersionDownload'] : ''; ?>" /></label>
	</div>
	<h3>Theme details</h3>
	<div>
		<label><span class="etd-label">
				<?php echo __('Columns', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[columns]" value="<?php echo (isset($envantoProductDetails['columns'])) ? $envantoProductDetails['columns'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Compatible Browsers', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[compatibleBrowsers]" value="<?php echo (isset($envantoProductDetails['compatibleBrowsers'])) ? $envantoProductDetails['compatibleBrowsers'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Software Version', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[softwareVersion]" value="<?php echo (isset($envantoProductDetails['softwareVersion'])) ? $envantoProductDetails['softwareVersion'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Compatible Width', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[compatibleWidth]" value="<?php echo (isset($envantoProductDetails['compatibleWidth'])) ? $envantoProductDetails['compatibleWidth'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Documentation', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[documentation]" value="<?php echo (isset($envantoProductDetails['documentation'])) ? $envantoProductDetails['documentation'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('High Resolution', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[highResolution]" value="<?php echo (isset($envantoProductDetails['highResolution'])) ? $envantoProductDetails['highResolution'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Layout', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[layout]" value="<?php echo (isset($envantoProductDetails['layout'])) ? $envantoProductDetails['layout'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('ThemeForest Files Included', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[themeForestFilesIncluded]" value="<?php echo (isset($envantoProductDetails['themeForestFilesIncluded'])) ? $envantoProductDetails['themeForestFilesIncluded'] : ''; ?>" /></label>
	</div>
	<div>
		<label><span class="etd-label">
				<?php echo __('Widget Ready', 'dfd');?>:
				</span>
		<input type="text" class="" name="envantoProductDetails[widgetReady]" value="<?php echo (isset($envantoProductDetails['widgetReady'])) ? $envantoProductDetails['widgetReady'] : ''; ?>" /></label>
	</div>

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
	if ( ! isset( $_POST['envantoProduct_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['envantoProduct_meta_box_nonce'], 'envantoProduct_meta_box' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	// Make sure that it is set.
	if ( ! isset( $_POST['envantoProductDetails'] ) ) {
		return;
	}

	// Sanitize user input.
	$envantoProductDetails['envID'] = sanitize_text_field( $_POST["envantoProductDetails"]['envID'] );
	$envantoProductDetails['shortName'] = sanitize_text_field( $_POST["envantoProductDetails"]['shortName'] );
	$envantoProductDetails['note'] = sanitize_text_field( $_POST["envantoProductDetails"]['note'] );
	$envantoProductDetails['liveLink'] = sanitize_text_field( $_POST["envantoProductDetails"]['liveLink'] );
	$envantoProductDetails['freeVersionDownload'] = sanitize_text_field( $_POST["envantoProductDetails"]['freeVersionDownload'] );

	$envantoProductDetails['columns'] = sanitize_text_field( $_POST["envantoProductDetails"]['columns'] );
	$envantoProductDetails['compatibleBrowsers'] = sanitize_text_field( $_POST["envantoProductDetails"]['compatibleBrowsers'] );
	$envantoProductDetails['softwareVersion'] = sanitize_text_field( $_POST["envantoProductDetails"]['softwareVersion'] );
	$envantoProductDetails['compatibleWidth'] = sanitize_text_field( $_POST["envantoProductDetails"]['compatibleWidth'] );
	$envantoProductDetails['documentation'] = sanitize_text_field( $_POST["envantoProductDetails"]['documentation'] );
	$envantoProductDetails['highResolution'] = sanitize_text_field( $_POST["envantoProductDetails"]['highResolution'] );
	$envantoProductDetails['layout'] = sanitize_text_field( $_POST["envantoProductDetails"]['layout'] );
	$envantoProductDetails['themeForestFilesIncluded'] = sanitize_text_field( $_POST["envantoProductDetails"]['themeForestFilesIncluded'] );
	$envantoProductDetails['widgetReady'] = sanitize_text_field( $_POST["envantoProductDetails"]['widgetReady'] );


	update_post_meta($post_id, "envantoProductDetails", $envantoProductDetails );

}
?>