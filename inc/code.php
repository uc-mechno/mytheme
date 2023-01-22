<?php
/**
 * ************************************************************************
 *
 * ショートコード集
 *
 * ************************************************************************
 */

/**
 * ショートコード[home_url]
 * ************************************************************************
 * 現在のブログのホームURLを返す
 *  @example
 * <a href="[home_url]/xxxxx.xx"></a>
 */
function homeUrl()
{
  return esc_url(home_url());
}
add_shortcode('home_url', 'homeUrl');
/**
 * ショートコード[img_path]
 * ************************************************************************
 * テーマディレクトリまでのURLを取得する
 *  @example
 * <img sec="[[img_path]/xxxxx.xx"></img>
 */
function imgPath()
{
  return get_template_directory_uri();
}
add_shortcode('img_path', 'imgPath');
/**
 * ショートコード[program_post]
 * ************************************************************************
 * 最新の投稿を1件取得、表示
 *  @example
 */
function programPost()
{
  $myposts = get_posts("post_type=program&orderby=date&order=DESC&numberposts=1");
  return get_permalink($myposts[0]);
}
add_shortcode('program_post', 'programPost');

/**
 * ショートコード[ignore]
 * ************************************************************************
 * 何も返さない（コメントアウト代わり）
 * @link https://www.u-1.net/2009/11/07/1963/
 *
 * @example
 * [ignore]ここにコンテンツがはいる[/ignore]
 */
function ignore_shortcode($atts, $content = null)
{
  return null;
}
add_shortcode('ignore', 'ignore_shortcode');

/**
 * ショートコード[limit]
 * ************************************************************************
 * 時限を仕込むショートコード
 * @link https://www.a-in-hello.world/limit_code.html
 *
 * @example
 * [limit start='2019-09-14 12:00']ここだけ2019年9月14日の12時に表示されます。[/limit]
 * [limit end='2019-09-14 12:00']ここだけ2019年9月14日の12時に消えます。[/limit]
 * [limit start='2019-09-14 12:00' end='2019-09-15 0:00']ここだけ2019年9月14日の12時から2019年9月15日の0時まで表示されます。[/limit]
 */
function limit_code($atts, $content = null)
{
  $atts = shortcode_atts(array(
    "start" => null,
    "end" => null
  ), $atts);

  date_default_timezone_set("Asia/Tokyo");
  $today = strtotime(date('Y-m-d H:i'));

  if (($atts[start]) && ($atts[end] == null)) {
    if ($today >= strtotime('' . $atts[start] . '')) {
      return $content;
    }
  } elseif ($atts[start] && $atts[end]) {
    if (($today >= strtotime('' . $atts[start] . '')) && ($today < strtotime('' . $atts[end] . ''))) {
      return $content;
    }
  } elseif (($atts[start] == null) && ($atts[end])) {
    if ($today < strtotime('' . $atts[end] . '')) {
      return $content;
    }
  } else {
    return $content;
  }
}
add_shortcode('limit', 'limit_code');

/**
 * ショートコード[if-login]
 * ショートコード[no-login]
 * ************************************************************************
 * @link https://www.d-grip.com/blog/seisaku/4945
 * @example
 * [if-login]このテキストはログインした時だけに表示されるよ。[/if-login]
 * [no-login]このテキストはログインしていない時だけに表示されるよ。[/no-login]
 */
//ログインした時表示
function if_login($atts, $content = null)
{
  if (is_user_logged_in()) {
    return "" . $content . "";
  } else {
    return "";
  }
}
add_shortcode('if-login', 'if_login');

//ログインしていない時表示
function no_login($atts, $content = null)
{
  if (!is_user_logged_in()) {
    return "" . $content . "";
  } else {
    return "";
  }
}
add_shortcode('no-login', 'no_login');

/**
 * ショートコード[if-test]
 * ショートコード[no-test]
 * ************************************************************************
 * @link https://webcreatetips.com/coding/1763/
 * @example
 * [if-login]このテキストは松尾に test=true をつけたときだけに表示されるよ。[/if-login]
 * [no-login]このテキストは松尾に test=true をつけていないときだけに表示されるよ。[/no-login]
 *
 */
//末尾に?test=trueをつけたとき
function if_test($atts, $content = null)
{
  if ($_GET['test'] == 'true') {
    return "" . $content . "";
  } else {
    return "";
  }
}
add_shortcode('if-test', 'if_test');

//末尾に?test=trueをつけていないとき
function no_test($atts, $content = null)
{
  if (!$_GET['test'] == 'true') {
    return "" . $content . "";
  } else {
    return "";
  }
}
add_shortcode('no-test', 'no_test');
