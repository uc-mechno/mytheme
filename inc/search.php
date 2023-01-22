<?php

/**
 * ************************************************************************
 *
 * 検索の設定
 *
 * ************************************************************************
 */
/**
 * 全ての固定ページを除外
 * ************************************************************************
 *
 */
/*
function my_main_query( $query ) {
  if ( ! is_admin() && $query->is_main_query() ) {
    if ( $query->is_search ) {
      $query->set( 'post_type', 'post' ) ;
    }
  }
}
add_action ('pre_get_posts', 'my_main_query' );
*/

/**
 * 特定ページ・特定カテゴリーをIDで除外
 * ************************************************************************
 *
 * @link https://wpdocs.osdn.jp/%E3%83%97%E3%83%A9%E3%82%B0%E3%82%A4%E3%83%B3_API/%E3%82%A2%E3%82%AF%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%95%E3%83%83%E3%82%AF%E4%B8%80%E8%A6%A7/pre_get_posts
 */
function my_post_only_query($query)
{
  if (!is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post__not_in', array(596)); // 特定ページのID
      $query->set('category__not_in', array(1)); // 特定カテゴリーのID
    }
  }
}
add_action('pre_get_posts', 'my_post_only_query');
