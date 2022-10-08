<?php
namespace Onwork_Core;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {
 
    /**
    * Instance
    *
    * @since 1.0.0
    * @access private
    * @static
    *
    * @var Plugin The single instance of the class.
    */
    private static $_instance = null;
 
    /**
    * Instance
    *
    * Ensures only one instance of the class is loaded or can be loaded.
    *
    * @since 1.2.0
    * @access public
    *
    * @return Plugin An instance of the class.
    */
    public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }

    return self::$_instance;
    }

    /**
    *  Plugin class constructor
    *
    * Register plugin action hooks and filters
    *
    * @since 1.2.0
    * @access public
    */
    public function __construct() {
        // Register widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

         // Register custom category
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
    }
    
    /**
     * Add custom category.
     *
     * @param $elements_manager
     */
    public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'onwork_core',
            [
                'title' => __( 'Onwork Core', 'onwork_core-core' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }
    
    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_widgets() {

        $LMSwidget = [
            'course-grid',
            'course-carousel',
            'category-image-box',
            'category-icon-box',
            'course-search',
        ];

        $widgets = [
            'dual-button',
            'webinar-box',
            'zoom-webinar-box',
            'video-popup',
            'mailchimp',
            'blog-post',
            'slider',
            'countdown',
            'pricing-table',
            'testimonial-carousel',
            'team-member',
            'testimonial',
            'skill-bar',
            'accordian',
            'step-flow',
        ];

        if ( function_exists('tutor') ) {
            $widgets = array_merge( $LMSwidget, $widgets);
        }

        foreach ( $widgets as $widget ) {
            require( __DIR__ . '/elementor/widgets/' . $widget . '/'. $widget . '.php' );

            $class_name = str_replace( '-', '_', $widget );
            $class_name = __NAMESPACE__ . '\Widgets\\' . $class_name;
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name() );
        }
    }

}
 
// Instantiate Plugin Class
Plugin::instance();