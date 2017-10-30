<?php
if ( is_admin() ) {
    add_action( 'wp_ajax_pedir_cousa', 'pedir_cousa' );
    add_action( 'wp_ajax_nopriv_pedir_cousa', 'pedir_cousa' );
    add_action( 'wp_ajax_gardar_cousa', 'gardar_cousa' );
    add_action( 'wp_ajax_nopriv_gardar_cousa', 'gardar_cousa' );
    add_action( 'wp_ajax_eliminar_cousa', 'eliminar_cousa' );
    add_action( 'wp_ajax_nopriv_eliminar_cousa', 'eliminar_cousa' );
}

function pedir_cousa(){
	$resultado = array('feito'	=> 'non');

	// Envio email a solicitante
	$email_solicitante = $_POST['email'];
	$cousa_id = $_POST['cousa_id'];
    $cousa_titulo = get_the_title($cousa_id);
	$nome = $_POST['nome'];
    $nome_dono = get_post_meta($cousa_id, 'bm_cousaform_nome', true);

	$subject = '[Cousateca] A túa petición foi enviada';
	$mensaxe = 'Ola ' . $nome;
    $mensaxe .= '<br><br> A túa petición foi enviada a ' . $nome_dono;
    $mensaxe .= '<br> Porase en contacto contigo en canto lle sexa posible.';
    $mensaxe .= '<br><br> Un saúdo';
	$headers = array('Content-Type: text/html; charset=UTF-8');

	$resultado['email'] = $email_solicitante;
	$resultado['cousa_id'] = $cousa_id;
	$resultado['nome'] = $nome;

	wp_mail($email_solicitante, $subject, $mensaxe, $headers);

	// Envio email a dono da cousa
	$cousa_id = $_POST['cousa_id'];
	$email = get_post_meta($cousa_id, 'bm_cousaform_email', true);
	$subject = '[Cousateca] Alguén quere unha cousa túa';
	$mensaxe = 'Ola ' . $nome_dono;
    $mensaxe .= '<br><br>A ' . $nome . ' interésalle a seguinte cousa:';
    $mensaxe .= '<br><br>' . $cousa_titulo . ' ('.get_permalink($cousa_id).')';
    $mensaxe .= '<br /><br />Podes escribirlle ao seguinte email:' . $email_solicitante . ' para falar dos detalles';
    $mensaxe .= '<br /><br />Saúdos';
	$headers = array('Content-Type: text/html; charset=UTF-8');

	$resultado['email'] = $email;
	$resultado['cousa_id'] = $cousa_id;
	$resultado['nome'] = $nome_dono;

	wp_mail($email, $subject, $mensaxe, $headers);

	$resultado['feito'] = 'si';



	die(json_encode($resultado));
}

function eliminar_cousa(){
    $resultado = array('feito'	=> 'non');
    $cousa_id = $_POST['cousa_id'];

    wp_delete_post($cousa_id, true);

    $resultado['feito'] = 'si';
    $resultado['cousa_id'] = $cousa_id;

	die(json_encode($resultado));
}

function gardar_cousa(){
    $resultado = array('feito'	=> 'non');
    $cousa_id = $_POST['cousa_id'];
    $checked = $_POST['checked'];

    if($checked == 'true'){
        wp_set_post_terms($cousa_id, array(15), 'estado', false);
    }else{
        wp_set_post_terms($cousa_id, array(14), 'estado', false);
    }

    $resultado['feito'] = 'si';
    $resultado['cousa_id'] = $cousa_id;
    $resultado['checked'] = $checked;

	die(json_encode($resultado));
}
