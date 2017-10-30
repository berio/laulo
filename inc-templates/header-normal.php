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
         <?php echo (!is_page(98))? '<li><a href="/cousas">Cousas</a></li>' : ''; ?>
         <?php if(!is_page(7)){ ?>
         <li><a href="<?php echo esc_url( get_permalink( get_the_id() ) ); ?>"><?php echo wp_trim_words(get_the_title(), 2, '...'); ?></a></li>
        <?php } ?>
     </ul>
 </nav>
