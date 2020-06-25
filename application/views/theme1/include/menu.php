<?php $active_menu=$this->uri->segment(1);?>
        <div id="cm-menu">
            <nav class="cm-navbar cm-navbar-primary">
                <div class="cm-flex">
                    <a href="<?= base_url()?>" style="color: #FFF;">
                    <?= create_image('uploads/images', $this->session->userdata('seting')['logo'], null, 50)?>
                     <?= $this->session->userdata('seting')['namasingkat']?>
                    </a></div>
                <div class="btn btn-primary md-menu-white" data-toggle="cm-menu"></div>
            </nav>
            <div id="cm-menu-content">
                <div id="cm-menu-items-wrapper">
                    <div id="cm-menu-scroller">
                        <ul class="cm-menu-items">
                            <?php 
                                $ci =& get_instance();
                                $ci->load->library('menubuilder');
                                $ci->menubuilder->generate_menu($this->session->userdata('tipeuser')); //tinggal ambil dari database
                                echo $ci->menubuilder->strmenu;
                               // $this->menubuilder->generate_menuarr('A');
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>