<?php
/**
 * Address widget
 * @package onwork_core 
 * @since 1.0.0
 */

class Onwork_Core_Contact_Widget extends WP_Widget{
    public function __construct(){

        parent::__construct('Onwork_Core_Contact_Widget', esc_html__('Contact Us', 'onwork-core'), array(
            'description'   =>  esc_html__('Contact us information', 'onwork-core'),
        ));
    }

    public function widget($args, $instance){
        echo wp_kses_post( $args['before_widget'] );

        if(!empty($instance['title'])){
            echo  wp_kses_post( $args['before_title'] ).apply_filters('widget_title', esc_html($instance['title'])).wp_kses_post( $args['after_title'] );
        };?>

        <ul class="address-widget-list">
        <?php
        if(!empty($instance['address_desc'])){ ?>
            <li class="footer-address-desc">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <?php echo wpautop(esc_html($instance['address_desc']));?>
            </li>

        <?php }

        if(!empty($instance['email_address'])){ ?>

            <li class="footer-mail-address">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <p><a href="mailto:<?php echo esc_html($instance['email_address']);?>"><?php echo esc_html($instance['email_address']);?></a></p>
            </li>

            <?php
            if(!empty($instance['footer_mobile'])){ ?>
                <li class="footer-mobile-number">
                    <p><i class="fa fa-phone-alt" aria-hidden="true"></i><?php echo esc_html($instance['footer_mobile']);?></p>
                </li>

                <?php
            } ?>
            </ul>
            <?php
            if(!empty($instance['footer_subscribe'])){ ?>
                <div class="footer-subscribe-form">
                    <?php echo do_shortcode( esc_html($instance['footer_subscribe']));?>
                </div>
            <?php }

        }

        echo wp_kses_post( $args['after_widget'] );
    }

    public function form($instance){
        $title = ! empty($instance['title']) ? $instance['title'] : '';

        $address_description = ! empty($instance['address_desc']) ? $instance['address_desc'] : '';
        $footer_email = ! empty($instance['email_address']) ? $instance['email_address'] : '';

        $footer_mobile = ! empty($instance['footer_mobile']) ? $instance['footer_mobile'] : '';

        $footer_subscribe = ! empty($instance['footer_subscribe']) ? $instance['footer_subscribe'] : '';
        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title'));?>"> <?php echo esc_html__( 'Title', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('title'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('title'));?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address_desc'));?>"> <?php echo esc_html__( 'Location', 'onwork-core' );?></label>

            <textarea  cols="30" rows="3" id="<?php echo esc_attr($this->get_field_id('address_desc'));?>" class="widefat" type="textarea" name="<?php echo esc_attr($this->get_field_name('address_desc'));?>"><?php echo esc_html($address_description); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title'));?>"> <?php echo esc_html__( 'Email', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('email_address'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('email_address'));?>" value="<?php echo esc_attr($footer_email); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('footer_mobile'));?>"> <?php echo esc_html__( 'Mobile Number', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('footer_mobile'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('footer_mobile'));?>" value="<?php echo esc_attr($footer_mobile); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('footer_subscribe'));?>"> <?php echo esc_html__( 'Subscribe Form Shortcode ', 'onwork-core' );?></label>

            <input id="<?php echo esc_attr($this->get_field_id('footer_subscribe'));?>" class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('footer_subscribe'));?>" value="<?php echo esc_attr($footer_subscribe); ?>">
        </p>

    <?php }

    public function update( $new_instance, $old_instance ){
        $instance                  = $old_instance;

        $instance['title']         = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        $instance['address_desc']         = ( ! empty( $new_instance['address_desc'] ) ) ? wp_kses_post( $new_instance['address_desc'] ) : '';

        $instance['email_address']         = ( ! empty( $new_instance['email_address'] ) ) ? sanitize_text_field( $new_instance['email_address'] ) : '';

        $instance['footer_mobile']         = ( ! empty( $new_instance['footer_mobile'] ) ) ? sanitize_text_field( $new_instance['footer_mobile'] ) : '';

        $instance['footer_subscribe']         = ( ! empty( $new_instance['footer_subscribe'] ) ) ? sanitize_text_field( $new_instance['footer_subscribe'] ) : '';

        return $instance;
    }
}

if ( ! function_exists( 'Onwork_Core_Contact_Widget_init' ) ) {
	function Onwork_Core_Contact_Widget_init() {
		register_widget('Onwork_Core_Contact_Widget');
	}

	add_action('widgets_init', 'Onwork_Core_Contact_Widget_init');
}