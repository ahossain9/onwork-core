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

	$attachments = get_post_meta($project_id, 'attachments', false);

	if ($attachments) {
		foreach ($attachments as $attachment) {
			if ($attachment) {
				$ids = array_keys($attachment);
			}
		}
	}

	update_post_meta($project_id, 'project_categories', 'ecommerce'); ?>

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
				<div class="col-md-12 mb-4">
					<label><?php echo esc_html__('Skills', 'prolancer'); ?></label>
					<select name="skills[]" class="form-control multiple-select" multiple="multiple">
						<?php
						$current_terms = wp_get_post_terms($project_id, 'skills', array('fields' => 'all'));
						if ($current_terms) {
							foreach ($current_terms as $current_term) {
								$current[] = $current_term->term_id;
							}
						}

						$terms = get_terms(array(
							'taxonomy' => 'skills',
							'hide_empty' => false,
							'orderby' => 'name'
						));

						foreach ($terms as $term) { ?>
							<option value="<?php echo esc_attr($term->term_id) ?>" <?php if (isset($current)) {
																						if (in_array($term->term_id, $current)) {
																							echo 'selected ="selected"';
																						}
																					} ?>><?php echo esc_html($term->name) ?></option>
						<?php }
						?>
					</select>
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
				<div class="col-md-12 mb-4">
					<label><?php echo esc_html__('Language', 'prolancer'); ?></label>
					<select name="languages[]" class="form-control multiple-select" multiple="multiple">
						<?php
						$current_terms = wp_get_post_terms($project_id, 'languages', array('fields' => 'all'));
						if ($current_terms) {
							foreach ($current_terms as $current_term) {
								$current[] = $current_term->term_id;
							}
						}

						$terms = get_terms(array(
							'taxonomy' => 'languages',
							'hide_empty' => false,
							'orderby' => 'name'
						));

						foreach ($terms as $term) { ?>
							<option value="<?php echo esc_attr($term->term_id) ?>" <?php if (isset($current)) {
																						if (in_array($term->term_id, $current)) {
																							echo 'selected ="selected"';
																						}
																					} ?>><?php echo esc_html($term->name) ?></option>
						<?php }
						?>
					</select>
				</div>
				<div class="col-md-12 mb-5">
					<label><?php echo esc_html__('Description', 'prolancer'); ?></label>
					<textarea id="editor" name="description" cols="30" rows="10" class="form-control"><?php echo esc_html($project->post_content); ?></textarea>
				</div>
				<div class="col-md-12 mb-4">
					<label><?php echo esc_html__('Attachments', 'prolancer'); ?></label>
					<input id="upload-project-attachments" type="file" class="form-control" multiple accept="image/pdf/mp4/doc/docx/ppt/pptx*" data-project-id="<?php echo esc_attr($project_id) ?>" data-nonce="<?php echo wp_create_nonce('upload_file_nonce'); ?>">
					<input type="hidden" name="attachments" class="attachment-ids" value="<?php if ($ids) {
																								echo json_encode($ids);
																							} ?>">

					<div class="append-images">
						<?php
						if ($attachments) {
							foreach ($ids as $id) { ?>
								<div>
									<img src="<?php echo esc_url(wp_get_attachment_image_src($id, 'prolancer-100x80', true)[0]); ?>">
									<div>
										<h6><?php echo esc_html(get_the_title($id)); ?></h6>
										<span><?php echo 'File size:' . filesize(get_attached_file($id)) . ' KB'; ?></span>
										<a class="delete-attachment" data-project-id="<?php echo esc_attr($project_id) ?>" data-nonce="<?php echo wp_create_nonce('delete_attachment_nonce'); ?>" data-attachment-id="<?php echo esc_attr($id) ?>" href="#"><i class="fas fa-trash-alt"></i></a>
									</div>
								</div>

						<?php }
						} ?>
					</div>
				</div>
				<div class="col-md-12 mb-4">
					<?php if (get_post_meta($project_id, 'featured_project', true) == true) { ?>
						<input type="hidden" name="project_update" value="true">
					<?php } ?>
					<label class="form-check-label" for="featured"><?php echo esc_html__('Make the project Featured', 'prolancer'); ?></label>
					<input name="featured_project" id="featured" type="checkbox" class="form-check-input" <?php if (get_post_meta($project_id, 'featured_project', true) == true) {
																												echo 'checked';
																											} ?>>
					<i class="d-block">
						<?php echo esc_html__('If this project is approved for featuring will charge you ', 'prolancer'); ?>
						<?php if (function_exists('onwork_get_currency_symbol')) {
							echo esc_html(onwork_get_currency_symbol($onwork_project_featuring_fee));
						} ?>
					</i>
				</div>
				<div class="col-md-12">
					<a href="" id="create-project" class="prolancer-btn" data-project-id="<?php echo esc_attr($project_id) ?>" data-nonce="<?php echo wp_create_nonce('create_project_nonce'); ?>"><?php if (!empty($_GET['project_id'])) {
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