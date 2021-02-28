/*EVERTON JS*/
window.onload = function () {
    var urlBASE = window.location.href;
    var testePOST = /post\=59/.test(urlBASE);
    var testePAGE = /wp-admin\/edit\.php/.test(urlBASE);
    var testePLUGIN = /plugin/.test(urlBASE);
    if (testePLUGIN) {
        $(".page-title-action").css({ "display": "block", "width": "100px" });
    } else {
        $(".page-title-action").css({ "display": "none" });
    }    
    
    if (!testePOST && !testePAGE && !testePLUGIN) { 
        console.log("MODIFICAÇÃO DO FORMULÁRIO")
        $("#adminmenu #menu-posts .wp-menu-name").html("Propostas");

        /* preparar email */
        var emailconteudista = $("#emailconteudista").html();
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



        /*************** equipe da capacitação - arrays **************/
        $("#equipe .acf-table .acf-row").attr('class', 'acf-row acf-row1');

        $("#equipe .acf-table .acf-row1 #equipenome .acf-input input").attr('name', 'acf[field_6021db8cbc637][field_6021dc1f7e0c2][]');
        $("#equipe .acf-table .acf-row1 #equipesuperior .acf-input input").attr('name', 'acf[field_6021db8cbc637][field_6021dc7ce9663][]');
        $("#equipe .acf-table .acf-row1 #equipeunidade .acf-input input").attr('name', 'acf[field_6021db8cbc637][field_6021dcdae6dba][]');
        $("#equipe .acf-table .acf-row1 #equipeemail .acf-input input").attr('name', 'acf[field_6021db8cbc637][field_6021dd0a7ee6f][]');
        $("#equipe .acf-table .acf-row1 #equipeatuacao .acf-input select").attr('name', 'acf[field_6021db8cbc637][field_6021dd92761ea][]');
        $("#equipe .acf-table .acf-row1 #equipecargaeq .acf-input input").attr('name', 'acf[field_6021db8cbc637][field_6021dde570989][]');

        var arrayeq = $("#equipe_atuacao_hidden .acf-input input").val().split(',');

        function atualizaValor(campo, indice, type) {
            var tr = indice + 1;
            var td = $("#equipe .acf-table .acf-row" + tr + " #" + campo + " .acf-input " + type);
            if (type == "input") {
                var valor = td.val().replace(/[\[\]\"]/g, "").split(',').filter(Boolean);
                td.val(valor[indice]);
            } else if (type == "select") {
                array = $("#equipe_atuacao_hidden .acf-input input").val().split(',');
                td.val(array[indice]).attr("onchange", "addatuacao(this.value," + indice + ")");
            }
        }

        var campoeq = 1;
        while (arrayeq.length > campoeq) {
            var ind = campoeq;
            var linha = $("#equipe .acf-table .acf-row" + campoeq)
            campoeq++;
            linha.clone().attr('class', 'acf-row acf-row' + campoeq).appendTo("#equipe .acf-table");
        }

        var ind = 0;
        while (arrayeq.length > ind) {
            atualizaValor("equipenome", ind, "input");
            atualizaValor("equipesuperior", ind, "input");
            atualizaValor("equipeunidade", ind, "input");
            atualizaValor("equipeemail", ind, "input");
            atualizaValor("equipeatuacao", ind, "select");
            atualizaValor("equipecargaeq", ind, "input");
            ind++;
        }

        $("#equipe .btnp-equipe-capacitacao").click(() => {
            var linha = $("#equipe .acf-table .acf-row" + campoeq)
            var indice = campoeq;
            campoeq++;
            linha.clone().attr('class', 'acf-row acf-row' + campoeq).appendTo("#equipe .acf-table");
            $("#equipe .acf-table .acf-row" + campoeq + " #equipenome .acf-input input").val("");
            $("#equipe .acf-table .acf-row" + campoeq + " #equipesuperior .acf-input input").val("");
            $("#equipe .acf-table .acf-row" + campoeq + " #equipeunidade .acf-input input").val("");
            $("#equipe .acf-table .acf-row" + campoeq + " #equipeemail .acf-input input").val("");
            $("#equipe .acf-table .acf-row" + campoeq + " #equipeatuacao .acf-input select").val("").attr("onchange", "addatuacao(this.value," + indice + ")");
            $("#equipe .acf-table .acf-row" + campoeq + " #equipecargaeq .acf-input input").val("");
            arrayeq[campoeq - 1] = ".";
            $("#equipe_atuacao_hidden .acf-input input").val(arrayeq);

        })

        $("#equipe .btnm-equipe-capacitacao").click(() => {
            if (campoeq > 1) {
                $("#equipe .acf-table .acf-row" + campoeq).remove();
                campoeq--;
                arrayeq.pop();
                $("#equipe_atuacao_hidden .acf-input input").val(arrayeq);
            }
        })

    }
}