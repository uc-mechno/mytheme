<?php

/**
 * ************************************************************************
 *
 * 管理画面の設定
 *
 * ************************************************************************
 */

/**
 * 管理メニューの「投稿」に関する表示を「NEWS（任意）」に変更
 * ************************************************************************
 */
// function change_post_menu_label()
// {
//   global $menu;
//   global $submenu;
//   $menu[5][0] = 'NEWS';
//   $submenu['edit.php'][5][0] = 'NEWS一覧';
//   $submenu['edit.php'][10][0] = '新しいNEWS';
//   $submenu['edit.php'][16][0] = 'タグ';
// }
// add_action('init', 'change_post_object_label');

/**
 * 管理画面上の「投稿」に関する表示を「NEWS」に変更
 * ************************************************************************
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_post_type
 */
// function change_post_object_label()
// {
//   global $wp_post_types;
//   $labels = &$wp_post_types['post']->labels;
//   $labels->name = 'NEWS';
//   $labels->singular_name = 'NEWS';
//   $labels->add_new = _x('追加', 'NEWS');
//   $labels->add_new_item = 'NEWSの新規追加';
//   $labels->edit_item = 'NEWSの編集';
//   $labels->new_item = '新規NEWS';
//   $labels->view_item = 'NEWSを表示';
//   $labels->search_items = 'NEWSを検索';
//   $labels->not_found = '記事が見つかりませんでした';
//   $labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
// }
// add_action('admin_menu', 'change_post_menu_label');

/**
 * メニュー、サブメニューの表示、非表示
 * ************************************************************************
 * @link https://www.itti.jp/web-design/how-to-customize-your-wordpress-admin-menu/#chapter-1
 * @link https://qiita.com/konweb/items/5483efbe87087eff5cc8
 */
function my_add_remove_admin_menus()
{
  if (!current_user_can('administrator')) {
  global $menu;
  global $submenu;

  // メニューを非表示にする
  // unset($menu[2]);  // ダッシュボード
  // unset($menu[4]);  // メニューの線1
  // unset($menu[5]);  // 投稿
  // unset($menu[10]); // メディア
  // unset($menu[15]); // リンク
  // unset($menu[20]); // ページ
  // unset($menu[25]); // コメント
  // unset($menu[59]); // メニューの線2
  // unset($menu[60]); // テーマ
  // unset($menu[65]); // プラグイン
  // unset($menu[70]); // プロフィール
  // unset($menu[75]); // ツール
  // unset($menu[80]); // 設定
  // unset($menu[90]); // メニューの線3

  // サブメニューを非表示にする
  // unset($submenu['index.php'][0]); //ホーム
  // unset($submenu['index.php'][10]); //更新
  // unset($submenu['upload.php'][5]); //ライブラリ
  // unset($submenu['upload.php'][10]); //新規追加
  // unset($submenu['edit-comments.php'][0]); //コメント一覧
  // unset($submenu['edit.php'][5]); //投稿一覧
  // unset($submenu['edit.php'][10]); //新規追加
  // unset($submenu['edit.php'][15]); //カテゴリー
  // unset($submenu['edit.php'][16]); //タグ
  // unset($submenu['edit.php?post_type=page'][5]); //固定ページ一覧
  // unset($submenu['edit.php?post_type=page'][10]); //新規追加
  // unset($submenu['themes.php'][5]); //テーマ
  // unset($submenu['themes.php'][6]); //カスタマイズ
  // unset($submenu['themes.php'][7]); //ウィジェット
  // unset($submenu['themes.php'][10]); //メニュー
  // unset($submenu['plugins.php'][5]); //インストール済みプラグイン
  // unset($submenu['plugins.php'][10]); //新規追加
  // unset($submenu['plugins.php'][15]); //プラグインファイルエディター
  // unset($submenu['users.php'][5]); //ユーザー一覧
  // unset($submenu['users.php'][10]); //新規追加
  // unset($submenu['users.php'][15]); //プロフィール
  // unset($submenu['tools.php'][5]); //利用可能なツール
  // unset($submenu['tools.php'][10]); //インポート
  // unset($submenu['tools.php'][15]); //エクスポート
  // unset($submenu['tools.php'][20]); //サイトヘルス
  // unset($submenu['tools.php'][25]); //個人データのエクスポート
  // unset($submenu['tools.php'][30]); //個人データの消去
  // unset($submenu['options-general.php'][10]); //一般
  // unset($submenu['options-general.php'][15]); //投稿設定
  // unset($submenu['options-general.php'][20]); //表示設定
  // unset($submenu['options-general.php'][25]); //ディスカッション
  // unset($submenu['options-general.php'][30]); //メディア
  // unset($submenu['options-general.php'][40]); //パーマリンク
  // unset($submenu['options-general.php'][45]); //プライバシー
  }
}
add_action('admin_menu', 'my_add_remove_admin_menus');

