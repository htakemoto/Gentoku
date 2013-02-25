<?php get_header(); ?>

<!-- Contents -->

		<div id="contents">
			<div id="main">
			
<?php // よくわからないけどこれにてカテゴリー別の記事数の指定が可能になった。 2012/8/19
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //現在のページ番号取得
    $taxonomy_name = 'products-categories';
    $taxonomys = get_terms($taxonomy_name);
    $tax_posts = get_posts(array('post_type' => get_post_type(), 'taxonomy' => $taxonomy_name, 'term' => $taxonomy->slug ) );
    $term_var = get_query_var( 'term' );//現在のページのタームを取得する
    $myQuery = new WP_Query(); // WP_Queryオブジェクト生成
    $param = array( //パラメータ。
        'paged' => $paged, //常に現在のページ番号を渡す
        'posts_per_page' => '-1', //（整数）- 1ページに表示する記事数。-1 ならすべての投稿を取得。
        'post_type' => 'products', //カスタム投稿タイプのみを指定。
        'post_status' => 'publish', //取得するステータスを指定：publish（公開済み）
        'taxonomy' => $taxonomy_name,//タクソノミー
        'term' => $term_var//ターム
    );
    $myQuery->query($param);  // クエリにパラメータを渡す
?>
			<?php if ($myQuery->have_posts()) : ?>
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
			<?php else : ?>
				<h2 class="title">記事が見つかりませんでした。</h2>
				<p>検索で見つかるかもしれません。</p><br />
				<?php get_search_form(); ?>
			<?php endif; ?>
			
			</div><!-- /#main -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>