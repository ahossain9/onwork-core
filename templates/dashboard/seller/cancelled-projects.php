<div class="white-padding mb-4">
  <h2 class="mb-0"><?php echo esc_html__( 'Ongoing Projects', 'prolancer' ); ?></h2>
</div>

<div class="white-padding">
  <?php
  if( is_user_logged_in() ){
    $seller_id = get_user_meta( get_current_user_id(), 'seller_id' , true );
    global $wpdb;
    $table ='prolancer_project_proposals';

    $total = $wpdb->get_var("SELECT COUNT(*) FROM ${table}");
    $items_per_page = get_option('posts_per_page');    
    $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
    $offset = ( $page * $items_per_page ) - $items_per_page;
    
    if($wpdb->get_var("SHOW TABLES LIKE ${table}") == $table) {
      $query = "SELECT * FROM ${table} WHERE `seller_id` = ${seller_id} AND `status` ='ongoing' ORDER BY timestamp DESC ${offset}, ${items_per_page}";
      $results = $wpdb->get_results($query, ARRAY_A);
    }
  }
 
  if ($results){ ?>
  <div class="table-responsive">
    <table class="prolancer-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"><?php echo esc_html__( 'Buyer' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Project' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Day to complete' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Price' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Proposed Price' , 'prolancer'); ?></th>
          <th scope="col"><?php echo esc_html__( 'Action' , 'prolancer'); ?></th>
        </tr>
      </thead>
      <tbody>
      <?php
        $count =1;
        foreach ($results as $result){ 

        $project_id = $result['project_id'];
        $buyer_id = $result['buyer_id'];
        
        $project = get_post($project_id); 
        ?>

        <tr>
          <th scope="row"><?php echo esc_html( $count++ ); ?></th>
          <td>
            <a href="<?php echo esc_url(get_the_permalink($buyer_id)) ?>" target="_blank">
              <?php $buyer_image = wp_get_attachment_image ( prolancer_get_image_id(get_post_meta($buyer_id, 'buyer_profile_attachment', true )),array('50', '50') ,false);

              if (!empty($buyer_image)) {
                  echo wp_kses($buyer_image,array(
                    "img" => array(
                        "src" => array(),
                        "alt" => array(),
                        "style" => array()
                    )
                  ));
              } else {
                  echo get_avatar( get_post_field('post_author', $buyer_id), 50 );
              } ?>
            </a>
          </td>
          <td>
            <a href="<?php echo get_the_permalink($project_id); ?>" target="_blank"><?php echo esc_html( $project->post_title ); ?></a>
          </td>
          <td><?php if (get_term_by( 'id', $result['day_to_complete'], 'project-duration' )) {echo esc_html(get_term_by( 'id', $result['day_to_complete'], 'project-duration' )->name);} ?></td>
          <td>
            <?php
            $price = get_post_meta($project_id, 'project_price', true);
            
            if (function_exists('prolancer_get_currency_symbol')) {
              echo esc_html(prolancer_get_currency_symbol($price));
            } ?>
          </td>
          <td>
            <?php if (function_exists('prolancer_get_currency_symbol')) {
              echo esc_html(prolancer_get_currency_symbol($result['proposed_price']));
            } ?>
          </td>
          <td>
            <a href="<?php if(function_exists('prolancer_get_page_url_by_template')){ echo esc_url(prolancer_get_page_url_by_template('prolancer-dashboard.php'));} if(get_option('permalink_structure')){echo"?";}else{echo"&";} ?>fed=ongoing-project-details&proposal_id=<?php echo esc_attr( $result['id'] ); ?>" class="prolancer-btn small-btn text-white"><?php echo esc_html__( 'Details', 'prolancer' ); ?></a>
          </td>
        </tr>          
        <?php } ?>
      </tbody>
    </table>
  </div>
  <nav class="navigation pagination mt-5">
    <div class="nav-links">
      <?php 
      echo paginate_links( array(
            'base' => add_query_arg( 'cpage', '%#%' ),
            'format' => '?paged=%#%',
            'current' => $page,
            'total' => ceil($total / $items_per_page)
        )); ?>
    </div>
  </nav>
  <?php } else{ ?>
      <p class="mb-0"><?php echo esc_html__( 'No result found!','prolancer' ); ?></p>
  <?php } ?>
</div>