$(document).foundation();

// Patch for a Bug in v6.3.1
$(window).on('changed.zf.mediaquery', function() {
  $('.is-accordion-submenu.invisible').removeClass('invisible');
});