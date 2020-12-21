<?php

/**
 * Iks Menu
 *
 *
 * @package   Iks Menu
 * @author    IksStudio
 * @license   GPL-3.0
 * @link      http://iks-menu.ru
 * @copyright 2019 IksStudio
 *
 * @wordpress-plugin
 * Plugin Name:       Iks Menu
 * Description:       Super Customizable Accordion Menu. Was made with attention to details.
 * Version:           1.8.8
 * Author:            IksStudio
 * Author URI:        http://iks-menu.ru
 * Text Domain:       iksm
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 */
namespace IksStudio\IKSM;

use  IksStudio\IKSM_CORE\Admin ;
use  IksStudio\IKSM_CORE\Plugin ;
use  IksStudio\IKSM\images\AdminMenusImprover ;
use  IksStudio\IKSM\images\AdminTaxonomiesImprover ;
use  IksStudio\IKSM\settings\SettingsStore ;
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'iks_menu_fs' ) ) {
    iks_menu_fs()->set_basename( false, __FILE__ );
} else {
    /*
     * Freemius SDK function
     */
    function iks_menu_fs()
    {
        global  $iks_menu_fs ;
        
        if ( !isset( $iks_menu_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $iks_menu_fs = fs_dynamic_init( array(
                'id'               => '4644',
                'slug'             => 'iks-menu',
                'premium_slug'     => 'iks-menu-pro',
                'type'             => 'plugin',
                'public_key'       => 'pk_8cd9c85c6a63b2f3652cfc2bcc959',
                'is_premium'       => false,
                'premium_suffix'   => 'Pro',
                'has_addons'       => false,
                'has_paid_plans'   => true,
                'is_org_compliant' => false,
                'menu'             => array(
                'slug' => 'iksm',
            ),
                'is_live'          => true,
            ) );
        }
        
        return $iks_menu_fs;
    }
    
    // Init Freemius.
    iks_menu_fs();
    iks_menu_fs()->add_action( 'after_uninstall', 'iks_menu_fs_uninstall_cleanup' );
    // Signal that SDK was initiated.
    do_action( 'iks_menu_fs_loaded' );
    /**
     * Autoloader
     *
     * @param string $class The fully-qualified class name.
     *
     * @return void
     *
     * @since 1.0.0
     */
    spl_autoload_register( function ( $class ) {
        require_once plugin_dir_path( __FILE__ ) . 'includes/core/autoloader.php';
        iks_autoloader( $class, __NAMESPACE__, __DIR__ );
    } );
    /**
     * Initialize Plugin
     *
     * @since 1.0.0
     */
    function init()
    {
        global  $iks_menu_fs ;
        Plugin::init(
            $iks_menu_fs,
            __FILE__,
            3011,
            'Iks Menu',
            'iksm',
            [ 'iks_menu' ],
            'iksm',
            '4.4',
            [
            'prod' => 'http://iks-menu.ru/skins/',
            'dev'  => 'http://iks-menu.ru/skins-dev/',
        ],
            [ "menu" ],
            new SettingsStore()
        );
        Shortcode::get_instance();
        Admin::get_instance();
        AdminMenusImprover::get_instance();
        AdminTaxonomiesImprover::get_instance();
        API\AdminAPI::get_instance();
    }
    
    add_action( 'plugins_loaded', 'IksStudio\\IKSM\\init' );
    /**
     * Register the widget
     *
     * @since 1.0.0
     */
    function widget_init()
    {
        return register_widget( 'IksStudio\\IKSM\\Widget' );
    }
    
    add_action( 'widgets_init', 'IksStudio\\IKSM\\widget_init' );
    /**
     * Register activation and deactivation hooks
     */
    register_activation_hook( __FILE__, array( 'IksStudio\\IKSM\\PluginLocal', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'IksStudio\\IKSM\\PluginLocal', 'deactivate' ) );
}
