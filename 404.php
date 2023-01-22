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
    <h1 class="c-title--center">404 Not Found.</h1>
  </div>

  <div class="l-under__content">

    <section class="l-section l-outer">
      <div class="l-section__inner l-inner">

        <div class="c-tag-style u-text-center">
          <p>お探しのページは見つかりませんでした。</p>
        </div>

      </div>
    </section>

  </div>

</main>

<?php get_footer(); ?>
