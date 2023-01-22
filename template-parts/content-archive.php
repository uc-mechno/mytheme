<?php
// デバッグ
$cat =  get_the_category();
print_r($cat);
// var_dump($cat);
?>

<article class="c-entry" id="post-<?php the_ID(); ?>">
  <div class="c-entry__thumb">
    <a href="<?php the_permalink(); ?>">
      <?php get_eyecatch_default($post->ID, 'medium'); ?>
    </a>
  </div>
  <div class="c-entry__meta">
    <div class="c-entry__header">

      <?php if ($args['term']) : ?>
        <div class="c-category-tip __<?php echo $args['term']->slug; ?>">
          <a href="<?php echo get_category_link($args['term']->term_id); ?>"><?php echo $args['term']->name; ?></a>
        </div>
      <?php endif; ?>

      <?php if ($args['tag']) :
        foreach ($args['tag'] as $tag) : ?>
          <div class="c-category-tip __<?php echo $tag->slug; ?>">
            <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <div class="c-entry__datetime">
        <time class="c-datetime" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
      </div>
    </div>
    <h2 class="c-entry__title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </div>
</article>
