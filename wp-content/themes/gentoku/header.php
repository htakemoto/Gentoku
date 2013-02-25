<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php bloginfo('name'); ?><?php if(is_single()) echo " &raquo; "; ?><?php wp_title(); ?></title>
<meta name="description" content="愛知県オーダーメード家具製作">
<meta name="keywords" content="木工房 玄徳,GEN-TOKU,オーダー家具,愛知,瀬戸,木工房,木製,手作り,ファニチャー,インテリア,椅子,イス，テーブル,デスク,小物,ペット用品,ベルト,古民家,改装">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php echo do_shortcode('[get_rssurl]'); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="wrapper">

        <!-- Header -->
        <div id="header">
            <h1><a href="<?php bloginfo('url'); ?>" id="site_title"><?php bloginfo('name'); ?></a></h1>
            <p id="site_description"><?php bloginfo('description'); ?></p>
            
            <div class="clearfix">
            	<div id="primary-menu">
            		<?php wp_nav_menu( array('menu_id' => 'primary-navi', 'theme_location' => 'primary', 'depth' => '1' )); ?>
            	</div>
            	<div id="secondary-menu">
            		<?php wp_nav_menu( array('menu_id' => 'secondary-navi', 'theme_location' => 'secondary', 'depth' => '1' )); ?>
            	</div>
            </div>
        </div>
        <!-- /#header -->
        
        <!--  ■ ここから  -->
        <div class="breadcrumbs">
        <?php if (function_exists('dimox_breadcrumbs') ) dimox_breadcrumbs(); ?>
        </div>
        <!--  ■ ここまで追加  -->
        
        <!-- Check if this is a post or page, if it has a thumbnail, and if it's a big one　-->
        <?php
        if ( is_singular() && !is_single() &&
        has_post_thumbnail( $post->ID ) &&
        ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ) ) &&
        $image[1] >= HEADER_IMAGE_WIDTH ) :
        // Houston, we have a new header image!
        ?>
        <div id="hbg_img">
            <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
        </div>
        <?php else : ?>
            <!-- <img class="hbg_img" src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />　-->
        <?php endif; ?>
        <!-- Check if this is a post or page, if it has a thumbnail, and if it's a big one　-->