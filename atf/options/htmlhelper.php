<?php

class AtfHtmlHelper {
	public static function textField ($args = array()) {
		$default = array(
			'value' => '',
			'class' => 'regular-text',
			'addClass' => '',
		);

		foreach ($default as $key => $value) {
			if (!isset($args[$key])) {
				$args[$key] = $value;
			}
		}
		$result = '<input type="text" id="'.$args['id'].'" name="'.$args['name'].'" value="'.$args['value'].'" class="'.$args['class'].$args['addClass'].'" />';
		if (isset($args['desc'])) {
			$result .= '<p class="description">'.$args['desc'].'</p>';
		}

		return $result;
	}
    public static function typography ($args = array()) {





	}
    public static function googlefont_redux ($args = array()) {

        wp_enqueue_script(
            'redux-opts-googlefonts-js',
            get_template_directory_uri().'/atf/options/admin/fields/google_webfonts/jquery.fontselect.js',
            array('jquery'),
            time(),
            true
        );

		$default = array(
			'value' => '',
			'class' => '',
			'addClass' => '',
		);

		foreach ($default as $key => $value) {
			if (!isset($args[$key])) {
				$args[$key] = $value;
			}
		}

        $result = '<p class="description" style="color:red;">' . __('The fonts provided below are free to use custom fonts from the <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts directory</a>', 'dfd') . '</p>';

        $result .= '<input type="text" id="' . $args['id'] . '" name="' . $args['name'] . '" class="font"  ' . 'value="' . esc_attr($args['value']) . '" />';

        $result .= '<h3 id="' . $args['id'] . '" class="example">Lorem Ipsum is simply dummy text</h3>';

        $result .= (isset($args['desc']) && !empty($args['desc'])) ? ' <span class="description">' . $args['desc'] . '</span>' : '';

        return $result;


	}
    public static function googlefont ($args = array()) {

		$default = array(
			'value' => '',
			'class' => '',
			'addClass' => '',
		);
        $listStr = file_get_contents(get_template_directory().'/atf/options/fontslist.txt');

        $listArray = explode('",'.PHP_EOL.'"', $listStr);

//        foreach ($listArray as $value) {
//            $font = explode(':', $value);
//
//            if (isset($font[1])) {
//                $listArray2[$font[0]][] = $font[1];
//            } else {
//                $listArray2[$font[0]] = '';
//            }
//        }



		foreach ($default as $key => $value) {
			if (!isset($args[$key])) {
				$args[$key] = $value;
			}
		}

        $result = '<div class="google-webfonts">';

        $result .= '';
        $result .= '<select name="'.$args['name'].'">';

        foreach ($listArray as $value) {
            $result .= '<option value="'.$value.'" '.selected($value, $args['value'], false).' > '.str_replace('+', ' ', $value).' </option>';
        }

        $result .= '</select>';
        $result .= '';
        $result .= '';
        $result .= '<div class="demotext"></div>';
        $result .= '';
        $result .= '<input type="text" class="demotextinput" value="Lorem ipsum dolor sit amet">';
        $result .= '';
        $result .= '</div>';


        $result .= (isset($args['desc']) && !empty($args['desc'])) ? ' <span class="description">' . $args['desc'] . '</span>' : '';

        return $result;


	}
	public static function addMedia ($args = array()) {



		$default = array(
			'value' => '',
			'class' => 'regular-text',
			'addClass' => '',
		);

		foreach ($default as $key => $value) {
			if (!isset($args[$key])) {
				$args[$key] = $value;
			}
		}

		$result = '<div class="uploader">';
		$result .= '<input type="hidden" id="'.$args['id'].'" name="'.$args['name'].'" value="'.$args['value'].'" class="'.$args['class'].$args['addClass'].'" />';
		$result .= '<img class="atf-options-upload-screenshot" id="screenshot-'.$args['id'].'" src="'.$args['value'].'" />';
		if($args['value'] == '') {$remove = ' style="display:none;"'; $upload = ''; } else {$remove = ''; $upload = ' style="display:none;"'; }
		$result .= ' <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);"class="atf-options-upload button-secondary"' . $upload . ' rel-id="'.$args['id'].'">' . __('Upload', 'atf') . '</a>';
		$result .= ' <a href="javascript:void(0);" class="atf-options-upload-remove"' . $remove . ' rel-id="'.$args['id'].'">' . __('Remove Upload', 'atf') . '</a>';
		$result .= '</div>';


		if (isset($args['desc'])) {
			$result .= '<p class="description">'.$args['desc'].'</p>';
		}

		return $result;
	}
	public static function colorPicker ($args = array()) {
		$default = array(
			'value' => '',
			'class' => 'color-picker-hex',
			'addClass' => '',
		);

		foreach ($default as $key => $value) {
			if (!isset($args[$key])) {
				$args[$key] = $value;
			}
		}
		$result = '<div class="customize-control-content"><input type="text" id="'.$args['id'].'" name="'.$args['name'].'" value="'.$args['value'].'" class="'.$args['class'].$args['addClass'].'" /></div>';
		if (isset($args['desc'])) {
			$result .= '<p class="description">'.$args['desc'].'</p>';
		}

		return $result;
	}
	public static function textarea ($args  = array()) {
		$default = array(
			'value'     => '',
			'class'     => 'regular-text',
			'addClass'  => '',
			'rows'      => 10,
			'cols'      => 50,
		);
		foreach ($default as $key => $value) {
			if (!isset($args[$key])) {
				$args[$key] = $value;
			}
		}
		$result = '<textarea id="'.$args['id'].'" name="'.$args['name'].'" rows="'.$args['rows'].'" cols="'.$args['cols'].'" class="'.$args['class'].$args['addClass'].'" >'.$args['value'].'</textarea>';
		return $result;
	}
	public static function radioButtons ($args  = array()) {

		$default = array(
			'value' => '',
			'class' => '',
			'addClass' => '',
		);

		foreach ($default as $key => $value) {
			if (!isset($args[$key])) {
				$args[$key] = $value;
			}
		}

		$result = '';
		$result .= '<fieldset class="'.$args['class'].$args['addClass'].'" >';
		foreach ($args['options'] as $value=>$label) {
			$checked = '';
			if ($value == $args['value']) {
				$checked = "checked";
			}


			$result .= '<label class="'.$checked.'" >';
			$result .= '<input type="radio" id="'.$args['id'].'" name="'.$args['name'].'" value="'.$value.'" '.checked($args['value'], $value, false).' />';
			$result .= $label;
			$result .= '</label>';
		}
		$result .= '</fieldset>';

		return $result;
	}
	public static function onOffBox ($args  = array()) {



		$on = '';
		if ($args['value'] == 'true'){
			$on = 'on';
		}
		$result = '<a class="on-off-box '.$on.'" href="#">';
		$result .= '<span class="tumbler"></span>';
		$result .= '<span class="text on">on</span>';
		$result .= '<span class="text off">off</span>';
		$result .= '<input type="radio" class="on" name="'.$args['name'].'" value="1"  '.checked($args['value'], '1', false).' >';
		$result .= '<input type="radio" class="off" name="'.$args['name'].'" value="0" '.checked($args['value'], '0', false).' >';
		$result .= '<span class="text off">off</span>';
		$result .= '</a>';

		if (isset($args['desc'])) {
			$result .= '<p class="description">'.$args['desc'].'</p>';
		}

		return $result;
	}
	public static function select ($args) {
		$result = '<select name="'.$args['name'].'">';

		foreach ($args['values'] as $value=>$text) {
			$result .= '<option value="'.$value.'" '.selected($value, $args['value'], false).' > '.$text.' </option>';
		}

		$result .= '</select>';

		return $result;
	}
	public static function selectFromTaxonomy ($args) {
        if (taxonomy_exists($args['taxonomy'])) {
            $cats = get_terms($args['taxonomy'],
                array(
                    'hide_empty' => $args['hide_empty'],
                ));

            $result = '<select name="'.$args['name'].'">';

            foreach ($cats as $cat) {
                $result .= '<option value="'.$cat->term_id.'" '.selected($cat->term_id, $args['value'], false).' > '.$cat->name.' </option>';
            }

            $result .= '</select>';

            return $result;
        } else {
            var_dump(get_taxonomies());
            return "Taxonomy not exist";
        }
	}
	public static function checkboxTaxonomy ($args) {

        if (taxonomy_exists($args['taxonomy'])) {
            $cats = get_terms($args['taxonomy'],
                array(
                    'hide_empty' => $args['hide_empty'],
                ));

            $result = '';

            foreach ($cats as $cat) {
                $result .= ' <label><input type="checkbox"'
                    .' name="'.$args['name'].'[]"'
                    .' value="'.$cat->term_id.'" ';
                $result .= (in_array($cat->term_id, $args['value'])) ? 'checked="checked"' : '';
                $result .= ' > '.$cat->name.'</label> ';

            }

            $result .= '';

            return $result;
        } else {
            var_dump(get_taxonomies());
            return "Taxonomy not exist";
        }

	}
	public static function info ($args  = array()) {
		echo 'info';
	}

}