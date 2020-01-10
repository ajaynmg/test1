<?php use Levy\Template\Wrapper; ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '<div class="container">';
endif; ?>

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		get_template_part( 'templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format() );
	endwhile;
	the_posts_navigation(); ?>
<?php else : ?>
	<div class="alert alert-warning">
		<?php _e( 'Sorry, no results were found.', 'adamstokes' ); ?>
	</div>
	<?php get_search_form();
endif; ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '</div>';
endif;