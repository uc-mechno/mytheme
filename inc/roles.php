<?php

/**
 * ************************************************************************
 *
 * 権限グループの設定
 *
 * ************************************************************************
 *
 */

/**
 * 権限グループ「カスタム編集者」を追加
 * ************************************************************************
 * @link https://blog.e2info.co.jp/2022/09/06/wordpress_add_roles/
 */
/*
function add_custom_roll()
{
  global $wp_roles;
  if (empty($wp_roles)) {
    $wp_roles = new WP_Roles();
  }

  // 権限グループの追加
  $wp_roles->add_role('custom_editor', 'カスタム編集者', []);

  // カスタムユーザー権限を付与
  $wp_roles->add_cap('custom_editor', 'export');
  $wp_roles->add_cap('custom_editor', 'import');

  // デフォルトユーザー権限を付与
  $wp_roles->add_cap('custom_editor', 'delete_others_pages');
  $wp_roles->add_cap('custom_editor', 'delete_others_posts');
  $wp_roles->add_cap('custom_editor', 'delete_pages');
  $wp_roles->add_cap('custom_editor', 'delete_posts');
  $wp_roles->add_cap('custom_editor', 'delete_private_pages');
  $wp_roles->add_cap('custom_editor', 'delete_private_posts');
  $wp_roles->add_cap('custom_editor', 'delete_published_pages');
  $wp_roles->add_cap('custom_editor', 'delete_published_posts');
  $wp_roles->add_cap('custom_editor', 'delete Reusable Blocks');
  $wp_roles->add_cap('custom_editor', 'edit_others_pages');
  $wp_roles->add_cap('custom_editor', 'edit_others_posts');
  $wp_roles->add_cap('custom_editor', 'edit_pages');
  $wp_roles->add_cap('custom_editor', 'edit_posts');
  $wp_roles->add_cap('custom_editor', 'edit_private_pages');
  $wp_roles->add_cap('custom_editor', 'edit_private_posts');
  $wp_roles->add_cap('custom_editor', 'edit_published_pages');
  $wp_roles->add_cap('custom_editor', 'edit_published_posts');
  $wp_roles->add_cap('custom_editor', 'create Reusable Blocks');
  $wp_roles->add_cap('custom_editor', 'edit Reusable Blocks');
  $wp_roles->add_cap('custom_editor', 'manage_categories');
  $wp_roles->add_cap('custom_editor', 'manage_links');
  $wp_roles->add_cap('custom_editor', 'moderate_comments');
  $wp_roles->add_cap('custom_editor', 'publish_pages');
  $wp_roles->add_cap('custom_editor', 'publish_posts');
  $wp_roles->add_cap('custom_editor', 'read');
  $wp_roles->add_cap('custom_editor', 'read_private_pages');
  $wp_roles->add_cap('custom_editor', 'read_private_posts');
  $wp_roles->add_cap('custom_editor', 'unfiltered_html');
  $wp_roles->add_cap('custom_editor', 'upload_files');
}
add_action('init', 'add_custom_roll');
*/

/**
 * 追加した権限グループを削除
 * ************************************************************************
 *
 * 追加権限はデータベースにの残るので、使わなくなったらremove_roleで消す
 *
 * @link https://mmcd-web.sounds-stella.jp/8848/add-wp-user-role/
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/remove_role
 */
/*
remove_role( 'custom_editor' );
*/
