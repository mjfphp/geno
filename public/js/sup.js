$(document).ready(function(){
  $('.cont').width($(window).innerWidth());
  $('.cont').height($(window).innerHeight()-50);
  sizetables();
  // on click events for our edit and delete buttons
  $('#addp').click(function() {
          $('#prof').css("display","block");
  });
  // close button of the modal
  $('.annuler,#nav-icon1,span').click(function(){
          $('#prof').css("display","none");
          $('#prof input').val("");
  });

  //Tab model
  $('.edit-modal').on('click',function() {
          $('#editModal').css("display","block");
          var el = $(this).parent().prevAll();

          $('#editModal form').attr('action','/profs/' + el[10].innerText);

          $('#editModal #refprof').val(el[9].innerText);
          $('#editModal #name').val(el[8].innerText);
          $('#editModal #prenom').val(el[7].innerText);
          $('#editModal #grade').val(el[6].innerText);
          $('#editModal #specialite').val(el[5].innerText);
          $('#editModal #email').val(el[4].innerText);
          $('#editModal #adress').val(el[3].innerText);
          $('#editModal #ville').val(el[2].innerText);
          $('#editModal #num').val(el[1].innerText);
          $('#editModal #departement_id').find("option").each(function(){
            if($(this).text() === el[0].innerText){
              $(this).attr('selected','selected');
            }else{
              $(this).removeAttr('selected');
            }
          });
  });
  $(".delete-modal").on('click',function() {
    $('#deleteModal').css("display","block");
    var el = $(this).parent().prevAll();

    $('#deleteModal form').attr('action','/profs/' + el[10].innerText);

    });
  $('.annuler2,#nav-icon1,span').click(function(e){
          $('.modal').css("display","none");
  });
})

function sizetables(){
  $(window).resize(function(){
    $('.cont').width($(window).innerWidth());
    $('.cont').height($(window).innerHeight()-50);
  });
}
