

<section class="post-wrapper-top">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>Ketelitian Tes</li>
            </ul>
            <h4>Petunjuk Pengisian: <br>
                "Dalam soal ini terdapat 90 pasang pernyataan. Anda harus memilih salah satu dari setiap pasang pernyataan yang menurut Anda paling mencerminkan diri Anda atau paling menunjukkan perasaan Anda. Kadang-kadang Anda akan dapatkan sepasang pernyataan yang keduanya tidak menggambarkan diri Anda. Dalam hal seperti ini, Anda tetap harus memilih salah satu yang lebih mendekati. 
                <br><br>Cara menjawab adalah dengan memilih pilihan sesuai dengan keadaan diri Anda yang terdapat di lembar jawaban yang tersedia.
                Sebagai contoh, bila Anda merasa pernyataan "Saya lambat dalam membuat teman" lebih mencerminkan diri anda dari pernyataan "Saya lambat dalam mengambil keputusan" maka pilihlah tanda panah yang dibagian atasnya. 
                <br><br>Sebaliknya, bila pernyataan "Saya lambat dalam mengambil keputusan"  lebih mencerminkan diri Anda dibandingkan pernyataan "Saya lambat dalam membuat teman", maka silahkan Anda pilih tanda panah yang di sebelah bawah. 

                <br><br>Harap berhati-hati dalam memilih, guna memastikan bahwa Anda menjawab pada kolom yang sesuai. Setiap kali membalik halaman berikutnya, pastikan bahwa nomer-nomer pada pernyataannya. 
                Bekerja secepat mungkin, tetapi periksalah dengan cermat bahwa Anda sudah memilih satu pernyataan dari setiap pasang pernyataan-pernyataan dalam buku ini. 
                "</h4>
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

        <div class="col-md-12 text-center">
            <input type="button" onclick="showlembarsoal()" value="Mulai Tes" class="btn btn-default btn btn-primary" style="margin-right: 20px;">
        </div>
        <div class="col-md-12" style="display:none" id="lembarsoal">

            <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>

            <h4 class="title">
                <span>SOAL :</span>
            </h4>


            <div class="row">
                <form id="ketelitianform" action="" method="post">
                    <div class="col-md-6">
                        <table class="table table-striped checkout effect-fade in" data-effect="fade" style="transition: all 0.7s ease-in-out 0s;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Soal</th>
                                    <th>Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //conotoh soal
                                for ($i = 1; $i <= 50; $i++) {
                                    ?>
                                    <tr style="height: 100px;">
                                        <td><?= $i ?></td>
                                        <td>
                                            <img src="<?= base_url('assets/tesketelitian/soal/soal' . $i . '.png') ?>" width="170" style="margin-top: 10px;"/>
                                        </td>
                                        <td>
                                            <div class="radio">
                                                <label><input type="radio" name="soal<?= $i ?>" value="a"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'a.png') ?>" width="30"/></label>
                                                <label><input type="radio" name="soal<?= $i ?>" value="b"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'b.png') ?>" width="30"/></label>
                                                <label><input type="radio" name="soal<?= $i ?>" value="c"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'c.png') ?>" width="30"/></label>
                                                <label><input type="radio" name="soal<?= $i ?>" value="d"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'd.png') ?>" width="30"/></label>
                                                <label><input type="radio" name="soal<?= $i ?>" value="e"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'e.png') ?>" width="30"/></label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table table-striped checkout effect-fade in" data-effect="fade" style="transition: all 0.7s ease-in-out 0s;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Soal</th>
                                    <th>Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //conotoh soal
                                for ($i = 51; $i <= 100; $i++) {
                                    ?>
                                    <tr style="height: 100px;">
                                        <td><?= $i ?></td>
                                        <td>
                                            <img src="<?= base_url('assets/tesketelitian/soal/soal' . $i . '.png') ?>" width="170" style="margin-top: 10px;"/>
                                        </td>
                                        <td>
                                            <div class="radio">
                                                <label><input type="radio" name="soal<?= $i ?>" value="a"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'a.png') ?>" width="30"/></label>
                                                <label><input type="radio" name="soal<?= $i ?>" value="b"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'b.png') ?>" width="30"/></label>
                                                <label><input type="radio" name="soal<?= $i ?>" value="c"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'c.png') ?>" width="30"/></label>
                                                <label><input type="radio" name="soal<?= $i ?>" value="d"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'd.png') ?>" width="30"/></label>
                                                <label><input type="radio" name="soal<?= $i ?>" value="e"><img src="<?= base_url('assets/tesketelitian/jawaban/jawaban' . $i . 'e.png') ?>" width="30"/></label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <input type="button" name="submit" onclick="submitformcontohketelitian()" value="Simpan dan Lanjut tes berikutnya" class="btn btn-default pull-right btn btn-primary" style="margin-right: 20px;">

            </div>
        </div>


    </div>

    <!-- end container -->
</section>
<!-- end section1 -->

<script type="text/javascript">
   function timerasli(){
   
    var timer2 = "3:00";
    var interval = setInterval(function () {

        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0)
            clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('.countdown').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;

        if (minutes < 0) {
            alert('waktu habis');
            submitformcontohketelitian();
        }

    }, 1000);
}
    function submitformcontohketelitian() {
        $('#ketelitianform').submit();
    }
    
    function showlembarsoal(){
        $('#lembarsoal').show();
        timerasli();
    }
</script>