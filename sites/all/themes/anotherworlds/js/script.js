/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {
  var Agent = {
    ua : navigator.userAgent.toLowerCase()
  };

  Agent.isIE = (Agent.ua.indexOf("msie") != -1 && Agent.ua.indexOf("opera") == -1 && Agent.ua.indexOf("webtv") == -1);
  Agent.isIE8 = (Agent.ua.indexOf("msie 8.") != -1);
  Agent.isIE7 = (Agent.ua.indexOf("msie 7.") != -1);
  Agent.isIE6 = (Agent.ua.indexOf("msie 6.") != -1);
  Agent.isOpera = (Agent.ua.indexOf("opera") != -1);
  Agent.isGecko = (Agent.ua.indexOf("gecko") != -1);
  Agent.isSafari = (Agent.ua.indexOf("safari") != -1);
  Agent.isKonqueror = (Agent.ua.indexOf("konqueror") != -1);
  Agent.isChrome = (Agent.ua.indexOf("chrome") != -1);

  //  userAgent       
  var ua = navigator.userAgent.toLowerCase();
  //  Internet Explorer
  var isIE = (ua.indexOf("msie") != -1 && ua.indexOf("opera") == -1 && ua.indexOf("webtv") == -1);
  // Opera
  var isOpera = (ua.indexOf("opera") != -1);
  // Gecko = Mozilla + Firefox + Netscape
  var isGecko = (ua.indexOf("gecko") != -1);
  // Safari,   MAC OS
  var isSafari = (ua.indexOf("safari") != -1);
  // Konqueror,   UNIX-
  var isKonqueror = (ua.indexOf("konqueror") != -1);

  $(function() {
    // theme of day
    $('.themesOfDay .theme > div').hover(function(){
      if(!$(this).hasClass('show')) {
        $('.themesOfDay .theme > div').toggleClass('show', false);
        $(this).toggleClass('show', true);
        if(!Agent.isIE7 && !Agent.isIE6 && !Agent.isIE8) {
          $(this).find('.popup').css('opacity',0).animate({
            'opacity':1
          },300);
        }
      }
			
    });
    
    $("#back-top").hide();
    
    $(window).scroll(function () {
      if ( $(this).scrollTop() > 600 ) {
        $('#back-top').fadeIn();
      } else {
        $('#back-top').fadeOut('slow', function() {
          });
      }
    });
    
    $('#back-top a').click(function () {
      $('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });
    
  });

})(jQuery, Drupal, this, this.document);
