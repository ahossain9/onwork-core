<?php
get_header();

//Rating
$ratings = onwork_seller_reviews(get_the_ID());
$max = 0;
$n = count($ratings);
if ($ratings) {
    foreach ($ratings as $rate => $count) {
        $max = $max + $count['star'];
    }
    $average_rating = $max / $n;
}

// Project status
$project_table = 'onwork_project_proposals';

if ($wpdb->get_var("SHOW TABLES LIKE '$project_table'") == $project_table) {
    $ongoing_project_query = "SELECT * FROM " . $project_table . " WHERE `seller_id` = '" . get_the_ID() . "' AND status='ongoing'";
    $ongoing_projects = $wpdb->get_results($ongoing_project_query, ARRAY_A);

    $complete_project_query = "SELECT * FROM " . $project_table . " WHERE `seller_id` = '" . get_the_ID() . "' AND status='complete'";
    $complete_projects = $wpdb->get_results($complete_project_query, ARRAY_A);
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


// Service status
$service_table = 'onwork_service_orders';

if ($wpdb->get_var("SHOW TABLES LIKE '$service_table'") == $service_table) {
    $ongoing_service_query = "SELECT * FROM " . $service_table . " WHERE `seller_id` = '" . get_the_ID() . "' AND status='ongoing'";
    $ongoing_services = $wpdb->get_results($ongoing_service_query, ARRAY_A);

    $complete_service_query = "SELECT * FROM " . $service_table . " WHERE `seller_id` = '" . get_the_ID() . "' AND status='complete'";
    $complete_services = $wpdb->get_results($complete_service_query, ARRAY_A);
}


if (count($ongoing_services) > 0) {
    $ongoing_service = count($ongoing_services);
} else {
    $ongoing_service = 0;
}

if (count($complete_services) > 0) {
    $complete_service = count($complete_services);
} else {
    $complete_service = 0;
}

// Get seller services
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} else if (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$services = new WP_Query(array(
    'author__in' => empty(get_users(array('meta_key' => 'seller_id', 'meta_value' => get_the_ID()))) !== true ?  get_users(array('meta_key' => 'seller_id', 'meta_value' => get_the_ID()))[0]->data->ID : '',
    'post_type' => 'services',
    'paged' => $paged,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order'   => 'DESC',
));

$seller_profile_attachment = get_post_meta(get_the_ID(), 'seller_profile_attachment', true);

 ?>

<section class="pt-5 mt-5 pb-5 mb-5 bg-gray">
    <div class="seller-cover" style="background-image: url( <?php echo wp_get_attachment_image_url(onwork_get_image_id(get_post_meta(get_the_ID(), 'seller_cover_attachment', true)), array('1920', '350'), false) ?>);"></div>
    <div class="container">
        <?php while (have_posts()) : the_post();
            // prolancer_profile_views(get_the_id());
        ?>
            <div class="seller-profile mb-5">
                <div class="row">
                    <div class="col-xl-2 my-auto">
                        <?php if (!empty($seller_profile_attachment)) {
                            echo wp_get_attachment_image(onwork_get_image_id(get_post_meta(get_the_ID(), 'seller_profile_attachment', true)), array('250', '250'), false);
                        } else {
                            echo get_avatar(get_post_field('post_author', get_the_ID()), 250);
                        } ?>
                    </div>
                    <div class="col-xl-10 my-auto">
                        <div class="row">
                            <div class="col-xl-7 my-auto">
                                <h3 class="mb-0"><?php echo get_post_meta(get_the_ID(), 'seller_profile_name', true); ?><?php onwork_verification(); ?></h3>
                                <?php //prolancer_badges(get_the_ID()); ?>
                                <h6 class="mb-0 mt-2"><?php echo get_post_meta(get_the_ID(), 'seller_profile_title', true) ?></h6>
                                <p><?php echo esc_html__('Member since', 'prolancer') . ' ' . get_the_date('M Y'); ?></p>
                                <div class="d-xl-none d-md-block mb-3">
                                    <h4>
                                        <?php
                                        if (get_post_meta(get_the_ID(), 'seller_hourly_rate', true)) {
                                            if (function_exists('onwork_get_currency_symbol')) {
                                                echo esc_html(onwork_get_currency_symbol(get_post_meta(get_the_ID(), 'seller_hourly_rate', true)));
                                            }
                                        } ?>
                                    </h4>
                                    <?php echo esc_html__('Hourly rate', 'prolancer'); ?>
                                </div>
                                <div class="stats-list">
                                    <!-- <div class="stats"> -->
                                    <!-- <span><?php
                                                echo esc_html($ongoing_project);
                                                ?></span><?php
                                                    echo esc_html__('Ongoing Project', 'prolancer');
                                                    ?> -->
                                    <!-- </div> -->
                                    <div class="stats">
                                        <span><?php
                                                echo esc_html($ongoing_service);
                                                ?></span><?php
                                                    echo esc_html__('In Queue Service', 'prolancer');
                                                    ?>
                                    </div>
                                    <div class="stats">
                                        <span><?php echo esc_html($complete_project); ?></span><?php echo esc_html__('Complete Project', 'prolancer'); ?>
                                    </div>
                                    <div class="stats">
                                        <span><?php echo esc_html($complete_service); ?></span><?php echo esc_html__('Complete Service', 'prolancer'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 text-center d-none d-xl-block">
                                <h4>
                                    <?php
                                    if (get_post_meta(get_the_ID(), 'seller_hourly_rate', true)) {
                                        if (function_exists('onwork_get_currency_symbol')) {
                                            echo esc_html(onwork_get_currency_symbol(get_post_meta(get_the_ID(), 'seller_hourly_rate', true)));
                                        }
                                    } ?>
                                </h4>
                                <?php echo esc_html__('Hourly rate', 'prolancer'); ?>
                            </div>
                            <div class="col-xl-3">
                                <ul class="list-unstyled mid-meta">
                                    <li>
                                        <?php
                                        $check_if_exist = get_user_meta(get_current_user_id(), 'seller_follow_id_' . get_the_ID(), true);

                                        if ($check_if_exist) { ?>
                                            <a href="#" class="follow-button follow-seller" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('follow_seller_nonce'); ?>"><i class="fad fa-user-check fa-lg"></i><span><?php echo esc_html__('Following', 'prolancer') ?></span></a>
                                        <?php } else { ?>
                                            <a href="#" class="follow-button follow-seller" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('follow_seller_nonce'); ?>"><i class="fad fa-user-plus fa-lg"></i><span><?php echo esc_html__('Follow', 'prolancer') ?></span></a>
                                        <?php } ?>
                                    </li>
                                    <li>
                                        <a href="#" class="message-button" data-bs-toggle="modal" data-bs-target="#message<?php echo get_the_ID(); ?>">
                                            <i class="fad fa-comments-alt fa-lg"></i>
                                            <span><?php echo esc_html__('Message', 'prolancer') ?></span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="text-center">
                                    <div class="star-rating">
                                        <span style="width:<?php if (isset($average_rating)) {
                                                                echo (($average_rating / 5) * 100);
                                                            } ?>%"></span>
                                    </div>
                                    <small>(<?php echo count($ratings) ?> <?php echo esc_html__('Ratings', 'prolancer') ?>)</small>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="message<?php echo get_the_ID(); ?>" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel"><?php echo esc_html__('Send Message to Seller', 'prolancer'); ?></h5>
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
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="<?php if (is_active_sidebar('seller_widgets')) {
                                echo 'col-xl-8';
                            } else {
                                echo 'col-lg-12';
                            } ?>">
                    <div class="white-padding">
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#about-me" role="tab" aria-selected="true"><?php echo esc_html__('About Me', 'prolancer'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#gigs" role="tab" aria-selected="false"><?php echo esc_html__('Active Gigs', 'prolancer'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews" role="tab" aria-selected="false"><?php echo esc_html__('Reviews', 'prolancer'); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="about-me" role="tabpanel">
                                <?php if (!empty(get_the_content())) { ?>
                                    <?php the_content(); ?>
                                <?php } else { ?>
                                    <div class="text-center pt-4 pb-4">
                                        <h3><?php echo esc_html__('There is no description', 'prolancer') ?></h3>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade mt-5" id="gigs" role="tabpanel">
                                <div class="row">
                                    <?php
                                    if ($services->have_posts()) {
                                        while ($services->have_posts()) {
                                            $services->the_post(); ?>
                                            <div class="col-md-6">
                                                <?php //do_action('get_prolancer_service_item', 'style-1'); ?>
                                            </div>
                                        <?php };
                                        wp_reset_postdata();
                                    } else { ?>
                                        <div class="text-center pt-4 pb-4">
                                            <h3><?php echo esc_html__('There is no active gigs', 'prolancer') ?></h3>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="review">
                                    <?php if ($ratings) {
                                        foreach ($ratings as $rating) : ?>
                                            <div class="row">
                                                <div class="col-md-2 col-xs-3 my-auto text-left text-md-center">
                                                    <?php
                                                    $profile_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta($rating['buyer_id'], 'buyer_profile_attachment', true)), array('90', '90'), false);

                                                    if (!empty($profile_image)) {
                                                        echo wp_kses($profile_image, array(
                                                            "img" => array(
                                                                "src" => array(),
                                                                "alt" => array(),
                                                                "class" => array(),
                                                                "style" => array()
                                                            )
                                                        ));
                                                    } else {
                                                        echo get_avatar(get_post_field('post_author', $rating['buyer_id']), 90, null, null);
                                                    } ?>
                                                </div>
                                                <div class="col-md-10 col-xs-9 my-auto">
                                                    <div class="commenter">
                                                        <a href="<?php the_permalink($rating['buyer_id']); ?>"><?php echo esc_html(get_post_meta($rating['buyer_id'], 'buyer_profile_name', true)); ?>
                                                        </a>
                                                        <span><?php echo esc_html(human_time_diff(strtotime($rating['timestamp']), current_time('timestamp'))) . esc_html__(' ago', 'prolancer'); ?></span>
                                                        <div class="stars">
                                                            <div class="star-received">
                                                                <?php for ($i = 0; $i < $rating['star']; $i++) { ?>
                                                                    <i class="fas fa-star"></i>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="star-required">
                                                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                                                    <i class="far fa-star"></i>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0"><?php echo esc_html($rating['review']); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    <?php } else { ?>
                                        <div class="text-center pt-4 pb-4">
                                            <h3><?php echo esc_html__('There is no review', 'prolancer') ?></h3>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (is_active_sidebar('seller_widgets')) { ?>
                    <div class="col-xl-4 position-relative">
                        <aside id="secondary" class="widget-area">
                            <?php dynamic_sidebar('seller_widgets'); ?>
                        </aside>
                    </div>
                <?php } ?>
            </div>
        <?php endwhile; ?>
        <div class="pt-120">
            <h2 class="mb-5"><?php echo esc_html__('Suggested sellers', 'prolancer'); ?></h2>
            <div class="negative-margin-15 sellers" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                <?php
                $services = new WP_Query(array(
                    'post_type' => 'sellers',
                    'posts_per_page' => 5,
                    'order' => 'DESC',
                    'orderby' => 'rand'
                ));

                /* Start the Loop */
                while ($services->have_posts()) : $services->the_post(); ?>
                    <div class="col-md-4">
                        <?php //do_action('get_prolancer_seller_item', 'style-1'); ?>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
