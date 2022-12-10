<div class="white-padding mb-4">
  <h2 class="mb-0"><?php echo esc_html__( 'Projects Wishlist', 'prolancer' ); ?></h2>
</div>

<div class="white-padding">
  <?php 
  if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
  } else if ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
  } else {
    $paged = 1;
  }

  global $wpdb;
  $current_user_id  = get_current_user_id();
  $data = $wpdb->get_results( "SELECT meta_value FROM $wpdb->usermeta WHERE user_id = '$current_user_id' AND meta_key LIKE 'project_wishlist_id_%'" );

  $project_ids = [];
  if ($data) {
    foreach ($data as $value) {
       $project_ids[] = $value->meta_value;
    }
  }

  if ($project_ids) {
    $projects = new WP_Query( array(
      'post_type' =>'projects',
      'paged' => $paged,
      'post__in' => $project_ids,
      'post_status' => 'publish',
      'orderby' => 'date',
      'order'   => 'DESC',                        
    ));
  }

  if ($project_ids && $projects->have_posts()){ ?>
  <div class="table-responsive">
    <table class="prolancer-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"><?php echo esc_html__( 'Title' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Category' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Project type' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Budget' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Action' , 'prolancer'); ?></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $count = 1;
        while ( $projects->have_posts() ) : $projects->the_post(); ?>
        <tr>
          <th scope="row"><?php echo esc_html( $count++ ); ?></th>
          <td><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></td>
          <td>
            <?php echo esc_html( get_the_terms( get_the_ID(), 'project-categories' )[0]->name ); ?>
          </td>
          <td>
            <?php echo esc_html( get_post_meta( get_the_ID(), 'project_type', true )); ?>
          </td>
          <td>
            <?php $price = get_post_meta(get_the_ID(), 'project_price', true);
            
            if (function_exists('prolancer_get_currency_symbol')) {
              echo esc_html(prolancer_get_currency_symbol($price));
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
                          <h5 class="modal-title" id="staticBackdropLabel"><?php echo esc_html__( 'Remove Project', 'prolancer' ) ; ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p><?php echo esc_html__('Are you sure?','prolancer'); ?></p>
                          <a href="#" class="remove-wishlist-project btn btn-danger text-white" data-nonce="<?php echo wp_create_nonce('remove_wishlist_project_nonce'); ?>" data-id="<?php echo get_the_ID(); ?>"><?php echo esc_html__( 'Remove', 'prolancer' ); ?></a>
                        </div>
                      </div>
                  </div>
                </div>

              </li>
            </ul>
          </td>
        </tr>
        <?php endwhile; wp_reset_postdata(); ?>
      </tbody>
    </table>
  </div>
  <?php } else { ?>
      <p class="mb-0"><?php echo esc_html__( 'No result found!','prolancer' ); ?></p>
  <?php } ?>
</div>