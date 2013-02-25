<?php get_header(); ?>

<!-- Contents -->
		<div id="contents">
			<div id="main">
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<div class="post">
						<?php if(has_post_thumbnail()) { ?>
							<div style="padding-bottom:15px;">
								<?php echo the_post_thumbnail(); ?>
							</div>
						<?php } ?>
						<h2 class="title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div><!-- /.post -->
					
				<?php endwhile; ?>
				
				
				<?php else : ?>
				
				<h2 class="title">記事が見つかりませんでした。</h2>
				<p>検索で見つかるかもしれません。</p><br />
				<?php get_search_form(); ?>
			
			<?php endif; ?>
			
				
			</div><!-- /#main -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>