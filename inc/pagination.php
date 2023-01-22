<?php

/**
 * ************************************************************************
 *
 * ページネーションの設定
 *
 * ************************************************************************
 */

/**
 * ページネーション出力関数
 * ************************************************************************
 * $paged : 現在のページ
 * $pages : 全ページ数
 * $range : 左右に何ページ表示するか
 * $show_only : 1ページしかない時に表示するかどうか
 * @see https://wemo.tech/978
 * @see https://gokansoichiro.com/blog/page-nation/
 */
function pagination($pages, $paged, $range = 2, $show_only = false)
{

  $pages = (int) $pages; //float型で渡ってくるので明示的に int型 へ
  $paged = $paged ?: 1; //get_query_var('paged')をそのまま投げても大丈夫なように

  //表示テキスト
  $text_first = "« 最初へ";
  $text_before = "‹ 前へ";
  $text_next = "次へ ›";
  $text_last = "最後へ »";

  if ($show_only && $pages === 1) {
    // １ページのみで表示設定が true の時
    echo '<div class="pagination"><span class="current pager">1</span></div>';
    return;
  }

  if ($pages === 1) return; // １ページのみで表示設定もない場合

  if (1 !== $pages) {
    //２ページ以上の時
    echo '<div class="pagination"><span class="page_num">Page ', $paged, ' of ', $pages, '</span>';
    if ($paged > $range + 1) {
      // 「最初へ」 の表示
      echo '<a href="', get_pagenum_link(1), '" class="first">', $text_first, '</a>';
    }
    if ($paged > 1) {
      // 「前へ」 の表示
      echo '<a href="', get_pagenum_link($paged - 1), '" class="prev">', $text_before, '</a>';
    }
    for ($i = 1; $i <= $pages; $i++) {

      if ($i <= $paged + $range && $i >= $paged - $range) {
        // $paged +- $range 以内であればページ番号を出力
        if ($paged === $i) {
          echo '<span class="current pager">', $i, '</span>';
        } else {
          echo '<a href="', get_pagenum_link($i), '" class="pager">', $i, '</a>';
        }
      }
    }
    if ($paged < $pages) {
      // 「次へ」 の表示
      echo '<a href="', get_pagenum_link($paged + 1), '" class="next">', $text_next, '</a>';
    }
    if ($paged + $range < $pages) {
      // 「最後へ」 の表示
      echo '<a href="', get_pagenum_link($pages), '" class="last">', $text_last, '</a>';
    }
    echo '</div>';
  }
}

/**
 * ページネーション出力関数
 * ************************************************************************
 * @see https://tatuking.com/wp-pagination-create/
 */
function my_paging_nav()
{
  //グローバル変数を宣言
  global $wp_query, $wp_rewrite;

  // ページ数が2より小さかったらページネーションを表示しない
  if ($wp_query->max_num_pages < 2) {
    return;
  }
  // ページがあればページ数を取得、なければ1を入れる
  $paged        = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
  // パーマリンクの設定をしていたら、それに従い表示する。デフォルトなら「?paged=%#%」で表示する
  $format  = $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

  //ページネーションの設定
  $links = paginate_links(array(
    'base'     => get_pagenum_link() . '%_%', //URLのベース
    'format'   => $format, //ページネーションのリンクの構造
    'total'    => $wp_query->max_num_pages, //ページ数（全ページを指定）
    'current'  => $paged, //現在のページの位置
    'mid_size' => 1, //現在のページの両側に表示する数
    'prev_text' => '前へ',
    'next_text' => '次へ',
  ));

  if ($links) :

?>
    <!-- 表示されるHTMLの構想（お好みで変更してね） -->
    <nav role="navigation">
      <ul class="page-numbers">
        <li><?php echo $links; ?></li>
      </ul>
    </nav>
<?php endif;
}

/**
 * ページネーション出力関数
 * ************************************************************************
 * @see https://since-inc.jp/blog/8506
 */
function page_nation($pages = '', $range = 2)
{
  $showitems = ($range * 1) + 1;
  global $paged;
  if (empty($paged)) $paged = 1;
  if ($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if (!$pages) {
      $pages = 1;
    }
  }
  if (1 != $pages) {
    // 画像を使う時用に、テーマのパスを取得
    $img_pass = get_template_directory_uri();
    echo "<div class=\"m-pagenation\">";
    // 「1/2」表示 現在のページ数 / 総ページ数
    // echo "<div class=\"m-pagenation__result\">". $paged."/". $pages."</div>";
    // 「前へ」を表示
    // if($paged > 1) echo "<div class=\"m-pagenation__prev\"><a href='".get_pagenum_link($paged - 1)."'>前へ</a></div>";
    // ページ番号を出力
    echo "<ol class=\"m-pagenation__body\">\n";
    for ($i = 1; $i <= $pages; $i++) {
      if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
        echo ($paged == $i) ? "<li class=\"-current\">" . $i . "</li>" : // 現在のページの数字はリンク無し
          "<li><a href='" . get_pagenum_link($i) . "'>" . $i . "</a></li>";
      }
    }
    // [...] 表示
    // if(($paged + 4 ) < $pages){
    //     echo "<li class=\"notNumbering\">...</li>";
    //     echo "<li><a href='".get_pagenum_link($pages)."'>".$pages."</a></li>";
    // }
    echo "</ol>\n";
    // 「次へ」を表示
    // if($paged < $pages) echo "<div class=\"m-pagenation__next\"><a href='".get_pagenum_link($paged + 1)."'>次へ</a></div>";
    echo "</div>\n";
  }
}

/**
 * ページネーション出力関数
 * ************************************************************************
 * @see https://code-step.com/wp-pagination/
 */
function paginations($pages = '', $range = 2)
{
  $showitems = ($range * 2) + 1;

  // 現在のページ数
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }

  // 全ページ数
  if ($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if (!$pages) {
      $pages = 1;
    }
  }

  // ページ数が2ぺージ以上の場合のみ、ページネーションを表示
  if (1 != $pages) {
    echo '<div class="pagination">';
    echo '<ul>';
    // 1ページ目でなければ、「前のページ」リンクを表示
    if ($paged > 1) {
      echo '<li class="prev"><a href="' . esc_url(get_pagenum_link($paged - 1)) . '">前のページ</a></li>';
    }

    // ページ番号を表示（現在のページはリンクにしない）
    for ($i = 1; $i <= $pages; $i++) {
      if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
        if ($paged == $i) {
          echo '<li class="active">' . $i . '</li>';
        } else {
          echo '<li><a href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a></li>';
        }
      }
    }

    // 最終ページでなければ、「次のページ」リンクを表示
    if ($paged < $pages) {
      echo '<li class="next"><a href="' . esc_url(get_pagenum_link($paged + 1)) . '">次のページ</a></li>';
    }
    echo '</ul>';
    echo '</div>';
  }
}
