<?php

/**
 * Template Name: Dashboard
 */

echo 'Hello World';

/*
 * Remove extra query string when this page is loaded
 */
if (get_post_meta(get_the_ID(), '_wp_page_template', true) == 'onwork-dashboard.php') {
    remove_filter('page_link', 'onwork_append_query_string');
}

if (is_user_logged_in()) {
    $buyer_id = get_user_meta(get_current_user_id(), 'buyer_id', true);
    $seller_id = get_user_meta(get_current_user_id(), 'seller_id', true);

    // Create a user meta and insert data to the "buyers" and "sellers" post type
    if ($buyer_id == "" || $seller_id == "") {
        $buyers = wp_insert_post(array(
            'post_title' => get_userdata(get_current_user_id())->display_name,
            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
            'post_type' => 'buyers'
        ));

        update_user_meta(get_current_user_id(), 'buyer_id', $buyers);
        update_post_meta($buyers, 'buyer_profile_name', get_userdata(get_current_user_id())->display_name);

        $sellers = wp_insert_post(array(
            'post_title' => get_userdata(get_current_user_id())->display_name,
            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
            'post_type' => 'sellers'
        ));

        update_user_meta(get_current_user_id(), 'seller_id', $sellers);
        update_post_meta($sellers, 'seller_profile_name', get_userdata(get_current_user_id())->display_name);
        update_post_meta($sellers, 'is_seller_verified', 0);

        $visit_as = get_user_meta(get_current_user_id(), 'visit_as', true);
        if (empty($visit_as)) {
            update_user_meta(get_current_user_id(), 'visit_as', 'buyer');
        }
    }
}

