<!-- Side -->				
            <div id="side">
<!-- sidemenu -->
<!-- Page List that: Only displays if child (sub) pages exist, displays page list of subpages on the parent page AND on the child pages HOWEVER this code keeps the parent page name in the title which makes it different.) -->
<?php
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
<!-- /sidemenu -->
                <div class="widget-area">
                    <?php dynamic_sidebar( 'side-widget' ); ?>
                </div><!-- /.widget-area -->
                
            </div><!-- /#side -->