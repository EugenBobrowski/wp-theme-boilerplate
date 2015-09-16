<?php

class AtfOptionsAdmin {
	protected $plugin_screen_hook_suffix = null;
	protected $optionsSlug = 'atf-options';
	protected static $instance = null;
	public $optionsArray;

	private function __construct() {

		if (isset($_POST[AFT_OPTIONS_PREFIX])) {
			add_action('admin_menu', array($this, 'save_options'));
		}
		// Add the options page and menu item.
		add_action('admin_menu', array($this, 'add_plugin_admin_menu'));

		// Load admin style sheet and JavaScript.
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));


	}

	public static function get_instance() {



		// If the single instance hasn't been set, set it now.
		if (null == self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function enqueue_admin_styles() {

		if (!isset($this->plugin_screen_hook_suffix)) {
			return;
		}

		$screen = get_current_screen();
		if ($screen->id == $this->plugin_screen_hook_suffix) {

			wp_enqueue_style( 'wp-color-picker' );



		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if (!isset($this->plugin_screen_hook_suffix)) {
			return;
		}

		$screen = get_current_screen();
		$atfOptionsIs = strpos($screen->id, str_replace('toplevel', '', $this->plugin_screen_hook_suffix));
		if ($atfOptionsIs !== false) {
			wp_enqueue_script(
                $this->optionsSlug . '-admin-script',
                get_template_directory_uri().'/atf/options/admin/assets/admin.js',
                array('jquery', 'wp-color-picker'),
                time(),
                true
            );

			wp_enqueue_script(
				'atf-options-field-upload-js',
				get_template_directory_uri().'/atf/options/admin/assets/field_upload.js',
				array('jquery'),
				time(),
				true
			);
			wp_enqueue_media();
			wp_localize_script($this->optionsSlug . '-admin-script', 'redux_upload', array('url' => get_template_directory_uri().'/atf/options/admin/assets/blank.png'));

		}
	}

	public function add_plugin_admin_menu() {
		$this->optionsArray = getOptionsArray();
		$this->plugin_screen_hook_suffix = add_menu_page(
			__('Theme Options', 'atf'),
			__('Theme Options', 'atf'),
			'edit_theme_options',
			'atf-options',
			array($this, 'display_plugin_admin_page'),
			get_template_directory_uri().'/atf/options/admin/assets/redvorona.png'//$icon_url,
			//$position
		);
		foreach (getOptionsArray() as $sectID=>$section) {
			//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
			add_submenu_page('atf-options', __('Theme Options', 'atf'), $section['name'], 'edit_theme_options', 'atf-options-' .$sectID, array($this, 'display_plugin_admin_page'));
		}


	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
//		$this->optionsArray = getOptionsArray();
		atf_enqueue_less_style('options-style', '/atf/options/admin/assets/options.css', '/atf/options/admin/assets/options.less', true);
		include 'views/admin.php';
		add_action('admin_footer_text', array($this, 'admin_footer_text'));
	}
	public function save_options() {

		// Check if our nonce is set.
		if ( ! isset( $_POST['update-atfOptions'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['update-atfOptions'], 'update-atfOptions' ) ) {
			return;
		}

		// Make sure that it is set.
		if ( ! isset( $_POST[AFT_OPTIONS_PREFIX] ) ) {
			return;
		}

        $optionsArray = getOptionsArray();

        var_dump($_POST[AFT_OPTIONS_PREFIX]);

		foreach($_POST[AFT_OPTIONS_PREFIX] as $key=>$value) {
            if (isset($optionsArray[$key]['function']) && function_exists($optionsArray[$key]['function'])) {
                $optionsArray[$key]['function']($value);
            }
			update_option(AFT_OPTIONS_PREFIX.$key, $value);
		}
	}
	public function admin_footer_text($footer = '') {
		echo '<span id="footer-thankyou"><img src="'.get_template_directory_uri().'/atf/options/admin/assets/AlgirithmicsTF.png'.'" style="height: 50px;vertical-align: middle;" > Created by <a href="http://atf.li" >ATF</a>. Version '.ATF_VERSION.' </span>';
	}
}