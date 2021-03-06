<?php get_header(); ?>

<!-- Contents -->
		
		<?php
		/* Generate Thumbnail on Top Page */
			/* Check if this is a post or page, if it has a thumbnail, and if it is a big one　*/
			if( is_singular() && !is_single() && has_post_thumbnail( $post->ID ) &&
				( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ) ) &&
				$image[1] >= HEADER_IMAGE_WIDTH ){
				echo "<figure id='hbg_img'>";
				echo get_the_post_thumbnail($post->ID, 'full');
				echo "</figure>";
			}
			else {
				// echo "<img class='hbg_img' src='" . header_image() . "' width='" . HEADER_IMAGE_WIDTH . "' height='" . HEADER_IMAGE_HEIGHT . "' alt='' />";
			}
		?>

		<div id="contents">
			<div id="main">
			
			<?php if (have_posts()) : ?>
			
				<!-- Products image list -->
				<?php
				$my_query = new WP_Query(
					array(
						'post_type' => 'products',
						'posts_per_page' => '16',
						'tax_query' => array(
							array(
								'taxonomy'=> 'products-categories',
								'field' => 'slug',
								'terms' => 'others',
								'operator' => 'NOT IN'
							)
						)
					)
				);
				?>
				<?php if ($my_query->have_posts()) : ?>
					<section>
					<h2 class="title">Works</h2>
					<ul id="frontpage-products" class="clearfix">
                        <?php $num = 0; ?>
                        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                        <?php $num += 1; ?>
                        <?php if ($num % 2) {
                            echo '<li class="odd">';
                        } else {
                            echo '<li class="even">';
                        } ?>
                            <a href="<?php the_permalink(); ?>">
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
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				<!--  Products image list 終了  -->
				
				<!-- ページの記事表示　-->
				<?php while (have_posts()) : the_post(); ?>
					<section class="post">
					<article>
						<h2 class="title">About</h2>
						<div class="clearfix">
							<?php the_content(); ?>
						</div>
					</article>
					</section><!-- /.post -->
				<?php endwhile; ?>
				<!-- ページの記事表示 終了　-->
					
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