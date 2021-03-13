<?php
//Configuração *************************************************
function proposta_page_html(){?>
	<link rel='stylesheet' href='/wp-content/plugins/proposta-educorp/css/educorp-pages.css'>
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
<?php
}

function proposta_options_page()
{
	add_submenu_page('edit.php?post_type=proposta', 'Configurações', 'Configurações', 'manage_options', 'proposta-educorp', 'proposta_page_html');
}
add_action('admin_menu', 'proposta_options_page');

//campos
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