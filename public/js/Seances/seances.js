$(document).ready(function(){
$("button#addS").click(function(){
    empty("addS");
    show("addS");
});
$("button#showS").click(function(){
//    empty("showS");
    show("showS");
});
    $("button.annuler").click(function(){
    modal_id=$(this).parent().attr("name");
        empty(modal_id);
        hide(modal_id);
    });
});

empty = function(modal_id){
    $("div#"+modal_id+" input").val("");
    option=$("div#"+modal_id+" select").children()[0];
    $(option).prop('selected', true);
}
show = function(modal_id){
    $("div#"+modal_id).css("display","block");
}

hide = function(modal_id){
    $("div#"+modal_id).css("display","none");
    empty(modal_id);
}