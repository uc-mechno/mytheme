<?php get_header(); ?>
<div class="page-inner">
  <div class="page-main" id="pg-search">

    <form class="search-form" role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
      <div class="search-box">
        <input type="text" name="s" class="search-input" placeholder="キーワードを入力してください" value="<?php the_search_query(); ?>" />
        <button type="submit" class="button button-submit">検索</button>
      </div>
    </form>

    <div class="searchResult-wrapper">
      <?php if (get_search_query()) : ?>
        <div class="searchResult-head">
          <h3 class="title">「<?php the_search_query(); ?>」の検索結果</h3>
          <div class="total">全<?php echo $wp_query->found_posts; ?>件</div>
        </div>
      <?php endif; ?>
      <ul class="searchResultLlist">
        <?php
        if (have_posts() && get_search_query()) :
          while (have_posts()) : the_post();
        ?>
            <li class="searchResultLlist-item">
              <a href="<?php the_permalink(); ?>">
                <div class="item-wrapper">
                  <div class="image">

                    <?php /*
                    $image = get_the_post_thumbnail($post->ID, 'search');
                    if ($image) :
                      echo $image;
                    else :
                      echo '<img src="' . get_template_directory_uri() . '/assets/images/img-noImage.png">';
                    endif;
                   */ ?>

                    <?php get_eyecatch_default($post->ID, 'search'); ?>

                  </div>
                  <dl>
                    <dt><?php the_title(); ?></dt>
                    <dd class="description"><?php echo get_the_excerpt(); ?></dd>
                  </dl>
                </div>
              </a>
            </li>
          <?php endwhile; ?>
      </ul>

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

    <?php elseif (!get_search_query()) : ?>
      <p> 検索ワードが入力されていません</p>
    <?php else : ?>
      <p> 該当する記事は見つかりませんでした。</p>
    <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
