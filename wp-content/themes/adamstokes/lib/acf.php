<?php

	namespace Levy\Template\ACF;

	/**
	 * ACF configurations after WordPress has finished loading
	 * but before headers are sent
	 */
	add_action( 'init', function () {
		// Register ACF options
		if ( function_exists( 'acf_add_options_page' ) ) {
			// Add parent Options page
			$parent_page = acf_add_options_page( [
				'page_title' => 'Theme Options',
				'menu_title' => 'Theme Options',
				'menu_slug'  => 'acf-options',
				'redirect'   => true,
			] );

			// Add sub pages
			acf_add_options_sub_page( [
				'page_title'  => 'Theme Options',
				'menu_title'  => 'Theme',
				'menu_slug'   => 'acf-theme-options',
				'parent_slug' => $parent_page['menu_slug'],
			] );
		}
	} );


	/**
	 * Hides ACF menu in dashboard. The URL check should match the devUrl in
	 * assets/manifest.json.
	 *
	 * @return mixed
	 */
	add_filter( 'acf/settings/show_admin', function () {
		if ( false !== strpos( get_bloginfo( 'url' ), 'adamstokes.levy' ) ) :
			return current_user_can( 'administrator' );
		endif;

		return false;
	} );