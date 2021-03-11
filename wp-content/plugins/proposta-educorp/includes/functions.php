<?php


// ADD Capacidades para Conteudista e Responsavel

function conteudista_role_caps()
{
	$roles = array('conteudista', 'editor', 'administrator');
	foreach ($roles as $the_role) {
		$role = get_role($the_role);
		$role->remove_cap('read');
		$role->add_cap('edit_proposta');
		$role->add_cap('edit_others_proposta');
		$role->add_cap('edit_published_proposta');
	}
}
add_action('admin_init', 'conteudista_role_caps', 998);

function responsavel_role_caps()
{
	$roles = array('responsavel', 'editor', 'administrator');
	foreach ($roles as $the_role) {
		$role = get_role($the_role);
		$role->add_cap('read');
		$role->add_cap('read_proposta');
		$role->add_cap('read_private_proposta');
		$role->add_cap('edit_proposta');
		$role->add_cap('edit_others_proposta');
		$role->add_cap('edit_published_proposta');
		$role->add_cap('publish_proposta');
		$role->add_cap('delete_others_proposta');
		$role->add_cap('delete_private_proposta');
		$role->add_cap('delete_published_proposta');
		$role->add_cap('list_users');
		$role->add_cap('create_users');
		$role->add_cap('remove_users');
		$role->add_cap('promote_users');
		$role->add_cap('edit_users');
		$role->add_cap('manage_options');	
	}
}
add_action('admin_init', 'responsavel_role_caps',999);


// ADMIN BAR
function remove_admin_bar() {
if (!current_user_can('administrator') && !current_user_can('responsavel')) {
  	show_admin_bar(false);
}
}
add_action('after_setup_theme', 'remove_admin_bar');

// Redirect After Login
function admin_default_page() {
	return '/proposta';
  }  
add_filter('login_redirect', 'admin_default_page');

// ADD style & script
function style_and_script()
{
	$user = wp_get_current_user();
	if (in_array('conteudista', (array) $user->roles)) {
		get_header();		
		$url = explode("/",$_SERVER['REQUEST_URI']);
		if($url[1] == "wp-admin" && ($url[2] == "edit.php?post_type=proposta")){
			echo "<script>window.location.href = '/naopermitido'</script>";
		}
	}
	if (get_post_type() == 'proposta') {
?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
	<?php
		wp_enqueue_style('stilos', '/wp-content/plugins/proposta-educorp/css/educorp.css');				
		wp_enqueue_script('scripts', '/wp-content/plugins/proposta-educorp/js/educorp.js');
	}
}
add_action('admin_enqueue_scripts', 'style_and_script');



// VERIFICAR PERMISSÕES  *************************************************

function permissao($post)
{
	if (get_post_type() == 'proposta') {
		$user = wp_get_current_user();
		if (in_array('conteudista', (array) $user->roles)) {	
			show_admin_bar(false);		
			echo "<link rel='stylesheet' href='/wp-content/plugins/proposta-educorp/css/educorp-conteudista.css'>";
		}

		$ehresp = 0;
		if (in_array('administrator', (array) $user->roles) || in_array('responsavel', (array) $user->roles)) {
			$ehresp = 1;
		}
		?>
		<input type="hidden" id="ehresp" value="<?php echo $ehresp; ?>">
		<?php

		$ativado = get_post_meta($post->ID, 'ativado', true);
		$conteudista = explode(",", get_post_meta($post->ID, 'conteudista', true));
		$permitido = false;
		foreach ($conteudista as $cont) {			
			if (get_current_user_id() == $cont) {
				$permitido = true;
			}
		}
		if (($ativado == "on" && $permitido) || $ehresp) {
			echo "";
		} else {
			echo "<script>window.location.href = '/naopermitido'</script>";
		}
	}
}
add_action('edit_form_top', 'permissao');


//AVISO *************************************************
function aviso()
{
	if (get_post_type() == 'proposta') { ?>
		<div id="quadro">
			<i class="bx bxs-x-square"></i>
			<h2>Atenção</h2>
			<p>Preencha todos os campos antes de avançar.</p>
		</div>
	<?php }
}
add_action('edit_form_top', 'aviso');


