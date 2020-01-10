<?php
	
	$theme_includes = [
		'lib/assets.php',    // Scripts and stylesheets
		'lib/helpers.php',   // Custom functions
		'lib/theme.php',     // Theme setup
		'lib/wrapper.php',   // Theme wrapper class
		'lib/acf.php',       // ACF customizations
	];

	foreach ( $theme_includes as $file ) {
		if ( ! $filepath = locate_template( $file ) ) {
			trigger_error( sprintf( __( 'Error locating %s for inclusion', 'adamstokes' ), $file ), E_USER_ERROR );
		}

		require_once $filepath;
	}
	unset( $file, $filepath );
