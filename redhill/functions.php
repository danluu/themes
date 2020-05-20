<?php
/**
 * Child Theme Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @since 1.0.0
 */

	if ( ! function_exists( 'redhill_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function redhill_theme_setup() {

		// Add child theme editor styles, compiled from `style-child-theme-editor.scss`.
		add_editor_style( 'style-editor.css' );

		// Remove parent theme font sizes
		remove_theme_support( 'editor-font-sizes' );

		// Add child theme editor font sizes to match Sass-map variables in `_config-child-theme-deep.scss`.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'redhill' ),
					'shortName' => __( 'S', 'redhill' ),
					'size'      => 16.66,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'redhill' ),
					'shortName' => __( 'N', 'redhill' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Medium', 'redhill' ),
					'shortName' => __( 'M', 'redhill' ),
					'size'      => 24,
					'slug'      => 'medium',
				),
				array(
					'name'      => __( 'Large', 'redhill' ),
					'shortName' => __( 'L', 'redhill' ),
					'size'      => 28.8,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'redhill' ),
					'shortName' => __( 'XL', 'redhill' ),
					'size'      => 34.56,
					'slug'      => 'huge',
				),
			)
		);

		/*
		 * Get customizer colors and add them to the editor color palettes
		 *
		 * - if the customizer color is empty, use the default
		 */
		$colors_array = get_theme_mod('colors_manager'); // color annotations array()
		$background   = $colors_array['colors']['bg'];   // $config-global--color-background-default;
		$primary      = $colors_array['colors']['link']; // $config-global--color-primary-default;
		$foreground   = $colors_array['colors']['txt'];  // $config-global--color-foreground-default;
		$secondary    = $colors_array['colors']['fg1'];  // $config-global--color-secondary-default;

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'redhill' ),
					'slug'  => 'primary',
					'color' => ! isset($primary) ? '#CA2017' : $primary,
				),
				array(
					'name'  => __( 'Secondary', 'redhill' ),
					'slug'  => 'secondary',
					'color' => ! isset($secondary) ? '#007FDB' : $secondary,
				),
				array(
					'name'  => __( 'Foreground', 'redhill' ),
					'slug'  => 'foreground',
					'color' => ! isset($foreground) ? '#444444' : $foreground,
				),
				array(
					'name'  => __( 'Background', 'redhill' ),
					'slug'  => 'background',
					'color' => ! isset($background) ? '#FFFFFF' : $background,
				),
			)
		);

		// Add child theme support for core custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 100,
				'flex-width'  => true,
				'flex-height' => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'redhill_theme_setup', 12 );

/**
 * Set the content width in pixels, based on the child-theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function redhill_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'redhill_theme_content_width', 740 );
}
add_action( 'after_setup_theme', 'redhill_theme_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function redhill_theme_scripts() {

	// dequeue parent styles
	wp_dequeue_style( 'varia-style' );

	// enqueue child styles
	wp_enqueue_style( 'redhill-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ));

	// enqueue child RTL styles
	wp_style_add_data( 'redhill-style', 'rtl', 'replace' );

}
add_action( 'wp_enqueue_scripts', 'redhill_theme_scripts', 99 );
