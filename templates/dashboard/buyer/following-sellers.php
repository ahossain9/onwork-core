<div class="white-padding mb-4">
  <h2 class="mb-0"><?php echo esc_html__('Following Sellers', 'prolancer'); ?></h2>
</div>

<div class="white-padding">
  <?php
  if (get_query_var('paged')) {
    $paged = get_query_var('paged');
  } else if (get_query_var('page')) {
    $paged = get_query_var('page');
  } else {
    $paged = 1;
  }

  global $wpdb;
  $current_user_id  = get_current_user_id();
  $data = $wpdb->get_results("SELECT meta_value FROM $wpdb->usermeta WHERE user_id = '$current_user_id' AND meta_key LIKE 'seller_follow_id_%'");

  $seller_ids = [];
  if ($data) {
    foreach ($data as $value) {
      $seller_ids[] = $value->meta_value;
    }
  }

  if ($seller_ids) {
    $sellers = new WP_Query(array(
      'post_type' => 'sellers',
      'paged' => $paged,
      'post__in' => $seller_ids,
      'post_status' => 'publish',
      'orderby' => 'date',
      'order'   => 'DESC',
    ));
  }

  if ($seller_ids && $sellers->have_posts()) { ?>
    <div class="table-responsive">
      <table class="prolancer-table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo esc_html__('Picture', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Name', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Hourly rate', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Action', 'prolancer'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 1;
          while ($sellers->have_posts()) : $sellers->the_post(); ?>

            <tr>
              <th scope="row"><?php echo esc_html($count++); ?></th>
              <td>
                <a href="<?php the_permalink() ?>" target="_blank">
                  <?php $seller_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta(get_the_ID(), 'seller_profile_attachment', true)), array('50', '50'), false);

                  if (!empty($seller_image)) {
                    echo wp_kses($seller_image, array(
                      "img" => array(
                        "src" => array(),
                        "alt" => array(),
                        "style" => array()
                      )
                    ));
                  } else {
                    echo get_avatar(get_post_field('post_author', get_the_ID()), 50);
                  } ?>
                </a>
              </td>

              <td><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></td>
              <td>
                <?php
                $price = get_post_meta(get_the_ID(), 'seller_hourly_rate', true);

                if (function_exists('onwork_get_currency_symbol')) {
                  echo esc_html(onwork_get_currency_symbol($price));
                } ?>
              </td>
              <td>
                <ul class="list-inline">
                  <li class="list-inline-item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#remove<?php echo get_the_ID(); ?>">
                      <i class="fad fa-trash-alt"></i>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="remove<?php echo get_the_ID(); ?>" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><?php echo esc_html__('Remove Seller', 'prolancer'); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p><?php echo esc_html__('Are you sure?', 'prolancer'); ?></p>
                            <a href="#" class="remove-following-seller btn btn-danger text-white" data-nonce="<?php echo wp_create_nonce('remove_following_seller_nonce'); ?>" data-id="<?php echo get_the_ID(); ?>"><?php echo esc_html__('Remove', 'prolancer'); ?></a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </li>
                </ul>
              </td>
            </tr>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </tbody>
      </table>
    </div>
  <?php } else { ?>
    <p class="mb-0"><?php echo esc_html__('No recharge found!', 'prolancer'); ?></p>
  <?php }  ?>
</div>