<?php
/**
 * onwork insight icon manager
 * @package Onwork_Core
 * @since 1.0.0
 */

namespace Onwork_Core\Inc;

defined( 'ABSPATH' ) || die();

class Icons_Manager {

    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_onwork_core_icons_tab' ] );
    }

    public static function add_onwork_core_icons_tab( $tabs ) {
        $tabs['onwork-core-icons'] = [
            'name' => 'onwork-core-icons',
            'label' => __( 'Onwork Icons', 'onwork-core-core' ),
            'url' => ONWORK_CORE_ASSETS . 'css/onwork-core-icons.css',
            'enqueue' => [ ONWORK_CORE_ASSETS . 'css/onwork-core-icons.css' ],
            'prefix' => 'icon-',
            'displayPrefix' => 'icon',
            'labelIcon' => 'icon icon-education',
            'ver' => ONWORK_CORE_VERSION,
            'fetchJson' => ONWORK_CORE_ASSETS . 'js/onwork-core-icons.js',
            'native' => false,
        ];
        return $tabs;
    }
}

Icons_Manager::init();