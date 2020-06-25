
  <section class="section1">
      <div class="container clearfix">
      <div class="content col-lg-12 col-md-12 col-sm-12 clearfix">
          
          <div class="col-md-12">
              <h4 class="title">
                    	<span>Form Data Diri</span>
                </h4>
                    <div class="row">
                       
                        <?= ($this->session->flashdata('info') != null) ? '<div class="alert alert-success text-center">' . $this->session->flashdata('info') . '</div>' : ''; ?>
                        <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>

                         <?= $this->formbuilder->open_form(array('action' => $page_post, 'class' => 'form-horizontal', 'method' => 'post')); ?>
                        <?php //print_r($datavalue); ?>
                        <?= $this->formbuilder->build_form_horizontal($formdata, $datavalue); ?>
                        <?= $this->formbuilder->close_form(); ?>
           
                  </div>
          </div>
      </div>
      </div>
    
    <!-- end container -->
  </section>
  <!-- end section1 -->
