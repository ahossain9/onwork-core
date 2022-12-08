<?php

if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} else if (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}


$projects = new WP_Query(array(
    'author__in' => empty(get_users(array('meta_key' => 'buyer_id', 'meta_value' => get_the_ID()))) !== true ?  get_users(array('meta_key' => 'buyer_id', 'meta_value' => get_the_ID()))[0]->data->ID : '',
    'post_type' => 'projects',
    'paged' => $paged,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order'   => 'DESC'
));

// Project status
$project_table = 'onwork_project_proposals';

if ($wpdb->get_var("SHOW TABLES LIKE '$project_table'") == $project_table) {
    $proposal_query = "SELECT * FROM " . $project_table . " WHERE `buyer_id` = '" . get_the_ID() . "' AND status = 'pending'";
    $proposals = $wpdb->get_results($proposal_query, ARRAY_A);

    $ongoing_project_query = "SELECT * FROM " . $project_table . " WHERE `buyer_id` = '" . get_the_ID() . "' AND status='ongoing'";
    $ongoing_projects = $wpdb->get_results($ongoing_project_query, ARRAY_A);

    $complete_project_query = "SELECT * FROM " . $project_table . " WHERE `buyer_id` = '" . get_the_ID() . "' AND status='complete'";
    $complete_projects = $wpdb->get_results($complete_project_query, ARRAY_A);
}

if (count($proposals) > 0) {
    $proposal = count($proposals);
} else {
    $proposal = 0;
}

if (count($ongoing_projects) > 0) {
    $ongoing_project = count($ongoing_projects);
} else {
    $ongoing_project = 0;
}

if (count($complete_projects) > 0) {
    $complete_project = count($complete_projects);
} else {
    $complete_project = 0;
}

$featured_project = get_post_meta(get_the_ID(), 'featured_project', true);
$buyer_id = get_user_meta($post->post_author, 'buyer_id', true);
$buyer_profile_attachment = get_post_meta(get_the_ID(), 'buyer_profile_attachment', true);

$buyer_locations = get_the_terms(get_the_ID(), 'buyer-locations');
$employees_number = get_the_terms(get_the_ID(), 'employees-number');
$buyer_departments = get_the_terms(get_the_ID(), 'buyer-departments');

get_header(); ?>

