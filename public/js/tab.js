$(document).ready(function(){
  // initialise the leftside and table container's hights and widthds
  $('.left-side').height($(document).height()-70);
  $('.tree').height($('.left-side').height()-50);
  $('.tables').width($(document).width()-196);
  $('.tables').height($(document).height()-56);
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
    $('.left-side,.tree').height($(document).height()-70);
    $('.tree').height($('.left-side').height()-50);
  });
}
function sizetables(){
  $(window).resize(function(){
    $('.tables').width($(document).width()-196);
    $('.tables').height($(document).height()-56);
  });
}
