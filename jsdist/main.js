/*!
 *
 * main.js for taitravis.com
 *
 */
 (function ($, document, window) {

  $(document).on('colorbox.open', function(e, name) {
    $(document.body).addClass('colorbox-open');
  });

  $(document).on('colorbox.close', function(e, d) {
    $(document.body).removeClass('colorbox-open');
  });

  $(document).on('nav.toggle', function(e, d) {
    $(document.body).toggleClass('nav-open');
  });


  $('.colorbox-trigger').on('click', function(e, d) {

    var $self = $(this);
    var name = $self.data('name')||'nope';
    e.preventDefault();
    launchColorbox($self);
  });

    /* NAV */
  $('.w-icon-nav-menu').on('click', function(e){
    $(document).trigger('nav.toggle');
  })

  /* Project trigger */
  $('.project-trigger').on('click', function(e, d) {
    var $self = $(this);
    var name = 'project';
    e.preventDefault();
    launchColorbox($self);
  });

  function launchColorbox($self) {
    $self.colorbox({
    href: function() {
      if($self.attr('href')) {
        return $self.attr('href') + ' .page';
      } else {
        return $self.data('href') + ' .page';
      }
    },
    onOpen: function(){ $(document).trigger('colorbox.open', name)},
    onClosed: function(){ $(document).trigger('colorbox.close', name)},
    maxWidth: "100%"
  });

  }
}(jQuery, document, window));

/*
REF (from webflow.js)
  // Feature detects + browser sniffs  à² _à²
  var userAgent = navigator.userAgent.toLowerCase();
  var appVersion = navigator.appVersion.toLowerCase();
  var touch = Webflow.env.touch = ('ontouchstart' in window) || window.DocumentTouch && document instanceof window.DocumentTouch;
  var chrome = Webflow.env.chrome = /chrome/.test(userAgent) && /Google/.test(navigator.vendor) && parseInt(appVersion.match(/chrome\/(\d+)\./)[1], 10);
  var ios = Webflow.env.ios = Modernizr && Modernizr.ios;
  Webflow.env.safari = /safari/.test(userAgent) && !chrome && !ios;

*/
