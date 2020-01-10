<?php
use Levy\Template\Helpers;
?>
<div class="layout layout-contact" id="contact">
<div class="container">
	<div class="layout-header">
        <h2 class="section-title">Contact</h2>
     </div>
	<div class="row">
		<div class="col-md-6 offset-md-3 pd-mb">
			<div class="text">
			 <?php echo $content= get_field('contact_content');?>
			  </div>
	        <div class="d-flex flex-column m-detail">
			  <div class="bx d-flex justify-content-center">
				<span class="icon"></span>
				<p><a href="mailto:<?php the_field( 'email', 'options' ); ?>"><i class="far fa-envelope" aria-hidden="true"></i> <?php the_field( 'email', 'options' ); ?></a></p>
				  </div>
					<div class="bx d-flex justify-content-center">
						<span class="icon"></span>
						<p><a href="tel:<?php echo Helpers\get_tel_link( get_field( 'phone', 'options' ) ); ?>">
						<i class="fas fa-phone" aria-hidden="true"></i> <?php echo get_field( 'phone', 'options' ); ?></a></p>
				</div>
			 </div>
	     </div>
	</div>
</div>
</div>