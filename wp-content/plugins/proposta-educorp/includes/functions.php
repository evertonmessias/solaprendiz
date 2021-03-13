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
	return '/propostas';
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
	if (in_array('responsavel', (array) $user->roles)) {					
		echo "<link rel='stylesheet' href='/wp-content/plugins/proposta-educorp/css/educorp-responsavel.css'>";
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
		
		$ativado = get_post_meta($post->ID, 'ativado', true);
		$conteudista = explode(",", get_post_meta($post->ID, 'conteudista', true));
		$permitido = false;

		$nomeconteudista = [];
		$emailconteudista = [];

		foreach ($conteudista as $cont) {	
			$nomeconteudista[] = get_userdata($cont)->display_name;
			$emailconteudista[] = get_userdata($cont)->user_email;		
			if (get_current_user_id() == $cont) {
				$permitido = true;
			}
		}
		if (($ativado == "on" && $permitido) || $ehresp) {
			echo "";
		} else {
			echo "<script>window.location.href = '/naopermitido'</script>";
		}
		
		
	?>	
		<input type="hidden" id="adminemail" value="<?php echo get_option('admin_email'); ?>">
		<input type="hidden" id="ehresp" value="<?php echo $ehresp; ?>">
		<input type="hidden" id="nomeconteudista" value="<?php echo implode(",", $nomeconteudista); ?>">
		<input type="hidden" id="emailconteudista" value="<?php echo implode(",", $emailconteudista); ?>">
	<?php
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

// BUTTON SCROLLtoTOP
function scrolltotop()
{
	if (get_post_type() == 'proposta') {?>	
		<i class='bx bxs-up-arrow-square scrollToTop'></i>
	<?php
	}
}
add_action('edit_form_advanced', 'scrolltotop');