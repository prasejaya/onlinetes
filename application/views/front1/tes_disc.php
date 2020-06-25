

<section class="post-wrapper-top">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>DISC tes</li>
            </ul>
            <h4>Petunjuk Pengisian: <br>
                "
                Setiap nomor di bawah ini memuat 4 (empat) kalimat. Tugas anda adalah : 
                <br>1. Memilih  [P] di samping kalimat yang PALING menggambarkan diri anda
                <br>2. Memilih  [K] di samping kalimat yang PALING TIDAK menggambarkan diri anda
                <br>PERHATIKAN : Setiap nomor hanya ada 1 (satu) pilihan di bawah masing-masing kolom P dan K.
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

                <form id="discform" action="" method="post">
                    <?php
                    $a_soalpertama = array_slice($a_soal, 0, 12);
                    ?>
                    <div class="col-md-6">

                        <table class="table checkout effect-fade in" data-effect="fade" style="transition: all 0.7s ease-in-out 0s;">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>P</th>
                                    <th>K</th>
                                    <th>Gambaran Diri</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($a_soalpertama as $nomor => $pilihan) {
                                    $i = 0;
                                    foreach ($pilihan as $key => $deskripsi) {
                                        ?>
                                        <tr>
                                            <?php
                                            if ($i == 0) {
                                                echo '<td style="vertical-align:middle;" rowspan="4">' . ($nomor + 1) . '</td>';
                                            }
                                            $i++;
                                            ?>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="soal<?= ($nomor + 1) . "P" ?>" value="P|<?= ($nomor + 1).'|'.$key ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="soal<?= ($nomor + 1) . "K" ?>" value="K|<?= ($nomor + 1).'|'.$key ?>"></label>
                                                </div>
                                            </td>
                                            <td><?= $deskripsi ?></td>
                                        </tr>
                                        <?php
                                        if ($i == 4) {
                                            echo '<tr><td colspan="4">&nbsp</td></tr>';
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>


                    </div>

                    <?php
                    $a_soalkedua = array_slice($a_soal, 12, 24);
                    ?>

                    <div class="col-md-6">

                        <table class="table checkout effect-fade in" data-effect="fade" style="transition: all 0.7s ease-in-out 0s;">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>P</th>
                                    <th>K</th>
                                    <th>Gambaran Diri</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($a_soalkedua as $nomor => $pilihan) {
                                    $i = 0;
                                    foreach ($pilihan as $key => $deskripsi) {
                                        ?>
                                        <tr>
                                            <?php
                                            if ($i == 0) {
                                                echo '<td style="vertical-align:middle;" rowspan="4">' . ($nomor + 13) . '</td>';
                                            }
                                            $i++;
                                            ?>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="soal<?= ($nomor + 13) . "P" ?>" value="P|<?= ($nomor + 13).'|'.$key ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="soal<?= ($nomor + 13) . "K" ?>" value="K|<?= ($nomor + 13).'|'.$key ?>"></label>
                                                </div>
                                            </td>
                                            <td><?= $deskripsi ?></td>
                                        </tr>
                                        <?php
                                        if ($i == 4) {
                                            echo '<tr><td colspan="4">&nbsp</td></tr>';
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>


                    </div>

                </form>
                <input type="button" name="submit" onclick="submitformdisc()" value="Simpan dan Lanjut tes berikutnya" class="btn btn-default pull-right btn btn-primary" style="margin-right: 20px;">

            </div>
        </div>


    </div>

    <!-- end container -->
</section>
<!-- end section1 -->

<script type="text/javascript">

    function submitformdisc() {
        var validform = true;
        
        if (typeof $("input[name='soal1K']:checked").val() == 'undefined' ||
typeof $("input[name='soal2K']:checked").val() == 'undefined' ||
typeof $("input[name='soal3K']:checked").val() == 'undefined' ||
typeof $("input[name='soal4K']:checked").val() == 'undefined' ||
typeof $("input[name='soal5K']:checked").val() == 'undefined' ||
typeof $("input[name='soal6K']:checked").val() == 'undefined' ||
typeof $("input[name='soal7K']:checked").val() == 'undefined' ||
typeof $("input[name='soal8K']:checked").val() == 'undefined' ||
typeof $("input[name='soal9K']:checked").val() == 'undefined' ||
typeof $("input[name='soal10K']:checked").val() == 'undefined' ||
typeof $("input[name='soal11K']:checked").val() == 'undefined' ||
typeof $("input[name='soal12K']:checked").val() == 'undefined' ||
typeof $("input[name='soal13K']:checked").val() == 'undefined' ||
typeof $("input[name='soal14K']:checked").val() == 'undefined' ||
typeof $("input[name='soal15K']:checked").val() == 'undefined' ||
typeof $("input[name='soal16K']:checked").val() == 'undefined' ||
typeof $("input[name='soal17K']:checked").val() == 'undefined' ||
typeof $("input[name='soal18K']:checked").val() == 'undefined' ||
typeof $("input[name='soal19K']:checked").val() == 'undefined' ||
typeof $("input[name='soal20K']:checked").val() == 'undefined' ||
typeof $("input[name='soal21K']:checked").val() == 'undefined' ||
typeof $("input[name='soal22K']:checked").val() == 'undefined' ||
typeof $("input[name='soal23K']:checked").val() == 'undefined' ||
typeof $("input[name='soal24K']:checked").val() == 'undefined' ||
typeof $("input[name='soal1P']:checked").val() == 'undefined' ||
typeof $("input[name='soal2P']:checked").val() == 'undefined' ||
typeof $("input[name='soal3P']:checked").val() == 'undefined' ||
typeof $("input[name='soal4P']:checked").val() == 'undefined' ||
typeof $("input[name='soal5P']:checked").val() == 'undefined' ||
typeof $("input[name='soal6P']:checked").val() == 'undefined' ||
typeof $("input[name='soal7P']:checked").val() == 'undefined' ||
typeof $("input[name='soal8P']:checked").val() == 'undefined' ||
typeof $("input[name='soal9P']:checked").val() == 'undefined' ||
typeof $("input[name='soal10P']:checked").val() == 'undefined' ||
typeof $("input[name='soal11P']:checked").val() == 'undefined' ||
typeof $("input[name='soal12P']:checked").val() == 'undefined' ||
typeof $("input[name='soal13P']:checked").val() == 'undefined' ||
typeof $("input[name='soal14P']:checked").val() == 'undefined' ||
typeof $("input[name='soal15P']:checked").val() == 'undefined' ||
typeof $("input[name='soal16P']:checked").val() == 'undefined' ||
typeof $("input[name='soal17P']:checked").val() == 'undefined' ||
typeof $("input[name='soal18P']:checked").val() == 'undefined' ||
typeof $("input[name='soal19P']:checked").val() == 'undefined' ||
typeof $("input[name='soal20P']:checked").val() == 'undefined' ||
typeof $("input[name='soal21P']:checked").val() == 'undefined' ||
typeof $("input[name='soal22P']:checked").val() == 'undefined' ||
typeof $("input[name='soal23P']:checked").val() == 'undefined' ||
typeof $("input[name='soal24P']:checked").val() == 'undefined' 
) {
            validform = false;
        }

        if (!validform) {
            alert('Mohon isi semua isian!');
        } else {
            $('#discform').submit();
        }
    }
</script>