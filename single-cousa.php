<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cousateca
 */

get_header(); ?>

<?php if (isset($_GET['post_submitted'])) { ?>
	<div id="mensaxe_consola" class="visible"><div class="contido_consola">A cousa foi engadida. Esta é a súa páxina</div><button type="button"><i class="material-icons">close</i></button></div>
<?php }else{ ?>
	<div id="mensaxe_consola"><div class="contido_consola">ola</div><button type="button"><i class="material-icons">close</i></button></div>
<?php } ?>

<div id="info_full"></div>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
<?php
if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) : the_post();
		get_template_part('inc-templates/header', 'normal');

	?>

			<article class="post-entry">

				<header id="header">
					<h1><?php the_title(); ?></h1>
				</header>

				<div class="content">
					<?php the_content(); ?>
				</div>

				<div class="termos">
					<div class="term">
						Compártese como
					<?php $usos = wp_get_post_terms(get_the_ID(), 'uso');
					foreach($usos as $uso) {
					   echo '<span><a href="'.get_term_link($uso->term_id).'">' . $uso->name . '</a></span>'; //do something here
					}
					?>
				   </div>

				   <div class="term">
					   Esta arquivada na categoría de
				   <?php $tipos = wp_get_post_terms(get_the_ID(), 'tipo');
				   foreach($tipos as $tipo) {
					  echo '<span><a href="'.get_term_link($tipo->term_id).'">' . $tipo->name . '</a></span>'; //do something here
				   }
				   ?>
				  </div>
			   </div>

				<div class="ficha">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-9">
							<?php the_post_thumbnail('cousa-image', array('class' => 'img-fluid')); ?>
						</div>
						<div class="col-12 col-sm-12 col-md-3">
							<div class="datas">
								Dispoñible ata o
								<span class="forte"><?php echo get_post_meta(get_the_ID(), 'bm_cousaform_ata', true); ?></span>
							</div>
							<button type="button" id="btn_querer_usar" data-id="<?php the_id(); ?>">Quero usala</button>
							<div class="contido_enviar_usar form_01">
							</div>
						</div>
					</div>

					<div class="row segunda_fila">
						<div class="col-12 col-sm-12 col-md-9">
							<?php $coord = get_post_meta(get_the_ID(), 'bm_cousaform_localizacion', true); ?>
							 <div id="map"></div>
							 <script>
								 var latlng = {lat: <?php echo $coord['latitude']; ?>, lng: <?php echo $coord['longitude']; ?>};
								 function initMap() {
									 var map = new google.maps.Map(document.getElementById('map'), {
										zoom: 15,
										center: latlng
									  });
									  var icon_image = {
										  url: '<?php echo get_template_directory_uri() ?>/imx/marker.png ?>',
										  size: new google.maps.Size(32, 47),
										  origin: new google.maps.Point(0, 0),
										  anchor: new google.maps.Point(32, 47),
									  };
									  var marker = new google.maps.Marker({
										position: latlng,
										icon: icon_image,
										map: map
									  });
									  var geocoder = new google.maps.Geocoder;
									  geocodeLatLng(geocoder, map);
								 }

								 function geocodeLatLng(geocoder, map) {
									 geocoder.geocode({'location': latlng}, function(results, status) {
										if (status === 'OK') {
											if (results[1]) {
	  	  										console.log(results);
	  	  										jQuery('.direccion').append(results[0].formatted_address);
	  	  						            }
  	  						          	}
	  						         });
								 }
								 initMap();
						     </script>
						</div>
						<div class="col-12 col-sm-12 col-md-3">
							<div class="direccion">Esta cousa está en<br /></div>
						</div>
					</div>

				</div>

			</article>
	<?php
	endwhile;
endif;
?>
		</div>
	</div>
</div>

<?php if(is_user_logged_in()){
	$author_obj = get_user_by('id', get_current_user_id());
	$author_post = get_the_author_meta('id');
	if($author_post == $author_obj->ID){ ?>
		<div class="container-edicion">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8">
						<h3>Eidición</h3>
						<?php $disponhible = wp_get_post_terms(get_the_id(), 'estado', 'ids'); ?>
						<div class="bloque_edicion checkbox<?php echo ($disponhible[0]->term_id == 15) ? ' checked' : '' ?>">
							<input type="checkbox" id="disponible"<?php echo ($disponhible[0]->term_id == 15) ? ' checked' : '' ?>> <label for="disponible">Dispoñible</label>
						</div>
						<div class="bloque_edicion">

							<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo esc_url(get_permalink(get_the_id()));?>&choe=UTF-8" />
						</div>
						<div class="bloque_edicion botons">
							<button type="button" id="btn_gardar_cousa" data-id="<?php the_id(); ?>">Gardar</button>
							<button type="button" id="btn_eliminar_cousa" data-id="<?php the_id(); ?>">Eliminar cousa</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>
<?php } ?>


<?php
get_footer();
