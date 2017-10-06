$(document).ready(function(){
  // initialise the leftside and table container's hights and widthds
  $('.left-side').height($(document).innerHeight()-70);
  $('.tree').height($('.left-side').innerHeight()-50);
  $('.tables').width($(document).innerWidth()-196);
  $('.tables').height($(document).innerHeight()-56);
  sizeleft();
  sizetables();
  $('.tree_label').click(function(){
    if($(this).prev().attr("checked")){
      $(this).prev().removeAttr("checked");
    }else{
      $(this).prev().attr("checked","checked");
    }
  });
  //close modals
  $('.modal .annuler,.modal #nav-icon1,.modal span').click(function(){
          $(".modal").each(function(){
            $(this).css("display","none");
          })
  });
});

function sizeleft(){
  $(window).resize(function(){
    $('.left-side,.tree').height($(window).innerHeight()-70);
    $('.tree').height($('.left-side').innerHeight()-50);
  });
}
function sizetables(){
  $(window).resize(function(){
    $('.tables').width($(window).innerWidth()-196);
    $('.tables').height($(window).innerHeight()-56);
  });
}
