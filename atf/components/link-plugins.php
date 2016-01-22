<?php
/**
 *
 */

add_action('admin_init', 'enqueue_theme_plugins');

function enqueue_theme_plugins () {
    $theme_plugins_dir = get_template_directory() . '/plugins';
    $wp_plugins_dir = WP_CONTENT_DIR . '/plugins';

    if (is_dir($theme_plugins_dir)) {
        $dir = scandir ( $theme_plugins_dir );

        foreach ($dir as $item) {
            $full_path_item = $theme_plugins_dir . '/' . $item;

            if (
                '.' != $item &&  '..' != $item &&
                (
                    !file_exists($wp_plugins_dir . '/' . $item)
                )
            ) {
                symlink($theme_plugins_dir . '/' . $item, $wp_plugins_dir . '/' . $item);
            }

        }

    }

}