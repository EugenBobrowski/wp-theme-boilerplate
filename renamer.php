<?php
/**
 * Created by PhpStorm. Recursively
 * User: eugen
 * Date: 5/4/15
 * Time: 10:59 PM
 *
 * http://site.loc/wp-content/themes/twentyfifteen/rename.php
 */
$search = array(
    'Twenty Fifteen',  'twentyfifteen'
);
$replace = array(
    'WP Theme Boilerplate',  'wpthemeboilerplate'
);
function scanpudindir($path, $search, $replace) {
    echo '<ul>';
    $items = scandir($path);
    foreach ($items as $item) {
        $path_item = $path.'/'.$item;
        if ($item == '.' || $item == '..') {
//            echo $item;
        } elseif (realpath($path_item) == __FILE__ ) {
            echo '<li>';
            echo '<em>THIS FILE '.__FILE__.'</em>';
            echo '</li>';
        } elseif (is_dir($path_item)) {
            echo '<li>';
            echo '<strong>'.$item.'</strong>';
            $path_item = renamefiles($path, $item, $search, $replace);
            scanpudindir($path_item, $search, $replace);
            echo '</li>';
        } else {
            echo '<li>';
            echo '<em>'.$item.'</em>';
            $path_item = renamefiles($path, $item, $search, $replace);
            $content = file_get_contents($path_item);
            $new_content = str_replace($search, $replace, $content);
            if ($new_content != $content && file_put_contents($path_item, $new_content)) {
                echo ' [REPLACED] ';
            }
            echo '</li>';
        }
    }
    echo '</ul>';
}
function renamefiles($path, $item, $search, $replace){
    $new_name = str_replace($search, $replace, $item);
    if ($new_name != $item && rename($path.'/'.$item, $path.'/'.$new_name)) {
        echo ' >> '.$new_name;
        return $path.'/'.$new_name;
    } else {
        return $path.'/'.$item;
    }
}
scanpudindir('.', $search, $replace);