$(document).ready(function(){

parametrage = function(elem){
    val=$(elem).text();
    $("#parametrages input:not(:first-child").val("");
    $("#intitule").val(val);
    $('#parametrages').css("display","block");
}
clodeModal = function(elem){
    $("#parametrages").css("display","none");
}

});