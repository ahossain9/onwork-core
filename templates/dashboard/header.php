<?php 
$buyer_id = get_user_meta( get_current_user_id(), 'buyer_id' , true );
$seller_id = get_user_meta( get_current_user_id(), 'seller_id' , true );
$visit_as = get_user_meta( get_current_user_id(), 'visit_as' , true );

global $wpdb;
$message_notification_query = "SELECT * FROM `prolancer_messages` WHERE `receiver_id` = '".get_current_user_id()."' ORDER BY timestamp DESC LIMIT 10";
$message_notifications = $wpdb->get_results($message_notification_query, ARRAY_A);

if($wpdb->get_var("SHOW TABLES LIKE 'prolancer_notifications'") == 'prolancer_notifications') {
	if($visit_as == 'buyer'){
		$notification_query = "SELECT * FROM `prolancer_notifications` WHERE `receiver_id` = ${buyer_id} AND `type` = 'other' ORDER BY timestamp DESC LIMIT 10";
	} elseif($visit_as == 'seller') {
		$notification_query = "SELECT * FROM `prolancer_notifications` WHERE `receiver_id` = ${seller_id} AND `type` = 'other' ORDER BY timestamp DESC LIMIT 10";
	}
	$notifications = $wpdb->get_results($notification_query, ARRAY_A);
} ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	 <?php wp_body_open(); ?>
	
	<?php 
	global $prolancer_opt;
	
	$site_preloader = !empty( $prolancer_opt['site_preloader'] ) ? $prolancer_opt['site_preloader'] : '';
	$prolancer_navbar_button_text =  !empty( $prolancer_opt['prolancer_navbar_button_text'] ) ? $prolancer_opt['prolancer_navbar_button_text'] : '';
	$prolancer_navbar_button_url =  !empty( $prolancer_opt['prolancer_navbar_button_url'] ) ? $prolancer_opt['prolancer_navbar_button_url'] : ''; ?>

	<?php if ($site_preloader): ?>
		<!-- Preloading -->
		<div id="preloader">
			<div class="spinner">
				<div class="uil-ripple-css" style="transform:scale(0.29);"><div></div><div></div></div>
			</div>
		</div>
	<?php endif ?>
	
	<header class="frontend-dashboard-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-2 col-lg-2 col-md-3 col-sm-8 col-8 col-xs-10 my-auto">
					<?php if (has_custom_logo()) {
			            the_custom_logo();
			        } else { ?>
			            <a class="navbar-logo-text" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			        <?php } ?>
				</div>				
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-1 col-1 d-none d-md-block my-auto offset-xl-4 offset-lg-3 text-center">
                    <div class="balance-in-navbar">
						<?php $price = get_user_meta( get_current_user_id(), 'wallet_balance' , true );
						
						if (function_exists('prolancer_get_currency_symbol')) {
                            echo esc_html(prolancer_get_currency_symbol($price));
                        } ?>
                    </div>
                </div>
				<div class="col-md-2 col-sm-4 col-4 my-auto">
					<div class="d-flex float-end">
						<div class="notifications-widget">
	                        <div class="notifications-button">
	                        	<i class="fas fa-fw fa-envelope"></i>
	                        	<?php
								if($message_notifications){
									foreach ($message_notifications as $notification) {
										if ($notification['read'] == false) {
											echo '<span class="count"></span>';
											break;
										};
									} 
								}?>	                        	
	                        </div>
	                        <?php if ($message_notifications) { ?>
	                        <div class="notifications-content message">
	                    		<ul class="list-unstyled">
	                    			<?php foreach ($message_notifications as $key => $notification) { ?>
	                    				<li>
	                    					<a href="<?php if(function_exists('prolancer_get_page_url_by_template')){ echo esc_url(prolancer_get_page_url_by_template('prolancer-dashboard.php'));} if(get_option('permalink_structure')){echo"?";}else{echo"&";} ?>fed=message" data-id="<?php echo esc_attr($notification['id']); ?>" data-nonce="<?php echo wp_create_nonce( 'notification_clicked_nonce' ) ?>">
	                    						<span class="d-flex">
	                    							<span class="pr-20">
	                    								<?php 
	                    								$sender_profile_image_id = get_posts(array(
	                    									'post_type'   => 'sellers',
	                    									'author' 	  => $notification['sender_id'],
	                    									'numberposts' => 1,
	                    								))[0]->ID;

			                    						$sender_image = wp_get_attachment_image ( onwork_get_image_id(get_post_meta($sender_profile_image_id, 'seller_profile_attachment', true )),array('50', '50') ,false);

											            if (!empty($sender_image)) {
											                echo wp_kses($sender_image,array(
											                    "img" => array(
											                        "src" => array(),
											                        "alt" => array(),
											                        "style" => array()
											                 	)
											                  ));
											            } else {
											                echo get_avatar($notification['sender_id'], 50 );
											            } ?>
													</span>
													<span>
														<p>
															<?php
															$user_name = get_post_meta($sender_profile_image_id, 'seller_profile_name', true );
															if (!empty($user_name)) {
																echo esc_html($user_name).esc_html__( ' has sent a message', 'prolancer' );
															} else {
																echo esc_html(get_the_author_meta('display_name', $notification['sender_id'])).esc_html__( ' has sent a message', 'prolancer' );
															} ?>
														</p>
														<small><?php echo esc_html( human_time_diff( strtotime( wp_date($notification['timestamp'])), current_time( 'timestamp' ))) . esc_html__(' ago','prolancer');?></small>
	                    							</span>
												<?php if ($notification['read'] == false) {?>
													<i class="fas fa-circle"></i>
												<?php } ?>
												</span>          					
		                    				</a>
	                    				</li>
	                    			<?php } ?>	                        		
	                        	</ul>                   	
	                        </div>
	                    	<?php } ?>
	                    </div>
						<div class="notifications-widget">
	                        <div class="notifications-button">
	                        	<i class="fas fa-fw fa-bell-on"></i>
	                        	<?php
								if($notifications){
									foreach ($notifications as $notification) {
										if ($notification['read'] == false) {
											echo '<span class="count"></span>';
											break;
										};
									} 
								}?>
	                        </div>
	                    	<?php if ($notifications) { ?>
	                        <div class="notifications-content">
	                    		<ul class="list-unstyled">
	                    			<?php foreach ($notifications as $key => $notification) { ?>
	                    				<li>
	                    					<a href="<?php echo esc_url($notification['url']); ?>" data-id="<?php echo esc_attr($notification['id']); ?>" data-nonce="<?php echo wp_create_nonce( 'notification_clicked_nonce' ) ?>">
	                    						<span class="d-flex">
	                    							<span class="pr-20">
	                    								<img src="<?php echo esc_url($notification['image']); ?>" alt="image">
													</span>
													<span>
														<p><?php echo esc_html($notification['title']);?></p>
														<small><?php echo esc_html( human_time_diff( strtotime( wp_date($notification['timestamp'])), current_time( 'timestamp' ))) . esc_html__( ' ago', 'prolancer' );?></small>
	                    							</span>
												<?php if ($notification['read'] == false) {?>
													<i class="fas fa-circle"></i>
												<?php } ?>   
												</span>          					
		                    				</a>
	                    				</li>
	                    			<?php } ?>	                        		
	                        	</ul>                   	
	                        </div>
	                    	<?php } ?>
	                    </div>
						<div class="my-account-widget">
	                        <div class="my-account-button">
	                            <?php if ( is_user_logged_in() ) { 
	                                if ($visit_as == 'buyer'){ ?>
	                                    <?php
										$buyer_image = wp_get_attachment_image ( onwork_get_image_id(get_post_meta($buyer_id, 'buyer_profile_attachment', true )),array('50', '50') ,false);
							            if (!empty($buyer_image)) {
							    			echo wp_kses($buyer_image,array(
							    				"img" => array(
											        "src" => array(),
											        "alt" => array(),
											        "style" => array()
											    )
							    			));
							    		} else {
							    			echo get_avatar( wp_get_current_user()->ID, 50 );
							    		} ?>
	                                <?php } elseif ($visit_as == 'seller'){ ?>
	                                    <?php
										$seller_image = wp_get_attachment_image ( onwork_get_image_id(get_post_meta($seller_id, 'seller_profile_attachment', true )),array('50', '50') ,false);

							    		if (!empty($seller_image)) {
							    			echo wp_kses($seller_image,array(
							    				"img" => array(
											        "src" => array(),
											        "alt" => array(),
											        "style" => array()
											    )
							    			));
							    		} else {
							    			echo get_avatar( wp_get_current_user()->ID, 50 );
							    		} ?>
	                                <?php } else { ?>
	                                    <i class="fal fa-fw fa-user"></i>
	                                <?php }
	                            } else { ?>
	                                <i class="fal fa-fw fa-user"></i>
	                            <?php } ?>
	                        </div>
	                        <div class="my-account-content">
	                            <?php if (is_user_logged_in()) { ?>
	                                <div class="header-profile">
	                                    <div class="header-profile-content">
	                                        <h6><?php echo wp_get_current_user()->display_name; ?></h6>
	                                        <p><?php echo wp_get_current_user()->user_email ?></p>
	                                    </div>
	                                </div>
	                                <ul class="list-unstyled">
	                                	<li>
	                                	<?php if($visit_as == 'buyer'){ ?>
				                            <a href="#" class="profile-switcher" data-visit-as="seller" data-nonce="<?php echo wp_create_nonce('profile_switcher'); ?>"><?php echo esc_html__( 'Switch to Selling', 'prolancer' ); ?></a>
				                        <?php } elseif($visit_as == 'seller') { ?>
				                            <a href="#" class="profile-switcher" data-visit-as="buyer" data-nonce="<?php echo wp_create_nonce('profile_switcher'); ?>"><?php echo esc_html__( 'Switch to Buying', 'prolancer' ); ?></a>
				                        <?php } ?>
				                        </li>
	                                    <li>
	                                    	<a href="<?php echo esc_url( wp_logout_url() ); ?>"><?php echo esc_html__( 'Logout','prolancer' ) ?></a>
	                                	</li>
	                                </ul>
	                            <?php } ?>
	                        </div>
	                    </div>
                    </div>
				</div>
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-0 col-0 col-xs-4 d-none d-md-block p-0 my-auto">
                    <div class="header-btn">
                        <?php if($visit_as == 'buyer'){ ?>
                            <a href="#" class="profile-switcher" data-visit-as="seller" data-nonce="<?php echo wp_create_nonce('profile_switcher'); ?>"><?php echo esc_html__( 'Switch to Selling', 'prolancer' ); ?></a>
                        <?php } elseif($visit_as == 'seller') { ?>
                            <a href="#" class="profile-switcher" data-visit-as="buyer" data-nonce="<?php echo wp_create_nonce('profile_switcher'); ?>"><?php echo esc_html__( 'Switch to Buying', 'prolancer' ); ?></a>
                        <?php } ?>
                    </div>
                </div>
			</div>
		</div>
	</header>