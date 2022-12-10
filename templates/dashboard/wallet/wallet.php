<?php if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	// Get all customer orders
	$customer_orders = get_posts( array(
	    'numberposts' => -1,
	    'meta_key'    => '_customer_user',
	    'meta_value'  => get_current_user_id(),
	    'post_type'   => wc_get_order_types(),
	    'post_status' => array_keys( wc_get_order_statuses() ),
	));

	$total_order = count($customer_orders);

	$orders_per_page = get_option('posts_per_page');

	$total_pages = ceil($total_order / $orders_per_page);

	if ( get_query_var( 'paged' ) ) {
	  $paged = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
	  $paged = get_query_var( 'page' );
	} else {
	  $paged = 1;
	}

	if(class_exists( 'WooCommerce' )){
		$orders = get_posts(array(
			'meta_key' => '_customer_user',
			'meta_value' => get_current_user_id(),
			'post_type' => wc_get_order_types('view-orders'),
			'posts_per_page' => $orders_per_page,
			'paged' => $paged,
			'post_status' => 'all'
		));

		$all_orders = [];
	    foreach ($orders as $order) {
	    $order = wc_get_order($order);
			$order_items = $order->get_items();
			foreach ( $order_items as $item ) {
				$product_name = $item->get_name();
			}

			if ($product_name == 'Recharge wallet') {
				$all_orders[] = [
		            "ID" => $order->get_id(),
		            "price" => $order->get_total(),
					"product_name" => $product_name,
		            "date" => $order->get_date_created()->date_i18n('Y-m-d'),
					"status" => $order->get_status(),
		        ];
			}
	    }
	}

} ?>


<div class="white-padding mb-4">
	<h2 class="mb-0"><?php echo esc_html__( 'Wallet', 'prolancer' ); ?></h2>
</div>

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="white-padding">
			<h4 class="mb-4"><?php echo esc_html__( 'Recharge your wallet', 'prolancer' ); ?></h4>
			<form id="wallet-recharge-form" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-9 my-auto">
						<input type="number" name='wallet_amount' class="form-control" placeholder="<?php echo esc_attr__('Amount','prolancer'); ?>">
					</div>
					<div class="col-md-3 my-auto">
						<a href="#" id="wallet-recharge" class="prolancer-btn w-100 text-center" data-nonce="<?php echo wp_create_nonce('create_wallet_nonce'); ?>"><?php echo esc_html__( 'Deposit', 'prolancer' ); ?></a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-12">
		<div class="white-padding">
			<?php 
			if(class_exists( 'WooCommerce' )){
				if ($all_orders){ ?>
				<div class="table-responsive">
					<table class="prolancer-table">
					  	<thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col"><?php echo esc_html__('Order','prolancer')?></th>
						      <th scope="col"><?php echo esc_html__('Recharged','prolancer')?></th>
						      <th scope="col"><?php echo esc_html__('Payment Status','prolancer')?></th>
						    </tr>
					  	</thead>
					  	<tbody>
					  		<?php
					  		$count = 1;
					  		foreach ($all_orders as $key => $order ) { ?>
					  			<tr>
							      	<th scope="row"><?php echo esc_html( $key ) + 1; ?></th>
							      	<td><?php echo esc_html($order['product_name']); ?></td>
							      	<td>
								      	<?php if (function_exists('prolancer_get_currency_symbol')) {
							            	echo esc_html(prolancer_get_currency_symbol($order['price']));
							          	} ?>
							       </td>
							      	<td><?php echo esc_html($order['status']); ?></td>
							    </tr>
					  		<?php
						  		$count++; 
						  	} ?>			    
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
						    'total' => $total_pages
						)); ?>
					</div>
				</nav>
				<?php } else { ?>
			     <p class="mb-0"><?php echo esc_html__( 'No recharge found!','prolancer' ); ?></p>
				<?php }
			}  ?>
		</div>
	</div>
</div>