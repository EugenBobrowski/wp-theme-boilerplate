<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 12/3/13
 * Time: 6:33 PM
 */

/**
 * @param string $addclass
 * @param string $before
 * @param string $after
 * @deprecated Use {@see bs_pagination} instead
 */
function pagination($addclass = '', $before = '', $after = '')
{
    echo '<div class="text-center">';
    bs_pagination(array(
        'before' => $before,
        'after' => $after,
        'class' => $addclass,
    ));
    echo '</div>';
}

function bs_pagination($args)
{
    $args = wp_parse_args($args, array(
        'before' => '',
        'after' => '',
        'class' => '',
        'prev' => '<span class="glyphicon glyphicon-chevron-left"></span>',
        'next' => '<span class="glyphicon glyphicon-chevron-right"></span>',
        'first' => '<span class="glyphicon glyphicon-step-backward">',
        'last' => '',
        'first_last' => false,
        'prev_next' => true,

    ));


    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ($numposts <= $posts_per_page) {
        return;
    }
    if (empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor($pages_to_show_minus_1 / 2);
    $half_page_end = ceil($pages_to_show_minus_1 / 2);
    $start_page = $paged - $half_page_start;
    if ($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if (($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if ($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if ($start_page <= 0) {
        $start_page = 1;
    }

    echo $args['before'] . '<ul class="pagination ' . $args['class'] . '">';

    if ($paged > 1 && $args['first_last']) {
        echo '<li class="prev"><a href="' . get_pagenum_link() . '" title="First">' . $args['first'] . '</a></li>';
    }

    if ($args['prev_next']) {
        $prev_link = get_previous_posts_link($args['prev']);
        if ($prev_link) {
            echo '<li>' . $prev_link . '</li>';
        } else {
            echo '<li class="disabled"><a href="#">' . $args['prev'] . '</a></li>';
        }
    }


    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $paged) {
            echo '<li class="active"><a href="#">' . $i . '</a></li>';
        } else {
            echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
        }
    }
    if ($args['prev_next']) {
        $next_link = get_next_posts_link($args['next']);
        if ($next_link) {
            echo '<li class="">' . $next_link . '</li>';
        } else {
            echo '<li class="disabled"><a href="#">' . $args['next'] . '</a></li>';
        }
    }



    if ($end_page < $max_page && $args['first_last']) {
        $last_page_text = '<span class="glyphicon glyphicon-step-forward">';
        echo '<li class="next"><a href="' . get_pagenum_link($max_page) . '" title="Last">' . $last_page_text . '</a></li>';
    }
    echo '</ul>' . $args['after'];
}