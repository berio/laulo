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
            <div class="col-12">
                <?php
                $args = array(
                    'theme_location'    => 'menu-1',
                    'fallback_cb'       => '',
                    'depth'             => 1,
                );

                wp_nav_menu($args);
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
