<?php use Levy\Template\Wrapper; ?>

<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part( 'templates/head' ); ?>
<body <?php body_class(); ?>>

	<div class="wrapper-page">
		<div class="wrapper-header">
			<?php get_header(); ?>
		</div>
		<div class="wrapper-content">
			<?php if ( Wrapper\display_sidebar() ) : ?>
				<div class="wrap container" role="document">
					<div class="content row">
						<main class="main">
							<?php include Wrapper\template_path(); ?>
						</main>
						<aside class="sidebar">
							<?php include Wrapper\sidebar_path(); ?>
						</aside>
					</div>
				</div>
			<?php else : ?>
				<main>
					<?php include Wrapper\template_path(); ?>
				</main>
			<?php endif; ?>
		</div>
		<div class="wrapper-footer">
			<?php get_footer(); ?>
		</div>
	</div>

	<?php
		wp_footer();
	?>
</body>
</html>
