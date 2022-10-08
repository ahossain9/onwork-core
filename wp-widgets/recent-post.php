<?php
/**
 * Recent post widget
 * @package onwork_core
 * @since 1.0.0
 */

class Owork_Core_Recent_Post_Widget extends WP_Widget {
    public function __construct(){
        parent::__construct('onwork-core-latest-post', esc_html__('Advanced Recent Posts', 'onwork-core'), array(
            'description'   =>  esc_html__('latest post with featured image', 'onwork-core'),
        ));
    }
    public function widget($args, $instance){
        ?>
        <?php echo wp_kses_post($args['before_widget']); ?>
        <?php if (! empty($instance['recent_post_title'])) {
        echo wp_kses_post( $args['before_title']) . apply_filters('widget_title', esc_html($instance['recent_post_title'])) . wp_kses_post( $args['after_title'] );
    }
        ?>
        <ul class="recent-post-widget">
            <?php
            $post_count = ! empty($instance['post_count']) ? $instance['post_count'] : 5;
            $resent_post    =   new WP_Query(array(
                'post_type'           =>  'post',
                'posts_per_page'      =>  $post_count,
                'ignore_sticky_posts' => true
            ));

            while ($resent_post->have_posts()) : $resent_post->the_post(); ?>

                <li>
                    <?php if(has_post_thumbnail()) :?>
                       <div class="recent-post-wid-thumb" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url());?>');">
                       </div>
                    <?php endif;?>
                    <div class="recent-post-wid-cont">
                        <h6>
                            <a class="recent-news-title" href="<?php echo esc_url(get_permalink());?>"><?php the_title();?></a>
                        </h6>
                        <span class="recent-post-widget-date">
                            <?php echo esc_html(get_the_date()); ?>
                        </span>
                    </div>
                </li>
            <?php endwhile;?>
        </ul>
        <?php echo wp_kses_post( $args['after_widget'] ); ?>
        <?php
    }
    public function form($instance){
        $title = ! empty($instance['recent_post_title']) ? $instance['recent_post_title'] : esc_html__(' Recent Posts', 'onwork-core');
        $post_count = ! empty($instance['post_count']) ? $instance['post_count'] : 3;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('recent_post_title')); ?>"><?php echo esc_html__('Title :', 'onwork-core') ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('recent_post_title'));?>" name="<?php echo esc_attr($this->get_field_name('recent_post_title'));?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_count')); ?>"><?php echo esc_html__('Post Count:', 'onwork-core') ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post_count')); ?>" name="<?php echo esc_attr($this->get_field_name('post_count')); ?>" type="number" min="-1" value="<?php echo esc_attr($post_count); ?>">
        </p>
        <?php
    }
}


if ( ! function_exists( 'onwork_core_latest_post' ) ) {
	function onwork_core_latest_post() {
		register_widget('Owork_Core_Recent_Post_Widget');
	}

	add_action('widgets_init', 'onwork_core_latest_post');
}