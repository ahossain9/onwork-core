<?php if (!empty($_GET['project_id'])) {
	$project_id = $_GET['project_id'];
} ?>


<div class="white-padding mb-4">
	<h2 class="mb-0"><?php echo esc_html__('Proposals', 'prolancer'); ?></h2>
</div>

<div class="white-padding">
	<?php
	if (is_user_logged_in()) {
		$buyer_id = get_user_meta(get_current_user_id(), 'buyer_id', true);
		global $wpdb;
		$table = 'onwork_project_proposals';

		$total = $wpdb->get_var("SELECT COUNT(*) FROM ${table} WHERE `buyer_id` = ${buyer_id} AND `status` = 'pending'");
		$items_per_page = get_option('posts_per_page');
		$page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;
		$offset = ($page * $items_per_page) - $items_per_page;

		if ($wpdb->get_var("SHOW TABLES LIKE '${table}'") == $table) {
			$query = "SELECT * FROM ${table} WHERE `buyer_id` = ${buyer_id} AND `status` = 'pending' ORDER BY timestamp DESC LIMIT ${offset}, ${items_per_page}";
			$results = $wpdb->get_results($query, ARRAY_A);
		}
	}

	if ($results) { ?>
		<div class="table-responsive">
			<table class="prolancer-table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col"><?php echo esc_html__('Seller', 'prolancer'); ?></th>
						<th scope="col"><?php echo esc_html__('Project', 'prolancer'); ?></th>
						<th scope="col"><?php echo esc_html__('Day to complete', 'prolancer'); ?></th>
						<th scope="col"><?php echo esc_html__('Price', 'prolancer'); ?></th>
						<th scope="col"><?php echo esc_html__('Proposed Price', 'prolancer'); ?></th>
						<th scope="col"><?php echo esc_html__('Cover Letter', 'prolancer'); ?></th>
						<th scope="col"><?php echo esc_html__('Action', 'prolancer'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					foreach ($results as $result) {
						$project_id = $result['project_id'];
						$seller_id = $result['seller_id'];
						$project = get_post($project_id);
					?>

						<tr>
							<td>
								<?php echo esc_html($count++); ?>
							</td>
							<td>
								<a href="<?php echo esc_url(get_the_permalink($seller_id)) ?>" target="_blank">
									<?php $seller_image = wp_get_attachment_image(onwork_get_image_id(get_post_meta($seller_id, 'seller_profile_attachment', true)), array('50', '50'), false);

									if (!empty($seller_image)) {
										echo wp_kses($seller_image, array(
											"img" => array(
												"src" => array(),
												"alt" => array(),
												"style" => array()
											)
										));
									} else {
										echo get_avatar(get_post_field('post_author', $seller_id), 50);
									} ?>
								</a>
							</td>
							<td>
								<a href="<?php echo get_the_permalink($project_id); ?>" target="_blank"><?php echo esc_html($project->post_title); ?></a>
							</td>
							<td><?php if (get_term_by('id', $result['day_to_complete'], 'project-duration')) {
									echo esc_html(get_term_by('id', $result['day_to_complete'], 'project-duration')->name);
								} ?></td>
							<td>
								<?php
								$price = get_post_meta($project_id, 'project_price', true);

								if (function_exists('onwork_get_currency_symbol')) {
									echo esc_html(onwork_get_currency_symbol($price));
								} ?>
							</td>
							<td>
								<?php if (function_exists('onwork_get_currency_symbol')) {
									echo esc_html(onwork_get_currency_symbol($result['proposed_price']));
								} ?>
							</td>
							<td>
								<a href="#" class="prolancer-btn small-btn text-white" data-bs-toggle="modal" data-bs-target="#coverLetter<?php echo esc_attr($seller_id); ?>">
									<?php echo esc_html__('Read', 'prolancer'); ?>
								</a>
								<!-- Modal -->
								<div class="modal fade" id="coverLetter<?php echo esc_attr($seller_id); ?>" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="staticBackdropLabel"><?php echo esc_html(get_post_meta($seller_id, 'seller_profile_name', true)); ?></h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<?php echo esc_html($result['cover_letter']); ?>
											</div>
										</div>
									</div>
								</div>
							</td>

							<td>
								<a href="#" class="hire-seller prolancer-btn small-btn text-white" data-nonce="<?php echo wp_create_nonce('hire_seller_nonce'); ?>" data-seller-id="<?php echo esc_attr($seller_id); ?>" data-buyer-id="<?php echo esc_attr($buyer_id); ?>" data-project-id="<?php echo esc_attr($project_id); ?>" data-proposal-id="<?php echo esc_attr($result['id']); ?>"><?php echo esc_html__('Hire', 'prolancer'); ?></a>
								<a href="#" class="project-proposal-cancel prolancer-btn small-btn text-white bg-danger" data-nonce="<?php echo wp_create_nonce('project_proposal_cancel_nonce'); ?>" data-seller-id="<?php echo esc_attr($seller_id); ?>" data-buyer-id="<?php echo esc_attr($buyer_id); ?>" data-project-id="<?php echo esc_attr($project_id); ?>" data-proposal-id="<?php echo esc_attr($result['id']); ?>"><?php echo esc_html__('Cancel', 'prolancer'); ?>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<nav class="navigation pagination mt-5">
			<div class="nav-links">
				<?php
				echo paginate_links(array(
					'base' => add_query_arg('cpage', '%#%'),
					'format' => '?paged=%#%',
					'current' => $page,
					'total' => ceil($total / $items_per_page)
				)); ?>
			</div>
		</nav>
	<?php } else { ?>
		<p class="mb-0"><?php echo esc_html__('No result found!', 'prolancer'); ?></p>
	<?php } ?>
</div>