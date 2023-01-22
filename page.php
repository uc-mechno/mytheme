<?php
// ContactForm7のpost以外でアクセスしたらTOPへリダイレクト
if (is_page('thanks')) {
  session_start();
  if (!isset($_SESSION['thanks_judge'])) {
    wp_safe_redirect(home_url());
    exit;
  } else {
    unset($_SESSION['thanks_judge']);
  }
}
?>

<?php get_header(); ?>

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
    <h1 class="c-title--center"><?php the_title(); ?></h1>
  </div>

  <div class="l-under__content">

    <section class="l-section l-outer">
      <div class="l-section__inner l-inner">

        <div class="c-tag-style">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
              <?php the_content(); ?>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>

      </div>
    </section>

  </div>

</main>

<?php get_footer(); ?>
