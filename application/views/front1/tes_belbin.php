

<section class="post-wrapper-top">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>Belbin Tes</li>
            </ul>
            <h2>Petunjuk Pengisian: <br>
                "Untuk setiap kelompok pernyataan, berkaitan pada pernyataan-pernyataan yang menurut anda
                paling menggambarkan perilaku anda. Nilai-nilai tersebut didistribusikan sedemikian rupa sehingga
                jumlah nilai untuk setiap kelompok pernyataan = 10. Dalam kasus-kasus yang ekstrim, nilai itu dapat
                disebarkan pada semua kalimat saja. Tuliskan nilai jawaban anda pada isian di samping jawaban"</h2>
        </div>
    </div>
</section>
<!-- end post-wrapper-top -->
<noscript>
    <style type="text/css">
        .section1 {display:none;}
    </style>
    <div style="text-align: center">
        <h1>Anda harus mengaktifkan javascript untuk memulai tes</h1>
    </div>
</noscript>
<section class="section1">
    <div class="container clearfix">

        <div class="col-md-12">
        <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>

            <h4 class="title">
                <span>SOAL :</span>
            </h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="accordion" id="accordion2">
                        
                        <form id="belbinform" action="" method="post">
                        <?php 
                        foreach ($a_soal as $key => $jawaban) { ?>
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?= $key?>">
                                    <em class="glyphicon glyphicon-chevron-right icon-fixed-width"></em> <?= $jawaban['kelompok'].': '?>
                                    <h4><?= $jawaban['keterangan']?></h4>
                                </a>
                            </div>
                            <div id="collapse<?= $key?>" class="accordion-body collapse in">
                                <div class="accordion-inner">

                                        <table class="table table-striped checkout effect-fade in" data-effect="fade" style="transition: all 0.7s ease-in-out 0s;">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>Jawaban</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($jawaban['jawaban'] as $idjawaban => $deskripsi) {
                                                ?>
                                                    <tr>
                                                        <td><?= $idjawaban?></td>
                                                        <td><?= $deskripsi?></td>
                                                        <td><input id="kelompok<?= $idjawaban?>" name="kelompok<?= $idjawaban?>" class="form-control quantity" onkeyup="hitungtotal<?= str_replace(' ','',$jawaban['kelompok'])?>()" onClick="this.select();" type="text" value="0"></td>
                                                    </tr>
                                                <?php
                                                 }?>
                                            </tbody>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="well text-right"><strong>TOTAL <?= $jawaban['kelompok']?> : </strong> <strong id="<?= str_replace(' ','',$jawaban['kelompok'])?>">0</strong></div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php }?>
                        </form>
                        <input type="button" name="submit" onclick="submitform()" value="Simpan dan Lanjut tes berikutnya" class="btn btn-default pull-right btn btn-primary" style="margin-right: 20px;">
                        
                    </div>
                    <!-- end accordion -->
                </div>
            </div>
        </div>


    </div>

    <!-- end container -->
</section>
<!-- end section1 -->

