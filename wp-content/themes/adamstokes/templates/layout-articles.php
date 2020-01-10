<?php
extract( $wp_query->query_vars );
?>
<div class="layout layout-articles" id="articles">
	<div class="container">
		<div class="layout-header">
           <h2 class="section-title"><?php echo $field['label']; ?></h2>
       </div>
       <?php if ( get_field('enable_featured_article') == true ): ?>
	    <?php while( have_rows('featured_article') ): the_row();?>
      <?php $image = get_sub_field('image');
       $content = get_sub_field('content');
       $link = get_sub_field('link');
        $button_url = $link['url'];
	        $button_title = $link['title'];
	        $button_target= $link['target'] ? $link['target'] : '_self';?>
	<div class="row">
		<div class="col-12 col-md-9  offset-md-2 d-flex flex-wrap first-section align-items-center pd-mb ">
				<div class="left-section image col-sm-5 col-12 p-0">
				<?php echo $images = wp_get_attachment_image($image['id'],"thumbnail",false, array( "class" => "img-fluid" ) );?>
				</div>
				<div class="col-sm-7 col-12 right-section p-0 p-sm-4 p-md-5">
				<?php echo $content;?>
				<?php if($link ):?>
					<div class="link-button d-flex justify-content-center justify-content-sm-start">
					<?php if ($button_url && $button_title): ?>
					<a href="<?php echo esc_url($button_url);?>" class="btn-primary btn-1" target="<?php echo esc_attr($button_target); ?>">  <?php echo $button_title; ?></a>
					<?php endif;?>
					</div>
				</div>
				<?php endif;?>
		</div>
	</div>				 
   <?php endwhile;?>
   <?php endif;?>
   <div class="row d-block">
   	<div class="main-slider">
    <?php while( have_rows('articles') ): the_row();?>
      <?php $article_image = get_sub_field('image');
      $article_content = get_sub_field('content'); 
        $link = get_sub_field('link');
        $button_url = @$link['url'];
	        $button_title = @$link['title'];
	        $button_target= @$link['target'] ? @$link['target'] : '_self';?>
		<div class="slider-bx">		
			<div class="media-bx">
				<div class="card">
					<div class="card-img-top">
						<?php echo $images = wp_get_attachment_image($article_image['id'],"thumbnail",false, array( "class" => "img-fluid" ) );?>
					</div>
					 <div class="card-body">
						<?php echo $article_content;?>
					<?php if($link ):?>
					<div class="link-button">
					<?php if($button_url && $button_title): ?>
					<a href="<?php echo esc_url($button_url);?>" class="btn1" target="<?php echo esc_attr($button_target); ?>">  <?php echo $button_title; ?></a>
					<?php endif;?>
					</div>
					<?php endif;?>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile;?>
	  </div>
	</div>
</div>
</div>