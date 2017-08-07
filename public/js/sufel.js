// the leftside bar click to scroll code
$(document).ready(function(){
  $('.tree_label').click(function(){
    if($(this).prev().attr("checked")){
      $(this).prev().removeAttr("checked");
    }else{
      $(this).prev().attr("checked","checked");
    }
  });
  // ADD eleve model
  $('#addel').on('click',function() {
          $('#addeleve').css("display","block");
  });
  $('#addel .annuler,#addmodule #nav-icon1,#addmodule span').click(function(){
          $('#addeleve').css("display","none");
  });
  // Edit eleve
  $('.edit-modal').on('click',function() {
          $('#editEl').css("display","block");
          var el = $(this).parent().prevAll();
          $('#editEl form').attr('action','/eleves/' + el[13].innerText);
          $('#editEl #apoge').val(el[12].innerText);
          $('#editEl #cne').val(el[11].innerText);
          $('#editEl #cin').val(el[10].innerText);
          $('#editEl #nom').val(el[9].innerText);
          $('#editEl #prenom').val(el[8].innerText);
          $('#editEl #statut').find("option").each(function(){
            if($(this).text() === el[7].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
          $('#editEl #grp').val(el[6].innerText);
          $('#editEl #email').val(el[5].innerText);
          $('#editEl #date_naissance').val(el[4].innerText.replace(/\//g ,"-").split("-").reverse().join("-"));
          $('#editEl #lieu_naissance').val(el[3].innerText);
          $('#editEl #ville').val(el[2].innerText);
          $('#editEl #num').val(el[1].innerText);
  });
  $(".delete-modal").on('click',function() {
          $('#deleteEl').css("display","block");
          var el = $(this).parent().prevAll();
          $('#deleteEl form').attr('action','/eleves/' + el[13].innerText);
  });
  $('.modal .annuler,.modal #nav-icon1,.modal span').click(function(){
          $(".modal").each(function(){
            $(this).css("display","none");
          });
  });
});
