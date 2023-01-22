<?php get_header(); ?>

<main class="l-main __index" role="main">

  <div class="l-section p-mv">
    <div class="l-section__inner p-mv__inner">
      <div class="p-mv__meta">
        <h1 class="p-mv__title"><?php bloginfo('name'); ?></h1>
        <p class="p-mv__caption">WordPress base theme.</p>
      </div>
      <div class="p-mv__bg" style="background-image: url(https://picsum.photos/id/1019/5472/3648);"></div>
    </div>
  </div>

  <!-- <section class="l-section p-___">
    <div class="l-section__inner">

    </div>
  </section> -->

  <section class="l-section p-top-〇〇">
    <div class="l-section__inner p-top-〇〇__inner">

      <?php
      $company_obj = get_page_by_path('company');
      $post = $company_obj;
      setup_postdata($post);
      $company_title = get_the_title();
      ?>

      <h2><?php echo esc_html($company_title); ?></h2>

      <?php wp_reset_postdata(); ?>

      <ul class="p-top-〇〇__item">

        <?php if (function_exists('get_child_pages')) : ?>

          <?php $company_pages = get_child_pages(4, $company_obj->ID); ?>
          <?php if ($company_pages->have_posts()) : ?>
            <?php while ($company_pages->have_posts()) : $company_pages->the_post(); ?>

              <li class="p-top-〇〇__list">
                <a href="<?php the_permalink(); ?>">
                  <div class="p-top-〇〇__image">
                    <?php get_eyecatch_default($post->ID, 'full'); ?>
                  </div>
                  <div class="p-top-〇〇__body">
                    <h3 class="p-top-〇〇__title"><?php the_title(); ?></h3>
                  </div>
                </a>
              </li>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>

        <?php endif; ?>

      </ul>
    </div>
  </section>

  <section class="l-section">
    <div class="l-section__inner">

    <h2>
      <span>タイトル</span>
    </h2>

      <?php $contribution_pages = get_specific_posts('daily_contribution', 'event', '', 3); ?>
      <?php if ($contribution_pages->have_posts()) : ?>
        <?php while ($contribution_pages->have_posts()) : $contribution_pages->the_post(); ?>

          <article class="c-card">
            <a href="<?php the_permalink(); ?>">
              <div class="c-card__inner">
                <div class="c-card__image">
                  <?php get_eyecatch_default($post->ID, 'full'); ?>
                </div>
                <div class="c-card__body">
                  <h3 class="c-card__title"><?php the_title(); ?></h3>
                  <p class="c-card__text"><?php echo get_the_excerpt(); ?></p>
                </div>
              </div>
            </a>
          </article>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>

    </div>
  </section>

  <section class="l-section">
    <div class="l-section__inner">

      <?php $news_pages = get_specific_posts('news', 'news-cat', '', 3); ?>
      <?php if ($news_pages->have_posts()) : ?>
        <?php while ($news_pages->have_posts()) : $news_pages->the_post(); ?>

          <article class="c-card">
            <a href="<?php the_permalink(); ?>">
              <div class="c-card__inner">
                <div class="c-card__image">
                  <?php get_eyecatch_default($post->ID, 'full'); ?>
                </div>
                <div class="c-card__body">
                  <h3 class="c-card__title"><?php the_title(); ?></h3>
                  <p class="c-card__text"><?php echo get_the_excerpt(); ?></p>
                </div>
              </div>
            </a>
          </article>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php get_footer(); ?>
