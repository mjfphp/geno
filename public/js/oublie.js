
function sizeleft(){
  $(window).resize(function(){
    $('.container,.wrap').height($(window).innerHeight()-$(".header").innerHeight());
  });
}
$(document).ready(function(){
  $('.container,.wrap').height($("body").innerHeight());
  sizeleft();
  $("input").on('keypress keyup',function(){
    resiz($(this));
  });
})
function resiz(el) {
  el.width( el.val().length ? (el.val().length + 10)*7 : 230);
}
