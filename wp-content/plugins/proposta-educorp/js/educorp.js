/*EVERTON JS*/

//calcula o valor total da carga horária   ***************************************************************
function calcularcarga() {
	var carga1 = document.querySelector("#carga #carga1");
	var carga2 = document.querySelector("#carga #carga2");
	var carga3 = document.querySelector("#carga #carga3");
	var carga4 = document.querySelector("#carga #carga4");
	var carga5 = document.querySelector("#carga #carga5");
	var cargatotal = document.querySelector("#carga #cargatotal");
	if (carga1.value != "" && carga2.value != "" && carga3.value != "" && carga4.value != "" && carga5.value != "") {
		cargatotal.value = parseFloat(carga1.value) + parseFloat(carga2.value) + parseFloat(carga3.value) + parseFloat(carga4.value) + parseFloat(carga5.value);
	}else{
		cargatotal.value = 0;
	}
}

// cria e apaga linhas na EQUIPE   **********************************************************************
function criaLinha() {
	var nl = $("#nl").val()
	nl++;
	$("#equipe table .linha1").clone().attr('class', 'linha' + nl).appendTo("#equipe table");
	$("#equipe table .linha" + nl + " td .equipe1").val("").attr('oninput', 'atualizaValor(this.value,' + nl + ',1)');
	$("#equipe table .linha" + nl + " td .equipe2").val("");
	$("#equipe table .linha" + nl + " td .equipe3").val("");
	$("#equipe table .linha" + nl + " td .equipe4").val("");
	$("#equipe table .linha" + nl + " td .equipe5").val("").attr('oninput', 'atualizaValor(this.value,' + nl + ',5);filterChar(this.value,this)');
	$("#equipe table .linha" + nl + " td .equipe6").val("").attr('oninput', 'atualizaValor(this.value,' + nl + ',6)');

	$("#calendario table .linha1").clone().attr('class', 'linha' + nl).appendTo("#calendario table");
	$("#calendario table .linha" + nl + " td .calendario1").val("").attr("oninput","filterChar(this.value,this)");
	$("#calendario table .linha" + nl + " td .calendario2").val("").attr("oninput","filterChar(this.value,this)");
	$("#calendario table .linha" + nl + " td .calendario3").val("").attr("oninput","filterChar(this.value,this)");
	$("#calendario table .linha" + nl + " td .calendario4").val("");
	$("#calendario table .linha" + nl + " td .calendario5").val("");
	$("#calendario table .linha" + nl + " td .calendario6").val("");
	$("#calendario table .linha" + nl + " td .calendario7").val("");
	$("#calendario table .linha" + nl + " td .calendario8").val("");

	$("#pagamento table .linha1").clone().attr('class', 'linha' + nl).appendTo("#pagamento table");
	$("#pagamento table .linha" + nl + " td .pagamento1").val("");
	$("#pagamento table .linha" + nl + " td .pagamento2").val("").attr("oninput", "filterChar(this.value,this)")
	$("#pagamento table .linha" + nl + " td .pagamento3").val("");
	$("#pagamento table .linha" + nl + " td .pagamento4").val("").attr("oninput", "valorAtuacao(this.value," + nl + ");filterChar(this.value,this)")
	$("#pagamento table .linha" + nl + " td .pagamento5").val("");

	$("#nl").val(nl);
}
function apagaLinha() {
	var nl = $("#nl").val()
	if (nl > 1) {
		$("#equipe table .linha" + nl + " td .equipe1").val("");
		$("#equipe table .linha" + nl + " td .equipe2").val("");
		$("#equipe table .linha" + nl + " td .equipe3").val("");
		$("#equipe table .linha" + nl + " td .equipe4").val("");
		$("#equipe table .linha" + nl + " td .equipe5").val("");
		$("#equipe table .linha" + nl + " td .equipe6").val("");
		$("#equipe table .linha" + nl).remove();

		$("#calendario table .linha" + nl + " td .calendario1").val("");
		$("#calendario table .linha" + nl + " td .calendario2").val("");
		$("#calendario table .linha" + nl + " td .calendario3").val("");
		$("#calendario table .linha" + nl + " td .calendario4").val("");
		$("#calendario table .linha" + nl + " td .calendario5").val("");
		$("#calendario table .linha" + nl + " td .calendario6").val("");
		$("#calendario table .linha" + nl + " td .calendario7").val("");
		$("#calendario table .linha" + nl + " td .calendario8").val("");
		$("#calendario table .linha" + nl).remove();

		$("#pagamento table .linha" + nl + " td .pagamento1").val("");
		$("#pagamento table .linha" + nl + " td .pagamento2").val("");
		$("#pagamento table .linha" + nl + " td .pagamento3").val("");
		$("#pagamento table .linha" + nl + " td .pagamento4").val("");
		$("#pagamento table .linha" + nl + " td .pagamento5").val("");
		$("#pagamento table .linha" + nl).remove();

		nl--;
		$("#nl").val(nl);
	}
}