//TITLE *************************************************
function title()
{
	if (get_post_type() == 'proposta') { ?>
		<div id="title-1" class="conteudo conteudo1">
			<br>
			<p>Roteiro para elaboração de solução de capacitação preenchido conjuntamente entre CONTEUDISTA E EQUIPE, até a validação da versão final.</p><br>
			<h2 style='font-size:20px;font-weight:bold;'>I. CARACTERIZAÇÃO DA DEMANDA</h2><br>
			<strong>1. TÍTULO DA CAPACITAÇÃO</strong><br><br>
			<span>Escreva o nome final exato do curso</span>
		</div>
	<?php }
}
add_action('edit_form_top', 'title');



// BARRAS TOP *************************************************
function barras()
{
	if (get_post_type() == 'proposta') { ?>
		<div id="back"></div>
		<div id="barra"></div>
		<div id="menu">DESENVOLVIMENTO DE SOLUÇÃO DE APRENDIZAGEM</div>
		<?php }
}
add_action('edit_form_top', 'barras');



// BOTOES ABAS *************************************************
function abas()
{
	if (get_post_type() == 'proposta') { ?>

		<div id="BlocoTab">
			<ul class="abas">
				<li>
					<div value="1" class="aba">
						<span>Passo 1</span>
					</div>
				</li>
				<li>
					<div value="2" class="aba">
						<span>Passo 2</span>
					</div>
				</li>
				<li>
					<div value="3" class="aba">
						<span>Passo 3</span>
					</div>
				</li>
				<li>
					<div value="4" class="aba">
						<span>Passo 4</span>
					</div>
				</li>
			</ul>
		</div>

	<?php }
}
add_action('edit_form_advanced', 'abas');



// Get conteudistas *************************************************
/*
function conteudista()
{
	if (get_post_type() == 'proposta') {		

		// conteudista atual		
		$id_conteud = [];
		$atual_conteud = [];
		$email_conteud = [];
		foreach (get_field('conteudista') as $cont) {
			$id_conteud[] = $cont;
			$atual_conteud[] = get_userdata($cont)->display_name;
			$email_conteud[] = get_userdata($cont)->user_email;
		}

		//todos os conteudistas
		$conteudistas = get_users(array('role__in' => array('contributor')));
		$value = [];
		$option = [];
		foreach ($conteudistas as $conteudista) {
			$option[] = $conteudista->display_name;
			$value[] = $conteudista->id;
		}
	?>
		<!-- atual -->
		<input type="hidden" id="conteudistas-atual" value="<?php echo implode(",", $atual_conteud); ?>">
		<input type="hidden" id="emailconteudista" value="<?php echo implode(",", $email_conteud); ?>">
		<input type="hidden" id="idconteudista" value="<?php echo implode(",", $id_conteud); ?>">
		<!-- todos -->
		<input type="hidden" id="conteudistas-option" value="<?php echo implode(",", $option); ?>">
		<input type="hidden" id="conteudistas-value" value="<?php echo implode(",", $value); ?>">
		<!-- valor da hora por atuacao -->
		<input type="hidden" id="valor_instrutor" value="<?php echo get_option("proposta_input_name1"); ?>">
		<input type="hidden" id="valor_tutor" value="<?php echo get_option("proposta_input_name2"); ?>">
		<input type="hidden" id="valor_monitor" value="<?php echo get_option("proposta_input_name3"); ?>">
		<input type="hidden" id="valor_cont_presencial" value="<?php echo get_option("proposta_input_name4"); ?>">
		<input type="hidden" id="valor_cont_sincrono" value="<?php echo get_option("proposta_input_name5"); ?>">
		<input type="hidden" id="valor_cont_assincrono" value="<?php echo get_option("proposta_input_name6"); ?>">
		
		<i class='bx bxs-up-arrow-square scrollToTop'></i>
	<?php
	}
}
add_action('edit_form_advanced', 'conteudista');
*/

// Relatórios *************************************************

