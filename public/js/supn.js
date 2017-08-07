// the leftside bar click to scroll code
$(document).ready(function(){
  $('.tree_label').click(function(){
    if($(this).prev().attr("checked")){
      $(this).prev().removeAttr("checked");
    }else{
      $(this).prev().attr("checked","checked");
    }
  });
  // ADD module model
  $('#addniv').on('click',function() {
          $('#addniveau').css("display","block");
  });
  $('#aaddniveau .annuler,#addniveau #nav-icon1,#addniveau span').click(function(){
          $('#addniveau').css("display","none");
  });

  // Edit niveau
  $('.edit-modal').on('click',function() {
          $('#editNiv').css("display","block");
          var el = $(this).parent().prevAll();
          $('#editNiv form').attr('action','/niveaux/' + el[3].innerText);
          $('#editNiv #abbreviation').val(el[2].innerText);
          $('#editNiv #nbg').val(el[1].innerText);
  });
  $(".delete-modal").on('click',function() {
          $('#deleteNiv').css("display","block");
          var el = $(this).parent().prevAll();
          $('#deleteNiv form').attr('action','/niveaux/' + el[3].innerText);

  });
  $('.modal .annuler,.modal #nav-icon1,.modal span').click(function(){
          $('.modal').css("display","none");
  });

});
