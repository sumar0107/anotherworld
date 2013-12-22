<div id="page">
	<div id="main-wrap">
		<div id="pre_header">
			<header class="header" id="header" role="banner">
				<?php if ($logo): ?>
					<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"
					   class="header--logo" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"
														   class="header--logo-image"/></a>
				<?php endif; ?>
				<?php if ($site_name || $site_slogan): ?>
					<div class="header--name-and-slogan" id="name-and-slogan">
						<?php if ($site_name): ?>
							<h1 class="header--site-name" id="site-name">
								<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"
								   class="header--site-link" rel="home"><span><?php print $site_name; ?></span></a>
							</h1>
						<?php endif; ?>
						<?php if ($site_slogan): ?>
							<h2 class="header--site-slogan" id="site-slogan"><?php print $site_slogan; ?></h2>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="time">
					Сегодня: <?php print format_date(time(), 'custom', 'd F Y', NULL, 'ru') . ' г.'; ?>
					<div class="holiday"><?php print _day(); ?></div>
				</div>
				<div class="wrapp-header-1 clearfix">
					<div class="akkaunt">

					</div>
					<div class="google-search">
						<span class="search-label">Введите запрос</span>
						<gcse:search></gcse:search>
					</div>
					<?php if ($user->uid == 0): ?>
						<?php print _anotherworlds_block('login', 'user'); ?>
					<?php else: ?>
						<?php if ($secondary_menu): ?>
							<nav class="header--secondary-menu" id="secondary-menu" role="navigation">
								<?php
								print theme('links__system_secondary_menu', array('links'      => $secondary_menu,
																				  'attributes' => array('class' => array('links', 'inline', 'clearfix'),
																				  ),
																				  'heading'    => array('text'  => $secondary_menu_heading,
																										'level' => 'h2',
																										'class' => array('element-invisible'),
																				  ),
																			));
								?>
							</nav>
						<?php endif; ?>
					<?php endif; ?>

				</div>
				<?php print render($page['header']); ?>

			</header>
		</div>
		<div id="main">
			<div id="google-adsense">

			</div>

			<div id="content" class="column" role="main">
				<?php if (isset($node_img)) print $node_img; ?>
				<?php if (isset($node_img2)) print $node_img2; ?>

				<?php print render($page['highlighted']); ?>
				<?php print $breadcrumb; ?>
				<a id="main-content"></a>
				<?php print render($title_prefix); ?>
				<?php if ($title && !empty($title)): ?>
					<h1 class="page--title title" id="page-title"><?php print $title; ?></h1>
				<?php endif; ?>
				<?php print render($title_suffix); ?>
				<?php print $messages; ?>
				<?php print render($tabs); ?>
				<?php print render($page['help']); ?>
				<?php if ($action_links): ?>
					<ul class="action-links"><?php print render($action_links); ?></ul>
				<?php endif; ?>
				<div id="front-top" class="clearfix"><?php if (isset($slideshow)) print $slideshow; ?></div>
				<?php print render($page['banner']); ?>
				<?php print render($page['content']); ?>
				<?php print $feed_icons; ?>

				<?php print render($page['frontco1']); ?>
				<?php print render($page['frontco2']); ?>
				<?php print render($page['frontco3']); ?>
				<?php print render($page['frontco4']); ?>
			</div>

			<?php
			// Render the sidebars to see if there's anything in them.
			$sidebar_first = render($page['sidebar_first']);
			$sidebar_second = render($page['sidebar_second']);
			?>

			<?php if ($sidebar_first || $sidebar_second): ?>
				<aside class="sidebars">
					<?php print $sidebar_first; ?>
					<?php print $sidebar_second; ?>
				</aside>
			<?php endif; ?>
		</div>
		<div id="teaser_add">

		</div>
	</div>
</div>
<footer id="footer" class="<?php print $classes; ?>">
	<?php print render($page['footer']); ?>
	<?php print render($page['bottom']); ?>
	<div id="liveinternet"></div>
</footer>
<p id="back-top" style="display: none;">
	<a href="#uplift"><?php print theme('image', array('path' => '/' . $theme_path . '/images/up.png', 'alt' => '', 'title' => 'Наверх')); ?></a>
</p>

<?php if (isset($user->roles[4]) && $user->roles[4] == 'editor') { ?>
	<div id="admin-menu" style="position: fixed;">
		<div id="admin-menu-wrapper"><?php print $editor_admin_menu; ?></div>
	</div>
<?php } ?>