<?php use Levy\Template\Wrapper; ?>
<?php use Levy\Template\Helpers; ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '<div class="container">';
endif; ?>

<h1><?php echo Helpers\title(); ?></h1>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'templates/content', 'search' ); ?>
	<?php endwhile; ?>
<?php else : ?>
	<div class="alert alert-warning">
		<?php _e( 'Sorry, no results were found.', 'adamstokes' ); ?>
	</div>
	<?php get_search_form(); ?>
<?php endif; ?>

<?php the_posts_navigation(); ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '</div>';
endif;