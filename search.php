<?php
get_header(); ?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<nav id="nav">
				<button type="button"><i class="material-icons">menu</i></button>
				<ul>
					<li class="destacado"><a href="/">Cousateca</a></li>
				</ul>
			</nav>
<?php
if ( have_posts() ) :
    echo '<div id="list_cousas">';
    echo '<div class="row">';
	/* Start the Loop */
	while ( have_posts() ) : the_post();?>
	<?php
		get_template_part( 'content', 'cousa' );

	endwhile;
    echo '</div>';
    echo '</div>';
endif;
get_search_form();
?>
		</div>
	</div>
</div>

<?php
get_footer();
