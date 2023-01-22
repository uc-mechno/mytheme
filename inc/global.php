<?php

/**
 * ************************************************************************
 *
 * グローバル変数 / 関数
 *
 * ************************************************************************
 */


/**
 * パス
 * ************************************************************************
 */
$WP_ROOT_PATH = get_stylesheet_directory_uri();
$WP_IMG_PATH  = esc_html($WP_ROOT_PATH . '/assets/images'); // 画像
$WP_CSS_PATH  = esc_html($WP_ROOT_PATH . '/assets/css');    // style
$WP_JS_PATH   = esc_html($WP_ROOT_PATH . '/assets/js');     // script
function GET_PATH(string $_type = 'img')
{
  global $WP_IMG_PATH;
  global $WP_CSS_PATH;
  global $WP_JS_PATH;
  switch ($_type) {
    case 'img':
      return $WP_IMG_PATH;
      break;
    case 'css':
      return $WP_CSS_PATH;
      break;
    case 'js':
      return $WP_JS_PATH;
      break;
    default:
      return '';
      break;
  }
}

/**
 * ループ
 * ************************************************************************
 */
// メインループの表示件数制御
// $WP_ROOP_VIEW_ARCHIVE = 3;
// $WP_ROOP_VIEW_TAX = 3;

// OGP用
// $FACEBOOK_APP_ID = '';
// $TWITTER_ACCOUNT_ID = '';
