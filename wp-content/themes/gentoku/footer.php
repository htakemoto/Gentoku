        </div><!-- /#contents -->
        
<!-- Bottom -->

        <div id="bottom">
        
            <div class="clearfix">
                <?php dynamic_sidebar( 'bottom-widget' ); ?>
            </div>
        
        </div><!-- /#bottom -->

<!-- Footer -->
        
        <div id="footer">

            <div class="clearfix">
                <div id="tertiary-menu">
                    <?php wp_nav_menu( array('menu_id' => 'tertiary-navi', 'theme_location' => 'tertiary', 'depth' => '1' )); ?>
                </div>
            </div>

            <?php dynamic_sidebar( 'footer-widget' ); ?>
            
            <p class="copy">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </p>

        </div><!-- /#footer -->
    </div><!-- /#wrapper -->

<?php wp_footer(); ?>
</body>
</html>