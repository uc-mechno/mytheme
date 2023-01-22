<?php

/**
 * ************************************************************************
 *
 * wp_headの設定
 *
 * ************************************************************************
 */

/**
 * headタグ終わりに挿入
 * ************************************************************************
 * @link https://choppydays.com/wordpress-google-tag-manager-settings/
 */
function add_gtm_head()
{
  echo "<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-XXXXXXXX');</script>
<!-- End Google Tag Manager -->";
}
add_action('wp_head', 'add_gtm_head', 0);
