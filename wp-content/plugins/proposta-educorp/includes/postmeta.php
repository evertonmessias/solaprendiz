<?php

// FIELDS POST META **********************************

// EIXO TEMÁTICO **********************************

function campo_box_eixo()
{
	add_meta_box('eixo_id', 'eixo', 'campo_eixo', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_eixo');
function campo_eixo($post)
{
	$value = get_post_meta($post->ID, 'eixo', true);

?><div id="eixo">
		<h4 class="wp-heading-inline">1.1. Eixo Temático</h4>
		<p class="post-sub-title">Marque um dos eixos abaixo.</p>
		<label><input type="radio" name="eixo" <?php if ($value == "Academia") echo "checked"; ?> value="Academia">
			&ensp;Academia</label><br>
		<label><input type="radio" name="eixo" <?php if ($value == "Suporte") echo "checked"; ?> value="Suporte">
			&ensp;Suporte</label><br>
		<label><input type="radio" name="eixo" <?php if ($value == "Liderança") echo "checked"; ?> value="Liderança">
			&ensp;Liderança</label><br>
	</div>
<?php }

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
		$checked = "checked";
	} else {
		$checked = "";
	}
?> <div id="ativado">
		<label class="post-sub-title"><b>1.2. Ativa a edição dessa proposta?</b>
			<input type="checkbox" name="ativado" <?php echo $checked; ?> /></label>
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
		<p class="post-sub-title">Contextualize detalhadamente o cenário na Unicamp que justifica o oferecimento da capacitação, inclusive indicando legislação regulamentadora do assunto, quando couber.<br>
		(máx. 1500 caracteres)</p>
		<textarea maxlength="1500" name="contexto" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Explicite quais as necessidades específicas do negócio serão atendidas com essa capacitação.<br>
		(máx. 600 caracteres)</p>
		<textarea maxlength="600" name="capacitacao" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Detalhe o público alvo que deverá participar da capacitação, indicando local/área/processos de trabalho, nível de decisão (ingressante no processo, experiente, gerente) e outras informações que caracterizem bem esse público, indicando a quantidade estimada de todo público a ser treinado. Esta informação é importante para divulgação e priorização das inscrições nas turmas.<br>
		(máx. 600 caracteres)</p>
		<textarea maxlength="600" name="publico" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Dimensione a quantidade total de pessoas na UNICAMP que necessita dessa capacitação.<br>
		(máx. 50 caracteres)</p>
		<textarea maxlength="50" name="estimativa" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Indique o que os participantes farão diferentemente e melhor nos seus locais de trabalho após vivenciarem essa capacitação.<br>
		(máx. 600 caracteres)</p>
		<textarea maxlength="600" name="aplicacao" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Resumo dos principais temas/tópicos/disciplinas que caracterizam o curso.<br>
		(máx. 600 caracteres)</p>
		<textarea maxlength="600" name="ementa" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Desdobramento da ementa, explicitando o conteúdo a ser abordado, dividindo-o em aulas.<br>
		(máx. 2000 caracteres)</p>
		<textarea maxlength="2000" name="conteudo" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Explicite quais as técnicas, métodos e ferramentas que utilizará nas aulas, para estimular e promover o aprendizado do conteúdo nos alunos.<br>
		(máx. 1000 caracteres)</p>
		<textarea maxlength="1000" name="metodologia" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Indique como realizará a avaliação de aprendizagem e a partir de qual instrumento aplicado saberá que o aluno aprendeu o conteúdo do curso.<br>
		(máx. 600 caracteres)</p>
		<textarea maxlength="600" name="avaliacao" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Informe aqui qual a nota, conceito ou requisito que o aluno precisará atingir para ser considerado aprovado. Não indique frequência, que é requisito obrigatório da Escola e não se refere ao aprendizado do aluno.<br>
		(máx. 600 caracteres)</p>
		<textarea maxlength="600" name="criterios" rows="5"><?php echo $value; ?></textarea>
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
		<p class="post-sub-title">Indique a carga horária de cada objeto de aprendizagem que compõe a capacitação. Siga a Instrução Normativa 04/2020. Se não houver digite zero.</p>

		<label><input type="number" min="0" max="999" id="carga1" name="carga1" maxlength="2" value="<?php echo $value1; ?>" oninput="calcularcarga(this.value);">H&emsp;(a) Videoaula gravada</label><br>
		<label><input type="number" min="0" max="999" id="carga2" name="carga2" maxlength="2" value="<?php echo $value2; ?>" oninput="calcularcarga(this.value);">H&emsp;(b) Videos diversos</label><br>
		<label><input type="number" min="0" max="999" id="carga3" name="carga3" maxlength="2" value="<?php echo $value3; ?>" oninput="calcularcarga(this.value);">H&emsp;(c) Textos, artigos, capítulos de livros e similares</label><br>
		<label><input type="number" min="0" max="999" id="carga4" name="carga4" maxlength="2" value="<?php echo $value4; ?>" oninput="calcularcarga(this.value);">H&emsp;(d) Aulas síncronas ou presenciais</label><br>
		<label><input type="number" min="0" max="999" id="carga5" name="carga5" maxlength="2" value="<?php echo $value5; ?>" oninput="calcularcarga(this.value);">H&emsp;(e) Elaboração de projetos, mapeamentos de processos, TCCs e demais atividades práticas</label><br>
		<label><input type="number" id="cargatotal" name="cargatotal" maxlength="2" value="<?php echo $valuetotal; ?>" readonly="true">H&emsp;TOTAL DA CARGA HORÁRIA DA CAPACITAÇÃO (3a+3b+2c+d+e)</label><br>

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
	$value0 = get_post_meta($post->ID, 'equipe0', true);
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
				<th>Matrícula</th>
				<th>Nome Completo</th>
				<th>Superior Imediato</th>
				<th>Unidade/Depto</th>
				<th>E-mail</th>
				<th>Carga horária</th>
				<th>Atuação</th>
			</tr>
			<tr class='linha1'>
				<td><input oninput="atualizaValor(this.value,1,0);filterChar(this.value,this)" type="text" name="equipe0[]" value="<?php echo $value0; ?>" class="equipe0"></td>
				<td><input oninput="atualizaValor(this.value,1,1)" type="text" name="equipe1[]" value="<?php echo $value1; ?>" class="equipe1"></td>
				<td><input type="text" name="equipe2[]" value="<?php echo $value2; ?>" class="equipe2"></td>
				<td><input type="text" name="equipe3[]" value="<?php echo $value3; ?>" class="equipe3"></td>
				<td><input type="text" name="equipe4[]" value="<?php echo $value4; ?>" class="equipe4"></td>
				<td><input oninput="atualizaValor(this.value,1,5);filterChar(this.value,this)" onfocusin="addInputNumber(this);" onfocusout="remInputNumber(this);" type="text" name="equipe5[]" value="<?php echo $value5; ?>" class="equipe5"></td>
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
		<h4 class="wp-heading-inline">9. BIBLIOGRAFIA</h4>
		<p class="post-sub-title">Indique a bibliografia obrigatório e complementar do curso, se possível, disponibilizando links.<br>
		(máx. 2000 caracteres)</p>
		<textarea maxlength="2000" name="bibliografia" rows="5"><?php echo $value; ?></textarea>
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
	$value9 = get_post_meta($post->ID, 'calendario9', true);
	$valuenlc = get_post_meta($post->ID, 'nlc', true);
	if ($valuenlc == "") $valuenlc = 1;

?>
	<div id="calendario">
		<h1><b>III. CARACTERIZAÇÃO DO OFERECIMENTO</b></h1>
		<h4 class="wp-heading-inline">1. CALENDÁRIO DE OFERECIMENTO DAS TURMAS</h4>
		<p class="post-sub-title">Datas, dias da semana e horários de oferecimento de cada turma.</p>
		<input type="hidden" id="nlc" name="nlc" value="<?php echo $valuenlc; ?>">
		<table>
			<tr>
				<th>Turma</th>
				<th>Vagas</th>
				<th>Data Inicio</th>
				<th>Data Fim</th>
				<th>Dia da Semana</th>
				<th>Horário</th>
				<th>Instrutor</th>
				<th>Carga Horária</th>
				<th>Atuação</th>
			</tr>
			<tr class='linha1'>
				<td><input type="text" maxlength="2" name="calendario1[]" value="<?php echo $value1; ?>" class="calendario1" oninput="filterChar(this.value,this)" onfocusin="addInputNumber(this);" onfocusout="remInputNumber(this);"></td>
				<td><input type="text" maxlength="3" name="calendario2[]" value="<?php echo $value2; ?>" class="calendario2" oninput="filterChar(this.value,this)" onfocusin="addInputNumber(this);" onfocusout="remInputNumber(this);"></td>
				<td><input type="text" name="calendario3[]" value="<?php echo $value3; ?>" class="calendario3" onfocusin="addInputDate(this);" onfocusout="remInputDate(this);"></td>
				<td><input type="text" name="calendario4[]" value="<?php echo $value4; ?>" class="calendario4" onfocusin="addInputDate(this);" onfocusout="remInputDate(this);"></td>
				<td><input type="text" name="calendario5[]" value="<?php echo $value5; ?>" class="calendario5"></td>
				<td><input type="text" name="calendario6[]" value="<?php echo $value6; ?>" class="calendario6"></td>
				<td><input type="text" name="calendario7[]" value="<?php echo $value7; ?>" class="calendario7"></td>
				<td><input type="text" name="calendario8[]" value="<?php echo $value8; ?>" class="calendario8" oninput="filterChar(this.value,this)" onfocusin="addInputNumber(this);" onfocusout="remInputNumber(this);"></td>
				<td><select name="calendario9[]" class="calendario9">
						<option hidden selected><?php echo $value9; ?></option>
						<option>Instrutor</option>
						<option>Tutor</option>
						<option>Monitor</option>
						<option>Conteudista Presencial</option>
						<option>Conteudista Remoto Síncrono</option>
						<option>Conteudista Remoto Assíncrono</option>
					</select></td>
			</tr>
		</table>
		<i class='bx bxs-plus-square' onclick="criaLinhaC();"></i>
		<i class='bx bxs-minus-square' onclick="apagaLinhaC();"></i>
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
		<h4 class="wp-heading-inline">2. LOCAL</h4>
		<p class="post-sub-title">Indique a sala da EDUCORP, se presencial. Se remoto, indique o link para acesso ao conteúdo assíncrono e o link do google meet para acesso à sala virtual no encontro síncrono.<br>
		(máx. 100 caracteres)</p>
		<textarea maxlength="100" name="local" rows="5"><?php echo $value; ?></textarea>
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
	//valores do settings
	$proposta_input_name1 = get_option("proposta_input_name1");
	$proposta_input_name2 = get_option("proposta_input_name2");
	$proposta_input_name3 = get_option("proposta_input_name3");
	$proposta_input_name4 = get_option("proposta_input_name4");
	$proposta_input_name5 = get_option("proposta_input_name5");
	$proposta_input_name6 = get_option("proposta_input_name6");

	$value = get_post_meta($post->ID, 'personpagamento', true);
	if ($value == 'on') {
		$checked = "checked";
	} else {
		$checked = "";
	}

	$value1 = get_post_meta($post->ID, 'pagamento1', true);
	$value2 = get_post_meta($post->ID, 'pagamento2', true);
	$value3 = get_post_meta($post->ID, 'pagamento3', true);
	$value4 = get_post_meta($post->ID, 'pagamento4', true);
	$value5 = get_post_meta($post->ID, 'pagamento5', true);
	$total = get_post_meta($post->ID, 'total', true);

	$pvalue1 = get_post_meta($post->ID, 'personpagamento1', true);
	$pvalue2 = get_post_meta($post->ID, 'personpagamento2', true);
	$pvalue3 = get_post_meta($post->ID, 'personpagamento3', true);
	$pvalue4 = get_post_meta($post->ID, 'personpagamento4', true);
	$pvalue5 = get_post_meta($post->ID, 'personpagamento5', true);
	$pvalue6 = get_post_meta($post->ID, 'personpagamento6', true);

?>
	<div id="pagamento">
		<h1><b>IV. INFORMAÇÕES GERENCIAIS</b></h1>
		<h4 class="wp-heading-inline">1. CONSOLIDAÇÃO PARA PAGAMENTO</h4>
		<p class="post-sub-title">Não preencha, se for treinamento em serviço. Utilize IN 04/2020 para o cálculo do valor por tipo de atuação e totalize.</p>
		<input type="hidden" id="proposta_input_name1" value="<?php echo $proposta_input_name1; ?>">
		<input type="hidden" id="proposta_input_name2" value="<?php echo $proposta_input_name2; ?>">
		<input type="hidden" id="proposta_input_name3" value="<?php echo $proposta_input_name3; ?>">
		<input type="hidden" id="proposta_input_name4" value="<?php echo $proposta_input_name4; ?>">
		<input type="hidden" id="proposta_input_name5" value="<?php echo $proposta_input_name5; ?>">
		<input type="hidden" id="proposta_input_name6" value="<?php echo $proposta_input_name6; ?>">

		<label class="post-sob-title"><b>Personalizar Valores de Pagamento ?</b>
			<input onchange="personalPag(this)" id="personpagamento" type="checkbox" name="personpagamento" <?php echo $checked; ?> /></label>
		<br>
		<div id="personal">
			<br>
			<label><input type="number" min="0" id="personpagamento1" name="personpagamento1" value="<?php echo $pvalue1; ?>" /><span> Instrutor</span></label><br>
			<label><input type="number" min="0" id="personpagamento2" name="personpagamento2" value="<?php echo $pvalue2; ?>" /><span> Tutor</span></label><br>
			<label><input type="number" min="0" id="personpagamento3" name="personpagamento3" value="<?php echo $pvalue3; ?>" /><span> Monitor</span></label><br>
			<label><input type="number" min="0" id="personpagamento4" name="personpagamento4" value="<?php echo $pvalue4; ?>" /><span> Conteudista Presencial</span></label><br>
			<label><input type="number" min="0" id="personpagamento5" name="personpagamento5" value="<?php echo $pvalue5; ?>" /><span> Conteudista Remoto Síncrono</span></label><br>
			<label><input type="number" min="0" id="personpagamento6" name="personpagamento6" value="<?php echo $pvalue6; ?>" /><span> Conteudista Remoto Assíncrono</span></label><br>
			<br>
		</div>

		<table>
			<tr>
				<th>Matricula</th>
				<th>Nome</th>
				<th>Atuação</th>
				<th>Carga Horária</th>
				<th>Valor (R$)</th>
			</tr>
			<tr class='linha1'>
				<td><input type="text" name="pagamento1[]" value="<?php echo $value1; ?>" class="pagamento1" readonly="true"></td>
				<td><input type="text" name="pagamento2[]" value="<?php echo $value2; ?>" class="pagamento2" readonly="true"></td>
				<td><input type="text" name="pagamento3[]" value="<?php echo $value3; ?>" class="pagamento3" readonly="true"></td>
				<td><input type="text" maxlength="2" oninput="valorAtuacao(this.value,1);filterChar(this.value,this)" onfocusin="addInputNumber(this);" onfocusout="remInputNumber(this);" name="pagamento4[]" value="<?php echo $value4; ?>" class="pagamento4"></td>
				<td><input type="text" name="pagamento5[]" value="<?php echo $value5; ?>" class="pagamento5" readonly="true"></td>
			</tr>
		</table>
		<p class="total"><span>Total: </span><input readonly="true" name="total" type="text" id="total" value="<?php echo $total; ?>"></p>
	</div>
<?php }


