
<script src="<?= base_url() ?>assets/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <div class="container-fluid">
            <?php if(isset($page_tab)){?>
            <div class="row cm-fix-height" style="padding-top:51px">
            </div>
            <?php }?>
              
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= $page_name ?>
                </div>
                <a href="<?= base_url($this->uri->segment(1))?>">
                    <button type="button" class="btn btn-gray"><i class="fa fa-chevron-left"></i> Kembali</button>
                </a>
                <div class="panel-body">
                    <?= ($this->session->flashdata('info') != null) ? '<div class="alert alert-success text-center">' . $this->session->flashdata('info') . '</div>' : ''; ?>
                    <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>
                  
                     <?= $this->formbuilder->open_form(array('action' => $page_post, 'class' => 'form-horizontal', 'method' => 'post')); ?>
                    <?php //print_r($datavalue); ?>
                    <?= $this->formbuilder->build_form_horizontal($formdata, $datavalue); ?>
                    <?= $this->formbuilder->close_form(); ?>
                </div>
            </div>
        </div>