<?php get_header(); ?>

<?php
$term = get_the_terms($post->ID, 'news-cat')[0];
$term_name = $term->name;
$term_slug = $term->slug;
$term_link = get_term_link($term_slug, 'news-cat');
?>

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

  <div class="l-under__content">

    <div class="l-section l-outer">
      <div class="l-section__inner l-inner">
        <div class="p-post">
          <div class="p-post__main">
            <h1 class="c-title p-post__title"><?php the_title(); ?></h1>
            <div class="p-post__thumb">
              <?php
              if (get_the_post_thumbnail()) {
                the_post_thumbnail('full');
              } else {
                echo '<img src="' . GET_PATH() . '/no-image.jpg" alt="">';
              }; ?>
            </div>
            <div class="p-post__meta">
              <div class="p-post__category c-category-tip __<?php echo $term_slug; ?>">
                <a href="<?php echo $term_link; ?>"><?php echo $term_name; ?></a>
              </div>
              <div class="p-post__datetime">
                <time class="c-datetime" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
              </div>
            </div>
            <div <?php post_class('p-post__content c-tag-style'); ?>>
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>

                  <?php get_template_part('template-parts/content', 'single-news'); ?>

                <?php endwhile; ?>
              <?php endif; ?>
            </div>
          </div>

          <aside class="p-post__sidebar">
            <?php get_template_part('sidebar'); ?>
          </aside>

        </div>
      </div>
    </div>

  </div>

</main>

<?php get_footer(); ?>
