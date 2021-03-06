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
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_url'); ?>/scripts/html5shiv.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="wrapper">

		<header id="globalheader">
			<hgroup>
				<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
				<p><?php bloginfo('description'); ?></p>
			</hgroup>

			<div class="clearfix">
				<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'primary-menu', 'menu_id' => 'primary-navi', 'theme_location' => 'primary', 'depth' => '1')); ?>
				<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'secondary-menu', 'menu_id' => 'secondary-navi', 'theme_location' => 'secondary', 'depth' => '1')); ?>
			</div>
		</header><!-- /#globalheader -->
		
		<div class="breadcrumbs">
			<?php if(function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		</div>
		