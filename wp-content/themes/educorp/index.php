<?php get_header();
if (is_user_logged_in()) {
?>
   <h1>&nbsp;</h1>
   <main id="main">
      <!-- ======= Breadcrumbs ======= -->
      <section id="breadcrumbs" class="breadcrumbs">
         <div class="container">
            <ol>
               <li><a href="index.html">Home</a></li>
               <li>Proposta</li>
            </ol>
         </div>
      </section><!-- End Breadcrumbs -->

      <!-- ======= Portfolio Details Section ======= -->
      <section id="portfolio-details" class="portfolio-details">
         <div class="container">
            <?php 
            $permitido = false;
            foreach (get_field('conteudista') as $cont) {
               if(get_current_user_id() == $cont){
                  $permitido = true;
               }               
            }
            $user = wp_get_current_user();            
            if ($permitido || in_array('administrator', (array) $user->roles) || in_array('author', (array) $user->roles)) { ?>
               <div class="portfolio-details-container">
                  <div class="portfolio-info">
                     <strong>Data</strong>: <?php echo get_the_date('d/m/Y H:i'); ?>
                  </div>
               </div>
               <div class="portfolio-description">
                  <h2>I. CARACTERIZAÇÃO DA DEMANDA</h2>
                  <fieldset>
                     <legend>1. TÍTULO DA CAPACITAÇÃO</legend>
                     <strong><?php echo the_title(); ?></strong>
                  </fieldset>                 

                  <fieldset>
                     <legend>2. ANÁLISE CONTEXTUAL</legend>
                     <?php echo get_field('contexto'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>3. OBJETIVO ESTRATÉGICO PLANES 2021-2025</legend>
                     <p><?php foreach (get_field('objetivo') as $objetivo) {
                           echo $objetivo['value'] . "<br>";
                        } ?></p>
                  </fieldset>

                  <fieldset>
                     <legend>4. OBJETIVOS DA CAPACITAÇÃO</legend>
                     <?php echo get_field('capacitacao'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>5. PÚBLICO-ALVO</legend>
                     <?php echo get_field('publico'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>6. ESTIMATIVA DE QUANTIDADE DE PÚBLICO-ALVO</legend>
                     <?php echo get_field('estimativa'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>7. APLICAÇÃO</legend>
                     <?php echo get_field('aplicacao'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>8. CONTEUDISTA(s)</legend>                     
                     <p><?php                      
                     foreach (get_field('conteudista') as $cont) {
                           echo get_userdata($cont)->display_name . "<br>";
                        } ?></p>
                  </fieldset>

                  <br><br><br>
                  <h2>II. CARACTERIZAÇÃO DO CURSO</h2>

                  <fieldset>
                     <legend>1. EMENTA</legend>
                     <?php echo get_field('ementa'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>2. CONTEÚDO PROGRAMÁTICO</legend>
                     <?php echo get_field('conteudo'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>3. MODALIDADE</legend>
                     <?php echo get_field('modalidade'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>4. METODOLOGIA/ESTRATÉGIAS DE APRENDIZAGEM</legend>
                     <?php echo get_field('metodologia'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>5. AVALIAÇÃO DE APRENDIZAGEM</legend>
                     <?php echo get_field('avaliacao'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>6. CRITÉRIOS PARA APROVAÇÃO</legend>
                     <?php echo get_field('criterios'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>7. CARGA HORÁRIA DA CAPACITAÇÃO</legend>                     
                     <?php $carga = get_field('carga'); ?>
                     <table class="carga">
                     <tr><td>Videoaula gravada</td><td><?php echo $carga['carga1']; ?></td></tr>
                     <tr><td>Videos diversos</td><td><?php echo $carga['carga2']; ?></td></tr>
                     <tr><td>Textos, artigos, capítulos de livros e similares</td><td><?php echo $carga['carga3']; ?></td></tr>
                     <tr><td>Aulas síncronas ou presenciais</td><td><?php echo $carga['carga4']; ?></td></tr>
                     <tr><td>Elaboração de projetos, mapeamentos de processos, TCCs e demais atividades práticas</td><td><?php echo $carga['carga5']; ?></td></tr>
                     <tr><td><strong>TOTAL DA CARGA HORÁRIA DA CAPACITAÇÃO</strong></td><td><strong><?php echo $carga['cargatotal']; ?></strong></td></tr>                                                          
                     </table>
                  </fieldset>

                  <fieldset>
                     <legend>8. EQUIPE DA CAPACITAÇÃO</legend>
                     <?php $equipe = get_field('equipe[]'); 
                     print_r($equipe);
                     
                     
                     
                     ?>
                     
                     <ul class="equipe">
                     <li><strong>Nome Completo: </strong><?php echo $equipe['nome']; ?></li>
                     <li><strong>Superior imediato: </strong><?php echo $equipe['superior']; ?></li>
                     <li><strong>Unidade/Depto: </strong><?php echo $equipe['unidade']; ?></li>
                     <li><strong>E-mail: </strong><?php echo $equipe['email']; ?></li>
                     <li><strong>Atuação: </strong><?php echo $equipe['atuacao']; ?></li>
                     <li><strong>Carga horária: </strong><?php echo $equipe['cargaeq']; ?></li>
                     </ul>

                  </fieldset>
                  
                  <fieldset>
                     <legend>9. BIBLIOGRAFIA</legend>
                     <?php echo get_field('bibliografia'); ?>
                  </fieldset>

                  <br><br><br>
                  <h2>III. CARACTERIZAÇÃO DO OFERECIMENTO</h2>

                  <fieldset>
                     <legend>1. QUANTIDADE DE TURMAS E CAPACIDADE DE CADA UMA</legend>
                     <?php echo get_field('quantidade'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>2. CALENDÁRIO DE OFERECIMENTO DAS TURMAS</legend>
                     <?php echo get_field('calendario'); ?>
                  </fieldset>

                  <fieldset>
                     <legend>3. LOCAL</legend>
                     <?php echo get_field('local'); ?>
                  </fieldset>

                  <br><br><br>
                  <h2>IV. INFORMAÇÕES GERENCIAIS </h2>

                  <fieldset>
                     <legend>1. CONSOLIDAÇÃO PARA PAGAMENTO  </legend>
                     <?php echo get_field('pagamento'); ?>
                  </fieldset>

                  <h1>&nbsp;</h1>
                  <a class="get-started-btn" href="/wp-admin/post.php?post=<?php echo the_ID(); ?>&action=edit">Editar</a>
                  <h1>&nbsp;</h1>
                  <hr>
               </div>
            <?php } else {
               echo "<h4>Essa proposta não é sua !</h4>";
            } ?>
         </div>
      </section><!-- End Portfolio Details Section -->

   </main><!-- End #main -->

<?php
} else { ?>
   <script>
      window.location.href = "/wp-admin"
   </script>
<?php }

get_footer(); ?>