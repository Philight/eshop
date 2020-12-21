<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package 8Store Lite
 */

get_header(); ?>
<div class="store-wrapper">
	<?php
	$archive_page_layout = get_theme_mod('archive_page_layout','sidebar-right');
	if(is_home()){
		$archive= 'archive';
	}
	?>
	<main id="main" class="site-main <?php echo esc_attr($archive_page_layout).' '.esc_attr($archive); ?>" role="main">
		<?php if ($archive_page_layout == 'sidebar-both'): ?>
			<div id="primary-wrap" class="clearfix">
			<?php endif; ?>
		<div id="primary" class="content-area">
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>
		</div><!-- #primary -->

		<?php
			if ($archive_page_layout == 'sidebar-both' || $archive_page_layout == 'sidebar-left'):
				get_sidebar('left');
			endif;
			?>

			<?php if ($archive_page_layout == 'sidebar-both'): ?>
			</div>
		<?php endif; ?>

		<?php
		if ($archive_page_layout == 'sidebar-both' || $archive_page_layout == 'sidebar-right'):
			get_sidebar('right');
		endif;
		?>
	</main><!-- #main -->
	
</div>
<?php get_footer(); ?>
