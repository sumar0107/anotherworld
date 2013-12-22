<div id="page">
  <div id="main-wrap">
    <header class="header" id="header" role="banner">
      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header--logo" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header--logo-image" /></a>
        <a href="/why-repin" id="repin">А почему Repin?</a>
      <?php endif; ?>
      <?php if ($site_name || $site_slogan): ?>
        <div class="header--name-and-slogan" id="name-and-slogan">
          <?php if ($site_name): ?>
            <h1 class="header--site-name" id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" class="header--site-link" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <h2 class="header--site-slogan" id="site-slogan"><?php print $site_slogan; ?></h2>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php print render($page['banner']); ?>
      <div class="clear"></div>
      <div class="wrapp-header-1 clearfix">
        <div class="contacts">
          <a href="/contacts">Контакты</a>
        </div>
        <div class="time">
          Сегодня: <?php print format_date(time(), 'custom', 'd F Y', NULL, 'ru') . ' г.'; ?>
        </div>
        <?php if ($user->uid == 0): ?>
          <?php print _repin_block('login', 'user'); ?>
        <?php else: ?>
          <?php if ($secondary_menu): ?>
            <nav class="header--secondary-menu" id="secondary-menu" role="navigation">
              <?php
              print theme('links__system_secondary_menu', array(
                          'links' => $secondary_menu,
                          'attributes' => array(
                              'class' => array('links', 'inline', 'clearfix'),
                          ),
                          'heading' => array(
                              'text' => $secondary_menu_heading,
                              'level' => 'h2',
                              'class' => array('element-invisible'),
                          ),
                      ));
              ?>
            </nav>
          <?php endif; ?>
        <?php endif; ?>
        <div class="google-search">
          <span class="search-label">Введите запрос</span>
          <gcse:search></gcse:search>  
        </div>
      </div>
      <?php print render($page['header']); ?>

    </header>

    <div id="main">
      <?php //if(arg(0) != 'admin' && arg(2) != 'edit') : ?>
      <div id="google-adsense">
        <script type="text/javascript"><!--
          google_ad_client = "ca-pub-4826343892735691";
          /* Горизонтальный блок внизу страниц */
          google_ad_slot = "1119764169";
          google_ad_width = 970;
          google_ad_height = 90;
          //-->
        </script>
        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
      </div>
      <?php //endif; ?>

      <div id="content" class="column" role="main">
        <?php if (isset($category)) print $category; ?>
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
        <?php if (drupal_is_front_page()) { ?>
          <div id="front-top" class="clearfix">
            <?php
            print render($page['themeofday']);
            print render($page['front_banners']);
            ?>
          </div>
        <?php } ?>
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
    <?php //if(arg(0) != 'admin' && arg(2) != 'edit') : ?>
    <div id="teaser_add">
      <script type="text/javascript">
        var a2b5c40303f51d = 219470;
        var edb2600ee40c76 = 461897;
      </script>
      <script type="text/javascript" src="http://repin.info/c264264e08/teaser_add.js"></script>

    </div>
    <?php //endif; ?>
  </div>
</div>
<footer id="footer" class="<?php print $classes; ?>">
  <?php print render($page['footer']); ?>
  <?php print render($page['bottom']); ?>
  <div id="liveinternet">
    <!-- begin of Top100 code -->

    <script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?2867136"></script>
    <noscript>
    <a href="http://top100.rambler.ru/navi/2867136/">
      <img src="http://counter.rambler.ru/top100.cnt?2867136" alt="Rambler's Top100" border="0" />
    </a>

    </noscript>
    <!-- end of Top100 code -->

    <!--Rating@Mail.ru counter-->
      <script language="javascript"><!--
      d=document;var a='';a+=';r='+escape(d.referrer);js=10;//--></script>
      <script language="javascript1.1"><!--
      a+=';j='+navigator.javaEnabled();js=11;//--></script>
    <script language="javascript1.2"><!--
      s=screen;a+=';s='+s.width+'*'+s.height;
      a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;//--></script>
    <script language="javascript1.3"><!--
        js=13;//--></script><script language="javascript" type="text/javascript"><!--
      d.write('<a href="http://top.mail.ru/jump?from=1975534" target="_top">'+
        '<img src="http://d4.c2.be.a1.top.mail.ru/counter?id=1975534;t=224;js='+js+
        a+';rand='+Math.random()+'" alt="Рейтинг@Mail.ru" border="0" '+
          'height="31" width="88"><\/a>');if(11<js)d.write('<'+'!-- ');//--></script>
    <noscript><a target="_top" href="http://top.mail.ru/jump?from=1975534">
      <img src="http://d4.c2.be.a1.top.mail.ru/counter?js=na;id=1975534;t=224" 
           height="31" width="88" border="0" alt="Рейтинг@Mail.ru"></a></noscript>
      <script language="javascript" type="text/javascript"><!--
      if(11<js)d.write('--'+'>');//--></script>
    <!--// Rating@Mail.ru counter-->

    <!--LiveInternet counter--><script type="text/javascript"><!--
      document.write("<a href='http://www.liveinternet.ru/click' "+
        "target=_blank><img src='//counter.yadro.ru/hit?t16.6;r"+
        escape(document.referrer)+((typeof(screen)=="undefined")?"":
        ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
        screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
        ";"+Math.random()+
        "' alt='' title='LiveInternet: показано число просмотров за 24"+
        " часа, посетителей за 24 часа и за сегодня' "+
        "border='0' width='88' height='31'><\/a>")
      //--></script><!--/LiveInternet-->
  </div>
</footer>
<p id="back-top" style="display: none;"><a href="#uplift"><?php print theme('image', array('path' => '/' . $theme_path . '/images/up.png', 'alt' => '', 'title' => 'Наверх')); ?></a></p>

<?php if(isset($user->roles[4]) && $user->roles[4] == 'editor'){ ?>
<div id="admin-menu" style="position: fixed;">
  <div id="admin-menu-wrapper"><?php print $editor_admin_menu; ?></div>
  </div>
<?php } ?>