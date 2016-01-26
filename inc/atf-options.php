<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 9/11/14
 * Time: 6:12 PM
 */
add_filter('get_options_array', 'getOptionsArray' );
function getOptionsArray() {
    return array (
        'general' => array(
            'name' => 'General Settings',
            'desc' => __('General settings'),

            'items' => array(
                'favicon' => array(
                    'type' => 'addMedia',
                    'title' => __('Favicon', 'atf'),
                    'default' => get_template_directory_uri().'/img/favicon.png',
                    'desc' => 'The optimal size for an image is 16x16'
                ),
                'logo' => array(
                    'type' => 'addMedia',
                    'title' => __('Header Logotype image', 'atf'),
                    'default' => get_template_directory_uri().'/img/logo.png',
                ),
                'logo_link' => array(
                    'type' => 'textField',
                    'title' => 'Ссылка логотипа',
                    'default' => 'http://aov.ru',
                    'desc' => 'Оставьте єто поле пустым, если хотите чтобы сайт ссылался на главную.',
                ),

            ),
        ),
        'examples' => array(
            'name' => 'General Settings',
            'desc' => __('General settings'),

            'items' => array(
                'favicon' => array(
                    'type' => 'addMedia',
                    'title' => __('Image', 'atf'),
                    'default' => get_template_directory_uri().'/atf/options/admin/assets/atf-options.png',
                    'desc' => 'addMedia'
                ),
            ),

        ),
    );
}