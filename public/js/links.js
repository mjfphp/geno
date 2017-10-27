$(document).ready(function() {

  var active1 = false;
  var active2 = false;

    $('.parent2').on('mousedown touchstart', function() {

    if (!active1) $(this).find('.Teach').css({'transform': 'translate(-5px,50px)'});
    else $(this).find('.Teach').css({ 'transform': 'translate(-5px,-5px)'});
     if (!active2) $(this).find('.Stud').css({ 'transform': 'translate(-50px,30px)'});
    else $(this).find('.Stud').css({'transform': 'translate(-5px,-5px)'});
    active1 = !active1;
    active2 = !active2;

    });
    $('.Teach').click(function(){
      window.location = "/trashp";
    });
    $('.Stud').click(function(){
      window.location = "/trash";
    });
});
