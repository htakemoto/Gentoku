<?php get_header(); ?>

<!-- Contents -->

		<div id="contents">
			<div id="main">
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<section class="post">
					<article>
						<div class="cal"><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d') ?></time></div>
						<h2 class="title">
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
						
						<?php if(has_post_thumbnail()) { echo the_post_thumbnail(); } ?>
						
						<div class="clearfix">
							<?php the_content('続きを読む'); ?>
						</div>
						
						<div class="blog_info">
							<ul>
								<li class="cat"><?php the_category(', ') ?></li>
								<li class="tag"><?php the_tags('', ', '); ?></li>
								<li class="cat"><?php echo get_the_term_list( $post->ID, 'products-categories', 'タクソノミー: ', ', ', ''); ?></li>
							</ul>
							<br class="clear" />
						</div>
					</article>
					</section><!-- /.post -->
				<?php endwhile; ?>
				
					<div class="nav-below">
						<span class="nav-previous"><?php next_posts_link('古い記事へ') ?></span>
						<span class="nav-next"><?php previous_posts_link('新しい記事へ') ?></span>
					</div><!-- /.nav-below -->
			 
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