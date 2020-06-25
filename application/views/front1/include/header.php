
  <div class="topbar clearfix">
    <div class="container">
      <div class="col-lg-12 text-right">
        <div class="social_buttons">
            &nbsp;
        </div>
      </div>
    </div>
    <!-- end container -->
  </div>
  <!-- end topbar -->

  <header class="header bg-patern">
    <div class="container">
      <div class="site-header clearfix">
        <div class="col-md-6 title-area">
          <div class="site-title" id="title">
            <a href="<?= base_url()?>" title="">
                <img style="float:left" src="<?= base_url()?>uploads/images/logo.png" class="img-responsive" width="75">
                <h4>Assessment Online<br> <span>People Development Consulting</span></h4>
            </a><br>
          </div>
        </div>
          <?php if($this->session->userdata('namalengkap')){?>
        <div class="col-md-6">
          <div id="nav" class="right">
            <div class="container clearfix">
              <ul id="jetmenu" class="jetmenu blue">
                  <li <?= ($this->uri->segment(2)=='papi')?'class="active"':''?>><a href="<?= base_url('front/papi')?>">PAPI</a>
                </li>
                <li <?= ($this->uri->segment(2)=='disc')?'class="active"':''?>><a href="<?= base_url('front/disc')?>">DISC</a>
                </li>
                  <li <?= ($this->uri->segment(2)=='belbin')?'class="active"':''?>><a href="<?= base_url('front/belbin')?>">Belbin</a>
                </li>
                <li <?= ($this->uri->segment(2)=='leadership')?'class="active"':''?>><a href="<?= base_url('front/leadership')?>">Leadership</a>
                </li>
                <li <?= ($this->uri->segment(2)=='ketelitian')?'class="active"':''?>><a href="<?= base_url('front/ketelitian')?>">Ketelitian</a>
                </li>
                <?php if($this->uri->segment(2)=='ketelitian'||$this->uri->segment(2)=='ketelitiancontoh'){?>
                <li>
                    <div class="countdown"></div>
                </li>
                <?php }?>
              </ul>
            </div>
          </div>
          <!-- nav -->
        </div>
          <?php }?>
      </div>
      <!-- site header -->
    </div>
    <!-- end container -->
  </header>
  <!-- end header -->
  