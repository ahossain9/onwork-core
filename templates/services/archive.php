<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package onwork
 */

get_header();

global $post;

$buyer_id = get_user_meta($post->post_author, 'buyer_id', true);
$featured_service = get_post_meta(get_the_ID(), 'featured_service', true);
$seller_id = get_user_meta($post->post_author, 'seller_id', true);
$service_attachments = get_post_meta(get_the_ID(), 'service_attachments');
if ($service_attachments) {
    foreach ($service_attachments as $attachment) {
        if ($attachment) {
            $image_ids = array_keys($attachment);
        }
    }
}
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php
                    if (have_posts()) :

                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();
                    ?>
                            <div class="prolancer-service-item pt-5 style-2">
                                <?php if ($featured_service == true) { ?>
                                    <div class="featured-post"><?php echo esc_html__('Featured', 'prolancer') ?><i class="fas fa-bolt"></i></div>
                                <?php } ?>
                                <div class="row">
                                    <?php //if (!empty($service_attachments)) { ?>
                                        <!-- <div class="col-md-4 my-auto">
                                            <div class="service-item-images">
                                                <?php //foreach ($image_ids as $image_id) { ?>
                                                    <img src="<?php //echo esc_url(wp_get_attachment_image_src($image_id, 'prolancer-600x399')[0]); ?>" alt="Img">
                                                <?php //} ?>
                                            </div>
                                        </div> -->
                                    <?php //} ?>
                                    <div class="col-md-<?php if (!empty($service_attachments)) {
                                                            echo '8';
                                                        } else {
                                                            echo '12';
                                                        } ?> my-auto">
                                        <div class="service-content">
                                            <div class="service-item-seller">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-flex">
                                                            <div class="my-auto">
                                                                <a href="<?php echo esc_url(get_the_permalink($seller_id)) ?>">
                                                                    <?php $seller_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta($seller_id, 'seller_profile_attachment', true)), array('40', '40'), false);

                                                                    if (!empty($seller_image)) {
                                                                        echo wp_kses($seller_image, array(
                                                                            "img" => array(
                                                                                "src" => array(),
                                                                                "alt" => array(),
                                                                                "style" => array()
                                                                            )
                                                                        ));
                                                                    } else {
                                                                        echo get_avatar(get_post_field('post_author', $seller_id), 40);
                                                                    } ?>
                                                                </a>
                                                            </div>
                                                            <div class="my-auto">
                                                                <h6 class="mb-0"><?php echo esc_html(get_post_meta($seller_id, 'seller_profile_name', true)); ?><?php onwork_verification(); ?></h6>
                                                                <span><?php echo esc_html__('Delivery:', 'prolancer'); ?>
                                                                    <b>
                                                                        <?php $delivery_time = get_term_by('id', json_decode(get_post_meta(get_the_ID(), 'packages', true), true)[0]['delivery_time'], 'delivery-time');
                                                                        if ($delivery_time) {
                                                                            echo esc_html($delivery_time->name);
                                                                        } else {
                                                                            echo esc_html__('Undefined', 'prolancer');
                                                                        } ?>
                                                                    </b>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="service-price float-end">
                                                            <h4>
                                                                <?php $price = json_decode(get_post_meta(get_the_ID(), 'packages', true), true)[0]['price'];

                                                                if (function_exists('onwork_get_currency_symbol')) {
                                                                    echo esc_html(onwork_get_currency_symbol($price));
                                                                } ?>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 80, '..'); ?></a></h3>
                                            <ul class="list-inline">
                                                <?php if (get_the_terms(get_the_ID(), 'service-categories')) { ?>
                                                    <li class="list-inline-item"><i class="fa fa-tags"></i><?php echo esc_html(get_the_terms(get_the_ID(), 'service-categories')[0]->name); ?></li>
                                                <?php }
                                                if (get_the_terms(get_the_ID(), 'service-english-level')) { ?>
                                                    <li class="list-inline-item"><i class="fa fa-language"></i><?php echo esc_html(get_the_terms(get_the_ID(), 'service-english-level')[0]->name); ?></li>
                                                <?php }
                                                if (get_the_terms(get_the_ID(), 'service-locations')) { ?>
                                                    <li class="list-inline-item"><i class="fa fa-map-marker"></i><?php echo esc_html(get_the_terms(get_the_ID(), 'service-locations')[0]->name); ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php

                        endwhile;

                    else :

                        echo 'No Project Found';

                    endif;

                    ?>
                </div>
                <div class="col-lg-4">
                    <h3>Sidebar Here</h2>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_footer();
