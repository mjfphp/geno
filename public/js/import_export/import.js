$(document).ready(function(){
  $("#import_btn").click(function(){
    $("#import").css("display","block");
  });
    $("#cancel_upload").click(function(){
        cancel_import();
    });
    up = function(link){
        if(link!='/eleves/up' && link!='/profs/up')  return 0;
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
            url: link,
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
cancel_import = function(){
    $("#import input").val("");
    resetUp();
    $("#import").css("display","none");

}
});