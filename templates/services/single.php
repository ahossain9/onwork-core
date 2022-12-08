<?php

global $post;
global $wpdb;

$seller_id = get_user_meta($post->post_author, 'seller_id', true);
$attachments = get_post_meta(get_the_ID(), 'service_attachments', false);
$packages = json_decode(get_post_meta(get_the_ID(), 'packages', true), true);
$faqs =  json_decode(stripslashes(get_post_meta(get_the_ID(), 'service_faqs', true)), true);
$additional_services =  json_decode(stripslashes(get_post_meta(get_the_ID(), 'additional_services', true)), true);

if ($packages) {
    foreach ($packages as $key => $package) {
        $features = $package['features'];
    }
}

if ($attachments) {
    foreach ($attachments as $attachment) {
        if ($attachment) {
            $image_ids = array_keys($attachment);
        }
    }
}

// Review
$table = 'prolancer_reviews';

if ($wpdb->get_var("SHOW TABLES LIKE ${table}") == $table) {
    $query = "SELECT * FROM ${table} WHERE `project_id` = '" . get_the_ID() . "' AND `type` ='service'";
    $reviews = $wpdb->get_results($query, ARRAY_A);
}

$seller_locations = get_the_terms($seller_id, 'seller-locations');
$seller_languages = get_the_terms($seller_id, 'seller-languages');
$seller_english_level = get_the_terms($seller_id, 'seller-english-level');
$seller_skills = get_the_term_list($seller_id, 'seller-skills', '', ' ');

get_header(); ?>

