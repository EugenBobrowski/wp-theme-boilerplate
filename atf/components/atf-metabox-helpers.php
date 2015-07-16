<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 8/7/14
 * Time: 12:24 PM
 */

if (class_exists('AtfMetaboxHtmlHelper')) {
	class AtfMetaboxHtmlHelper {
		static function intutText () {
			$res = '<div>
		<label><span class="etd-label">
				' . __('Columns', 'dfd'). ':
				</span>
		<input type="text" class="" name="envantoProductDetails[columns]" value="" /></label>
	</div>';
		}
	}
}