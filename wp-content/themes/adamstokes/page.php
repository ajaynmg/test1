<?php use Levy\Template\Wrapper; ?>
<?php use Levy\Template\Helpers; ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '<div class="container">';
endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
	<h1><?php echo Helpers\title(); ?></h1>
	<?php get_template_part( 'templates/content', 'page' );
endwhile; ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '</div>';
endif;