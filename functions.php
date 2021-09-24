<?php
/* INCLUDES */
require_once( 'inc/class_airtable.php' );
require_once( 'inc/gf_registrations.php' );
require_once( 'inc/gf_payments.php' );
require_once( 'inc/shortcodes.php' );

/* Load Child Theme Styles */
function child_theme_enqueue_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/min/style-min.css' );
}
add_action( 'get_footer', 'child_theme_enqueue_styles' );


/* Load Child Theme Javascript */
function child_theme_enqueue_scripts() {
	wp_enqueue_script( 'js-teaser', get_stylesheet_directory_uri() . '/min/js-teaser-min.js' );
}
add_action('get_footer', 'child_theme_enqueue_scripts' );


/* Disable the admin bar for all users */
add_filter( 'show_admin_bar', '__return_false' );


/* Remove default Avada portfolio & faq functionality  */
function remove_avada_cpts()
{
	unregister_post_type('avada_portfolio');
	unregister_post_type('avada_faq');
	unregister_taxonomy('portfolio_category');
	unregister_taxonomy('portfolio_tags');
	unregister_taxonomy('portfolio_skills');
	unregister_taxonomy('faq_category');
}
add_action('init', 'remove_avada_cpts');


/* Enables the HTTP Strict Transport Security (HSTS) header in WordPress. */
function enable_strict_transport_security_hsts_header_wordpress() {
	header( 'Strict-Transport-Security: max-age=10886400' );
}


/* Dequeuing guttenberg and dequeue tmm and enqueue in footer */
function remove_block_css() {
	wp_dequeue_style( 'wp-block-library');
	wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );


/* ACF PRO OPTIONS PAGES */
if( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title'	=> 'Trips General Settings',
		'menu_title'	=> 'Trips Settings',
		'menu_slug'		=> 'trips-settings',
		'capability'	=> 'manage_options',
		'position'		=> false,
		'icon_url'		=> false
	) );

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Airtable Settings',
		'menu_title'	=> 'Airtable Settings',
		'parent_slug'	=> 'trips-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Registration Settings',
		'menu_title'	=> 'Registration Settings',
		'parent_slug'	=> 'trips-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Payment Settings',
		'menu_title'	=> 'Payment Settings',
		'parent_slug'	=> 'trips-settings',
	));
}


/* ACF PRO GOOGLE MAPS API KEY */
function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyDf9fMDmH3CupC1u5nsYGKh7vFAfBGoE94';
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


/* ACF PRO Google Map Shortcode */
function do_acf_gmap( $atts = array() ) {

	// set up default parameters
    extract( shortcode_atts( array(
    	'field_name' => ''
    ), $atts ) );

	$location = get_field( $field_name );

	wp_enqueue_script( 'gmap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDf9fMDmH3CupC1u5nsYGKh7vFAfBGoE94', array(), false, true );
	wp_enqueue_script( 'acf_gmap', get_stylesheet_directory_uri() . '/min/acf-gmap-min.js', array( 'gmap' ), false, true );
	
	if( $location ):
		ob_start();
		?>
    	<div class="acf-map" data-zoom="9">
        	<div class="marker" data-lat="<?php echo esc_attr( $location['lat'] ); ?>" data-lng="<?php echo esc_attr( $location['lng'] ); ?>"></div>
    	</div>
		<?php
		$return = ob_get_clean();
	else:
		$return = "There was an error.";
	endif;

	return $return;
}
add_shortcode( 'acf_gmap', 'do_acf_gmap' );