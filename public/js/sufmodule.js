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
// ADD module model
$('#addmod').on('click',function() {
        $('#addmodule').css("display","block");
});
// Edit filiere
$('.edit-modal').on('click',function() {
        $('#editMod').css("display","block");
        var el = $(this).parent().prevAll();
        $('#editMod form').attr('action','/modules/' + el[8].innerText);


        $('#editMod #intitule').val(el[7].innerText);
        $('#editMod #abbreviation').val(el[6].innerText);
        $('#editMod #user_id').find("option").each(function(){
          if($(this).text() === el[5].innerText){
            $(this).attr('selected','selected');
          }else{
            $(this).removeAttr('selected');
          }
        });
        $('#editMod #niveau_id').val(el[4].innerText);
        $('#editMod #departement_id').find("option").each(function(){
          if($(this).text()=== el[3].innerText){
            $(this).attr('selected','selected');
          }else{
            $(this).removeAttr('selected');
          }
        });
        $('#editMod #semestre').find("option").each(function(){
          if($(this).text() === el[2].innerText){
            $(this).attr('selected','selected');
          }else{
            $(this).removeAttr('selected');
          }
        });
        $('#editMod #nature').val(el[1].innerText);
        $('#editMod #vh').val(el[0].innerText);
});
$(".delete-modal").on('click',function() {
        $('#deleteMod').css("display","block");
        var el = $(this).parent().prevAll();
        $('#deleteMod form').attr('action','/modules/' + el[8].innerText);
});
$('.modal .annuler,.modal #nav-icon1,.modal span').click(function(){
        $(".modal").each(function(){
          $(this).css("display","none");
        });
});
