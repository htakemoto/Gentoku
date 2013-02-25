		</div><!-- /#contents -->
		
<!-- Bottom -->
		
		<!-- show only on front page -->
		<?php if(is_front_page()){ ?>
			<section id="frontpagebottom">
				<div class="clearfix">
					<?php dynamic_sidebar( 'bottom-widget' ); ?>
 				</div>
			</section><!-- /#frontpagebottom -->
		<?php } ?>

<!-- Footer -->
		
		<footer id="globalfooter">

			<div class="clearfix">
				<?php wp_nav_menu( array('container' => 'nav', 'container_id' => 'tertiary-menu', 'menu_id' => 'tertiary-navi', 'theme_location' => 'tertiary', 'depth' => '1' )); ?>
			</div>

			<?php dynamic_sidebar( 'footer-widget' ); ?>
			
			<p class="copyright">
				&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
			</p>

		</footer><!-- /#globalfooter -->
		
	</div><!-- /#wrapper -->

<?php wp_footer(); ?>
</body>
</html>