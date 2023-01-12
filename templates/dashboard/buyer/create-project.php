<?php
if (!empty($_GET['project_id'])) {
	$project_id = $_GET['project_id'];
} else {
	$project_id = wp_insert_post(array(
		'post_title' => '',
		'post_status' => 'pending',
		'post_author' => get_current_user_id(),
		'post_type' => 'projects'
	));
}

if (get_post_type($project_id) == 'projects') {
	$project = get_post($project_id);
}

?>

<div class="white-padding mb-4">
	<h2 class="mb-0"><?php echo esc_html__('Create Project', 'prolancer'); ?></h2>
</div>

<?php

if (!empty($project)) {

?>
	<div class="white-padding">
		<form id="create-project-form" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12 mb-4">
					<input type="text" name='title' class="form-control" value="<?php echo esc_attr($project->post_title); ?>" placeholder="<?php echo esc_attr__('Project Title', 'prolancer'); ?>">
				</div>
				<div class="col-md-6 mb-4">
					<select name="project_category" class="form-control">
						<option value=""><?php echo esc_html__('Category', 'prolancer'); ?></option>
						<?php onwork_get_option_list('project-categories', 'project_categories', $project_id); ?>
					</select>
				</div>
				<div class="col-md-6 mb-4">
					<select name="project_seller_type" class="form-control">
						<option value=""><?php echo esc_html__('Seller Type', 'prolancer'); ?></option>
						<?php onwork_get_option_list('project-seller-type', 'project_seller_type', $project_id); ?>
					</select>
				</div>
				<div class="col-md-6 mb-4">
					<select name="project_type" class="form-control">
						<option value=""><?php echo esc_html__('Project type', 'prolancer'); ?></option>
						<option <?php selected(get_post_meta($project_id, 'project_type', true), 'Fixed') ?> value="<?php echo esc_attr('Fixed'); ?>"><?php echo esc_html__('Fixed', 'prolancer'); ?></option>
						<option <?php selected(get_post_meta($project_id, 'project_type', true), 'Hourly') ?> value="<?php echo esc_attr('Hourly'); ?>"><?php echo esc_html__('Hourly', 'prolancer'); ?></option>
					</select>
				</div>
				<div class="col-md-6 mb-4">
					<input type="number" class="form-control" name="project_price" value="<?php echo esc_attr(get_post_meta($project_id, 'project_price', true)); ?>" placeholder="<?php echo esc_attr__('Price', 'prolancer'); ?>">
				</div>
				<div class="col-md-6 mb-4">
					<input type="number" class="form-control" name="estimated_hours" value="<?php echo esc_attr(get_post_meta($project_id, 'estimated_hours', true)); ?>" placeholder="<?php echo esc_attr__('Estimated Hours', 'prolancer'); ?>">
				</div>
				<div class="col-md-6 mb-4">
					<select name="project_level" class="form-control">
						<option><?php echo esc_html__('Project Level', 'prolancer'); ?></option>
						<?php onwork_get_option_list('project-level', 'project_level', $project_id); ?>
					</select>
				</div>
				<div class="col-md-6 mb-4">
					<select name="project_duration" class="form-control">
						<option><?php echo esc_html__('Project Duration', 'prolancer'); ?></option>
						<?php onwork_get_option_list('project-duration', 'project_duration', $project_id); ?>
					</select>
				</div>
				<div class="col-md-6 mb-4">
					<select name="english_level" class="form-control">
						<option><?php echo esc_html__('English Level', 'prolancer'); ?></option>
						<?php onwork_get_option_list('english-level', 'english_level', $project_id); ?>
					</select>
				</div>
				<div class="col-md-6 mb-4">
					<select name="locations" class="form-control">
						<option><?php echo esc_html__('Location', 'prolancer'); ?></option>
						<?php onwork_get_option_list('locations', 'locations', $project_id); ?>
					</select>
				</div>
				<div class="col-md-12 mb-5">
					<label><?php echo esc_html__('Description', 'prolancer'); ?></label>
					<textarea id="editor" name="description" cols="30" rows="10" class="form-control"><?php echo esc_html($project->post_content); ?></textarea>
				</div>
				<div class="col-md-12">
					<a href="#" id="create-project" class="prolancer-btn" data-project-id="<?php echo esc_attr($project_id) ?>" data-nonce="<?php echo wp_create_nonce('create_project_nonce'); ?>"><?php if (!empty($_GET['project_id'])) {
																																																		echo esc_html__('Update Project', 'prolancer');
																																																	} else {
																																																		echo esc_html__('Create Project', 'prolancer');
																																																	} ?></a>
				</div>
				
			</div>
		</form>
	</div>
<?php } else { ?>
	<div class="white-padding">
		<p class="mb-0"><?php echo esc_html__('No result found!', 'prolancer'); ?></p>
	</div>
<?php } ?>