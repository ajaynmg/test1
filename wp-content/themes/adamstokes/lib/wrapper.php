<?php

	/**
	 * Theme wrapper
	 *
	 * @link https://roots.io/sage/docs/theme-wrapper/
	 * @link http://scribu.net/wordpress/theme-wrappers.html
	 */

	namespace Levy\Template\Wrapper;

	/**
	 * @return mixed
	 */
	function template_path() {
		return SageWrapping::$main_template;
	}

	/**
	 * @return SageWrapping
	 */
	function sidebar_path() {
		return new SageWrapping( 'sidebar.php' );
	}

	/**
	 * Filters pages and posts, determining which should NOT display a sidebar
	 *
	 * @return mixed|void
	 */
	function display_sidebar() {
		static $display;

		isset( $display ) || $display = ! in_array( true, [
			// The sidebar will NOT be displayed if ANY of the following return true.
			// @link https://codex.wordpress.org/Conditional_Tags
			is_page(),
			is_archive(),
			is_search(),
		] );

		return apply_filters( 'sage/display_sidebar', $display );
	}

	/**
	 * Class SageWrapping
	 *
	 * @package Levy\Template\Wrapper
	 */
	class SageWrapping {
		// Stores the full path to the main template file
		public static $main_template;

		// Basename of template file
		public $slug;

		// Array of templates
		public $templates;

		// Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
		public static $base;

		public function __construct( $template = 'base.php' ) {
			$this->slug = basename( $template, '.php' );
			$this->templates = [ $template ];

			if ( self::$base ) {
				$str = substr( $template, 0, -4 );
				array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
			}
		}

		public function __toString() {
			$this->templates = apply_filters( 'sage/wrap_' . $this->slug, $this->templates );

			return locate_template( $this->templates );
		}

		public static function wrap( $main ) {
			// Check for other filters returning null
			if ( ! is_string( $main ) ) {
				return $main;
			}

			self::$main_template = $main;
			self::$base = basename( self::$main_template, '.php' );

			if ( self::$base === 'index' ) {
				self::$base = false;
			}

			return new SageWrapping();
		}
	}

	add_filter( 'template_include', [ __NAMESPACE__ . '\\SageWrapping', 'wrap' ], 109 );
