<?php print $wrapper_prefix; ?>
<?php if (!empty($title)) : ?>
	<h3><?php print $title; ?></h3>
<?php endif; ?>
<div id="wowslider-container1">
	<div class="ws_images">
		<?php print $list_type_prefix; ?>
		<?php foreach ($rows as $id => $row): ?>
			<li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
		<?php endforeach; ?>
		<?php print $list_type_suffix; ?>
	</div>
	<div class="ws_bullets">
		<div>
			<?php foreach ($rows as $id => $row): ?>
				<a href="#" title=""><?= $id + 1; ?></a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="ws_shadow"></div>
</div>
<?php print $wrapper_suffix; ?>
