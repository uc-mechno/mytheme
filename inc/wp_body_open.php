<?php

/**
 * ************************************************************************
 *
 * wp_body_openの設定
 *
 * ************************************************************************
 */

/**
 * bodyタグ開始に挿入
 * ************************************************************************
 * @link https://choppydays.com/wordpress-google-tag-manager-settings/
 */
function add_gtm_body()
{
  echo '<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXXX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->';
}

add_action('wp_body_open', 'add_gtm_body', 0);
