<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cousateca
 */

?>
<footer id="footer">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-4">
                <img src="<?php echo get_template_directory_uri() ?>/imx/logo_footer.png" alt="Logo Cousateca footer" />
                <?php
                $args = array(
                    'theme_location'    => 'menu-1',
                    'fallback_cb'       => '',
                    'depth'             => 1,
                );

                wp_nav_menu($args);
                ?>

                <?php if(is_user_logged_in()){
                    $author_obj = get_user_by('id', get_current_user_id());
                    ?>

                <div class="menu-menu-superior-container">
                    <ul>
                        <li><a href="<?php echo get_author_posts_url($author_obj->ID) ?>"><?php echo $author_obj->display_name ?></a></li>
                        <li><a href="/engadir-unha-cousa">Publicar</a></li>
                        <li><a href="<?php echo wp_logout_url('/cousas'); ?>">Saír</a></li>
                    </ul>
                </div>

                <?php } ?>
            </div>

            <div class="logos_oficiales col-12">
                <a href="http://colab.coruna.gal/" class="logos_oficiales" target="_blank">
                    <img src="<?php echo get_template_directory_uri() ?>/imx/logos-pe.png" alt="Logo Cousateca footer" />
                </a>
            </div>

        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
