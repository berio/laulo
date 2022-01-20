<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.svg">
		<link rel="alternate icon" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico">
		<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/icons/safari-pinned-tab.svg" color="#ff8a01">
			
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

			<header class="header" role="banner">

				<a href="<?php echo home_url(); ?>" class="titulo_paxina">
					<?php /*
					svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
					*/ ?>
					<?php if ( is_front_page() || is_home() ) { ?>
						<h1><?php bloginfo('name'); ?></h1>
					<?php }else{ ?>
						<?php bloginfo('name'); ?>
					<?php } ?>
				</a>

				<nav class="nav" role="navigation">
					<?php laulo_menu('header-menu'); ?>
				</nav>

				<?php /*
				Listado das redes socias, collidas da páxina de opcions do theme
				*/
				$redes_sociais = laulo_get_option( '_laulo_opcions_redes' );
				if($redes_sociais){
					echo '<ul class="redes_sociais">';
					foreach ($redes_sociais as $key => $rede) {
						echo '<li><a href="'.$rede['url'].'">'.$rede['icono'].'</a></li>';
					}
					echo '</ul>';
				}
				?>
			</header>
