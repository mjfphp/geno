$('.table').each(function(){
  $(this).DataTable({info:false});
})
// the leftside bar click to scroll code
$(document).ready(function(){
  $(".delete").on('click',function() {
          $('#deleteS').css("display","block");
          var id = $(this).attr("data-id");
          var action = $(this).attr("data-info");
          $('#deleteS form').attr('action', action + id);
  });

});
