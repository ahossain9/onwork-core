<?php 
$buyer_id = get_user_meta( get_current_user_id(), 'buyer_id' , true );
global $wpdb;

// Services
$table ='prolancer_service_orders';

if($wpdb->get_var("SHOW TABLES LIKE ${table}") == $table) {
  $query = "SELECT * FROM ${table} WHERE `buyer_id` = ${buyer_id} AND `status` ='cancel' ORDER BY timestamp DESC";
  	$services = $wpdb->get_results($query, ARRAY_A);
	foreach( $services as $index => $service ) {
	   $service_array[] = $service['service_id'];
	   $service_seller_array[] = $service['seller_id'];
	}
}

// Projects
$table ='prolancer_project_proposals';
    
if($wpdb->get_var("SHOW TABLES LIKE ${table}") == $table) {
  $query = "SELECT * FROM ${table} WHERE `buyer_id` = ${buyer_id} AND `status` ='cancel' ORDER BY timestamp DESC";
	$projects = $wpdb->get_results($query, ARRAY_A);
	foreach( $projects as $index => $project ) {
	   $project_array[] = $project['project_id'];
	   $project_seller_array[] = $project['seller_id'];
	}
}

if (isset($service_array) & isset($project_array)) {
	$post_ids = array_merge($service_array, $project_array);
	$seller_ids = array_merge($service_seller_array, $project_seller_array);	
} elseif(isset($project_array)){
	$post_ids = $project_array;
	$seller_ids = $project_seller_array;
} elseif(isset($service_array)){
	$post_ids = $service_array;
	$seller_ids = $service_seller_array;
}

$payouts = new WP_Query( array( 
    'post_type' => 'disputes',
    'author' => get_current_user_id(),
    'post_status' => array( 'pending', 'publish', 'private' )
)); ?>

<div class="white-padding mb-4">
	<h2 class="mb-0"><?php echo esc_html__( 'Disputes', 'prolancer' ); ?></h2>
</div>

<div class="cotainer">
	<div class="row">
		<div class="col-md-12">
			<div class="disputes white-padding mb-4">
				<form id="disputes-form" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<select class="mb-4" name="dispute-id">
								<?php
								if (array_unique($post_ids)) {
									foreach (array_unique($post_ids) as $id){ ?>						
									<option value="<?php echo esc_attr( $id ); ?>"><?php echo get_the_title( $id ); ?></option>
								<?php }
								 } ?>
							</select>
						</div>
						<div class="col-md-6">
							<select class="mb-4" name="seller-id">
								<?php
								if (array_unique($seller_ids)) {
									foreach (array_unique($seller_ids) as $id){?>						
									<option value="<?php echo esc_attr( $id ); ?>">
										<?php
										$user_name = get_the_title( $id );
										if (!empty($user_name)) {
											echo esc_html($user_name);
										} else {
											echo esc_html(get_the_author_meta('display_name', get_post_field('post_author', $id)));
										} ?>
									</option>
								<?php }
								 } ?>
							</select>
						</div>
					</div>
					<input class="mb-3" type="number" name="amount" placeholder="<?php echo esc_attr__('Price','prolancer'); ?>">
					<textarea class="mb-3" name="dispute-details" placeholder="<?php echo esc_attr__( 'Tell us detail...', 'prolancer' ); ?>"></textarea>
					<a href="#" id="open-dispute" class="prolancer-btn" data-nonce="<?php echo wp_create_nonce('open_dispute_nonce'); ?>"><?php echo esc_html__( 'Open Dispute', 'prolancer' ); ?></a>
				</form>
			</div>

			<?php if ($payouts->have_posts()){ ?>			
				<div class="white-padding">
					<div class="row">
						<div class="col-md-12">
							<h3><?php echo esc_html__( 'Disputes', 'prolancer' ); ?></h3>
							<div class="table-responsive mt-4">
								<table  class="prolancer-table">
									<thead>
										<tr>
										  <th scope="col">#</th>
										  <th scope="col"><?php echo esc_html__( 'Project', 'prolancer' ); ?></th>
										  <th scope="col"><?php echo esc_html__( 'Seller', 'prolancer' ); ?></th>
										  <th scope="col"><?php echo esc_html__( 'Date', 'prolancer' ); ?></th>
										  <th scope="col"><?php echo esc_html__( 'Amount', 'prolancer' ); ?></th>
										  <th scope="col"><?php echo esc_html__( 'Status', 'prolancer' ); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$count =1;
								    while ( $payouts->have_posts() ) { $payouts->the_post(); ?>
											<tr>
												<th scope="row"><?php echo esc_html( $count++ ); ?></th>
												<td><?php the_title(); ?></td>
												<td><?php echo esc_html( get_post_meta( get_the_ID(), 'dispute_seller' , true ) ); ?></td>
												<td><?php echo get_the_modified_date() ?></td>								
												<td>
													<?php if (function_exists('prolancer_get_currency_symbol')) {
								            echo esc_html(prolancer_get_currency_symbol(get_post_meta( get_the_ID(), 'dispute_price' , true )));
								          } ?>
								        </td>
												<td>
													<?php
												    if ( get_post_status ( get_the_ID() ) == 'pending' ) {
												        echo esc_html__( 'Pending', 'prolancer' );
												    } elseif( get_post_status ( get_the_ID() ) == 'private' ) {
												        echo esc_html__( 'Dispute Finished', 'prolancer' );
												    }
													?>	
												</td>
											</tr>
										<?php }; wp_reset_postdata(); ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>
		    <div class="white-padding">
		      <p class="mb-0"><?php echo esc_html__( 'No result found!','prolancer' ); ?></p>
		    </div>
		  <?php } ?>
		</div>
	</div>
</div>