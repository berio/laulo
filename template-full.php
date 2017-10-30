<?php
/*
Template Name: Ancho completo
*/



get_header();
if (isset($_GET['deleted'])) { ?>
<div id="mensaxe_consola" class="visible"><div class="contido_consola">A cousa foi eliminada</div><button type="button"><i class="material-icons">close</i></button></div>
<?php } ?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">

<?php
if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) : the_post();

	get_template_part('inc-templates/header', 'normal');

	?>
	<?php
		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		the_content();

	endwhile;
endif;
?>
		</div>
	</div>
</div>

<?php
get_footer();
