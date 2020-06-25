<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/SISCLOUD_LOGO.png')?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/bootstrap-clearmin.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/roboto.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/theme1/css/font-awesome.min.css">
    <title>SisCloud V.0.1</title>
    <style></style>
  </head>
  <body class="cm-login">

    <div class="text-center" style="padding:90px 0 30px 0;background:#fff;border-bottom:1px solid #ddd">
      <?= create_image('uploads/images', $logo, null, 150)?>
    </div>
    
    <div class="col-sm-6 col-md-4 col-lg-3" style="margin:40px auto; float:none;">
      <form method="post">
	<div class="col-xs-12">
            <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>
              
          <div class="form-group">
	    <div class="input-group">
	      <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
	      <input type="text" name="username" class="form-control" placeholder="Username">
	    </div>
              <?php if(form_error('username')) echo '<small class="text-danger"><p>'. form_error('username').'</p></small>'?>
                
          </div>
          <div class="form-group">
	    <div class="input-group">
	      <div class="input-group-addon"><i class="fa fa-fw fa-lock"></i></div>
	      <input type="password" name="password" class="form-control" placeholder="Password">
	    </div>
              <?php if(form_error('password')) echo '<small class="text-danger"><p>'. form_error('password').'</p></small>'?>
                
          </div>
        </div>
	<div class="col-xs-6">
          <div class="checkbox"><label><input type="checkbox" name="rememberme"> &nbsp;&nbsp;Remember me</label></div>
	</div><div class="col-xs-6">
          <button type="submit" class="btn btn-block btn-primary">Sign in</button>
        </div>
      </form>
    </div>
  </body>
</html>
