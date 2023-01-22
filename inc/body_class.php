<?php

/**
 * ************************************************************************
 *
 * body_classの設定
 *
 * ************************************************************************
 */

/**
 * ユーザー権限毎に body にclassをふる
 * ************************************************************************
 */
/*
function add_user_role_class($admin_body_class)
{
  global $current_user;
  if (!$admin_body_class) {
    $admin_body_class .= ' ';
  }
  $admin_body_class .= ' role-' . urlencode($current_user->roles[0]);
  return $admin_body_class;
}
add_filter('admin_body_class', 'add_user_role_class');
*/

/**
 * スラッグ名のクラスを自動で出力
 * ************************************************************************
 *
 * @param array $classes
 * @return array $classes
 *
 * @link https://www.nxworld.net/wp-add-page-slug-body-class.html
 * @link https://www.nxworld.net/wp-body-class-adding-more-classes-and-alternative-method.html
 * @link https://highfivecreate.com/blog/tips/2949.html
 * @link https://web.contempo.jp/weblog/tips/post-7057
 * @link https://webrent.xsrv.jp/display-term-on-single-with-body-class/
 * @link https://way105.com/journal/wordpress-slug/
 * @link https://into-the-program.com/get-taxonomy-name/
 */
function add_class_page_slug($classes)
{
  $pre_project  = 'p-';        // [p-]を接頭辞としてつける
  $pre_layout   = 'l-';        // [l-]を接頭辞としてつける
  $pre_single   = 'single-';   // [single-]を接頭辞としてつける
  $pre_archive  = 'archive-';  // [archive-]を接頭辞としてつける
  $pre_category = 'category-'; // [category-]を接頭辞としてつける

  $query_object = get_queried_object(); // クエリオブジェクト取得
  $category     = get_the_category();   // カテゴリー情報を取得
  $post_type    = get_post_type();      // 投稿タイプ名を取得


  // カスタムタクソノミーに紐づくタームを取得
  if (!is_search() && !is_404()) {
    $terms        = get_the_terms(get_the_ID(), $query_object->taxonomy);
  }

  if (is_front_page() || is_home()) { // トップ
    $classes[] .= $pre_project . 'top';
  } elseif (is_page()) { // 固定ページ
    $page = get_post(get_the_ID());
    $classes[] .= $pre_project . $page->post_name;
    $parent_id = $page->post_parent;
    if ($parent_id) {
      $classes[] .= $pre_project . get_post($parent_id)->post_name . '-child';
    }
  } elseif (is_singular() && is_single()) { // カスタム投稿
    $classes[] .= $pre_project . $pre_single . $post_type;
    $classes[] .= $pre_project . $post_type;
  } elseif (is_post_type_archive() && is_archive()) { // カスタム投稿アーカイブ
    $classes[] .= $pre_project . $pre_archive . $post_type;
    $classes[] .= $pre_project . $post_type;
  } elseif (!is_search() && !is_404()) {
    if (is_tax($query_object->taxonomy)) { // タクソノミー
      foreach ($terms as $term) {
        $classes[] .= $pre_project . $term->slug;
      }
      $classes[] .= $pre_project . $query_object->taxonomy;
      if (is_tax($query_object->taxonomy) && is_archive()) {
        foreach ($terms as $term) {
          $classes[] .= $pre_project . $pre_archive . $term->slug;
        }
      }
    }
  } elseif (is_single()) { // 投稿
    $classes[] .= $pre_project . $category[0]->slug;
    $classes[] .= $pre_project . $pre_single . $category[0]->slug;
  } elseif (is_archive()) { // アーカイブ
    $classes[] .= $pre_project . $category[0]->slug;
    $classes[] .= $pre_project .  $pre_archive . $category[0]->slug;
  } elseif (is_category()) { // カテゴリー
    $classes[] .= $pre_project . $category[0]->slug;
    $classes[] .= $pre_project .  $pre_category . $category[0]->slug;
  } elseif (is_search()) { // 検索
    $classes[] .= $pre_project . 'search';
  } elseif (is_404()) { // 404
    $classes[] .= $pre_project . '404';
  }
  //$classes[] .= '任意のクラス名'; //その他必要なクラス名があれば追加

  return $classes;

  if (is_admin()) return $classes; // 管理画面は除外
  if (wp_is_mobile()) $classes[] .= $pre_layout . 'mobile'; // スマホ・タブレット
}
add_filter('body_class', 'add_class_page_slug');
