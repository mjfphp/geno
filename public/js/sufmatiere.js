
// the leftside bar click to scroll code
$(document).ready(function(){
  $('.tree_label').click(function(){
    if($(this).prev().attr("checked")){
      $(this).prev().removeAttr("checked");
    }else{
      $(this).prev().attr("checked","checked");
    }
  });
  // ADD matiere model
  $('#addmt').on('click',function() {
          $('#addmatiere').css("display","block");
  });
  //close modals
  $('.modal .annuler,.modal #nav-icon1,.modal span').click(function(){
          $(".modal").each(function(){
            $(this).css("display","none");
          })
  });
  // Edit filiere
  $('.edit').on('click',function() {
          $('#editMat').css("display","block");
          var el = $(this).parent().prevAll();
          $('#editMat form').attr('action','/matieres/' + el[6].innerText);
          $('#editMat #intitule').val(el[5].innerText);
          $('#editMat #grp').find("option").each(function(){
            if($(this).text() === el[4].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
          $('#editMat #user_id').find("option").each(function(){
            if($(this).text() === el[3].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
          $('#editMat #pourcentage').val(el[1].innerText);
          $('#editMat #vh').val(el[0].innerText);
  });
  $(".delete").on('click',function() {
          $('#deleteMat').css("display","block");
          var el = $(this).parent().prevAll();
          $('#deleteMat form').attr('action','/matieres/' + el[6].innerText);
  });

});
