<?php get_header();
if (is_user_logged_in()) {
?>
   <h1>&nbsp;</h1>
   <main id="main">
      <!-- ======= Breadcrumbs ======= -->
      <section id="breadcrumbs" class="breadcrumbs">
         <div class="container">
            <ol>
               <li><a href="/">Home</a></li>
               <li><a href="/propostas">Propostas</a></li>
               <li><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></li>
            </ol>
         </div>
      </section><!-- End Breadcrumbs -->

      <!-- ======= Portfolio Details Section ======= -->
      <section id="portfolio-details" class="portfolio-details">
         <div class="container">
            <?php
            $permitido = false;
            foreach (explode(",", get_post_meta(get_the_ID(), 'conteudista', true)) as $cont) {
               if (get_current_user_id() == $cont) {
                  $permitido = true;
               }
            }
            $user = wp_get_current_user();
            if ($permitido || in_array('administrator', (array) $user->roles) || in_array('responsavel', (array) $user->roles)) { ?>

               <div class="portfolio-description">
                  <h2>I. CARACTERIZAÇÃO DA DEMANDA</h2>
                  <fieldset>
                     <legend>1. TÍTULO DA CAPACITAÇÃO
                        <span class="data"><strong>Data</strong>: <?php echo get_the_date('d/m/Y'); ?></span>
                     </legend>
                     <strong><?php echo the_title(); ?></strong>
                  </fieldset>

                  <fieldset>
                     <legend>2. ANÁLISE CONTEXTUAL</legend>
                     <?php echo get_post_meta(get_the_ID(), 'contexto', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>3. OBJETIVO ESTRATÉGICO PLANES 2021-2025</legend>
                     <p><?php
                        if (get_post_meta(get_the_ID(), "objetivo1", true) == 'on') echo "1.1. Ampliar o acesso e a diversidade da comunidade universitária e as políticas de inclusão, permanência e apoio acadêmico.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo2", true) == 'on') echo "1.2. Promover a inovação, extensão, cultura e transferência de conhecimento, intensificando a cooperação dialógica com o poder público e a sociedade, em consonância com os Objetivos de Desenvolvimento Sustentável.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo3", true) == 'on') echo "1.3. Desenvolver uma cultura de interação com os egressos, contribuindo para o aprimoramento da Universidade<br>";
                        if (get_post_meta(get_the_ID(), "objetivo4", true) == 'on') echo "1.4. Ampliar e fortalecer a comunicação efetiva com os diversos setores da sociedade, buscando dar visibilidade às nossas atividades e seus impactos.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo5", true) == 'on') echo "2.1. Ampliar visibilidade dos programas de ensino, em todos os níveis, para que mais estudantes se sintam atraídos pela experiência formativa da UNICAMP.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo6", true) == 'on') echo "2.2. Ter currículos atualizados, flexíveis, centrados no estudante, que utilizem recursos tecnológicos e incorporem atividades extra curriculares, co-curriculares e de extensão em todos os níveis de ensino.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo7", true) == 'on') echo "2.3. Promover pesquisas integradas de forma a assumir o protagonismo frente aos desafios da sociedade contemporânea.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo8", true) == 'on') echo "2.4. Reconhecer e valorizar as atividades de extensão na carreira docente e no ambiente acadêmico discente.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo9", true) == 'on') echo "2.5. Intensificar as parcerias com diferentes setores da sociedade como forma de diversificar as fontes de captação nacional e internacional de recursos de pesquisa.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo10", true) == 'on') echo "3.1. Aprimorar a atratividade das carreiras da Universidade visando a preservação dos quadros de alto nível condizentes com a missão e a visão de futuro da UNICAMP.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo11", true) == 'on') echo "3.2. Garantir a sustentabilidade orçamentária, financeira, operacional e de infraestrutura da Universidade.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo12", true) == 'on') echo "3.3. Aperfeiçoar e modernizar o modelos de gestão administrativa e acadêmica que garanta o bom desenvolvimento das atividades-fim da Universidade.<br>";
                        if (get_post_meta(get_the_ID(), "objetivo13", true) == 'on') echo "3.4. Estabelecer um modelo sustentável de gestão financeira e administrativa para a área da saúde.<br>";
                        ?></p>
                  </fieldset>

                  <fieldset>
                     <legend>4. OBJETIVOS DA CAPACITAÇÃO</legend>
                     <?php echo get_post_meta(get_the_ID(), 'capacitacao', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>5. PÚBLICO-ALVO</legend>
                     <?php echo get_post_meta(get_the_ID(), 'publico', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>6. ESTIMATIVA DE QUANTIDADE DE PÚBLICO-ALVO</legend>
                     <?php echo get_post_meta(get_the_ID(), 'estimativa', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>7. APLICAÇÃO</legend>
                     <?php echo get_post_meta(get_the_ID(), 'aplicacao', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>8. CONTEUDISTA(s)</legend>
                     <?php
                     foreach (explode(",", get_post_meta(get_the_ID(), 'conteudista', true)) as $cont) {
                        echo get_userdata($cont)->display_name . "<br>";
                     } ?>
                  </fieldset>

                  <br><br><br>
                  <h2>II. CARACTERIZAÇÃO DO CURSO</h2>

                  <fieldset>
                     <legend>1. EMENTA</legend>
                     <?php echo get_post_meta(get_the_ID(), 'ementa', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>2. CONTEÚDO PROGRAMÁTICO</legend>
                     <?php echo get_post_meta(get_the_ID(), 'conteudo', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>3. MODALIDADE</legend>
                     <?php echo get_post_meta(get_the_ID(), 'modalidade', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>4. METODOLOGIA/ESTRATÉGIAS DE APRENDIZAGEM</legend>
                     <?php echo get_post_meta(get_the_ID(), 'metodologia', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>5. AVALIAÇÃO DE APRENDIZAGEM</legend>
                     <?php echo get_post_meta(get_the_ID(), 'avaliacao', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>6. CRITÉRIOS PARA APROVAÇÃO</legend>
                     <?php echo get_post_meta(get_the_ID(), 'criterios', true); ?>
                  </fieldset>

                  <fieldset>
                     <legend>7. CARGA HORÁRIA DA CAPACITAÇÃO</legend>
                     <?php $carga = explode(",", get_post_meta(get_the_ID(), 'carga', true)); ?>
                     <table class="carga">
                        <tr>
                           <td>Videoaula gravada</td>
                           <td><?php echo get_post_meta(get_the_ID(), 'carga1', true); ?></td>
                        </tr>
                        <tr>
                           <td>Videos diversos</td>
                           <td><?php echo get_post_meta(get_the_ID(), 'carga2', true); ?></td>
                        </tr>
                        <tr>
                           <td>Textos, artigos, capítulos de livros e similares</td>
                           <td><?php echo get_post_meta(get_the_ID(), 'carga3', true); ?></td>
                        </tr>
                        <tr>
                           <td>Aulas síncronas ou presenciais</td>
                           <td><?php echo get_post_meta(get_the_ID(), 'carga4', true); ?></td>
                        </tr>
                        <tr>
                           <td>Elaboração de projetos, mapeamentos de processos, TCCs e demais atividades práticas</td>
                           <td><?php echo get_post_meta(get_the_ID(), 'carga5', true); ?></td>
                        </tr>
                        <tr>
                           <td><strong>TOTAL DA CARGA HORÁRIA DA CAPACITAÇÃO</strong></td>
                           <td><strong><?php echo get_post_meta(get_the_ID(), 'cargatotal', true); ?></strong></td>
                        </tr>
                     </table>
                  </fieldset>

                  <fieldset>
                     <legend>8. EQUIPE DA CAPACITAÇÃO</legend>
                     <?php
                     $equipe0 = explode(",", get_post_meta(get_the_ID(), 'equipe0', true));
                     $equipe1 = explode(",", get_post_meta(get_the_ID(), 'equipe1', true));
                     $equipe2 = explode(",", get_post_meta(get_the_ID(), 'equipe2', true));
                     $equipe3 = explode(",", get_post_meta(get_the_ID(), 'equipe3', true));
                     $equipe4 = explode(",", get_post_meta(get_the_ID(), 'equipe4', true));
                     $equipe5 = explode(",", get_post_meta(get_the_ID(), 'equipe5', true));
                     $equipe6 = explode(",", get_post_meta(get_the_ID(), 'equipe6', true));

                     $nl = get_post_meta(get_the_ID(), 'nl', true);
                     ?>
                     <table class="equipe">
                        <tr>
                           <th><strong>Matrícula: </strong></th>
                           <th><strong>Nome Completo: </strong></th>
                           <th><strong>Superior imediato: </strong></th>
                           <th><strong>Unidade/Depto: </strong></th>
                           <th><strong>E-mail: </strong></th>
                           <th><strong>Carga horária: </strong></th>
                           <th><strong>Atuação: </strong></th>
                        </tr>
                        <?php for ($i = 0; $i < $nl; $i++) {
                        ?>
                           <tr>
                              <td><?php echo $equipe0[$i]; ?></td>
                              <td><?php echo $equipe1[$i]; ?></td>
                              <td><?php echo $equipe2[$i]; ?></td>
                              <td><?php echo $equipe3[$i]; ?></td>
                              <td><?php echo $equipe4[$i]; ?></td>
                              <td><?php echo $equipe5[$i]; ?></td>
                              <td><?php echo $equipe6[$i]; ?></td>
                           </tr>
                        <?php } ?>
                     </table>
                  </fieldset>

                  <fieldset>
                     <legend>9. BIBLIOGRAFIA</legend>
                     <?php echo get_post_meta(get_the_ID(), 'bibliografia', true); ?>
                  </fieldset>

                  <br><br><br>
                  <h2>III. CARACTERIZAÇÃO DO OFERECIMENTO</h2>

                  <fieldset>
                     <legend>1. CALENDÁRIO DE OFERECIMENTO DAS TURMAS</legend>
                     <?php
                     $calendario1 = explode(",", get_post_meta(get_the_ID(), 'calendario1', true));
                     $calendario2 = explode(",", get_post_meta(get_the_ID(), 'calendario2', true));
                     $calendario3 = explode(",", get_post_meta(get_the_ID(), 'calendario3', true));
                     $calendario4 = explode(",", get_post_meta(get_the_ID(), 'calendario4', true));
                     $calendario5 = explode(",", get_post_meta(get_the_ID(), 'calendario5', true));
                     $calendario6 = explode(",", get_post_meta(get_the_ID(), 'calendario6', true));
                     $calendario7 = explode(",", get_post_meta(get_the_ID(), 'calendario7', true));
                     $calendario8 = explode(",", get_post_meta(get_the_ID(), 'calendario8', true));
                     $calendario9 = explode(",", get_post_meta(get_the_ID(), 'calendario9', true));

                     $nlc = get_post_meta(get_the_ID(), 'nlc', true);
                     ?>
                     <table class="calendario">
                        <tr>
                           <th><strong>Turma: </strong></th>
                           <th><strong>Vagas: </strong></th>
                           <th><strong>Data Inicio: </strong></th>
                           <th><strong>Data Fim: </strong></th>
                           <th><strong>Dia da Semana: </strong></th>
                           <th><strong>Horário: </strong></th>
                           <th><strong>Instrutor: </strong></th>
                           <th><strong>Carga Horária: </strong></th>
                           <th><strong>Atuação: </strong></th>
                        </tr>
                        <?php for ($i = 0; $i < $nlc; $i++) {
                        ?>
                           <tr>
                              <td><?php echo $calendario1[$i]; ?></td>
                              <td><?php echo $calendario2[$i]; ?></td>
                              <td><?php echo $calendario3[$i]; ?></td>
                              <td><?php echo $calendario4[$i]; ?></td>
                              <td><?php echo $calendario5[$i]; ?></td>
                              <td><?php echo $calendario6[$i]; ?></td>
                              <td><?php echo $calendario7[$i]; ?></td>
                              <td><?php echo $calendario8[$i]; ?></td>
                              <td><?php echo $calendario9[$i]; ?></td>
                           </tr>
                        <?php } ?>
                     </table>
                  </fieldset>


                  <fieldset>
                     <legend>2. LOCAL</legend>
                     <?php echo get_post_meta(get_the_ID(), 'local', true); ?>
                  </fieldset>

                  <?php if (get_post_meta(get_the_ID(), 'showpagamento', true) == "on") { ?>
                     <br><br><br>
                     <h2>IV. INFORMAÇÕES GERENCIAIS </h2>
                     <fieldset>
                        <legend>1. CONSOLIDAÇÃO PARA PAGAMENTO </legend>
                        <?php
                        $pagamento1 = explode(",", get_post_meta(get_the_ID(), 'pagamento1', true));
                        $pagamento2 = explode(",", get_post_meta(get_the_ID(), 'pagamento2', true));
                        $pagamento3 = explode(",", get_post_meta(get_the_ID(), 'pagamento3', true));
                        $pagamento4 = explode(",", get_post_meta(get_the_ID(), 'pagamento4', true));
                        $pagamento5 = explode(",", get_post_meta(get_the_ID(), 'pagamento5', true));

                        $nl = get_post_meta(get_the_ID(), 'nl', true);
                        ?>
                        <table class="pagamento">
                           <tr>
                              <th><strong>Matrícula: </strong></th>
                              <th><strong>Nome Completo: </strong></th>
                              <th><strong>Atuação: </strong></th>
                              <th><strong>Carga horária: </strong></th>
                              <th><strong>Valor (R$): </strong></th>
                           </tr>
                           <?php for ($i = 0; $i < $nl; $i++) {
                           ?>
                              <tr>
                                 <td><?php echo $pagamento1[$i]; ?></td>
                                 <td><?php echo $pagamento2[$i]; ?></td>
                                 <td><?php echo $pagamento3[$i]; ?></td>
                                 <td><?php echo $pagamento4[$i]; ?></td>
                                 <td><?php echo $pagamento5[$i]; ?></td>
                              </tr>
                           <?php } ?>
                        </table>
                        <p style="font-size:20px !important;text-align:right;"><b>Total: </b>R$ <?php echo get_post_meta(get_the_ID(), 'total', true); ?>&emsp;</p>
                     </fieldset>
                  <?php } ?>

                  <h1>&nbsp;</h1>
                  <?php $ativado = get_post_meta(get_the_ID(), 'ativado', true);
                  if ($ativado == "on") {
                     echo "<a class='get-started-btn' href='/wp-admin/post.php?post=" . get_the_ID(), "&action=edit'>Editar</a>";
                  }
                  ?>
                  <h1>&nbsp;</h1>
                  <hr>
               </div>
            <?php } else {
               echo "<h4>Essa proposta não é sua !</h4>";
            } ?>
         </div>
      </section><!-- End Portfolio Details Section -->

   </main><!-- End #main -->
   <i class='bx bxs-up-arrow-square scrollToTop'></i>
<?php
} else { ?>
   <script>
      window.location.href = "/wp-admin"
   </script>
<?php }

get_footer(); ?>