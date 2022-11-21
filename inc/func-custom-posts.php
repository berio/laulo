<?php
/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

/**
 * Post types
 */

// Etiquetas post type
function getEtiquetasPostType($singular, $plural)
{
    $labels = array(
        'name' => __($plural, 'laulo'),
        'singular_name'  => __($singular, 'laulo'),
        'menu_name'  => __($plural, 'laulo'),
        'add_new'  => __('Add '.$singular, 'laulo'),
        'add_new_item'  => __('Add New '.$singular, 'laulo'),
        'edit'  => __('Edit', 'laulo'),
        'edit_item'  => __('Edit '.$singular, 'laulo'),
        'new_item'  => __('New '.$singular, 'laulo'),
        'view'  => __('View '.$singular, 'laulo'),
        'view_item'  => __('View '.$singular, 'laulo'),
        'search_items'  => __('Search '.$plural, 'laulo'),
        'not_found'  => __('No '.$plural.' Found', 'laulo'),
        'not_found_in_trash'  => __('No '.$plural.' Found in Trash', 'laulo'),
        'parent'  => __('Parent '.$singular, 'laulo')
    );

    return $labels;
}

// Etiquetas taxonomia
function getEtiquetasTaxonomia($singular, $plural)
{
    $labels = array(
        'name'              => _x($plural, 'taxonomy general name', 'laulo'),
        'singular_name'     => _x($singular, 'taxonomy singular name', 'laulo'),
        'search_items'      => __('Search '.$plural, 'laulo'),
        'all_items'         => __('All '.$plural, 'laulo'),
        'parent_item'       => __('Parent '.$singular, 'laulo'),
        'parent_item_colon' => __('Parent '.$singular.':', 'laulo'),
        'edit_item'         => __('Edit '.$singular.'', 'laulo'),
        'update_item'       => __('Update '.$singular.'', 'laulo'),
        'add_new_item'      => __('Add New '.$singular.'', 'laulo'),
        'new_item_name'     => __('New '.$singular.' Name', 'laulo'),
        'menu_name'         => __($singular, 'laulo'),
    );

    return $labels;
}


function registrarPostTypes($postTypes)
{
    if ($postTypes) {
        foreach ($postTypes as $tipo => $valor) {
          register_post_type($tipo, array(
              'label'           => $valor[0],
              'public'          => true,
              'capability_type' => 'post',
              'map_meta_cap'    => true,
              'rewrite'         => array('with_front' => false),
              'query_var'       => $tipo,
              'has_archive'     => true,
              'show_in_rest'    => true, // para facer que apareza no Gutemberg
              'menu_icon'       => $valor[1],
              'menu_position'   => 4,
              'supports'        => $valor[2],
              'labels'          => getEtiquetasPostType(ucfirst($tipo), $valor[0])
          ));
        }
    }
}

function registrarTaxonomias($taxonomias)
{
    if ($taxonomias) {
        foreach ($taxonomias as $tax => $valor) {
            register_taxonomy($tax, $valor[1], array(
                'hierarchical'      => true,
                'labels'            => getEtiquetasTaxonomia(ucfirst($tax), $valor[0]),
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'show_in_rest'      => true, // para facer que apareza no Gutemberg
                'rewrite'           => array( 'slug' => $tax ),
            ));
        }
    }
}

function crearPostTypes()
{
    $postTypes = array(
        'empresa' => array('Empresas','dashicons-groups', array('title','thumbnail'))
    );
    $taxonomias = array(
        'tipo' => array('Tipo','movimiento')
    );

    //registrarPostTypes($postTypes);
    //registrarTaxonomias($taxonomias);
}

add_action('init', 'crearPostTypes'); // Añadir post types
?>
