<?php

/**
 * ************************************************************************
 *
 * スクリプトの読み込み
 *
 * ************************************************************************
 */

function my_enqueue_script()
{
  /**
   * scriptの読み込み
   * ************************************************************************
   *
   * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wp_enqueue_script
   * wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
   * @param string $handle ハンドル名を指定（初期値：なし）
   * @param string $src スクリプトの URL（初期値：false）
   * @param array $deps スクリプトが依存するスクリプトのハンドルの配列（初期値：array()）
   * @param string $ver 任意のバージョンを指定（初期値：false）
   * @param string $in_footer </body> 終了タグの前に配置（初期値：false）
   *
   * @link https://twotone.me/web/2323/
   * @link https://capitalp.jp/2018/05/02/complex-between-jquery-and-frontend/amp/
   */
  if (!is_admin()) { // 管理画面ではjQueryを削除できない
    // 現在のバージョンとURIを保存。
    // CDNを使いたい方は$jquery_srcのURIを変更してもよい。
    global $wp_scripts;
    $jquery = $wp_scripts->registered['jquery-core'];
    $jquery_ver = $jquery->ver;
    $jquery_src = $jquery->src;

    // いったん削除
    wp_deregister_script('jquery'); // jquery-core, jquery-migrateのエイリアスの削除
    wp_deregister_script('jquery-core'); // デフォルトjquery削除
    wp_deregister_script('jquery-migrate');  // デフォルトjquery-migrate削除

    wp_enqueue_script('jquery');  // デフォルトのjqueryの読み込み

    // 登録しなおし
    wp_register_script('jquery', false, ['jquery-core'], $jquery_ver, true);
    wp_register_script('jquery-core', $jquery_src, [], $jquery_ver, true);

    // jQuery を CDN から読み込む
    // wp_enqueue_script(
    //   'jquery-org',
    //   '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js',
    //   [],
    //   '3.6.0',
    //   true //</body> 終了タグの前で読み込み
    // );

    wp_enqueue_script(
      'slick',
      GET_PATH('js') . '/slick.min.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'bundle',
      GET_PATH('js') . '/bundle.js',
      ['slick'],
      date('YmdGis', filemtime(get_theme_file_path('/assets/js/bundle.js'))),
      true
    );
  }
}

add_action('wp_enqueue_scripts', 'my_enqueue_script');

/**
 * style scriptの整形
 * ************************************************************************
 * id を先頭に移動し、src 属性をダブルクォートで囲み、該当するハンドルに async もしくは async 属性を付与
 *
 * @param string $tag script 要素タグの HTML
 * @param string $handle スクリプトのハンドル名
 * @param array  $src スクリプトの URL（バージョンパラメータを含む）
 *
 * @link https://www.webdesignleaves.com/pr/wp/wp_func_style_script.html
 * @link https://tadtadya.com/wordpress-late-load-js-async-defer/
 * @link https://engineer-lady.com/program_info/javascript-defer/
 *
 * @example
 * $defer = ['hoge'];
 * $async = ['fuga', 'habo'];
 * 配列に格納する（複数可）
 *
 */
function scriptLoader($tag, $handle, $src)
{
  // 管理画面以外
  if (is_admin()) {
    return $tag;
  }
  $defer = [];
  $async = [];
  // defer 属性を追加する
  if (in_array($handle, $defer, true)) {
    $tag = '<script defer id="' . $handle . '-js" src="' . $src . '"></script>' . "\n";
    return $tag;
    // async 属性を追加する
  } elseif (in_array($handle, $async, true)) {
    $tag = '<script async id="' . $handle . '-js" src="' . $src . '"></script>' . "\n";
    return $tag;
  } else {
    // 上記以外
    $tag = '<script id="' . $handle . '-js" src="' . $src . '"></script>' . "\n";
    return $tag;
  }
  return $tag;
}
add_filter('script_loader_tag', 'scriptLoader', 10, 3);
