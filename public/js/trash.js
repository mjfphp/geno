$(document).ready(function() {

  var active1 = false;
  var active2 = false;
  var active3 = false;
  var active4 = false;

    $('.parent2').on('mousedown touchstart', function() {

    if (!active1) $(this).find('.test1').css({'background-color': 'gray', 'transform': 'translate(0px,70px)'});
    else $(this).find('.test1').css({'background-color': 'dimGray', 'transform': 'none'});
     if (!active2) $(this).find('.test2').css({'background-color': 'gray', 'transform': 'translate(-60px,40px)'});
    else $(this).find('.test2').css({'background-color': 'darkGray', 'transform': 'none'});
    active1 = !active1;
    active2 = !active2;
    });
});

$('.test1,.test2').click(function(){
  $('#editT').css("display","block");
  if( $(this)[0] === $(".test1")[0]){
    $(".modal-header h4").text("Professeurs");
    $('.stud').css('display','none');
    $('.prof').css('display','block');
  }else {
    $(".modal-header h4").text("Etudiants");
    $('.stud').css('display','block');
    $('.prof').css('display','none');
  }
})

$('#nav-icon1,#nav-icon1 span,.annuler').click(function(){
        $('#editT').css("display","none");
        $(".modal-header h4").text("");
});