function proposta_page_relatorios()
{ ?>
	<link rel='stylesheet' href='/wp-content/plugins/proposta-educorp/css/educorp-pages.css'>
	<div class="pagina relatorios">
		<h1>Relatórios</h1>
	</div>

<?php
}

function proposta_relatorios()
{
	add_submenu_page('edit.php?post_type=proposta', 'Relatórios', 'Relatórios', 'manage_options', 'proposta-relatorios', 'proposta_page_relatorios');
}
add_action('admin_menu', 'proposta_relatorios');


//Configuração *************************************************
function proposta_settings1()
{
	add_option('proposta_input_name1');
	register_setting('proposta_option_grupo', 'proposta_input_name1');
}
add_action('admin_init', 'proposta_settings1');

function proposta_settings2()
{
	add_option('proposta_input_name2');
	register_setting('proposta_option_grupo', 'proposta_input_name2');
}
add_action('admin_init', 'proposta_settings2');

function proposta_settings3()
{
	add_option('proposta_input_name3');
	register_setting('proposta_option_grupo', 'proposta_input_name3');
}
add_action('admin_init', 'proposta_settings3');

function proposta_settings4()
{
	add_option('proposta_input_name4');
	register_setting('proposta_option_grupo', 'proposta_input_name4');
}
add_action('admin_init', 'proposta_settings4');

function proposta_settings5()
{
	add_option('proposta_input_name5');
	register_setting('proposta_option_grupo', 'proposta_input_name5');
}
add_action('admin_init', 'proposta_settings5');

function proposta_settings6()
{
	add_option('proposta_input_name6');
	register_setting('proposta_option_grupo', 'proposta_input_name6');
}
add_action('admin_init', 'proposta_settings6');

function proposta_options_page()
{
	add_submenu_page('edit.php?post_type=proposta', 'Configurações', 'Configurações', 'manage_options', 'proposta-educorp', 'proposta_page_html');
}
add_action('admin_menu', 'proposta_options_page');


function proposta_page_html()
{
?>
	<link rel='stylesheet' href='/wp-content/plugins/proposta-educorp/css/educorp-pages.css'>
	<div class="pagina">
		<div class="settings">
			<h1 style="color:#000;">Configurações</h1>
			<h3>Valor da hora por tipo de Atuação, em R$</h3>
			<form method="post" action="options.php">
				<?php settings_fields('proposta_option_grupo'); ?>
				<label><span>Instrutor: </span><input type="number" id="proposta_input_name1" name="proposta_input_name1" value="<?php echo get_option('proposta_input_name1'); ?>" /></label><br>
				<label><span>Tutor: </span><input type="number" id="proposta_input_name2" name="proposta_input_name2" value="<?php echo get_option('proposta_input_name2'); ?>" /></label><br>
				<label><span>Monitor: </span><input type="number" id="proposta_input_name3" name="proposta_input_name3" value="<?php echo get_option('proposta_input_name3'); ?>" /></label><br>
				<label><span>Conteudista Presencial: </span><input type="number" id="proposta_input_name4" name="proposta_input_name4" value="<?php echo get_option('proposta_input_name4'); ?>" /></label><br>
				<label><span>Conteudista Remoto Síncrono: </span><input type="number" id="proposta_input_name5" name="proposta_input_name5" value="<?php echo get_option('proposta_input_name5'); ?>" /></label><br>
				<label><span>Conteudista Remoto Assíncrono:</span><input type="number" id="proposta_input_name6" name="proposta_input_name6" value="<?php echo get_option('proposta_input_name6'); ?>" /></label><br>
				<?php submit_button(); ?>
			</form>
		</div>
		<div class="sobre">
			<br>
			<h1 style="color:#f00;">Sobre o Proposta Educorp</h1>
			<p style="text-align:justify;font-size:16px">
				O plugin 'Proposta Educorp' foi criado para permitir a inclusão de propostas pelo Wordpress.<br><br>
				<a href="https://github.com/evertonmessias/solaprendiz" target="_blank">Projeto</a>
			</p>
		</div>
	</div>
<?php
}
