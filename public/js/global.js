// the leftside bar click to scroll code
$(document).ready(function(){
  $('.tree_label').click(function(){
    if($(this).prev().attr("checked")){
      $(this).prev().removeAttr("checked");
    }else{
      $(this).prev().attr("checked","checked");
    }
  });
});

$(".delete").on('click',function() {
        $('#deleteS').css("display","block");
        var id = $(this).attr("data-id");
        var action = $(this).attr("data-info");
        $('#deleteS form').attr('action', action + id);
});

//close modals
$('.modal .annuler,.modal #nav-icon1,.modal span').click(function(){
        $(".modal").each(function(){
          $(this).css("display","none");
        })
});
