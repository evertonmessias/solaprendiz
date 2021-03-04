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

<main id="main">

	<!-- ======= Counts Section ======= -->

	<section id="counts" class="counts">
		<br><br><br>
		<div class="container" data-aos="fade-up">

			<div class="row no-gutters">

				<div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
				</div>

				<div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
					<div class="count-box">
						<i class="icofont-document-folder"></i>
						<span data-toggle="counter-up"><?php propostas(); ?></span>
						<p><strong>Propostas</strong></p>
					</div>
				</div>
				&emsp;&emsp;&emsp;
				<div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
					<div class="count-box">
						<i class="icofont-users-alt-5"></i>
						<span data-toggle="counter-up"><?php contador(); ?></span>
						<p><strong>Visitas</strong></p>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
				</div>

			</div>

		</div>
	</section><!-- End Counts Section -->

	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact section-bg">
		<div class="container" data-aos="fade-up">

			<div class="section-title">
				<h2>Contato</h2>
				<p>Fale Conosco</p>
			</div>

			<div class="row">

				<div class="col-lg-6">

					<div class="row">
						<div class="col-md-12">
							<div class="info-box">
								<a target="_blank" href="https://www.google.com/maps/place/Educorp+-+UNICAMP/@-22.815201,-47.0629103,15z/data=!4m5!3m4!1s0x0:0xb4878316d2918a4d!8m2!3d-22.815201!4d-47.0629103"><i class="bx bx-map"></i></a>
								<h3>Educorp</h3>
								<p>Saturnino de Brito, nº 323 - Cidade Universitária, Campinas</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="info-box mt-4">
								<a target="_blank" href="mailto:educorp@unicamp.br"><i class="bx bx-envelope"></i></a>
								<h3>E-Mail</h3>
								<p><a target="_blank" href="mailto:educorp@unicamp.br">educorp@unicamp.br</a><br>&nbsp;</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="info-box mt-4">
								<i class="bx bx-phone-call"></i>
								<h3>Telefones</h3>
								<p>(19) 3521-4507 , (19) 3521-4533<br>(19) 3521-4602 , (19) 3521-4613</p>
							</div>
						</div>
					</div>

				</div>

				<div class="col-lg-6">
					<form method="post" role="form" class="php-email-form">
						<div class="form-row">
							<div class="col form-group">
								<input type="text" class="form-control" id="name" placeholder="Seu Nome"/>	
							</div>
							<div class="col form-group">
								<input type="text" class="form-control" id="email" placeholder="Seu E-mail"/>	
							</div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="subject" placeholder="Assunto"/>
						</div>
						<div class="form-group">
							<textarea class="form-control" id="message" rows="5" placeholder="Mensagem"></textarea>
						</div>						
						<div class="sent">&nbsp;</div>
						<input type="hidden" id="destino" value="<?php echo get_option('admin_email'); ?>"/>				
						<div class="text-center"><button type="button" id="enviar">Enviar</button></div>
					</form>
				</div>

			</div>

		</div>
	</section><!-- End Contact Section -->

</main><!-- End #main -->
<?php get_footer(); ?>