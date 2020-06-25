
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
<div class="container-fluid">
    <div class="row cm-fix-height" style="padding-top:51px">
    </div>

    <?php if(isset($kelas_aktif)&&!$kelas_aktif){?>
        <div class="alert alert-warning text-center">Tahun Ajaran sudah di tutup</div>
    <?php }?>
    <?php if(!empty($formdata)){?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah 
                    <?= $page_name ?></div>
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
                <div class="panel-heading"><?= $page_name ?></div>
                <div class="panel-body">
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
                                    elseif($keykolom=='#aksifull'){
                                        echo '<td><a href="'.base_url('kelas/ubahtugaskelas/'.$idkelas.'/'.$this->urlencrypt->encode($value[$list_id])).'" title="edit"><button type="button" class="btn btn-warning btn-xs" ><i class="fa fa-pencil"></i></button></a>&nbsp;';
                                        echo '<a onclick="hapusdata(' . "'" . $this->urlencrypt->encode($value[$list_id])  . "'" . ')" title="hapus"><button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button></a>&nbsp;'
                                                . '<a href="'.base_url('kelas/detailtugaskelas/'.$idkelas.'/'.$this->urlencrypt->encode($value[$list_id])).'" title="detail"><button type="button" class="btn btn-primary btn-xs" ><i class="fa fa-list-alt"></i></button></a></td>';
                                    }
                                    elseif($keykolom=='#aksidetail'){
                                        echo '<td><a href="'.base_url('kelas/detailtugaskelas/'.$idkelas.'/'.$this->urlencrypt->encode($value[$list_id])).'" title="detail"><button type="button" class="btn btn-primary btn-xs" ><i class="fa fa-list-alt"></i></button></a></td>';
                                    }
                                    elseif($keykolom=='#aksi'){
                                        echo '<td><a onclick="hapusdata(' . "'" . $this->urlencrypt->encode($value[$list_id])  . "'" . ')" title="hapus"><button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button></a></td>';
                                    }elseif($keykolom=='file')
                                        echo "<td><a href='".base_url('uploads/soaltugas/').$value[$keykolom]."' target='_blank'>{$value[$keykolom]}</a></td>";
                                    else
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