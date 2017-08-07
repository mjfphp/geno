$(document).ready(function(){
    $("#cancel_export").click(function(){
        cancel_export();
        $("#export_pdf").css("display","none");
    });
    $("#exprtP").click(function(){
        $("#export_pdf").css("display","block");
    });
cancel_export = function(){
    $("#export_pdf input[type='checkbox']").prop('checked',false);
}
});