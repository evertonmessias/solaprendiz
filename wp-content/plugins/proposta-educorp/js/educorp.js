/*EVERTON JS*/

//funções externas ao onload
function calcularcarga() {
	var carga1 = document.querySelector("#carga1 input");
	var carga2 = document.querySelector("#carga2 input");
	var carga3 = document.querySelector("#carga3 input");
	var carga4 = document.querySelector("#carga4 input");
	var carga5 = document.querySelector("#carga5 input");
	var cargatotal = document.querySelector("#cargatotal input");
	if (carga1.value != "" && carga2.value != "" && carga3.value != "" && carga4.value != "" && carga5.value != "") {
		cargatotal.value = parseFloat(carga1.value) + parseFloat(carga2.value) + parseFloat(carga3.value) + parseFloat(carga4.value) + parseFloat(carga5.value);
	} else {
		cargatotal.value = 0;
	}
}

function addatuacao(val, indice) { //select
	var arrayeq = $("#equipe_atuacao_hidden .acf-input input").val().split(',');
	arrayeq[indice] = val;
	$("#equipe_atuacao_hidden .acf-input input").val(arrayeq);
}

window.onload = function () {

	function Razao(altura) {
		var largura = $(document).width();
		return largura / altura;
	}
	var razao = Razao(1600);

	//BARRA
	var inicial = 0;
	$(window).scroll(function () {
		var atualscroll = $(this).scrollTop();
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


	/* FUNÇÕES EXTRAS DO FORMULÁRIO */

	$("#wpbody h1.wp-heading-inline").html("Editar Proposta:");

	/* objetivo */

	var objetivo = $("#objetivo .acf-label");
	var strong = document.createElement("strong");
	strong.innerHTML = "1. Resultados para a SOCIEDADE:";
	objetivo.append(strong);

	var objetivo = $("#objetivo .acf-input ul li:nth-child(4)");
	var hr = document.createElement("hr");
	objetivo.append(hr);
	var strong = document.createElement("strong");
	strong.innerHTML = "2. Para excelência no ENSINO, PESQUISA E EXTENSÃO:";
	objetivo.append(strong);

	var objetivo = $("#objetivo .acf-input ul li:nth-child(9)");
	var hr = document.createElement("hr");
	objetivo.append(hr);
	var strong = document.createElement("strong");
	strong.innerHTML = "3. Para excelência na GESTÃO:";
	objetivo.append(strong);


	/* conteudista, criação do select */
	var conteudista = $("#conteudista select");
	var conteudistasoption = $("#conteudistas-option").val();
	var conteudistasvalue = $("#conteudistas-value").val();
	var conteudistaatual = $("#conteudistas-atual").val();

	var coption = conteudistasoption.split(',');
	var cvalue = conteudistasvalue.split(',');

	for (var i = 0; i < coption.length; i++) {
		var option = document.createElement("option");
		option.innerHTML = coption[i];
		option.setAttribute("value", cvalue[i]);
		conteudista.append(option);
	}

	conteudista.attr("class", "selectpicker");
	conteudista.attr("multiple", "multiple");
	conteudista.attr("data-live-search", "true");
	conteudista.selectpicker();
	$("#conteudista .filter-option").html(conteudistaatual);
	conteudista.val($("#idconteudista").val().split(','));

	/*II caracterização */

	var caracterizacao = $("#ementa");
	var h2 = document.createElement("h2");
	h2.setAttribute("style", "font-weight:600;font-size:20px;margin-left:-10px");
	h2.setAttribute("class", "conteudo conteudo2");
	h2.innerHTML = "<br>II. CARACTERIZAÇÃO DO CURSO";
	caracterizacao.before(h2);

	/* carga */

	var cargatotal = $("#cargatotal input");
	cargatotal.attr('readonly', true);

	var carga1 = $("#carga1 input");
	var carga2 = $("#carga2 input");
	var carga3 = $("#carga3 input");
	var carga4 = $("#carga4 input");
	var carga5 = $("#carga5 input");

	if (carga1.value == "") carga1.value = 0;
	if (carga2.value == "") carga2.value = 0;
	if (carga3.value == "") carga3.value = 0;
	if (carga4.value == "") carga4.value = 0;
	if (carga5.value == "") carga5.value = 0;
	if (cargatotal.value == "") cargatotal.value = 0;

	carga1.attr("min", "0");
	carga2.attr("min", "0");
	carga3.attr("min", "0");
	carga4.attr("min", "0");
	carga5.attr("min", "0");

	carga1.attr("oninput", "calcularcarga()");
	carga2.attr("oninput", "calcularcarga()");
	carga3.attr("oninput", "calcularcarga()");
	carga4.attr("oninput", "calcularcarga()");
	carga5.attr("oninput", "calcularcarga()");


	/*************** equipe da capacitação - arrays **************/

	var btnequipe = $("#equipe .acf-table");

	var span = document.createElement("span");
	span.setAttribute("class", "btnp-equipe-capacitacao");
	span.innerHTML = "<i class='bx bxs-plus-square'></i>";
	btnequipe.after(span);

	var span = document.createElement("span");
	span.setAttribute("class", "btnm-equipe-capacitacao");
	span.innerHTML = "<i class='bx bxs-minus-square'></i>";
	btnequipe.after(span);


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


	/*III caracterização*/
	var quantidade = $("#quantidade");
	var h2 = document.createElement("h2");
	h2.setAttribute("style", "font-weight:600;font-size:20px;margin-left:-10px");
	h2.setAttribute("class", "conteudo conteudo3");
	h2.innerHTML = "III. CARACTERIZAÇÃO DO OFERECIMENTO";
	quantidade.before(h2);

	/* calendario */
	$pretabela = "<table style='border-spacing: 0px;width: 100%;'><tbody><tr><td style='width=100px;padding:10px;border: 1px solid #000;'>Turma</td><td style='width=100px;padding:10px;border: 1px solid#000;'>Data</td><td style='width=100px;padding:10px;border: 1px solid #000;'>Dia da semana</td><td style='width=100px;padding:10px;border: 1px solid #000;'>Horário</td><td style='width=100px;padding:10px;border: 1px solid #000;'>Instrutor</td><td style='width=100px;padding:10px;border: 1px solid #000;'>Carga Horária</td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr></tbody></table>";

	var calendario = $("#calendario textarea");
	if (calendario.value == "") {
		calendario.value = $pretabela;
	}

	/*IV gerencial*/
	var pagamento = $("#pagamento");
	var h2 = document.createElement("h2");
	h2.setAttribute("style", "font-weight:600;font-size:20px;margin-left:-10px");
	h2.setAttribute("class", "conteudo conteudo4");
	h2.innerHTML = "IV. INFORMAÇÕES GERENCIAIS";
	pagamento.before(h2);

	/*pagamento*/
	$prepagamento = "<table style='border-spacing: 0px;width: 100%;'><tbody><tr><td style='width=120px;padding:10px;border: 1px solid #000;'>Nome</td><td style='width=120px;padding:10px;border: 1px solid #000;'>Dias</td><td style='width=120px;padding:10px;border: 1px solid #000;'>Atuação</td><td style='width=120px;padding:10px;border: 1px solid #000;'>Carga Horária</td><td style='width=120px;padding:10px;border: 1px solid #000;'>Valor</td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr></tbody></table>";
	var pagamento = $("#pagamento textarea");
	if (pagamento.value == "") {
		pagamento.value = $prepagamento;
	}

	//advanced-sortables 
	var submit = document.querySelector("#advanced-sortables");
	submit.setAttribute("class", "conteudo conteudo4");


	$("#quadro").click(function () {
		$("#quadro").css({ 'display': 'none' });
	})


	/*BOTOES ABAS*/
	var titulo = $("#titlediv");//titulo
	var submitdiv = $("#submitdiv");//submitdiv	
	$(".conteudo1").show();
	$(".abas li:first div").addClass("selected");
	var ehresp = $("#ehresp").val();

	$(".aba").click(function () {
		var indice = $(this).attr("value");

		//teste campos
		var ementa = $("#ementa textarea").val();
		var conteudo = $("#conteudo textarea").val();
		var metodologia = $("#metodologia textarea").val();
		var avaliacao = $("#avaliacao textarea").val();
		var criterios = $("#criterios textarea").val();
		var equipenome = $("#equipenome input").val();
		var bibliografia = $("#bibliografia textarea").val();
		
		/*
		console.log("Ementa " + ementa);
		console.log("Conteudo " + conteudo);
		console.log("Metodologia " + metodologia);
		console.log("Avaliacao " + avaliacao);
		console.log("Criter " + criterios);
		console.log("Equipe " + equipenome);
		console.log("Biblio " + bibliografia);
		*/

		var teste;
		if (ementa == "" || conteudo == "" || metodologia == "" || avaliacao == "" || criterios == "" || equipenome == "" || bibliografia == "") {
			teste = 0;
		} else {
			teste = 1;
		}

		if ((indice == 3 || indice == 4) && ehresp == "0" && teste == 0) {
				$("#quadro").show();
		}else{
		$(".aba").removeClass("selected");
		$(this).addClass("selected");

		$(".conteudo").hide();
		$(".conteudo" + indice).show();
		if (indice == 1) {
			razao = Razao(1600);
			titulo.removeClass("conteudo conteudo1");
		} else {
			titulo.addClass("conteudo conteudo1");
		}
		if (indice == 2) razao = Razao(2300);
		if (indice == 3) razao = Razao(600);
		if (indice == 4) {
			razao = Razao(100);
			submitdiv.css({ "display": "block" });
		} else {
			submitdiv.css({ "display": "none" });
		}
		$('html, body').animate({ scrollTop: 0 }, 500);
	}
	});

	$(".aba").hover(
		function () { $(this).addClass("ativa") },
		function () { $(this).removeClass("ativa") }
	);



	/* preparar email para o(s) conteudista(s) */
	var emailconteudista = $("#emailconteudista").val();
	if ($("#message")) {
		var postenviado = $("#message p a");
		if (postenviado.html() == "Ver post" && emailconteudista != "") {
			var titulo = $("#title").val();
			var p = document.createElement("p");
			$.post("/wp-content/plugins/proposta-educorp/envia_email.php", { titulo: titulo, emailconteudista: emailconteudista }, function (data) {
				p.innerHTML = data;
				postenviado.after(p);
			});
		}
	}
}