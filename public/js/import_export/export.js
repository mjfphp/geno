$(document).ready(function(){
    $("#cancel_export").click(function(){
        cancel_export();
        $("#export_pdf").css("display","none");
        $("#export_excel").css("display","none");
    });
    $("#exprtP").click(function(){
        $("#export_pdf").css("display","block");
    });
    $("#exprtE").click(function(){
        $("#export_excel").css("display","block");
    });
cancel_export = function(){
    $("#export_pdf input[type='checkbox']").prop('checked',false);
    $("#export_excel input[type='checkbox']").prop('checked',false);
}
});