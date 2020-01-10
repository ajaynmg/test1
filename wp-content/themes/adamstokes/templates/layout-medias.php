<?php
extract( $wp_query->query_vars );?>
<div class="layout layout-medias" id="media">
    <div class="container">
        <div class="layout-header">
           <h2 class="section-title"><?php echo $field['label']; ?></h2>
       </div>
			<div class="row d-block">
				<div class="main-slider">
			  <?php while ( have_rows('medias') ) : the_row();
				$image = get_sub_field('image');
				$link_url = $image['url'];
				$link = get_sub_field('link');
				$iframe_val = "";
				if( $link ){
					$link_url = $link['url'];
					if ((strpos($link_url, 'youtube') == false) && (strpos($link_url, 'vimeo') == false) ) {
						$iframe_val = "iframe";
					}
				}
				?>
				<div class="slider-bx ">
				  <div class="media-bx">
				  	<div class="card">
						<a href="javascript:;" data-fancybox="gallery" data-type="<?php echo $iframe_val;?>" data-src="<?php echo $link_url;?>" >
							<div class="card-img-top">
								<?php echo $images = wp_get_attachment_image($image['id'],"thumbnail",false, array( "class" => "img-fluid" ) );?>
							</div>
							<div class="card-body">
							  <p class="card-text"><?php echo get_sub_field('title');?></p>     
							</div>
					    </a>
					  </div>
				  </div>	
				 </div> 
			   <?php endwhile;?>
			  </div>
		</div>
	</div>
</div>