function atualizaValor(valor, linha, coluna) {
	if (coluna == 1) {
		$("#calendario table .linha" + linha + " .calendario7").val(valor);
		$("#pagamento table .linha" + linha + " .pagamento1").val(valor);
	}
	if (coluna == 5) {
		$("#calendario table .linha" + linha + " .calendario8").val(valor);
		$("#pagamento table .linha" + linha + " .pagamento4").val(valor);
	}
	if (coluna == 6) $("#pagamento table .linha" + linha + " .pagamento3").val(valor);
}

function valorAtuacao(valor, linha) {	
	var proposta_input_name1 = $("#proposta_input_name1").val();
	var proposta_input_name2 = $("#proposta_input_name2").val();
	var proposta_input_name3 = $("#proposta_input_name3").val();
	var proposta_input_name4 = $("#proposta_input_name4").val();
	var proposta_input_name5 = $("#proposta_input_name5").val();
	var proposta_input_name6 = $("#proposta_input_name6").val();

	var atuacao = $("#pagamento table .linha" + linha + " .pagamento3").val();

	var ValorAtuac;

	if (atuacao == "Instrutor") ValorAtuac = proposta_input_name1;
	if (atuacao == "Tutor") ValorAtuac = proposta_input_name2;
	if (atuacao == "Monitor") ValorAtuac = proposta_input_name3;
	if (atuacao == "Conteudista Presencial") ValorAtuac = proposta_input_name4;
	if (atuacao == "Conteudista Remoto Síncrono") ValorAtuac = proposta_input_name5;
	if (atuacao == "Conteudista Remoto Assíncrono") ValorAtuac = proposta_input_name6;

	$("#pagamento table .linha" + linha + " .pagamento5").val(valor * ValorAtuac);

	var nl = $("#nl").val();

	var somatorio = 0;
	var valorx = 0;
	for (var i = 1; i <= nl; i++) {
		valorx = $("#pagamento table .linha" + i + " .pagamento5").val() * 1;
		somatorio = somatorio + valorx;
	}
	$("#pagamento #total").val(somatorio);
}

function filterChar(valor,campo){	
	if(isNaN(valor)){
		campo.value = "";
		campo.setAttribute("placeholder","Digite Numeros !")		
	}else{
		campo.removeAttribute("placeholder");
	}
}

