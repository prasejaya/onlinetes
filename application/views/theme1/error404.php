<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/bootstrap-clearmin.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/roboto.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/font-awesome.min.css">
        <link rel="icon" type="image/png" href="<?= base_url('uploads/images/').$logo?>" />
        <title><?= $namasingkat?></title>
    <style></style>
  </head>
  <body class="cm-login">

    <div class="text-center" style="padding:90px 0 30px 0;background:#fff;border-bottom:1px solid #ddd">
      <?= create_image('uploads/images', $logo, null, 150)?>
    </div>
    
    <div class="col-sm-6 col-md-4 col-lg-3" style="margin:40px auto; float:none;">
        :( Kami tidak dapat menemukan halaman yang anda maksud, <a href="<?= base_url()?>">Kembali</a>
    </div>
  </body>
</html>
