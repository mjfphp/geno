$(document).ready(function(){
disable_Context=false;

docWidth=$(document).width();
docHeight=$(document).height();
$(document).resize(function(){
    docWidth=$(this).width;
    docHeight=$(this).height;
});


    s = function(){
        alert("working");
    }
    
modal = function(options,f1,f2){
    //options
    /*
        notiftype:
            error=> modal qui montre une erreur
            warning=> modal qui montre un averticement
            success=> modal qui montre un succes
        type:
            readClose || 1=>on lit un message et on ferme
            readReact || 2=>on reagit, soit on confirm,soit on annule
        Title:
            "..."=>titre du modal
        msg:
            Msg:
                "..."=>message a afficher
            VMsg
                "..."=>message a afficher sur le boutton de confirmation
            CMsg
                "..."=>message a afficher sur le boutton d'annulation
        Action
            open=>ouvre le modal
            close=>ferme le modal
        f1=>fonctions a executer en cas de validation
        f2=>fonctions a executer en cas d'annulation
        
        return -1 si une vaaleur n'a pas ete envoye
        return 0 si une erreur s'est produite
    */
    Op={
        Action:"open",
        Title:"Information!",
        type:"readClose",
        notifType:"warning",
        msg:{
            Msg:"Modal",
            VMsg:"Confirmer",
            CMsg:"Annuler"
        },
        Ret:{
            V:0,
            C:1
        }
        
    };//options par defaut

    /*  Tests de validation */
    if(options===undefined){
        return modal(Op);
    }
    if(options.Action==undefined){
       options.Action="open";
    }
    if(options.Action!="open" && options.Action !="close"){
        console.log("l'option ne peut etre que: \"open\" ou \"close\"  ");
        return 0;
    }

    if(options["Action"]=="close"){
        $("#Modal").css({display:"none"});
        return 1;
    }

    if(options.Title===undefined){
        options["Title"]="Confirmation du choix!";
    }
    
    type=options.type;
    if(type!="readClose" && type!=1 && type!="1" && type!="readReact" && type!=2 && type!="2"){
        console.log("le type pocède deux choix possible: \"readClose\" ou 1, ou \"readReact\" ou 2 ");
        return 0;
    }else{
        if(type=="readClose" || type==1 || type=="1"){
            type=1;
        }
        if(type=="readReact" && type==2 && type=="2"){
            type=2;
        }
    }
    
    /*  fin des tests de validation */

    if(options["Action"]=="open"){
        color=options["notifType"];
        if(color!=undefined){//coleur definie
            E="#modal #body";
            $(E).removeClass("success");
            $(E).removeClass("danger");
            $(E).removeClass("warning");
            switch (color){
                case "success":$(E).addClass("success");
                    break;
                case "warning":$(E).addClass("warning");
                    break;
                case "error":$(E).addClass("danger");
                    break;
            }
        }
        message=options.msg.Msg;
        if(message===undefined){
            console.log("Message pas defini");
            return 0;
        }
        titre=options["Title"];
        
        $("#Modal #Title").text(titre);
        $("#Modal #Msg").html(message);
        
        footer=$("#Modal #modal-footer");
        if(type==1){
           //affiche une notification qu'on peut fermer a l'iade d'un btn
            footer.html('<button name="button" class="conf" onclick="modal({Action:\'close\'})" >'+f1+'</button>');
        }
        
        if(type==2){
        //affiche un modal qui demande un choix
            VMsg=options.msg.VMsg;
            CMsg=options.msg.CMsg;
            if(VMsg===undefined){
             VMsg="continuer";
            }
            if(CMsg===undefined){
             CMsg="Annuler";
            }
            footer.html('<button name="button" class="conf" onclick="'+f1+'">'+VMsg+'</button>\
                        <button name="button" class="conf" onclick="'+f2+'">'+CMsg+'</button>');
        }
        $("#Modal").css({display:"block"});
    }
}


inputModal = function(obj){//cree un modal pour faire les formulaires
    
}

toggle=function(e){    
    e.preventDefault();
    $("#sidebar").toggleClass("active");
}

hideContext = function(){
    $(".context-menu").addClass("hidden");
}

showContext = function(){
    $(".context-menu").removeClass("hidden");
}

disablContext = function(){
    $(".context-menu #edit").addClass("disabled");
    $(".context-menu #cancel").addClass("disabled");
    $(".context-menu #validate").addClass("disabled");
    $(".context-menu #remove").addClass("disabled");

}

enableContext = function(){
    $(".context-menu #edit").removeClass("disabled");
    $(".context-menu #cancel").removeClass("disabled");
    $(".context-menu #validate").removeClass("disabled");
    $(".context-menu #remove").removeClass("disabled");

}

addProf = function(e){
    e.preventDefault();
    inputs=$("div#ajout_prof").html();

    modal({
        Action:"open",
        type:1,
        Title:"Ajout d'un professeur",
        msg:{
            Msg:inputs,
            VMsg:"Ajouter",
            CMsg:"Annuler"
        }
    },"Quitter");
    
}

                             
stMenu = function(tr){
    $(tr+" a#validate").addClass("hidden");
    $(tr+" a#cancel").addClass("hidden");
    
    $(tr+" a#edit").removeClass("hidden");
    $(tr+" a#remove").removeClass("hidden");
}

ndMenu = function(tr){
    $(tr+" a#edit").addClass("hidden");
    $(tr+" a#remove").addClass("hidden");
    
    $(tr+" a#validate").removeClass("hidden");
    $(tr+" a#cancel").removeClass("hidden");
}
    
context_check=function(e){
    
}
$(document).click(function(e){
    shown=$(".context-menu").attr("shown");
    if(shown=="true"){
        dy=$(".context-menu").offset().top;
        dx=$(".context-menu").offset().left;
        W=$(".context-menu").width();
        H=$(".context-menu").height();
        X = e.pageX;//curseur x
        Y = e.pageY;//curseur y

        if( 0<=X-dx && X-dx<=W && 0<=Y-dy && Y-dy<=H){
              
        }else{
            $(".context-menu").addClass("hidden");
            $(".context-menu").attr("shown",false);
        }
        
    }
});

$("tbody tr").mouseenter(function(){
    state=$("table").attr("state");
    if(state=="edition") return 0;
        $("tbody tr").attr("options",false);
        in_use=$("table").attr("in-use");
        $(this).attr("options",true);
        if(in_use==undefined || in_use=="false"){
            ELEMENT=$(this);
        }
        $('[data-toggle="tooltip"]').tooltip();
});

$("tbody tr").mouseenter(function(){
    state=$("table").attr("state");
    if(state!="edition"){
        makepointer(this); 
    }
});

$("tbody tr").mouseleave(function(){
   removepointer(this); 
});    

$("tbody td").dblclick(function(e){
    ELEMENT=$($(this).parent());
    edit(e);
});


makepointer = function(Elem){
    $(Elem).css({cursor:"pointer"});
}

removepointer = function(Elem){
    $(Elem).css({cursor:"default"});
}

makeInput = function(td,additionalAttrs){
    val=td.text();
    return "<input type='text' value='"+val+"' "+additionalAttrs+"  />"
}

testUse = function(e,elem){
    e.preventDefault();
    if(elem.attr("class")=="disabled"){
        return 0;
    }else{
        hideContext();
        return 1;
    }
}

Modified = function(tds){
    var l=tds.length-2;
    var modified=0;
    while(l>0){
        td=$(tds[l]);
        modified=$(td.children()).attr("modified");
        if(modified=="true"){
            modified=1;
            break;
        }
        l--;
    }
    return modified;
}

reset = function(tds,valide){
    var l=tds.length-2;
    while(l>0){
        td=$(tds[l]);
        val=$(td.children()).attr("oldvalue");
        if(valide==true){
            val=$(td.children()).val();
        }
        attr=$(td.children()).attr("phone");
        if(attr=="true"){//champs du numero de telephone
            val="<code>"+val+"</code>";
        }
        td.html(val);
        l--;
    }
}

edit=function(e){
    e.preventDefault();
    ELEMENT=$("tr[options=true]");
    if(typeof(ELEMENT)==="object"){
        ndMenu("tr[options=true]");
        $("#wrapper").remove();
        $("table").attr("in-use",true);
        table_state=$("table").attr("state");
        if(table_state=="edition"){
           return 0;
        }
        $("table").attr("state",true);
        ELEMENT.attr("in-use",true);
        childs=ELEMENT.children();
        l=childs.length-2;
        while(l>0){
            Elem=$(childs[l]);
            valeur=Elem.text();
            count_child=Elem.children().length;
//          name=Elem.attr("name");
            attr="modified=false phone=false ";
//          attr="modified='false' name='"+name+"'";
            if(count_child){//phone cell
               attr="modified=false phone=true ";
            }
            Elem.html('<input type="text" onkeyup="change_input(this,event)" oldvalue="'+valeur+'" value="'+valeur+'" '+attr+' />');
            l--;
        }
        $("table").attr("state","edition");

    }
}

editContext = function(e,elem){
    s=testUse(e,elem);
    if(s==0){
       return 0;
    }else edit(e);
}

remove=function(e){
    e.preventDefault();
    tr=$("tr[options=true]");
    table_state=$("table").attr("state");
    if(table_state=="edition"){
       return 0;
    }
    hideContext();
    tr.addClass("danger");
    tr.addClass("remove");
    console.log(tr);
    modal({
        Action:"open",
        type:2,
        Title:"Confirmation de suppression",
        notifType:"warning",
        msg:{
            Msg:"Etes-vous sûr de vouloir supprimer ce professeur? L'operation est irrévérsible!",
            VMsg:"Supprimer",
            CMsg:"Annuler la suppression"
        },
        Ret:{
            V:1,
            C:-1
        }
    },
         "modal({Action:'close'});confirmRemove();","modal({Action:'close'})");
}

confirmRemove = function(){
    //le superuser a confirme la suppression....
    //on passe les info par ajax
    tr=$("tr.remove");
    console.log(tr);
}

removeContext = function(e,elem){
    s=testUse(e,elem);
    if(s==0){
       return 0;
    }else remove(e);
}

cancel=function(e,valide,force){
    if(e!=null) e.preventDefault();
    tr=$("tr[in-use=true]");
    if(tr.length==1){
        hideContext();
        childs=tr.children();
        l=childs.length-2;
        modifications=Modified($(childs));
        if(modifications=="false" || force==1){//aucune modification, donc pas de pertes
           reset(childs,valide);
           stMenu("tr[options=true]");
           tr.removeAttr("in-use");
           $("table").attr("state",false);
           $("table").removeAttr("in-use");
           $("#wrapper").remove();

        }else{
            modal({
                Action:"open",
                Title:"Annuler les changements",
                msg:{
                    Msg:"Etes vous sûr de vouloir annuler les changements? toute modification sera perdu.",
                    VMsg:"Annuler les modifications",
                    CMsg:"Retour en arrière"
                },
                type:2,
                notifType:"warning",
                Ret:{
                    V:1,//annuler les changments
                    C:-1//on ferme juste le dialogue
                }
            },"cancel(null,0,1);modal({Action:'close'})","modal({Action:'close'})");
        }
    }
}

cancelContext = function(e,elem){
    s=testUse(e,elem);
    if(s==0){
       return 0;
    }else cancel(e);
}

field=["ref_prof","nom","prenom","tel","email","adresse","ville","grade","spe","code_depart"];
    
validate=function(e){
    e.preventDefault();
    tr=$("tr[in-use=true]");
    count=tr.length;
    hideContext();
    if(count==1){
        childs=tr.children();
        n=childs.length-1;
        i=1;
        changes=0;
        inputs=[];
        modifications=Modified(childs);
        if(modifications=="false"){
           alert("aucune modification n'a etet enregistyree");
        }else{
            while(i<n){
                child=$(childs[i]);
                field_name=child.attr("name");
                field_name=(field_name==undefined)?field[i-1]:field_name;
                field_value=$(child.children()).val();
                inputs[i-1]={name:field_name,value:field_value};
                i++;
            }
        }
        console.log(inputs);
        //apres l'envoie des donnees si tous c'est bien passe, on appele la fonction cancel(e)
        //sinn on affiche les erreurs
        
        reset(childs,true);
        $("table").attr("state",false);
        stMenu("tr[options=true]");
        $("tr").attr("in-use",false);
        $("tr").attr("options",false);
    }else console.log("Erreur survenue: nombre de tr avec le même attribut: "+count);

}

validateContext = function(e,elem){
    s=testUse(e,elem);
    if(s==0){
       return 0;
    }else validate(e);
}

change_input = function(tag,e){
    code=e.keyCode;
    if(code==13){
       validate(e);
    }else{
        $(tag).attr("modified",true);
    }
}

stMenu("tr ");

$("tbody tr").contextmenu(function(e){
    shown=$(".context-menu").attr("shown");
//    $("table").attr("state","context");
    X=0; Y=0; width=0; height=0;
    console.log($(this).attr("options"));
    if($(this).attr("options")=="false" && $("table").attr("state")=="edition" ){
       return 0;
    }
    
    if(disable_Context==false && !(shown==true)){
        e.preventDefault();
        X = e.pageX;
        Y = e.pageY;
        width=$(".context-menu").width();
        height=$(".context-menu").height();
        if((X+width)<docWidth){
            Xpos=X;
        }else Xpos=X-width;
        
        if((Y+height)<docHeight){
            Ypos=Y;
        }else Ypos=Y-height;
        
        $(".context-menu").css({top:Ypos,left:Xpos});
        $(".context-menu").attr("shown",true);
        //test si on est sur un tr on non
        disablContext();
        state=$("table").attr("state");
            switch(state){
                case undefined:
                case "false":// aucune ligne n'est selectionee
                    $(".context-menu #edit").removeClass("disabled");
                    $(".context-menu #remove").removeClass("disabled");
                    break;
                case "edition":
                case "in-use"://edition d'une ligne
                    $(".context-menu #cancel").removeClass("disabled");
                    $(".context-menu #validate").removeClass("disabled");
                    break;
                //default: $("table").attr("state",false);
            }
        //on affiche
        showContext();
    }
});



});