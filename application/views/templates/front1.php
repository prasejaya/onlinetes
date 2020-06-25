<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Assessment Online</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?= base_url()?>assets/images/logoypi.png" rel="icon">
  <link href="<?= base_url()?>assets/front1/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Ruda:400,900,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?= base_url()?>assets/front1/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?= base_url()?>assets/front1/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/front1/lib/prettyphoto/css/prettyphoto.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/front1/lib/hover/hoverex-all.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/front1/lib/jetmenu/jetmenu.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/front1/lib/owl-carousel/owl-carousel.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?= base_url()?>assets/front1/css/style.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/front1/css/custom.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url()?>assets/front1/css/colors/brown.css">
  <script src="<?= base_url()?>assets/front1/lib/jquery/jquery.min.js"></script>
  <style>
      .bg-patern{
          background-color: #ffffff;
background-image: url("data:image/svg+xml,%3Csvg width='48' height='64' viewBox='0 0 48 64' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M48 28v-4L36 12 24 24 12 12 0 24v4l4 4-4 4v4l12 12 12-12 12 12 12-12v-4l-4-4 4-4zM8 32l-6-6 10-10 10 10-6 6 6 6-10 10L2 38l6-6zm12 0l4-4 4 4-4 4-4-4zm12 0l-6-6 10-10 10 10-6 6 6 6-10 10-10-10 6-6zM0 16L10 6 4 0h4l4 4 4-4h4l-6 6 10 10L34 6l-6-6h4l4 4 4-4h4l-6 6 10 10v4L36 8 24 20 12 8 0 20v-4zm0 32l10 10-6 6h4l4-4 4 4h4l-6-6 10-10 10 10-6 6h4l4-4 4 4h4l-6-6 10-10v-4L36 56 24 44 12 56 0 44v4z' fill='%233498db' fill-opacity='0.16' fill-rule='evenodd'/%3E%3C/svg%3E");
      }
      
      .bg-patern2{
          background-color: #DFDBE5;
background-image: url("data:image/svg+xml,%3Csvg width='84' height='84' viewBox='0 0 84 84' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233498db' fill-opacity='0.2'%3E%3Cpath d='M84 23c-4.417 0-8-3.584-8-7.998V8h-7.002C64.58 8 61 4.42 61 0H23c0 4.417-3.584 8-7.998 8H8v7.002C8 19.42 4.42 23 0 23v38c4.417 0 8 3.584 8 7.998V76h7.002C19.42 76 23 79.58 23 84h38c0-4.417 3.584-8 7.998-8H76v-7.002C76 64.58 79.58 61 84 61V23zM59.05 83H43V66.95c5.054-.5 9-4.764 9-9.948V52h5.002c5.18 0 9.446-3.947 9.95-9H83v16.05c-5.054.5-9 4.764-9 9.948V74h-5.002c-5.18 0-9.446 3.947-9.95 9zm-34.1 0H41V66.95c-5.053-.502-9-4.768-9-9.948V52h-5.002c-5.184 0-9.447-3.946-9.95-9H1v16.05c5.053.502 9 4.768 9 9.948V74h5.002c5.184 0 9.447 3.946 9.95 9zm0-82H41v16.05c-5.054.5-9 4.764-9 9.948V32h-5.002c-5.18 0-9.446 3.947-9.95 9H1V24.95c5.054-.5 9-4.764 9-9.948V10h5.002c5.18 0 9.446-3.947 9.95-9zm34.1 0H43v16.05c5.053.502 9 4.768 9 9.948V32h5.002c5.184 0 9.447 3.946 9.95 9H83V24.95c-5.053-.502-9-4.768-9-9.948V10h-5.002c-5.184 0-9.447-3.946-9.95-9zM50 50v7.002C50 61.42 46.42 65 42 65c-4.417 0-8-3.584-8-7.998V50h-7.002C22.58 50 19 46.42 19 42c0-4.417 3.584-8 7.998-8H34v-7.002C34 22.58 37.58 19 42 19c4.417 0 8 3.584 8 7.998V34h7.002C61.42 34 65 37.58 65 42c0 4.417-3.584 8-7.998 8H50z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      }
    </style>
  <!-- =======================================================
    Template Name: MaxiBiz
    Template URL: https://templatemag.com/maxibiz-bootstrap-business-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
    <?php $this->load->view('front1/include/header');?>
    <?= $body?>
    <?php $this->load->view('front1/include/footer');?>


  <div class="dmtop">Scroll to Top</div>

  <!-- JavaScript Libraries -->
  <script src="<?= base_url()?>assets/front1/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/php-mail-form/validate.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/prettyphoto/js/prettyphoto.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/isotope/isotope.min.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/hover/hoverdir.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/hover/hoverex.min.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/unveil-effects/unveil-effects.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/owl-carousel/owl-carousel.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/jetmenu/jetmenu.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/animate-enhanced/animate-enhanced.min.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/jigowatt/jigowatt.js"></script>
  <script src="<?= base_url()?>assets/front1/lib/easypiechart/easypiechart.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?= base_url()?>assets/front1/js/main.js"></script>

</body>
</html>
