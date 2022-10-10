<?php

$buyer_id = get_user_meta($post->post_author, 'buyer_id', true);

$attachments = get_post_meta(get_the_ID(), 'attachments', false);

if ($attachments) {
    foreach ($attachments as $attachment) {
        if ($attachment) {
            $image_ids = array_keys($attachment);
        }
    }
}


// Sellers
$review_table = 'onwork_reviews';

if ($wpdb->get_var("SHOW TABLES LIKE '$review_table'") == $review_table) {
    $query = "SELECT * FROM " . $review_table . " WHERE `project_id` = '" . get_the_ID() . "' AND `type` ='project'";
    $sellers = $wpdb->get_results($query, ARRAY_A);
}

// Proposals
$proposal_table = 'onwork_project_proposals';

if ($wpdb->get_var("SHOW TABLES LIKE '$proposal_table'") == $proposal_table) {
    $query = "SELECT * FROM " . $proposal_table . " WHERE `project_id` = '" . get_the_ID() . "'";
    $proposals = $wpdb->get_results($query, ARRAY_A);
}

$skills = get_the_term_list(get_the_ID(), 'skills', '', ' ');
$project_categories = get_the_terms(get_the_ID(), 'project-categories');
$buyer_locations = get_the_terms($buyer_id, 'buyer-locations');
$buyer_departments = get_the_terms($buyer_id, 'buyer-departments');
$employees_number = get_the_terms($buyer_id, 'employees-number');

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

                    <div class="row project-meta-cards mb-3">
                        <div class="col-xl-4 col-md-6">
                            <div class="project-meta">
                                <div class="my-auto">
                                    <i class="fad fa-id-card-alt"></i>
                                </div>
                                <div class="my-auto">
                                    <span><?php echo esc_html__('Seller Type', 'prolancer'); ?></span>
                                    <h6>
                                        <?php if (get_the_terms(get_the_ID(), 'project-seller-type')) {
                                            echo esc_html(get_the_terms(get_the_ID(), 'project-seller-type')[0]->name);
                                        } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="project-meta">
                                <div class="my-auto">
                                    <i class="fad fa-file-chart-pie"></i>
                                </div>
                                <div class="my-auto">
                                    <span><?php echo esc_html__('Project type', 'prolancer'); ?></span>
                                    <h6>
                                        <?php if (get_post_meta(get_the_ID(), 'project_type', true)) {
                                            echo esc_html(get_post_meta(get_the_ID(), 'project_type', true));
                                        } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="project-meta">
                                <div class="my-auto">
                                    <i class="fad fa-clock"></i>
                                </div>
                                <div class="my-auto">
                                    <span><?php echo esc_html__('Project Duration', 'prolancer'); ?></span>
                                    <h6>
                                        <?php if (get_the_terms(get_the_ID(), 'project-duration')) {
                                            echo esc_html(get_the_terms(get_the_ID(), 'project-duration')[0]->name);
                                        } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="project-meta">
                                <div class="my-auto">
                                    <i class="fad fa-shield-alt"></i>
                                </div>
                                <div class="my-auto">
                                    <span><?php echo esc_html__('Project Level', 'prolancer'); ?></span>
                                    <h6>
                                        <?php if (get_the_terms(get_the_ID(), 'project-level')) {
                                            echo esc_html(get_the_terms(get_the_ID(), 'project-level')[0]->name);
                                        } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="project-meta">
                                <div class="my-auto">
                                    <i class="fad fa-globe-asia"></i>
                                </div>
                                <div class="my-auto">
                                    <span><?php echo esc_html__('Languages', 'prolancer'); ?></span>
                                    <h6>
                                        <?php if (get_the_terms(get_the_ID(), 'languages')) {
                                            echo esc_html(get_the_terms(get_the_ID(), 'languages')[0]->name);
                                        } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="project-meta">
                                <div class="my-auto">
                                    <i class="fad fa-megaphone"></i>
                                </div>
                                <div class="my-auto">
                                    <span><?php echo esc_html__('English Level', 'prolancer'); ?></span>
                                    <h6>
                                        <?php if (get_the_terms(get_the_ID(), 'english-level')) {
                                            echo esc_html(get_the_terms(get_the_ID(), 'english-level')[0]->name);
                                        } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-entry-content">
                        <?php
                        the_content();

                            the_post_navigation(array(
                                'prev_text' => esc_html__('&#171; Previous Project', 'prolancer'),
                                'next_text' => esc_html__('Next Project &#187;', 'prolancer')
                            ));
                        ?>
                    </div>

                    <?php if ($skills) { ?>
                        <div class="skills-required">
                            <h2 class="mb-4"><?php echo esc_html__('Skills Required', 'prolancer'); ?></h2>
                            <?php echo wp_kses($skills, array(
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
                    <?php } ?>

                    <?php if ($attachments) { ?>
                        <div class="project-attachments">
                            <h2 class="mb-5"><?php echo esc_html__('Attachments', 'prolancer'); ?></h2>
                            <div class="row">
                                <?php
                                foreach ($image_ids as $image_id) { ?>
                                    <div class="col-md-6">
                                        <a class="project-attachment" href="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>" download>
                                            <img src="<?php echo esc_url(wp_get_attachment_image_src($image_id, 'prolancer-100x80', true)[0]); ?>">
                                            <div>
                                                <h6><?php echo esc_html(get_the_title($image_id)); ?></h6>
                                                <span><?php echo 'File size: ' . filesize(get_attached_file($image_id)) . ' KB'; ?></span>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <form id="proposal-form">
                        <h2 class="mb-5"><?php echo esc_html__('Send Proposal', 'prolancer'); ?></h2>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="number" name="proposal_price" value="<?php echo esc_html(get_post_meta(get_the_ID(), 'project_price', true)); ?>">
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" name="proposal_project_duration">
                                    <?php prolancer_get_option_list('project-duration', 'project_duration', $project_id); ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="proposal_cover_letter" cols="30" rows="10" placeholder="<?php echo esc_attr__('Cover Letter', 'prolancer'); ?>"></textarea>
                            </div>
                        </div>
                    </form>
                <?php endwhile; ?>
                <?php if ($sellers) { ?>
                    <div class="review">
                        <h2 class="mb-5"><?php echo esc_html__('Hired', 'prolancer'); ?></h2>
                        <?php
                        foreach ($sellers as $seller) : ?>
                            <div class="row">
                                <div class="col-md-2 col-xs-3 text-left text-md-center">
                                    <?php
                                    $profile_image = wp_get_attachment_image(prolancer_get_image_id(get_post_meta($seller['seller_id'], 'seller_profile_attachment', true)), array('90', '90'), false);

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
                                        echo get_avatar(get_post_field('post_author', $seller['seller_id']), 90, null, null);
                                    } ?>
                                </div>
                                <div class="col-md-10 col-xs-9 my-auto">
                                    <div class="commenter">
                                        <a href="<?php the_permalink($seller['seller_id']); ?>"><?php echo esc_html(get_post_meta($seller['seller_id'], 'seller_profile_name', true)); ?>
                                        </a>
                                        <span><?php echo esc_html(human_time_diff(strtotime($seller['timestamp']), current_time('timestamp'))) . esc_html__(' ago', 'prolancer'); ?></span>
                                        <div class="stars">
                                            <div class="star-received">
                                                <?php for ($i = 0; $i < $seller['star']; $i++) { ?>
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
                                    <p class="mb-0"><?php echo esc_html($seller['review']); ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php } ?>
                <?php if ($proposals) { ?>
                    <div class="review">
                        <h2 class="mb-5"><?php echo esc_html__('Proposals', 'prolancer'); ?></h2>
                        <?php foreach ($proposals as $proposal) :
                            //Rating
                            $ratings = prolancer_seller_reviews($proposal['seller_id']);
                            $max = 0;
                            $n = count($ratings);
                            if ($ratings) {
                                foreach ($ratings as $rate => $count) {
                                    $max = $max + $count['star'];
                                }
                                $average_rating = $max / $n;
                            } ?>
                            <div class="row">
                                <div class="col-md-2 col-xs-3 text-left text-md-center">
                                    <?php
                                    $profile_image = wp_get_attachment_image(prolancer_get_image_id(get_post_meta($proposal['seller_id'], 'seller_profile_attachment', true)), array('90', '90'), false);

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
                                        echo get_avatar(get_post_field('post_author', $proposal['seller_id']), 90, null, null);
                                    } ?>
                                </div>
                                <div class="col-md-10 col-xs-9 my-auto">
                                    <div class="commenter">
                                        <a href="<?php the_permalink($proposal['seller_id']); ?>"><?php echo esc_html(get_the_title($proposal['seller_id'])); ?>
                                        </a>
                                        <span>
                                            <?php echo esc_html(human_time_diff(strtotime($proposal['timestamp']), current_time('timestamp'))) . esc_html__(' ago', 'prolancer'); ?>
                                            <div class="star-rating">
                                                <span style="width:<?php echo (($average_rating / 5) * 100) ?>%"></span>
                                            </div>
                                        </span>
                                    </div>
                                    <h6><?php echo get_post_meta($proposal['seller_id'], 'seller_profile_title', true) ?></h6>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php } ?>
            </div>

            <div class="col-lg-4 position-relative">
                <div class="widget-area">
                    <div class="project-widget">
                        <div class="text-center">
                            <h5><?php echo esc_html__('Budget', 'prolancer'); ?></h5>
                            <h1>
                                <?php $price = get_post_meta(get_the_ID(), 'project_price', true);

                                if (function_exists('prolancer_get_currency_symbol')) {
                                    echo esc_html(prolancer_get_currency_symbol($price));
                                } ?>
                            </h1>
                            <span><?php echo esc_html__('Project type: ', 'prolancer') . esc_html(get_post_meta(get_the_ID(), 'project_type', true)); ?></span>
                            <div>
                                <a href="#" class="submit-proposal prolancer-btn d-md-block d-lg-inline-block mt-3 mb-20" data-project-id="<?php echo get_the_ID() ?>" data-nonce="<?php echo wp_create_nonce('create_project_nonce'); ?>"><?php echo esc_html__('Submit a Proposal', 'prolancer'); ?></a>
                                <?php
                                $check_if_exist = get_user_meta(get_current_user_id(), 'project_wishlist_id_' . get_the_ID(), true);

                                if ($check_if_exist) { ?>
                                    <a href="#" class="prolancer-rgb-btn d-md-block d-lg-inline-block wishlist-project" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('wishlist_project_nonce'); ?>"><i class="fad fa-check-circle"></i><span><?php echo esc_html__('Wishlisted', 'prolancer'); ?></span></a>
                                <?php } else { ?>
                                    <a href="#" class="prolancer-rgb-btn d-md-block d-lg-inline-block wishlist-project" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('wishlist_project_nonce'); ?>"><i class="fad fa-heart"></i><span><?php echo esc_html__('Wishlist Project', 'prolancer'); ?></span></a>
                                <?php } ?>
                            </div>
                        </div>
                        <ul class="list-unstyled mt-5 mb-3 meta">
                            <li class="text-left"><?php echo esc_html__('Seller Type:', 'prolancer'); ?><b class="float-end"><?php if (get_the_terms(get_the_ID(), 'project-seller-type')) {
                                                                                                                                    echo esc_html(get_the_terms(get_the_ID(), 'project-seller-type')[0]->name);
                                                                                                                                } ?></b></li>
                            <li class="text-left"><?php echo esc_html__('Project type:', 'prolancer'); ?><b class="float-end"><?php if (get_post_meta(get_the_ID(), 'project_type', true)) {
                                                                                                                                    echo esc_html(get_post_meta(get_the_ID(), 'project_type', true));
                                                                                                                                } ?></b></li>
                            <li class="text-left"><?php echo esc_html__('Project Duration:', 'prolancer'); ?><b class="float-end"><?php if (get_the_terms(get_the_ID(), 'project-duration')) {
                                                                                                                                        echo esc_html(get_the_terms(get_the_ID(), 'project-duration')[0]->name);
                                                                                                                                    } ?></b></li>
                            <li class="text-left"><?php echo esc_html__('Project Level:', 'prolancer'); ?><b class="float-end"><?php if (get_the_terms(get_the_ID(), 'project-level')) {
                                                                                                                                        echo esc_html(get_the_terms(get_the_ID(), 'project-level')[0]->name);
                                                                                                                                    } ?></b></li>
                            <li class="text-left"><?php echo esc_html__('Languages:', 'prolancer'); ?><b class="float-end"><?php if (get_the_terms(get_the_ID(), 'languages')) {
                                                                                                                                    echo esc_html(get_the_terms(get_the_ID(), 'languages')[0]->name);
                                                                                                                                } ?></b></li>
                            <li class="text-left"><?php echo esc_html__('English Level:', 'prolancer'); ?><b class="float-end"><?php if (get_the_terms(get_the_ID(), 'english-level')) {
                                                                                                                                        echo esc_html(get_the_terms(get_the_ID(), 'english-level')[0]->name);
                                                                                                                                    } ?></b></li>
                        </ul>
                    </div>
                    <div class="project-widget">
                        <div class="text-center">
                            <h3 class="project-widget-title"><?php echo esc_html__('About Buyer', 'prolancer'); ?></h3>
                            <a href="<?php echo esc_url(get_the_permalink($buyer_id)) ?>">
                                <?php $buyer_image = wp_get_attachment_image(prolancer_get_image_id(get_post_meta($buyer_id, 'buyer_profile_attachment', true)), array('120', '120'), false, array("class" => "mb-3 rounded-circle img-thumbnail"));
                                if (!empty($buyer_image)) {
                                    echo wp_kses($buyer_image, array(
                                        "img" => array(
                                            "src" => array(),
                                            "alt" => array(),
                                            "class" => array(),
                                            "style" => array()
                                        )
                                    ));
                                } else {
                                    echo get_avatar(get_post_field('post_author', $buyer_id), 120, null, null, array('class' => 'mb-3 rounded-circle img-thumbnail'));
                                } ?>
                            </a>
                            <a href="<?php echo esc_url(get_the_permalink($buyer_id)) ?>" target="_blank">
                                <h4><?php echo esc_html(get_post_meta($buyer_id, 'buyer_profile_name', true)); ?><?php prolancer_verification(); ?></h4>
                            </a>
                            <?php prolancer_badges($buyer_id); ?>
                        </div>

                        <ul class="list-unstyled mt-4 meta">
                            <?php if ($buyer_locations) { ?>
                                <li class="text-left"><?php echo esc_html__('Location:', 'prolancer'); ?><b class="float-end"><?php echo esc_html($buyer_locations[0]->name); ?></b></li>
                            <?php } ?>

                            <?php if ($buyer_departments) { ?>
                                <li class="text-left"><?php echo esc_html__('Departments:', 'prolancer'); ?><b class="float-end"><?php echo esc_html($buyer_departments[0]->name); ?></b></li>
                            <?php } ?>
                            <?php if ($employees_number) { ?>
                                <li class="text-left"><?php echo esc_html__('No. of Employees:', 'prolancer'); ?><b class="float-end"><?php echo esc_html($employees_number[0]->name); ?></b></li>
                            <?php } ?>
                        </ul>
                        <div class="text-center">
                            <a href="#" class="prolancer-btn mt-5" data-bs-toggle="modal" data-bs-target="#message<?php echo get_the_ID(); ?>">
                                <?php echo esc_html__('Contact Buyer', 'prolancer'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

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

            <div class="pt-120">
                <h2 class="mb-5"><?php echo esc_html__('Suggested projects', 'prolancer'); ?></h2>
                <div class="projects negative-margin-15" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                    <?php
                    $services = new WP_Query(array(
                        'post_type' => 'projects',
                        'posts_per_page' => 6,
                        'order' => 'DESC',
                        'orderby' => 'rand'
                    ));

                    /* Start the Loop */
                    while ($services->have_posts()) : $services->the_post(); ?>
                        <div class="col-md-4">
                            <?php do_action('get_prolancer_project_item', 'style-1'); ?>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer();
