<?php

/**
 * ************************************************************************
 *
 *  抜粋の設定
 *
 * ************************************************************************
 */

/**
 * 記事の抜粋の末に付く文字列の設定
 * ************************************************************************
 *
 * @return string ... を出力.
 * @example
 * <h1><?php new_line_title(); ?></h1>
 *
 */
function cms_excerpt_more()
{
  return '...';
}
add_filter('excerpt_more', 'cms_excerpt_more');

/**
 * 記事の抜粋の文字数の設定
 * ************************************************************************
 *
 * @return string 文字数を出力.
 * @example
 * <h1><?php new_line_title(); ?></h1>
 *
 */
function cms_excerpt_length()
{
  return 80;
}
add_filter('excerpt_mblength', 'cms_excerpt_length');

/**
 * 記事の抜粋の文字数の設定
 * ************************************************************************
 *
 * @param string $number 抜粋対象の文字列をwp_trim_words()の第二引数に格納.
 * @return string 文字数調整した文字列を出力.
 * @link wp_trim_words() https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wp_trim_words
 * @example
 * <h1><?php new_line_title(); ?></h1>
 *
 */
function get_flexible_excerpt($number)
{
  $value = get_the_excerpt();
  $value = wp_trim_words($value, $number, '...');
  return $value;
}

/**
 * get_the_excerptで取得する抜粋の改行を有効にする
 * ************************************************************************
 *
 * @param string $value 抜粋文.
 * @return string $value 改行が有効化された抜粋文.
 * @example
 * <h1><?php new_line_title(); ?></h1>
 *
 */
function apply_excerpt_br($value)
{
  return nl2br($value);
}
add_filter('get_the_excerpt', 'apply_excerpt_br');
