<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>

<?php

/**
 * Plugin Name: Proposta Educorp
 * Plugin URI: https://ic.unicamp.br/~everton
 * Description: Plugin para criação de Propostas para Educorp
 * Author: Everton Messias
 * Version: 1.0
 * Text Domain: proposta
 * Este é um plugin para criação de Propostas para Educorp
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}
class PropostaEducorp
{
	public function __construct()
	{
		add_action('init', array($this, 'create_custom_post_type_modulo'));
	}

	public function create_custom_post_type_modulo()
	{
		$labels = [
			'name'					=> _x('Proposta', 'proposta', 'text_domain'),
			'singular_name'			=> _x('Proposta', 'proposta', 'text_domain'),
			'menu_name'				=> __('Proposta', 'text_domain'),
			'name_admin_bar'		=> __('Proposta', 'text_domain')
		];
		$args = [
			'label'                	=> __('Proposta', 'text_domain'),
			'description'           => __('Descrição Proposta', 'text_domain'),
			'labels'				=> $labels,
			'supports'              => ['title', 'editor'/*, 'author', 'thumbnail', 'excerpt'*/],
			'taxonomies'            => ['category'/*, 'post_tag'*/],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 3,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'			=> true,
			'menu_icon'             => 'dashicons-book',
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post'
		];
		register_post_type('proposta', $args);
	}

	public function activate()
	{
		$this->create_custom_post_type_modulo();
		flush_rewrite_rules();
		global $wpdb;
		$wpdb->get_results("INSERT INTO wp_posts(post_author,post_content,post_title,post_status,comment_status,ping_status,post_type,comment_count) VALUES(1,'proposta teste','Proposta Teste','publish','open','open','proposta',0);");
	}

	public function deactivate()
	{
		flush_rewrite_rules();
		// ****** cuidado com isso !!!!!!!!
		//global $wpdb;
		//$wpdb->get_results("DELETE from wp_posts where post_type='proposta';");
	}
}

// ADD style & script
function style_and_script()
{
	if(get_post_type() == 'proposta'){
	wp_enqueue_style( 'stilos', '/wp-content/plugins/proposta-educorp/css/educorp.css');		
	wp_enqueue_script( 'scripts', '/wp-content/plugins/proposta-educorp/js/educorp.js');
	}
}
add_action('admin_enqueue_scripts', 'style_and_script');



//AVISO
function aviso() { 
	if (get_post_type() == 'proposta') {?>
<div id="quadro">
		<i class="bx bxs-x-square"></i>
		<h2>Atenção</h2>
		<p>Preencha todos os campos antes de avançar.</p>			
</div>	
<?php } }
add_action( 'edit_form_top', 'aviso');



//TITLE
function title() { 
	if (get_post_type() == 'proposta') {?>
	<div class="conteudo conteudo1">
	<br><p>Roteiro para elaboração de solução de capacitação preenchido conjuntamente entre CONTEUDISTA E EQUIPE, até a validação da versão final.</p><br>
	<h2 style='font-size:20px;font-weight:bold;'>I. CARACTERIZAÇÃO DA DEMANDA</h2><br>
	<strong>1. TÍTULO DA CAPACITAÇÃO</strong><br><br>
	<span>Escreva o nome final exato do curso</span>
	</div>
<?php } }
add_action( 'edit_form_top', 'title');



// BARRAS TOP
function barras() { 
	if (get_post_type() == 'proposta') {?>
<div id="back"></div>
<div id="barra"></div>
<div id="menu">DESENVOLVIMENTO DE SOLUÇÃO DE APRENDIZAGEM</div> 
<?php }}
add_action('edit_form_top', 'barras');



// VERIFICAR PERMISSÕES  : ********************
function permissao()
{
	if (get_post_type() == 'proposta') {
$user = wp_get_current_user();
if (in_array('contributor', (array) $user->roles)) {	
	get_header();
	?>
	<link rel='stylesheet' href='/wp-content/plugins/proposta-educorp/css/educorp-conteudista.css'>
	<?php
	echo "<br><br>";
}

$ehresp = 0;
if(in_array('administrator', (array) $user->roles) || in_array('author', (array) $user->roles)){
	$ehresp = 1;
}
?>
<input type="hidden" id="ehresp" value="<?php echo $ehresp; ?>">
<?php


$ativado = get_field('ativado');  
$permitido = false;
foreach (get_field('conteudista') as $cont) {
   if(get_current_user_id() == $cont){
      $permitido = true;
   }   
} 
if (($ativado[0] == "Ativado" && $permitido) || $ehresp) {
	echo "";
}else{
	echo "<script>window.location.href = '/naopermitido'</script>";
}
}}
add_action('edit_form_top', 'permissao');



// BOTOES ABAS
function abas() { 
	if (get_post_type() == 'proposta') {?>

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

<?php }}
add_action('edit_form_advanced', 'abas');



// get conteudistas
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
	<i class='bx bxs-up-arrow-square scrollToTop'></i>
<?php
	}
}
add_action('edit_form_advanced', 'conteudista');

//Sobre

function mensagem(){?>
	<br>
    <h1 style="color:#f00;">Sobre o Proposta Educorp</h1>
	<p style="text-align:justify;font-size:16px">
	O plugin 'Proposta Educorp' foi criado para permitir a inclusão de propostas pelo Wordpress.<br><br>
	<a href="https://github.com/evertonmessias/solaprendiz" target="_blank">Projeto</a></p>
<?php }

function sobre(){
    add_submenu_page('edit.php?post_type=proposta','Sobre esse o Proposta Educorp','Sobre','manage_options','proposta-educorp','mensagem',10 );
}add_action('admin_menu', 'sobre');


// OBJETO

if (class_exists('PropostaEducorp')) {
	$prop = new PropostaEducorp();
	register_activation_hook(__FILE__, array($prop, 'activate'));
	register_deactivation_hook(__FILE__, array($prop, 'deactivate'));
}


//****************************  NAO USADO *************************** */

/* CAMPOS POSTMETA EX - não usado nesse projeto !!!!
function campos_educorp()
{
	add_meta_box('member_sectionid', 'Telefones', 'campo_imput', 'proposta');
}
add_action('add_meta_boxes', 'campos_educorp');

function campo_imput($post)
{
	$value = get_post_meta($post->ID, 'num_telefone', true);
	$value = explode(',', $value);

	echo '<input type="tel" placeholder="Telefone" name="numero_telefone1" value="' . esc_attr($value[0]) . '" size="25" /><br>';
	echo '<input type="tel" placeholder="Celular" name="numero_telefone2" value="' . esc_attr($value[1]) . '" size="25" />';
}

function salvar_no_postmeta($post_id)
{
	$my_data[] = sanitize_text_field($_POST['numero_telefone1']);
	$my_data[] = sanitize_text_field($_POST['numero_telefone2']);

	$my_data = implode(',', $my_data);

	update_post_meta($post_id, 'num_telefone', $my_data);
}
add_action('save_post', 'salvar_no_postmeta');
*/