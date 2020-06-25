

<section class="post-wrapper-top">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>Tes Leadership</li>
            </ul>
            <h2>Instruksi: <br>
                "Pada setiap soal berikut terdapat situasi/kasus yang membutuhkan tindakan atau perilaku ANDA sebagai seorang pemimpin. Di bagian bawah halaman ini telah disediakan 5 alternatif tindakan kepemimpinan. Tugas ANDA adalah memberikan jawaban yang mencerminkan diri ANDA bila sedang berada dalam situasi tersebut, dengan cara."<br>
                <ol>
                    <li>"Menentukan tindakan kepemimpinan yang PALING KECIL kemungkinannya untuk ANDA pilih, lalu tuliskan HURUF pilihan ANDA pada kolom “-“ (minus)."</li>
                    <li>"Menentukan tindakan kepemimpinan yang PALING BESAR kemungkinannya untuk ANDA pilih, lalu tuliskan HURUF pilihan ANDA pada kolom “+” (plus)"</li>
                </ol>
            </h2>
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

                    <form id="leadershipform" action="" method="post">
                        <table class="table table-striped checkout effect-fade in" data-effect="fade" style="transition: all 0.7s ease-in-out 0s;">
                            <thead>
                                <tr>
                                    <th colspan="2" style="text-align:center" width="50px">SITUASI atau KASUS</th>
                                    <th width="200px">(+)</th>
                                    <th width="200px">(-)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($a_soal as $key => $jawaban) {
                                    ?>
                                    <tr>
                                        <td><?= $key ?></td>
                                        <td ><?= $jawaban ?></td>
                                        <td ><select id="plus<?= $key ?>" name="plus<?= $key ?>"  class="form-control"><?php foreach ($a_jawab as $keyjawab => $val) { ?>
                                                    <option value="<?= $keyjawab ?>"><?= $keyjawab . '.' . $val ?></option>     
                                                <?php } ?></select>
                                        <td ><select id="minus<?= $key ?>" name="minus<?= $key ?>" class="form-control"><?php foreach ($a_jawab as $keyjawab => $val) { ?>
                                                    <option value="<?= $keyjawab ?>"><?= $keyjawab . '.' . $val ?></option>
                                                <?php } ?></select></td>
                                    </tr>
                                    <?php }
                                ?>
                            </tbody>
                        </table>

                    </form>
                    <input type="button" name="submit" onclick="submitform()" value="Simpan dan Lanjut tes berikutnya" class="btn btn-default pull-right btn btn-primary" style="margin-right: 20px;">

                </div>
            </div>
        </div>


    </div>

    <!-- end container -->