<script type="text/javascript">
    function hitungtotalKelompokI(){
        var jmlkel1=parseInt($('#kelompok10').val())+parseInt($('#kelompok11').val())+parseInt($('#kelompok12').val())+parseInt($('#kelompok13').val())+parseInt($('#kelompok14').val())+parseInt($('#kelompok15').val())+parseInt($('#kelompok16').val())+parseInt($('#kelompok17').val())+parseInt($('#kelompok18').val())+parseInt($('#kelompok19').val());
        $('#KelompokI').html(jmlkel1);
    }
    function hitungtotalKelompokII(){
        var jmlkel2=parseInt($('#kelompok20').val())+parseInt($('#kelompok21').val())+parseInt($('#kelompok22').val())+parseInt($('#kelompok23').val())+parseInt($('#kelompok24').val())+parseInt($('#kelompok25').val())+parseInt($('#kelompok26').val())+parseInt($('#kelompok27').val())+parseInt($('#kelompok28').val())+parseInt($('#kelompok29').val());
        $('#KelompokII').html(jmlkel2);
    }
    function hitungtotalKelompokIII(){
        var jmlkel3=parseInt($('#kelompok30').val())+parseInt($('#kelompok31').val())+parseInt($('#kelompok32').val())+parseInt($('#kelompok33').val())+parseInt($('#kelompok34').val())+parseInt($('#kelompok35').val())+parseInt($('#kelompok36').val())+parseInt($('#kelompok37').val())+parseInt($('#kelompok38').val())+parseInt($('#kelompok39').val());
        $('#KelompokIII').html(jmlkel3);
    }
    function hitungtotalKelompokIV(){
        var jmlkel4=parseInt($('#kelompok40').val())+parseInt($('#kelompok41').val())+parseInt($('#kelompok42').val())+parseInt($('#kelompok43').val())+parseInt($('#kelompok44').val())+parseInt($('#kelompok45').val())+parseInt($('#kelompok46').val())+parseInt($('#kelompok47').val())+parseInt($('#kelompok48').val())+parseInt($('#kelompok49').val());
        $('#KelompokIV').html(jmlkel4);
    }
    function hitungtotalKelompokV(){
        var jmlkel5=parseInt($('#kelompok50').val())+parseInt($('#kelompok51').val())+parseInt($('#kelompok52').val())+parseInt($('#kelompok53').val())+parseInt($('#kelompok54').val())+parseInt($('#kelompok55').val())+parseInt($('#kelompok56').val())+parseInt($('#kelompok57').val())+parseInt($('#kelompok58').val())+parseInt($('#kelompok59').val());
        $('#KelompokV').html(jmlkel5);
    }
    function hitungtotalKelompokVI(){
        var jmlkel6=parseInt($('#kelompok60').val())+parseInt($('#kelompok61').val())+parseInt($('#kelompok62').val())+parseInt($('#kelompok63').val())+parseInt($('#kelompok64').val())+parseInt($('#kelompok65').val())+parseInt($('#kelompok66').val())+parseInt($('#kelompok67').val())+parseInt($('#kelompok68').val())+parseInt($('#kelompok69').val());
        $('#KelompokVI').html(jmlkel6);
    }
    function hitungtotalKelompokVII(){
        var jmlkel7=parseInt($('#kelompok70').val())+parseInt($('#kelompok71').val())+parseInt($('#kelompok72').val())+parseInt($('#kelompok73').val())+parseInt($('#kelompok74').val())+parseInt($('#kelompok75').val())+parseInt($('#kelompok76').val())+parseInt($('#kelompok77').val())+parseInt($('#kelompok78').val())+parseInt($('#kelompok79').val());
        $('#KelompokVII').html(jmlkel7);
    }
    
    function submitform(){
        
        var validform=true;
        
        if(parseInt($('#KelompokI').html())!=10){
            alert('Jumlah Kelompok I harus sama dengan 10');
            validform=false;
        }
        if(parseInt($('#KelompokII').html())!=10){
            alert('Jumlah Kelompok II harus sama dengan 10');
            validform=false;
        }
        if(parseInt($('#KelompokIII').html())!=10){
            alert('Jumlah Kelompok III harus sama dengan 10');
            validform=false;
        }
        if(parseInt($('#KelompokIV').html())!=10){
            alert('Jumlah Kelompok IV harus sama dengan 10');
            validform=false;
        }
        if(parseInt($('#KelompokV').html())!=10){
            alert('Jumlah Kelompok V harus sama dengan 10');
            validform=false;
        }
        if(parseInt($('#KelompokVI').html())!=10){
            alert('Jumlah Kelompok VI harus sama dengan 10');
            validform=false;
        }
        if(parseInt($('#KelompokVII').html())!=10){
            alert('Jumlah Kelompok VII harus sama dengan 10');
            validform=false;
        }
        
        if(validform){
            $('#belbinform').submit();
        }
    }
</script>