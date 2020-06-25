
  <section class="section1">
      <div class="container clearfix">
      <div class="content col-lg-12 col-md-12 col-sm-12 clearfix">
          <div class="col-lg-3 col-md-3 col-sm-12">
              <h4 class="title">
                    <span>Info Pendaftaran</span>
                </h4>
              <?php if(!empty($periodedaftar)){?>
                <p><b><?= $periodedaftar['nmperiodedaftar']?><b><br>
                </p>
                <img src="<?= base_url()?>uploads/gambarperiode/<?= $periodedaftar['gambar']?>" class="img-responsive">
                <p><?= $periodedaftar['pengumuman']?></p>
                 <ul>
                <li>Kuota : <?= $periodedaftar['kuota']?></li>
                <li>Tgl. Pendaftaran : <?= tgl_indo($periodedaftar['tglbuka'],false)?> s/d <?= tgl_indo($periodedaftar['tgltutup'],false)?></li>
                <li>Tgl. Verifikasi Berkas : <?= tgl_indo($periodedaftar['tglbukaverifikasi'],false)?> s/d <?= tgl_indo($periodedaftar['tgltutupverifikasi'],false)?></li>
                <li>Tgl. Pemetaan : <?= tgl_indo($periodedaftar['tglbukaseleksi'],false)?> s/d <?= tgl_indo($periodedaftar['tgltutupseleksi'],false)?></li>
                <li>Tgl. Pengumuman : <?= tgl_indo($periodedaftar['tglbukapengumuman'],false)?> s/d <?= tgl_indo($periodedaftar['tgltutuppengumuman'],false)?></li>
                <li><a href="<?= base_url()?>uploads/fileperiode/<?= $periodedaftar['filepengumuman']?>">File Pengumuman</a></li>
             </ul>
                    <?php }?>
          </div>
          
          <div class="col-lg-8 col-md-8 col-sm-12">
              <h4 class="title">
                    	<span>Form Pendaftaran</span>
                </h4>
                    <div class="row">
                        
            <?php 
            
            $tglbuka = new DateTime($periodedaftar['tglbuka']);
            $tgltutup = new DateTime($periodedaftar['tgltutup']);
            $now = new DateTime();
            
            //if($periodedaftar['is_buka']=='1')
            if($now<$tgltutup&&$now>=$tglbuka){?>
                        <?= ($this->session->flashdata('info') != null) ? '<div class="alert alert-success text-center">' . $this->session->flashdata('info') . '</div>' : ''; ?>
                        <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>

                         <?= $this->formbuilder->open_form(array('action' => $page_post, 'class' => 'form-horizontal', 'method' => 'post')); ?>
                        <?php //print_r($datavalue); ?>
                        <?= $this->formbuilder->build_form_horizontal($formdata, $datavalue); ?>
                        <?= $this->formbuilder->close_form(); ?>
            <?php }elseif($diterima['jumlahditerima']>=$periodedaftar['kuota']){?>
                <div class="alert alert-danger">Kuota penuh</div>
            <?php
            }else{?>
                        <div class="alert alert-danger">Gelombang tutup</div>
            <?php }?>
                  </div>
          </div>
      </div>
      </div>
    
    <!-- end container -->
  </section>
  <!-- end section1 -->
