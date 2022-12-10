<?php
$woo_countries = new WC_Countries();
$countries = $woo_countries->get_allowed_countries();
$verification = json_decode( get_user_meta( get_current_user_id(), 'verification' , true ), true );
?>

<div class="white-padding mb-4">
	<h2 class="mb-0"><?php echo esc_html__( 'Verification', 'prolancer' ); ?></h2>
</div>

<div class="cotainer">
	<div class="row">
		<div class="col-md-12">
			<div class="white-padding mb-4">
				<?php
				if (!empty($verification['verified'])) {
				 	if ($verification['verified'] == 'yes'){ ?>
						<div class="alert alert-success" role="alert">
		  		        	<?php echo esc_html__('Your account is verified!','prolancer'); ?>
		  		      	</div>
					<?php }elseif($verification['verified'] == 'no'){ ?>
						<div class="alert alert-danger" role="alert">
		  		        	<?php echo esc_html__('Your account verification is pending!','prolancer'); ?>
		  		      	</div>
					<?php }elseif($verification['verified'] == 'rejected'){ ?>
						<div class="alert alert-danger" role="alert">
		  		        	<?php echo esc_html__('Your account verification is rejected!','prolancer'); ?>
		  		      	</div>
					<?php }
				 } ?>
				<?php
				 if (empty($verification['verified'])) { ?>
					<form id="verification-form" enctype="multipart/form-data">
						<?php 
						woocommerce_form_field('my_country_field', array(
								'type'       => 'select',
								'label'      => esc_html__('Select your country','prolancer'),
								'placeholder'=> esc_html__('Enter something','prolancer'),
								'required'   => true,
								'options'    => $countries
							)
						); ?> 
						<h5><?php echo esc_html__('Your ID Type','prolancer'); ?></h5>
						<div class="accordion" id="verification">
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingOne">
								  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#passport-verification" aria-expanded="false" aria-controls="passport-verification">
								    <i class="fas fa-globe"></i><?php echo esc_html__('Passport','prolancer'); ?>
								  </button>
								</h2>
								<div id="passport-verification" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#verification">
								  <div class="accordion-body">
								    <div class="dropzone mt-4" data-name="<?php echo esc_attr('user_passport_attachment'); ?>" data-nonce="<?php echo wp_create_nonce( 'upload_file_nonce' ) ?>">
										<input type="file" name="upload-file" class="upload-file" id="upload-passport-attachment" data-name="<?php echo esc_attr('user_passport_attachment'); ?>"   data-nonce="<?php echo wp_create_nonce( 'upload_file_nonce' ) ?>">
										<label for="upload-passport-attachment"><strong><?php echo esc_html__( 'Choose a passport Picture', 'prolancer' ) ?></strong><span class="box__dragndrop"> <?php echo esc_html__( 'or drag it here', 'prolancer' ) ?></span>.</label>
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
										</div>
									</div>
								  </div>
								</div>
							</div>
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingTwo">
								  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#drivers-license-verification" aria-expanded="false" aria-controls="drivers-license-verification">
								    <i class="fas fa-steering-wheel"></i><?php echo esc_html__('Driver\'s license','prolancer'); ?>
								  </button>
								</h2>
								<div id="drivers-license-verification" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#verification">
								  <div class="accordion-body">
								    <div class="dropzone mt-4" data-name="<?php echo esc_attr('user_drivers_license_attachment'); ?>" data-nonce="<?php echo wp_create_nonce( 'upload_file_nonce' ) ?>">
										<input type="file" name="upload-file" class="upload-file" id="upload-drivers-license-attachment" data-name="<?php echo esc_attr('user_drivers_license_attachment'); ?>"   data-nonce="<?php echo wp_create_nonce( 'upload_file_nonce' ) ?>">
										<label for="upload-drivers-license-attachment"><strong><?php echo esc_html__( 'Choose a drivers license Picture', 'prolancer' ) ?></strong><span class="box__dragndrop"> <?php echo esc_html__( 'or drag it here', 'prolancer' ) ?></span>.</label>
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
										</div>
									</div>
								  </div>
								</div>
							</div>
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingThree">
								  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id-verification" aria-expanded="false" aria-controls="id-verification">
								    <i class="fas fa-id-card"></i><?php echo esc_html__('Identity card','prolancer'); ?>
								  </button>
								</h2>
								<div id="id-verification" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#verification">
								  <div class="accordion-body">
								    <div class="dropzone mt-4" data-name="<?php echo esc_attr('user_id_front_attachment'); ?>" data-nonce="<?php echo wp_create_nonce( 'upload_file_nonce' ) ?>">
										<input type="file" name="upload-file" class="upload-file" id="upload-id-front-attachment" data-name="<?php echo esc_attr('user_id_front_attachment'); ?>"   data-nonce="<?php echo wp_create_nonce( 'upload_file_nonce' ) ?>">
										<label for="upload-id-front-attachment"><strong><?php echo esc_html__( 'Choose a id front picture', 'prolancer' ) ?></strong><span class="box__dragndrop"> <?php echo esc_html__( 'or drag it here', 'prolancer' ) ?></span>.</label>
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
										</div>
									</div>
									<div class="dropzone mt-4" data-name="<?php echo esc_attr('user_id_back_attachment'); ?>" data-nonce="<?php echo wp_create_nonce( 'upload_file_nonce' ) ?>">
										<input type="file" name="upload-file" class="upload-file" id="upload-id_back-attachment" data-name="<?php echo esc_attr('user_id_back_attachment'); ?>"   data-nonce="<?php echo wp_create_nonce( 'upload_file_nonce' ) ?>">
										<label for="upload-id_back-attachment"><strong><?php echo esc_html__( 'Choose a id back picture', 'prolancer' ) ?></strong><span class="box__dragndrop"> <?php echo esc_html__( 'or drag it here', 'prolancer' ) ?></span>.</label>
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
										</div>
									</div>
								  </div>
								</div>
							</div>
						</div>
						<a href="#" id="submit-verification" class="prolancer-btn mt-3" data-nonce="<?php echo wp_create_nonce('verification_nonce'); ?>"><?php echo esc_html__( 'Submit Verification', 'prolancer' ); ?></a>
					</form>
					<?php
				} ?>
			</div>
		</div>
	</div>
</div>