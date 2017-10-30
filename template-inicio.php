<?php
/*
Template Name: Inicio
*/



get_header();
$imaxe_slider = get_post_meta(get_the_ID(), 'bm_inicio_image', true);
$titulo_slider = get_post_meta(get_the_ID(), 'bm_inicio_titulo_slide', true);
$subtitulo_slider = get_post_meta(get_the_ID(), 'bm_inicio_subtitulo_slide', true);
$btn_texto_slider = get_post_meta(get_the_ID(), 'bm_inicio_texto_boton', true);
$btn_url_slider = get_post_meta(get_the_ID(), 'bm_inicio_url_boton', true);
?>
<div class="full" style="background-image:url(<?php echo $imaxe_slider; ?>)">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 contido_slide">
				<?php echo $titulo_slider ? '<h1>'.$titulo_slider.'</h1>' : ''; ?>
				<?php echo $subtitulo_slider ? '<div class="subtitulo">'.$subtitulo_slider.'</div>' : ''; ?>
				<?php echo $btn_url_slider ? '<a href="'.$btn_url_slider.'">' : ''; ?>
				<?php echo $btn_texto_slider ? ''.$btn_texto_slider.'' : ''; ?>
				<?php echo $btn_url_slider ? '</a>' : ''; ?>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12 cousas_inicio">
			<?php
			get_template_part('inc-templates/header', 'normal');

			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			endif;
			?>
		</div>
	</div>
</div>

<?php
get_footer();
