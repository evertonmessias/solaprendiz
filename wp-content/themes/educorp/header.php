<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Solução de Aprendizagem - Educorp</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo SITEPATH; ?>assets/img/favicon.png" rel="icon">
  <link href="<?php echo SITEPATH; ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo SITEPATH; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo SITEPATH; ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo SITEPATH; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo SITEPATH; ?>assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo SITEPATH; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo SITEPATH; ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo SITEPATH; ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo SITEPATH; ?>assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo SITEPATH; ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo SITEPATH; ?>assets/css/educorp.css" rel="stylesheet">
 
</head>
<body>
	<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
	<div class="container d-flex align-items-center">

		<a href="/" class="logo mr-auto educorp-logo"><img src="<?php echo SITEPATH; ?>assets/img/educorp-logo.png" alt="" class="img-fluid"></a>

    <?php if(is_user_logged_in()){?>
      <a href="/propostas" class="get-started-btn">Propostas</a>
      <a href="/wp-login.php?action=logout" class="get-started-btn">Sair</a>
    <?php  }else{ ?>
      <a href="/propostas" class="get-started-btn">Login</a>
		<?php } ?>

	</div>
</header><!-- End Header -->