<?php 
$seller_id = get_user_meta( get_current_user_id(), 'seller_id' , true );

do_action( 'wp_enqueue_scripts', $seller_id );

if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} else if ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}

$services = new WP_Query(array(
	'author__in' => array( get_current_user_id() ),
	'post_type' =>'services',
	'paged' => $paged,	
	'post_status' => 'publish'													
)); 

if( is_user_logged_in() ){
    $seller_id = get_user_meta( get_current_user_id(), 'seller_id' , true );
    global $wpdb;
    $table ='prolancer_service_orders';
    
    if($wpdb->get_var("SHOW TABLES LIKE ${table}") == $table) {
      $query = "SELECT * FROM ${table} WHERE `seller_id` = ${seller_id} AND `status` ='ongoing' ORDER BY timestamp DESC";
      $ongoing_service_count = $wpdb->get_results($query, ARRAY_A);
    }
    
    if($wpdb->get_var("SHOW TABLES LIKE ${table}") == $table) {
      $query = "SELECT * FROM ${table} WHERE `seller_id` = ${seller_id} AND `status` ='complete' ORDER BY timestamp DESC";
      $complete_service_count = $wpdb->get_results($query, ARRAY_A);
    }
} ?>

<div class="white-padding mb-4">
	<h2 class="mb-0"><?php echo esc_html__( 'Seller dashboard', 'prolancer' ); ?></h2>
</div>

 <div class="row stats">
 	<div class="col-lg-4">
 		<a href="<?php if(function_exists('prolancer_get_page_url_by_template')){ echo esc_url(prolancer_get_page_url_by_template('prolancer-dashboard.php'));} if(get_option('permalink_structure')){echo"?";}else{echo"&";} ?>fed=services" class="dashboard-stats-item"> 		
	 		<h1><?php echo esc_html( $services->found_posts ); ?></h1>
	 		<h5><?php echo esc_html__( 'Active Services', 'prolancer' ); ?></h5>
	 	</a>
 	</div>
 	<div class="col-lg-4">
 		<a href="<?php if(function_exists('prolancer_get_page_url_by_template')){ echo esc_url(prolancer_get_page_url_by_template('prolancer-dashboard.php'));} if(get_option('permalink_structure')){echo"?";}else{echo"&";} ?>fed=ongoing-services" class="dashboard-stats-item"> 		
	 		<h1><?php echo esc_html( count($ongoing_service_count) ); ?></h1>
	 		<h5><?php echo esc_html__( 'Ongoing Services', 'prolancer' ); ?></h5>
	 	</a>
 	</div>
 	<div class="col-lg-4">
 		<a href="<?php if(function_exists('prolancer_get_page_url_by_template')){ echo esc_url(prolancer_get_page_url_by_template('prolancer-dashboard.php'));} if(get_option('permalink_structure')){echo"?";}else{echo"&";} ?>fed=completed-services" class="dashboard-stats-item"> 		
	 		<h1><?php echo esc_html( count($complete_service_count) ); ?></h1>
	 		<h5><?php echo esc_html__( 'Complete Services', 'prolancer' ); ?></h5>
	 	</a>
 	</div>
</div>

<div class="white-padding mt-4">
	<h3><?php echo esc_html__( 'Views', 'prolancer' ) ?></h3>
	<div id="curve_chart"></div>
</div>