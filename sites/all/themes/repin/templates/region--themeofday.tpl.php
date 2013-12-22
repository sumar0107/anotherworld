<?php
$view = views_get_view('theme_of_day');
$view->set_display('block');
$view->pre_execute();
$view->execute();
$count = count($view->result);

?>
<table class="themesOfDay micons">
<?php foreach ($view->result as $key => $item): ?>
    <tr>
      <?php if($key == 0) { ?>
      <td class="photo" rowspan="3"></td>
      <?php } ?>
      <td class="theme">
        <div name="t<?php print ($key + 1); ?>" class="<?php if($key == 0) { ?>show<?php } ?>">
          <div class="popup t<?php print ($key + 1); ?>">
            <div class="arrow"></div>
            <?php print drupal_render($item->field_field_img[0]['rendered']); ?>
          </div>
          <div class="mask">
            <h2><?php print l($item->node_title, 'node/' . $item->nid); ?><div class="white_grad"></div></h2>
            <div class="shortText"><?php print drupal_render($item->field_body[0]['rendered']); ?></div>
            <div class="articleInfoMini">
              <div class="date"><span></span> <?php print format_date($item->node_created, 'custom', 'd-m-Y'); ?></div>
  <?php //<div class="views"><span></span> 104</div>  ?>
              <div class="cat"><span class="space"></span> <?php print drupal_render($item->field_field_category[0]['rendered']); ?></div>
            </div>
          </div>
        </div>
      </td>
    </tr>
<?php endforeach; ?>
</table>