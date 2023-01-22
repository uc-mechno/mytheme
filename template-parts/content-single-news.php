        <div <?php post_class('news'); ?>>
          <time class="time"><?php the_time('Y.m.d'); ?></time>
          <p class='title'><?php the_title(); ?></p>
          <div class="news-body">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
          </div>
        </div>

        <div class="more-news">

          <?php
          $next_post = get_next_post();
          $prev_post = get_previous_post();
          if ($next_post) :
          ?>
            <div class="next">
              <a class="another-link" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">NEXT</a>
            </div>
          <?php
          endif;
          if ($prev_post) :
          ?>
            <div class="prev">
              <a class="another-link" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">PREV</a>
            </div>
          <?php endif; ?>

        </div>

        <div class="more-news">
          <!-- 前後をテキスト -->
          <?php the_post_navigation(array(
            'prev_text' => '前のページへ',
            'next_text' => '次のページへ',
          ));
          ?>
        </div>

        <div class="more-news">
          <!-- 前後を画像 -->
          <?php the_post_navigation(array(
            'prev_text' => '<img src="' . get_template_directory_uri() . '画像のパス">',
            'next_text' => '<img src="' . get_template_directory_uri() . '画像のパス">',
          ));
          ?>
        </div>
