<div class="white-padding mb-4">
  <h2 class="mb-0"><?php echo esc_html__( 'Services', 'prolancer' ); ?></h2>
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

  $services = new WP_Query( array( 
    'author__in' => array( get_current_user_id() ),
    'post_type' =>'services',
    'paged' => $paged,
    'post_status' => ['publish','pending'],
    'orderby' => 'date',
    'order'   => 'DESC',                        
  )); 
  if ($services->have_posts()){
  ?>
  <div class="table-responsive">
    <table class="prolancer-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"><?php echo esc_html__( 'Title' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Status' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Delivery time' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Price' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Action' , 'prolancer'); ?></th>
        </tr>
      </thead>
      <tbody>
      <?php      
        $count = 1;
        while ( $services->have_posts() ) : $services->the_post(); 

        $packages = json_decode(get_post_meta(get_the_ID(), 'packages', true ), true); 
        $delivery_time = get_term_by( 'id', $packages[0]['delivery_time'], 'delivery-time' );
        $price = $packages[0]['price']; ?>
        <tr>
          <th scope="row"><?php echo esc_html( $count++ ); ?></th>
          <td><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></td>        
          <td>
          <?php
              if ( get_post_status ( get_the_ID() ) == 'publish' ) {
                  echo esc_html__( 'Approved' , 'prolancer');
              } elseif ( get_post_status ( get_the_ID() ) == 'pending' ) {
                  echo esc_html__( 'Pending' , 'prolancer');
              }
          ?>
          </td>
          <td>
          <?php if ($delivery_time) {echo esc_html($delivery_time->name);} ?>          
          </td>
          <td>
            <?php if (function_exists('prolancer_get_currency_symbol')) {
              echo esc_html(prolancer_get_currency_symbol($price));
            } ?>
          </td>
          <td>
            <ul class="list-inline">
              <li class="list-inline-item"><a href="<?php if(function_exists('prolancer_get_page_url_by_template')){ echo esc_url(prolancer_get_page_url_by_template('prolancer-dashboard.php'));} if(get_option('permalink_structure')){echo"?";}else{echo"&";} ?>fed=create-service&service_id=<?php echo get_the_ID(); ?>"><i class="fad fa-edit"></i></a></li>
              <li class="list-inline-item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo get_the_ID(); ?>">
                  <i class="fad fa-trash-alt"></i>
                </a>           
                <!-- Modal -->
                <div class="modal fade" id="delete<?php echo get_the_ID(); ?>" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel"><?php echo esc_html__( 'Delete Service', 'prolancer' ) ; ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p><?php echo esc_html__('Are you sure?','prolancer'); ?></p>
                          <a href="#" class="delete-service btn btn-danger text-white" data-nonce="<?php echo wp_create_nonce('delete_service_nonce'); ?>" data-service-id="<?php echo get_the_ID(); ?>"><?php echo esc_html__( 'Delete', 'prolancer' ); ?></a>
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
  <nav class="navigation pagination mt-5">
    <div class="nav-links">
      <?php $big = 999999999; // need an unlikely integer
       
      echo paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => max( 1, get_query_var('paged') ),
          'total' => $services->max_num_pages
      )); ?>
    </div>
  </nav>
  <?php } else{ ?>
      <p class="mb-0"><?php echo esc_html__( 'No result found!','prolancer' ); ?></p>
  <?php } ?>
</div>