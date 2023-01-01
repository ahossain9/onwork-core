<div class="white-padding mb-4">
  <h2 class="mb-0"><?php echo esc_html__('Project', 'prolancer'); ?></h2>
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

  $projects = new WP_Query(array(
    'author__in' => array(get_current_user_id()),
    'post_type' => 'projects',
    'paged' => $paged,
    'post_status' => ['publish', 'pending'],
    'orderby' => 'date',
    'order'   => 'DESC',
  ));

  if ($projects->have_posts()) { ?>
    <div class="table-responsive">
      <table class="prolancer-table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo esc_html__('Project', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Category', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Budget', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Status', 'prolancer'); ?></th>
            <th scope="col"><?php echo esc_html__('Action', 'prolancer'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 1;
          while ($projects->have_posts()) : $projects->the_post();

            global $wpdb;
            $table = 'onwork_project_proposals';

            if ($wpdb->get_var("SHOW TABLES LIKE '${table}'") == $table) {
              $query = "SELECT * FROM ${table} WHERE `project_id` = '" . get_the_ID() . "' AND `status` = 'pending' ORDER BY timestamp DESC";
              $results = $wpdb->get_results($query, ARRAY_A);

              $proposal_count = 0;
              if ($results) {
                $proposal_count = count($results);
              }
            } ?>

            <tr>
              <th scope="row"><?php echo esc_html($count++); ?></th>
              <td><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></td>
              <td>
                <?php $categories = get_the_terms(get_the_ID(), 'project-categories');
                if (!empty($categories)) {
                  echo '<a class="cat" href="' . esc_url(get_category_link($categories[0]->term_id)) . '" target="_blank">' . esc_html($categories[0]->name) . '</a>';
                } ?>
              </td>
              <td>
                <?php
                $price = get_post_meta(get_the_ID(), 'project_price', true);

                if (function_exists('onwork_get_currency_symbol')) {
                  echo esc_html(onwork_get_currency_symbol($price));
                } ?>
              </td>
              <td>
                <?php
                if ($projects->post->post_status == 'publish') { ?>
                  <a href="<?php if (function_exists('onwork_get_page_url_by_template')) {
                              echo esc_url(onwork_get_page_url_by_template('onwork-dashboard.php'));
                            }
                            if (get_option('permalink_structure')) {
                              echo "?";
                            } else {
                              echo "&";
                            } ?>fed=proposals&project_id=<?php echo get_the_ID(); ?>"><?php echo esc_html__('Proposal (', 'prolancer') . $proposal_count . ')'; ?></a>
                <?php } else {
                  echo esc_html($projects->post->post_status);
                } ?>
              </td>
              <td>
                <ul class="list-inline mb-0">
                  <li class="list-inline-item"><a href="<?php if (function_exists('onwork_get_page_url_by_template')) {
                                                          echo esc_url(onwork_get_page_url_by_template('onwork-dashboard.php'));
                                                        }
                                                        if (get_option('permalink_structure')) {
                                                          echo "?";
                                                        } else {
                                                          echo "&";
                                                        } ?>fed=create-project&project_id=<?php echo get_the_ID(); ?>"><i class="fad fa-edit"></i></a></li>
                  <li class="list-inline-item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo get_the_ID(); ?>">
                      <i class="fad fa-trash-alt"></i>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="delete<?php echo get_the_ID(); ?>" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><?php echo esc_html__('Delete Project', 'prolancer'); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p><?php echo esc_html__('Are you sure?', 'prolancer'); ?></p>
                            <a href="#" class="delete-project btn btn-danger text-white" data-nonce="<?php echo wp_create_nonce('delete_project_nonce'); ?>" data-project-id="<?php echo get_the_ID(); ?>"><?php echo esc_html__('Delete', 'prolancer'); ?></a>
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
    <nav class="navigation pagination mt-5">
      <div class="nav-links">
        <?php $big = 999999999; // need an unlikely integer

        echo paginate_links(array(
          'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          'format' => '?paged=%#%',
          'current' => max(1, get_query_var('paged')),
          'total' => $projects->max_num_pages
        )); ?>
      </div>
    </nav>
  <?php } else { ?>
    <p class="mb-0"><?php echo esc_html__('No result found!', 'prolancer'); ?></p>
  <?php } ?>
</div>