<section class="pb-5 pt-5 mt-5 mb-5 bg-gray">
    <div class="buyer-cover" style="background-image: url( <?php echo wp_get_attachment_image_url(onwork_get_image_id(get_post_meta(get_the_ID(), 'buyer_cover_attachment', true)), array('1920', '350'), false) ?>);"></div>
    <div class="container">
        <?php while (have_posts()) : the_post();
            //prolancer_profile_views(get_the_id()); 
        ?>
            <div class="buyer-profile mb-5">
                <div class="row">
                    <div class="col-xl-2 my-auto">
                        <?php if (!empty($buyer_profile_attachment)) { ?>
                            <?php echo wp_get_attachment_image(onwork_get_image_id(get_post_meta(get_the_ID(), 'buyer_profile_attachment', true)), array('250', '250'), false) ?>
                        <?php } else {
                            echo get_avatar(get_post_field('post_author', get_the_ID()), 250);
                        } ?>
                    </div>
                    <div class="col-xl-10 my-auto">
                        <div class="row">
                            <div class="col-xl-7 my-auto">
                                <h3 class="mb-0"><?php echo get_post_meta(get_the_ID(), 'buyer_profile_name', true) ?><?php onwork_verification(); ?></h3>
                                <?php //prolancer_badges(get_the_ID()); 
                                ?>
                                <h6 class="mb-0 mt-2"><?php echo get_post_meta(get_the_ID(), 'buyer_profile_title', true) ?></h6>
                                <p><?php echo esc_html__('Member since', 'prolancer') . ' ' . get_the_date('M Y'); ?></p>
                                <ul class="list-inline meta">
                                    <?php if ($buyer_locations) { ?>
                                        <li class="list-inline-item"><i class="fas fa-map-marked-alt"></i><?php echo esc_html($buyer_locations[0]->name); ?></li>
                                    <?php } ?>
                                    <?php if ($employees_number) { ?>
                                        <li class="list-inline-item"><i class="fas fa-users"></i><?php echo esc_html($employees_number[0]->name); ?></li>
                                    <?php } ?>
                                    <?php if ($buyer_departments) { ?>
                                        <li class="list-inline-item"><i class="fas fa-tags"></i><?php echo esc_html($buyer_departments[0]->name); ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="col-xl-2 my-auto">
                                <ul class="list-unstyled mid-meta">
                                    <li>
                                        <?php
                                        $check_if_exist = get_user_meta(get_current_user_id(), 'buyer_follow_id_' . get_the_ID(), true);

                                        if ($check_if_exist) { ?>
                                            <a href="#" class="follow-button follow-buyer" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('follow_buyer_nonce'); ?>"><i class="fad fa-user-check fa-lg"></i><span><?php echo esc_html__('Following', 'prolancer') ?></span></a>
                                        <?php } else { ?>
                                            <a href="#" class="follow-button follow-buyer" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('follow_buyer_nonce'); ?>"><i class="fad fa-user-plus fa-lg"></i><span><?php echo esc_html__('Follow', 'prolancer') ?></span></a>
                                        <?php } ?>
                                    </li>
                                    <li><a href="#" class="message-button" data-bs-toggle="modal" data-bs-target="#message<?php echo get_the_ID(); ?>"><i class="fad fa-comments-alt fa-lg"></i><span><?php echo esc_html__('Message', 'prolancer') ?></span></a></li>
                                </ul>
                                <!-- Modal -->
                                <div class="modal fade" id="message<?php echo get_the_ID(); ?>" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"><?php echo esc_html__('Send Message to Buyer', 'prolancer'); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (is_user_logged_in()) { ?>
                                                    <form id="reply-message-form">
                                                        <textarea id="message" name="message" cols="30" rows="10" class="mb-3"></textarea>
                                                        <a href="#" class="send-message prolancer-btn" data-nonce="<?php echo wp_create_nonce('messages_nonce'); ?>" data-receiver-id="<?php echo get_the_author_meta('ID'); ?>" data-sender-id="<?php echo get_current_user_id(); ?>"><?php echo esc_html__('Send', 'prolancer'); ?></a>
                                                    </form>
                                                <?php } else { ?>
                                                    <p><?php echo esc_html__('Please login to send message',  'prolancer') ?></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <ul class="list-unstyled stats mb-0">
                                    <li><?php echo esc_html__('Proposals:', 'prolancer'); ?><strong class="float-end"><?php echo esc_html($proposal); ?></strong></li>
                                    <li><?php echo esc_html__('Ongoing project:', 'prolancer'); ?><strong class="float-end"><?php echo esc_html($ongoing_project); ?></strong></li>
                                    <li><?php echo esc_html__('Complete project:', 'prolancer'); ?><strong class="float-end"><?php echo esc_html($complete_project); ?></strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="<?php if (is_active_sidebar('buyer_widgets')) {
                                echo 'col-xl-8';
                            } else {
                                echo 'col-lg-12';
                            } ?>">
                    <div class="white-padding">
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#about-me" role="tab" aria-selected="true"><?php echo esc_html__('About Me', 'prolancer'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#project" role="tab" aria-selected="false"><?php echo esc_html__('Active Project', 'prolancer'); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="about-me" role="tabpanel">
                                <?php if (!empty(get_the_content())) { ?>
                                    <?php the_content(); ?>
                                <?php } else { ?>
                                    <div class="text-center pt-4 pb-4">
                                        <h3><?php echo esc_html__('There is no description', 'prolancer') ?></h3>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade mt-5" id="project" role="tabpanel">
                                <?php if ($projects->have_posts()) { ?>
                                    <?php while ($projects->have_posts()) {
                                        $projects->the_post(); ?>
                                        <div class="prolancer-project-item style-2">
                                            <?php if ($featured_project == true) { ?>
                                                <div class="featured-post"><?php echo esc_html__('Featured', 'prolancer') ?><i class="fas fa-bolt"></i></div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-md-1 my-auto">
                                                    <a class="project-buyer" href="<?php echo esc_url(get_the_permalink($buyer_id)) ?>">
                                                        <?php $buyer_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta($buyer_id, 'buyer_profile_attachment', true)), array('170', '170'), false);
                                                        if (!empty($buyer_image)) {
                                                            echo wp_kses($buyer_image, array(
                                                                "img" => array(
                                                                    "src" => array(),
                                                                    "alt" => array(),
                                                                    "style" => array()
                                                                )
                                                            ));
                                                        } else {
                                                            echo get_avatar(get_post_field('post_author', $buyer_id), 170);
                                                        }

                                                        onwork_verification(); ?>
                                                    </a>
                                                </div>
                                                <div class="col-md-6 my-auto">
                                                    <a class="project-title" href="<?php the_permalink(); ?>">
                                                        <h3><?php echo mb_strimwidth(get_the_title(), 0, 50, '..'); ?></h3>
                                                    </a>
                                                    <ul class="list-inline">
                                                        <?php if (get_the_terms(get_the_ID(), 'project-duration')) { ?>
                                                            <li class="list-inline-item"><i class="fad fa-clock"></i> <?php echo esc_html(get_the_terms(get_the_ID(), 'project-duration')[0]->name); ?></li>
                                                        <?php }
                                                        if (get_the_terms(get_the_ID(), 'project-level')) { ?>
                                                            <li class="list-inline-item"><i class="fad fa-signal-alt-3"></i> <?php echo esc_html(get_the_terms(get_the_ID(), 'project-level')[0]->name); ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>

                                                <div class="col-md-2 my-auto text-center">
                                                    <h2>
                                                        <?php $price = get_post_meta(get_the_ID(), 'project_price', true);

                                                        if (function_exists('onwork_get_currency_symbol')) {
                                                            echo esc_html(onwork_get_currency_symbol($price));
                                                        } ?>
                                                    </h2>
                                                    <?php echo esc_html(get_post_meta(get_the_ID(), 'project_type', true)); ?>
                                                </div>
                                                <div class="col-md-3 my-auto">
                                                    <a href="<?php the_permalink(); ?>" class="prolancer-rgb-btn float-lg-end"><?php echo esc_html__('Detail', 'prolancer'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php };
                                    wp_reset_postdata(); ?>
                                <?php } else { ?>
                                    <div class="text-center pt-4 pb-4">
                                        <h3><?php echo esc_html__('There is no projects', 'prolancer') ?></h3>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (is_active_sidebar('buyer_widgets')) { ?>
                    <div class="col-xl-4 position-relative">
                        <aside id="secondary" class="widget-area">
                            <?php dynamic_sidebar('buyer_widgets'); ?>
                        </aside>
                    </div>
                <?php } ?>
            </div>
        <?php endwhile; ?>


        <div class="pt-120">
            <h2 class="mb-5"><?php echo esc_html__('Suggested buyers', 'prolancer'); ?></h2>
            <div class="negative-margin-15 buyers" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                <?php
                $services = new WP_Query(array(
                    'post_type' => 'buyers',
                    'posts_per_page' => 5,
                    'order' => 'DESC',
                    'orderby' => 'rand'
                ));

                /* Start the Loop */
                while ($services->have_posts()) : $services->the_post(); ?>
                    <div class="pr-15 pl-15">
                        <?php //do_action('get_prolancer_buyer_item', 'style-1'); 
                        ?>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
