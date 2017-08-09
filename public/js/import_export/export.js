$(document).ready(function(){
    $("#cancel_export").click(function(){
        cancel_export();
        $("#export_pdf").css("display","none");
    });
    $("#cancel_export_Excel").click(function(){
        $("#export_excel").css("display","none");
        cancel_export();
    });
    $("#exprtP").click(function(){
        $("#export_pdf").css("display","block");
    });
    $("#exprtE").click(function(){
        $("#export_excel").css("display","block");
    });
check = function(type){
    if(type=="pdf"){
        is=$("#all").prop("checked");
       $("#export_pdf input[type='checkbox']").prop('checked',is);
        return true;
    }
    if(type=="excel"){
        is=$("#Eall").prop("checked");
       $("#export_excel input[type='checkbox']").prop('checked',is);
        return true;
    }

    
}
cancel_export = function(){
    $("#export_pdf input[type='checkbox']").prop('checked',false);
    $("#export_excel input[type='checkbox']").prop('checked',false);
}
});