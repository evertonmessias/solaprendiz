<?php
// Relatórios *************************************************
function curso_page_relatorios(){ ?>
    <link rel='stylesheet' href='/wp-content/plugins/curso-educorp/css/educorp-pages.css'>
    <div class="relatorios">
        <h1>Relatório de cursos</h1>
        <table>
            <tr>
                <th>Curso</th>
                <th>Data</th>
                <th>Equipe</th>
                <th>Total</th>
            </tr>
            <?php
            $lastupdated_args = array(
                'post_type' => 'curso',
                'posts_per_page' => 10,
                'order' => 'DESC'
            );
            $lastupdated_loop = new WP_Query($lastupdated_args);
            $totalgeral = 0;
            while ($lastupdated_loop->have_posts()) : $lastupdated_loop->the_post();
                $pagamento2 = get_post_meta(get_the_ID(), 'pagamento2', true);
                $total = get_post_meta(get_the_ID(), 'total', true);               
            ?>
                <tr>
                    <td><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></td>
                    <td><?php echo get_the_date('d/m/Y'); ?></td>
                    <td><?php echo $pagamento2; ?></td>
                    <td><?php echo "R$ ".$total.",00";
                    $totalgeral = $totalgeral + $total ?></td>
                </tr>
            <?php endwhile;
            wp_reset_postdata(); ?>
            <tr>
                <td style="text-align: right;" colspan="3"><b>TOTAL GERAL:&emsp;</b></td>
                <td><?php echo "R$ ".$totalgeral.",00" ?></td>
            </tr>
        </table>
    </div>
<?php
}

function curso_relatorios()
{
    add_submenu_page('edit.php?post_type=curso', 'Relatórios', 'Relatórios', 'manage_options', 'curso-relatorios', 'curso_page_relatorios');
}
add_action('admin_menu', 'curso_relatorios');