<section class="pt-120 pb-95">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php
                while (have_posts()) : the_post();
                    if (function_exists('setPostViews')) {
                        setPostViews(get_the_id());
                    } ?>

                    <div class="row service-meta-cards mb-3">
                        <div class="col-xl-4 col-md-6">
                            <div class="service-meta">
                                <div class="my-auto">
                                    <i class="fad fa-id-card-alt"></i>
                                </div>
                                <div class="my-auto">
                                    <span><?php echo esc_html__('Delivery Time', 'prolancer'); ?></span>
                                    <h6>
                                        <?php if (get_term_by('id', $packages[0]['delivery_time'], 'delivery-time')) {
                                            echo esc_html(get_term_by('id', $packages[0]['delivery_time'], 'delivery-time')->name);
                                        } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="service-meta">
                                <div class="my-auto">
                                    <i class="fad fa-language"></i>
                                </div>
                                <div class="my-auto">
                                    <span><?php echo esc_html__('English Level', 'prolancer'); ?></span>
                                    <h6>
                                        <?php if (get_the_terms(get_the_ID(), 'service-english-level')) {
                                            echo esc_html(get_the_terms(get_the_ID(), 'service-english-level')[0]->name);
                                        } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="service-meta">
                                <div class="my-auto">
                                    <i class="fad fa-globe-europe"></i>
                                </div>
                                <div class="my-auto">
                                    <span><?php echo esc_html__('Locations', 'prolancer'); ?></span>
                                    <h6>
                                        <?php if (get_the_terms(get_the_ID(), 'service-locations')) {
                                            echo esc_html(get_the_terms(get_the_ID(), 'service-locations')[0]->name);
                                        } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-slider">
                        <?php
                        if (isset($image_ids)) {
                            foreach ($image_ids as $image_id) { ?>
                                <div>
                                    <img src="<?php echo esc_url(wp_get_attachment_image_src($image_id, 'prolancer-1280x720', true)[0]); ?>" alt="Img">
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="row service-slider-nav">
                        <?php
                        if (isset($image_ids)) {
                            foreach ($image_ids as $image_id) { ?>
                                <div>
                                    <img src="<?php echo esc_url(wp_get_attachment_image_src($image_id, 'prolancer-300x150', true)[0]); ?>" alt="Img">
                                </div>
                        <?php }
                        } ?>
                    </div>

                    <div class="service-single-content">
                        <?php
                        the_content();

                        if (true == $prolancer_service_details_navigation) {
                            the_post_navigation(array(
                                'prev_text' => esc_html__('&#171; Previous Service', 'prolancer'),
                                'next_text' => esc_html__('Next Service &#187;', 'prolancer')
                            ));
                        }
                        ?>
                    </div>

                    <?php if ($packages) { ?>
                        <div class="mt-5">
                            <h2 class="mb-5"><?php echo esc_html__('Packages', 'prolancer'); ?></h2>
                            <div class="packages table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="align-bottom"><?php echo esc_html__('Features', 'prolancer') ?></th>
                                            <?php foreach ($packages as $package) { ?>
                                                <th scope="col">
                                                    <h3 class="price" data-price="<?php echo esc_attr($package['price']) ?>"><?php if (class_exists('WooCommerce')) {
                                                                                                                                    echo esc_html(get_woocommerce_currency_symbol());
                                                                                                                                } ?><span><?php if ($package) {
                                                                                                                                                echo esc_html($package['price']);
                                                                                                                                            } ?></span></h3>
                                                    <h5><?php echo esc_html($package['name']) ?></h5>
                                                    <p><?php echo esc_html($package['description']) ?></p>
                                                </th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><?php echo esc_html__('Delivery Time', 'prolancer') ?></th>
                                            <?php foreach ($packages as $package) { ?>
                                                <td>
                                                    <p><?php if (get_term_by('id', $package['delivery_time'], 'delivery-time')) {
                                                            echo esc_html(get_term_by('id', $package['delivery_time'], 'delivery-time')->name);
                                                        } ?></p>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php echo esc_html__('Revisions', 'prolancer') ?></th>
                                            <?php foreach ($packages as $package) { ?>
                                                <td>
                                                    <p><?php echo esc_html($package['revision']) ?></p>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                        <?php
                                        if ($features) {
                                            foreach ($features as $key => $feature) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo esc_html(ucwords(str_replace('packagefeature', '', str_replace('_', ' ', $key)))) ?></th>
                                                    <?php foreach ($feature as $key => $value) { ?>
                                                        <td>
                                                            <?php if ($value == 'yes') { ?>
                                                                <i class="far fa-check"></i>
                                                            <?php } else { ?>
                                                                <i class="far fa-times"></i>
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                        <?php }
                                        } ?>

                                        <tr>
                                            <th scope="row"><?php echo esc_html__('Price', 'prolancer') ?></th>
                                            <?php foreach ($packages as $package) { ?>
                                                <td>
                                                    <p class="price" data-price="<?php echo esc_attr($package['price']) ?>"><?php if (class_exists('WooCommerce')) {
                                                                                                                                echo esc_html(get_woocommerce_currency_symbol());
                                                                                                                            } ?><span><?php echo esc_html($package['price']) ?></span></p>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                        <tr>
                                            <th scope="row"><?php echo esc_html__('Total', 'prolancer') ?></th>
                                            <?php foreach ($packages as $key => $package) { ?>
                                                <td>
                                                    <a href="#" class="order-service price" data-package-id="<?php echo esc_attr($key); ?>" data-service-id="<?php echo get_the_ID() ?>" data-additional-service-ids="" data-price="<?php echo esc_attr($package['price']) ?>" data-nonce="<?php echo wp_create_nonce('order_service_nonce'); ?>"><?php echo esc_html__('Order ', 'prolancer') ?><?php if (class_exists('WooCommerce')) {
                                                                                                                                                                                                                                                                                                                                                                                                        echo esc_html(get_woocommerce_currency_symbol());
                                                                                                                                                                                                                                                                                                                                                                                                    } ?><span><?php echo esc_html($package['price']) ?></span></a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($additional_services)) { ?>
                        <div class="additional-services mt-5">
                            <h2 class="mb-5"><?php echo esc_html__('Add Extra Services', 'prolancer'); ?></h2>
                            <form id="additional-service-form">
                                <?php
                                if (!empty($additional_services)) {
                                    foreach ($additional_services as $key => $additional_service) { ?>
                                        <div class="additional-service-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <div class="d-flex">
                                                        <div>
                                                            <input type="checkbox" class="form-check-input" data-service-id="<?php echo get_the_ID() ?>" data-nonce="<?php echo wp_create_nonce('additional_service_nonce'); ?>" name="additional_services[]" value="<?php echo esc_attr($key); ?>">
                                                        </div>
                                                        <div>
                                                            <h5><?php echo esc_html($additional_service['title']); ?></h5>
                                                            <div class="additional-service-content">
                                                                <?php echo wp_kses($additional_service['description'], array(
                                                                    'a'       => array(
                                                                        'href'    => array(),
                                                                        'title'   => array()
                                                                    ),
                                                                    'br'      => array(),
                                                                    'em'      => array(),
                                                                    'strong'  => array(),
                                                                    'img'     => array(
                                                                        'src' => array(),
                                                                        'alt' => array()
                                                                    )
                                                                )); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <strong>
                                                        <?php if (function_exists('onwork_get_currency_symbol')) {
                                                            echo esc_html(onwork_get_currency_symbol($additional_service['price']));
                                                        } ?>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </form>
                        </div>
                    <?php } ?>

                    <?php if ($faqs) { ?>
                        <div class="faq mt-5">
                            <h2 class="mb-5"><?php echo esc_html__('FAQs', 'onwork'); ?></h2>
                            <div id="accordion" class="onwork-accordion <?php echo esc_attr($settings['accordion_style']) ?>">
                                <?php
                                if (!empty($faqs)) {
                                    foreach ($faqs as $key => $faq) { ?>
                                        <div class="onwork-accordion-item">
                                            <h5 data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo esc_attr($key); ?>" aria-expanded="false" aria-controls="collapse-<?php echo esc_attr($key); ?>">
                                                <?php echo esc_html($faq['title']); ?>
                                                <span class="fal fa-plus"></span>
                                                <span class="fal fa-minus"></span>
                                            </h5>

                                            <div id="collapse-<?php echo esc_attr($key); ?>" class="collapse" data-bs-parent="#accordion">
                                                <?php echo wp_kses($faq['description'], array(
                                                    'a'       => array(
                                                        'href'    => array(),
                                                        'title'   => array()
                                                    ),
                                                    'br'      => array(),
                                                    'em'      => array(),
                                                    'strong'  => array(),
                                                    'img'     => array(
                                                        'src' => array(),
                                                        'alt' => array()
                                                    ),
                                                )); ?>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php
                    if ($related_services == true) {

                        global $post;
                        $related = get_posts(array(
                            'posts_per_page' => $posts_per_page,
                            'post_type' => 'services',
                            'post__not_in' => array($post->ID),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'service-categories',
                                    'field' => 'term_id',
                                    'terms' => get_the_terms(get_the_ID(), 'service-categories')[0]->term_id
                                )
                            )
                        ));

                    ?>

                        <?php if ($related) { ?>
                            <div class="related-posts">
                                <h4><?php echo esc_html($related_service_title) ?></h4>
                                <div class="row">
                                    <?php
                                    if ($related) foreach ($related as $post) {
                                        setup_postdata($post); ?>
                                        <div class="col-md-12 col-xl-<?php echo esc_attr($related_services_columns) ?>">
                                            <div class="single-related-service">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('prolancer-600x399');  ?>
                                                    </a>
                                                <?php endif; ?>

                                                <div class="related-post-title">
                                                    <a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></a>
                                                    <span><?php the_time('F j, Y') ?></span>
                                                </div>

                                            </div>
                                        </div>
                                    <?php }
                                    wp_reset_postdata(); ?>
                                </div>
                            </div><!-- .related-posts -->
                        <?php } ?>
                <?php
                    }

                endwhile; // End of the loop.
                ?>
                <?php if ($reviews) { ?>
                    <div class="review">
                        <h2 class="mb-5"><?php echo esc_html__('Reviews', 'prolancer'); ?></h2>
                        <?php foreach ($reviews as $review) : ?>
                            <div class="row">
                                <div class="col-md-2 col-xs-3 text-left text-md-center">
                                    <?php
                                    $profile_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta($review['buyer_id'], 'buyer_profile_attachment', true)), array('90', '90'), false);

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
                                        echo get_avatar(get_post_field('post_author', $review['buyer_id']), 90, null, null);
                                    } ?>
                                </div>
                                <div class="col-md-10 col-xs-9 my-auto">
                                    <div class="commenter">
                                        <a href="<?php the_permalink($review['buyer_id']); ?>"><?php echo esc_html(get_post_meta($review['buyer_id'], 'buyer_profile_name', true)); ?>
                                        </a>
                                        <span><?php echo esc_html(human_time_diff(strtotime($review['timestamp']), current_time('timestamp'))) . esc_html__(' ago', 'prolancer'); ?></span>
                                        <div class="stars">
                                            <div class="star-received">
                                                <?php for ($i = 0; $i < $review['star']; $i++) { ?>
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
                                    <p class="mb-0"><?php echo esc_html($review['review']); ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-4 position-relative">
                <div class="widget-area">
                    <?php if ($packages) { ?>
                        <div class="service-widget mb-30">
                            <div class="mb-30">
                                <div class="price-tab">
                                    <ul class="nav nav-tabs mb-3">
                                        <?php foreach ($packages as $key => $package) { ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($key == 0) {
                                                                        echo 'active show';
                                                                    } ?>" data-bs-toggle="tab" data-bs-target="#tab-<?php echo esc_attr($key); ?>" role="tab" aria-selected="<?php if ($key == 1) {
                                                                                                                                                                                    echo 'true';
                                                                                                                                                                                } ?>"><?php echo esc_html($package['name']); ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php foreach ($packages as $key => $package) { ?>
                                            <div class="tab-pane fade <?php if ($key == 0) {
                                                                            echo 'active show';
                                                                        } ?>" id="tab-<?php echo esc_attr($key); ?>" role="tabpanel">
                                                <h1 class="price" data-price="<?php echo esc_attr($package['price']) ?>"><?php if (class_exists('WooCommerce')) {
                                                                                                                                echo esc_html(get_woocommerce_currency_symbol());
                                                                                                                            } ?><span><?php echo esc_html($package['price']) ?></span></h1>
                                                <p><?php echo esc_html($package['description']); ?></p>
                                                <ul class="list-unstyled">
                                                    <li class="mb-2">
                                                        <i class="far fa-fw fa-clock"></i>
                                                        <b><?php if (get_term_by('id', $package['delivery_time'], 'delivery-time')) {
                                                                echo esc_html(get_term_by('id', $package['delivery_time'], 'delivery-time')->name);
                                                            } ?></b>
                                                    </li>
                                                    <?php
                                                    if ($features) {
                                                        foreach ($features as $index => $feature) { ?>
                                                            <li>
                                                                <?php if ($feature[$key] == 'yes') { ?>
                                                                    <i class="far fa-fw fa-check"></i>
                                                                <?php } else { ?>
                                                                    <i class="far fa-fw fa-times"></i>
                                                                <?php } ?>
                                                                <?php echo esc_html(ucwords(str_replace('packagefeature', '', str_replace('_', ' ', $index)))) ?>
                                                            </li>
                                                    <?php }
                                                    } ?>
                                                </ul>
                                                <div class="text-center mt-4">
                                                    <a href="#" class="order-service onwork-btn price" data-package-id="<?php echo esc_attr($key); ?>" data-service-id="<?php echo get_the_ID() ?>" data-additional-service-ids="" data-price="<?php echo esc_attr($package['price']) ?>" data-nonce="<?php echo wp_create_nonce('order_service_nonce'); ?>"><?php echo esc_html__('Order ', 'prolancer') ?>(<?php if (class_exists('WooCommerce')) {
                                                                                                                                                                                                                                                                                                                                                                                                                    echo esc_html(get_woocommerce_currency_symbol());
                                                                                                                                                                                                                                                                                                                                                                                                                } ?><span><?php echo esc_html($package['price']) ?></span>)</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="service-widget mb-30">
                        <div class="text-center mb-30">
                            <?php
                            $check_if_exist = get_user_meta(get_current_user_id(), 'service_wishlist_id_' . get_the_ID(), true);

                            if ($check_if_exist) { ?>
                                <a href="#" class="onwork-rgb-btn wishlist-service" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('wishlist_service_nonce'); ?>"><i class="fad fa-check-circle"></i><span><?php echo esc_html__('Wishlisted', 'onwork-core'); ?></span></a>
                            <?php } else { ?>
                                <a href="#" class="onwork-rgb-btn wishlist-service" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('wishlist_service_nonce'); ?>"><i class="fad fa-heart"></i><span><?php echo esc_html__('Wishlist Service', 'onwork'); ?></span></a>
                            <?php } ?>
                        </div>

                        <ul class="list-unstyled meta">
                            <li class="text-left"><?php echo esc_html__('Delivery Time:', 'prolancer'); ?><b class="float-end"><?php if (get_term_by('id', $package['delivery_time'], 'delivery-time')) {
                                                                                                                                    echo esc_html(get_term_by('id', $package['delivery_time'], 'delivery-time')->name);
                                                                                                                                } ?></b></li>
                            <li class="text-left"><?php echo esc_html__('Category:', 'prolancer'); ?><b class="float-end"><?php if (get_the_terms(get_the_ID(), 'service-categories')) {
                                                                                                                                echo esc_html(get_the_terms(get_the_ID(), 'service-categories')[0]->name);
                                                                                                                            } ?></b></li>
                            <li class="text-left"><?php echo esc_html__('English level:', 'prolancer'); ?><b class="float-end"><?php if (get_the_terms(get_the_ID(), 'service-english-level')) {
                                                                                                                                    echo esc_html(get_the_terms(get_the_ID(), 'service-english-level')[0]->name);
                                                                                                                                } ?></b></li>
                            <li class="text-left"><?php echo esc_html__('Location:', 'prolancer'); ?><b class="float-end"><?php if (get_the_terms(get_the_ID(), 'service-locations')) {
                                                                                                                                echo esc_html(get_the_terms(get_the_ID(), 'service-locations')[0]->name);
                                                                                                                            } ?></b></li>
                        </ul>
                    </div>
                    <div class="service-widget">
                        <div class="text-center">
                            <h3 class="service-widget-title"><?php echo esc_html__('About Seller', 'prolancer'); ?></h3>
                            <a href="<?php echo esc_url(get_the_permalink($seller_id)) ?>">
                                <?php
                                $seller_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta($seller_id, 'seller_profile_attachment', true)), array('120', '120'), false, array("class" => "mb-3 rounded-circle img-thumbnail"));

                                if (!empty($seller_image)) {
                                    echo wp_kses($seller_image, array(
                                        "img" => array(
                                            "src" => array(),
                                            "alt" => array(),
                                            "class" => array(),
                                            "style" => array()
                                        )
                                    ));
                                } else {
                                    echo get_avatar(get_post_field('post_author', $seller_id), 120, null, null, array('class' => 'mb-3 rounded-circle img-thumbnail'));
                                } ?>
                            </a>
                            <a href="<?php echo esc_url(get_the_permalink($seller_id)) ?>" target="_blank">
                                <h4><?php echo esc_html(get_post_meta($seller_id, 'seller_profile_name', true)); ?><?php onwork_verification(); ?></h4>
                            </a>
                            <?php //prolancer_badges($seller_id); ?>
                        </div>

                        <ul class="list-unstyled meta mt-4 mb-5">
                            <li class="text-left"><?php echo esc_html__('Gender:', 'prolancer'); ?><b class="float-end"><?php echo esc_html(get_post_meta($seller_id, 'seller_gender', true)); ?></b></li>
                            <li class="text-left"><?php echo esc_html__('Hourly rate:', 'prolancer'); ?>
                                <b class="float-end">
                                    <?php $price = get_post_meta($seller_id, 'seller_hourly_rate', true);

                                    if (function_exists('onwork_get_currency_symbol')) {
                                        echo esc_html(onwork_get_currency_symbol($price));
                                    } ?>
                                </b>
                            </li>
                            <?php if ($seller_locations) { ?>
                                <li class="text-left"><?php echo esc_html__('Location:', 'prolancer'); ?><b class="float-end"><?php echo esc_html($seller_locations[0]->name); ?></b></li>
                            <?php } ?>
                            <?php if ($seller_languages) { ?>
                                <li class="text-left"><?php echo esc_html__('Languages:', 'prolancer'); ?><b class="float-end"><?php echo esc_html($seller_languages[0]->name); ?></b></li>
                            <?php } ?>
                            <?php if ($seller_english_level) { ?>
                                <li class="text-left"><?php echo esc_html__('English Level:', 'prolancer'); ?><b class="float-end"><?php echo esc_html($seller_english_level[0]->name); ?></b></li>
                            <?php } ?>
                        </ul>
                        <div class="text-center">
                            <a href="#" class="onwork-btn" data-bs-toggle="modal" data-bs-target="#message<?php echo get_the_ID(); ?>">
                                <?php echo esc_html__('Contact Seller', 'prolancer'); ?>
                            </a>
                        </div>
                        <?php if ($seller_skills) { ?>
                            <div class="mt-5 text-center">
                                <h4 class="mb-3"><?php echo esc_html__('Skills', 'prolancer'); ?></h4>
                                <div class="skills">
                                    <?php echo wp_kses($seller_skills, array(
                                        'ul'  => array(
                                            'itemtype'    => array(),
                                            'itemscope'   => array(),
                                            'class'   => array()
                                        ),
                                        'li'  => array(
                                            'class' => array()
                                        ),
                                        'a' => array(
                                            'href'    => array(),
                                            'title'   => array(),
                                            'class'   => array()
                                        )
                                    )); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
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


        <div class="pt-120">
            <h2 class="mb-5"><?php echo esc_html__('Suggested services', 'prolancer'); ?></h2>
            <div class="services negative-margin-15" data-slick='{"slidesToShow": 3, "slidesToScroll": 3}'>
                <?php
                $services = new WP_Query(array(
                    'post_type' => 'services',
                    'posts_per_page' => 5,
                    'order' => 'DESC',
                    'orderby' => 'rand'
                ));

                /* Start the Loop */
                while ($services->have_posts()) : $services->the_post(); ?>
                    <div class="col-md-4">
                        <?php //do_action('get_prolancer_service_item', 'style-1'); ?>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
