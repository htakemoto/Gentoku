<?php get_header(); ?>

<!-- Contents -->
		<div id="contents">
			<div id="main">
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<section class="post">
						<?php if(has_post_thumbnail()) { ?>
							<figure style="padding-bottom:15px;">
								<?php echo the_post_thumbnail(); ?>
							</figure>
						<?php } ?>
					<article>
						<h2 class="title"><?php the_title(); ?></h2>
						<div class="clearfix">
							<?php the_content(); ?>
						</div>
					</article>
					</section><!-- /.post -->
					
				<?php endwhile; ?>
				
				
				<?php else : ?>
				
				<section>
					<h2 class="title">記事が見つかりませんでした。</h2>
					<p>検索で見つかるかもしれません。</p><br />
					<?php get_search_form(); ?>
				</section>
			
			<?php endif; ?>
			
				
			</div><!-- /#main -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>