/**
 * アドミンバーーの表示、非表示
 * ************************************************************************
 * @link https://www.itti.jp/web-design/how-to-customize-your-wordpress-admin-menu/#chapter-1
 * @link https://qiita.com/konweb/items/5483efbe87087eff5cc8
 */
function remove_admin_bar_menus($wp_admin_bar)
{
  if (!current_user_can('administrator')) {
  // $wp_admin_bar->remove_menu( 'wp-logo' ); // ロゴ
  // $wp_admin_bar->remove_menu( 'about' ); // ロゴ / WordPressについて
  // $wp_admin_bar->remove_menu( 'wporg' ); // ロゴ / WordPress.org
  // $wp_admin_bar->remove_menu( 'documentation' ); // ロゴ / ドキュメンテーション
  // $wp_admin_bar->remove_menu( 'support-forums' ); // ロゴ / サポート
  // $wp_admin_bar->remove_menu( 'feedback' ); // ロゴ / フィードバック
  // $wp_admin_bar->remove_menu( 'site-name' ); // サイト名
  // $wp_admin_bar->remove_menu( 'view-site' ); // サイト名 / サイトを表示
  // $wp_admin_bar->remove_menu( 'updates' ); // 更新
  // $wp_admin_bar->remove_menu( 'comments' ); // コメント
  // $wp_admin_bar->remove_menu( 'new-content' ); // 新規
  // $wp_admin_bar->remove_menu( 'new-post' ); // 新規 / 投稿
  // $wp_admin_bar->remove_menu( 'new-media' ); // 新規 / メディア
  // $wp_admin_bar->remove_menu( 'new-page' ); // 新規 / 固定
  // $wp_admin_bar->remove_menu( 'new-user' ); // 新規 / ユーザー
  // $wp_admin_bar->remove_menu( 'view' ); // 投稿を表示
  // $wp_admin_bar->remove_menu( 'my-account' ); // こんにちは、[ユーザー名]さん $wp_admin_bar->remove_menu( 'user-info' ); // ユーザー / [ユーザー名]
  // $wp_admin_bar->remove_menu( 'edit-profile' ); // ユーザー / プロフィールを編
  // $wp_admin_bar->remove_menu( 'logout' ); // ユーザー / ログアウト
  // $wp_admin_bar->remove_menu( 'menu-toggle' ); // メニュー
  // $wp_admin_bar->remove_menu( 'search' ); // 検索
  }
}
add_action('admin_bar_menu', 'remove_admin_bar_menus', 999);

/**
 * 表示オプションの表示、非表示（remove_post_type_support）
 * ************************************************************************
 */

function remove_post_support()
{
  if (!current_user_can('administrator')) {

    // 投稿ページ
    // remove_post_type_support('post', 'author'); // 作成者
    // remove_post_type_support('post', 'excerpt'); // 抜粋
    // remove_post_type_support('post', 'trackbacks'); // トラックバック
    // remove_post_type_support('post', 'custom-fields'); // カスタムフィールド
    // remove_post_type_support('post', 'tag'); // タグ
    // remove_post_type_support('post', 'comments'); // コメント
    // remove_post_type_support('post', 'revisions'); // リビジョン
    // remove_post_type_support('post', 'page-attributes'); // 表示順
    // remove_post_type_support('post', 'post-formats'); // 投稿フォーマット

    // 固定ページ
    // remove_post_type_support('post', 'author'); // 作成者
    // remove_post_type_support('post', 'excerpt'); // 抜粋
    // remove_post_type_support('post', 'trackbacks'); // トラックバック
    // remove_post_type_support('post', 'custom-fields'); // カスタムフィールド
    // remove_post_type_support('post', 'tag'); // タグ
    // remove_post_type_support('post', 'comments'); // コメント
    // remove_post_type_support('post', 'revisions'); // リビジョン
    // remove_post_type_support('post', 'page-attributes'); // 表示順
    // remove_post_type_support('post', 'post-formats'); // 投稿フォーマット

  }
}
add_action('init', 'remove_post_support');


/**
 * ウィジェットの表示、非表示
 * ************************************************************************
 */

