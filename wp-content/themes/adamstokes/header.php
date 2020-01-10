<header class="banner">
	<nav class="navbar navbar-expand-lg navbar-light pd-mb">
		<div class="container">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="logo-heading"><?php echo get_bloginfo( 'name' ); ?></span>
			</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-navigation" aria-controls="primary-navigation" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php if ( has_nav_menu( 'header_navigation' ) ) :
				echo str_replace( 'sub-menu', 'dropdown-menu', wp_nav_menu( [
					'theme_location'  => 'header_navigation',
					'menu_class'      => 'navbar-nav ml-lg-auto',
					'echo'            => false,
					'container_class' => 'collapse navbar-collapse',
					'container_id'    => 'primary-navigation',
				] ) );
			endif; ?>
		</div>
	</nav>
</header>