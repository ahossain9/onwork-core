<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolancer
 */

get_header();

$buyer_locations = get_the_terms(get_the_ID(), 'buyer-locations');
$employees_number = get_the_terms(get_the_ID(), 'employees-number');
$buyer_profile_attachment = get_post_meta(get_the_ID(), 'buyer_profile_attachment', true);
$buyer_profile_name = get_post_meta(get_the_ID(), 'buyer_profile_name', true);
$complete_project = get_post_meta(get_the_ID(), 'complete_project', true);

global $wpdb;
$project_table = 'onwork_project_proposals';

if ($wpdb->get_var("SHOW TABLES LIKE '$project_table'") == $project_table) {
    $proposal_query = "SELECT * FROM " . $project_table . " WHERE `buyer_id` = '" . get_the_ID() . "' AND status = 'pending'";
    $proposals = $wpdb->get_results($proposal_query, ARRAY_A);
}
if (count($proposals) > 0) {
    $proposal = count($proposals);
} else {
    $proposal = 0;
}

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
                        <div class="prolancer-buyer-item pt-5 style-2">
                            <div class="row">               
                                <?php if (!empty($buyer_profile_attachment)){ ?>
                                <div class="col-md-3 my-auto">
                                    <a href="<?php the_permalink(); ?>" class="buyer-item-images">
                                        <?php $buyer_image = wp_get_attachment_image ( onwork_get_image_id($buyer_profile_attachment),array('250', '250') ,false);
                                        if (!empty($buyer_image)) {
                                            echo wp_kses($buyer_image,array(
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
                                <div class="col-md-<?php if (!empty($buyer_profile_attachment)){ echo '6';}else{ echo '9'; } ?> my-auto">
                                <div class="buyer-content">
                                        <h4><?php echo esc_html(get_post_meta(get_the_ID(), 'buyer_profile_title', true)) ; ?></h4>
                                        <h3 class="mb-2"><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth( get_the_title(), 0, 60, '..' );?></a><?php onwork_verification(); ?></h3>

                                        <p class="mb-4"><?php echo esc_html__( 'Member since', 'prolancer' ).' '.get_the_date('M Y'); ?></p>
                                        <ul class="list-inline mb-lg-0">
                                            <?php if ($buyer_locations){ ?>
                                                <li class="list-inline-item"><i class="fas fa-map-marked-alt"></i><?php echo esc_html($buyer_locations[0]->name); ?></li>
                                            <?php } ?>
                                            <?php if ($employees_number) { ?>
                                                <li class="list-inline-item"><i class="fas fa-users"></i><?php echo esc_html( $employees_number[0]->name ); ?></li>
                                            <?php } ?>
                                        </ul>
                                </div>
                                </div>
                                <div class="col-md-3 my-auto text-center">
                                    <h5><?php echo esc_html($proposal); ?></h5>
                                <span>(<?php echo esc_html__( 'Proposals', 'prolancer' ) ?>)</span>
                                <div>
                                        <a href="<?php echo esc_url(get_the_permalink($buyer_id)) ?>" class="mt-3 prolancer-rgb-btn"><?php echo esc_html__( 'Profile', 'prolancer' ) ?></a>
                                    </div>
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
