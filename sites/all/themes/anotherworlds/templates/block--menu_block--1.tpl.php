<?php
/**
 * @file
 * Returns the HTML for a block.
 *
 * Complete documentation for this file is available online.
 * @see http://drupal.org/node/1728246
 */
?>
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
	<?php print render($title_prefix); ?>
	<?php if ($title): ?>
		<h2<?php print $title_attributes; ?>><?php print $title; ?></h2>
	<?php endif; ?>
	<?php print render($title_suffix); ?>

	<div class="menu-block-wrapper menu-block-1 menu-name-main-menu parent-mlid-0 menu-level-1">
		<div id="cssmenu">
			<ul class="menu">
				<li class="menu--leaf first leaf menu-mlid-799">
					<a href="/space" title="" class="menu--link">Вести из космоса</a>
					<ul>
						<span class="ico_menu"></span>
						<li><a href="/space">АРХИВ ПОЛНОСТЬЮ</a></li>
						<?php print category_get_last_nodes(1529); ?>
					</ul>
				</li>
				<li class="menu--leaf leaf menu-mlid-800">
					<a href="/mystery" title="" class="menu--link">Загадки истории</a>
					<ul>
						<span class="ico_menu"></span>
						<li><a href="/mystery">АРХИВ ПОЛНОСТЬЮ</a></li>
						<?php print category_get_last_nodes(1528); ?>
					</ul>
				</li>
				<li class="menu--leaf leaf menu-mlid-801">
					<a href="/darkages" title="" class="menu--link">Из тьмы веков</a>
					<ul>
						<span class="ico_menu"></span>
						<li><a href="/darkages">АРХИВ ПОЛНОСТЬЮ</a></li>
						<?php print category_get_last_nodes(1530); ?>
					</ul>
				</li>
				<li class="menu--leaf leaf menu-mlid-718">
					<a href="/mistique" title="" class="menu--link">Мистические истории</a>
					<ul>
						<span class="ico_menu"></span>
						<li><a href="/mistique">АРХИВ ПОЛНОСТЬЮ</a></li>
						<?php print category_get_last_nodes(1526); ?>
					</ul>
				</li>
				<li class="menu--leaf leaf menu-mlid-802">
					<a href="/losttribes" title="" class="menu--link">Затерянные племена</a>
					<ul>
						<span class="ico_menu"></span>
						<li><a href="/losttribes">АРХИВ ПОЛНОСТЬЮ</a></li>
						<?php print category_get_last_nodes(3685); ?>
					</ul>
				</li>
				<li class="menu--leaf last leaf menu-mlid-803">
					<a href="/animals" title="" class="menu--link">Удивительные животные</a>
					<ul>
						<span class="ico_menu"></span>
						<li><a href="/animals">АРХИВ ПОЛНОСТЬЮ</a></li>
						<?php print category_get_last_nodes(3686); ?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
