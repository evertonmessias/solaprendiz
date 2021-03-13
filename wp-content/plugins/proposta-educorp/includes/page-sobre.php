<?php
// Sobre *************************************************
function proposta_page_sobre(){?>
    <link rel='stylesheet' href='/wp-content/plugins/proposta-educorp/css/educorp-pages.css'>
    <div class="sobre">
        <h1 style="color:#f00;">Sobre o Proposta Educorp</h1>
        <p style="text-align:justify;font-size:16px">
            O plugin 'Proposta Educorp' foi criado para permitir a inclusão de propostas pelo Wordpress.<br><br>
            <a href="https://github.com/evertonmessias/solaprendiz" target="_blank">Projeto</a>
        </p>
    </div>
<?php
}

function proposta_sobre()
{
    add_submenu_page('edit.php?post_type=proposta', 'Sobre', 'Sobre', 'manage_options', 'proposta-sobre', 'proposta_page_sobre');
}
add_action('admin_menu', 'proposta_sobre');
