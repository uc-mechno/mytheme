<?php

/**
 * ************************************************************************
 *
 * カスタム投稿、カスタムタクソノミーなどの設定
 *
 * ************************************************************************
 */

/**
 * カスタム投稿タイプ news を登録する
 * ************************************************************************
 *
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_post_type
 * @link https://prograshi.com/wordpress/wp-register_post_type/
 * @link https://www.webdesignleaves.com/pr/wp/wp_custom_post_type.html
 * @link https://wordpress-web.and-ha.com/summary-add-custom-post-type/
 *
 */
function my_add_custom_post()
{
  register_post_type(
    'news', // スラッグ名
    [
      'label' => 'ニュース', // ラベル名
      'labels' => [
        'name' => 'ニュース', // ラベル名
        'singular_name' => 'ニュース',
        'all_items' => 'ニュース一覧',
        'add_new' => '新規ニュース追加', // 新規追加
        'edit_item' => 'ニュースの編集', // 編集
        'new_item' => '新規ニュースの編集', // 新規
        'view_item' => 'ニュースを表示', // 表示
        'search_items' => 'ニュースを検索', // 検索
        'not_found' => '見つかりません', // 見つかりません
        'not_found_in_trash' => 'ゴミ箱内に見つかりません', // ゴミ箱内に見つかりません
        'parent_item_colon' => '親', // 親
      ],
      'public' => true, // 公開
      'has_archive' => true, // アーカイブ
      'menu_position' => 5, // 位置
      'show_in_rest' => true, // Gutenbergエディタを有効
      'supports' => [
        'title', // タイトル
        'editor', // エディター
        'custom-fields', // カスタムフィールド
        'thumbnail', // アイキャッチ
        'excerpt', // 抜粋
        'revisions', // リビジョン
        'page-attributes', // ページ属性
      ],
    ]
  );
  register_post_type(
    'daily_contribution', // スラッグ名
    [
      'label' => '地域貢献活動', // ラベル名
      'labels' => [
        'name' => '地域貢献活動', // ラベル名
        'all_items' => '地域貢献活動一覧', // すべての
        'add_new' => '新規地域貢献活動', // 新規追加
        'edit_item' => 'レンタルの編集', // 編集
        'new_item' => '新規レンタルの編集', // 新規
        'view_item' => 'レンタルを表示', // 表示
        'search_items' => 'レンタルを検索', // 検索
        'not_found' => '見つかりません', // 見つかりません
        'not_found_in_trash' => 'ゴミ箱内に見つかりません', // ゴミ箱内に見つかりません
        'parent_item_colon' => '親', // 親
      ],
      'public' => true, // 公開
      'has_archive' => true, // アーカイブ
      'menu_position' => 5, // 位置
      'show_in_rest' => true, // Gutenbergエディタを有効
      'supports' => [
        'title', // タイトル
        'editor', // エディター
        'custom-fields', // カスタムフィールド
        'thumbnail', // アイキャッチ
        'excerpt', // 抜粋
        'revisions', // リビジョン
        'page-attributes', // ページ属性
      ],
    ]
  );
}
add_action('init', 'my_add_custom_post');

/**
 * カスタム分類 news を登録する
 * ************************************************************************
 */
function my_add_taxonomy()
{
  register_taxonomy(
    'news-cat', // タクソノミー名
    'news', // カスタム投稿タイプ名
    [
      'label' => 'ニュースカテゴリー',
      'labels' => [
        'name' => 'ニュースカテゴリー', // ラベル名
        'all_items' => '全てのカテゴリー', // すべての
        'add_new_item' => 'カテゴリーを追加', // 追加
        'edit_item' => 'ニュースを編集', // 〇〇を編集
        'view_item' => 'ニュースを表示', // 表示
        'update_item' => 'ニュースを更新', // 〇〇を更新
        'add_new_item' => '新規ニュースを追加', // 新規追加の名前
        'parent_item' => '親ニュースを追加', // 親
        'search_items' => 'ニュースを検索', // 検索
      ],
      'public' => true, // 公開
      'hierarchical' => true, // カテゴリー形式
      'show_in_rest' => true, // Gutenberg で表示
      'update_count_callback' => '_update_post_term_count',
      // 'rewrite' => [
      //   'slug' => 'news', // リライト
      //   'hierarchical' => true // カテゴリー形式
      // ],
    ]
  );
  register_taxonomy(
    'news-tag', // タクソノミー名
    'news', // カスタム投稿タイプ名
    [
      'label' => 'ニュースタグ',
      'labels' => [
        'name' => 'ニュースタグ', // ラベル名
        'all_items' => '全てのカテゴリー', // すべての
        'add_new_item' => 'カテゴリーを追加', // 追加
        'edit_item' => 'ニュースを編集', // 〇〇を編集
        'view_item' => 'ニュースを表示', // 表示
        'update_item' => 'ニュースを更新', // 〇〇を更新
        'add_new_item' => '新規ニュースを追加', // 新規追加の名前
        'parent_item' => '親ニュースを追加', // 親
        'search_items' => 'ニュースを検索', // 検索
      ],
      'public' => true, // 公開
      'hierarchical' => false, // タグ形式
      'show_in_rest' => true, // Gutenberg で表示
      'update_count_callback' => '_update_post_term_count',
      // 'rewrite' => [
      //   'slug' => 'news', // リライト
      //   'hierarchical' => false // タグ形式
      // ],
    ]
  );
  register_taxonomy(
    'event', // タクソノミー名
    'daily_contribution', // カスタム投稿タイプ名
    [
      'label' => 'イベントの種類',
      'labels' => [
        'name' => 'イベントの種類', // ラベル名
        'all_items' => '全てのイベント', // すべての
        'edit_item' => 'イベントを編集', // 〇〇を編集
        'view_item' => 'イベントを表示', // 表示
        'update_item' => 'イベントを更新', // 〇〇を更新
        'add_new_item' => '新規イベントを追加', // 新規追加の名前
        'parent_item' => '親イベントを追加', // 親
        'search_items' => 'イベントを検索', // 検索
      ],
      'public' => true, // 公開
      'hierarchical' => true, // カテゴリー形式
      'show_in_rest' => true, // Gutenberg で表示
    ]
  );
}
add_action('init', 'my_add_taxonomy');

/**
 * カスタムタクソノミーURLリライト
 * デフォルトの /news-cat/xxx/ から /news/xxx/ でアクセスできるように
 * ************************************************************************
 * @link https://blog.skylarking.me/2017/12/24/wordpress-custom-post-type-and-taxonomies
 */
/*
function my_rewrite_rule_tax()
{
  add_rewrite_rule(
    '^news/([^/]+)/?$',
    'index.php?taxonomy=news-cat&term=$matches[1]',
    'top'
  );
  add_rewrite_rule(
    'news/([^/]+)/page/?([0-9]{1,})/?$',
    'index.php?news-cat=$matches[1]&paged=$matches[2]',
    'top'
  );
}
add_action('init', 'my_rewrite_rule_tax');
*/

/**
 * カスタム投稿タイプのページが404エラーで表示されないとき
 * ************************************************************************
 * @link https://gray-code.com/blog/wordpress/how-to-repair-404page/
 */
/*
// global $wp_rewrite;
// $wp_rewrite->flush_rules();
