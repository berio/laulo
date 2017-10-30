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
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-7">
<?php
if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) : the_post();

	get_template_part('inc-templates/header', 'normal');
	?>

	<header id="header">
		<h1><?php the_title(); ?></h1>
	</header>
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