</section>
<!-- end section1 -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#plus1').on('change', function () {
            $("#minus1 option").prop('disabled', false);
            $("#minus1 option[value*='" + $('#plus1').val() + "']").prop('disabled', true);
        });
        $('#minus1').on('change', function () {
            $("#plus1 option").prop('disabled', false);
            $("#plus1 option[value*='" + $('#minus1').val() + "']").prop('disabled', true);
        });

        $('#plus2').on('change', function () {
            $("#minus2 option").prop('disabled', false);
            $("#minus2 option[value*='" + $('#plus2').val() + "']").prop('disabled', true);
        });
        $('#minus2').on('change', function () {
            $("#plus2 option").prop('disabled', false);
            $("#plus2 option[value*='" + $('#minus2').val() + "']").prop('disabled', true);
        });

        $('#plus3').on('change', function () {
            $("#minus3 option").prop('disabled', false);
            $("#minus3 option[value*='" + $('#plus3').val() + "']").prop('disabled', true);
        });
        $('#minus3').on('change', function () {
            $("#plus3 option").prop('disabled', false);
            $("#plus3 option[value*='" + $('#minus3').val() + "']").prop('disabled', true);
        });

        $('#plus4').on('change', function () {
            $("#minus4 option").prop('disabled', false);
            $("#minus4 option[value*='" + $('#plus4').val() + "']").prop('disabled', true);
        });
        $('#minus4').on('change', function () {
            $("#plus4 option").prop('disabled', false);
            $("#plus4 option[value*='" + $('#minus4').val() + "']").prop('disabled', true);
        });

        $('#plus5').on('change', function () {
            $("#minus5 option").prop('disabled', false);
            $("#minus5 option[value*='" + $('#plus5').val() + "']").prop('disabled', true);
        });
        $('#minus5').on('change', function () {
            $("#plus5 option").prop('disabled', false);
            $("#plus5 option[value*='" + $('#minus5').val() + "']").prop('disabled', true);
        });

        $('#plus6').on('change', function () {
            $("#minus6 option").prop('disabled', false);
            $("#minus6 option[value*='" + $('#plus6').val() + "']").prop('disabled', true);
        });
        $('#minus6').on('change', function () {
            $("#plus6 option").prop('disabled', false);
            $("#plus6 option[value*='" + $('#minus6').val() + "']").prop('disabled', true);
        });

        $('#plus7').on('change', function () {
            $("#minus7 option").prop('disabled', false);
            $("#minus7 option[value*='" + $('#plus7').val() + "']").prop('disabled', true);
        });
        $('#minus7').on('change', function () {
            $("#plus7 option").prop('disabled', false);
            $("#plus7 option[value*='" + $('#minus7').val() + "']").prop('disabled', true);
        });

        $('#plus8').on('change', function () {
            $("#minus8 option").prop('disabled', false);
            $("#minus8 option[value*='" + $('#plus8').val() + "']").prop('disabled', true);
        });
        $('#minus8').on('change', function () {
            $("#plus8 option").prop('disabled', false);
            $("#plus8 option[value*='" + $('#minus8').val() + "']").prop('disabled', true);
        });

        $('#plus9').on('change', function () {
            $("#minus9 option").prop('disabled', false);
            $("#minus9 option[value*='" + $('#plus9').val() + "']").prop('disabled', true);
        });
        $('#minus9').on('change', function () {
            $("#plus9 option").prop('disabled', false);
            $("#plus9 option[value*='" + $('#minus9').val() + "']").prop('disabled', true);
        });

        $('#plus10').on('change', function () {
            $("#minus10 option").prop('disabled', false);
            $("#minus10 option[value*='" + $('#plus10').val() + "']").prop('disabled', true);
        });
        $('#minus10').on('change', function () {
            $("#plus10 option").prop('disabled', false);
            $("#plus10 option[value*='" + $('#minus10').val() + "']").prop('disabled', true);
        });

        $('#plus11').on('change', function () {
            $("#minus11 option").prop('disabled', false);
            $("#minus11 option[value*='" + $('#plus11').val() + "']").prop('disabled', true);
        });
        $('#minus11').on('change', function () {
            $("#plus11 option").prop('disabled', false);
            $("#plus11 option[value*='" + $('#minus11').val() + "']").prop('disabled', true);
        });

        $('#plus12').on('change', function () {
            $("#minus12 option").prop('disabled', false);
            $("#minus12 option[value*='" + $('#plus12').val() + "']").prop('disabled', true);
        });
        $('#minus12').on('change', function () {
            $("#plus12 option").prop('disabled', false);
            $("#plus12 option[value*='" + $('#minus12').val() + "']").prop('disabled', true);
        });

        $('#plus13').on('change', function () {
            $("#minus13 option").prop('disabled', false);
            $("#minus13 option[value*='" + $('#plus13').val() + "']").prop('disabled', true);
        });
        $('#minus13').on('change', function () {
            $("#plus13 option").prop('disabled', false);
            $("#plus13 option[value*='" + $('#minus13').val() + "']").prop('disabled', true);
        });

        $('#plus14').on('change', function () {
            $("#minus14 option").prop('disabled', false);
            $("#minus14 option[value*='" + $('#plus14').val() + "']").prop('disabled', true);
        });
        $('#minus14').on('change', function () {
            $("#plus14 option").prop('disabled', false);
            $("#plus14 option[value*='" + $('#minus14').val() + "']").prop('disabled', true);
        });

        $('#plus15').on('change', function () {
            $("#minus15 option").prop('disabled', false);
            $("#minus15 option[value*='" + $('#plus15').val() + "']").prop('disabled', true);
        });
        $('#minus15').on('change', function () {
            $("#plus15 option").prop('disabled', false);
            $("#plus15 option[value*='" + $('#minus15').val() + "']").prop('disabled', true);
        });

    });

    function submitform() {

        var validform = true;

        if ($('#plus1').val() == '' ||
                $('#plus2').val() == '' ||
                $('#plus3').val() == '' ||
                $('#plus4').val() == '' ||
                $('#plus5').val() == '' ||
                $('#plus6').val() == '' ||
                $('#plus7').val() == '' ||
                $('#plus8').val() == '' ||
                $('#plus9').val() == '' ||
                $('#plus10').val() == '' ||
                $('#plus11').val() == '' ||
                $('#plus12').val() == '' ||
                $('#plus13').val() == '' ||
                $('#plus14').val() == '' ||
                $('#plus15').val() == '' ||
                $('#minus1').val() == '' ||
                $('#minus2').val() == '' ||
                $('#minus3').val() == '' ||
                $('#minus4').val() == '' ||
                $('#minus5').val() == '' ||
                $('#minus6').val() == '' ||
                $('#minus7').val() == '' ||
                $('#minus8').val() == '' ||
                $('#minus9').val() == '' ||
                $('#minus10').val() == '' ||
                $('#minus11').val() == '' ||
                $('#minus12').val() == '' ||
                $('#minus13').val() == '' ||
                $('#minus14').val() == '' ||
                $('#minus15').val() == ''
                ) {
            validform = false;
        }


        if (!validform) {
            alert('Mohon isi semua isian!');
        } else {
            $('#leadershipform').submit();
        }

    }

</script>
