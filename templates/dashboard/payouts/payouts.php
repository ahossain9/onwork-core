<?php 

global $prolancer_opt;

$minimum_threshold = !empty( $prolancer_opt['minimum_threshold'] ) ? $prolancer_opt['minimum_threshold'] : ''; 
if(class_exists( 'WooCommerce' )){
	$woo_countries = new WC_Countries();
	$countries = $woo_countries->get_allowed_countries();
}
$payout_methods_data = json_decode(get_user_meta( get_current_user_id(), 'payout_methods_data' , true ), true);
$wallet_balance = get_user_meta( get_current_user_id(), 'wallet_balance' , true ); ?>

<div class="white-padding mb-4">
	<h2 class="mb-0"><?php echo esc_html__( 'Payout', 'prolancer' ); ?></h2>
</div>

<div class="white-padding mb-4">
	<div class="row">
		<div class="col"><h4 class="mb-0"><?php echo esc_html__( 'Balance', 'prolancer' ); ?></h4></div>
		<div class="col">
			<h4 class="mb-0 text-end">
				<?php $price = get_user_meta( get_current_user_id(), 'wallet_balance' , true );
				
				if (function_exists('prolancer_get_currency_symbol')) {
		        	echo esc_html(prolancer_get_currency_symbol($price));
		        } ?>
			</h4>
		</div>
	</div>
</div>

