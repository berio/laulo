<?php
	/*
	Template Name: Traballando
	*/


    get_header(); ?>
    <div class="container">


    <?php
    if ( have_posts() ) :

    	/* Start the Loop */
    	while ( have_posts() ) : the_post();?>

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
