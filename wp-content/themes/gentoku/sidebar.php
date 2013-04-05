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
					<?php if(function_exists('get_cat_items')) echo do_shortcode('[get_newpost cat="news" num="2"]'); ?>
					</section>
				<?php } ?>
				
				<!-- show only on products page -->
				<?php if(get_post_type()=="products"){ ?>
					<nav>
					<?php if(function_exists('get_tax_items')) echo do_shortcode('[taxonomy_list tax="products-categories"]'); ?>
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