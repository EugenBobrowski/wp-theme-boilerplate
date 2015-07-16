<?php
define( 'AFT_OPTIONS_POST_INDEX', 'atfOptions');
define( 'AFT_OPTIONS_PREFIX', 'atfOptions_');
// here will be the geting options class


class AtfOptions {
	public $defaults;
	function __construct($optionsArray){
		$this->defaults = $optionsArray;
	}
	function get($sectionName) {
		var_dump($this->defaults[$sectionName]['items']);
		$options = get_option(AFT_OPTIONS_PREFIX.$sectionName);
		foreach ($this->defaults[$sectionName]['items'] as $itemId => $item ) {
			if(!isset($options[$itemId])) {
				$options[$itemId] = $item['default'];
			}
		}
	}
}
function get_atf_options($sectionName) {
	$optionsArray = getOptionsArray();
	$options = get_option(AFT_OPTIONS_PREFIX.$sectionName);
	if (!is_array($options)) $options = array();
	foreach ($optionsArray[$sectionName]['items'] as $itemId => $item ) {
		if(!isset($options[$itemId]) && isset($item['default'])) {
			$options[$itemId] = $item['default'];
		}
	}
	return $options;
}
// Depricated
function getAtfOptions($sectionName) {
	return get_atf_options($sectionName);
}


if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) && function_exists('getOptionsArray')) {
	require_once( plugin_dir_path( __FILE__ ) . 'admin/options_admin.php' );
	AtfOptionsAdmin::get_instance(getOptionsArray());
}



?>