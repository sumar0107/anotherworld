<div id="taxonomy-term-<?php print $term->tid; ?>" class="<?php print $classes; ?>">
  <div class="category-title tags">
    <h1 class="<?php print $class_h1; ?>"><span class="icons"></span><?php print $term->name; ?></h1>
    <span class="arrow">→</span>
    <span class="arhive">Архив материалов</span>
  </div>  

  <?php if (render($content) != ''): ?>
    <div class="content">
      <?php print render($content); ?>
    </div>
  <?php endif; ?>
</div>
