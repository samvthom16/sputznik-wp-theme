<?php get_header();?>
<?php global $post;?>
<div class="container bottom-buffer">
	<div class="row">
		<div class="col-md-12 bottom-buffer">
			<?php if(function_exists('sp_breadcrumb')) sp_breadcrumb(); ?>
			<?php if(have_posts()):while ( have_posts() ) : the_post();?> 
			<h1 class="post-title text-left"><strong><?php the_title_attribute(); ?></strong></h1>
			<?php the_content(); ?>
			<?php endwhile;endif;?>
		</div>
	</div>
</div>
</div>
<?php get_footer();?>