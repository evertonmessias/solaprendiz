<?php get_header(); ?>
<!-- ======= Hero Section ======= -->
<section id="hero">
	<div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<!-- Slide 1 -->
			<div class="carousel-item active" style="background-image: url(<?php echo SITEPATH; ?>assets/img/slide/slide-1.jpg)">
				<div class="carousel-container">
					<div class="container">
						<p class="animate__animated animate__fadeInUp"><strong>Bem vindo ao</strong></p>
						<h2 class="animate__animated animate__fadeInDown"><h2><?php echo get_bloginfo('name'); ?></h2></h2>
						<p class="animate__animated animate__fadeInUp texto-slide">Aqui você poderá enviar sua proposta de DESENVOLVIMENTO DE
							SOLUÇÃO DE APRENDIZAGEM preenchendo o Roteiro para elaboração de solução de capacitação
							conjuntamente entre CONTEUDISTA E EQUIPE, até a validação da versão final.</p>
						<a href="proposta" class="btn-get-started animate__animated animate__fadeInUp scrollto">Proposta</a>
					</div>
				</div>
			</div>
		</div>		
	</div>
</section><!-- End Hero -->
<?php get_footer(); ?>