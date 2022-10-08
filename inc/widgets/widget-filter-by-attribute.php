<?php
/**
 * Filter by Attribute Widget.
 * @package prolancer
 */
if( !class_exists('Prolancer_Filter_by_Attribute') ){
	class Prolancer_Filter_by_Attribute extends WP_Widget{
		/**
		 * Register widget with WordPress.
		 */
		function __construct(){

			$widget_options = array(
				'description' 					=> esc_html__('Prolancer Filter by Attribute', 'prolancer'), 
				'customize_selective_refresh' 	=> true,
			);

			parent:: __construct('Prolancer_Filter_by_Attribute', esc_html__( 'Prolancer : Filter by Attribute', 'prolancer'), $widget_options );

		}
		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget($args, $instance){

			if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Filter by Attribute','prolancer' );
		
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			echo $args['before_widget']; 
			if ( $title ): 
		    echo $args['before_title'];  
			echo esc_attr( $title );  
		 	echo $args['after_title']; 
			endif;

			$services = get_posts(array(
			  'numberposts' => -1,
			  'post_type'   => 'services'
			));

			foreach ($services as $service) {
				$service_price[] = get_post_meta( $service->ID,'service_price', true);				
			}

			$projects = get_posts(array(
			  'numberposts' => -1,
			  'post_type'   => 'projects'
			));

			foreach ($projects as $project) {				
	            $project_price[] = get_post_meta($project->ID, 'project_price', true);            
			}

			$sellers = get_posts(array(
			  'numberposts' => -1,
			  'post_type'   => 'sellers'
			));

			foreach ($sellers as $seller) {
				$seller_hourly_rate[] = get_post_meta( $seller->ID,'seller_hourly_rate', true);
			}

			if ( is_post_type_archive( 'projects' ) || is_tax(['project-categories','project-seller-type','project-duration','project-level','english-level','locations','project-label','skills','languages'])) { ?>			
				<form id="project-search-form" enctype="multipart/form-data" data-nonce="<?php echo wp_create_nonce('search_form_nonce'); ?>">
					
					<div class="filter-box">
						<label><?php echo esc_html__('Category','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'project-categories',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="project_categories[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>	
						</div>		
					</div>					
					
					<div class="filter-box">
						<label><?php echo esc_html__('Seller Type','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'project-seller-type',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="project_seller_type[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>
						</div>
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Price','prolancer'); ?></label>
						<div class="price-range" data-max-value="<?php echo esc_attr(max($project_price)); ?>"></div>
						<div class="row">
							<input type="hidden" class="from-price" name="price-from">
							<input type="hidden" class="to-price" name="price-to">
							<div class="col-sm-6"><input type="number" class="from-price form-control text-center" name="price-from" disabled></div>
							<div class="col-sm-6"><input type="number" class="to-price form-control text-center" name="price-to" disabled></div>
						</div>
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Project type','prolancer'); ?></label>
						<select name="project_type" class="form-control">
							<option value=""><?php echo esc_html__('Project type','prolancer'); ?></option>
							<option value="<?php echo esc_attr( 'Fixed' ); ?>"><?php echo esc_html( 'Fixed','prolancer' ); ?></option>
							<option value="<?php echo esc_attr( 'Hourly' ); ?>"><?php echo esc_html( 'Hourly','prolancer' ); ?></option>
						</select>
					</div>
					
					<div class="filter-box">
						<label><?php echo esc_html__('Skills','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'skills',
							    'hide_empty' => false,
								'orderby' => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="skills[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>
						</div>		
					</div>
					
					<div class="filter-box">
						<label><?php echo esc_html__('Project Level','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'project-level',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="project_level[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>
						</div>
					</div>
					
					<div class="filter-box">
						<label><?php echo esc_html__('English Level','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'english-level',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="english_level[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>
						</div>
					</div>
					
					<div class="filter-box">
						<label><?php echo esc_html__('Locations','prolancer'); ?></label>
						<select name="locations" class="form-control">
							<option value=""><?php echo esc_html__('Locations','prolancer'); ?></option>
							<?php 
							$terms = get_terms( array(
							    'taxonomy' => 'locations',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );

							foreach ($terms as $term) { ?>
								<option value="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_html($term->name) ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Languages','prolancer'); ?></label>
						<select name="languages" class="form-control">
							<option value=""><?php echo esc_html__('Languages','prolancer'); ?></option>
							<?php 
							$terms = get_terms( array(
							    'taxonomy' => 'languages',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );

							foreach ($terms as $term) { ?>
								<option value="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_html($term->name) ?></option>
							<?php } ?>
						</select>
					</div>
				</form>
			<?php } elseif( is_post_type_archive( 'services' ) || is_tax(['service-categories','service-english-level','service-locations']) ){ ?>
				<form id="service-search-form" enctype="multipart/form-data" data-nonce="<?php echo wp_create_nonce('search_form_nonce'); ?>">
					
					<div class="filter-box">
						<label><?php echo esc_html__('Category','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'service-categories',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="service_categories[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>	
						</div>
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Price','prolancer'); ?></label>
						<div class="price-range" data-max-value="<?php echo esc_attr(max($service_price)); ?>"></div>
						<div class="row">
							<input type="hidden" class="from-price" name="price-from">
							<input type="hidden" class="to-price" name="price-to">
							<div class="col-sm-6"><input type="number" class="from-price form-control text-center" name="price-from" disabled></div>
							<div class="col-sm-6"><input type="number" class="to-price form-control text-center" name="price-to" disabled></div>
						</div>
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Locations','prolancer'); ?></label>
						<select name="service_locations" class="form-control">
							<option value=""><?php echo esc_html__('Locations','prolancer'); ?></option>
							<?php 
							$terms = get_terms( array(
							    'taxonomy' => 'service-locations',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );

							foreach ($terms as $term) { ?>
								<option value="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_html($term->name) ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Delivery time','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'delivery-time',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="delivery_time[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>	
						</div>		
					</div>
				</form>
			<?php } elseif( is_post_type_archive( 'buyers' ) || is_tax( ['buyer-departments','employees-number','buyer-locations'] )){ ?>
				<form id="buyer-search-form" enctype="multipart/form-data" data-nonce="<?php echo wp_create_nonce('search_form_nonce'); ?>">
					
					<div class="filter-box">
						<label><?php echo esc_html__('Departments','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'buyer-departments',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="buyer_departments[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>	
						</div>		
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Locations','prolancer'); ?></label>
						<select name="buyer_locations" class="form-control">
							<option value=""><?php echo esc_html__('Locations','prolancer'); ?></option>
							<?php 
							$terms = get_terms( array(
							    'taxonomy' => 'buyer-locations',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );

							foreach ($terms as $term) { ?>
								<option value="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_html($term->name) ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('No. of Employees','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'employees-number',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="employees_number[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>	
						</div>		
					</div>
				</form>
			<?php } elseif( is_post_type_archive( 'sellers' ) || is_tax( ['seller-locations','seller-skills','seller-type','seller-english-level','seller-languages'] )){ ?>
				<form id="seller-search-form" enctype="multipart/form-data" data-nonce="<?php echo wp_create_nonce('search_form_nonce'); ?>">

					<div class="filter-box">
						<label><?php echo esc_html__('Hourly Rate','prolancer'); ?></label>
						<div class="price-range" data-max-value="<?php echo esc_attr(max($seller_hourly_rate)); ?>"></div>
						<div class="row">
							<input type="hidden" class="from-price" name="price-from">
							<input type="hidden" class="to-price" name="price-to">
							<div class="col-sm-6"><input type="number" class="from-price form-control text-center" name="price-from" disabled></div>
							<div class="col-sm-6"><input type="number" class="to-price form-control text-center" name="price-to" disabled></div>
						</div>						
					</div>
					
					<div class="filter-box">
						<label><?php echo esc_html__('Skills','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'seller-skills',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="seller_skills[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>	
						</div>		
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Seller Type','prolancer'); ?></label>
						<div class="checkbox-items">
							<?php $terms = get_terms( array(
							    'taxonomy' => 'seller-type',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );
							
							foreach ($terms as $term) { ?>
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="<?php echo esc_attr($term->term_id) ?>" name="seller_type[]" value="<?php echo esc_attr($term->term_id) ?>">
								  <label class="form-check-label" for="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
								</div>
							<?php } ?>	
						</div>		
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Locations','prolancer'); ?></label>
						<select name="seller_locations" class="form-control">
							<option value=""><?php echo esc_html__('Locations','prolancer'); ?></option>
							<?php 
							$terms = get_terms( array(
							    'taxonomy' => 'seller-locations',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );

							foreach ($terms as $term) { ?>
								<option value="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_html($term->name) ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="filter-box">
						<label><?php echo esc_html__('Languages','prolancer'); ?></label>
						<select name="seller_languages" class="form-control">
							<option value=""><?php echo esc_html__('Languages','prolancer'); ?></option>
							<?php 
							$terms = get_terms( array(
							    'taxonomy' => 'seller-languages',
							    'hide_empty' => false,
								'orderby'      => 'name'
							) );

							foreach ($terms as $term) { ?>
								<option value="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_html($term->name) ?></option>
							<?php } ?>
						</select>
					</div>
				</form>
			<?php } else {
				echo esc_html__('This filter only work on "Projects, Services, Buyers and Sellers archive pages"','prolancer');;
			} ?>

			<?php echo $args['after_widget'];
		}
		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			return $instance;
		}

	 	/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */

		public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : ''; ?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:','prolancer' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<?php
		}
	}
}



// Filter by Attribute Widget.
function Prolancer_Filter_by_Attribute(){
	register_widget('Prolancer_Filter_by_Attribute');
}
add_action('widgets_init','Prolancer_Filter_by_Attribute');