window.onload = function () {  //onload **********************************

	function Razao(altura) {
		var largura = $(document).width();
		return largura / altura;
	}
	var razao = Razao(1650);

	//BARRA ***************************************************************
	var inicial = 0;
	$(window).scroll(function () {
		var atualscroll = $(this).scrollTop();
		//console.log(atualscroll);
		if (atualscroll > inicial) {
			$('#barra').css({ 'width': atualscroll * razao });
		} else {
			$('#barra').css({ 'width': atualscroll * razao });
		}
		inicial = atualscroll;

		if ($(this).scrollTop() > 200) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});

	$('.scrollToTop').click(function () {
		$('html, body').animate({ scrollTop: 0 }, 500);
		return false;
	});

	//QUADRO  ***************************************************************

	$("#quadro").click(function () {
		$("#quadro").css({ 'display': 'none' });
	})

	//ATUALIZA CAMPO CONTEUDISTA *******************************************************

	$("#conteudista .filter-option").html($("#cont").val());

	// ATUALIZA CAMPOS DA EQUIPE *******************************************************
	var equipe1 = $("#equipe table .linha1 .equipe1").val().split(",");
	var equipe2 = $("#equipe table .linha1 .equipe2").val().split(",");
	var equipe3 = $("#equipe table .linha1 .equipe3").val().split(",");
	var equipe4 = $("#equipe table .linha1 .equipe4").val().split(",");
	var equipe5 = $("#equipe table .linha1 .equipe5").val().split(",");
	var equipe6 = $("#equipe table .linha1 .equipe6").val().split(",");

	$("#equipe table .linha1 .equipe1").val(equipe1[0]);
	$("#equipe table .linha1 .equipe2").val(equipe2[0]);
	$("#equipe table .linha1 .equipe3").val(equipe3[0]);
	$("#equipe table .linha1 .equipe4").val(equipe4[0]);
	$("#equipe table .linha1 .equipe5").val(equipe5[0]);
	$("#equipe table .linha1 .equipe6").val(equipe6[0]);

	var nl = $("#nl").val();
	var ind = 1;
	while (nl > ind) {
		var lin = ind + 1;
		$("#equipe table .linha1").clone().attr('class', 'linha' + lin).appendTo("#equipe table");
		$("#equipe table .linha" + lin + " .equipe1").val(equipe1[ind]).attr('oninput', 'atualizaValor(this.value,' + lin + ',1)');
		$("#equipe table .linha" + lin + " .equipe2").val(equipe2[ind]);
		$("#equipe table .linha" + lin + " .equipe3").val(equipe3[ind]);
		$("#equipe table .linha" + lin + " .equipe4").val(equipe4[ind]);
		$("#equipe table .linha" + lin + " .equipe5").val(equipe5[ind]).attr('oninput', 'atualizaValor(this.value,' + lin + ',5);filterChar(this.value,this)');
		$("#equipe table .linha" + lin + " .equipe6").val(equipe6[ind]).attr('oninput', 'atualizaValor(this.value,' + lin + ',6)');
		ind++;
	}

	// ATUALIZA CAMPOS DO CALENDARIO *******************************************************
	var calendario1 = $("#calendario table .linha1 .calendario1").val().split(",");
	var calendario2 = $("#calendario table .linha1 .calendario2").val().split(",");
	var calendario3 = $("#calendario table .linha1 .calendario3").val().split(",");
	var calendario4 = $("#calendario table .linha1 .calendario4").val().split(",");
	var calendario5 = $("#calendario table .linha1 .calendario5").val().split(",");
	var calendario6 = $("#calendario table .linha1 .calendario6").val().split(",");
	var calendario7 = equipe1;
	var calendario8 = equipe5;

	$("#calendario table .linha1 .calendario1").val(calendario1[0]);
	$("#calendario table .linha1 .calendario2").val(calendario2[0]);
	$("#calendario table .linha1 .calendario3").val(calendario3[0]);
	$("#calendario table .linha1 .calendario4").val(calendario4[0]);
	$("#calendario table .linha1 .calendario5").val(calendario5[0]);
	$("#calendario table .linha1 .calendario6").val(calendario6[0]);
	$("#calendario table .linha1 .calendario7").val(calendario7[0]);
	$("#calendario table .linha1 .calendario8").val(calendario8[0]);

	var nl = $("#nl").val();
	var ind = 1;
	while (nl > ind) {
		var lin = ind + 1;
		$("#calendario table .linha1").clone().attr('class', 'linha' + lin).appendTo("#calendario table");
		$("#calendario table .linha" + lin + " .calendario1").val(calendario1[ind]).attr("oninput","filterChar(this.value,this)");
		$("#calendario table .linha" + lin + " .calendario2").val(calendario2[ind]).attr("oninput","filterChar(this.value,this)");
		$("#calendario table .linha" + lin + " .calendario3").val(calendario3[ind]).attr("oninput","filterChar(this.value,this)");
		$("#calendario table .linha" + lin + " .calendario4").val(calendario4[ind]);
		$("#calendario table .linha" + lin + " .calendario5").val(calendario5[ind]);
		$("#calendario table .linha" + lin + " .calendario6").val(calendario6[ind]);
		$("#calendario table .linha" + lin + " .calendario7").val(calendario7[ind]);
		$("#calendario table .linha" + lin + " .calendario8").val(calendario8[ind]);
		ind++;
	}


	// ATUALIZA CAMPOS DO PAGAMENTO *******************************************************
	var pagamento1 = equipe1;
	var pagamento2 = $("#pagamento table .linha1 .pagamento2").val().split(",");
	var pagamento3 = equipe6;
	var pagamento4 = $("#pagamento table .linha1 .pagamento4").val().split(",");
	var pagamento5 = $("#pagamento table .linha1 .pagamento5").val().split(",");

	$("#pagamento table .linha1 .pagamento1").val(pagamento1[0]);
	$("#pagamento table .linha1 .pagamento2").val(pagamento2[0]);
	$("#pagamento table .linha1 .pagamento3").val(pagamento3[0]);
	$("#pagamento table .linha1 .pagamento4").val(pagamento4[0]);
	$("#pagamento table .linha1 .pagamento5").val(pagamento5[0]);

	var nl = $("#nl").val();
	var ind = 1;
	while (nl > ind) {
		var lin = ind + 1;
		$("#pagamento table .linha1").clone().attr('class', 'linha' + lin).appendTo("#pagamento table");
		$("#pagamento table .linha" + lin + " .pagamento1").val(pagamento1[ind]);
		$("#pagamento table .linha" + lin + " .pagamento2").val(pagamento2[ind]).attr("oninput","filterChar(this.value,this)");
		$("#pagamento table .linha" + lin + " .pagamento3").val(pagamento3[ind]);
		$("#pagamento table .linha" + lin + " .pagamento4").val(pagamento4[ind]).attr("oninput", "valorAtuacao(this.value," + lin + ");filterChar(this.value,this)")
		$("#pagamento table .linha" + lin + " .pagamento5").val(pagamento5[ind]);
		ind++;
	}

	// TESTA CAMPOS
	function testacampos(pagina) {
		if (pagina == 2) {
			//teste campos
			var ementa = $("#ementa textarea").val();
			var conteudo = $("#conteudo textarea").val();
			var metodologia = $("#metodologia textarea").val();
			var avaliacao = $("#avaliacao textarea").val();
			var criterios = $("#criterios textarea").val();
			var equipe1 = $("#equipe .linha1 .equipe1").val();
			var equipe2 = $("#equipe .linha1 .equipe2").val();
			var equipe3 = $("#equipe .linha1 .equipe3").val();
			var equipe4 = $("#equipe .linha1 .equipe4").val();
			var equipe5 = $("#equipe .linha1 .equipe5").val();
			var equipe6 = $("#equipe .linha1 .equipe6").val();
			var bibliografia = $("#bibliografia textarea").val();

			/*
			console.log("Ementa " + ementa);
			console.log("Conteudo " + conteudo);
			console.log("Metodologia " + metodologia);
			console.log("Avaliacao " + avaliacao);
			console.log("Criter " + criterios);
			console.log("Equipe " + equipe1+" "+equipe2+" "+equipe3+" "+equipe4+" "+equipe5+" "+equipe6);
			console.log("Biblio " + bibliografia);
			*/

			if (ementa == "" || conteudo == "" || metodologia == "" || avaliacao == "" || criterios == "" || equipe1 == "" || equipe2 == "" || equipe3 == "" || equipe4 == "" || equipe5 == "" || equipe6 == "" || bibliografia == "") {
				return 0;
			} else {
				return 1;
			}
		}else if(pagina == 3){
			var calendario1 = $("#calendario .linha1 .calendario1").val();
			var calendario2 = $("#calendario .linha1 .calendario2").val();
			var calendario3 = $("#calendario .linha1 .calendario3").val();
			var calendario4 = $("#calendario .linha1 .calendario4").val();
			var calendario5 = $("#calendario .linha1 .calendario5").val();
			var calendario6 = $("#calendario .linha1 .calendario6").val();
			var calendario7 = $("#calendario .linha1 .calendario7").val();
			var calendario8 = $("#calendario .linha1 .calendario8").val();
			var local = $("#local textarea").val();

			//console.log("Calendario " + calendario1+" "+calendario2+" "+calendario3+" "+calendario4+" "+calendario5+" "+calendario6+" "+calendario7+" "+calendario8);
			//console.log("Local " + local);

			if (local == "" || calendario1 == "" || calendario2 == "" || calendario3 == "" || calendario4 == "" || calendario5 == "" || calendario6 == "" || calendario7 == "" || calendario8 == "") {
				return 0;
			} else {
				return 1;
			}

		}
	}


	//BOTOES ABAS  *************************************************************** 

	$("#ativado_id").attr("class", "postbox conteudo conteudo1");
	$("#contexto_id").attr("class", "postbox conteudo conteudo1");
	$("#objetivo_id").attr("class", "postbox conteudo conteudo1");
	$("#capacitacao_id").attr("class", "postbox conteudo conteudo1");
	$("#publico_id").attr("class", "postbox conteudo conteudo1");
	$("#estimativa_id").attr("class", "postbox conteudo conteudo1");
	$("#aplicacao_id").attr("class", "postbox conteudo conteudo1");
	$("#conteudista_id").attr("class", "postbox conteudo conteudo1");

	$("#ementa_id").attr("class", "postbox conteudo conteudo2");
	$("#conteudo_id").attr("class", "postbox conteudo conteudo2");
	$("#modalidade_id").attr("class", "postbox conteudo conteudo2");
	$("#metodologia_id").attr("class", "postbox conteudo conteudo2");
	$("#avaliacao_id").attr("class", "postbox conteudo conteudo2");
	$("#criterios_id").attr("class", "postbox conteudo conteudo2");
	$("#carga_id").attr("class", "postbox conteudo conteudo2");
	$("#equipe_id").attr("class", "postbox conteudo conteudo2");
	$("#bibliografia_id").attr("class", "postbox conteudo conteudo2");

	$("#calendario_id").attr("class", "postbox conteudo conteudo3");
	$("#local_id").attr("class", "postbox conteudo conteudo3");

	$("#pagamento_id").attr("class", "postbox conteudo conteudo4");
	$("#msgfinal_id").attr("class", "postbox conteudo conteudo4");	
	$("#submit_id").attr("class", "postbox conteudo conteudo4");

	$(".conteudo1").show();
	$(".abas li:first div").addClass("selected");

	var ehresp = $("#ehresp").val();
	if(ehresp == 0){
		$("#pagamento").hide();
		$("#msgfinal").show();
	}else{
		$("#pagamento").show();
		$("#msgfinal").hide();
	}

	$(".aba").click(function () {
		var indice = $(this).attr("value");

		if ((indice == 3 || indice == 4) && ehresp == "0" && testacampos(2) == 0) {
			$("#quadro").show();
		}else if(indice == 4 && ehresp == "0" && testacampos(3) == 0){
			$("#quadro").show();
		}else {
			$(".aba").removeClass("selected");
			$(this).addClass("selected");
			if (indice == 1) {
				razao = Razao(1650);
				$("#titlediv").show();
			} else {
				$("#titlediv").hide();
			}
			if (indice == 2) razao = Razao(1800);
			if (indice == 3) razao = Razao(60);
			if (indice == 4) razao = Razao(20);
			$(".conteudo").hide();
			$(".conteudo" + indice).show();
			$('html, body').animate({ scrollTop: 0 }, 500);
		}
	});

	$(".aba").hover(
		function () { $(this).addClass("ativa") },
		function () { $(this).removeClass("ativa") }
	);

	//preparar email para o(s) conteudista(s) ***************************************************************
	var emailconteudista = $("#emailconteudista").val();
	var adminemail = $("#adminemail").val();
	if ($("#message")) {
		var postenviado = $("#message p a");
		if (postenviado.html() == "Ver post" && emailconteudista != "") {
			var titulo = $("#title").val();
			var p = document.createElement("p");
			$.post("/wp-content/plugins/proposta-educorp/includes/email.php", { ehresp: ehresp,adminemail:adminemail, titulo: titulo, emailconteudista: emailconteudista }, function (data) {
				p.innerHTML = data;
				postenviado.after(p);
			});
		}
	}

}