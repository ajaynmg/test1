<?php use Levy\Template\Wrapper; ?>
<?php use Levy\Template\Helpers; ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '<div class="container">';
endif; ?>
	<h1><?php echo Helpers\title(); ?></h1>
	<p>
		<?php _e( 'Sorry, but the page you were trying to view does not exist.', 'adamstokes' ); ?>
	</p>
<?php get_search_form(); ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '</div>';
endif;