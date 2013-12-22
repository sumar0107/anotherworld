<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see http://drupal.org/node/1728164
 */
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted): ?>
        <p class="submitted">
          <?php print $user_picture; ?>
          <?php print $submitted; ?>
        </p>
      <?php endif; ?>

      <?php if ($unpublished): ?>
        <mark class="unpublished"><?php print t('Unpublished'); ?></mark>
      <?php endif; ?>
    </header>
  <?php endif; ?>
  <div class="clearfix">
  <?php
  
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);
  hide($content['field_tags']);
  hide($content['field_field_autohs']);
  hide($content['field_img']);
  hide($content['field_raiting']);
  print render($content['field_img']);
  print '<h1 id="page-title">' . $title . '</h1>';
  print render($content);
  ?>
  </div>
  <?php if(isset($node->field_category) && !empty($node->field_category)): ?>
  <div class="articleInfo clearfix">
    <div title="дата публикации" class="date">
      <span></span> 
      <?php print format_date($node->created, 'custom', 'd.m.Y'); ?>
    </div>

    <div class="rating">
      <div class="share">
        <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki"></div> 
      </div>

    </div>
  </div>
  <?php endif; ?>
  <div class="clearfix">
    <?php print render($content['field_raiting']); ?>
    <?php print render($content['field_field_autohs']); ?>
    <?php print render($content['field_tags']); ?>
  </div>
  <div class="stats"><?php print render($content['links']); ?></div>
  <?php print render($content['comments']); ?>
</article>
