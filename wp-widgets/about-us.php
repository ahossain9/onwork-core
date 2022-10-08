<?php
/**
 * About us widget
 * @package onwork_core
 * @since 1.0.0
 */

class Onwork_Core_About_Widget extends WP_Widget{
    public function __construct(){

        parent::__construct('Onwork_Core_About_Widget', esc_html__('About Us', 'onwork-core'), array(
            'description'   =>  esc_html__('Company information.', 'onwork-core'),
        ));
    }

    public function widget($args, $instance){
        echo wp_kses_post( $args['before_widget'] );

        if(!empty($instance['title'])){
            echo  wp_kses_post( $args['before_title'] ).apply_filters('widget_title', esc_html($instance['title'])).wp_kses_post( $args['after_title'] );
        };

        if(!empty($instance['footer_logo_url'])){ ?>
            <a class="footer-widget-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="img-responsive" src="<?php echo esc_url( $instance['footer_logo_url'] ); ?>" alt="logo"></a>
        <?php }


        if(!empty($instance['footer_desc'])){ ?>

            <div class="footer-widget-about-description">
                <?php echo wpautop( esc_html($instance['footer_desc']));?>
            </div>

        <?php }

        if(!empty($instance['social_heading'])){ ?>
            <h6><?php echo esc_html($instance['social_heading']);?></h6>
        <?php }?>

        <ul class="footer-social-icons">
            <?php
            if(!empty($instance['facebook'])){ ?>
                <li><a class="facebook" href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <?php }
            ?>

            <?php
            if(!empty($instance['twitter'])){ ?>
                <li><a class="twitter" href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <?php }
            ?>

            <?php
            if(!empty($instance['linkedin'])){ ?>
                <li><a class="linkedin" href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><i class="fa  fa-linkedin"></i></a></li>
            <?php }
            ?>

            <?php
            if(!empty($instance['pinterest'])){ ?>
                <li><a class="pinterest" href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><i class="fa  fa-pinterest-p"></i></a></li>
            <?php }
            ?>

            <?php
            if(!empty($instance['instagram'])){ ?>
                <li><a class="instagram" href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><i class="fa  fa-instagram"></i></a></li>
            <?php }
            ?>
        </ul>

        <?php echo wp_kses_post( $args['after_widget'] );
    }


    public function form($instance){

        $title = ! empty($instance['title']) ? $instance['title'] : '';

        $logo_url = ! empty($instance['footer_logo_url']) ? $instance['footer_logo_url'] : '';

        $short_desc = ! empty($instance['footer_desc']) ? $instance['footer_desc'] : '';

        $socialicon_heading = ! empty($instance['social_heading']) ? $instance['social_heading'] : '';
        $facebook_url = ! empty($instance['facebook']) ? $instance['facebook'] : '';

        $twitter_url = ! empty($instance['twitter']) ? $instance['twitter'] : '';

        $linkedin_url = ! empty($instance['linkedin']) ? $instance['linkedin'] : '';

        $pinterest_url = ! empty($instance['pinterest']) ? $instance['pinterest'] : '';

        $instagram_url = ! empty($instance['instagram']) ? $instance['instagram'] : '';

        ?>


        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title'));?>"> <?php echo esc_html__( 'Title', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('title'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('title'));?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('footer_logo_url'));?>"> <?php echo esc_html__( 'Logo Image URL', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('footer_logo_url'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('footer_logo_url'));?>" value="<?php echo esc_url($logo_url); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('footer_desc'));?>"> <?php echo esc_html__( 'Short Description', 'onwork-core' );?></label>

            <textarea  cols="30" rows="3" id="<?php echo esc_attr($this->get_field_id('footer_desc'));?>" class="widefat" type="textarea" name="<?php echo esc_attr($this->get_field_name('footer_desc'));?>"><?php echo esc_html($short_desc); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('social_heading'));?>"> <?php echo esc_html__( 'Social Icon Heading', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('social_heading'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('social_heading'));?>" value="<?php echo esc_attr($socialicon_heading); ?>">
        </p>


        <p>
            <label for="<?php echo esc_attr($this->get_field_id('facebook'));?>"> <?php echo esc_html__( 'Facebook URL', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('facebook'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('facebook'));?>" value="<?php echo esc_url($facebook_url); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('twitter'));?>"> <?php echo esc_html__( 'Twitter URL', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('twitter'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('twitter'));?>" value="<?php echo esc_url($twitter_url); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('linkedin'));?>"> <?php echo esc_html__( 'Linkedin URL', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('linkedin'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('linkedin'));?>" value="<?php echo esc_url($linkedin_url); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('pinterest'));?>"> <?php echo esc_html__( 'Pinterest URL', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('pinterest'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('pinterest'));?>" value="<?php echo esc_url($pinterest_url); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('instagram'));?>"> <?php echo esc_html__( 'Instagram URL', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('instagram'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('instagram'));?>" value="<?php echo esc_url($instagram_url); ?>">
        </p>
    <?php }


    public function update( $new_instance, $old_instance ){
        $instance                  = $old_instance;
        $instance['title']         = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        $instance['footer_logo_url']     = ( ! empty( $new_instance['footer_logo_url'] ) ) ? sanitize_text_field( $new_instance['footer_logo_url'] ) : '';

        $instance['footer_desc']   = ( ! empty( $new_instance['footer_desc'] ) ) ? wp_kses_post( $new_instance['footer_desc'] ) : '';

        $instance['social_heading']   = ( ! empty( $new_instance['social_heading'] ) ) ? sanitize_text_field( $new_instance['social_heading'] ) : '';

        $instance['facebook']      = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';

        $instance['twitter']       = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';

        $instance['linkedin']      = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';

        $instance['pinterest']     = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';

        $instance['instagram']     = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';

        return $instance;
    }
}

if ( ! function_exists( 'onwork_core_about_widget_init' ) ) {
	function onwork_core_about_widget_init() {
		register_widget('Onwork_Core_About_Widget');
	}

	add_action('widgets_init', 'onwork_core_about_widget_init');
}