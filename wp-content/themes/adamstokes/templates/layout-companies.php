<?php
extract( $wp_query->query_vars );
?>
<div class="layout layout-companies" id="companies">
	<div class="container">
		<div class="layout-header">
				<h2 class="section-title"> <?php echo $field['label']; ?></h2>
		</div>
		<div class="row justify-content-center pd-mb">
			<?php while ( have_rows('companies') ) : the_row();?>
      <?php $image= get_sub_field('logo'); ?>
			  <?php echo $images = wp_get_attachment_image($image['id'],"thumbnail",false, array( "class" => "img-fluid" ) );?>
   <?php endwhile;?>
		</div>
	</div>
</div>