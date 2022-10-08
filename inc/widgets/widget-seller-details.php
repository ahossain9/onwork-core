<?php
/**
 * Seller Details Widget.
 * @package prolancer
 */
if( !class_exists('Prolancer_Seller_Details') ){
	class Prolancer_Seller_Details extends WP_Widget{
		/**
		 * Register widget with WordPress.
		 */
		function __construct(){

			$widget_options = array(
				'description' 					=> esc_html__('Prolancer Seller Details', 'prolancer'), 
				'customize_selective_refresh' 	=> true,
			);

			parent:: __construct('Prolancer_Seller_Details', esc_html__( 'Prolancer : Seller Details', 'prolancer'), $widget_options );

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
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'About Me','prolancer' );
		
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			echo $args['before_widget']; 
			if ( $title ): 
		    echo $args['before_title'];  
			echo esc_attr( $title );  
		 	echo $args['after_title']; 
			endif;


			$seller_gender = get_post_meta( get_the_ID(), 'seller_gender' , true );
			$seller_type = get_the_terms( get_the_ID(), 'seller-type');
			$seller_locations = get_the_terms( get_the_ID(), 'seller-locations' );
			$seller_languages = get_the_terms( get_the_ID(), 'seller-languages' );
			$seller_english_level = get_the_terms( get_the_ID(), 'seller-english-level' );
			$skills =  json_decode(stripslashes(get_post_meta(get_the_ID(), 'seller_skills', true)), true);
			$facebook = get_the_author_meta( 'facebook', get_the_author_meta( 'ID' ));
			$twitter = get_the_author_meta( 'twitter', get_the_author_meta( 'ID' ));
			$linkedin = get_the_author_meta( 'linkedin', get_the_author_meta( 'ID' ));
			$github = get_the_author_meta( 'github' , get_the_author_meta( 'ID' ));
			$dribbble = get_the_author_meta( 'dribbble', get_the_author_meta( 'ID' ));
			
			?>

			<?php if ($seller_gender){ ?>
			<div class="seller-detail d-flex">
				<i class="fal fa-venus-mars"></i>
				<div>
					<h5><?php echo esc_html__( 'Gender', 'prolancer' ) ?></h5>
					<p><?php echo esc_html($seller_gender) ?></p>
				</div>
			</div>				
			<?php } ?>

			<?php if ($seller_type){ ?>
			<div class="seller-detail d-flex">
				<i class="fal fa-user-shield"></i>
				<div>
					<h5><?php echo esc_html__( 'Seller Type', 'prolancer' ) ?></h5>
					<p><?php echo esc_html($seller_type[0]->name) ?></p>
				</div>
			</div>
			<?php } ?>

			<?php if ($seller_locations){ ?>
			<div class="seller-detail d-flex">
				<i class="fal fa-compass"></i>
				<div>
					<h5><?php echo esc_html__( 'Location', 'prolancer' ) ?></h5>
					<p><?php echo esc_html($seller_locations[0]->name) ?></p>
				</div>
			</div>
			<?php } ?>

			<?php if ($seller_languages){ ?>
			<div class="seller-detail d-flex">
				<i class="fal fa-language"></i>
				<div>
					<h5><?php echo esc_html__( 'Languages', 'prolancer' ) ?></h5>
					<p><?php echo esc_html($seller_languages[0]->name) ?></p>
				</div>
			</div>
			<?php } ?>

			<?php if ($seller_english_level){ ?>
			<div class="seller-detail d-flex">
				<i class="fal fa-signal-alt"></i>
				<div>
					<h5><?php echo esc_html__( 'English Level', 'prolancer' ) ?></h5>
					<p><?php echo esc_html($seller_english_level[0]->name) ?></p>
				</div>
			</div>
			<?php } ?>

			<?php if ($facebook || $twitter || $linkedin || $github || $dribbble){ ?>
				<div class="social-widget">	
					<?php if ($facebook) {?>
						<a href="<?php echo esc_url($facebook); ?>"><i class="fab fa-facebook-f"></i></a>
					<?php } ?>
					<?php if ($twitter) {?>
						<a href="<?php echo esc_url($twitter); ?>"><i class="fab fa-twitter"></i></a>
					<?php } ?>
					<?php if ($linkedin) {?>
						<a href="<?php echo esc_url($linkedin); ?>"><i class="fab fa-linkedin-in"></i></a>
					<?php } ?>
					<?php if ($github) {?>
						<a href="<?php echo esc_url($github); ?>"><i class="fab fa-github"></i></a>
					<?php } ?>
					<?php if ($dribbble) {?>
						<a href="<?php echo esc_url($dribbble); ?>"><i class="fab fa-dribbble"></i></a>
					<?php } ?>					
				</div>
			<?php } ?>

			<?php if(!empty($skills)){ ?>
				<div class="seller-skills mt-5">
					<h4 class="text-center"><?php echo esc_html__( 'Skills', 'prolancer' ) ?></h4>
					<?php foreach ($skills as $skill) {
						$terms = wp_get_post_terms( get_the_ID(), 'seller-skills', array( 'fields' => 'ids' ) ); 
						$skill_name = get_term_by( 'id', $skill[ 'skill' ], 'seller-skills' );
						?> 
						<div class="skill-item">
							<span><?php if (!empty($skill_name)) {echo esc_html($skill_name->name);} ?></span>
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo esc_attr($skill['percent']) ?>%" aria-valuenow="<?php echo esc_attr($skills['percent']) ?>" aria-valuemin="0" aria-valuemax="100"><?php echo esc_html($skill['percent']) ?>%</div>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

			<?php echo $args['after_widget']; ?>
			
			<?php wp_reset_postdata();
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



// Register Seller Details Widget.
function Prolancer_Seller_Details(){
	register_widget('Prolancer_Seller_Details');
}
add_action('widgets_init','Prolancer_Seller_Details');
