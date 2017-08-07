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
    $("#import_btn").click(function(){
      $("#import").css("display","block");
  });
    $(".cancel_upload").click(function(){
        $("#import input").val("");
        resetUp();
        $("#import").css("display","none");
    });
    up = function(){
        resetMsg();
        file=$("#fileid")[0].files[0];
        token=$("input[name=_token]").val();
        content=new FormData($("#up")[0]);
        if(file===undefined){
            $("#up_result").addClass("text-danger");
            $("#up_result").html("Aucun fichier trouvé!");
            return ;
        }
        $.ajax({
            url: "/profs/up",
            xhr: function() { // custom xhr (is the best)
                var xhr = new XMLHttpRequest();
                var size = file.size;
                // Called when upload progress changes. xhr2
                xhr.upload.addEventListener("progress", function(evt) {
                  // show progress like example
                  var loaded = (evt.loaded / size).toFixed(2)*100;
                    loaded=parseFloat(loaded).toFixed(2);
                    if(loaded>100){
                       loaded=100;
                       }
                  $('#up_result').text('Chargement...'+ loaded +'%');
                }, false);
                return xhr;
            },
            type: 'post',
            processData: false,
            contentType: false,
            data: content,
            success: function(data) {
//                console.log(data);
                if(data["message"]===undefined){
                    $("#up_result").html(data);
                }
                $("#up_result").html(data["message"]);
                $("#up_result").addClass(data["style"]);
            }
            }).fail(function(data){
                $("#up_result").html(data["message"]);
                if(data["responseText"]!==undefined){
                    $("#up_result").html(data["responseText"]);
                }
            });
    }
    resetMsg = function(){
        $("#up_result").removeClass("text-success text-danger text-warning text-info");
    }
    resetUp = function(){
        $("#up_result").html("").removeClass("text-success text-danger text-warning text-info");
    }
    $("#exprtP").click(function(){
        $("#export_pdf").css("display","block");
    });
})



function sizetables(){
  $(window).resize(function(){
    $('.cont').width($(window).innerWidth());
    $('.cont').height($(window).innerHeight()-50);
  });
}
