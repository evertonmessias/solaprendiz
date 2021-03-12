<?php

// FIELDS POST META **********************************

// ATIVADO **********************************

function campo_box_ativado()
{
	add_meta_box('ativado_id', 'Ativado', 'campo_ativado', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_ativado');
function campo_ativado($post)
{
	$value = get_post_meta($post->ID, 'ativado', true);
	if ($value == 'on') {
		$checked = "checked='checked'";
	} else {
		$checked = "";
	}
?> <div id="ativado">
		<h4 class="wp-heading-inline">1.1 ATIVAR EDIÇÃO</h4>
		<p class="post-sub-title">Ativa ou desativa a edição dessa proposta para o(s) conteudista(s).</p>
		<input type="checkbox" name="ativado" <?php echo $checked; ?> />
	</div>
<?php }

// CONTEXTO **********************************

function campo_box_contexto()
{
	add_meta_box('contexto_id', 'Contexto', 'campo_contexto', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_contexto');
function campo_contexto($post)
{
	$value = get_post_meta($post->ID, 'contexto', true);
?>
	<div id="contexto">
		<h4 class="wp-heading-inline">2. ANÁLISE CONTEXTUAL</h4>
		<p class="post-sub-title">Contextualize detalhadamente o cenário na Unicamp que justifica o oferecimento da capacitação, inclusive indicando legislação regulamentadora do assunto, quando couber.</p>
		<textarea name="contexto" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }

// OBJETIVO **********************************

function campo_box_objetivo()
{
	add_meta_box('objetivo_id', 'objetivo', 'campo_objetivo', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_objetivo');
function campo_objetivo($post)
{
	$value = [];
	$checked = [];
	for ($i = 1; $i <= 13; $i++) {
		$obj = "objetivo" . $i;
		$value[$i] = get_post_meta($post->ID, $obj, true);
		if ($value[$i] == 'on') {
			$checked[$i] = "checked='checked'";
		} else {
			$checked[$i] = "";
		}
	}
?><div id="objetivo">
		<h4 class="wp-heading-inline">3. OBJETIVO ESTRATÉGICO PLANES 2021-2025</h4>
		<p class="post-sub-title">Marque com um X os objetivos estratégicos com os quais a capacitação proposta contribuirá</p>
		<p><b>1. Resultados para a SOCIEDADE:</b></p>
		<label><input type="checkbox" name="objetivo1" <?php echo $checked[1]; ?> />&ensp;1.1. Ampliar o acesso e a diversidade da comunidade universitária e as políticas de inclusão, permanência e apoio acadêmico.</label><br>
		<label><input type="checkbox" name="objetivo2" <?php echo $checked[2]; ?> />&ensp;1.2. Promover a inovação, extensão, cultura e transferência de conhecimento, intensificando a cooperação dialógica com o poder público e a sociedade, em consonância com os Objetivos de Desenvolvimento Sustentável.</label><br>
		<label><input type="checkbox" name="objetivo3" <?php echo $checked[3]; ?> />&ensp;1.3. Desenvolver uma cultura de interação com os egressos, contribuindo para o aprimoramento da Universidade</label><br>
		<label><input type="checkbox" name="objetivo4" <?php echo $checked[4]; ?> />&ensp;1.4. Ampliar e fortalecer a comunicação efetiva com os diversos setores da sociedade, buscando dar visibilidade às nossas atividades e seus impactos.</label><br>
		<p><b>2. Para excelência no ENSINO, PESQUISA E EXTENSÃO:</b></p>
		<label><input type="checkbox" name="objetivo5" <?php echo $checked[5]; ?> />&ensp;2.1. Ampliar visibilidade dos programas de ensino, em todos os níveis, para que mais estudantes se sintam atraídos pela experiência formativa da UNICAMP.</label><br>
		<label><input type="checkbox" name="objetivo6" <?php echo $checked[6]; ?> />&ensp;2.2. Ter currículos atualizados, flexíveis, centrados no estudante, que utilizem recursos tecnológicos e incorporem atividades extra curriculares, co-curriculares e de extensão em todos os níveis de ensino.</label><br>
		<label><input type="checkbox" name="objetivo7" <?php echo $checked[7]; ?> />&ensp;2.3. Promover pesquisas integradas de forma a assumir o protagonismo frente aos desafios da sociedade contemporânea.</label><br>
		<label><input type="checkbox" name="objetivo8" <?php echo $checked[8]; ?> />&ensp;2.4. Reconhecer e valorizar as atividades de extensão na carreira docente e no ambiente acadêmico discente.</label><br>
		<label><input type="checkbox" name="objetivo9" <?php echo $checked[9]; ?> />&ensp;2.5. Intensificar as parcerias com diferentes setores da sociedade como forma de diversificar as fontes de captação nacional e internacional de recursos de pesquisa.</label><br>
		<p><b>3. Para excelência na GESTÃO:</b></p>
		<label><input type="checkbox" name="objetivo10" <?php echo $checked[10]; ?> />&ensp;3.1. Aprimorar a atratividade das carreiras da Universidade visando a preservação dos quadros de alto nível condizentes com a missão e a visão de futuro da UNICAMP.</label><br>
		<label><input type="checkbox" name="objetivo11" <?php echo $checked[11]; ?> />&ensp;3.2. Garantir a sustentabilidade orçamentária, financeira, operacional e de infraestrutura da Universidade.</label><br>
		<label><input type="checkbox" name="objetivo12" <?php echo $checked[12]; ?> />&ensp;3.3. Aperfeiçoar e modernizar o modelos de gestão administrativa e acadêmica que garanta o bom desenvolvimento das atividades-fim da Universidade.</label><br>
		<label><input type="checkbox" name="objetivo13" <?php echo $checked[13]; ?> />&ensp;3.4. Estabelecer um modelo sustentável de gestão financeira e administrativa para a área da saúde.</label><br>
	</div>
<?php }


// CAPACITAÇÃO **********************************

function campo_box_capacitacao()
{
	add_meta_box('capacitacao_id', 'capacitacao', 'campo_capacitacao', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_capacitacao');
function campo_capacitacao($post)
{
	$value = get_post_meta($post->ID, 'capacitacao', true);
?>
	<div id="capacitacao">
		<h4 class="wp-heading-inline">4. OBJETIVOS DA CAPACITAÇÃO</h4>
		<p class="post-sub-title">Explicite quais as necessidades específicas do negócio serão atendidas com essa capacitação.</p>

		<textarea name="capacitacao" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }


// PUBLICO **********************************

function campo_box_publico()
{
	add_meta_box('publico_id', 'publico', 'campo_publico', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_publico');
function campo_publico($post)
{
	$value = get_post_meta($post->ID, 'publico', true);
?><div id="publico">
		<h4 class="wp-heading-inline">5. PÚBLICO-ALVO</h4>
		<p class="post-sub-title">Detalhe o público alvo que deverá participar da capacitação, indicando local/área/processos de trabalho, nível de decisão (ingressante no processo, experiente, gerente) e outras informações que caracterizem bem esse público, indicando a quantidade estimada de todo público a ser treinado. Esta informação é importante para divulgação e priorização das inscrições nas turmas.</p>

		<textarea name="publico" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }


// ESTIMATIVA **********************************

function campo_box_estimativa()
{
	add_meta_box('estimativa_id', 'estimativa', 'campo_estimativa', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_estimativa');
function campo_estimativa($post)
{
	$value = get_post_meta($post->ID, 'estimativa', true);
?><div id="estimativa">
		<h4 class="wp-heading-inline">6. ESTIMATIVA DE QUANTIDADE DE PÚBLICO-ALVO</h4>
		<p class="post-sub-title">Dimensione a quantidade total de pessoas na UNICAMP que necessita dessa capacitação.</p>
		<textarea name="estimativa" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }

// APLICAÇÃO **********************************

function campo_box_aplicacao()
{
	add_meta_box('aplicacao_id', 'aplicacao', 'campo_aplicacao', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_aplicacao');
function campo_aplicacao($post)
{
	$value = get_post_meta($post->ID, 'aplicacao', true);
?><div id="aplicacao">
		<h4 class="wp-heading-inline">7. APLICAÇÃO</h4>
		<p class="post-sub-title">Indique o que os participantes farão diferentemente e melhor nos seus locais de trabalho após vivenciarem essa capacitação.</p>

		<textarea name="aplicacao" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }


// CONTEUDISTA **********************************

function campo_box_conteudista()
{
	add_meta_box('conteudista_id', 'conteudista', 'campo_conteudista', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_conteudista');
function campo_conteudista($post)
{
	$value = get_post_meta($post->ID, 'conteudista', true);
	$value = explode(',', $value);
	$conteudistas = get_users(array('role__in' => array('conteudista')));
	$nomes = [];
	foreach ($conteudistas as $conteudista) {
		foreach ($value as $val) {
			if ($val == $conteudista->ID) {
				$nomes[] = $conteudista->display_name;
			}
		}
	}
?>
	<input type="hidden" id="cont" value="<?php echo implode(',', $nomes); ?>">
	<div id="conteudista">		
		<h4 class="wp-heading-inline">8. CONTEUDISTA(s) DA PROPOSTA</h4>
		<p class="post-sub-title">Selecione o(s) conteudista(s) para esta proposta. ( será enviado um e-mail ao(s) conteudista(s) )</p>

		<select name="conteudista[]" class="selectpicker" multiple="multiple" data-live-search="true">
			<option value="">Ninguém</option>
			<?php
			foreach ($conteudistas as $conteudista) {
				echo "<option value=" . $conteudista->ID . ">" . $conteudista->display_name . "</option>";
			}
			?>
		</select>
	</div>
<?php }


// EMENTA **********************************

function campo_box_ementa()
{
	add_meta_box('ementa_id', 'ementa', 'campo_ementa', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_ementa');
function campo_ementa($post)
{
	$value = get_post_meta($post->ID, 'ementa', true);
?><div id="ementa">
		<h1><b>II. CARACTERIZAÇÃO DO CURSO</b></h1>
		<h4 class="wp-heading-inline">1. EMENTA</h4>
		<p class="post-sub-title">Resumo dos principais temas/tópicos/disciplinas que caracterizam o curso.</p>
		<textarea name="ementa" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }


// CONTEUDO **********************************

function campo_box_conteudo()
{
	add_meta_box('conteudo_id', 'conteudo', 'campo_conteudo', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_conteudo');
function campo_conteudo($post)
{
	$value = get_post_meta($post->ID, 'conteudo', true);
?><div id="conteudo">
		<h4 class="wp-heading-inline">2. CONTEÚDO PROGRAMÁTICO</h4>
		<p class="post-sub-title">Desdobramento da ementa, explicitando o conteúdo a ser abordado, dividindo-o em aulas.</p>
		<textarea name="conteudo" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }


// MODALIDADE **********************************

function campo_box_modalidade()
{
	add_meta_box('modalidade_id', 'modalidade', 'campo_modalidade', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_modalidade');
function campo_modalidade($post)
{
	$value = get_post_meta($post->ID, 'modalidade', true);

?><div id="modalidade">
		<h4 class="wp-heading-inline">3. MODALIDADE</h4>
		<p class="post-sub-title">Marque uma das possibilidades descritas.</p>
		<label><input type="radio" name="modalidade" <?php if ($value == "Totalmente presencial") echo "checked"; ?> value="Totalmente presencial">
			&ensp;Totalmente presencial</label><br>
		<label><input type="radio" name="modalidade" <?php if ($value == "Presencial e remoto síncrono") echo "checked"; ?> value="Presencial e remoto síncrono">
			&ensp;Presencial e remoto síncrono</label><br>
		<label><input type="radio" name="modalidade" <?php if ($value == "Presencial e remoto assíncrono") echo "checked"; ?> value="Presencial e remoto assíncrono">
			&ensp;Presencial e remoto assíncrono</label><br>
		<label><input type="radio" name="modalidade" <?php if ($value == "Remoto totalmente síncrono") echo "checked"; ?> value="Remoto totalmente síncrono">
			&ensp;Remoto totalmente síncrono</label><br>
		<label><input type="radio" name="modalidade" <?php if ($value == "Remoto totalmente assíncrono, com tutoria") echo "checked"; ?> value="Remoto totalmente assíncrono, com tutorial">
			&ensp;Remoto totalmente assíncrono, com tutorial</label><br>
		<label><input type="radio" name="modalidade" <?php if ($value == "Remoto síncrono e assíncrono") echo "checked"; ?> value="Remoto síncrono e assíncrono">
			&ensp;Remoto síncrono e assíncrono</label><br>
	</div>
<?php }


// METODOLOGIA **********************************

function campo_box_metodologia()
{
	add_meta_box('metodologia_id', 'metodologia', 'campo_metodologia', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_metodologia');
function campo_metodologia($post)
{
	$value = get_post_meta($post->ID, 'metodologia', true);
?><div id="metodologia">
		<h4 class="wp-heading-inline">4. METODOLOGIA/ESTRATÉGIAS DE APRENDIZAGEM</h4>
		<p class="post-sub-title">Explicite quais as técnicas, métodos e ferramentas que utilizará nas aulas, para estimular e promover o aprendizado do conteúdo nos alunos.</p>
		<textarea name="metodologia" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }


// AVALIAÇÃO **********************************

function campo_box_avaliacao()
{
	add_meta_box('avaliacao_id', 'avaliacao', 'campo_avaliacao', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_avaliacao');
function campo_avaliacao($post)
{
	$value = get_post_meta($post->ID, 'avaliacao', true);
?><div id="avaliacao">
		<h4 class="wp-heading-inline">5. AVALIAÇÃO DE APRENDIZAGEM</h4>
		<p class="post-sub-title">Indique como realizará a avaliação de aprendizagem e a partir de qual instrumento aplicado saberá que o aluno aprendeu o conteúdo do curso.</p>
		<textarea name="avaliacao" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }


// CRITÉRIOS **********************************

function campo_box_criterios()
{
	add_meta_box('criterios_id', 'criterios', 'campo_criterios', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_criterios');
function campo_criterios($post)
{
	$value = get_post_meta($post->ID, 'criterios', true);
?><div id="criterios">
		<h4 class="wp-heading-inline">6. CRITÉRIOS PARA APROVAÇÃO</h4>
		<p class="post-sub-title">Informe aqui qual a nota, conceito ou requisito que o aluno precisará atingir para ser considerado aprovado. Não indique frequência, que é requisito obrigatório da Escola e não se refere ao aprendizado do aluno.</p>
		<textarea name="criterios" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }



// CARGA **********************************

function campo_box_carga()
{
	add_meta_box('carga_id', 'carga', 'campo_carga', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_carga');
function campo_carga($post)
{
	$value1 = get_post_meta($post->ID, 'carga1', true);
	$value2 = get_post_meta($post->ID, 'carga2', true);
	$value3 = get_post_meta($post->ID, 'carga3', true);
	$value4 = get_post_meta($post->ID, 'carga4', true);
	$value5 = get_post_meta($post->ID, 'carga5', true);
	$valuetotal = get_post_meta($post->ID, 'cargatotal', true);

?>
	<div id="carga">
		<h4 class="wp-heading-inline">7. CARGA HORÁRIA DA CAPACITAÇÃO</h4>
		<p class="post-sub-title">Indique a carga horária de cada objeto de aprendizagem que compõe a capacitação. Siga a Instrução Normativa 04/2020.</p>

		<label><input type="number" id="carga1" name="carga1" min="0" max="99" size="2" value="<?php echo $value1; ?>" onchange="calcularcarga(this.value);">&ensp;Videoaula gravada</label><br>
		<label><input type="number" id="carga2" name="carga2" min="0" max="99" size="2" value="<?php echo $value2; ?>" onchange="calcularcarga(this.value);">&ensp;Videos diversos</label><br>
		<label><input type="number" id="carga3" name="carga3" min="0" max="99" size="2" value="<?php echo $value3; ?>" onchange="calcularcarga(this.value);">&ensp;Textos, artigos, capítulos de livros e similares</label><br>
		<label><input type="number" id="carga4" name="carga4" min="0" max="99" size="2" value="<?php echo $value4; ?>" onchange="calcularcarga(this.value);">&ensp;Aulas síncronas ou presenciais</label><br>
		<label><input type="number" id="carga5" name="carga5" min="0" max="99" size="2" value="<?php echo $value5; ?>" onchange="calcularcarga(this.value);">&ensp;Elaboração de projetos, mapeamentos de processos, TCCs e demais atividades práticas</label><br>
		<label><input type="number" id="cargatotal" name="cargatotal" min="0" max="99" size="2" value="<?php echo $valuetotal; ?>" readonly="true">&ensp;TOTAL DA CARGA HORÁRIA DA CAPACITAÇÃO</label><br>

	</div>
<?php }


// EQUIPE **********************************

function campo_box_equipe()
{
	add_meta_box('equipe_id', 'equipe', 'campo_equipe', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_equipe');
function campo_equipe($post)
{
	$value1 = get_post_meta($post->ID, 'equipe1', true);
	$value2 = get_post_meta($post->ID, 'equipe2', true);
	$value3 = get_post_meta($post->ID, 'equipe3', true);
	$value4 = get_post_meta($post->ID, 'equipe4', true);
	$value5 = get_post_meta($post->ID, 'equipe5', true);
	$value6 = get_post_meta($post->ID, 'equipe6', true);
	$valuenl = get_post_meta($post->ID, 'nl', true);
	if ($valuenl == "") $valuenl = 1;

?>
	<div id="equipe">
		<h4 class="wp-heading-inline">8. EQUIPE DA CAPACITAÇÃO</h4>
		<p class="post-sub-title">Indique a contribuição de cada um dos componentes da equipe de capacitação, explicitando a(s) formas(s) de atuação de cada um e a respectiva carga horária de cada tipo de atuação. Sendo uma única pessoa responsável por todo o curso, explicite a carga horária nas diferentes formas de atuação, para elaboração e oferecimento do curso. Siga a Instrução Normativa 04/2020 e acrescente quantos itens forem necessários à tabela abaixo.</p>
		<input type="hidden" id="nl" name="nl" value="<?php echo $valuenl; ?>">
		<table>
			<tr>
				<th>Nome Completo</th>
				<th>Superior Imediato</th>
				<th>Unidade/Depto</th>
				<th>E-mail</th>
				<th>Carga horária</th>
				<th>Atuação</th>
			</tr>
			<tr class='linha1'>
				<td><input oninput="atualizaValor(this.value,1,1)" type="text" name="equipe1[]" value="<?php echo $value1; ?>" class="equipe1"></td>
				<td><input type="text" name="equipe2[]" value="<?php echo $value2; ?>" class="equipe2"></td>
				<td><input type="text" name="equipe3[]" value="<?php echo $value3; ?>" class="equipe3"></td>
				<td><input type="text" name="equipe4[]" value="<?php echo $value4; ?>" class="equipe4"></td>
				<td><input  oninput="atualizaValor(this.value,1,5)" type="text" name="equipe5[]" value="<?php echo $value5; ?>" class="equipe5"></td>
				<td><select name="equipe6[]" class="equipe6" oninput="atualizaValor(this.value,1,6)">
				<option hidden selected><?php echo $value6; ?></option>
				<option>Instrutor</option>
				<option>Tutor</option>
				<option>Monitor</option>
				<option>Conteudista Presencial</option>
				<option>Conteudista Remoto Síncrono</option>
				<option>Conteudista Remoto Assíncrono</option>		
				</select></td>
			</tr>
		</table>
		<i class='bx bxs-plus-square' onclick="criaLinha();"></i>
		<i class='bx bxs-minus-square' onclick="apagaLinha();"></i>
	</div>
<?php }


// BIBLIOGRAFIA **********************************

function campo_box_bibliografia()
{
	add_meta_box('bibliografia_id', 'bibliografia', 'campo_bibliografia', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_bibliografia');
function campo_bibliografia($post)
{
	$value = get_post_meta($post->ID, 'bibliografia', true);
?><div id="bibliografia">
		<h4 class="wp-heading-inline">9. BIBLIOGRAFIA</h4><p class="post-sub-title">Indique a bibliografia obrigatório e complementar do curso, se possível, disponibilizando links.</p>
		<textarea name="bibliografia" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }



// CALENDÁRIO **********************************

function campo_box_calendario()
{
	add_meta_box('calendario_id', 'calendario', 'campo_calendario', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_calendario');
function campo_calendario($post)
{
	$value1 = get_post_meta($post->ID, 'calendario1', true);
	$value2 = get_post_meta($post->ID, 'calendario2', true);
	$value3 = get_post_meta($post->ID, 'calendario3', true);
	$value4 = get_post_meta($post->ID, 'calendario4', true);
	$value5 = get_post_meta($post->ID, 'calendario5', true);
	$value6 = get_post_meta($post->ID, 'calendario6', true);
	$value7 = get_post_meta($post->ID, 'calendario7', true);
	$value8 = get_post_meta($post->ID, 'calendario8', true);

?>
	<div id="calendario">
	<h1><b>III. CARACTERIZAÇÃO DO OFERECIMENTO</b></h1>
	<h4 class="wp-heading-inline">1. CALENDÁRIO DE OFERECIMENTO DAS TURMAS</h4><p class="post-sub-title">Datas, dias da semana e horários de oferecimento de cada turma.</p>
		<table>
			<tr>
				<th>Turma</th>
				<th>Quantidade</th>
				<th>Capacidade</th>
				<th>Data</th>
				<th>Dia da Semana</th>
				<th>Horário</th>
				<th>Instrutor</th>
				<th>Carga Horária</th>
			</tr>
			<tr class='linha1'>
				<td><input type="text" name="calendario1[]" value="<?php echo $value1; ?>" class="calendario1"></td>
				<td><input type="text" name="calendario2[]" value="<?php echo $value2; ?>" class="calendario2"></td>
				<td><input type="text" name="calendario3[]" value="<?php echo $value3; ?>" class="calendario3"></td>
				<td><input type="text" name="calendario4[]" value="<?php echo $value4; ?>" class="calendario4"></td>
				<td><input type="text" name="calendario5[]" value="<?php echo $value5; ?>" class="calendario5"></td>
				<td><input type="text" name="calendario6[]" value="<?php echo $value6; ?>" class="calendario6"></td>
				<td><input type="text" readonly="true" name="calendario7[]" value="<?php echo $value7; ?>" class="calendario7"></td>
				<td><input type="text" readonly="true" name="calendario8[]" value="<?php echo $value8; ?>" class="calendario8"></td>
			</tr>
		</table>		
	</div>
<?php }


// LOCAL **********************************

function campo_box_local()
{
	add_meta_box('local_id', 'local', 'campo_local', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_local');
function campo_local($post)
{
	$value = get_post_meta($post->ID, 'local', true);
?><div id="local">
<h4 class="wp-heading-inline">2. LOCAL</h4><p class="post-sub-title">Indique a sala da EDUCORP, se presencial. Se remoto, indique o link para acesso ao conteúdo assíncrono e o link do google meet para acesso à sala virtual no encontro síncrono.</p>
<textarea name="local" rows="5"><?php echo $value; ?></textarea>
	</div>
<?php }



// PAGAMENTO **********************************

function campo_box_pagamento()
{
	add_meta_box('pagamento_id', 'pagamento', 'campo_pagamento', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_pagamento');
function campo_pagamento($post)
{
	$proposta_input_name1 = get_option("proposta_input_name1");
	$proposta_input_name2 = get_option("proposta_input_name2");
	$proposta_input_name3 = get_option("proposta_input_name3");
	$proposta_input_name4 = get_option("proposta_input_name4");
	$proposta_input_name5 = get_option("proposta_input_name5");
	$proposta_input_name6 = get_option("proposta_input_name6");

	$value1 = get_post_meta($post->ID, 'pagamento1', true);
	$value2 = get_post_meta($post->ID, 'pagamento2', true);
	$value3 = get_post_meta($post->ID, 'pagamento3', true);
	$value4 = get_post_meta($post->ID, 'pagamento4', true);
	$value5 = get_post_meta($post->ID, 'pagamento5', true);	
	$total = get_post_meta($post->ID, 'total', true);

?>
	<div id="pagamento">
	<h1><b>IV. INFORMAÇÕES GERENCIAIS</b></h1>
	<h4 class="wp-heading-inline">1. CONSOLIDAÇÃO PARA PAGAMENTO</h4><p class="post-sub-title">Não preencha, se for treinamento em serviço. Utilize IN 04/2020 para o cálculo do valor por tipo de atuação e totalize.</p>
	<input type="hidden" id="proposta_input_name1" value="<?php echo $proposta_input_name1; ?>">
	<input type="hidden" id="proposta_input_name2" value="<?php echo $proposta_input_name2; ?>">
	<input type="hidden" id="proposta_input_name3" value="<?php echo $proposta_input_name3; ?>">
	<input type="hidden" id="proposta_input_name4" value="<?php echo $proposta_input_name4; ?>">
	<input type="hidden" id="proposta_input_name5" value="<?php echo $proposta_input_name5; ?>">
	<input type="hidden" id="proposta_input_name6" value="<?php echo $proposta_input_name6; ?>">	
	<table>
			<tr>
				<th>Nome</th>
				<th>Dias</th>
				<th>Atuação</th>
				<th>Carga Horária</th>
				<th>Valor (R$)</th>				
			</tr>
			<tr class='linha1'>
				<td><input type="text" name="pagamento1[]" value="<?php echo $value1; ?>" class="pagamento1" readonly="true"></td>
				<td><input type="text" name="pagamento2[]" value="<?php echo $value2; ?>" class="pagamento2"></td>
				<td><input type="text" name="pagamento3[]" value="<?php echo $value3; ?>" class="pagamento3" readonly="true"></td>
				<td><input type="text" oninput="valorAtuacao(this.value,1)" name="pagamento4[]" value="<?php echo $value4; ?>" class="pagamento4"></td>
				<td><input type="text" name="pagamento5[]" value="<?php echo $value5; ?>" class="pagamento5" readonly="true"></td>
			</tr>
		</table>
		<p class="total"><span>Total: </span><input readonly="true" name="total" type="text" id="total" value="<?php echo $total; ?>"></p>		
	</div>
<?php }



// *****************************************
// SUBMIT **********************************
// *****************************************

function campo_box_submit()
{
	add_meta_box('submit_id', 'submit', 'campo_submit', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_submit');
function campo_submit()
{
?>
	<div id="publishing-action">
		<input name="original_publish" type="hidden" value="Publicar" />
		<input type="submit" name="publish" class="button button-primary button-large" value="Publicar" />
	</div>
<?php }


// SALVAR **********************************

function salvar_no_postmeta($post_id)
{
	if (isset($_POST['ativado'])) {
		$ativado = sanitize_text_field($_POST['ativado']);
		update_post_meta($post_id, 'ativado', $ativado);
	}

	if (isset($_POST['contexto'])) {
		$contexto = sanitize_text_field($_POST['contexto']);
		update_post_meta($post_id, 'contexto', $contexto);
	}

	$objetivo = [];
	$obj = [];
	for ($i = 1; $i <= 13; $i++) {
		$obj = "objetivo" . $i;
		if (isset($_POST[$obj])) {
			$objetivo[$i] = sanitize_text_field($_POST[$obj]);
			update_post_meta($post_id, $obj, $objetivo[$i]);
		}
	}

	if (isset($_POST['capacitacao'])) {
		$capacitacao = sanitize_text_field($_POST['capacitacao']);
		update_post_meta($post_id, 'capacitacao', $capacitacao);
	}

	if (isset($_POST['publico'])) {
		$publico = sanitize_text_field($_POST['publico']);
		update_post_meta($post_id, 'publico', $publico);
	}
	if (isset($_POST['estimativa'])) {
		$estimativa = sanitize_text_field($_POST['estimativa']);
		update_post_meta($post_id, 'estimativa', $estimativa);
	}
	if (isset($_POST['aplicacao'])) {
		$aplicacao = sanitize_text_field($_POST['aplicacao']);
		update_post_meta($post_id, 'aplicacao', $aplicacao);
	}
	if (isset($_POST['conteudista'])) {
		$conteudista = implode(',', $_POST['conteudista']);
		update_post_meta($post_id, 'conteudista', $conteudista);
	}
	if (isset($_POST['ementa'])) {
		$ementa = sanitize_text_field($_POST['ementa']);
		update_post_meta($post_id, 'ementa', $ementa);
	}
	if (isset($_POST['conteudo'])) {
		$conteudo = sanitize_text_field($_POST['conteudo']);
		update_post_meta($post_id, 'conteudo', $conteudo);
	}
	if (isset($_POST['modalidade'])) {
		$modalidade = sanitize_text_field($_POST['modalidade']);
		update_post_meta($post_id, 'modalidade', $modalidade);
	}
	if (isset($_POST['metodologia'])) {
		$metodologia = sanitize_text_field($_POST['metodologia']);
		update_post_meta($post_id, 'metodologia', $metodologia);
	}
	if (isset($_POST['avaliacao'])) {
		$avaliacao = sanitize_text_field($_POST['avaliacao']);
		update_post_meta($post_id, 'avaliacao', $avaliacao);
	}
	if (isset($_POST['criterios'])) {
		$criterios = sanitize_text_field($_POST['criterios']);
		update_post_meta($post_id, 'criterios', $criterios);
	}
	if (isset($_POST['carga1'])) {
		$carga1 = sanitize_text_field($_POST['carga1']);
		update_post_meta($post_id, 'carga1', $carga1);
	}
	if (isset($_POST['carga2'])) {
		$carga2 = sanitize_text_field($_POST['carga2']);
		update_post_meta($post_id, 'carga2', $carga2);
	}
	if (isset($_POST['carga3'])) {
		$carga3 = sanitize_text_field($_POST['carga3']);
		update_post_meta($post_id, 'carga3', $carga3);
	}
	if (isset($_POST['carga4'])) {
		$carga4 = sanitize_text_field($_POST['carga4']);
		update_post_meta($post_id, 'carga4', $carga4);
	}
	if (isset($_POST['carga5'])) {
		$carga5 = sanitize_text_field($_POST['carga5']);
		update_post_meta($post_id, 'carga5', $carga5);
	}
	if (isset($_POST['cargatotal'])) {
		$cargatotal = sanitize_text_field($_POST['cargatotal']);
		update_post_meta($post_id, 'cargatotal', $cargatotal);
	}

	if (isset($_POST['equipe1'])) {
		$equipe1 = implode(',', $_POST['equipe1']);
		update_post_meta($post_id, 'equipe1', $equipe1);
	}
	if (isset($_POST['equipe2'])) {
		$equipe2 = implode(',', $_POST['equipe2']);
		update_post_meta($post_id, 'equipe2', $equipe2);
	}
	if (isset($_POST['equipe3'])) {
		$equipe3 = implode(',', $_POST['equipe3']);
		update_post_meta($post_id, 'equipe3', $equipe3);
	}
	if (isset($_POST['equipe4'])) {
		$equipe4 = implode(',', $_POST['equipe4']);
		update_post_meta($post_id, 'equipe4', $equipe4);
	}
	if (isset($_POST['equipe5'])) {
		$equipe5 = implode(',', $_POST['equipe5']);
		update_post_meta($post_id, 'equipe5', $equipe5);
	}
	if (isset($_POST['equipe6'])) {
		$equipe6 = implode(',', $_POST['equipe6']);
		update_post_meta($post_id, 'equipe6', $equipe6);
	}
	if (isset($_POST['nl'])) {
		$nl = sanitize_text_field($_POST['nl']);
		update_post_meta($post_id, 'nl', $nl);
	}
	if (isset($_POST['bibliografia'])) {
		$bibliografia = sanitize_text_field($_POST['bibliografia']);
		update_post_meta($post_id, 'bibliografia', $bibliografia);
	}
	if (isset($_POST['calendario1'])) {
		$calendario1 = implode(',', $_POST['calendario1']);
		update_post_meta($post_id, 'calendario1', $calendario1);
	}
	if (isset($_POST['calendario2'])) {
		$calendario2 = implode(',', $_POST['calendario2']);
		update_post_meta($post_id, 'calendario2', $calendario2);
	}
	if (isset($_POST['calendario3'])) {
		$calendario3 = implode(',', $_POST['calendario3']);
		update_post_meta($post_id, 'calendario3', $calendario3);
	}
	if (isset($_POST['calendario4'])) {
		$calendario4 = implode(',', $_POST['calendario4']);
		update_post_meta($post_id, 'calendario4', $calendario4);
	}
	if (isset($_POST['calendario5'])) {
		$calendario5 = implode(',', $_POST['calendario5']);
		update_post_meta($post_id, 'calendario5', $calendario5);
	}
	if (isset($_POST['calendario6'])) {
		$calendario6 = implode(',', $_POST['calendario6']);
		update_post_meta($post_id, 'calendario6', $calendario6);
	}
	if (isset($_POST['calendario7'])) {
		$calendario7 = implode(',', $_POST['calendario7']);
		update_post_meta($post_id, 'calendario7', $calendario7);
	}
	if (isset($_POST['calendario8'])) {
		$calendario8 = implode(',', $_POST['calendario8']);
		update_post_meta($post_id, 'calendario8', $calendario8);
	}
	if (isset($_POST['local'])) {
		$local = sanitize_text_field($_POST['local']);
		update_post_meta($post_id, 'local', $local);
	}
	if (isset($_POST['pagamento1'])) {
		$pagamento1 = implode(',', $_POST['pagamento1']);
		update_post_meta($post_id, 'pagamento1', $pagamento1);
	}
	if (isset($_POST['pagamento2'])) {
		$pagamento2 = implode(',', $_POST['pagamento2']);
		update_post_meta($post_id, 'pagamento2', $pagamento2);
	}
	if (isset($_POST['pagamento3'])) {
		$pagamento3 = implode(',', $_POST['pagamento3']);
		update_post_meta($post_id, 'pagamento3', $pagamento3);
	}
	if (isset($_POST['pagamento4'])) {
		$pagamento4 = implode(',', $_POST['pagamento4']);
		update_post_meta($post_id, 'pagamento4', $pagamento4);
	}
	if (isset($_POST['pagamento5'])) {
		$pagamento5 = implode(',', $_POST['pagamento5']);
		update_post_meta($post_id, 'pagamento5', $pagamento5);
	}
	if (isset($_POST['total'])) {
		$total = sanitize_text_field($_POST['total']);
		update_post_meta($post_id, 'total', $total);
	}
}
add_action('save_post', 'salvar_no_postmeta');
?>
