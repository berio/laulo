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
        'name' => __($plural, 'cuentica'),
        'singular_name'  => __($singular, 'cuentica'),
        'menu_name'  => __($plural, 'cuentica'),
        'add_new'  => __('Add '.$singular, 'cuentica'),
        'add_new_item'  => __('Add New '.$singular, 'cuentica'),
        'edit'  => __('Edit', 'cuentica'),
        'edit_item'  => __('Edit '.$singular, 'cuentica'),
        'new_item'  => __('New '.$singular, 'cuentica'),
        'view'  => __('View '.$singular, 'cuentica'),
        'view_item'  => __('View '.$singular, 'cuentica'),
        'search_items'  => __('Search '.$plural, 'cuentica'),
        'not_found'  => __('No '.$plural.' Found', 'cuentica'),
        'not_found_in_trash'  => __('No '.$plural.' Found in Trash', 'cuentica'),
        'parent'  => __('Parent '.$singular, 'cuentica')
    );

    return $labels;
}

// Etiquetas taxonomia
function getEtiquetasTaxonomia($singular, $plural)
{
    $labels = array(
        'name'              => _x($plural, 'taxonomy general name', 'cuentica'),
        'singular_name'     => _x($singular, 'taxonomy singular name', 'cuentica'),
        'search_items'      => __('Search '.$plural, 'cuentica'),
        'all_items'         => __('All '.$plural, 'cuentica'),
        'parent_item'       => __('Parent '.$singular, 'cuentica'),
        'parent_item_colon' => __('Parent '.$singular.':', 'cuentica'),
        'edit_item'         => __('Edit '.$singular.'', 'cuentica'),
        'update_item'       => __('Update '.$singular.'', 'cuentica'),
        'add_new_item'      => __('Add New '.$singular.'', 'cuentica'),
        'new_item_name'     => __('New '.$singular.' Name', 'cuentica'),
        'menu_name'         => __($singular, 'cuentica'),
    );

    return $labels;
}


function registrarPostTypes($postTypes)
{
    if ($postTypes) {
        foreach ($postTypes as $tipo => $valor) {
            register_post_type($tipo, array(
                'label' => $valor[0],
                'public' => true,
                'capability_type' => 'post',
                'map_meta_cap' => true,
                'rewrite' => array('with_front' => false),
                'query_var' => $tipo,
                'has_archive' => true,
                'menu_icon' => $valor[1],
                'supports' => array('title','thumbnail'),
                'labels' => getEtiquetasPostType(ucfirst($tipo), $valor[0])
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
                'rewrite'           => array( 'slug' => $tax ),
            ));
        }
    }
}

function crearPostTypes()
{
    $postTypes = array(
        'empresa' => array('Empresas','dashicons-groups')
    );
    $taxonomias = array(
        'tipo' => array('Tipo','movimiento')
    );

    //registrarPostTypes($postTypes);
    //registrarTaxonomias($taxonomias);
}

add_action('init', 'crearPostTypes'); // Añadir post types
?>
