
// the leftside bar click to scroll code
$(document).ready(function(){
  $('.cont').width($(document).width());
  $('.cont').height($(document).height()-50);
  sizetables();
  $('.table').dataTable( {
    "searching": false,
    "info" : false,
     "pageLength" :7,
    "bLengthChange": false
  } );

  $(".delete").on('click',function() {
          $('#deleteS').css("display","block");
          $('#deleteS form h4').text("Vous voulez vraiment supprimer cet element?");
          $('#deleteS form input').attr("value","delete");
          var id = $(this).attr("data-id");
          var action = $(this).attr("data-info");
          $('#deleteS form').attr('action', action + id);
  });

  $(".restaurer").on('click',function() {
          $('#deleteS').css("display","block");
          $('#deleteS form h4').text("Vous voulez vraiment restaurer cet element?");
          $('#deleteS form input').attr("value","put");
          var id = $(this).attr("data-id");
          var action = $(this).attr("data-info");
          $('#deleteS form').attr('action', action + id);
  });

  $('#nav-icon1,#nav-icon1 span,.annuler').click(function(){
          $('#deleteS').css("display","none");
  });

});

function sizetables(){
  $(window).on('resize',function(){
    $('.cont').width($(document).width());
    $('.cont').height($(document).height()-50);
  });
}