function unregister_default_widget()
{
  if (!current_user_can('administrator')) {

    // unregister_widget('WP_Widget_Pages'); // 固定ページ
    // unregister_widget('WP_Widget_Calendar'); // カレンダー
    // unregister_widget('WP_Widget_Archives'); // アーカイブ
    // unregister_widget('WP_Widget_Media_Audio'); // 音声
    // unregister_widget('WP_Widget_Media_Image'); // 画像
    // unregister_widget('WP_Widget_Media_Gallery'); // ギャラリー
    // unregister_widget('WP_Widget_Media_Video'); // 動画
    // unregister_widget('WP_Widget_Meta'); // メタ情報
    // unregister_widget('WP_Widget_Search'); // 検索
    // unregister_widget('WP_Widget_Text'); // テキスト
    // unregister_widget('WP_Widget_Categories'); // カテゴリー
    // unregister_widget('WP_Widget_Recent_Posts'); // 最近の投稿
    // unregister_widget('WP_Widget_Recent_Comments'); // 最近のコメント
    // unregister_widget('WP_Widget_RSS'); // RSS
    // unregister_widget('WP_Widget_Tag_Cloud'); // タグクラウド
    // unregister_widget('WP_Nav_Menu_Widget'); // ナビゲーションメニュー
    // unregister_widget('WP_Nav_Menu_Widget'); // カスタムメニュー
    // unregister_widget('WP_Widget_Custom_HTML'); // カスタムHTML
    // unregister_widget('WP_Widget_Block'); // ブロック
    // unregister_widget('AIOSEO\\Plugin\\Common\\Breadcrumbs\\Widget'); // AIOSEO - パンくずリスト
    // unregister_widget('bcn_widget'); // Breadcrumb NavXT
    // unregister_widget('WP_Custom_Post_Type_Widgets_Recent_Posts'); // blog新着
    // unregister_widget('WP_Custom_Post_Type_Widgets_Archives'); // blogアーカイブ
    // unregister_widget('WP_Custom_Post_Type_Widgets_Categories'); // blogカテゴリー
    // unregister_widget('WP_Custom_Post_Type_Widgets_Calendar'); // blogカレンダー
    // unregister_widget('WP_Custom_Post_Type_Widgets_Recent_Comments'); // blogコメント
    // unregister_widget('WP_Custom_Post_Type_Widgets_Tag_Cloud'); // blogタグ
    // unregister_widget('WP_Custom_Post_Type_Widgets_Search'); // blog検索
  }
}
add_action('widgets_init', 'unregister_default_widget');

/**
 * ダッシュボードのカスタマイズ
 * ************************************************************************
 */

function remove_dashboard_widget()
{

  if (!current_user_can('administrator')) {
    // remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // 概要
    // remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // アクティビティ
    // remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // クイックドラフト
    // remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPressニュース
  }
}
add_action('wp_dashboard_setup', 'remove_dashboard_widget');


/**
 * dumpを使って確認すためだけの関数
 * ***********************************************************************
 */
/*
function dump_menu()
{
  global $menu;
  global $submenu;
  var_dump($menu);
  var_dump($submenu);
}
add_action('admin_menu', 'dump_menu');
*/

/**
 * ウィジェット
 * ***********************************************************************
 */
/*
add_action('wp_footer', function () {
  if (empty($GLOBALS['wp_widget_factory']))
    return;
  $widgets = array_keys($GLOBALS['wp_widget_factory']->widgets);
  print '<pre>$widgets = ' . esc_html(var_export($widgets, TRUE)) . '</pre>';
});
*/


/**
 * メニューの並び替え
 * ************************************************************************
 */
/*
function my_custom_menu_order($menu_order)
{
  if (!$menu_order) return true;
  return array(
    'index.php', // ダッシュボード
    'separator1', // セパレータ１
    'edit.php', // 投稿
    'upload.php', // メディア
    'edit.php?post_type=page', //固定ページ
    'edit.php?post_type=mw-wp-form', // mwwpform
    'separator2', //セパレータ２
    'edit-comments.php', //コメント
    'separator-last', //最後のセパレータ
    'themes.php', //外観
    'plugins.php', //プラグイン
    'users.php', //ユーザー
    'tools.php', //ツール
    'options-general.php', //設定
  );
}
add_filter('custom_menu_order', 'my_custom_menu_order');
add_filter('menu_order', 'my_custom_menu_order');
*/

/**
 * 更新通知を管理者権限のみに表示
 * ************************************************************************
 */
/*
function update_nag_admin_only()
{
  if (!current_user_can('administrator')) {
    remove_action('admin_notices', 'update_nag', 3);
  }
}
*/

/**
 * 管理画面全体にCSS適用
 * ************************************************************************
 */
function my_add_admin_style()
{
  global $WP_CSS_PATH;
  wp_enqueue_style('my_add_admin_style', $WP_CSS_PATH . '/style-admin.css');
}
add_action('admin_enqueue_scripts', 'my_add_admin_style');

/**
 * ビジュアルエディタにCSS適用
 * ************************************************************************
 */
function my_add_editor_style()
{
  global $WP_CSS_PATH;
  add_editor_style(str_replace('/' . get_stylesheet_directory_uri(), '', $WP_CSS_PATH) . '/style-editor.css');
}
add_action('admin_init', 'my_add_editor_style');

/**
 * 管理画面全体にjs適用
 * ************************************************************************
 */
function my_add_admin_js($hook)
{
  global $WP_JS_PATH;
  wp_enqueue_script('my_admin_script', $WP_JS_PATH . '/admin.js');
}
add_action('admin_enqueue_scripts', 'my_add_admin_js');
