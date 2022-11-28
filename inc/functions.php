<?php

/**
 * onwork_core functions
 * @package Onwork_Core
 * @since 1.0.0
 */

require ONWORK_CORE_DIR_PATH . '/inc/helper-functions.php';
require ONWORK_CORE_DIR_PATH . '/inc/assets-manager.php';
require ONWORK_CORE_DIR_PATH . '/inc/floating-effects.php';
require ONWORK_CORE_DIR_PATH . '/inc/icons-manager.php';
require ONWORK_CORE_DIR_PATH . '/inc/custom-post-types.php';
require ONWORK_CORE_DIR_PATH . '/wp-widgets/about-us.php';
require ONWORK_CORE_DIR_PATH . '/wp-widgets/contact-us.php';
require ONWORK_CORE_DIR_PATH . '/wp-widgets/recent-post.php';
include_once(dirname(__FILE__) . '/metabox.php');
include_once(dirname(__FILE__) . '/db-tables.php');
include_once(dirname(__FILE__) . '/templates.php');


/**
 * Returns page url by template file name
 *
 * @param string $template name of template file including .php
 */
function onwork_get_page_url_by_template($template)
{
    $args = [
        'post_type'  => 'page',
        'fields'     => 'ids',
        'nopaging'   => true,
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template
    ];
    $pages = get_posts($args);
    if ($pages) {
        return get_permalink($pages[0]);
    }
}

/**
 * Returns page id by template file name
 *
 * @param string $template name of template file including .php
 */
function onwork_get_page_id_by_template($template)
{
    $args = [
        'post_type'  => 'page',
        'fields'     => 'ids',
        'nopaging'   => true,
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template
    ];
    $pages = get_posts($args);
    if ($pages) {
        return $pages[0];
    }
}

/*
 * Add extra query string
 */

function onwork_append_query_string($url, $id)
{
    if (onwork_get_page_id_by_template('onwork-dashboard.php') == $id) {
        $url = add_query_arg('fed', '', $url);
    }
    return $url;
}
add_filter('page_link', 'onwork_append_query_string', 10, 2);


// Remove menu items from end users
function onwork_remove_menu_items()
{
    if (!current_user_can('administrator')) {
        remove_menu_page('edit.php?post_type=sellers');
        remove_menu_page('edit.php?post_type=buyers');
        remove_menu_page('edit.php?post_type=payouts');
        remove_menu_page('edit.php?post_type=disputes');
        remove_menu_page('edit.php?post_type=verification');
    };
}
add_action('admin_menu', 'onwork_remove_menu_items');

// Enqueue script
function onwork_style_script() {
    wp_enqueue_style(
        'onwork-dashboard',
        ONWORK_CORE_ASSETS . 'css/dashboard.css',
        null,
        ONWORK_CORE_VERSION
    );

    // JS
    // wp_enqueue_script('sweetalert2', plugin_dir_url(__FILE__) . '../assets/js/sweetalert2.min.js', array('jquery'), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'onwork_style_script');