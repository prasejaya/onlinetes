
        <header id="cm-header">
            <nav class="cm-navbar cm-navbar-primary">
                <div class="btn btn-primary md-menu-white hidden-md hidden-lg" data-toggle="cm-menu"></div>
                <div class="cm-flex">
                    <div class="cm-breadcrumb-container">
                        <ol class="breadcrumb">
                            <?php foreach ($page_breadcrumb as $key=>$value){ 
                                if(isset($value['active'])){ 
                                    $active='class="active"';
                                    $link=$key;
                                }else{
                                    $active='';
                                    $link='<a href="'.$value['url'].'">'.$key.'</a>';
                                }
                                echo '<li '.$active.'>'.$link.'</li>';
                            }
                            ?>
                        </ol>
                    </div> 
                </div>
                
                <div class="dropdown pull-right">
                    
                    <button class="btn btn-primary md-account-circle-white" data-toggle="dropdown"></button>
                    <ul class="dropdown-menu">
                        <li class="disabled text-center">
                            <a style="cursor:default;"><strong><?= $this->session->userdata('namauser')?></strong></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= base_url('auth/gantipassword')?>"><i class="fa fa-fw fa-cog"></i> Ubah Password</a>
                        </li>
                        <li>
                            <a href="<?= base_url('auth/logout')?>"><i class="fa fa-fw fa-sign-out"></i> Sign out</a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <?php if(isset($page_tab)){?>
            <nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
                <div class="cm-flex">
                    <div class="nav-tabs-container">
                        <ul class="nav nav-tabs">
                            <?php 
                                foreach ($page_tab as $key=>$value){ 
                                $link='<a href="'.$value['url'].'">'.$key.'</a>';
                                if(isset($value['active'])){ 
                                    $active='class="active"';
                                }else{
                                    $active='';
                                }
                                echo '<li '.$active.'>'.$link.'</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php }?>
        </header>