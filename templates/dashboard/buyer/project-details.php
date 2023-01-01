<div class="white-padding mb-4">
  <h2 class="mb-0"><?php echo esc_html__('Project', 'prolancer'); ?></h2>
</div>

<div class="table-responsive">
  <table class="prolancer-table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col"><?php echo esc_html__('Title', 'prolancer'); ?></th>
        <th scope="col"><?php echo esc_html__('Category', 'prolancer'); ?></th>
        <th scope="col"><?php echo esc_html__('Cost', 'prolancer'); ?></th>
        <th scope="col"><?php echo esc_html__('Status', 'prolancer'); ?></th>
        <th scope="col"><?php echo esc_html__('Proposal', 'prolancer'); ?></th>
        <th scope="col"><?php echo esc_html__('Action', 'prolancer'); ?></th>
      </tr>
    </thead>
    <tbody>
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

      $count = 1;
      while ($projects->have_posts()) : $projects->the_post(); ?>

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
          <td><?php echo esc_html($projects->post->post_status); ?></td>
          <td><a href="<?php if (function_exists('onwork_get_page_url_by_template')) {
                          echo esc_url(onwork_get_page_url_by_template('onwork-dashboard.php'));
                        }
                        if (get_option('permalink_structure')) {
                          echo "?";
                        } else {
                          echo "&";
                        } ?>fed=proposals&project_id=<?php echo get_the_ID(); ?>"><?php echo esc_html__('Proposal', 'prolancer'); ?></a></td>
          <td>
            <ul class="list-inline">
              <li class="list-inline-item"><a href="<?php if (function_exists('onwork_get_page_url_by_template')) {
                                                      echo esc_url(onwork_get_page_url_by_template('onwork-dashboard.php'));
                                                    }
                                                    if (get_option('permalink_structure')) {
                                                      echo "?";
                                                    } else {
                                                      echo "&";
                                                    } ?>fed=create-project&project_id=<?php echo get_the_ID(); ?>"><i class="fad fa-edit"></i></a></li>
              <li class="list-inline-item"><a href="#" class="cancel_project" data-project-id="<?php echo get_the_ID(); ?>"><i class="fad fa-trash-alt"></i></a></li>
            </ul>
          </td>
        </tr>
      <?php endwhile;
      wp_reset_postdata(); ?>

    </tbody>
  </table>
</div>