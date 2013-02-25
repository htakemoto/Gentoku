<?php get_header(); ?>

<!-- Contents -->
		<div id="contents">
			<div id="main">
			
			<?php if (have_posts()) : ?>
			
				<!-- ページの記事表示　-->
				<?php if (the_content()) : ?>
				<?php while (have_posts()) : the_post(); ?>
                    <div class="post">
						<h2 class="title"><?php the_title(); ?></h2>
						<?php if(has_post_thumbnail()) { echo the_post_thumbnail(); } ?>
						<?php the_content(); ?>
					</div><!-- /.post -->
				<?php endwhile; ?>
				<?php endif; ?>
				<!-- ページの記事表示 終了　-->
				
				<!-- Products image list -->
				<?php $my_query = new WP_Query('post_type=products&posts_per_page=-1'); ?>
				<?php if ($my_query->have_posts()) : ?>
					<ul id="frontpage-products" class="clearfix">
                        <?php $num = 0; ?>
                        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            <?php $num += 1; ?>
                            <?php if ($num % 2) {
                                echo '<li class="odd">';
                            } else {
                                echo '<li class="even">';
                            } ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <div>
                                    <?php if(has_post_thumbnail()){ ?>
                                        <?php echo wp_get_attachment_image(get_post_thumbnail_id(),'medium'); ?>
                                    <?php } else { ?>
                                        <img src="<?php bloginfo('template_url') ?>/images/blank-280x210.png" alt="no_image" />
                                    <?php } ?>
                                        <?php the_title(); ?>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
					</ul>
				<?php endif; ?>
				<!--  Products image list 終了  -->
				
			<?php else : ?>
				
				<h2 class="title">記事が見つかりませんでした。</h2>
				<p>検索で見つかるかもしれません。</p><br />
				<?php get_search_form(); ?>
				
			<?php endif; ?>
			
		</div><!-- /#main -->
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>