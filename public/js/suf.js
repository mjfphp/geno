
// ADD filiere model
$('#addf').on('click',function() {
          $('#editF').css("display","block");

          var action = $(this).attr("data-info");

          $(".method1").remove();
          $('#editF form').attr('action',action);
});
  // Edit filiere
  $('.edit').on('click',function() {
          $('#editF').css("display","block");

          var el = $(this).parent().prevAll();
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-info');
          $('#editF form').attr('action',action + id);

          $('#editF #intitule').val(el[2].innerText);
          $('#editF #abbreviation').val(el[1].innerText);
          $('#editF #user_id').find("option").each(function(){
            if($(this).text() === el[0].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
  });
  $('.info1').on('click',function() {
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-info');
          window.location.replace(action + id);
  });

  // ADD depetement model
   $('#addd').on('click',function() {
           $('#editD').css("display","block");

           var action = $(this).attr("data-info");

           $(".method2").remove();
           $('#editD form').attr('action',action);
   });

  // Edit departement
  $('.edit2').on('click',function() {
          $('#editD').css("display","block");

          var el = $(this).parent().prevAll();
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-info');


          $('#editD form').attr('action',action + id);
          $('#editD #intitule').val(el[1].innerText);
          $('#editD #user_id').find("option").each(function(){
            if($(this).text() === el[0].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
  });
