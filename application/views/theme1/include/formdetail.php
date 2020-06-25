
<script src="<?= base_url() ?>assets/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Anda yakin akan menghapus data?</p>
                <form id="formdelete" method="post" >
                    <input id="idtable" type="hidden" name="idtable">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="$('#formdelete').submit()">hapus</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">batal</button>
            </div>
        </div>

    </div>
</div>
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">Tambah</h4>
            </div>
            <div class="modal-body">
                <?php if($formdatadetail){?>
                <?= $this->formbuilder->open_form(array('action'=>'','class' => 'form-horizontal', 'method' => 'post','id'=>'forminsert')); ?>
                <?= $this->formbuilder->build_form_horizontal($formdatadetail, $datavaluedetail); ?>
                <?= $this->formbuilder->close_form(); ?>
                <?php }?>
            </div>
        </div>

    </div>
</div>

<div id="formUpdateModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">Ubah</h4>
            </div>
            <div class="modal-body">
                <?php if($formdatadetailupdate){?>
                <?= $this->formbuilder->open_form(array('action'=>'','class' => 'form-horizontal', 'method' => 'post','id'=>'formupdate')); ?>
                <?= $this->formbuilder->build_form_horizontal($formdatadetailupdate, $datavaluedetailupdate); ?>
                <?= $this->formbuilder->close_form(); ?>
                <?php }?>
            </div>
        </div>

    </div>
</div>
<div class="container-fluid">
    <?php if(!empty($formdata)){?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $page_name ?></div>
                <a href="<?= base_url($this->uri->segment(1))?>">
                    <button type="button" class="btn btn-gray"><i class="fa fa-chevron-left"></i> Kembali</button>
                </a>
                <div class="panel-body">
                    <?= ($this->session->flashdata('info') != null) ? '<div class="alert alert-success text-center">' . $this->session->flashdata('info') . '</div>' : ''; ?>
                    <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>
                    <?= $this->formbuilder->open_form(array('action' => $page_post, 'class' => 'form-horizontal', 'method' => 'post')); ?>
                    <?= $this->formbuilder->build_form_horizontal($formdata, $datavalue); ?>    
                    <?= $this->formbuilder->close_form(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $list_name ?></div>
                <div class="panel-body">
                    <?php if(!empty($formdatadetail)){?>
                    <button type="button" class="btn btn-success btn-md pull-right" onclick="insertdata()"><i class="mdi mdi-plus"></i>Tambah</button>
                    <?php }?>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <?php foreach ($list_kolom as $value) {
                                echo "<th>$value</th>";
                            }?>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                            $no=1;
                            foreach ($list_data as $key => $value) {
                                echo '<tr>';
                                foreach ($list_kolom as $keykolom => $valuekolom) {
                                    if($keykolom=='#no')
                                        echo "<td>$no</td>";
                                    elseif($keykolom=='#aksi'){
                                        echo '<td><a onclick="hapusdata(' . "'" . $this->urlencrypt->encode($value[$list_id])  . "'" . ')" title="hapus"><button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button></a>';
                                        echo '&nbsp;&nbsp;<a onclick="editdata(' . "'" . $this->urlencrypt->encode($value[$list_id])  . "'" . ')" title="edit"><button type="button" class="btn btn-warning btn-xs" ><i class="fa fa-pencil"></i></button></a></td>';
                                    }elseif($keykolom=='#aksidelete'){
                                        echo '<td><a onclick="hapusdata(' . "'" . $this->urlencrypt->encode($value[$list_id])  . "'" . ')" title="hapus"><button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button></a>';
                                    }elseif($keykolom=='foto'){
                                        echo '<td>'.create_image('/uploads/fotoanak/', $value[$keykolom]).'</td>';
                                    }elseif($keykolom=='foto1'||$keykolom=='foto2'||$keykolom=='foto3'){
                                        echo '<td>'.create_image('/uploads/fotosurvei/', $value[$keykolom]).'</td>';
                                    }elseif($keykolom=='maps'){
                                        echo '<td><a target="_blank" href="'. base_url().'maps/view/'.$value['longtitude'].'/'.$value['latitude'].'">View maps</td>';
                                    }else
                                        echo "<td>{$value[$keykolom]}</td>";
                                }$no++;
                                echo '</tr>';
                            }
                            ?>
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?= $customjs ?>
</script>