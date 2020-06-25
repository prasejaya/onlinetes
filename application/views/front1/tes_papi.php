

<section class="post-wrapper-top">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>PAPI Tes</li>
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

        <div class="col-md-12">
            <?= ($this->session->flashdata('error') != null) ? '<div class="alert alert-danger text-center">' . $this->session->flashdata('error') . '</div>' : ''; ?>

            <h4 class="title">
                <span>SOAL :</span>
            </h4>

            <div class="row">
                
                <form id="papiform" action="" method="post">
                <?php
                $a_soalpertama = array_slice($a_soal, 0, 45);
                ?>
                <div class="col-md-6">

                    <table class="table table-striped checkout effect-fade in" data-effect="fade" style="transition: all 0.7s ease-in-out 0s;">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($a_soalpertama as $nomor => $pilihan) {
                                ?>
                                <tr style="height: 150px;">
                                    <td><?= ($nomor + 1) ?></td>
                                    <td>
                                        <?php foreach ($pilihan as $abjad => $keterangan) {
                                            ?>
                                            <div class="radio">
                                                <label><input type="radio" name="soal<?= ($nomor + 1) ?>" value="<?= $abjad?>"><?= $abjad . ". " . $keterangan ?></label>
                                            </div>
                                            <?php
                                            if ($abjad == 'a')
                                                echo '<br>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>


                </div>

                <?php
                $a_soalkedua = array_slice($a_soal, 45, 90);
                ?>
                <div class="col-md-6">

                    <table class="table table-striped checkout effect-fade in" data-effect="fade" style="transition: all 0.7s ease-in-out 0s;">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($a_soalkedua as $nomor => $pilihan) {
                                ?>
                                <tr style="height: 150px;">
                                    <td><?= ($nomor + 46) ?></td>
                                    <td>
                                        <?php foreach ($pilihan as $abjad => $keterangan) {
                                            ?>
                                            <div class="radio">
                                                <label><input type="radio" name="soal<?= ($nomor + 46) ?>" value="<?= $abjad?>"><?= $abjad . ". " . $keterangan ?></label>
                                            </div>
                                            <?php
                                            if ($abjad == 'a')
                                                echo '<br>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>


                </div>
                    
                </form>
                <input type="button" name="submit" onclick="submitformpapi()" value="Simpan dan Lanjut tes berikutnya" class="btn btn-default pull-right btn btn-primary" style="margin-right: 20px;">

            </div>
        </div>


    </div>

    <!-- end container -->
</section>
<!-- end section1 -->

<script type="text/javascript">

    function submitformpapi() {

        var validform = true;

        if (typeof $("input[name='soal1']:checked").val() == 'undefined' ||
typeof $("input[name='soal2']:checked").val() == 'undefined' ||
typeof $("input[name='soal3']:checked").val() == 'undefined' ||
typeof $("input[name='soal4']:checked").val() == 'undefined' ||
typeof $("input[name='soal5']:checked").val() == 'undefined' ||
typeof $("input[name='soal6']:checked").val() == 'undefined' ||
typeof $("input[name='soal7']:checked").val() == 'undefined' ||
typeof $("input[name='soal8']:checked").val() == 'undefined' ||
typeof $("input[name='soal9']:checked").val() == 'undefined' ||
typeof $("input[name='soal10']:checked").val() == 'undefined' ||
typeof $("input[name='soal11']:checked").val() == 'undefined' ||
typeof $("input[name='soal12']:checked").val() == 'undefined' ||
typeof $("input[name='soal13']:checked").val() == 'undefined' ||
typeof $("input[name='soal14']:checked").val() == 'undefined' ||
typeof $("input[name='soal15']:checked").val() == 'undefined' ||
typeof $("input[name='soal16']:checked").val() == 'undefined' ||
typeof $("input[name='soal17']:checked").val() == 'undefined' ||
typeof $("input[name='soal18']:checked").val() == 'undefined' ||
typeof $("input[name='soal19']:checked").val() == 'undefined' ||
typeof $("input[name='soal20']:checked").val() == 'undefined' ||
typeof $("input[name='soal21']:checked").val() == 'undefined' ||
typeof $("input[name='soal22']:checked").val() == 'undefined' ||
typeof $("input[name='soal23']:checked").val() == 'undefined' ||
typeof $("input[name='soal24']:checked").val() == 'undefined' ||
typeof $("input[name='soal25']:checked").val() == 'undefined' ||
typeof $("input[name='soal26']:checked").val() == 'undefined' ||
typeof $("input[name='soal27']:checked").val() == 'undefined' ||
typeof $("input[name='soal28']:checked").val() == 'undefined' ||
typeof $("input[name='soal29']:checked").val() == 'undefined' ||
typeof $("input[name='soal30']:checked").val() == 'undefined' ||
typeof $("input[name='soal31']:checked").val() == 'undefined' ||
typeof $("input[name='soal32']:checked").val() == 'undefined' ||
typeof $("input[name='soal33']:checked").val() == 'undefined' ||
typeof $("input[name='soal34']:checked").val() == 'undefined' ||
typeof $("input[name='soal35']:checked").val() == 'undefined' ||
typeof $("input[name='soal36']:checked").val() == 'undefined' ||
typeof $("input[name='soal37']:checked").val() == 'undefined' ||
typeof $("input[name='soal38']:checked").val() == 'undefined' ||
typeof $("input[name='soal39']:checked").val() == 'undefined' ||
typeof $("input[name='soal40']:checked").val() == 'undefined' ||
typeof $("input[name='soal41']:checked").val() == 'undefined' ||
typeof $("input[name='soal42']:checked").val() == 'undefined' ||
typeof $("input[name='soal43']:checked").val() == 'undefined' ||
typeof $("input[name='soal44']:checked").val() == 'undefined' ||
typeof $("input[name='soal45']:checked").val() == 'undefined' ||
typeof $("input[name='soal46']:checked").val() == 'undefined' ||
typeof $("input[name='soal47']:checked").val() == 'undefined' ||
typeof $("input[name='soal48']:checked").val() == 'undefined' ||
typeof $("input[name='soal49']:checked").val() == 'undefined' ||
typeof $("input[name='soal50']:checked").val() == 'undefined' ||
typeof $("input[name='soal51']:checked").val() == 'undefined' ||
typeof $("input[name='soal52']:checked").val() == 'undefined' ||
typeof $("input[name='soal53']:checked").val() == 'undefined' ||
typeof $("input[name='soal54']:checked").val() == 'undefined' ||
typeof $("input[name='soal55']:checked").val() == 'undefined' ||
typeof $("input[name='soal56']:checked").val() == 'undefined' ||
typeof $("input[name='soal57']:checked").val() == 'undefined' ||
typeof $("input[name='soal58']:checked").val() == 'undefined' ||
typeof $("input[name='soal59']:checked").val() == 'undefined' ||
typeof $("input[name='soal60']:checked").val() == 'undefined' ||
typeof $("input[name='soal61']:checked").val() == 'undefined' ||
typeof $("input[name='soal62']:checked").val() == 'undefined' ||
typeof $("input[name='soal63']:checked").val() == 'undefined' ||
typeof $("input[name='soal64']:checked").val() == 'undefined' ||
typeof $("input[name='soal65']:checked").val() == 'undefined' ||
typeof $("input[name='soal66']:checked").val() == 'undefined' ||
typeof $("input[name='soal67']:checked").val() == 'undefined' ||
typeof $("input[name='soal68']:checked").val() == 'undefined' ||
typeof $("input[name='soal69']:checked").val() == 'undefined' ||
typeof $("input[name='soal70']:checked").val() == 'undefined' ||
typeof $("input[name='soal71']:checked").val() == 'undefined' ||
typeof $("input[name='soal72']:checked").val() == 'undefined' ||
typeof $("input[name='soal73']:checked").val() == 'undefined' ||
typeof $("input[name='soal74']:checked").val() == 'undefined' ||
typeof $("input[name='soal75']:checked").val() == 'undefined' ||
typeof $("input[name='soal76']:checked").val() == 'undefined' ||
typeof $("input[name='soal77']:checked").val() == 'undefined' ||
typeof $("input[name='soal78']:checked").val() == 'undefined' ||
typeof $("input[name='soal79']:checked").val() == 'undefined' ||
typeof $("input[name='soal80']:checked").val() == 'undefined' ||
typeof $("input[name='soal81']:checked").val() == 'undefined' ||
typeof $("input[name='soal82']:checked").val() == 'undefined' ||
typeof $("input[name='soal83']:checked").val() == 'undefined' ||
typeof $("input[name='soal84']:checked").val() == 'undefined' ||
typeof $("input[name='soal85']:checked").val() == 'undefined' ||
typeof $("input[name='soal86']:checked").val() == 'undefined' ||
typeof $("input[name='soal87']:checked").val() == 'undefined' ||
typeof $("input[name='soal88']:checked").val() == 'undefined' ||
typeof $("input[name='soal89']:checked").val() == 'undefined' ||
typeof $("input[name='soal90']:checked").val() == 'undefined' 
) {
            validform = false;
        }

        if (!validform) {
            alert('Mohon isi semua isian!');
        }else{
            $('#papiform').submit();
        }
    }
</script>