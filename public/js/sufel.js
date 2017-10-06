// the leftside bar click to scroll code
$(document).ready(function(){
  // ADD eleve model
  $('#addel').on('click',function() {
          $('#editS').css("display","block");
          var niveau_id = $("#table1").attr("data-id");
          var el = "<input type=\"hidden\" value=\" "+niveau_id+" \" name=\"niveau_id\" />";
          $(".method").after(el);
          $(".method").remove();
          $('#editS form').attr('action','/eleves');
  });
  $('#addel .annuler,#addmodule #nav-icon1,#addmodule span').click(function(){
          $('#addeleve').css("display","none");
  });
  // Edit eleve
  $('.edit').on('click',function() {
          $('#editS').css("display","block");
          var el = $(this).parent().prevAll();
          var id = $(this).attr("data-id");
          var action = $(this).attr("data-info");

          $('#editS form').attr('action',action + id);
          $('#editS #apoge').val(el[11].innerText);
          $('#editS #cne').val(el[10].innerText);
          $('#editS #cin').val(el[9].innerText);
          $('#editS #nom').val(el[8].innerText);
          $('#editS #prenom').val(el[7].innerText);
          $('#editS #statut').find("option").each(function(){
            if($(this).text() === el[6].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
          $('#editS #email').val(el[5].innerText);
          $('#editS #grp').find("option").each(function(){
            if($(this).text() === el[4].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
          $('#editS #date_naissance').val(el[3].innerText);
          $('#editS #lieu_naissance').val(el[2].innerText);
          $('#editS #ville').val(el[1].innerText);
          $('#editS #num').val(el[0].innerText);
  });
});
