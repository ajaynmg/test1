<?php use Levy\Template\Wrapper; ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '<div class="container">';
endif; ?>

<?php get_template_part( 'templates/content-single', get_post_type() ); ?>

<?php if ( ! Wrapper\display_sidebar() ) :
	echo '</div>';
endif;