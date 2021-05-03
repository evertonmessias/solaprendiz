<?php

/**
 * Plugin Name: Curso Educorp
 * Plugin URI: https://ic.unicamp.br/~everton
 * Description: Plugin para criação de Cursos para Educorp
 * Author: Everton Messias
 * Version: 1.0
 * Text Domain: Curso
 * Este é um plugin para criação de Cursos para Educorp
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

class cursoEducorp
{
	public function __construct()
	{
		add_action('init', array($this, 'create_custom_post_type_modulo'));
	}

	public function create_custom_post_type_modulo()
	{
		$labels = [
			'name'					=> _x('Curso', 'Curso', 'text_domain'),
			'singular_name'			=> _x('Curso', 'Curso', 'text_domain'),
			'menu_name'				=> __('Cursos', 'text_domain'),
			'name_admin_bar'		=> __('Curso', 'text_domain')
		];
		$args = [
			'label'                	=> __('Curso', 'text_domain'),
			'description'           => __('Descrição Curso', 'text_domain'),
			'labels'				=> $labels,
			'supports'              => ['title'/*, 'editor', 'author', 'thumbnail', 'excerpt'*/],
			'taxonomies'            => [/*'category', 'post_tag'*/],
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
			'capability_type'     	=> array('post', 'curso'),
			'map_meta_cap'        => true,
		];
		register_post_type('curso', $args);
	}

	function create_custom_conteudista_role()
	{
		add_role(
			'conteudista',
			'Conteudista',
			array(
				'read' => true,
				'edit_posts' => false,
				'delete_posts' => false,
				'publish_posts' => false,
				'upload_files' => false,
			)
		);
	}
	function create_custom_responsavel_role()
	{
		add_role(
			'responsavel',
			'Responsavel',
			array(
				'read' => true,
				'edit_posts' => false,
				'delete_posts' => false,
				'publish_posts' => false,
				'upload_files' => false,
			)
		);
	}


	public function activate()
	{
		remove_role('subscriber');
		remove_role('contributor');
		remove_role('author');
		$this->create_custom_post_type_modulo();
		$this->create_custom_conteudista_role();
		$this->create_custom_responsavel_role();
		flush_rewrite_rules();
		//global $wpdb;
		//$wpdb->get_results("INSERT INTO wp_posts(post_author,post_content,post_title,post_status,comment_status,ping_status,post_type,comment_count) VALUES(1,'curso teste','curso Teste','publish','open','open','curso',0);");
	}

	public function deactivate()
	{
		remove_role('conteudista');
		remove_role('responsavel');
		flush_rewrite_rules();
	}
}

// FUNÇÕES ************************************************
include ABSPATH . '/wp-content/plugins/curso-educorp/includes/functions.php';

//USER ***************************************************
include ABSPATH . '/wp-content/plugins/curso-educorp/includes/user.php';

// PAGES ************************************************
include ABSPATH . '/wp-content/plugins/curso-educorp/includes/page-relatorios.php';
include ABSPATH . '/wp-content/plugins/curso-educorp/includes/page-settings.php';
include ABSPATH . '/wp-content/plugins/curso-educorp/includes/page-sobre.php';

// POSTMETA ************************************************
include ABSPATH . '/wp-content/plugins/curso-educorp/includes/postmeta.php';

// OBJETO *************************************************
if (class_exists('cursoEducorp')) {
	$prop = new cursoEducorp();
	register_activation_hook(__FILE__, array($prop, 'activate'));
	register_deactivation_hook(__FILE__, array($prop, 'deactivate'));
}
