<!-- Side -->
			<div id="side">

<?php
// sidemenu (This is not being used as of 2013/02/23)
// Page List that: Only displays if child (sub) pages exist, displays list of subpages on the parent page AND on the child pages HOWEVER this code keeps the parent page name in the title which makes it different.)
if($post->post_parent) {
$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
$titlenamer = get_the_title($post->post_parent);
}
else {
$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
$titlenamer = get_the_title($post->ID);
}
if ($children) { ?>
<h3> <?php echo $titlenamer; ?> </h3>
<ul>
<?php echo $children; ?>
</ul>
<?php } ?>


				<!-- show only on front page -->
				<?php if(is_front_page()){ ?>
					<section class="widget-container-side">
					<h2>News</h2>
					<div id="news">
					<?php if(function_exists('get_cat_items')) echo do_shortcode('[get_newpost cat="news" num="2"]'); ?>
					</div>
					</section>
				<?php } ?>
				
				<!-- show only on products page -->
				<?php if(get_post_type()=="products"){ ?>
					<nav>
					<ul id="tax-list">
					<?php
					// wp_list_categories('taxonomy=products-categories&show_count=0&hide_empty=0&title_li=');
					// Above Code's Bugfix for Forcing Highlighting Current Taxonomy Menu Item on Single Post
					$tax = "products-categories"; // taxonomy name
					$catinfos = get_the_terms($post->ID, $tax);
					if(is_single()) {
						foreach ( $catinfos as $catinfo ) :
							$mycat = $catinfo;
							break;
						endforeach;
						echo wp_list_categories('taxonomy='.$tax.'&title_li=&echo=0&current_category='.$mycat->term_id);
					}
					else {
						echo wp_list_categories('taxonomy='.$tax.'&title_li=&echo=0');
					}
					?>
					</ul>
					</nav>
				<?php } ?>
				
				<!-- show only on blog page -->
				<?php if(get_post_type()=="post"){ ?>
					<?php dynamic_sidebar( 'side-widget-blog' ); ?>
				<?php } ?>
				
				<!-- show on all page -->
				<aside class="widget-area">
					<?php dynamic_sidebar( 'side-widget' ); ?>
				</aside><!-- /.widget-area -->
				
			</div><!-- /#side -->