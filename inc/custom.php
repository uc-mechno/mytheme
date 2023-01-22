<?php

/**
 * ************************************************************************
 *
 * その他関数
 *
 * ************************************************************************
 */

/**
 * 子ページを出力する関数
 * ************************************************************************
 *
 * @param int $numberに記事数を指定
 * 初期値：-1
 * @param int $specified_idに現在表示している記事のIDを指定
 * 初期値：null
 * @return object $child_pagesにWP_Queryを格納
 * @example
 *  <?php $sample_pages = get_child_pages(第一引数, 第二引数);
 *  if ($sample_pages->have_posts()) :
 *    while ($sample_pages->have_posts()) : $sample_pages->the_post();
 *
 *      ここに回す記事
 *
 *    endwhile;
 *    wp_reset_postdata();
 *  endif; ?>
 *
 */
function get_child_pages($number = -1, $specified_id = null)
{
  //isset関数で変数に値ががセットされているか判定
  if (isset($specified_id)) :   //値がセットされていたら
    $parent_id = $specified_id; //$parent_id にIDを格納
  //値がセットされていなかったら
  else :
    $parent_id = get_the_ID();  //現在表示している記事のIDを $parent_id に格納
  endif;

  $args = [
    'posts_per_page' => $number, //記事数
    'post_type' => 'page',       //投稿タイプ
    'orderby' => 'menu_order',   //並び順
    'order' => 'ASC',            //昇順or降順
    'post_parent' => $parent_id, //親IDの指定（get_the_ID()を直接指定しても良い）
  ];
  $child_pages = new WP_Query($args);
  return $child_pages;
}

/**
 * 特定の記事を出力する関数
 * ************************************************************************
 *
 * @param int $post_typeに投稿タイプを指定
 * @param int $taxonomyにタクソノミー名を指定
 * 初期値：null
 * @param int $termにターム名を指定
 * 初期値：null
 * @param int $numberに記事数を指定
 * 初期値：-1
 * @return object $specific_postsにWP_Queryを格納
 * @example
 *  <?php $term = get_specific_posts(第一引数, 第二引数, 第三引数, 第四引数);
 *  if ($term->have_posts()) :
 *    while ($term->have_posts()) : $term->the_post();
 *
 *      ここに回す記事
 *
 *    endwhile;
 *    wp_reset_postdata();
 *  endif; ?>
 *
 */
function get_specific_posts($post_type, $taxonomy = null, $term = null, $number = -1)
{
  //taxonomy.php などには $term に自動的にタームのスラッグなどの情報が格納される
  // $term が null 以外だった場合
  if (!$term) :
    $terms_obj = get_terms($taxonomy);         //$terms_obj にタームを格納
    $term = wp_list_pluck($terms_obj, 'slug'); //$term に $terms_obj に格納して特定のオブジェクトの値を格納
  endif;

  $args = [
    'post_type' => $post_type,   //投稿タイプ
    //カスタム投稿をタームで絞り込み
    'tax_query' => [
      [
        'taxonomy' => $taxonomy, //タクソノミータイプ
        'field' => 'slug',       //タクソノミータームの種類
        'terms' => $term,        //表示するカテゴリー
      ],
    ],
    'posts_per_page' => $number, //記事数
  ];
  $specific_posts = new WP_Query($args);
  return $specific_posts;
}

/**
 * カスタムメニューを柔軟に使用する
 * ************************************************************************
 *
 * @param string $nameに該当するメニュー名を指定する
 * @return object $menu_itemsにterm_idを指定して取得して格納
 *
 * @link https://connect-solution.net/jp/2020/09/28/wordpress%E3%80%80get_nav_menu%E3%81%AB%E5%AF%BE%E3%81%99%E3%82%8B%E8%80%83%E5%AF%9F/
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wp_get_nav_menu_items
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wp_get_nav_menu_items
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wp_get_nav_menu_items
 * @example
 * <?php
 * $items = get_nav_menu('place_global');
 * foreach ($items as $item) : ?>
 *   <li class="menu-item">
 *     <a class="nav-link" href="<?php echo esc_attr($item->url); ?>"><?php echo esc_html ($item->title); ?></a>
 *   </li>
 *<?php endforeach; ?>
 *
 */
function get_nav_menu($name)
{
  $menu_name  = $name;                                          // メニュー名
  $locations  = get_nav_menu_locations();                       // メニューを取得
  $menu       = wp_get_nav_menu_object($locations[$menu_name]); // ナビゲーションの情報を取得
  $menu_items = wp_get_nav_menu_items($menu->term_id);          // term_idを指定して取得

  return $menu_items;
}

/**
 * PCとSPの表示切り替えを設置する関数
 * ************************************************************************
 * cssで display: none; を使って切り替えるより読み込み速度が早い
 *
 * @link https://webfun-style.com/localization-wordpress/
 * @return boolean $browser ユーザエージェントを判定
 * @example
 * if(is_sp()){
 * SPで表示したいものを書く
 * }else{
 * PCで表示したいものを書く
 * }
 *
 */
function is_sp()
{
  $ua = $_SERVER['HTTP_USER_AGENT'];
  $browser = ((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPod') !== false) || (strpos($ua, 'Android') !== false));
  if ($browser == true) {
    $browser = 'sp';
  }
  return ($browser == 'sp');
}

/**
 * 投稿アーカイブページの作成
 * ************************************************************************
 */
/*
function my_post_has_archive( $args, $post_type ) {
	if ('post' === $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'posts'; // スラッグを指定（これがURLになる）
	}
	return $args;
}
add_filter('register_post_type_args', 'my_post_has_archive', 10, 2);
*/
