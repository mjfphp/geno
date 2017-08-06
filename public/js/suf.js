$(document).ready(function(){
  // Edit filiere
  $('.edit1').on('click',function() {
          $('#editF').css("display","block");
          var el = $(this).parent().prevAll();

          $('#editF form').attr('action','/filieres/' + el[3].innerText);
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
  $(".delete1").on('click',function() {
          $('#deleteF').css("display","block");
          var el = $(this).parent().prevAll();

          $('#deleteF form').attr('action','/filieres/' + el[3].innerText);
  });
  $('.info1').on('click',function() {
          var el = $(this).parent().prevAll();
          window.location.replace("/filieres/"+el[3].innerText);
  });
  $('.annuler,#nav-icon1,span').click(function(e){
          $('.modal').css("display","none");
  });
  // Edit departement
  $('.edit2').on('click',function() {
          $('#editD').css("display","block");
          var el = $(this).parent().prevAll();

          $('#editD form').attr('action','/dept/' + el[2].innerText);
          $('#editD #intitule').val(el[1].innerText);
          $('#editD #user_id').find("option").each(function(){
            if($(this).text() === el[0].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
  });
  $(".delete2").on('click',function() {
          $('#deleteD').css("display","block");
          var el = $(this).parent().prevAll();

          $('#deleteD form').attr('action','/dept/' + el[2].innerText);

  });
  });
  // ADD filiere model
  $('#addf').on('click',function() {
          $('#addfiliere').css("display","block");
  });
  $('#addfiliere .annuler,#addfiliere #nav-icon1,#addfiliere span').click(function(){
          $('#addfiliere').css("display","none");
  });
 // ADD depetement model
  $('#addd').on('click',function() {
          $('#adddept').css("display","block");
  });
  $('#adddept .annuler,#adddept #nav-icon1,#adddept span').click(function(){
          $('#adddept').css("display","none");
  })
  $('.annuler,#nav-icon1,span').click(function(e){
          $('.modal').css("display","none");
  });

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
