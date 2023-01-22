<?php

/**
 * ************************************************************************
 *
 * カスタムメニューの設定
 *
 * ************************************************************************
 */

/**
 * wp_nav_menuのaにclass追加
 * @link https://webutubutu.com/webdesign/3692
 * wp_get_nav_menu_itemsを使う場合は使わなくてよい
 */
/*
function description_in_nav_menu($item_output, $item)
{
  return preg_replace('/(<a.*?)/', '$1' . " class='nav-link'", $item_output);
}
add_filter('walker_nav_menu_start_el', 'description_in_nav_menu', 10, 4);
*/
