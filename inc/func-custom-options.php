<?php
// Descomentar para activar
//add_action( 'cmb2_admin_init', 'laulo_register_theme_options_metabox' );

function laulo_register_theme_options_metabox() {
	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'           => 'laulo_option_metabox',
		'title'        => esc_html__( 'UGBN Opcions', 'laulo' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'laulo_options', // The option key and admin menu page slug.
		// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'laulo' ), // Falls back to 'title' (above).
		// 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'laulo' ), // The text for the options-page save button. Defaults to 'Save'.
	) );
	/*
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */
	 /* Repeated group. Redes sociais
	 */
	 $prefix = '_laulo_opcions_';
	 $group_redes = $cmb_options->add_field( array(
		  'id'          => $prefix . 'redes',
		  'type'        => 'group',
		  'options'     => array(
				'group_title'   => __( 'Red Social {#}', 'laulo' ), // {#} gets replaced by row number
				'add_button'    => __( 'Añadir otra red', 'laulo' ),
				'remove_button' => __( 'Quitar red', 'laulo' ),
				'sortable'      => true, // beta
				// 'closed'     => true, // true to have the groups closed by default
		  ),
	 ) );	 
	 $cmb_options->add_group_field( $group_redes, array(
   	'name'       => __( 'Url', 'laulo' ),
   	'id'         => 'url',
   	'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	)); 
	 $cmb_options->add_group_field( $group_redes, array(
	  'name'       => __( 'Icono', 'laulo' ),
	  'id'         => 'icono',
	  'type'       => 'textarea_code',
	  'options' => array( 'disable_codemirror' => true ),
	  'attributes'  => array(
	  		'rows'        => 1,
  		),
  )); 

	$cmb_options->add_field( array(
		'name' => __( 'Test Text', 'laulo' ),
		'desc' => __( 'field description (optional)', 'laulo' ),
		'id'   => 'test_text',
		'type' => 'text',
		'default' => 'Default Text',
	) );
	$cmb_options->add_field( array(
		'name'    => __( 'Test Color Picker', 'laulo' ),
		'desc'    => __( 'field description (optional)', 'laulo' ),
		'id'      => 'test_colorpicker',
		'type'    => 'colorpicker',
		'default' => '#bada55',
	) );
}
/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function laulo_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'laulo_options', $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'laulo_options', $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}

?>
