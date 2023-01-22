<?php get_header(); ?>
<?php $wp_obj = get_queried_object(); ?>

<?php var_dump($wp_obj); ?>

<main class="l-main l-under" role="main">

<div class="l-under__breadcrumb">
    <?php
    if (function_exists('create_breadcrumb')) {
      create_breadcrumb();
    }
    if (function_exists('breadcrumb')) {
      breadcrumb();
    }
    if (function_exists('the_breadcrumbs')) {
      the_breadcrumbs();
    }
    ?>
  </div>
  <div class="l-under__header">
    <h1 class="c-title--center">「<?php echo get_the_category()[0]->name; ?>」の記事一覧</h1>
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
                  'term' => get_the_category()[0]
                ];
                //@link https://hsmt-web.com/blog/wp-get-template-part/

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
        </div>
      </div>
    </section>

  </div>

</main>

<?php get_footer(); ?>
