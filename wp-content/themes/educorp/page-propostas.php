<?php get_header(); ?>
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
         if (is_user_logged_in()) {

            $user = wp_get_current_user();
            if (in_array('administrator', (array) $user->roles) || in_array('responsavel', (array) $user->roles)) { ?>
               <script>
                  window.location.href = "/wp-admin/edit.php?post_type=proposta"
               </script>
               <?php } else {

               $permitido = false;

               $lastupdated_args = array(
                  'post_type' => 'proposta',
                  'posts_per_page' => 10,
                  'order' => 'DESC'
               );
               $lastupdated_loop = new WP_Query($lastupdated_args);

               while ($lastupdated_loop->have_posts()) : $lastupdated_loop->the_post();
               $conteudista = explode(",",get_post_meta(get_the_ID(),'conteudista',true));  
                  foreach ($conteudista as $cont) {
                     if (get_current_user_id() == $cont) {
                        $permitido = true; ?>                          
                        <div class="portfolio-description">                        
                           <fieldset>
                              <legend>TÍTULO DA CAPACITAÇÃO
                              <span class="data"><strong>Data</strong>: <?php echo get_the_date('d/m/Y'); ?></span>
                              </legend>                            
                              &emsp;<a href="<?php echo the_permalink(); ?>"><strong><?php echo the_title(); ?></strong></a>
                           </fieldset>
                        </div>
            <?php
                     }
                  }

               endwhile;
               wp_reset_postdata();

               if (!$permitido) {
                  echo "Nenhuma proposta disponível !";
               }
            }
         } else { ?>
            <script>
               window.location.href = "/wp-admin"
            </script>
         <?php  }  ?>
      </div>
   </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<?php get_footer(); ?>