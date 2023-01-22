<?php

/**
 * ************************************************************************
 *
 * 文字・画像などの関数
 *
 * ************************************************************************
 */

/**
 * タイトル文字数制限
 * ************************************************************************
 *
 * @param integer $limit 表示させる文字数。引数を指定しない場合は20
 * @example
 * <h1><?php new_line_title(10); ?></h1>
 */
function show_limit_title($limit = 20)
{
  global $post;
  $title = $post->post_title;

  if (mb_strlen($title) > $limit) {
    $title = mb_substr($title, 0, $limit);
    $show_title = $title . '･･･';
  } else {
    $show_title = $title;
  }

  echo $show_title;
}

/**
 * タイトルを改行
 * ************************************************************************
 *
 * @link https://junpei-sugiyama.com/title-new-line/
 * @example
 * <h1><?php new_line_title(); ?></h1>
 *
 */
function new_line_title()
{
  $title = get_the_title();
  $title = str_replace(" ", "<br>", $title);
  echo $title;
}

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

/**
 * メイン画像上にテンプレートごとの文字列を表示
 * ************************************************************************
 *
 * @example
 * <h2><?php echo esc_html(get_main_title()); ?></h2>
 */
function get_main_title()
{
  if (is_singular('post')) :
    $category_obj = get_the_category();
    return $category_obj[0]->name;
  elseif (is_page()) :
    return get_the_title();
  elseif (is_category() || is_tax()) :
    return single_cat_title();
  elseif (is_search()) :
    return ' サイト内検索結果';
  elseif (is_404()) :
    return ' ページが見つかりません';
  elseif (is_singular('daily_contribution')) :
    global $post;
    $term_obj = get_the_terms($post->ID, 'event');
    return $term_obj[0]->name;
  endif;
}

/**
 * メイン画像上にテンプレートごとの英語タイトルを表示
 * ************************************************************************
 *
 * @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/get_queried_object
 * @example
 * <span><?php echo esc_html(get_main_en_title()); ?></span>
 *
 */
function get_main_en_title()
{
  if (is_category()) :
    $term_obj = get_queried_object();
    $english_title = get_field('english_title', $term_obj->taxonomy . '_' . $term_obj->term_id);
    return $english_title;
  elseif (is_singular('post')) :
    $term_obj = get_the_category();
    $english_title = get_field('english_title', $term_obj[0]->taxonomy . '_' . $term_obj[0]->term_id);
    return $english_title;
  elseif (is_page() || is_singular('daily_contribution')) :
    return get_field('english_title');
  elseif (is_search()) :
    return 'Search Result';
  elseif (is_404()) :
    return '404 Not Found';
  elseif (is_tax()) :
    $term_obj = get_queried_object();
    $english_title = get_field('english_title', $term_obj->taxonomy . '_' . $term_obj->term_id);
    return $english_title;
  endif;
}


/**
 * アイキャッチ画像がなければ、ダミー画像を取得する
 * ************************************************************************
 *
 * @param string $sizeに画像のサイズを指定
 * 初期値：thumbnail
 * @param string $pathにダミー画像のパスを指定
 * 初期値：'/img/post-bg.jpg'
 * @return array $imgにterm_idを指定して取得して格納
 * @example
 * <?php $eyecatch = get_eyecatch_with_default(第一引数, 第二引数); ?>
 * <header style="background-image: url('<?php echo $eyecatch[0]; ?>')"></header>
 *
 */
function get_eyecatch_with_default($size = 'thumbnail', $path = '/img/post-bg.jpg')
{
  if (has_post_thumbnail()) :
    $id  = get_post_thumbnail_id();
    $img = wp_get_attachment_image_src($id, $size);
  else :
    $img = array(get_template_directory_uri() . $path);
  endif;

  return $img;
}

/**
 * アイキャッチ画像がなければ、ダミー画像を取得する
 * ************************************************************************
 *
 * @param string $idに投稿IDを指定
 * @param string $sizeに画像のサイズを指定
 * 初期値：thumbnail
 * @return array $imageにget_the_post_thumbnail()を指定して取得して格納
 * @example php
 * <?php get_eyecatch_default($post->ID, 'search'); ?>
 *
 * @example html
 * <img width="" height="" src="" class="" alt="" srcset="" sizes="">
 *
 */
function get_eyecatch_default($id, $size = 'thumbnail')
{
  $image = get_the_post_thumbnail($id,  $size);
  if ($image) :
    echo $image;
  else :
    echo '<img src="' . GET_PATH() . '/no-image.gif">';
  endif;

  return $image;
}

/**
 * 各テンプレートごとのメイン画像を表示
 * ************************************************************************
 *
 * @link https://wpdocs.osdn.jp/%E3%83%86%E3%83%B3%E3%83%97%E3%83%AC%E3%83%BC%E3%83%88%E3%82%BF%E3%82%B0/wp_get_attachment_image
 * @example php
 * <?php echo get_main_image(); ?>
 * @example html
 * <img width="" height="" src="" class="attachment-detail size-detail" alt="" loading="lazy">
 *
 */
function get_main_image()
{
  if (is_page() || is_singular('daily_contribution')) :
    $attachment_id = get_field('main_image');
    if (is_front_page()) :
      return wp_get_attachment_image($attachment_id, 'top');
    else :
      return wp_get_attachment_image($attachment_id, 'detail');
    endif;
  elseif (is_category('news') || is_singular('post')) :
    return '<img src="' . GET_PATH() . '/bg-page-news.jpg">';
  elseif (is_search() || is_404()) :
    return '<img src="' . GET_PATH() . '/bg-page-search.jpg">';
  elseif (is_tax('event')) :
    $term_obj = get_queried_object();
    $image_id = get_field('event_image', $term_obj->taxonomy . '_' . $term_obj->term_id);
    return wp_get_attachment_image($image_id, 'detail');
  else :
    return '<img src="' . GET_PATH() . '/bg-page-dummy.png">';
  endif;
}
