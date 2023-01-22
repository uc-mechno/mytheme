<?php

/**
 * ************************************************************************
 *
 * ウィジェットの設定
 *
 * ************************************************************************
 */

/**
 * ウィジェットの登録
 * ************************************************************************
 */
function my_widgets_init()
{
  register_sidebar([
    'name' => ' サイドバーウィジェットエリア',
    'id' => 'primary-widget-area',
    'description' => ' 固定ページのサイドバー',
    'before_widget' => '<aside class="side-inner">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="title">',
    'after_title' => '</h4>',
  ]);
}
add_action('widgets_init', 'my_widgets_init');
