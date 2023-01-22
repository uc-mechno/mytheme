<?php

/**
 * ************************************************************************
 *  Contact Form 7の設定
 * ************************************************************************
 */

/**
 * ContactForm7で自動挿入されるPタグ、brタグを削除
 * ************************************************************************
 */
function wpcf7_autop_return_false()
{
  return false;
}
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');

/**
 * post成功時にセッションをセット
 * サンクスページアクセス時、このセッションが無いとTOPへリダイレクトさせる（URL直打ちのアクセス対策）
 * ************************************************************************
 */
function my_wpcf7_mail_sent_session_start()
{
  session_start();
  $_SESSION['thanks_judge'] = true;
}
add_action('wpcf7_mail_sent', 'my_wpcf7_mail_sent_session_start');

/**
 * サンクスページに遷移
 * ************************************************************************
 * @see https://junpei-sugiyama.com/contact-form-7-thanks-page/
 */
function add_origin_thanks_page()
{
  $thanks = home_url('/thanks/');
  $recruit = home_url('/recruit/');
  echo <<< EOC
     <script>
       var thanksPage = {
         14: '{$thanks}',
         フォームID: '{$recruit}',
       };
     document.addEventListener( 'wpcf7mailsent', function( event ) {
       location = thanksPage[event.detail.contactFormId];
     }, false );
     </script>
   EOC;
}
add_action('wp_footer', 'add_origin_thanks_page');
