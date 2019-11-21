<?php
/**
 * Plugin Name: HitHot
 * Description: A simple and lightweight pageviews counter for your WordPress posts and pages. Compatible with all cache plugins.
 * Version: 1.0
 * License: GPLv3 or later
 */
defined( 'WPINC' ) || exit;

if ( defined( 'HITHOT_VER' ) ) {
	return;
}

define( 'HITHOT_VER', '1.0' );
! defined( 'HITHOT_DIR' ) && define( 'HITHOT_DIR', dirname( __FILE__ ) . '/' );// Full absolute path '/usr/local/***/wp-content/plugins/hithot/' or MU
! defined( 'HITHOT_PLUGIN_URL' ) && define( 'HITHOT_PLUGIN_URL', plugin_dir_url( __FILE__ ) ) ;// Full URL path 'https://example.com/wp-content/plugins/hithot/'

// Register hooks
add_action( 'the_content', 'hithot_content' );
add_action( 'wp_enqueue_scripts', 'hithot_wp_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'hithot_admin_enqueue_style' ) ;
add_action( 'admin_menu', 'hithot_admin_menu' );

/**
 * Append counter to content
 */
function hithot_content( $content )
{
	if ( ! is_admin() && get_option( 'hithot' ) ) {
		$content .= '
			<div class="hithot_hitnum_div">
				<span class="dashicons dashicons-universal-access"></span>
				<span id="hithot_count"></span>
			</div>
		';
	}

	return $content;
}

/**
 * Add js&css to frontend post/page
 */
function hithot_wp_enqueue_scripts() 
{
	$id = get_the_ID();
	if ( ! $id ) {
		return;
	}

	if ( ! get_option( 'hithot' ) ) {
		return;
	}

	wp_enqueue_style( 'hithot', HITHOT_PLUGIN_URL . 'assets/css/main.css', array(), HITHOT_VER, 'all' );

	wp_register_script( 'hithot', HITHOT_PLUGIN_URL . 'assets/js/main.js', array( 'jquery' ), HITHOT_VER, false );
	$localize_data = array();
	$localize_data[ 'domain' ] = get_site_url();
	$localize_data[ 'post_id' ] = $id;
	wp_localize_script( 'hithot', 'hithot', $localize_data ) ;
	wp_enqueue_script( 'hithot' );
}

function hithot_admin_enqueue_style()
{
	wp_enqueue_style( 'hithot', HITHOT_PLUGIN_URL . 'assets/css/main.css', array(), HITHOT_VER, 'all' );
}

function hithot_admin_menu()
{
	add_options_page( 'HitHot', 'HitHot', 'manage_options', 'hithot', 'hithot_setting_page' );
}

function hithot_setting_page()
{
	if ( ! empty( $_POST ) ) {
		check_admin_referer( 'hithot' );

		if ( isset( $_POST[ 'hithot' ] ) && $_POST[ 'hithot' ] ) {
			$val = 1;
		}
		else {
			$val = 0;
		}
		update_option( 'hithot', $val );
	}

	require_once HITHOT_DIR . 'tpl/settings.tpl.php';
}




