</div>

<footer class="p-footer">
  <div class="c-sitemap">
    <?php /* wp_get_nav_menu_itemsの使用に伴い削除
        wp_nav_menu(
          [
            'theme_location' => 'place_footer',
            'container' => false,
          ]
        );
      */ ?>

    <ul class="c-sitemap__item">
      <?php
      $items = get_nav_menu('place_footer');
      if (!$items == '') : ?>
        <?php foreach ($items as $item) : ?>
          <li class="c-sitemap__list">
            <span itemprop="name">
              <a href="<?php echo esc_attr($item->url); ?>"><?php echo esc_html($item->title); ?></a>
            </span>
          </li>
        <?php endforeach; ?>
      <?php endif; ?>
    </ul>
  </div>

  <div class="p-footer__copyright">
    <small>&copy; <?php echo date_i18n(__('Y', 'blankslate')); ?> <?php echo get_bloginfo('name'); ?></small>
  </div>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>
