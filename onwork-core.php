<?php
/**
 * Plugin Name: Onwork Core
 * Plugin URI: https://omexer.com
 * Description: <a href="https://omexer.com">Onwork Core</a> plugin is the collection of widgets for Elementor page builder
 * Version: 1.0
 * Author: Omexer
 * Author URI: https://omexer.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: onwork-core
 * Domain Path: /languages/
 *
 * @package Onwork_Core
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'ONWORK_CORE_VERSION', '1.0' );
define( 'ONWORK_CORE__FILE__', __FILE__ );
define( 'ONWORK_CORE_DIR_PATH', plugin_dir_path( ONWORK_CORE__FILE__ ) );
define( 'ONWORK_CORE_DIR_URL', plugin_dir_url( ONWORK_CORE__FILE__ ) );
define( 'ONWORK_CORE_ASSETS', trailingslashit( ONWORK_CORE_DIR_URL . 'assets' ) );

 
/**
 * Main Elementor Onwork_Core Class
 *
 * The init class that runs the Elementor Onwork_Core plugin.
 * The main class that initiates and runs the plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 * @since 1.0.0
 */

final class Onwork_Core {
 
  /**
   * Plugin Version
   *
   * @since 1.0.0
   * @var string The plugin version.
   */
  const VERSION = '1.0.0';
 
  /**
   * Minimum Elementor Version
   *
   * @since 1.0.0
   * @var string Minimum Elementor version required to run the plugin.
   */
  const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
 
  /**
   * Minimum PHP Version
   *
   * @since 1.0.0
   * @var string Minimum PHP version required to run the plugin.
   */
  const MINIMUM_PHP_VERSION = '7.0';
 
  /**
   * Constructor
   *
   * @since 1.0.0
   * @access public
   */
  public function __construct() {
 
    // Load translation
    add_action( 'init', array( $this, 'i18n' ) );
 
    // Init Plugin
    add_action( 'plugins_loaded', array( $this, 'init' ) );
  }
 
  /**
   * Load Textdomain
   *
   * Load plugin localization files.
   * Fired by `init` action hook.
   *
   * @since 1.2.0
   * @access public
   */
  public function i18n() {
    load_plugin_textdomain( 'onwork-core' );
  }
 
  /**
   * Initialize the plugin
   *
   * Validates that Elementor is already loaded.
   * Checks for basic plugin requirements, if one check fail don't continue,
   * if all check have passed include the plugin class.
   *
   * Fired by `plugins_loaded` action hook.
   *
   * @since 1.2.0
   * @access public
   */
  public function init() {
 
    // Check if Elementor installed and activated
    if ( ! did_action( 'elementor/loaded' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
      return;
    }
 
    // Check for required Elementor version
    if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
      return;
    }
 
    // Check for required PHP version
    if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
      return;
    }
 
    // Once we get here, We have passed all validation checks so we can safely include our plugin
    require ONWORK_CORE_DIR_PATH . 'base.php';
    require ONWORK_CORE_DIR_PATH . '/inc/functions.php';
  }
 
  /**
   * Admin notice
   *
   * Warning when the site doesn't have Elementor installed or activated.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_missing_main_plugin() {
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }
 
    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor */
      esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'onwork-core' ),
      '<strong>' . esc_html__( 'Onwork Core', 'onwork-core' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor Page Builder', 'onwork-core' ) . '</strong>'
    );
 
    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }
 
  /**
   * Admin notice
   *
   * Warning when the site doesn't have a minimum required Elementor version.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_minimum_elementor_version() {
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }
 
    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
      esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'onwork-core' ),
      '<strong>' . esc_html__( 'Onwork_Core Core', 'onwork-core' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor Page Builder', 'onwork-core' ) . '</strong>',
      self::MINIMUM_ELEMENTOR_VERSION
    );
 
    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }
 
  /**
   * Admin notice
   *
   * Warning when the site doesn't have a minimum required PHP version.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_minimum_php_version() {
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }
 
    $message = sprintf(
      /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
      esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'onwork-core' ),
      '<strong>' . esc_html__( 'Onwork_Core Core', 'onwork-core' ) . '</strong>',
      '<strong>' . esc_html__( 'PHP', 'onwork-core' ) . '</strong>',
      self::MINIMUM_PHP_VERSION
    );
 
    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }
}
 
// Instantiate Onwork_Core.
new Onwork_Core();