<?php
// ウィジェットエリア

// サイドバーのウィジェット
register_sidebar( array(
	'name' => __( 'Side Widget' ),
	'id' => 'side-widget',
	'before_widget' => '<div class="widget-container-side">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
) );

// ボトムエリアのウィジェット
register_sidebar( array(
	'name' => __( 'Bottom Widget' ),
	'id' => 'bottom-widget',
	'before_widget' => '<div class="widget-container-bottom"><ul><li>',
	'after_widget' => '</li></ul></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
) );

// フッターエリアのウィジェット
register_sidebar( array(
	'name' => __( 'Footer Widget' ),
	'id' => 'footer-widget',
	'before_widget' => '<div class="widget-container-footer">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
) );

// アイキャッチ画像
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(640, 476, true ); // 幅 640px、高さ 476px、切り抜きモード

// カスタムナビゲーションメニュー
add_theme_support('menus');

register_nav_menus( array( 'primary' => __( 'Primary Navigation'), ) );
register_nav_menus( array( 'secondary' => __( 'Secondary Navigation'), ) );
register_nav_menus( array( 'tertiary' => __( 'Tertiary Navigation'), ) );

// WordPressのバージョン非表示
remove_action('wp_head', 'wp_generator');

// スクリプトの日付/時刻関数で使用されるデフォルトタイムゾーンを日本時間に修正
date_default_timezone_set( 'Asia/Tokyo' );

// ショートコードをウィジェットで使用可能にする
add_filter('widget_text', 'do_shortcode');

// トップページとブログページ別々のRSS URLを取得するショートコード (ex: [get_rssurl])
function get_items($atts, $content = null) {
$blog_name = get_bloginfo('name');
if( is_front_page() ){
$blog_url = get_bloginfo('url');
$blog_url.='/category/news/feed';
} elseif( get_post_type()=='post' ) {
$blog_url = get_bloginfo('rss2_url');
} else {
$blog_url = get_bloginfo('url');
$blog_url.='/category/news/feed';
}
return $blog_url;
}
add_shortcode("get_rssurl", "get_items");

// 特定カテゴリの新着記事を表示するショートコード (ex: [get_newpost cat="8" num="5"])
function get_cat_items($atts, $content = null) {
extract(shortcode_atts(array(
"num" => '5',
"cat" => ''
), $atts));
global $post;
$myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
$retour='<ul id="news">';
foreach($myposts as $post) :
setup_postdata($post);
$retour.='<li>';
$retour.='<div class="news-date">'.get_post_time('Y/m/d', true).'</div>';
$retour.='<div class="news-title">'.the_title("","",false).'</div>';
$retour.='<div class="news-post">'.mb_substr(get_the_excerpt(), 0, 60).'... <a href="'.get_permalink().'">続きを見る>></a></div>';
$retour.='</li>';
endforeach;
$retour.='</ul>';
wp_reset_query();
return $retour;
}
add_shortcode("get_newpost", "get_cat_items");

// タクソノミーの一覧を表示するショートコード (ex: [taxonomy-list tax="products"])
// Bugfix: Highlight Current taxonomy Menu Item for WordPress Single Post
function get_tax_items($atts, $content = null) {
extract(shortcode_atts(array(
"tax" => ''
), $atts));
$catinfos = get_the_terms($post->ID, $tax);
if(is_single() ) :
	foreach ( $catinfos as $catinfo ) :
		$mycat = $catinfo;
		break;
	endforeach;
	$retour='<ul id="tax-list">';
	$retour.=wp_list_categories('taxonomy='.$tax.'&title_li=&echo=0&current_category='.$mycat->term_id);
	$retour.='</ul>';
else:
	$retour='<ul id="tax-list">';
	$retour.=wp_list_categories('taxonomy='.$tax.'&title_li=&echo=0');
	$retour.='</ul>';
endif;
return $retour;
}
add_shortcode("taxonomy-list", "get_tax_items");

// Bugfix: Menus adds "current_page_parent" class to the blog page when viewing a custom post type entry
function mypace_custom_navi_menu( $classes, $item ) {
    global $wp_query;
 
    $singular_slug = 'products';
    $page_for_custom_type_title = 'Products';
    $page_for_posts = get_option( 'page_for_posts' );
    $post_type_query = $wp_query->query_vars['post_type'];
    $del_flag = true;
    $add_flag = false;
 
    if ( is_singular( 'post' ) || is_category() || is_tag() ) {
        $del_flag = false;
    } elseif ( ( is_author() || is_date() || is_author() ) ) {
        if ( in_array( $post_type_query, array ( '', 'post' ) ) ) {
            $del_flag = false;
        } elseif ( $post_type_query == $custom_post_type ) {
            $add_flag = true;
        }
    } elseif ( is_tax() ) {
        $taxonomy = get_taxonomy( $wp_query->query_vars['taxonomy'] );
        if ( count( $taxonomy->object_type ) == 1 && $taxonomy->object_type[0] == 'post' ) {
            $del_flag = false;
        } elseif ( count( $taxonomy->object_type ) == 1 && $taxonomy->object_type[0] == $singular_slug ) {
            $add_flag = true;
        }
    } elseif ( is_singular( $singular_slug ) ) {
        $add_flag = true;
    }
 
    if ( $del_flag && is_numeric( $page_for_posts ) && $item->object_id == $page_for_posts && $item->object == 'page' && $key = array_search( 'current_page_parent', $classes ) ) {
            unset( $classes[$key] );
    } elseif ( $add_flag && $item->title == $page_for_custom_type_title && $item->object == 'page' ) {
        $classes[] = 'current_page_parent';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'mypace_custom_navi_menu', 10, 2 );

// Breadcrumbs
function dimox_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_front_page() || is_paged() ) {
    echo '<div id="crumbs">';
    global $post;
    $homeLink = get_bloginfo('url');
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo '<a href="' . get_site_url() . '/blog/">Blog</a> ' . $delimiter . ' '; // Add on Blog page
      echo $before . single_cat_title('', false) . $after;
 
    } elseif ( is_home() ) {
      echo $before . 'Blog' . $after; // Add on Blog page
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_site_url() . '/blog/">Blog</a> ' . $delimiter . ' '; // Add on Blog page
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_site_url() . '/blog/">Blog</a> ' . $delimiter . ' '; // Add on Blog page
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo '<a href="' . get_site_url() . '/blog/">Blog</a> ' . $delimiter . ' '; // Add on Blog page
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        echo '<a href="' . get_site_url() . '/blog/">Blog</a> ' . $delimiter . ' '; // Add on Blog page
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</div>';
  }
} // end dimox_breadcrumbs()

?>