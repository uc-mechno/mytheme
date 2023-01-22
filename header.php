<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <?php
  /* functions.phpで読み込み
  <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Vollkorn:400i" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo GET_PATH('css'); >/styles.css" />
  <script type="text/javascript" src="<?php echo GET_PATH('js'); >/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="<?php echo GET_PATH('js'); >/bundle.js"></script>
  */
  ?>

  <?php /* Base */ ?>
  <?php wp_head(); ?>
  <meta name="description" content="<?php bloginfo('description'); ?>">

  <?php /* Favicon */ ?>
  <link rel="shortcut icon" href="<?php echo GET_PATH(); ?>/favicon.ico">
  <link rel="apple-touch-icon" href="<?php echo GET_PATH(); ?>/apple-touch-icon.png">

  <?php /* Other */ ?>
  <link rel="canonical" href="<?php echo get_pagenum_link(1); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <?php /* noindex */ ?>
  <?php if (is_page('contact-thanks')) : ?>
    <meta name="robots" content="noindex,nofollow">
  <?php endif; ?>

  <?php if (is_user_logged_in()) : ?>
    <style type="text/css">
      .l-header {
        margin-top: 32px;
      }

      @media screen and (max-width:768px) {
        .l-header {
          margin-top: 46px
        }
      }
    </style>
  <?php endif; ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div class="l-wrapper">
    <header class="l-header" id="js-header">
      <div class="l-header__inner">
        <div class="l-header__meta">
          <div class="l-header__logo">
            <a href="<?php echo home_url(); ?>" class="c-logo">
              <img src="<?php echo GET_PATH(); ?>/logo.svg" alt="<?php bloginfo('name'); ?>" width="160" height="37">
            </a>
          </div>
        </div>
        <div class="l-header__nav">
          <div class="c-drawer" id="js-drawer-menu-nav">
            <nav class="c-nav" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
            <?php /* wp_get_nav_menu_itemsの使用に伴い削除
            wp_nav_menu(
              [
                'theme_location' => 'place_global',
                'container' => false,
              ]
            );
            */ ?>
              <ul class="c-nav__item">
                <?php
                $items = get_nav_menu('place_global');
                if (!$items == '') : ?>
                  <?php foreach ($items as $item) : ?>
                    <li class="c-nav__list">
                      <span itemprop="name">
                        <a href="<?php echo esc_attr($item->url); ?>"><?php echo esc_html($item->title); ?></a>
                      </span>
                    </li>
                  <?php endforeach; ?>
                <?php endif; ?>
              </ul>
            </nav>
            <div class="c-drawer__close-btn">
              <button type="button" class="c-close-btn" id="js-drawer-close-btn" title="メニューを閉じる"></button>
            </div>
          </div>
          <button type="button" class="c-hamburger-menu" id="js-drawer-open-btn" title="メニューを開く">
            <span></span>
          </button>
          <div class="c-cover-bg" id="js-drawer-menu-bg"></div>
          <div class="u-ml20 is-lg-hide">
            <?php get_template_part('template-parts/input', 'search', null); ?>
          </div>
        </div>
      </div>
    </header>

    <div class="l-container">
