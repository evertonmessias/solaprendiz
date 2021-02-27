/*EVERTON JS*/
window.onload = function () {
    var url = window.location.href;
    var teste = /plugin/.test(url);
    if (teste) {
        $(".page-title-action").css({ "display": "block","width":"100px" });
    } else {
        $(".page-title-action").css({ "display": "none" });
    }
    $("#adminmenu #menu-posts .wp-menu-name").html("Propostas");

	/* preparar email */
    var emailconteudista = $("#emailconteudista").html(); 
    //console.log(emailconteudista);   
	if($("#message")){
        var postenviado = $("#message p a");
        if(postenviado.html() == "Ver post" && emailconteudista != ""){
            var titulo = $("#title").val();                             
            var p = document.createElement("p");
            $.post("envia_email.php", {titulo:titulo,emailconteudista:emailconteudista}, function (data) {
                p.innerHTML = data;
                postenviado.after(p);                                
            });
        }
    }

    /* conteudista, criação do select multiplo */	
    var conteudista = $("#conteudista select");    
	conteudista.attr("class", "selectpicker");
	conteudista.attr("multiple","multiple");
	conteudista.attr("data-live-search", "true");
    conteudista.selectpicker();    

	/* conteudista, exibição do span do select */	
    var displayconteudista = $("#conteudista .filter-option");
    displayconteudista.html($("#valcont").html());
	
	/* conteudista, atualiza value */    
    var valorconteudista = $("#valcontid").html();
	var vetorvalor = valorconteudista.split(',')
	conteudista.val(vetorvalor);
}