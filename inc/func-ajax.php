<?php
/*------------------------------------*\
	Custom Ajax Calls
\*------------------------------------*/

function nome_funcion(){
   $return_array = array();
   $post_id = $_POST['post_id'];
   array_push($return_array, $post_id);
   die(json_encode($return_array));
}

//add_action('wp_ajax_nome_funcion', 'nome_funcion');
//add_action('wp_ajax_nopriv_nome_funcion', 'nome_funcion');
?>
