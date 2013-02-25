<?php get_header(); ?>

<!-- Contents -->

		<div id="contents">
			<div id="main">
			
			<?php // 2012/8/19 -> 2013/2/23(cleanup the code)
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //現在のページ番号取得
			$term_var = get_query_var('term'); //現在のページのターム名を取得する ex. dj-booth
			$taxonomy_var = get_query_var( 'taxonomy' ); //タクソノミー名取得 ex. products-categories
			$myQuery = new WP_Query(
				array(
					'paged' => $paged, //常に現在のページ番号を渡す usually 1 is inserted
					'post_type' => 'products', //カスタム投稿タイプのみを指定。
					'posts_per_page' => '-1', //（整数）- 1ページに表示する記事数。-1 ならすべての投稿を取得。
					'post_status' => 'publish', //取得するステータスを指定：publish（公開済み）
					'taxonomy' => $taxonomy_var, //タクソノミー名
					'term' => $term_var //ターム名
				)
			);
			?>
			<?php if ($myQuery->have_posts()) : ?>
				<section>
				<ul id="frontpage-products" class="clearfix">
					<?php while ($myQuery->have_posts()) : $myQuery->the_post(); ?>
						<?php $num = 0; ?>
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
				</section>
			
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