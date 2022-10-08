<?php
/**
 * Buyer Details Widget.
 * @package prolancer
 */
if( !class_exists('Prolancer_Buyer_Details') ){
	class Prolancer_Buyer_Details extends WP_Widget{
		/**
		 * Register widget with WordPress.
		 */
		function __construct(){

			$widget_options = array(
				'description' 					=> esc_html__('Prolancer Buyer Details', 'prolancer'), 
				'customize_selective_refresh' 	=> true,
			);

			parent:: __construct('Prolancer_Buyer_Details', esc_html__( 'Prolancer : Buyer Details', 'prolancer'), $widget_options );

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


			$Buyer_gender = get_post_meta( get_the_ID(), 'buyer_gender' , true );
			$buyer_departments = get_the_terms( get_the_ID(), 'buyer-departments');
			$employees_number = get_the_terms( get_the_ID(), 'employees-number');
			$buyer_locations = get_the_terms( get_the_ID(), 'buyer-locations');
			
			?>

			<?php if ($buyer_departments){ ?>
			<div class="seller-detail d-flex">
				<i class="fal fa-layer-group"></i>
				<div>
					<h5><?php echo esc_html__( 'Department', 'prolancer' ) ?></h5>
					<p><?php echo esc_html($buyer_departments[0]->name) ?></p>
				</div>
			</div>				
			<?php } ?>

			<?php if ($employees_number){ ?>
			<div class="seller-detail d-flex">
				<i class="fal fa-users"></i>
				<div>
					<h5><?php echo esc_html__( 'Number of Employees', 'prolancer' ) ?></h5>
					<p><?php echo esc_html($employees_number[0]->name) ?></p>
				</div>
			</div>
			<?php } ?>

			<?php if ($buyer_locations){ ?>
			<div class="seller-detail d-flex">
				<i class="fal fa-compass"></i>
				<div>
					<h5><?php echo esc_html__( 'Location', 'prolancer' ) ?></h5>
					<p><?php echo esc_html($buyer_locations[0]->name) ?></p>
				</div>
			</div>
			<?php } ?>

			<div class="social-widget">			
				<a href="<?php echo esc_url(get_the_author_meta( 'facebook', get_the_author_meta( 'ID' ))); ?>"><i class="fab fa-facebook-f"></i></a>
				<a href="<?php echo esc_url(get_the_author_meta( 'twitter', get_the_author_meta( 'ID' ))); ?>"><i class="fab fa-twitter"></i></a>
				<a href="<?php echo esc_url(get_the_author_meta( 'linkedin', get_the_author_meta( 'ID' ))); ?>"><i class="fab fa-linkedin-in"></i></a>
				<a href="<?php echo esc_url(get_the_author_meta( 'github' , get_the_author_meta( 'ID' ))); ?>"><i class="fab fa-github"></i></a>
				<a href="<?php echo esc_url(get_the_author_meta( 'dribbble', get_the_author_meta( 'ID' ))); ?>"><i class="fab fa-dribbble"></i></a>
			</div>

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



// Register Buyer Details Widget.
function Prolancer_Buyer_Details(){
	register_widget('Prolancer_Buyer_Details');
}
add_action('widgets_init','Prolancer_Buyer_Details');
