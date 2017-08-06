$(document).ready(function(){
token=$("input[type='hidden']").val();
makeInput = function(Tag){
    value=$(Tag).text();
    token=$("input#token").val();
    $(Tag).html("<i class='material-icons' onclick='backToText(this)'>cancel</i><input type='text' name='' modified='false' onkeypress=input(event,this) oldvalue='"+value+"' value='"+value+"' /><i class='material-icons' onclick='send(this)'>done</i>");
}

makeText = function(Tag){
    value=$(Tag).attr("oldvalue");
    $(Tag).parent().text(value);
}
backToText = function(Tag){
    inpt=$(Tag).next();
    $(Tag).parent().attr("modifications","false");
    makeText(inpt);
}
$("body").keyup(function(event){
    code=event.keyCode;
    foccusInput=$("input:focus").prev();
    if(code==27){
       backToText(foccusInput);
    }
});
isModified = function(Tag){
    if($(Tag).attr("modified")=="true"){
        return 1;  
    }else return 0;
}
done = function(Tag){
    if(isModified(Tag)){
        form=$(Tag).parent();
        val=$(Tag).val();
        apogee=$(Tag).parent().parent().children(":nth-child(2)").attr("value");
        name=$(Tag).attr("name");
        $.ajax({
            method: "post",
            url: "/matiere/submit",
            data:{
                "_token": token,
                val:val,
                apogee:apogee,
                name:name
            },
            dataType: "json"
        })
        .done(function(data) {
            console.log(data);
        })
        .fail(function(data) {
                $("#log").html(data.responseText);
            $.each(data.responseJSON, function (key, value) {
                var input = '#formRegister input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');
            });
        });
    }
}
send = function(Tag){
    done($(Tag).prev());
}
edit = function(){
    intitu=$("#intitule").val();
    pourcent=$("#pourcentage").val();
    $.ajax({
            method: "post",
            url: "/matiere/edit",
            data:{
                "_token": token,
                intitule:intitu,
                pourcentage:pourcent
            },
            dataType: "json"
        })
        .done(function(data) {
            console.log(data);
        })
        .fail(function(data) {
                $("#log").html(data.responseText);
            $.each(data.responseJSON, function (key, value) {
                var input = '#formRegister input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');
            });
        });
}
input = function(e,Tag){
    if(e.keyCode==13){
        e.preventDefault();
    }
    oldValue=$(Tag).attr("oldvalue");
    current=$(Tag).val();
    if(e.keyCode==13 && oldValue!=current){
       done(Tag);
    }else $(Tag).attr("modified","true");
}
notes=$("tbody tr").children(":not(:nth-child(1)):not(:nth-child(2)):not(:last-child)");
notes.css("cursor","pointer");
notes.dblclick(function(){
    if($(this).attr("modifications")=="true"){
       return 1;
    }else{
        makeInput(this); 
        $(this).attr("modifications","true");
    }
});

parametrage = function(elem){
    val=$(elem).text();
    $("#parametrages input:not(:first-child").val("");
    $("#intitule").val(val);
    $("#pourcentage").val(1);
    $('#parametrages').css("display","block");
}
clodeModal = function(elem){
    $("#parametrages").css("display","none");
}
    
});