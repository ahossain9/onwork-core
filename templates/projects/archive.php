<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package onwork
 */

get_header();
?>

<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
                <?php
                global $post;
                $featured_project = get_post_meta(get_the_ID(), 'featured_project', true);
                $buyer_id = get_user_meta($post->post_author, 'buyer_id', true);
                $buyer_profile_attachment = get_post_meta($buyer_id, 'buyer_profile_attachment', true);
                if (have_posts()) :
                    /* Start the Loop */
                    while (have_posts()) : the_post();
                    
                    ?>
                        <div class="prolancer-project-item style-1">
                            <?php if ($featured_project == true) {?>
                                <div class="featured-post"><?php echo esc_html__('Featured','prolancer') ?><i class="fas fa-bolt"></i></div>
                            <?php } ?>
                            <div class="text-center">
                                <a class="project-buyer" href="<?php echo esc_url(get_the_permalink($buyer_id)) ?>">
                                <?php $buyer_image = wp_get_attachment_image ( get_post_meta($buyer_id, 'buyer_profile_attachment', true ),array('150', '150') ,false);
                                if (!empty($buyer_image)) {
                                    echo wp_kses($buyer_image,array(
                                        "img" => array(
                                            "src" => array(),
                                            "alt" => array(),
                                            "style" => array()
                                        )
                                    ));
                                } else {
                                    echo get_avatar( get_post_field('post_author', $buyer_id), 150 );
                                } ?>           
                                <h5><?php echo esc_html(get_post_meta($buyer_id, 'buyer_profile_name', true)) ; ?><?php //prolancer_verification(); ?></h5>
                                </a>
                                <a class="project-title" href="<?php the_permalink(); ?>"><h3><?php echo mb_strimwidth( get_the_title(), 0, 45, '..' );?></h3></a>
                                <ul class="list-inline mb-0">
                                    <?php if (get_post_meta( get_the_ID(), 'project_type' , true )){ ?>
                                        <li class="list-inline-item"><i class="fad fa-file-chart-pie"></i> <?php echo esc_html(esc_html(get_post_meta( get_the_ID(), 'project_type' , true ))); ?></li>
                                    <?php }                    
                                    if(get_the_terms( get_the_ID(), 'project-duration' )){ ?>
                                        <li class="list-inline-item"><i class="fad fa-clock"></i> <?php echo esc_html(get_the_terms( get_the_ID(), 'project-duration' )[0]->name); ?></li>
                                    <?php } ?>
                                </ul>
                            </div>            
                        </div>
                   <?php endwhile; ?>

                    <div class="text-center">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'  => 2,
                            'prev_text' => esc_html__('&#10094; Prev', 'prolancer'),
                            'next_text' => esc_html__('Next &#10095;', 'prolancer'),
                        )); ?>
                    </div>

                <?php

                else :

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();
