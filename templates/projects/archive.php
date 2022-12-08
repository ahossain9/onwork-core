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
                    <div class="project-list mb-5">
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

                                    onwork_verification();
                                    ?>
                                </a>
                            </div>
                            <div class="col-md-6 my-auto">
                                <a class="project-title" href="<?php the_permalink(); ?>">
                                    <h3><?php echo mb_strimwidth(get_the_title(), 0, 50, '..'); ?></h3>
                                </a>
                                <ul class="list-inline">
                                    <?php if (get_the_terms(get_the_ID(), 'project-duration')) { ?>
                                        <li class="list-inline-item"><i class="fa fa-clock-o"></i> <?php echo esc_html(get_the_terms(get_the_ID(), 'project-duration')[0]->name); ?></li>
                                    <?php }
                                    if (get_the_terms(get_the_ID(), 'project-level')) { ?>
                                        <li class="list-inline-item"><i class="fa fa-signal"></i> <?php echo esc_html(get_the_terms(get_the_ID(), 'project-level')[0]->name); ?></li>
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
                                <a href="<?php the_permalink(); ?>" class="onwork-rgb-btn float-lg-end"><?php echo esc_html__('Detail', 'onwork-core'); ?></a>
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
<?php




?>
<?php get_footer();
