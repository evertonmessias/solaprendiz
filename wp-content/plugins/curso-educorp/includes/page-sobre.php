<?php
// Sobre *************************************************
function curso_page_sobre(){?>
    <link rel='stylesheet' href='/wp-content/plugins/curso-educorp/css/educorp-pages.css'>
    <div class="sobre">
        <h1 style="color:#f00;">Sobre o curso Educorp</h1>
        <p style="text-align:justify;font-size:16px">
            O plugin 'curso Educorp' foi criado para permitir a inclusão de cursos pelo Wordpress.<br><br>
            <a href="https://github.com/evertonmessias/solaprendiz" target="_blank">Projeto</a>
        </p>
    </div>
<?php
}

function curso_sobre()
{
    add_submenu_page('edit.php?post_type=curso', 'Sobre', 'Sobre', 'manage_options', 'curso-sobre', 'curso_page_sobre');
}
add_action('admin_menu', 'curso_sobre');
