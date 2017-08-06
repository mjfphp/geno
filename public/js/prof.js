$(document).ready(function(){

    toggle = function(item){
        next=$(item).parent().next();
        $(next).toggleClass("hidden");
    }
});