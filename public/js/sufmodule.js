
// ADD module model
$('#addmod').on('click',function() {
        $('#editS').css("display","block");
        var niveau_id = $("#table1").attr("data-id");
        var el = "<input id=\"niveau_id\" type=\"hidden\" value=\" "+ niveau_id + "\" name=\"niveau_id\">";
        var action = $(this).attr('data-info');

        $(".method").after(el);
        $(".method").remove();
        $('#editS form').attr('action',action);
});
// Edit filiere
$('.edit-modal').on('click',function() {
        $('#editS').css("display","block");

        var el = $(this).parent().prevAll();
        var id = $(this).attr('data-id');
        var action = $(this).attr('data-info');
        $('#editS form').attr('action',action + id);

        $('#editS #intitule').val(el[7].innerText);
        $('#editS #abbreviation').val(el[6].innerText);
        $('#editS #user_id').find("option").each(function(){
          if($(this).text() === el[5].innerText){
            $(this).attr('selected','selected');
          }else{
            $(this).removeAttr('selected');
          }
        });
        $('#editS #departement_id').find("option").each(function(){
          if($(this).text()=== el[3].innerText){
            $(this).attr('selected','selected');
          }else{
            $(this).removeAttr('selected');
          }
        });
        $('#editS #semestre').find("option").each(function(){
          if($(this).text() === el[2].innerText){
            $(this).attr('selected','selected');
          }else{
            $(this).removeAttr('selected');
          }
        });
        $('#editS #nature').val(el[1].innerText);
        $('#editS #vh').val(el[0].innerText);
});
