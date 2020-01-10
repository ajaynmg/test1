<?php
 use Levy\Template\Helpers;
 while( have_rows('social_media','option') ): the_row();
   $facebook= get_sub_field('facebook','options');
   $linkedin= get_sub_field('linkedin','options');  
   $twitter= get_sub_field('twitter','options');					
     endwhile; ?>
<div class="layout layout-about" id="about">
	<div class="container">
		<div class="layout-header">
           <h2 class="section-title">About</h2>
       </div>
		<div class="row align-items-center">
					<?php $image = get_field('about_photo');?>
					<div class="col-sm-6 pd-mb left d-flex justify-content-center justify-content-sm-end">
						<?php echo $images = wp_get_attachment_image($image['id'],"thumbnail",false, array( "class" => "img-fluid" ) );?>
					</div>
					<div class="col-sm-6 pd-mb right ">
						<?php echo $content= get_field('about_content');?>
							<ul class="social-media list-unstyled abt-information">
								<li>
						<a href="mailto:<?php the_field( 'email', 'options' ); ?>">
							<i class="far fa-envelope" aria-hidden="true"></i><?php the_field( 'email', 'options' ); ?>
						</a></li>
						      <li><a href="tel:<?php echo Helpers\get_tel_link( get_field( 'phone', 'options' ) ); ?>">
							<i class="fas fa-phone" aria-hidden="true"></i><?php the_field( 'phone', 'options' ); ?>
								</a> 
							</li>
						  <?php if ($facebook) { ?>
                     <li><a rel="noopener noreferrer" href="<?php echo $facebook; ?>" class="author-profile__social-anchor facebook" target="_blank"><i class="fab fa-facebook-square" aria-hidden="true"></i>Facebook</a>
                            </li><?php } ?>
                            <?php if($linkedin) { ?>
                      <li><a rel="noopener noreferrer" href="<?php echo $linkedin; ?>" class="author-profile__social-anchor facebook" target="_blank"><i class="fab fa-linkedin-square" aria-hidden="true"></i>Linkedin</a>
                            </li><?php } ?>
                            <?php if ($twitter) { ?>
                      <li><a rel="noopener noreferrer" href="<?php echo $twitter; ?>" class="author-profile__social-anchor facebook" target="_blank"><i class="fab fa-twitter-square" aria-hidden="true"></i>Twitter</a>
                            </li><?php } ?>
					</ul>
							<div class="about-logos d-flex flex-wrap justify-content-center justify-content-sm-start">
								<?php while( have_rows('contact_logos') ): the_row();
								   $image = get_sub_field('image'); ?>
									<?php echo $images = wp_get_attachment_image($image['id'],"thumbnail",false, array( "class" => "img-fluid" ) );?>
								<?php endwhile; ?>
							</div>
					</div>
		</div>
	</div>
</div>