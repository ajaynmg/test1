<?php
use Levy\Template\Helpers;
?>
<div class="layout layout-hero">
	<div class="container">
		<div class="row">
		   <div class=" col-sm-6 col-12 d-flex justify-content-center justify-content-sm-end order-2 order-sm-1 pt-4 pt-sm-0 pd-mb ">
				<div class="image d-flex align-items-end ">
				<?php
				$image= get_field('hero_background_image');
				echo $images = wp_get_attachment_image($image['id'],"thumbnail",false, array( "class" => "img-fluid" ) );?>
				</div>
			</div>
			  <div class="col-sm-6 pb-sm-4 order-1 order-sm-2 pd-mb">
				<?php echo $content= get_field('hero_content');?>
				<div class="d-flex flex-column m-detail">
					<div class="bx d-flex">
						<span class="icon"></span>
						<p><a href="mailto:<?php the_field( 'email', 'options' ); ?>"><i class="far fa-envelope" aria-hidden="true"></i>  <?php the_field( 'email', 'options' ); ?></a></p>
					</div>
					<div class="bx d-flex">
						<span class="icon"></span>
						<p><a href="tel:<?php echo Helpers\get_tel_link( get_field( 'phone', 'options' ) ); ?>">
							<i class="fas fa-phone" aria-hidden="true"></i>  <?php echo get_field( 'phone', 'options' ); ?></a></p>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>