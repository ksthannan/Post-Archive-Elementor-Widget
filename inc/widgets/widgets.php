<?php 
function register_post_archive_widget( $widgets_manager ) {

	require_once( __DIR__ . '/post-archive.php' );

	$widgets_manager->register( new \Elementor_Post_Archive_Widget() );

}
add_action( 'elementor/widgets/register', 'register_post_archive_widget' );

function paew_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'custom',
		[
			'title' => esc_html__( 'Custom', 'paew' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'paew_add_elementor_widget_categories' );