<?php
get_header();
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
//print_r($curauth);
?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">

			<nav id="user_nav">
			    <ul>
			        <?php if(is_user_logged_in()){
			            $author_obj = get_user_by('id', get_current_user_id());
			            ?>
			        <li><a href="<?php echo get_author_posts_url($author_obj->ID) ?>"><?php echo $author_obj->display_name ?></a></li>
			        <?php } ?>
			        <li class="destacado"><a href="/engadir-unha-cousa">Publicar</a></li>
			    </ul>
			</nav>

			<nav id="nav">
				<button type="button"><i class="material-icons">menu</i></button>
				<ul>
					<li class="destacado"><a href="/">Cousateca</a></li>
					<li><a href="/cousas">Cousas</a></li>
                    <li><?php echo $curauth->user_login; ?></li>
				</ul>
			</nav>

            <header id="header">
        		<h1><?php echo $curauth->user_login; ?></h1>
        	</header>
            <p>Cousas publicadas:</p>
            <?php echo do_shortcode('[bm_list_cousas author="'.$curauth->ID.'"]'); ?>
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
	</div>
</div>

<?php
get_footer();
