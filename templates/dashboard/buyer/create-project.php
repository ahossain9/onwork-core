<?php

global $onwork_opt;

$onwork_project_featuring_fee = isset($onwork_opt['onwork_project_featuring_fee']) ? $onwork_opt['onwork_project_featuring_fee'] : '';

$project_id = wp_insert_post(array(
	'post_title' => '',
	'post_status' => 'pending',
	'post_author' => get_current_user_id(),
	'post_type' => 'projects'
));

if (get_post_type($project_id) == 'projects') {
	$project = get_post($project_id);
} ?>

<?php var_dump($project);?>

<div class="white-padding mb-4">
	<h2 class="mb-0"><?php echo esc_html__('Create Project', 'prolancer'); ?></h2>
</div>

<?php

if (!empty($project)) {

	update_post_meta($project_id, 'project_categories', 'ecommerce'); ?>

	<div class="white-padding">
		<form id="create-project-form" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12 mb-4">
					<input type="text" name='title' class="form-control" value="<?php echo esc_attr($project->post_title); ?>" placeholder="<?php echo esc_attr__('Project Title', 'prolancer'); ?>">
				</div>
				<div class="col-md-6 mb-4">
					<input type="number" class="form-control" name="project_price" value="<?php echo esc_attr(get_post_meta($project_id, 'project_price', true)); ?>" placeholder="<?php echo esc_attr__('Price', 'prolancer'); ?>">
				</div>
				<div class="col-md-6 mb-4">
					<input type="number" class="form-control" name="estimated_hours" value="<?php echo esc_attr(get_post_meta($project_id, 'estimated_hours', true)); ?>" placeholder="<?php echo esc_attr__('Estimated Hours', 'prolancer'); ?>">
				</div>
				<div class="col-md-12">
					<a type="submit" href="" id="create-project"><?php echo esc_html__('Create Project', 'prolancer');?></a>
				</div>
			</div>
		</form>
	</div>
<?php } else { ?>
	<div class="white-padding">
		<p class="mb-0"><?php echo esc_html__('No result found!', 'prolancer'); ?></p>
	</div>
<?php } ?>