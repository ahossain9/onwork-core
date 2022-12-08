<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolancer
 */

get_header();

global $wpdb;

$seller_english_level = get_the_terms(get_the_ID(), 'seller-english-level');
$seller_locations = get_the_terms(get_the_ID(), 'seller-locations');
// $seller_type = get_the_terms(get_the_ID(), 'seller-type');
$seller_hourly_rate = get_post_meta(get_the_ID(), 'seller_hourly_rate', true);
$seller_profile_attachment = get_post_meta(get_the_ID(), 'seller_profile_attachment', true);

//Rating
// $ratings = prolancer_seller_reviews(get_the_ID());

// $max = 0;
// $n = count($ratings);
// if ($ratings) {
//     foreach ($ratings as $rate => $count) {
//         $max = $max + $count['star'];
//     }
//     $average_rating = $max / $n;
// }

?>

<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="search-result">
                <?php

                if (have_posts()) :
                    /* Start the Loop */
                    while (have_posts()) : the_post();
                    ?>
                        <div class="prolancer-seller-item mt-5 mb-5 style-2">
            <div class="row">
                <?php if ($seller_profile_attachment){ ?>
                <div class="col-md-3 my-auto">
                    <a href="<?php the_permalink(); ?>">
                        <?php $seller_image = wp_get_attachment_image ( onwork_get_image_id($seller_profile_attachment),array('250', '250') ,false);
                        if (!empty($seller_image)) {
                            echo wp_kses($seller_image,array(
                                "img" => array(
                                    "src" => array(),
                                    "alt" => array(),
                                    "style" => array()
                                )
                            ));
                        } else {
                            echo get_avatar( get_post_field('post_author', get_the_ID()), 250 );
                        } ?>
                    </a>
                </div>                
                <?php } ?>
                <div class="col-md-<?php if ($seller_profile_attachment){ echo '6';}else{ echo '9'; } ?> my-auto">
                   <div class="seller-content">
                        <h4 ><?php echo esc_html(get_post_meta(get_the_ID(), 'seller_profile_title', true)) ; ?></h4>
                        <h3 class="mb-2"><a href="<?php the_permalink(); ?>"><?php the_title() ; ?></a><?php onwork_verification(); ?></h3>
                        
                        <p class="mb-4"><?php echo esc_html__( 'Member since', 'prolancer' ).' '.get_the_date('M Y'); ?></p>

                        <ul class="list-inline mb-lg-0">
                            <?php if ($seller_english_level){ ?>
                                <li class="list-inline-item"><i class="fad fa-users-medical"></i><?php echo esc_html($seller_type[0]->name); ?></b></li>
                            <?php } ?>
                            <?php if ($seller_locations){ ?>
                                <li class="list-inline-item"><i class="fas fa-map-marked-alt"></i><?php echo esc_html($seller_locations[0]->name); ?></b></li>
                            <?php } ?>
                        </ul>
                   </div>
                </div>
                <div class="col-md-3 my-auto text-center">
                    <?php if ($seller_hourly_rate){ ?>
                    <div class="seller-hourly-rate">
                        <h5><?php if (function_exists('prolancer_get_currency_symbol')) { echo esc_html(onwork_get_currency_symbol($seller_hourly_rate)); } ?></h5>
                        <span>(<?php echo esc_html__( 'Hourly rate', 'prolancer' ) ?>)</span>
                    </div>
                <?php } ?>
                    <div class="star-rating mx-auto mb-4">
                <span style="width:<?php echo ( ( $average_rating / 5 ) * 100 )?>%"></span>
            </div>
            <a href="<?php the_permalink(); ?>" class="prolancer-rgb-btn"><?php echo esc_html__( 'Hire me', 'prolancer' ) ?></a>
                </div>
            </div>
        </div>
        <?php
                    endwhile; ?>

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
