<section id="intro">
    <div class="container">
      <div class="ror">
        <div class="col-md-8 col-md-offset-2">
        <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>

          <h1>Mulai Tes</h1>
          <p>Masukkan token pada form di bawah ini</p>
           <?= $this->formbuilder->open_form(array('action' => $page_post, 'class' => 'form-horizontal', 'method' => 'post')); ?>
            <?php //print_r($datavalue); ?>
            <?= $this->formbuilder->build_form_horizontal($formdata, $datavalue); ?>
            <?= $this->formbuilder->close_form(); ?>
        </div>
      </div>
    </div>
  </section>