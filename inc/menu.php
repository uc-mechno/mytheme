<?php

/**
 * ************************************************************************
 *
 * オリジナルメニューの設定
 *
 * ************************************************************************
 */

/**
 * オリジナルのメニューの追加
 * ************************************************************************
 */

// 管理画面に「とりあえずメニュー」を追加登録する
function custom_menu_page()
{

  // メインメニュー① ※実際のページ表示はサブメニュー①
  add_menu_page(
    'とりあえずメニューです', // ページのタイトルタグ<title>に表示されるテキスト
    'とりあえずメニュー', // 左メニューとして表示されるテキスト
    'manage_options', // 必要な権限 manage_options は通常 administrator のみに与えられた権限
    'toriaezu_menu', // 左メニューのスラッグ名 →URLのパラメータに使われる /wp-admin/admin.php?page=toriaezu_menu
    '', // メニューページを表示する際に実行される関数(サブメニュー①の処理をする時はこの値は空にする)
    'dashicons-admin-users', // メニューのアイコンを指定 https://developer.wordpress.org/resource/dashicons/#awards
    0 // メニューが表示される位置のインデックス(0が先頭) 5=投稿,10=メディア,20=固定ページ,25=コメント,60=テーマ,65=プラグイン,70=ユーザー,75=ツール,80=設定
  );

  // サブメニュー① ※事実上の親メニュー
  add_submenu_page(
    'toriaezu_menu',    // 親メニューのスラッグ
    'サブメニュー①です', // ページのタイトルタグ<title>に表示されるテキスト
    'サブメニュー①', // サブメニューとして表示されるテキスト
    'manage_options', // 必要な権限 manage_options は通常 administrator のみに与えられた権限
    'toriaezu_menu',  // サブメニューのスラッグ名。この名前を親メニューのスラッグと同じにすると親メニューを押したときにこのサブメニューを表示します。一般的にはこの形式を採用していることが多い。
    'toriaezu_submenu1_page_contents', //（任意）このページのコンテンツを出力するために呼び出される関数
    0
  );

  // サブメニュー②
  add_submenu_page(
    'toriaezu_menu',    // 親メニューのスラッグ
    'サブメニュー②', // ページのタイトルタグ<title>に表示されるテキスト
    'サブメニュー②', // サブメニューとして表示されるテキスト
    'manage_options', // 必要な権限 manage_options は通常 administrator のみに与えられた権限
    'toriaezu_submenu2', //サブメニューのスラッグ名
    'toriaezu_submenu2_page_contents', //（任意）このページのコンテンツを出力するために呼び出される関数
    1
  );
};
add_action('admin_menu', 'custom_menu_page');

/**
 * メインメニューページ内容の表示・更新処理
 * ************************************************************************
 */
function toriaezu_mainmenu_page_contents()
{

  // HTML表示
  echo <<<EOF

<div class="wrap">
  <h2>メインメニューです</h2>
  <p>
    toriaezu_menuのページです。
  </p>
</div>

EOF;
}

// サブメニュー①ページ内容の表示・更新処理
function toriaezu_submenu1_page_contents()
{

  // ヒアドキュメントでHTMLを表示
  echo <<<EOF

<div class="wrap">
  <h2>サブメニュー①</h2>
  <p>
    toriaezu_submenu1 のページです。
  </p>
</div>

EOF;
// こちらの方法でもHTMLを表示
?>
<div class="wrap">
  <h2>サブメニュー①</h2>
  <p>
    toriaezu_submenu1 のページです。
  </p>
</div>
<?php
}

/**
 *  サブメニュー②ページ内容の表示・更新処理
 * ************************************************************************
 */
function toriaezu_submenu2_page_contents()
{

  // ヒアドキュメントでHTMLを表示
  echo <<<EOF

<div class="wrap">
  <h2>サブメニュー②</h2>
  <p>
    toriaezu_submenu2 のページです。
  </p>
</div>

EOF;
// こちらの方法でもHTMLを表示
?>
<div class="wrap">
  <h2>サブメニュー②</h2>
  <p>
    toriaezu_submenu2 のページです。
  </p>
</div>
<?php
}
