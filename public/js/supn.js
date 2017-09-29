  // ADD module model
  $('#addniv').on('click',function() {
            $('#editS').css("display","block");

            var filiere_id = $('#table').attr("data-id");
            var el = "<input id=\"filiere_id\" type=\"hidden\" value=\" "+ filiere_id +" \" name=\"filiere_id\" />";
            var action = $(this).attr("data-info");

            $(".method").after(el);
            $(".method").remove();
            $('#editS form').attr('action',action);
  });

  // Edit niveau
  $('.edit-modal').on('click',function() {
          $('#editS').css("display","block");
          var el = $(this).parent().prevAll();
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-info');
          $('#editS form').attr('action',action + id);

          $('#editS #abbreviation').val(el[2].innerText);
          $('#editS #nbg').val(el[1].innerText);
  });
