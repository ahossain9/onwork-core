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
// include_once(dirname( __FILE__ ). '/widgets/widget-filter-by-attribute.php');
// include_once(dirname( __FILE__ ). '/widgets/widget-recent-posts.php');
// include_once(dirname( __FILE__ ). '/widgets/widget-seller-details.php');
// include_once(dirname( __FILE__ ). '/widgets/widget-buyer-details.php');

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
