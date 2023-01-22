<?php

/**
 * ドキュメント
 * @link https://ja.wordpress.org/team/handbook/coding-standards/inline-documentation-standards/php/
 *
 * テーマの作成
 * @link https://wpdocs.osdn.jp/%E3%83%86%E3%83%BC%E3%83%9E%E3%81%AE%E4%BD%9C%E6%88%90
 *
 * functions.phpを分割
 * @link https://meshikui.com/2018/08/24/753/
 *
 * get_template_part()だとglobal変数が渡せない
 * @link https://www-creators.com/archives/465
 * locate_template()関数を使う
 * get_template_part('include/global');
 * ↓
 * require_once locate_template('include/global.php');
 *
 * オリジナルプラグイン化
 * posts.php code.phpをプラグインとして追加
 * @link https://wpqw.jp/wordpress/plugins/cpt-create-plugin/
 *
 * @link https://tabibitojin.com/wordpress-inc-php-separate/
 *
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/locate_template
 *
 */
require locate_template('inc/global.php');               // global変数
require locate_template('inc/init.php');                 // 初期設定
require locate_template('inc/remove.php');               // 削除、除去の設定（一部プラグイン化）
// require locate_template('inc/roles.php');             // 権限グループの設定
// require locate_template('inc/custom-menu.php');       // カスタムメニューの設定
require locate_template('inc/widgets.php');              // ウィジェットの設定
// require locate_template('inc/sidebar.php');           // サイドバーの設定
require locate_template('inc/custom.php');               // その他関数
require locate_template('inc/display.php');              // 文字・画像などの関数
require locate_template('inc/code.php');                 // ショートコード集（プラグイン化）
require locate_template('inc/styles.php');               // styleの読み込み
require locate_template('inc/scripts.php');              // scriptの読み込み
require locate_template('inc/editor.php');               // エディターに関するカスタマイズ
require locate_template('inc/admin.php');                // 管理画面の設定
require locate_template('inc/menu.php');                 // 管理画面の設定
require locate_template('inc/posts.php');                // カスタム投稿の設定（プラグイン化）
// require locate_template('inc/category.php');          // カテゴリーの設定
require locate_template('inc/titles.php');               // タイトルの設定
require locate_template('inc/wp_head.php');              // wp-headの設定
// require locate_template('inc/body_class.php');        // body_classの設定※エラーが出るため一旦、コメントアウト
require locate_template('inc/wp_body_open.php');         // wp_body_openの設定
require locate_template('inc/breadcrumbs.php');          // パンくずの設定
require locate_template('inc/pagination.php');           // ページネーションの設定
require locate_template('inc/search.php');               // 検索の設定
// require locate_template('inc/plugins/contactform7.php'); // contactform7の設定
