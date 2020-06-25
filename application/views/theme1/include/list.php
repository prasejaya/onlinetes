
<!-- List  -->
<!-- ============================================================== -->
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
<div id="customModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Anda yakin melakukan perubahan?</p>
                <form id="formcustom" method="post" >
                    <input id="idtablecustom" type="hidden" name="idtable">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="$('#formcustom').submit()">lanjutkan</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">batal</button>
            </div>
        </div>

    </div>
</div>
<div id="validModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Anda yakin merubah data?</p>
                <form id="formvalid" method="post" >
                    <input id="idtablevalid" type="hidden" name="idtable">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="$('#formvalid').submit()">Ya</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
            </div>
        </div>

    </div>
</div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        
<?php if(isset($page_tab)){?>
<div class="row cm-fix-height" style="padding-top:51px">
</div>
<?php }?>
        
        <div class="panel panel-default">
            <div class="panel-heading"><?= $page_name ?></div>
        <!-- Row -->
            <div class="panel-body">
                <?php if(isset($formfilter)){?>
                <div class="row">
                <div class="col-md-3 text-center"></div>
                <div class="col-md-6 text-center">
                    <?= $this->formbuilder->open_form(array('id'=>'form_filter','action' => '', 'class' => 'form-horizontal', 'method' => 'get')); ?>
                   <?= $this->formbuilder->build_form_horizontal($formfilter, $datavaluefilter); ?>
                    <?= $this->formbuilder->close_form(); ?>
                </div>
                <div class="col-md-3 text-center"></div>
                </div>
                <hr>
                <?php }?>
            <!-- Column -->
            <div class="col-md-12">
                <?= ($this->session->flashdata('info') != null) ? '<div class="alert alert-success text-center">' . $this->session->flashdata('info') . '</div>' : ''; ?>
                <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>

                <div class="card">
                    <?php if(isset($page_insert)&&$page_insert!=''&&$akses_insert){?>
                    <a href="<?= $page_insert ?>">
                        <button type="button" class="btn btn-success btn-md pull-right"><i class="fa fa-plus"></i> <?= (isset($nama_tomboltambah)? $nama_tomboltambah:'Tambah')?></button>
                    </a>
                    <br><br>
                    <?php }?>

                    <div class="card-block">
                        <table id="datatable" class="display table table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <?php
                                    foreach ($kolom as $row) {
                                        $cek = explode(",", $row);
                                        if ($row == '') {
                                            echo "<th style='display:none;'>$row</th>";
                                        } elseif (!empty($cek[1]) && $cek[1] == 'cek') {
                                            echo "<th>$cek[0]</th>";
                                        } else {
                                            echo "<th>$row</th>";
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <?php
                                    foreach ($kolom as $row) {
                                        $cek = explode(",", $row);
                                        if ($row == '') {
                                            echo "<th style='display:none;'>$row</th>";
                                        } elseif (!empty($cek[1]) && $cek[1] == 'cek') {
                                            echo "<th>$cek[0]</th>";
                                        } else {
                                            echo "<th>$row</th>";
                                        }
                                    }
                                    ?>
                                </tr>
                            </tfoot>

                            <tbody>
                                <tr>
                                    <td colspan="<?php echo (count($kolom) + 1); ?>" class="dataTables_empty text-center">Loading data from server</td>
                                </tr>  
                            </tbody>
                        </table>
                        <?= isset($page_description)? $page_description:''?>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
            </div>
</div>
<link href="<?= base_url() ?>assets/plugins/DataTables/datatables.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/plugins/DataTables/datatables.responsive.css" rel="stylesheet">
<script src="<?= base_url() ?>assets/plugins/DataTables/datatables.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/datatables.responsive.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/datatables.buttons.js" type="text/javascript"></script>
<!--export--->
<script src="<?= base_url() ?>assets/plugins/DataTables/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/jszip.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/pdfmake.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/vfs_fonts.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/buttons.print.min.js" type="text/javascript"></script>
<script type="text/javascript">
<?= $customjs ?>
</script>