<div class="cotainer">
	<div class="row">
		<div class="col-md-12">
			<div class="white-padding mb-4">
				<form id="payout-form" enctype="multipart/form-data">
					<div class="payout-methods">
						<ul class="nav nav-tabs mb-3">
	                      <li class="nav-item">                        
	                        <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#paypal" role="tab" aria-selected="true"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/paypal.png') ?>" alt="<? echo esc_attr__('Paypal','prolancer'); ?>"><?php echo  esc_html__('Paypal','prolancer'); ?></a>
	                      </li>
	                      <li class="nav-item">
	                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#payoneer" role="tab" aria-selected="false"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/payoneer.png') ?>" alt="<? echo esc_attr__('Payoneer','prolancer'); ?>"><?php echo esc_html__('Payoneer','prolancer'); ?></a>
	                      </li>
	                      <li class="nav-item">
	                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#bank" role="tab"aria-selected="false"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/bank.png') ?>" alt="<? echo esc_attr__('Bank','prolancer'); ?>"><?php echo esc_html__('Bank','prolancer'); ?></a>
	                      </li>
	                    </ul>
	                    <div class="tab-content">
	                     	<div class="tab-pane fade active show" id="paypal" role="tabpanel">
	                     		<div class="form-control">
	                     			<input type="email" name="paypal-email" placeholder="<?php echo esc_attr__( 'Email','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['paypal-email'] );} ?>">
	                     		</div>
	                     	</div>
	                     	<div class="tab-pane fade" id="payoneer" role="tabpanel">                     		
	                     		<div class="form-control">
	                     			<input type="email" name="payoneer-email" placeholder="<?php echo esc_attr__( 'Email','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['payoneer-email'] );} ?>">
	                     		</div>
	                     	</div>
	                     	<div class="tab-pane fade" id="bank" role="tabpanel">
	                     		<div class="row">
	                     			<div class="col-md-6">
	                     				<div class="form-control">
	                     					<input type="text" name="first-name" placeholder="<?php echo esc_attr__( 'First Name','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['first-name'] );} ?>">
	                     				</div>
	                     			</div>
	                     			<div class="col-md-6">
	                     				<div class="form-control">
			                     			<input type="text" name="last-name" placeholder="<?php echo esc_attr__( 'Last Name','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['last-name'] );} ?>">
			                     		</div>
	                     			</div>
	                     			<div class="col-md-12">
	                     				<div class="form-control">
			                     			<input type="text" name="address" placeholder="<?php echo esc_attr__( 'Your address','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['address'] );} ?>">
			                     		</div>
	                     			</div>
	                     			<div class="col-md-12">
	                     				<div class="form-control">
	                     					<select name="country" id="customer_order_status">
	                     						<?php
	                     						if ($countries) {
	                     							foreach ($countries as $key => $country) { ?>
	                     							<option value="<?php echo esc_attr( $country ) ?>" <?php selected( $payout_methods_data['country'], $country ); ?>><?php echo esc_html( $country ) ?></option>
	                     						<?php }
	                     						} ?>
				                            </select>
			                     		</div>
	                     			</div>
	                     			<div class="col-md-12">
	                     				<div class="form-control">
			                     			<input type="text" name="routing-number" placeholder="<?php echo esc_attr__( 'Routing number','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['routing-number'] );} ?>">
			                     		</div>
	                     			</div>
	                     			<div class="col-md-12">
	                     				<div class="form-control">
			                     			<input type="text" name="iban" placeholder="<?php echo esc_attr__( 'IBAN','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['iban'] );} ?>">
			                     		</div>
	                     			</div>
	                     			<div class="col-md-12">
	                     				<div class="form-control">
			                     			<input type="text" name="bic-swift-code" placeholder="<?php echo esc_attr__( 'BIC / SWIFT-code','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['bic-swift-code'] );} ?>">
			                     		</div>
	                     			</div>
	                     			<div class="col-md-12">
	                     				<div class="form-control">
			                     			<input type="text" name="bank-name" placeholder="<?php echo esc_attr__( 'Bank name','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['bank-name'] );} ?>">
			                     		</div>
	                     			</div>
	                     			<div class="col-md-12">
	                     				<div class="form-control">
			                     			<input type="text" name="bank-account-number" placeholder="<?php echo esc_attr__( 'Bank account number','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['bank-account-number'] );} ?>">
			                     		</div>
	                     			</div>
	                     			<div class="col-md-12">
	                     				<div class="form-control">
			                     			<input type="text" name="bank-address" placeholder="<?php echo esc_attr__( 'Bank address','prolancer' ); ?>" value="<?php if($payout_methods_data){ echo esc_attr( $payout_methods_data['bank-address'] );} ?>">
			                     		</div>
	                     			</div>
	                     		</div>
	                     	</div>
	                  	</div>

						<a href="#" id="save-payout-methods" class="prolancer-btn mt-3" data-nonce="<?php echo wp_create_nonce('payout_methods_nonce'); ?>"><?php echo esc_html__( 'Save method', 'prolancer' ); ?></a>
	              	</div>
				</form>
			</div>
		</div>
	</div>

	<?php if ($payout_methods_data): ?>
	<div class="white-padding mb-4">
		<form id="withdrawal-form" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<div class="form-control">
						<select name="payout-method">
							<?php if ($payout_methods_data['paypal-email']){ ?>
							<option value="paypal">
								<?php echo esc_html__('Paypal','prolancer'); ?>
							</option>
							<?php }
							if ($payout_methods_data['payoneer-email']) { ?>
							<option value="payoneer">
								<?php echo esc_html__('Payoneer','prolancer'); ?>
							</option>
							} ?>
							<?php }
							if ($payout_methods_data['bank-account-number']) { ?>
							<option value="bank">
								<?php echo esc_html__('Bank','prolancer'); ?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-control">
						<input type="number" name="payout-amount" placeholder="<?php echo esc_html__( 'Amount', 'prolancer' );?>" required min="<?php echo esc_attr( $minimum_threshold ); ?>" <?php if ( $minimum_threshold > $wallet_balance ){echo "disabled";} ?>>
					</div>
				</div>
				<div class="col-md-12">
					<a href="#" id="withdrawal-request" class="prolancer-btn mt-4" data-nonce="<?php echo wp_create_nonce('payment_withdraw_nonce'); ?>"><?php echo esc_html__( 'Withdrawal request', 'prolancer' ); ?></a>
				</div>
			</div>
		</form>	
	</div>
	<?php endif ?>
	
	<div class="white-padding">
		<div class="row">
			<div class="col-md-12">
				<h3><?php echo esc_html__( 'Withdraw', 'prolancer' ); ?></h3>
				<?php 
				$payouts = new WP_Query( array( 
		            'post_type' => 'payouts',
		            'author' => get_current_user_id(),
		            'post_status' => array( 'pending', 'publish', 'private' )
		        ));

		        if ($payouts->have_posts()) { ?>
			        <div class="table-responsive mt-4">
						<table class="table">
							<thead>
								<tr>
								  <th scope="col">#</th>
								  <th scope="col"><?php echo esc_html__( 'Method', 'prolancer' ); ?></th>
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
										<td><?php echo esc_html( get_post_meta( get_the_ID(), 'payout_method' , true ) ); ?></td>
										<td><?php echo get_the_modified_date() ?></td>								
										<td>
											<?php if (function_exists('prolancer_get_currency_symbol')) {
									        	echo esc_html(prolancer_get_currency_symbol(get_post_meta( get_the_ID(), 'payout_amount' , true )));
									        } ?>									        	
									    </td>
										<td>
											<?php
											    if ( get_post_status ( get_the_ID() ) == 'pending' ) {
											        echo esc_html__( 'Pending', 'prolancer' );
											    } elseif( get_post_status ( get_the_ID() ) == 'publish' ) {
											        echo esc_html__( 'Complete', 'prolancer' );
											    } elseif( get_post_status ( get_the_ID() ) == 'private' ) {
											        echo esc_html__( 'Rejected', 'prolancer' );
											    }
											?>	
										</td>
									</tr>
								<?php }; wp_reset_postdata(); ?>
							</tbody>
						</table>
					</div>
				<?php } else { ?>
				     <p class="mb-0"><?php echo esc_html__( 'No result found!','prolancer' ); ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>