<?php

/**
 * ************************************************************************
 *
 * 初期設定
 *
 * ************************************************************************
 */

function my_theme_setup()
{

  /**
   * 翻訳ファイルの場所を指定
   * ************************************************************************
   */
  load_theme_textdomain('mytheme', get_template_directory() . '/languages');

  // load_plugin_textdomain( 'mytheme' , false, basename( dirname( __FILE__ ) ) .'/languages' );

  /**
   * コンテンツ幅（大サイス）の設定
   */
  function my_theme_content_width()
  {
    $GLOBALS['content_width'] = 640;
  }
  add_action('after_setup_theme', 'my_theme_content_width', 0);

  /**
   * アイキャッチ画像を利用できるようにする
   * ************************************************************************
   */
  add_theme_support('post-thumbnails');

  /**
   * 画像サイズを登録
   * ************************************************************************
   *
   * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_image_size
   *
   */
  add_image_size('top', 1077, 622, true); // トップページのメイン
  add_image_size('contribution', 557, 280, true); // 地域貢献活動一覧
  add_image_size('front-contribution', 255, 189, true); // トップページの地域貢献活動
  add_image_size('common', 465, 252, true);  // 企業情報・店舗情報一覧
  add_image_size('detail', 1100, 330, true); // 各ページのメイン
  add_image_size('search', 168, 168, true); // 検索一覧画像
  add_image_size('search', 1100, 330, true); // 検索一覧画像

  /**
   * Titleタグ
   * ************************************************************************
   */
  add_theme_support('title-tag');

  /**
   * フィードリンク
   * ************************************************************************
   */
  add_theme_support('automatic-feed-links');

  /**
   * 抜粋を利用できるようにする
   * ************************************************************************
   */
  add_post_type_support('page', 'excerpt');

  /**
   * HTML5サポート
   * ************************************************************************
   */
  add_theme_support(
    'html5',
    [
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    ]
  );
  /**
   * 投稿フォーマット
   */
  // add_theme_support( 'post-formats', array(
  //   'aside',
  //   'image',
  //   'video',
  //   'quote',
  //   'link',
  //   'gallery',
  //   'status',
  //   'audio',
  //   'chat',
  // ) )
  /**
   * カスタム背景
   */
  // add_theme_support(
  //   'custom-background',
  //   array(
  //     'default-image' => '',
  //     'default-preset' => 'default',
  //     'default-position-x' => 'left',
  //     'default-position-y' => 'top',
  //     'default-size' => 'auto',
  //     'default-repeat' => 'repeat',
  //     'default-attachment' => 'scroll',
  //     'default-color' => '',
  //     'wp-head-callback' => '_custom_background_cb',
  //     'admin-head-callback' => '',
  //     'admin-preview-callback' => '',
  //   )
  // );
  /**
   * カスタムロゴ
   */
  // add_theme_support(
  //   'custom-logo',
  //   array(
  //     'height'      => 100,
  //     'width'       => 400,
  //     'flex-height' => true,
  //     'flex-width'  => true,
  //     'header-text' => array('site-title', 'site-description'),
  //   )
  // );
  /**
   * テーマカスタマイザーでのウィジェット再読み込み
   */
  // add_theme_support('customize-selective-refresh-widgets');

  /**
 * カスタムメニュー
 * ************************************************************************
 */
  register_nav_menus(
    [
      'place_global' => 'グローバル',
      'place_footer' => 'フッターナビ',
    ]
  );

  /**
   * ブロックエディターサポート
   * ************************************************************************
   */
  add_theme_support('wp-block-styles'); // wp-block-stylesの読み込み
  add_theme_support('align-wide'); // 画像投稿で、幅広/全幅が使えるように
  add_theme_support('editor-styles'); // 投稿画面に、オリジナルCSSの読み込み
  add_theme_support('dark-editor-style'); // ダークモードの実装
  add_editor_style('css/editor.css'); // オリジナルCSSのパス
  add_theme_support('responsive-embeds'); // YouTubeなどの埋め込みコンテンツをレスポンシブに
  // add_theme_support( 'disable-custom-font-sizes' ); // ブロックのカスタム文字サイズを使えなくする
  // add_theme_support( 'editor-font-sizes' ); // ブロックの文字サイズの選択肢を使えなくする
  // add_theme_support( 'disable-custom-colors' ); // ブロックの色設定のカスタムカラーを選ばせないようにする
  // add_theme_support( 'editor-color-palette' ); // ブロックの色設定のカラーパレットを使わないようにする
  // remove_theme_support( 'widgets-block-editor' ); // ブロックベースのウィジェットを無効化

  /**
   * ブロックベースのウィジェットを無効化
   * ************************************************************************
   */
  remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'my_theme_setup');
