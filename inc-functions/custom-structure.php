<?php
/*
add_action( 'init', 'bm_rexistra_post_types' );
function bm_rexistra_post_types(){

	// Cousa post type
	$labels = array(
		'name'			=> 'cousas',
		'singular_name'	=> 'cousa',
		'menu_name'		=> 'Cousas',
	);

	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'show_ui'				=> true,
		'supports'				=> array('title', 'thumbnail', 'editor', 'author'),
		'rewrite'            	=> array( 'slug' => 'cousa' ),
		'menu_position'			=> 5
	);
	register_post_type( 'cousa', $args );

	// Usos taxonomy
	$usos_args = array(
		"hierarchical" => true,
		"label" => "Usos",
		"singular_label" => "Uso",
		"query_var" => true
	);
	register_taxonomy("uso", array("cousa"), $usos_args);
}
*/
