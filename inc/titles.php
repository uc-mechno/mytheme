<?php

/**
 * ************************************************************************
 *
 *  タイトルの設定
 *
 * ************************************************************************
 */

/**
 * <title>の区切り文字を変更
 * ************************************************************************
 */
function my_document_title_separator($sep)
{
  $sep = '|';
  return $sep;
}
add_filter('document_title_separator', 'my_document_title_separator');

/**
 * <title>のテキストの形式を変える
 * ************************************************************************
 */
function my_document_title_parts($title)
{
  if (is_home() || is_front_page()) {
    unset($title['tagline']);
  } else if (is_category()) {
    $title['title'] = '「' . single_term_title('', false) . '」カテゴリー一覧';
  } else if (is_tax()) {
    $title['title'] = '「' . single_term_title('', false) . '」カテゴリー一覧';
  } else if (is_tag()) {
    $title['title'] = '「' . single_term_title('', false) . '」タグ一覧';
  }
  return $title;
}
add_filter('document_title_parts', 'my_document_title_parts', 10, 1);
