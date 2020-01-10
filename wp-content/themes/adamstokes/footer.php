<?php
use Levy\Template\Helpers;

 while( have_rows('social_media','option') ): the_row();
   $facebook= get_sub_field('facebook','options');
   $linkedin= get_sub_field('linkedin','options');  
   $twitter= get_sub_field('twitter','options');					
 endwhile; ?>

<footer class="content-info">
	<div class="container">
		<div class="row">
			<div class="footer-navs col-12">
					<?php if ( has_nav_menu( 'footer_navigation' ) ) :
						echo str_replace( 'sub-menu', 'dropdown-menu', wp_nav_menu( [
							'theme_location'  => 'footer_navigation',
							'menu_class'      => 'navbar-nav ml-lg-auto',
							'echo'            => false,
							'container_class' => 'navbar-collapse',
							'container_id'    => 'footer-navigation',
						] ) );
					endif; ?>
			</div>
			<div class="col-12 footer-social d-flex flex-wrap flex-column ">
					<ul class="social-media list-unstyled d-flex flex-wrap justify-content-center ">
						<li><a href="mailto:<?php the_field( 'email', 'options' ); ?>"><i class="far fa-envelope" aria-hidden="true"></i></a></li>
						<li><a href="tel:<?php echo Helpers\get_tel_link( get_field( 'phone', 'options' ) ); ?>"><i class="fas fa-phone" aria-hidden="true"></i></a> </li>
						<?php if ($facebook) { ?>
							<li><a rel="noopener noreferrer" href="<?php echo $facebook; ?>" class="author-profile__social-anchor facebook" target="_blank"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
						<?php } ?>
						<?php if($linkedin) { ?>
							<li><a rel="noopener noreferrer" href="<?php echo $linkedin; ?>" class="author-profile__social-anchor facebook" target="_blank"><i class="fab fa-linkedin-square" aria-hidden="true"></i></a></li>
						<?php } ?>
						<?php if ($twitter) { ?>
							<li><a rel="noopener noreferrer" href="<?php echo $twitter; ?>" class="author-profile__social-anchor facebook" target="_blank"><i class="fab fa-twitter-square" aria-hidden="true"></i></a></li>  
                        <?php } ?>
					</ul>
				<p class="address">
					&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>
				</p>
				<p class="address copyright">Web design and development by <a href="https://www.levyonline.com/" target="_blank">Levy Online</a></p>
			</div>
		</div>
	</div>
</footer>
<?php
/*'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'primary-navigation',
*/