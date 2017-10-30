<?php
echo '<article class="col-md-3 cousa-list">';
echo '<a href="'.esc_url( get_permalink(get_the_ID())).'">';
echo '<h3>' . get_the_title() . '</h3>';
echo get_the_post_thumbnail(get_the_ID(), 'cousa-image-list', array('class' => 'img-fluid'));
echo '</a>';
echo '<div class="periodo">';
$usos = wp_get_post_terms(get_the_ID(), 'uso');
foreach($usos as $uso) {
   echo 'Para <span><a href="'.get_term_link($uso->term_id).'">' . $uso->name . '</a></span>'; //do something here
}
echo '</div>';
echo '<i class="material-icons">arrow_forward</i>';
echo '</article>';
?>
