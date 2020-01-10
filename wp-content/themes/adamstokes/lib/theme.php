<?php

	namespace Levy\Template\Setup;

	use Levy\Template\Wrapper;
	use Levy\Template\Assets;


	/**
	 * Sets up theme features
	 */
	add_action( 'after_setup_theme', function () {
		// Make theme available for translation
		// Community translations can be found at https://github.com/roots/sage-translations
		load_theme_textdomain( 'adamstokes', get_template_directory() . '/lang' );

		// Register wp_nav_menu() menus
		// http://codex.wordpress.org/Function_Reference/register_nav_menus
		register_nav_menus( [
			'header_navigation' => __( 'Header Navigation', 'adamstokes' ),
			'footer_navigation' => __( 'Footer Navigation', 'adamstokes' ),
		] );

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats', [ 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ] );
		add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );

		// Use main stylesheet for visual editor
		// To add custom styles edit /assets/styles/layouts/_tinymce.scss
		add_editor_style( Assets\asset_path( 'styles/main.css' ) );
	} );


	/**
	 * Registers sidebars and widgets
	 */
	add_action( 'widgets_init', function () {
		register_sidebar( [
			'name'          => __( 'Blog', 'adamstokes' ),
			'id'            => 'sidebar-blog',
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		] );
	} );


	/**
	 * Enqueues theme assets
	 */
	add_action( 'wp_enqueue_scripts', function () {
		wp_enqueue_style( 'sage/css', Assets\asset_path( 'styles/main.css' ), false, null );

		if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'sage/js', Assets\asset_path( 'scripts/main.js' ), [ 'jquery' ], null, true );
	}, 100 );


	/**
	 * Adds postMessage support
	 */
	add_action( 'customize_register', function ( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	} );


	/**
	 * Enqueues customizer JS
	 */
	add_action( 'customize_preview_init', function () {
		wp_enqueue_script( 'sage/customizer', Assets\asset_path( 'scripts/customizer.js' ), [ 'customize-preview' ], null, true );
	} );


	/**
	 * Adds classes to body
	 */
	add_filter( 'body_class', function ( $classes ) {
		// Add page slug if it doesn't exist
		if ( is_single() || is_page() && ! is_front_page() ) {
			if ( ! in_array( basename( get_permalink() ), $classes ) ) {
				$classes[] = basename( get_permalink() );
			}
		}

		// Add class if sidebar is active
		if ( Wrapper\display_sidebar() ) {
			$classes[] = 'has-sidebar';
		}

		return $classes;
	} );


	/**
	 * Cleans up the_excerpt()
	 */
	add_filter( 'excerpt_more', function () {
		return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'adamstokes' ) . '</a>';
	} );


	/**
	 * Hides Theme Editor menu in dashboard
	 */
	add_action( '_admin_menu', function () {
		remove_action( 'admin_menu', '_add_themes_utility_last', 101 );
	} );


	/**
	 * Disables auto p filter on Contact Form 7 elements
	 */
	add_filter( 'wpcf7_autop_or_not', '__return_false' );


	/**
	 * Registers Levy Online dashboard support box
	 */
	add_action( 'wp_dashboard_setup', function () {
		wp_add_dashboard_widget( 'custom_help_widget', 'Website created by', function () {
			echo '
        <img src="https://www.levyonline.com/assets/logo-levyonline.png">
        <p><strong>Contact Levy Online</strong></p>
        <ul>
        	<li>5905 S. Decatur Blvd. Suite 1<br> Las Vegas, NV 89118</li>
        	<li>702-739-3082</li>
        	<li>Visit us online at <a href="https://www.levyonline.com" target="_blank">www.levyonline.com</a></li>
        	<li>For Help, updates or additions please contact us at <a href="mailto:support@levyonline.com">support@levyonline.com</a></li>
        </ul>
        <p><strong>Helpful Links</strong></p>
        <p>Looking for some simple "How To" in WordPress? Here are some links to some great resources.</p>
        <ul>
        	<li><a href="https://www.wpbeginner.com/" target="_blank">wpBeginner.com</a></li>
        	<li><a href="https://www.simplewpguide.com/" target="_blank">Simple WP Guide</a></li>
        	<li><a href="https://codex.wordpress.org/WordPress_Menu_User_Guide#Adding_Items_to_a_Menu" target="_blank">Menu User Guide</a></li>
        	<li><a href="https://codex.wordpress.org/Embeds" target="_blank">Easy Video Embeds</a></li>
        	<li><a href="https://www.youtube.com/watch?v=uIJmW-jC8t0" target="_blank">Video – Adding a link in your content area</a></li>
        	<li><a href="https://www.youtube.com/watch?v=_XYZNoxBuss" target="_blank">Video – Inserting Images in a Post or Page</a></li>
        	<li><a href="https://www.youtube.com/watch?v=EXvj-Ujp1tQ" target="_blank">Video – Learn How to Create and Use WordPress Menus</a></li>
        	<li>Documentation from the source, <a href="https://wordpress.org/" target="_blank">WordPress.org</a></li>
        </ul>';
		} );
	} );


	/**
	 * Loads assets for admin / dashboard.
	 */
	add_action( 'admin_enqueue_scripts', function () {
		wp_enqueue_style( 'admin-styles', Assets\asset_path( 'styles/admin.css' ), null, null );
	} );


	/**
	 * Returns filtered user role capabilities
	 *
	 * @param $caps
	 * @param $cap
	 * @param $user_id
	 *
	 * @return array
	 */
	add_filter( 'map_meta_cap', function ( $caps, $cap, $user_id ) {
		// Allow admins to add scripts
		if ( 'unfiltered_html' === $cap && ( user_can( $user_id, 'administrator' ) || user_can( $user_id, 'wpseo_manager' ) ) ) {
			$caps = [ 'unfiltered_html' ];
		}

		return $caps;
	}, 1, 3 );


	/**
	 * Returns filtered nav menu item CSS classes.
	 *
	 * @param $classes
	 * @param $item
	 *
	 * @return array
	 */
	add_action( 'nav_menu_css_class', function ( $classes, $item, $args ) {
		if ( 'header_navigation' == $args->theme_location ) :
			if ( in_array( 'menu-item-has-children', $classes ) ) {
				$classes[] = 'dropdown';
			}

			if ( in_array( 'current-menu-item', $classes ) ) {
				$classes[] = 'active';
			}
		endif;

		return $classes;
	}, 10, 3 );


	/**
	 * Returns filtered nav menu link attribuutes.
	 *
	 * @param $atts
	 * @param $item
	 * @param $args
	 *
	 * @return mixed
	 */
	add_action( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
		if ( 'header_navigation' == $args->theme_location ) :
			if ( in_array( 'menu-item-has-children', $item->classes ) ) {
				if ( isset( $atts['class'] ) ) {
					$atts['class'][] = 'dropdown-toggle';
				} else {
					$atts['class'] = 'dropdown-toggle';
				}

				$atts['data-toggle'] = 'dropdown';
				$atts['role'] = 'button';
				$atts['aria-haspopup'] = 'true';
				$atts['aria-expanded'] = 'false';
			}
		endif;

		return $atts;
	}, 10, 3 );


	/**
	 * Modifies TinyMCE settings before passing them to a content editor for initialization.
	 *
	 * @param $settings
	 *
	 * @return mixed
	 */
	add_filter( 'tiny_mce_before_init', function ( $settings ) {
		$style_formats = [
			[
				'title'    => 'Heading 1',
				'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
				'classes'  => 'h1',
			],
			[
				'title'    => 'Heading 2',
				'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
				'classes'  => 'h2',
			],
			[
				'title'    => 'Heading 3',
				'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
				'classes'  => 'h3',
			],
			[
				'title'    => 'Heading 4',
				'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
				'classes'  => 'h4',
			],
			[
				'title'    => 'Heading 5',
				'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
				'classes'  => 'h5',
			],
			[
				'title'    => 'Heading 6',
				'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
				'classes'  => 'h6',
			],
			[
				'title'    => 'Lead',
				'selector' => 'p, span',
				'classes'  => 'lead',
			],
			[
				'title'   => 'Small',
				'inline'  => 'span',
				'classes' => 'small',
			],
			[
				'title'    => 'Primary Button',
				'selector' => 'a, button, input[type="button"], input[type="submit"]',
				'classes'  => 'btn btn-primary',
			],
			[
				'title'    => 'Primary Button Outline',
				'selector' => 'a, button, input[type="button"], input[type="submit"]',
				'classes'  => 'btn btn-outline-primary',
			],
		];

		$settings['style_formats'] = json_encode( $style_formats );

		return $settings;
	} );


	/**
	 * Registers scripts to work with new buttons added to content editor toolbar.
	 *
	 * @param $plugins
	 *
	 * @return mixed
	 */
	add_filter( 'mce_external_plugins', function ( $plugins ) {
		$plugins['table'] = Assets\asset_path( 'scripts/editor-tables.js' );

		return $plugins;
	} );


	/**
	 * Adds new buttons to the first row of toolbar in a content editor.
	 *
	 * @param $buttons
	 *
	 * @return mixed
	 */
	add_filter( 'mce_buttons', function ( $buttons ) {

		// Add custom buttons to toolbar
		array_splice( $buttons, 2, 0, 'table' );
		array_splice( $buttons, 3, 0, 'styleselect' );

		return $buttons;
	} );