if (in_array('onwork-core/onwork-core.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    if (is_user_logged_in()) { ?>
        <?php
        $header_exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/header.php', false));

        if ($header_exists_in_theme == true) {
            get_template_part('prolancer-templates/dashboard/header');
        } else {
            include_once plugin_dir_path(__DIR__) . 'templates/dashboard/header.php';
        } ?>
        <div class="container-fluid bg-gray pt-30 pb-100 frontend-dashboard">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <?php
                    $sidebar_exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/sidebar.php', false));

                    if ($sidebar_exists_in_theme == true) {
                        get_template_part('prolancer-templates/dashboard/sidebar');
                    } else {
                        include_once plugin_dir_path(__DIR__) . 'templates/dashboard/sidebar.php';
                    } ?>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <?php
                    // Page routing
                    if (!empty($_GET['fed'])) {
                        $frontendDashboard = $_GET['fed'];


                        if ($frontendDashboard == 'wallet') {
                            $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/wallet/wallet.php', false));

                            if ($exists_in_theme == true) {
                                get_template_part('prolancer-templates/dashboard/wallet/wallet');
                            } else {
                                include_once plugin_dir_path(__DIR__) . 'templates/dashboard/wallet/wallet.php';
                            }
                        } elseif ($frontendDashboard == 'verification') {
                            $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/verification/verification.php', false));

                            if ($exists_in_theme == true) {
                                get_template_part('prolancer-templates/dashboard/verification/verification');
                            } else {
                                include_once plugin_dir_path(__DIR__) . 'templates/dashboard/verification/verification.php';
                            }
                        } elseif ($frontendDashboard == 'disputes') {
                            $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/disputes/disputes.php', false));

                            if ($exists_in_theme == true) {
                                get_template_part('prolancer-templates/dashboard/disputes/disputes');
                            } else {
                                include_once plugin_dir_path(__DIR__) . 'templates/dashboard/disputes/disputes.php';
                            }
                        } elseif ($frontendDashboard == 'message') {
                            $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/message/message.php', false));

                            if ($exists_in_theme == true) {
                                get_template_part('prolancer-templates/dashboard/message/message');
                            } else {
                                include_once plugin_dir_path(__DIR__) . 'templates/dashboard/message/message.php';
                            }
                        }

                        if ($visit_as == 'seller') {
                            if ($frontendDashboard == 'dashboard') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/dashboard.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/dashboard');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/dashboard.php';
                                }
                            } elseif ($frontendDashboard == 'profile') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/profile.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/profile');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/profile.php';
                                }
                            } elseif ($frontendDashboard == 'services') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/services.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/services');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/services.php';
                                }
                            } elseif ($frontendDashboard == 'create-service') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/create-service.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/create-service');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/create-service.php';
                                }
                            } elseif ($frontendDashboard == 'service-details') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/service-details.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/service-details');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/service-details.php';
                                }
                            } elseif ($frontendDashboard == 'ongoing-services') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/ongoing-services.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/ongoing-services');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/ongoing-services.php';
                                }
                            } elseif ($frontendDashboard == 'ongoing-service-details') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/ongoing-service-details.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/ongoing-service-details');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/ongoing-service-details.php';
                                }
                            } elseif ($frontendDashboard == 'cancelled-services') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/cancelled-services.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/cancelled-services');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/cancelled-services.php';
                                }
                            } elseif ($frontendDashboard == 'completed-services') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/completed-services.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/completed-services');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/completed-services.php';
                                }
                            } elseif ($frontendDashboard == 'completed-service-details') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/completed-service-details.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/completed-service-details');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/completed-service-details.php';
                                }
                            } elseif ($frontendDashboard == 'ongoing-projects') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/ongoing-projects.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/ongoing-projects');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/ongoing-projects.php';
                                }
                            } elseif ($frontendDashboard == 'ongoing-project-details') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/ongoing-project-details.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/ongoing-project-details');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/ongoing-project-details.php';
                                }
                            } elseif ($frontendDashboard == 'cancelled-projects') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/cancelled-projects.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/cancelled-projects');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/cancelled-projects.php';
                                }
                            } elseif ($frontendDashboard == 'completed-projects') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/completed-projects.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/completed-projects');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/completed-projects.php';
                                }
                            } elseif ($frontendDashboard == 'completed-project-details') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/completed-project-details.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/completed-project-details');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/completed-project-details.php';
                                }
                            } elseif ($frontendDashboard == 'following-buyers') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/following-buyers.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/following-buyers');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/following-buyers.php';
                                }
                            } elseif ($frontendDashboard == 'payouts') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/payouts/payouts.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/payouts/payouts');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/payouts/payouts.php';
                                }
                            } elseif ($frontendDashboard == 'wishlist-projects') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/seller/wishlist-projects.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/seller/wishlist-projects');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/seller/wishlist-projects.php';
                                }
                            }
                        } elseif ($visit_as == 'buyer') {
                            if ($frontendDashboard == 'dashboard') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/dashboard.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/dashboard');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/dashboard.php';
                                }
                            } elseif ($frontendDashboard == 'profile') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/profile.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/profile');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/profile.php';
                                }
                            } elseif ($frontendDashboard == 'projects') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/projects.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/projects');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/projects.php';
                                }
                            } elseif ($frontendDashboard == 'create-project') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/create-project.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/create-project');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/create-project.php';
                                }
                            } elseif ($frontendDashboard == 'completed-projects') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/completed-projects.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/completed-projects');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/completed-projects.php';
                                }
                            } elseif ($frontendDashboard == 'completed-project-details') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/completed-project-details.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/completed-project-details');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/completed-project-details.php';
                                }
                            } elseif ($frontendDashboard == 'ongoing-projects') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/ongoing-projects.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/ongoing-projects');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/ongoing-projects.php';
                                }
                            } elseif ($frontendDashboard == 'ongoing-project-details') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/ongoing-project-details.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/ongoing-project-details');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/ongoing-project-details.php';
                                }
                            } elseif ($frontendDashboard == 'cancelled-projects') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/cancelled-projects.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/cancelled-projects');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/cancelled-projects.php';
                                }
                            } elseif ($frontendDashboard == 'proposals') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/proposals.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/proposals');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/proposals.php';
                                }
                            } elseif ($frontendDashboard == 'ongoing-services') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/ongoing-services.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/ongoing-services');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/ongoing-services.php';
                                }
                            } elseif ($frontendDashboard == 'ongoing-service-details') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/ongoing-service-details.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/ongoing-service-details');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/ongoing-service-details.php';
                                }
                            } elseif ($frontendDashboard == 'cancelled-services') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/cancelled-services.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/cancelled-services');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/cancelled-services.php';
                                }
                            } elseif ($frontendDashboard == 'completed-services') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/completed-services.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/completed-services');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/completed-services.php';
                                }
                            } elseif ($frontendDashboard == 'following-sellers') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/following-sellers.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/following-sellers');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/following-sellers.php';
                                }
                            } elseif ($frontendDashboard == 'completed-service-details') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/completed-service-details.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/completed-service-details');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/completed-service-details.php';
                                }
                            } elseif ($frontendDashboard == 'wishlist-services') {
                                $exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/buyer/wishlist-services.php', false));

                                if ($exists_in_theme == true) {
                                    get_template_part('prolancer-templates/dashboard/buyer/wishlist-services');
                                } else {
                                    include_once plugin_dir_path(__DIR__) . 'templates/dashboard/buyer/wishlist-services.php';
                                }
                            }
                        }
                    } ?>
                </div>
            </div>
        </div>
        <?php
        $footer_exists_in_theme = file_exists(locate_template('/prolancer-templates/dashboard/footer.php', false));

        if ($footer_exists_in_theme == true) {
            get_template_part('prolancer-templates/dashboard/footer');
        } else {
            include_once plugin_dir_path(__DIR__) . 'templates/dashboard/footer.php';
        } ?>
<?php } else {
        if ($prolancer_login_and_register_page) {
            wp_redirect(get_permalink($prolancer_login_and_register_page));
        } else {
            wp_redirect(home_url());
        }
    }
} else {
    wp_redirect(home_url());
}
