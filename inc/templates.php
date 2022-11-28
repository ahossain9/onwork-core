<?php

// Filter the template with our custom function
function onwork_templates($template)
{

    // if (is_post_type_archive('projects') || is_tax(['project-categories', 'project-seller-type', 'project-duration', 'project-level', 'english-level', 'locations', 'project-label', 'skills', 'languages'])) {
    //     $exists_in_theme = locate_template('onwork-templates/projects/archive.php', false);
    //     if ($exists_in_theme != '') {
    //         return $exists_in_theme;
    //     } else {
    //         return plugin_dir_path(__DIR__) . 'templates/projects/archive.php';
    //     }
    // }

    // if (is_singular('projects')) {
    //     $exists_in_theme = locate_template('onwork-templates/projects/single.php', false);
    //     if ($exists_in_theme != '') {
    //         return $exists_in_theme;
    //     } else {
    //         return plugin_dir_path(__DIR__) . 'templates/projects/single.php';
    //     }
    // }

    // if (is_post_type_archive('services') || is_tax(['service-categories', 'service-english-level', 'service-locations'])) {
    //     $exists_in_theme = locate_template('onwork-templates/services/archive.php', false);
    //     if ($exists_in_theme != '') {
    //         return $exists_in_theme;
    //     } else {
    //         return plugin_dir_path(__DIR__) . 'templates/services/archive.php';
    //     }
    // }

    // if (is_singular('services')) {
    //     $exists_in_theme = locate_template('onwork-templates/services/single.php', false);
    //     if ($exists_in_theme != '') {
    //         return $exists_in_theme;
    //     } else {
    //         return plugin_dir_path(__DIR__) . 'templates/services/single.php';
    //     }
    // }

    // if (is_post_type_archive('buyers') || is_tax(['buyer-departments', 'employees-number', 'buyer-locations'])) {
    //     $exists_in_theme = locate_template('onwork-templates/buyers/archive.php', false);
    //     if ($exists_in_theme != '') {
    //         return $exists_in_theme;
    //     } else {
    //         return plugin_dir_path(__DIR__) . 'templates/buyers/archive.php';
    //     }
    // }

    // if (is_singular('buyers')) {
    //     $exists_in_theme = locate_template('onwork-templates/buyers/single.php', false);
    //     if ($exists_in_theme != '') {
    //         return $exists_in_theme;
    //     } else {
    //         return plugin_dir_path(__DIR__) . 'templates/buyers/single.php';
    //     }
    // }

    // if (is_post_type_archive('sellers') || is_tax(['seller-locations', 'seller-skills', 'seller-type', 'seller-english-level', 'seller-languages'])) {
    //     $exists_in_theme = locate_template('onwork-templates/sellers/archive.php', false);
    //     if ($exists_in_theme != '') {
    //         return $exists_in_theme;
    //     } else {
    //         return plugin_dir_path(__DIR__) . 'templates/sellers/archive.php';
    //     }
    // }

    // if (is_singular('sellers')) {
    //     $exists_in_theme = locate_template('onwork-templates/sellers/single.php', false);
    //     if ($exists_in_theme != '') {
    //         return $exists_in_theme;
    //     } else {
    //         return plugin_dir_path(__DIR__) . 'templates/sellers/single.php';
    //     }
    // }
    if (get_post_meta(get_the_ID(), '_wp_page_template', true) == 'onwork-dashboard.php') {
        if (is_page()) {
            $template_path = plugin_dir_path(__DIR__) . 'inc/' . get_post_meta(get_the_ID())['_wp_page_template'][0];
            if (!empty($template_path) && $template_path != $template) {
                $template = $template_path;
            }
        }
    }

    return $template;
}

add_filter('template_include', 'onwork_templates');


// Add custom template
function onwork_add_page_template_to_dropdown( $templates )
{
    $templates = array_merge(
        $templates,
        array(
            'onwork-dashboard.php' => __( 'Frontend Dashboard', 'onwork-core' )
        )
    );

    return $templates;
}
add_filter( 'theme_page_templates', 'onwork_add_page_template_to_dropdown' );



