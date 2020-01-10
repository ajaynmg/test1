<?php use Levy\Template\Wrapper; ?>

<section class="hero-banner">
<?php get_template_part('templates/layout','hero');?>
</section>
<?php if ( ! Wrapper\display_sidebar() ) :
	// echo '<div class="container">';
endif; ?>
<?php while ( have_posts() ) : the_post();?>
	<?php $fields = get_field_objects(); 
           foreach( $fields as $name => $field ):
            if (($field['type']== 'repeater') &&($name!='contact_logos')) : 
             set_query_var( 'field', $field); ?>
				<section class="<?php echo str_replace( '_', '-', $name )?>-section">
					<?php get_template_part('templates/layout', str_replace( '_', '-', $name ) );?>
				</section>
	<?php endif;?>
<?php endforeach; ?>
<section class="about-section">
 <?php get_template_part('templates/layout','about');?>
  </section>
  <section class="contact-section">
  <?php get_template_part('templates/layout','contact');?>
  </section>
<?php endwhile; ?>
<?php if ( ! Wrapper\display_sidebar() ) :
	// echo '</div>';
endif;