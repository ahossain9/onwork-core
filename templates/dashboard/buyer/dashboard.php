<?php
$buyer_id = get_user_meta(get_current_user_id(), 'buyer_id', true);

do_action('wp_enqueue_scripts', $buyer_id);

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
	'post_status' => 'publish'
));

if (is_user_logged_in()) {
	$buyer_id = get_user_meta(get_current_user_id(), 'buyer_id', true);
	global $wpdb;
	$table = 'onwork_project_proposals';

	if ($wpdb->get_var("SHOW TABLES LIKE '${table}'") == $table) {
		$query = "SELECT * FROM ${table} WHERE `buyer_id` = ${buyer_id} AND `status` = 'ongoing' ORDER BY timestamp DESC";
		$ongoing_project_count = $wpdb->get_results($query, ARRAY_A);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '${table}'") == $table) {
		$query = "SELECT * FROM ${table} WHERE `buyer_id` = ${buyer_id} AND `status` = 'complete' ORDER BY timestamp DESC";
		$complete_project_count = $wpdb->get_results($query, ARRAY_A);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '${table}'") == $table) {
		$query = "SELECT * FROM ${table} WHERE `buyer_id` = ${buyer_id} AND `status` = 'pending' ORDER BY timestamp DESC";
		$project_proposal_count = $wpdb->get_results($query, ARRAY_A);
	}
}

?>

<div class="white-padding mb-4">
	<h2 class="mb-0"><?php echo esc_html__('Buyer Dashboard', 'prolancer'); ?></h2>
</div>

<div class="row stats">
	<div class="col-lg-3">
		<a href="<?php if (function_exists('onwork_get_page_url_by_template')) {
						echo esc_url(onwork_get_page_url_by_template('onwork-dashboard.php'));
					}
					if (get_option('permalink_structure')) {
						echo "?";
					} else {
						echo "&";
					} ?>fed=projects" class="dashboard-stats-item">
			<h1><?php echo esc_html($projects->found_posts); ?></h1>
			<h5><?php echo esc_html__('Active Projects', 'prolancer'); ?></h5>
		</a>
	</div>
	<div class="col-lg-3">
		<a href="<?php if (function_exists('onwork_get_page_url_by_template')) {
						echo esc_url(onwork_get_page_url_by_template('onwork-dashboard.php'));
					}
					if (get_option('permalink_structure')) {
						echo "?";
					} else {
						echo "&";
					} ?>fed=proposals" class="dashboard-stats-item">
			<h1><?php echo esc_html(count($project_proposal_count)); ?></h1>
			<h5><?php echo esc_html__('Proposals', 'prolancer'); ?></h5>
		</a>
	</div>
	<div class="col-lg-3">
		<a href="<?php if (function_exists('onwork_get_page_url_by_template')) {
						echo esc_url(onwork_get_page_url_by_template('onwork-dashboard.php'));
					}
					if (get_option('permalink_structure')) {
						echo "?";
					} else {
						echo "&";
					} ?>fed=ongoing-projects" class="dashboard-stats-item">
			<h1><?php echo esc_html(count($ongoing_project_count)); ?></h1>
			<h5><?php echo esc_html__('Ongoing Projects', 'prolancer'); ?></h5>
		</a>
	</div>
	<div class="col-lg-3">
		<a href="<?php if (function_exists('onwork_get_page_url_by_template')) {
						echo esc_url(onwork_get_page_url_by_template('onwork-dashboard.php'));
					}
					if (get_option('permalink_structure')) {
						echo "?";
					} else {
						echo "&";
					} ?>fed=completed-projects" class="dashboard-stats-item">
			<h1><?php echo esc_html(count($complete_project_count)); ?></h1>
			<h5><?php echo esc_html__('Complete Projects', 'prolancer'); ?></h5>
		</a>
	</div>
</div>

<div class="white-padding mt-4">
	<h3><?php echo esc_html__('Views', 'prolancer') ?></h3>
	<div id="curve_chart"></div>
</div>