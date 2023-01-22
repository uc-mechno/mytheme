<?php

/**
 * ************************************************************************
 *
 * 削除、除去の設定
 *
 * ************************************************************************
 */

/**
 * wp_head()で出力されるタグの内、不要なものを削除
 * ************************************************************************
 * @link https://digitalnavi.net/wordpress/6921/
 * @link https://wpqw.jp/wordpress/themes/head-clean/
 * @link https://labo.kon-ruri.co.jp/remove-tags-in-wp_head/
 * @link https://helog.jp/wordpress/wp_head/
 */
remove_action('wp_head', 'feed_links', 2); // フィード
remove_action('wp_head', 'feed_links_extra', 3); // コメントのフィード
// remove_action('wp_head', 'wp_print_styles', 8); // デフォルトCSS
remove_action('wp_head', 'rsd_link'); // XML-RPCでの投稿
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writerでの投稿
remove_action('wp_head', 'wp_generator'); // WordPressコアのバージョン情報
remove_action('wp_head', 'print_emoji_detection_script', 7); // 絵文字のスクリプト
remove_action('admin_print_scripts', 'print_emoji_detection_script'); // 絵文字のスクリプト
remove_action('wp_print_styles', 'print_emoji_styles'); // 絵文字のスタイル
remove_action('admin_print_styles', 'print_emoji_styles'); // 絵文字のスタイル
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // 短縮URL
remove_action('wp_head', 'rest_output_link_wp_head'); // REST APIのURL表示
remove_action('wp_head', 'wp_oembed_add_discovery_links'); // 外部コンテンツの埋め込み
remove_action('wp_head', 'wp_oembed_add_host_js'); //ブログカード
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // 過去の投稿へと次の投稿へ
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles'); // wp5.9で追加されたsvg
remove_action('wp_footer', 'wp_enqueue_global_styles');          // wp5.9で追加されたsvg

/**
 * ウィジェット「最近のコメント」の削除
 * ************************************************************************
 * @link https://labo.kon-ruri.co.jp/remove-tags-in-wp_head/
 */
function remove_recent_comment_css() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action( 'widgets_init', 'remove_recent_comment_css');

/**
 * dns-prefetch を削除
 * ************************************************************************
 * @link https://affi-sapo.com/3551/#gsc.tab=0
 */
function remove_dns_prefetch($hints, $relation_type)
{
  if ('dns-prefetch' === $relation_type) {
    return array_diff(wp_dependencies_unique_hosts(), $hints);
  }
  return $hints;
}
add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);


/**
 * wp-block-library-css の削除
 * ************************************************************************
 * @link https://hacknote.jp/archives/48382/
 */
/*
function my_dequeue_plugins_style()
{
  wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'my_dequeue_plugins_style', 9999);
*/

/**
 * body_classで出力される余計なclassを削除
 * ************************************************************************
 *
 * @link https://techmemo.biz/wordpress/body_class_addclass/
 *
 */

function remove_body_class($wp_classes)
{

  foreach ($wp_classes as $key => $value) {

    $post_type = get_post_type();

    // switch文
    switch ($value) {
      case 'home':
        unset($wp_classes[$key]);
        break;
      case 'page':
        unset($wp_classes[$key]);
        break;
      case 'category':
        unset($wp_classes[$key]);
        break;
      case 'tag':
        unset($wp_classes[$key]);
        break;
      case 'category-1':
        unset($wp_classes[$key]);
        break;
      case 'logged-in':
        unset($wp_classes[$key]);
        break;
      case 'p-embed-responsive':
        unset($wp_classes[$key]);
        break;
      case 'admin-bar':
        unset($wp_classes[$key]);
        break;
      case 'page-template-default':
        unset($wp_classes[$key]);
        break;
      case 'wp-embed-responsive':
        unset($wp_classes[$key]);
        break;
      case 'page-child':
        unset($wp_classes[$key]);
        break;
      case 'archive':
        unset($wp_classes[$key]);
        break;
      case 'category':
        unset($wp_classes[$key]);
        break;
      case 'post-template-default':
        unset($wp_classes[$key]);
        break;
      case 'single':
        unset($wp_classes[$key]);
        break;
      case 'single-post':
        unset($wp_classes[$key]);
        break;
      case 'single-format-standard':
        unset($wp_classes[$key]);
        break;
      case 'page-parent':
        unset($wp_classes[$key]);
        break;
      case 'page-template-custom-page':
        unset($wp_classes[$key]);
        break;
      case $post_type . '-template':
        unset($wp_classes[$key]);
        break;
      case $post_type . '-template-single-sidebar':
        unset($wp_classes[$key]);
        break;
      case 'search':
        unset($wp_classes[$key]);
        break;
      case 'search-results':
        unset($wp_classes[$key]);
        break;
      case 'error404':
        unset($wp_classes[$key]);
        break;
    }


    // if文
    /*
    if ($value == 'home') {
      unset($wp_classes[$key]);
    } elseif ($value == 'page') {
      unset($wp_classes[$key]);
    } elseif ($value == 'tag') {
      unset($wp_classes[$key]);
    } elseif ($value == 'category-1') {
      unset($wp_classes[$key]);
    } elseif ($value == 'logged-in') {
      unset($wp_classes[$key]);
    } elseif ($value == 'p-embed-responsive') {
      unset($wp_classes[$key]);
    } elseif ($value == 'admin-bar') {
      unset($wp_classes[$key]);
    } elseif ($value == 'page-template-default') {
      unset($wp_classes[$key]);
    } elseif ($value == 'wp-embed-responsive') {
      unset($wp_classes[$key]);
    } elseif ($value == 'page-child') {
      unset($wp_classes[$key]);
    } elseif ($value == 'archive') {
      unset($wp_classes[$key]);
    } elseif ($value == 'category') {
      unset($wp_classes[$key]);
    } elseif ($value == 'post-template-default') {
      unset($wp_classes[$key]);
    } elseif ($value == 'single') {
      unset($wp_classes[$key]);
    } elseif ($value == 'single-post') {
      unset($wp_classes[$key]);
    } elseif ($value == 'single-format-standard') {
      unset($wp_classes[$key]);
    } elseif ($value == 'page-parent') {
      unset($wp_classes[$key]);
    } elseif ($value == 'page-template-custom-page') {
      unset($wp_classes[$key]);
    } elseif ($value == 'page-template-page-' . $page_parent . '-detail') {
      unset($wp_classes[$key]);
    } elseif ($value == 'page-template-custom-pagepage-' . $page_parent . '-detail-php') {
      unset($wp_classes[$key]);
    } elseif ($value == $post_type . '-template') {
      unset($wp_classes[$key]);
    } elseif ($value == $post_type . '-template-single-sidebar') {
      unset($wp_classes[$key]);
    } elseif ($value == $post_type . '-template-single-sidebar-php') {
      unset($wp_classes[$key]);
    } elseif ($value == 'single-' . $post_type) {
      unset($wp_classes[$key]);
    } elseif (is_category()) {
      if ($value == 'category-' . $category[0]->slug) {
        unset($wp_classes[$key]);
      }
    } elseif (is_tax()) {
      if ($value == 'term-' . $term[0]->slug) {
        unset($wp_classes[$key]);
      } elseif ($value == 'tax-' . $query_object->taxonomy) {
        unset($wp_classes[$key]);
      }
    }
    */
  }
  return $wp_classes;
}
add_filter('body_class', 'remove_body_class');
