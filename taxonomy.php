<?php get_header();
$term = get_queried_object();
$taxonomy = get_taxonomy($term->taxonomy);
?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<nav id="nav">
				<button type="button"><i class="material-icons">menu</i></button>
				<ul>
					<li class="destacado"><a href="/">Cousateca</a></li>
					<li><a href="/cousas">Cousas</a></li>
					<li><?php echo $term->name; ?></li>
				</ul>
			</nav>
			<?php echo do_shortcode("[bm_list_cousas limit=16 post_status='publish' term='".$term->term_id."']"); ?>
		</div>
	</div>
</div>

<?php
get_footer();
