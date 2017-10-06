$(document).ready(function(){
  $('.cont').width($(window).innerWidth());
  $('.cont').height($(window).innerHeight()-50);
  sizetables();
  // close button of the modal
  $('.annuler,#nav-icon1,span').click(function(){
          $('#prof').css("display","none");
          $('#prof input').val("");
  });
  // on click events for our edit and delete buttons
  $('#addp').click(function() {
          $('#editS').css("display","block");

          var action = $(this).attr("data-info");
          
          $(".method").remove();
          $('#editS form').attr('action',action);
  });

  //Tab model
  $('.edit-modal').on('click',function() {
          $('#editS').css("display","block");

          var el = $(this).parent().prevAll();
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-info');
          $('#editS form').attr('action',action + id);

          $('#editS #refprof').val(el[9].innerText);
          $('#editS #name').val(el[8].innerText);
          $('#editS #prenom').val(el[7].innerText);
          $('#editS #grade').val(el[6].innerText);
          $('#editS #specialite').val(el[5].innerText);
          $('#editS #email').val(el[4].innerText);
          $('#editS #adress').val(el[3].innerText);
          $('#editS #ville').val(el[2].innerText);
          $('#editS #num').val(el[1].innerText);
          $('#editS #departement_id').find("option").each(function(){
            if($(this).text() === el[0].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
  });
})

function sizetables(){
  $(window).resize(function(){
    $('.cont').width($(window).innerWidth());
    $('.cont').height($(window).innerHeight()-50);
  });
}
