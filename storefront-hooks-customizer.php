<?php
/*
Plugin Name: Storefront Hooks Customizer
Plugin URI: https://themebynumbers.com
Description: Hook into Storefront from the Customizer.
Version: 1.0
Author: mikeyarce
Author URI: http://themebynumbers.com
Text Domain: storefront-hooks-customizer
Domain Path: /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'STOREFRONT_HOOKS_CUSTOMIZER', '1.0.0' );

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Storefront_Hooks_Customizer
 * @author     Mikey Arce <mikeyarce@gmail.com>
 */
class Storefront_Hooks_Customizer {

	private $storefront_hooks;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'shcz_customize_register' ) );
		add_action( 'after_setup_theme', array( $this, 'shcz_register_storefront_hooks' ) );

		$this->storefront_hooks = [
			'storefront_before_header' => [
				'title' => __( 'Before Header', 'storefront-hooks-customizer' ),
				'section' => 'header_hooks',
			],
			'storefront_header' => [
				'title' => __( 'Header' , 'storefront-hooks-customizer' ),
				'section' => 'header_hooks',
			],
			'storefront_before_content' => [
				'title' => __( 'Before Content', 'storefront-hooks-customizer' ),
				'section' => 'content_hooks',
			],
			'storefront_content_top' => [
				'title' => __( 'Content Top', 'storefront-hooks-customizer' ),
				'section' => 'content_hooks',
			],
			'homepage' => [
				'title' => __( 'Homepage', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_page' => [
				'title' => __( 'Page', 'storefront-hooks-customizer' ),
				'section' => 'content_hooks',
			],
			'storefront_homepage_before_product_categories' => [
				'title' => __( 'Before Product Categories', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_product_categories_title' => [
				'title' => __( 'After Product Categories Title', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_product_categories' => [
				'title' => __( 'After Product Categories', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_before_recent_products' => [
				'title' => __( 'Before Recent Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_recent_products_title' => [
				'title' => __( 'After Recent Products Title', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_recent_products' => [
				'title' => __( 'After Recent Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_before_featured_products' => [
				'title' => __( 'Before Featured Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_featured_products_title' => [
				'title' => __( 'After Featured Products Title', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_featured_products' => [
				'title' => __( 'After Featured Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_before_popular_products' => [
				'title' => __( 'Before Popular Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_popular_products_title' => [
				'title' => __( 'After Popular Products Title', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_popular_products' => [
				'title' => __( 'After Popular Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_before_on_sale_products' => [
				'title' => __( 'Before On Sale Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_on_sale_products_title' => [
				'title' => __( 'After On Sale Products Title', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_on_sale_products' => [
				'title' => __( 'After On Sale Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_before_best_selling_products' => [
				'title' => __( 'Before Best Selling Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_best_selling_products_title' => [
				'title' => __( 'After Best Selling Products Title', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_homepage_after_best_selling_products_products' => [
				'title' => __( 'After Best Selling Products', 'storefront-hooks-customizer' ),
				'section' => 'homepage_hooks',
			],
			'storefront_before_footer' => [
				'title' => __( 'Before Footer', 'storefront-hooks-customizer' ),
				'section' => 'footer_hooks',
			],
			'storefront_footer' => [
				'title' => __( 'Footer', 'storefront-hooks-customizer' ),
				'section' => 'footer_hooks',
			],
			'storefront_after_footer' => [
				'title' => __( 'After Footer', 'storefront-hooks-customizer' ),
				'section' => 'footer_hooks',
			],
		];
	}

	public function shcz_customize_register( $wp_customize ) {

		require_once dirname( __FILE__ ) . '/includes/class-textarea-custom-control.php';

		// Register Main Panel
		$wp_customize->add_panel( 'storefront_hooks', array(
			'title' => __( 'Storefront Hooks' ),
			'description' => 'Hooks',
			'priority' => 160,
		) );

		// Register each Section
		$shcz_secitons = [
			'header_hooks' => [
				'title'       => __( 'Header Hooks', 'storefront-hooks-customizer' ),
				'description' => __( 'These hooks will let you add content into Storefront\'s Header section.  You will likely need CSS to move other things around to get the exact desired look.', 'storefront-hooks-customizer' ),
			],
			'content_hooks' => [
				'title'       => __( 'Content Hooks', 'storefront-hooks-customizer' ),
				'description' => __( 'Here you can hook into the Content section of Storefront.  Keep in mind these will show up any time the content is being displayed!  Use conditional tags if you want to display things only sometimes.', 'storefront-hooks-customizer' ),
			],
			'homepage_hooks' => [
				'title'       => __( 'Homepage Template Hooks', 'storefront-hooks-customizer' ),
				'description' => __( 'Homepage hooks are available when you are using the Homepage Template on your Front Page.', 'storefront-hooks-customizer' ),
			],
			'footer_hooks' => [
				'title'       => __( 'Footer Hooks', 'storefront-hooks-customizer' ),
				'description' => __( 'These are the Footer hooks.', 'storefront-hooks-customizer' ),
			],
		];

		foreach ( $shcz_secitons as $section => $options ) {
			$wp_customize->add_section( $section , array(
				'title'       => $options['title'],
				'panel'       => 'storefront_hooks',
				'description' => $options['description'],
			) );
		}

		$shcz_hooks = $this->storefront_hooks;

		foreach ( $shcz_hooks as $hook => $option ) {
			$wp_customize->add_setting( 'shcz_' . $hook, array(
				'default'        => '',
				'sanitize_callback' => 'wp_kses_post',
			) );
			$wp_customize->add_control( new SHCZ_TinyMCE_Custom_control( $wp_customize, 'shcz_' . $hook, array(
				'label'       => $option['title'],
				'type'        => 'textarea',
				'section'     => $option['section'],
			) ) );
		}
	}

	public function shcz_register_storefront_hooks() {

		$filters = $this->storefront_hooks;

		foreach ( $filters as $filter => $options ) {

			$theme_mod = 'shcz_' . $filter;
			$option    = get_theme_mod( $theme_mod );

			if ( ! empty( $option ) ) {
				add_filter( $filter, function() use ( $option ) {
					echo wp_kses_post( $option );
				} );
			}
		}
	}
}
if ( 'storefront' === get_option( 'template' ) ) {
	new Storefront_Hooks_Customizer();
}
