/*EVERTON JS*/
window.onload = function () {
    var url = window.location.href;
    var teste = /plugin/.test(url);
    if (teste) {
        $(".page-title-action").css({ "display": "block", "width": "100px" });
    } else {
        $(".page-title-action").css({ "display": "none" });
    }
    $("#adminmenu #menu-posts .wp-menu-name").html("Propostas");

    /* preparar email */
    var emailconteudista = $("#emailconteudista").html();
    //console.log(emailconteudista);   
    if ($("#message")) {
        var postenviado = $("#message p a");
        if (postenviado.html() == "Ver post" && emailconteudista != "") {
            var titulo = $("#title").val();
            var p = document.createElement("p");
            $.post("envia_email.php", { titulo: titulo, emailconteudista: emailconteudista }, function (data) {
                p.innerHTML = data;
                postenviado.after(p);
            });
        }
    }

    /* conteudista, criação do select multiplo */
    var conteudista = $("#conteudista select");
    conteudista.attr("class", "selectpicker");
    conteudista.attr("multiple", "multiple");
    conteudista.attr("data-live-search", "true");
    conteudista.selectpicker();

    /* conteudista, exibição do span do select */
    var displayconteudista = $("#conteudista .filter-option");
    displayconteudista.html($("#valcont").html());

    /* conteudista, atualiza value */
    var valorconteudista = $("#valcontid").html();
    var vetorvalor = valorconteudista.split(',')
    conteudista.val(vetorvalor);



    /*************** equipe da capacitação **************/
    
    var equipenome = $("#equipe-nome .acf-input input");
    var equipenomeval = equipenome.val().replace(/[\[\]\"]/g,"").split(',').filter(Boolean);
    equipenome.val(equipenomeval[0]);

    var equipesuperior = $("#equipe-superior .acf-input input");
    var equipesuperiorval = equipesuperior.val().replace(/[\[\]\"]/g,"").split(',').filter(Boolean);
    equipesuperior.val(equipesuperiorval[0]);

    var equipeunidade = $("#equipe-unidade .acf-input input");
    var equipeunidadeval = equipeunidade.val().replace(/[\[\]\"]/g,"").split(',').filter(Boolean);
    equipeunidade.val(equipeunidadeval[0]);

    var equipeemail = $("#equipe-email .acf-input input");
    var equipeemailval = equipeemail.val().replace(/[\[\]\"]/g,"").split(',').filter(Boolean);
    equipeemail.val(equipeemailval[0]);

    var equipeatuacao = $("#equipe-atuacao .acf-input1 select");
    var equipe_atuacao_hidden = $("#equipe_atuacao_hidden .acf-input input");
    equipe_atuacao_hidden_array = equipe_atuacao_hidden.val().split(',');
    equipe_atuacao_hidden.val(equipe_atuacao_hidden_array);
    equipeatuacao.val(equipe_atuacao_hidden_array[0]);

    var equipecargaeq = $("#equipe-cargaeq .acf-input input");
    var equipecargaeqval = equipecargaeq.val().replace(/[\[\]\"]/g,"").split(',').filter(Boolean);
    equipecargaeq.val(equipecargaeqval[0]); 
    
    var tamanho = equipenomeval.length;
    var campoeq = 1;

    while(tamanho > campoeq){ 
        var equipenome = $("#equipe-nome .acf-input" + campoeq);
        var equipesuperior = $("#equipe-superior .acf-input" + campoeq);
        var equipeunidade = $("#equipe-unidade .acf-input" + campoeq);
        var equipeemail = $("#equipe-email .acf-input" + campoeq);
        var equipeatuacao = $("#equipe-atuacao .acf-input" + campoeq);
        var equipecargaeq = $("#equipe-cargaeq .acf-input" + campoeq);
        campoeq++;

        equipenome.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-nome");
        $("#equipe-nome .acf-input" + campoeq + " input").val(equipenomeval[campoeq-1]);

        equipesuperior.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-superior");
        $("#equipe-superior .acf-input" + campoeq + " input").val(equipesuperiorval[campoeq-1]);
        
        equipeunidade.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-unidade");
        $("#equipe-unidade .acf-input" + campoeq + " input").val(equipeunidadeval[campoeq-1]);

        equipeemail.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-email");
        $("#equipe-email .acf-input" + campoeq + " input").val(equipeemailval[campoeq-1]);
        
        equipeatuacao.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-atuacao");
        $("#equipe-atuacao .acf-input" + campoeq + " select").attr('onchange', 'addatuacao(' + campoeq +')').val(equipe_atuacao_hidden_array[campoeq-1]);
        
        equipecargaeq.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-cargaeq");
        $("#equipe-cargaeq .acf-input" + campoeq + " input").val(equipecargaeqval[campoeq-1]);
    
        $("#qtdequipe").val(campoeq);
    }
    
    
    $("#equipe .btnp-equipe-capacitacao").click(() => {
        var equipenome = $("#equipe-nome .acf-input" + campoeq);
        var equipesuperior = $("#equipe-superior .acf-input" + campoeq);
        var equipeunidade = $("#equipe-unidade .acf-input" + campoeq);
        var equipeemail = $("#equipe-email .acf-input" + campoeq);
        var equipeatuacao = $("#equipe-atuacao .acf-input" + campoeq);
        var equipecargaeq = $("#equipe-cargaeq .acf-input" + campoeq);
        campoeq++;

        equipenome.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-nome");
        $("#equipe-nome .acf-input" + campoeq + " input").val("");

        equipesuperior.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-superior");
        $("#equipe-superior .acf-input" + campoeq + " input").val("");
        
        equipeunidade.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-unidade");
        $("#equipe-unidade .acf-input" + campoeq + " input").val("");

        equipeemail.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-email");
        $("#equipe-email .acf-input" + campoeq + " input").val("");
        
        equipeatuacao.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-atuacao");
        $("#equipe-atuacao .acf-input" + campoeq + " option:selected").val("");
        
        equipecargaeq.clone().attr('class', 'acf-input acf-input' + campoeq).appendTo("#equipe-cargaeq");
        $("#equipe-cargaeq .acf-input" + campoeq + " input").val("");

        $("#qtdequipe").val(campoeq);
    })

    $("#equipe .btnm-equipe-capacitacao").click(() => {
        if (campoeq > 1) {
            
            var equipenome = $("#equipe-nome .acf-input" + campoeq);
            equipenome.remove();

            var equipesuperior = $("#equipe-superior .acf-input" + campoeq);
            equipesuperior.remove();

            var equipeunidade = $("#equipe-unidade .acf-input" + campoeq);
            equipeunidade.remove();

            var equipeemail = $("#equipe-email .acf-input" + campoeq);
            equipeemail.remove();

            var equipeatuacao = $("#equipe-atuacao .acf-input" + campoeq);
            equipeatuacao.remove();

            var equipecargaeq = $("#equipe-cargaeq .acf-input" + campoeq);
            equipecargaeq.remove();
            
            campoeq--;
            $("#qtdequipe").val(campoeq);
        }
    })    

}