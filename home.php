<?php get_header(); ?>
<?php $wp_obj = get_queried_object();
?>

<main class="l-main l-under" role="main">

  <div class="l-under__breadcrumb">
    <?php create_breadcrumb(); ?>
  </div>
  <div class="l-under__header">
    <h1 class="c-title--center"><?php echo post_type_archive_title('', false); ?></h1>
  </div>

  <div class="l-under__content">

    <section class="l-section l-outer">
      <div class="l-section__inner l-inner">
        <div class="p-entries">
          <div class="p-entries__lists">
            <?php if (have_posts()) : ?>
              <?php while (have_posts()) : the_post(); ?>

                <?php
                $args = [
                  'term' => get_the_category()[0],
                  'tag' =>  get_the_tags()
                ];

                get_template_part('template-parts/content', 'archive', $args);
                ?>

              <?php endwhile; ?>
            <?php else : ?>
              <p>記事がありません。</p>
            <?php endif; ?>
          </div>
          <?php
          // デフォルトだとスクリーンリーダー用の要素が出力されるから、preg_replace()で消す
          $pagination = preg_replace(
            '/\<h2 class=\"screen-reader-text\"\>(.*?)\<\/h2\>/',
            '',
            get_the_posts_pagination(array(
              'mid_size' => 2, // 現在のページの左右に表示するページ番号の数
              'prev_text' => '',
              'next_text' => ''
            ))
          );
          if ($pagination) {
            echo '<div class="p-entries__pagination">';
            echo '  <div class="c-pagination">' . $pagination . '</div>';
            echo '</div>';
          }
          ?>
          <!-- ページネーション(数字あり) -->
          <div class="">
            <?php
            the_posts_pagination(array(
              'mid_size' => 1,
              'prev_text' => '前へ',
              'next_text' => '次へ',
            ));
            ?>
          </div>

          <!-- ページネーション(数字あり前後なし) -->
          <div class="">
            <?php
            the_posts_pagination(array(
              'mid_size' => 1,
              'prev_next' => false,
            ));
            ?>
          </div>

          <!-- ページネーション(前後のみ) -->
          <div class="">
            <div class="page-numbers prev">
              <?php previous_posts_link('前へ'); ?>
            </div>
            <div class="page-numbers next">
              <?php next_posts_link('次へ'); ?>
            </div>
          </div>

          <!-- ページネーション(前後を画像) -->
          <div class="">
            <?php
            the_posts_navigation(array(
              'prev_text' => '<img src="' . get_template_directory_uri() . '画像のパス">',
              'next_text' => '<img src="' . get_template_directory_uri() . '画像のパス">',
            ));
            ?>
          </div>

          <div class="pager">
            <ul class="pagerList">

              <?php
              if (function_exists('pagination')) {
                pagination($wp_query->max_num_pages, get_query_var('paged'));
              }
              if (function_exists('my_paging_nav')) {
                my_paging_nav($wp_query->max_num_pages, get_query_var('paged'));
              }
              if (function_exists('page_nation')) {
                page_nation($wp_query->max_num_pages, get_query_var('paged'));
              }
              if (function_exists('paginations')) {
                paginations($wp_query->max_num_pages, get_query_var('paged'));
              }
              ?>

            </ul>
          </div>
        </div>
      </div>
    </section>

  </div>

</main>

<?php get_footer(); ?>
