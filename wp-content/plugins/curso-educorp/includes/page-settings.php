<?php
//Configuração *************************************************
function curso_page_html()
{ ?>
	<link rel='stylesheet' href='/wp-content/plugins/curso-educorp/css/educorp-pages.css'>
	<div class="settings">
		<h1 style="color:#000;">Configurações</h1>
		<h3>Valor da hora por tipo de Atuação, em R$</h3>
		<form method="post" action="options.php">
			<?php settings_fields('curso_option_grupo'); ?>
			<label><input type="number" min="0" id="curso_input_name1" name="curso_input_name1" value="<?php echo get_option('curso_input_name1'); ?>" /><span> Instrutor</span></label><br><br>
			<label><input type="number" min="0" id="curso_input_name2" name="curso_input_name2" value="<?php echo get_option('curso_input_name2'); ?>" /><span> Orientador</span></label><br><br>
			<label><input type="number" min="0" id="curso_input_name3" name="curso_input_name3" value="<?php echo get_option('curso_input_name3'); ?>" /><span> Tutor</span></label><br><br>
			<label><input type="number" min="0" id="curso_input_name4" name="curso_input_name4" value="<?php echo get_option('curso_input_name4'); ?>" /><span> Multiplicador</span></label><br><br>
			<label><input type="number" min="0" id="curso_input_name5" name="curso_input_name5" value="<?php echo get_option('curso_input_name5'); ?>" /><span> Facilitador</span></label><br><br>
			<label><input type="number" min="0" id="curso_input_name6" name="curso_input_name6" value="<?php echo get_option('curso_input_name6'); ?>" /><span> Monitor</span></label><br><br>
			<label><input type="number" min="0" id="curso_input_name7" name="curso_input_name7" value="<?php echo get_option('curso_input_name7'); ?>" /><span> Conteudista Presencial</span></label><br><br>
			<label><input type="number" min="0" id="curso_input_name8" name="curso_input_name8" value="<?php echo get_option('curso_input_name8'); ?>" /><span> Conteudista Remoto Síncrono</span></label><br><br>
			<label><input type="number" min="0" id="curso_input_name9" name="curso_input_name9" value="<?php echo get_option('curso_input_name9'); ?>" /><span> Conteudista Remoto Assíncrono</span></label><br><br>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

function curso_options_page()
{
	add_submenu_page('edit.php?post_type=curso', 'Configurações', 'Configurações', 'manage_options', 'curso-educorp', 'curso_page_html');
}
add_action('admin_menu', 'curso_options_page');

//campos
function curso_settings1()
{
	add_option('curso_input_name1');
	register_setting('curso_option_grupo', 'curso_input_name1');
}
add_action('admin_init', 'curso_settings1');

function curso_settings2()
{
	add_option('curso_input_name2');
	register_setting('curso_option_grupo', 'curso_input_name2');
}
add_action('admin_init', 'curso_settings2');

function curso_settings3()
{
	add_option('curso_input_name3');
	register_setting('curso_option_grupo', 'curso_input_name3');
}
add_action('admin_init', 'curso_settings3');

function curso_settings4()
{
	add_option('curso_input_name4');
	register_setting('curso_option_grupo', 'curso_input_name4');
}
add_action('admin_init', 'curso_settings4');

function curso_settings5()
{
	add_option('curso_input_name5');
	register_setting('curso_option_grupo', 'curso_input_name5');
}
add_action('admin_init', 'curso_settings5');

function curso_settings6()
{
	add_option('curso_input_name6');
	register_setting('curso_option_grupo', 'curso_input_name6');
}
add_action('admin_init', 'curso_settings6');

function curso_settings7()
{
	add_option('curso_input_name7');
	register_setting('curso_option_grupo', 'curso_input_name7');
}
add_action('admin_init', 'curso_settings7');

function curso_settings8()
{
	add_option('curso_input_name8');
	register_setting('curso_option_grupo', 'curso_input_name8');
}
add_action('admin_init', 'curso_settings8');

function curso_settings9()
{
	add_option('curso_input_name9');
	register_setting('curso_option_grupo', 'curso_input_name9');
}
add_action('admin_init', 'curso_settings9');