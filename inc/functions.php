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
include_once(dirname(__FILE__) . '/widgets/widget-filter-by-attribute.php');
include_once(dirname(__FILE__) . '/widgets/widget-recent-posts.php');
include_once(dirname(__FILE__) . '/widgets/widget-seller-details.php');
include_once(dirname(__FILE__) . '/widgets/widget-buyer-details.php');
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
function onwork_style_script()
{
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



// Verification
function onwork_verification()
{
    $verification = json_decode(get_user_meta(get_the_author_meta('ID'), 'verification', true), true);
    if ($verification) {
        if ($verification['verified'] == 'yes') {
            echo '<i class="fa fa-check-circle verified" title="' . esc_attr__('Verified', 'onwork-core') . '"></i>';
        }
    }
}

// Get option list
function onwork_get_option_list($taxonomy, $meta, $post_id)
{
    $current_term = get_the_terms($post_id, $taxonomy)[0]->slug;

    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'orderby'   => 'name',
    ));
    $hierarchy = '';
    $hierarchy = _get_term_hierarchy($taxonomy);

    foreach ($terms as $term) {
        if ($term->parent) {
            continue;
        } ?>
        <option <?php if ($term->slug == $current_term) {
                    echo 'selected ="selected"';
                } ?> value="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>

        <?php if (isset($hierarchy[$term->term_id])) {
            foreach ($hierarchy[$term->term_id] as $child) {
                $child = get_term($child, $taxonomy); ?>

                <option <?php if ($child->slug == $current_term) {
                            echo 'selected ="selected"';
                        } ?> value="<?php echo esc_attr($child->term_id); ?>">- <?php echo esc_html($child->name); ?></option>

                <?php if (isset($hierarchy[$child->term_id])) {
                    foreach ($hierarchy[$child->term_id] as $child2) {
                        $child2 = get_term($child2, $taxonomy); ?>

                        <option <?php if ($child2->slug == $current_term) {
                                    echo 'selected ="selected"';
                                } ?> value="<?php echo esc_attr($child2->term_id); ?>">-- <?php echo esc_html($child2->name); ?></option>

                        <?php if (isset($hierarchy[$child2->term_id])) {
                            foreach ($hierarchy[$child2->term_id] as $child3) {
                                $child3 = get_term($child3, $taxonomy); ?>

                                <option <?php if ($child3->slug == $current_term) {
                                            echo 'selected ="selected"';
                                        } ?> value="<?php echo esc_attr($child3->term_id); ?>">--- <?php echo esc_html($child3->name); ?></option>
                        <?php }
                        } ?>
                <?php }
                } ?>
        <?php }
        } ?>
<?php }
}


// Seller reviews
function onwork_seller_reviews($id)
{
    global $wpdb;
    $review_table = 'onwork_reviews';

    if ($wpdb->get_var("SHOW TABLES LIKE '$review_table'") == $review_table) {
        $query = "SELECT * FROM " . $review_table . " WHERE `seller_id` = '" . $id . "'";
        return $wpdb->get_results($query, ARRAY_A);
    }
}
