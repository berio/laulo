<?php
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

	// Tipos taxonomy
	$tipos_args = array(
		"hierarchical" => true,
		"label" => "Tipos",
		"singular_label" => "Tipo",
		"query_var" => true
	);
	register_taxonomy("tipo", array("cousa"), $tipos_args);

	// Tipos taxonomy
	$estado_args = array(
		"hierarchical" => true,
		"label" => "Estados",
		"singular_label" => "Estado",
		"query_var" => true
	);
	register_taxonomy("estado", array("cousa"), $estado_args);
}
