<?php
// Relatórios *************************************************

function proposta_page_relatorios()
{ ?>
	<link rel='stylesheet' href='/wp-content/plugins/proposta-educorp/css/educorp-pages.css'>
	<div class="pagina relatorios">
		<h1>Relatório de Propostas</h1>
        <table>
        <tr>
        <th>Proposta</th><th>Data</th><th>Equipe</th><th>Total (R$)</th>
        </tr>
        
        <?php
        $lastupdated_args = array(
            'post_type' => 'proposta',
            'posts_per_page' => 10,
            'order' => 'DESC'
         );
         $lastupdated_loop = new WP_Query($lastupdated_args);
         $totalgeral = 0;
         while ($lastupdated_loop->have_posts()) : $lastupdated_loop->the_post();
         $pagamento1 = get_post_meta(get_the_ID(),'pagamento1',true);
         $total = get_post_meta(get_the_ID(),'total',true);
          ?> 
          <tr>                                            
        <td><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></td>
        <td><?php echo get_the_date('d/m/Y'); ?></td>                 
        <td><?php echo $pagamento1; ?></td>  
        <td><?php echo $total;$totalgeral = $totalgeral + $total ?></td>  
        </tr>
      <?php 
         endwhile;
         wp_reset_postdata();
    ?>
    <tr>
        <td style="text-align: right;" colspan="3"><b>TOTAL GERAL:&emsp;</b></td>
        <td><?php echo $totalgeral ?></td>
    </tr>
        </table>
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
