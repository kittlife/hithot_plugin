<?php
/**
 * Plugin Name: HitHot
 * Description: A simple and lightweight pageviews counter for your WordPress posts and pages.
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

add_action( 'the_content', 'hithot_content' );
add_action( 'wp_enqueue_scripts', 'hithot_wp_enqueue_scripts' );

function hithot_content( $content )
{
	if ( ! is_admin() ) {

		
		$count = get_post_meta( $id, 'hithot_count', true ); // false, $count is array, $count[0]
		$count ++;
		update_post_meta( $id, 'hithot_count', $count );
		$content .= '
			<div class="hithot_hitnum_div">
				<span class="dashicons dashicons-universal-access"></span>
				<span id="hithot_count"></span>
			</div>
		';

	}

	return $content;
}

function hithot_wp_enqueue_scripts() 
{
	$id = get_the_ID();
	if ( ! $id ) {
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
