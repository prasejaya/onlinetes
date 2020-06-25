<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="icon" type="image/png" href="<?= base_url('uploads/images/logo.png')?>" />
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/bootstrap-clearmin.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/roboto.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/material-design.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/small-n-flat.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/custom.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugins/EasyAutocomplete/easy-autocomplete.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugins/EasyAutocomplete/easy-autocomplete.themes.min.css">
        <script src="<?= base_url()?>assets/theme1/js/lib/jquery-2.1.3.min.js"></script>
        <script src="<?= base_url()?>assets/plugins/EasyAutocomplete/jquery.easy-autocomplete.js"></script>
        <title>People Development Consulting</title>
    </head>
    <body class="cm-no-transition cm-1-navbar">
            <?php $this->load->view('theme1/include/menu');?>
            <?php $this->load->view('theme1/include/header');?>
        <div id="global">
            <?= $body?>
            <?php $this->load->view('theme1/include/footer');?>
        </div>
        <script src="<?= base_url()?>assets/theme1/js/jquery.mousewheel.min.js"></script>
        <script src="<?= base_url()?>assets/theme1/js/jquery.cookie.min.js"></script>
        <script src="<?= base_url()?>assets/theme1/js/fastclick.min.js"></script>
        <script src="<?= base_url()?>assets/theme1/js/bootstrap.min.js"></script>
        <script src="<?= base_url()?>assets/theme1/js/clearmin.min.js"></script>
    </body>
</html>