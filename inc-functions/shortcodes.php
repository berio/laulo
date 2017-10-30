<?php

/*
	Shortcode Listar Cousas
*/
function bm_do_list_cousas_shortcode( $atts = array() ) {
	// Parse attributes
	$atts = shortcode_atts( array(
		'limit' 	=> 10, // Current user, or admin
		'term'		=> '',
		'author'	=> ''
	), $atts, 'cmb_frontend_form' );

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$args = array(
		'post_type' 		=> 'cousa',
		'posts_per_page'	=> $atts['limit'],
		'paged' 			=> $paged
	);
	if($atts['term'] != ''){
		$term = get_term($atts['term']);

		$args['tax_query'] = array(
			array(
				'taxonomy' 	=> $term->taxonomy,
				'field' 	=> 'term_id',
				'terms'		=> $atts['term']
			)
		);
	}
	if($atts['author'] != ''){
		$args['author'] = $atts['author'];
	}

	$the_query = new WP_Query( $args );

	// gardamos a query anterior
	global $wp_query;
	$tmp_query = $wp_query;
	$wp_query = null;
	$wp_query = $the_query;

	$output = '';

	if ( $the_query->have_posts() ) {
		$output .= '<div id="list_cousas">';
		$output .= '<div class="row">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$output .= '<article class="col-md-3 col-sm-6 col-6 cousa-list">';
			$output .= '<a href="'.esc_url( get_permalink(get_the_ID())).'">';
			$output .= '<h3>' . get_the_title() . '</h3>';
			$output .= get_the_post_thumbnail(get_the_ID(), 'cousa-image-list', array('class' => 'img-fluid'));
			$output .= '</a>';
			$output .= '<div class="periodo">';
			$usos = wp_get_post_terms(get_the_ID(), 'uso');
			foreach($usos as $uso) {
			   $output .= 'Para <span><a href="'.get_term_link($uso->term_id).'">' . $uso->name . '</a></span>'; //do something here
			}
			$output .= '</div>';
			$output .= '<i class="material-icons">arrow_forward</i>';
			$output .= '</article>';
		}

		$output .= '</div>';

		$output .= '<div class="navegacion row">';
		$output .= '<div class="col-md-6 exq">';
		$output .= get_previous_posts_link('<i class="material-icons">chevron_left</i><i class="material-icons">chevron_left</i>');
		$output .= '</div>';
		$output .= '<div class="col-md-6 der">';
		$output .= get_next_posts_link('<i class="material-icons">chevron_right</i><i class="material-icons">chevron_right</i>');
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		/* Restore original Post Data */
		wp_reset_postdata();
	} else {
		if($atts['author'] != ''){
			$output .= '<p>Aínda non tes ningunha cousa publicada. Se queres facelo diríxete ao formulario de <a href="/engadir-unha-cousa/">engadir unha cousa</a>.</p>';
			$output .= '<p>Se queres ver o que xa hai publicado diríxete ao <a href="/cousas">arquivo de cousas</a>.</p>';
		}
		// no posts found
	}

	// retomamos a query anterior
	$wp_query = null;
	$wp_query = $tmp_query;

	return $output;
}
add_shortcode( 'bm_list_cousas', 'bm_do_list_cousas_shortcode' );


/*
	Shortcode Buscar Cousas
*/
function bm_do_buscar_shortcode( $atts = array() ) {

	$usos = get_terms( array(
    	'taxonomy' => 'uso',
    	'hide_empty' => false,
	) );

	$tipos = get_terms( array(
    	'taxonomy' => 'tipo',
    	'hide_empty' => false,
	) );

	// Parse attributes
	$atts = shortcode_atts( array(
		'limit' => 10, // Current user, or admin
		'term'	=> ''
	), $atts, 'cmb_frontend_form' );

	$output = '';
	$output .= '<div class="caja_buscar">';
	$output .= '<h1>Buscar</h1>';
	$output .= '<div class="row"><div class="col-md-6">';
	$output .= '<form id="buscar">';
	$output .= '<div class="input_container">';
	$output .= '<input type="text" />';
	$output .= '<button type="submit" class="dispara_ler">Buscar</button>';
	$output .= '</div>';
	$output .= '</form>';
	$output .= '<div class="resultado_busqueda">Últimas cousas publicadas:</div>';
	$output .= '</div>';
	$output .= '<div class="col-md-6">';
	$output .= '<div class="listado_tax_buscar">';
	$output .= '<span class>Uso:</span>';
	$output .= '<ul>';
	foreach($usos as $uso) {
	   $output .= '<li><a href="'.get_term_link($uso->term_id).'"> ' . $uso->name . ' </a> </li>'; //do something here
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '<div class="listado_tax_buscar">';
	$output .= '<span class>Tipo:</span>';
	$output .= '<ul>';
	foreach($tipos as $tipo) {
	   $output .= '<li><a href="'.get_term_link($tipo->term_id).'"> ' . $tipo->name . ' </a> </li>'; //do something here
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'bm_buscar', 'bm_do_buscar_shortcode' );
