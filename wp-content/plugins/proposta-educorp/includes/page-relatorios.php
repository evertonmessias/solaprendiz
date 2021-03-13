<?php
// Relatórios *************************************************
function proposta_page_relatorios(){ ?>
    <link rel='stylesheet' href='/wp-content/plugins/proposta-educorp/css/educorp-pages.css'>
    <div class="relatorios">
        <h1>Relatório de Propostas</h1>
        <table>
            <tr>
                <th>Proposta</th>
                <th>Data</th>
                <th>Equipe</th>
                <th>Total (R$)</th>
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
                $pagamento1 = get_post_meta(get_the_ID(), 'pagamento1', true);
                $total = get_post_meta(get_the_ID(), 'total', true);
            ?>
                <tr>
                    <td><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></td>
                    <td><?php echo get_the_date('d/m/Y'); ?></td>
                    <td><?php echo $pagamento1; ?></td>
                    <td><?php echo $total;
                        $totalgeral = $totalgeral + $total ?></td>
                </tr>
            <?php endwhile;
            wp_reset_postdata(); ?>
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
