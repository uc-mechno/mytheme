<?php

/**
 * ************************************************************************
 *
 * エディターの設定
 *
 * ************************************************************************
 */

/**
 * エディタのビジュアル・テキスト切替でコード消滅を防止
 * ************************************************************************
 */
function my_tiny_mce_before_init($init_array)
{

  global $allowedposttags;

  $init_array['valid_elements']          = '*[*]'; //すべてのタグを許可(削除されないように)
  $init_array['extended_valid_elements'] = '*[*]'; //すべてのタグを許可(削除されないように)
  $init_array['valid_children'] = '+a[' . implode('|', array_keys($allowedposttags)) . ']'; //aタグ内にすべてのタグを入れられるように
  $init_array['indent'] = true; //インデントを有効に
  $init_array['wpautop'] = false; //テキストやインライン要素を自動的にpタグで囲む機能を無効に
  $init_array['force_p_newlines'] = false; //改行したらpタグを挿入する機能を無効に

  return $init_array;
}
add_filter('tiny_mce_before_init', 'my_tiny_mce_before_init');

/**
 * 記事表示時の整形無効
 * ************************************************************************
 */
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

/**
 * 新規登録時にブロックを配置する
 * ************************************************************************
 * @link https://memocarilog.info/wordpress/9070
 */

function my_post_template()
{
  $post_obj = get_post_type_object('post');
  // get_post_type_object( 'post' )  → の部分で、設定をしたい投稿タイプのスラッグを記入
  $post_obj->template = [
    // h2タグを入れる
    ['core/heading', ['className' => 'myclass', 'level' => '2', 'content' => 'H2見出しダミーテキスト']],
    // 'core/heading' → 入れたいブロックのスラッグを記入
    // 'level' => '' → 見出しの場合タグの指定を記入
    // 'className' => '' → 指定しておきたいクラスがあれば記入
    // 'content' => ''  → 入力しておきたいテキストがあれば記入

    // h3タグを入れる
    ['core/heading', ['className' => 'myclass', 'level' => '3', 'content' => 'H3見出しダミーテキスト']],

    // pタグを入れる
    ['core/paragraph', ['className' => 'myclass', 'content' => 'pダミーテキスト']],

    // グループブロックで囲む
    ['core/group', ['className' => 'myclass'], [

      // h2タグを入れる
      ['core/heading', ['className' => 'myclass', 'level' => '2', 'content' => 'H2見出しダミーテキスト']],

      // pタグを入れる
      ['core/paragraph', ['className' => 'myclass', 'content' => 'pダミーテキスト']],
    ]],

  ];
}
add_action('init', 'my_post_template');