// SHOW PAGAMENTO **********************************

function campo_box_showpagamento()
{
	add_meta_box('showpagamento_id', 'showpagamento', 'campo_showpagamento', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_showpagamento');
function campo_showpagamento($post)
{
	$value = get_post_meta($post->ID, 'showpagamento', true);
	if ($value == 'on') {
		$checked = "checked";
	} else {
		$checked = "";
	}
?> <div id="showpagamento">
		<label class="post-sub-title"><b>Ativar a visualização do Pagamento?</b>
			<input type="checkbox" name="showpagamento" <?php echo $checked; ?> /></label>
	</div>
<?php }


// MENSAGEM FINAL AO CONTEUDISTA **********************************

function campo_box_msgfinal()
{
	add_meta_box('msgfinal_id', 'msgfinal', 'campo_msgfinal', 'proposta');
}
add_action('add_meta_boxes', 'campo_box_msgfinal');
function campo_msgfinal($post)
{
?><div id="msgfinal">
		<h1 class="wp-heading-inline"><b>&ensp;Concluído!</b></h1>
		<p class="post-sub-title">Ao clicar em <b>Publicar</b>, um e-mail será enviado ao Responsável.</p>
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
	if (isset($_POST['eixo'])) {
		$eixo = sanitize_text_field($_POST['eixo']);
		update_post_meta($post_id, 'eixo', $eixo);
	}

	if (isset($_POST['ativado'])) {
		update_post_meta($post_id, 'ativado', "on");
	} else {
		update_post_meta($post_id, 'ativado', "off");
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

	if (isset($_POST['equipe0'])) {
		$equipe0 = implode(',', $_POST['equipe0']);
		update_post_meta($post_id, 'equipe0', $equipe0);
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
	if (isset($_POST['calendario9'])) {
		$calendario9 = implode(',', $_POST['calendario9']);
		update_post_meta($post_id, 'calendario9', $calendario9);
	}
	if (isset($_POST['nlc'])) {
		$nlc = sanitize_text_field($_POST['nlc']);
		update_post_meta($post_id, 'nlc', $nlc);
	}
	if (isset($_POST['local'])) {
		$local = sanitize_text_field($_POST['local']);
		update_post_meta($post_id, 'local', $local);
	}
	if (isset($_POST['personpagamento'])) {
		update_post_meta($post_id, 'personpagamento', "on");
	} else {
		update_post_meta($post_id, 'personpagamento', "off");
	}

	if (isset($_POST['personpagamento1'])) {
		$personpagamento1 = sanitize_text_field($_POST['personpagamento1']);
		update_post_meta($post_id, 'personpagamento1', $personpagamento1);
	}
	if (isset($_POST['personpagamento2'])) {
		$personpagamento2 = sanitize_text_field($_POST['personpagamento2']);
		update_post_meta($post_id, 'personpagamento2', $personpagamento2);
	}
	if (isset($_POST['personpagamento3'])) {
		$personpagamento3 = sanitize_text_field($_POST['personpagamento3']);
		update_post_meta($post_id, 'personpagamento3', $personpagamento3);
	}
	if (isset($_POST['personpagamento4'])) {
		$personpagamento4 = sanitize_text_field($_POST['personpagamento4']);
		update_post_meta($post_id, 'personpagamento4', $personpagamento4);
	}
	if (isset($_POST['personpagamento5'])) {
		$personpagamento5 = sanitize_text_field($_POST['personpagamento5']);
		update_post_meta($post_id, 'personpagamento5', $personpagamento5);
	}
	if (isset($_POST['personpagamento6'])) {
		$personpagamento6 = sanitize_text_field($_POST['personpagamento6']);
		update_post_meta($post_id, 'personpagamento6', $personpagamento6);
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
	if (isset($_POST['showpagamento'])) {
		update_post_meta($post_id, 'showpagamento', "on");
	} else {
		update_post_meta($post_id, 'showpagamento', "off");
	}
}
add_action('save_post', 'salvar_no_postmeta');
?>