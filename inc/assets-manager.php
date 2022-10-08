<?php
/**
 * onwork insight assets manager
 * @package Onwork_Core
 * @since 1.0.0
 */

namespace Onwork_Core\Inc;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Assets {
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

    public function __construct() {
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_frontend_styles' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_frontend_scripts' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', array ( $this, 'enqueue_frontend_scripts' ), 10 );
        add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'onwork_core_editor_styles' ) );
    }
    
    public function onwork_core_editor_styles() {
        wp_enqueue_style('onwork-core-elementor-editor', ONWORK_CORE_ASSETS . 'css/elementor-editor.css', '', ONWORK_CORE_VERSION );
    }
    
    // Register Styles
    public function register_frontend_styles() {  
        wp_register_style(
            'font-awesome',
            ONWORK_CORE_ASSETS . 'css/font-awesome.min.css',
            null,
            ONWORK_CORE_VERSION
        );

        wp_register_style(
            'owl-carousel',
            ONWORK_CORE_ASSETS . 'css/owl.carousel.min.css',
            null,
            ONWORK_CORE_VERSION
        );

        wp_register_style(
            'magnific-popup',
            ONWORK_CORE_ASSETS . 'css/magnific-popup.css',
            null,
            ONWORK_CORE_VERSION
        );
        wp_register_style(
            'magnific-popup',
            ONWORK_CORE_ASSETS . 'css/animate.min.css',
            null,
            ONWORK_CORE_VERSION
        );
        
        wp_register_style(
            'onwork-core-icons',
            ONWORK_CORE_ASSETS . 'css/onwork-core-icons.css',
            null,
            ONWORK_CORE_VERSION
        );
        
        wp_register_style(
            'onwork-core',
            ONWORK_CORE_ASSETS . 'css/onwork-core.css',
            null,
            ONWORK_CORE_VERSION
        );

	}
    
    public function enqueue_frontend_styles() {
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_style( 'animate' );
		wp_enqueue_style( 'onwork-core-icons' );
		wp_enqueue_style( 'onwork-core' );

	}
    
    // Register Scripts
    public function register_frontend_scripts() {
        wp_register_script(
            'owl-carousel',
            ONWORK_CORE_ASSETS . 'js/owl.carousel.min.js',
            array('jquery'),
            ONWORK_CORE_VERSION,
            true
        );

        wp_register_script(
            'magnific-popup',
            ONWORK_CORE_ASSETS . 'js/magnific-popup.min.js',
            array('jquery'),
            ONWORK_CORE_VERSION,
            true
        );

        wp_register_script(
            'countdown',
            ONWORK_CORE_ASSETS . 'js/countdown.js',
            array('jquery'),
            ONWORK_CORE_VERSION,
            true
        );
        
        wp_register_script(
            'onwork-core',
            ONWORK_CORE_ASSETS . 'js/onwork-core.js',
            array('jquery'),
            ONWORK_CORE_VERSION,
            true
        ); 

	}
    
    public function enqueue_frontend_scripts() {
        wp_enqueue_script( 'onwork-core' );
        wp_enqueue_script( 'countdown' );
        wp_enqueue_script( 'owl-carousel' );
        wp_enqueue_script( 'magnific-popup' );
	}

    public function onwork_admin_scripts(){
        wp_enqueue_style(
            'onwork-core-admin-css',
            ONWORK_CORE_ASSETS . 'css/admin.css',
            null,
            ONWORK_CORE_VERSION 
        );
        wp_register_script(
            'onwork-core-admin-js',
            ONWORK_CORE_ASSETS . 'js/admin.js',
            array('jquery'),
            ONWORK_CORE_VERSION,
            true
        ); 
    }
}

// Assets Plugin Class
Assets::instance();