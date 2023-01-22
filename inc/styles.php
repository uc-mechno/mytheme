<?php

/**
 * ************************************************************************
 *
 * スタイルシートの読み込み
 *
 * ************************************************************************
 */

/**
 * styleの読み込み
 * ************************************************************************
 *
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wp_enqueue_style
 * wp_enqueue_style($handle, $src, $deps, $ver, $media);
 * @link https://wemo.tech/205
 * @param string $handle ハンドル名を指定（初期値：なし）
 * @param string $src スタイルシートへのパス（初期値：false）
 * @param array $deps 他のスタイルシートのハンドル名を配列で指定（初期値：array()）
 * @param string $ver 任意のバージョンを指定（初期値：false）
 * @param string $media media属性に関する指定（初期値：all）
 */
function my_enqueue_styles()
{

  wp_enqueue_style(
    'notosansjapanese',
    'https://fonts.googleapis.com/earlyaccess/notosansjapanese.css',
    [],
    null,
  );

  wp_enqueue_style(
    'vollkorn',
    'https://fonts.googleapis.com/css?family=Vollkorn:400i',
    ['notosansjapanese'],
    null
  );

  wp_enqueue_style(
    'slick',
    GET_PATH('css') . '/slick.css',
    ['vollkorn']
  );

  wp_enqueue_style(
    'slick-theme',
    GET_PATH('css') . '/slick-theme.css',
    ['slick']
  );

  wp_enqueue_style(
    'my_style',
    GET_PATH('css') . '/styles.css',
    ['slick-theme'],
    date('YmdGis', filemtime(get_theme_file_path('/assets/css/styles.css'))),
  );
}
add_action('wp_enqueue_scripts', 'my_enqueue_styles');

/**
 * style scriptの整形
 * ************************************************************************
 * link 要素の属性の値をダブルクォートで囲み、終了タグの /（末尾のスラッシュ）を削除
 *
 * @param string $html link 要素の HTML
 * @param string $handle スタイルシートのハンドル名
 * @param array  $href スタイルシートの URL（バージョンパラメータを含む）
 * @param array  $media ink 要素の media 属性
 *
 * @link https://www.nxworld.net/wp-change-link-tag-output-by-wp-enqueue-style.html
 * @link https://www.webdesignleaves.com/pr/wp/wp_func_style_script.html
 * @link https://engineer-lady.com/program_info/css-preload/
 * @link https://www.webdesignleaves.com/pr/css/load_css_async.html#wordpress
 *
 * @example
 *  $criticals = ['hoge', 'fuga'];
 * 配列に格納する（複数可）
 */
function load_css_async_top($html, $handle, $href, $media)
{
  if (is_admin() || did_action('login_head')) {
    return $html;
  }
  $criticals = [];
  if (in_array($handle, $criticals, true)) {
    //元の link 要素の HTML（改行が含まれているようなので前後の空白文字を削除）
    $default_html = trim($html);
    $html = <<<EOT
    <link rel="stylesheet" id="{$handle}-css" href="$href" media="print" onload="this.media='all'">
  <noscript>{$default_html}</noscript>\n
  EOT;
  } else {
    $html = <<<EOT
    <link rel="stylesheet" id="{$handle}-css" href="$href" media="$media">\n
    EOT;
  }
  return $html;
}
add_filter('style_loader_tag', 'load_css_async_top', 10, 4);

/* 旧 style_loader_tag 念のため残してある
function change_stylesheet_link($html, $handle, $href)
{
  //管理画面、ログイン画面
  if (!is_admin() || did_action( 'login_head' )) {
    if ('my_style' === $handle) {
      $html = '<link rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" data-handle="' .  $handle . '-css" id="' . $handle . '-css" href="' . $href . '">' . "\n" . '<noscript>' . "\n" . $html . '</noscript>' . "\n";
      return $html;
    }
    $html = '<link rel="stylesheet" id="' . $handle . '-css" href="' . $href . '">' . "\n";
    return $html;
  }
  //管理画面、ログイン画面
  return $html;
}
add_filter('style_loader_tag', 'change_stylesheet_link', 10, 3);
*/
