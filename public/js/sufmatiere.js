
  // ADD matiere model
  $('#addmt').on('click',function() {
          $('#editS').css("display","block");

          var module_id = $('#table').attr("data-id");
          var el = "<input id=\"module_id\" type=\"hidden\" value=\" "+ module_id +" \" name=\"module_id\" />";
          var action = $(this).attr("data-info");

          $(".method").after(el);
          $(".method").remove();
          $('#editS form').attr('action',action);
  });
  // Edit filiere
  $('.edit').on('click',function() {
          $('#editS').css("display","block");

          var el = $(this).parent().prevAll();
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-info');
          $('#editS form').attr('action',action + id);

          $('#editS #intitule').val(el[5].innerText);
          $('#editS #grp').find("option").each(function(){
            if($(this).text() === el[4].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
          $('#editS #user_id').find("option").each(function(){
            if($(this).text() === el[3].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
          $('#editS #pourcentage').val(el[1].innerText);
          $('#editS #vh').val(el[0].innerText);
  });
