<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

    public function index() {
        if ($this->session->userdata('token')) {
            redirect(base_url('front/datapeserta'));
        }else{
            $config = array(/* Config array - can be overrided by passing in array in ini() */
                'default_input_type' => 'form_input',
                'default_input_container_class' => 'form-group',
                'bootstrap_required_input_class' => 'form-control',
                'default_dropdown_class' => 'valid',
                'default_control_label_class' => 'col-md-2',
                'default_no_label_class' => 'col-sm-offset-2',
                'default_form_control_class' => 'col-md-8',
                'default_form_class' => 'form-horizontal col-sm-12',
                'default_button_classes' => 'btn btn-primary',
                'default_date_post_addon' => '', // For instance '<span class="input-group-btn"><button class="btn default" type="button"><i class="glyphicon glyphicon-calendar"></i></button></span>'
                'default_date_format' => 'Y-m-d',
                'default_date_today_if_not_set' => FALSE,
                'default_datepicker_class' => '', // For instance 'date-picker'
                'empty_value_html' => '<div class="form-control" style="border:none;"></div>',
                'use_testing_value' => true
            );
            $this->load->library('formbuilder', $config);
            $this->load->helper('form');
            $this->load->helper('captcha');

            $data['page_post'] = '';
            $data['datavalue'] = null;

            $data['formdata'][] = array('id' => 'token', 'label' => '', 'size' => '20', 'validation' => 'required|min_length[1]|max_length[225]');

            //create captcha image
            $captcha_option = array(
                'img_path' => './captcha/',
                'img_url' => base_url() . 'captcha/',
                'font_path' => './assets/font/Roboto.ttf',
                'img_width' => 300,
                'img_height' => 100,
                'border' => 0,
                'expiration' => 7200,
                'word_length' => 4,
                'font_size' => 30,
            );
            $captcha = create_captcha($captcha_option);

            $data['formdata'][] = array('id' => 'captchaimage', 'label' => '', 'type' => 'html', 'html' => $captcha['image']);
            $data['formdata'][] = array('id' => 'captchatext', 'label' => '', 'placeholder' => "Ketik Captcha (huruf pada gambar di atas)", 'validation' => 'required|callback_captcha_check');

            $data['formdata'][] = array('id' => 'submit', 'type' => 'submit', 'label' => 'Mulai tes', 'class' => 'btn btn-lg btn-default', 'style' => 'margin-right: 20px;');

            if ($this->input->post()) {
                $this->load->library('valid');

                $result_valid = $this->valid->cek_form($data['formdata']);

                if ($result_valid['status']) {
                    //cek token di database
                    $this->load->model('m_peserta');
                    $datatoken = $this->m_peserta->get_data_token($this->input->post('token'));

                    if (!empty($datatoken)) {
                        $this->session->set_userdata($datatoken);
                        redirect(base_url('front/datapeserta'));
                    } else {
                        $this->session->set_flashdata('error', 'Token tidak ditemukan!');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Cek kembali isian anda!');
                }

                //overide form untuk message
                $data['formdata'] = $result_valid['form'];
                //$data['datavalue'] = $result_valid['datavalue'];
                //setting ulang captcha jika salah
                if ($result_valid['status'] == false) {
                    $this->session->set_userdata('captchaword', $captcha['word']);
                }
            } else {
                $this->session->set_userdata('captchaword', $captcha['word']);
            }

            $this->template->load('front1', 'front1/home', $data);
        }
    }

    public function captcha_check() {
        if (strtolower($this->input->post('captchatext')) == strtolower($this->session->userdata('captchaword'))) {
            return true;
        } else {
            $this->form_validation->set_message('captcha_check', 'captcha tidak sesuai');
            return false;
        }
    }

    public function datapeserta() {
        if (!$this->session->userdata('token')) {
            $this->template->load('front1', 'front1/no_token', null);
        } else {
            $config = array(/* Config array - can be overrided by passing in array in ini() */
                'default_input_type' => 'form_input',
                'default_input_container_class' => 'form-group',
                'bootstrap_required_input_class' => 'form-control',
                'default_dropdown_class' => 'valid',
                'default_control_label_class' => 'col-md-2',
                'default_no_label_class' => 'col-sm-offset-2',
                'default_form_control_class' => 'col-md-8',
                'default_form_class' => 'form-horizontal col-sm-12',
                'default_button_classes' => 'btn btn-primary',
                'default_date_post_addon' => '', // For instance '<span class="input-group-btn"><button class="btn default" type="button"><i class="glyphicon glyphicon-calendar"></i></button></span>'
                'default_date_format' => 'Y-m-d',
                'default_date_today_if_not_set' => FALSE,
                'default_datepicker_class' => '', // For instance 'date-picker'
                'empty_value_html' => '<div class="form-control" style="border:none;"></div>',
                'use_testing_value' => true
            );
            $this->load->library('formbuilder', $config);
            $this->load->helper('form');
            $this->load->model('m_peserta');

            $data['page_post'] = '';

            $data['datavalue'] = $this->m_peserta->get_one('*', $this->session->userdata('id_peserta'));

            $a_jeniskelamin = array('L' => 'Laki-Laki', 'P' => 'Perempuan');
            $a_status = array('Single' => 'Single', 'Menikah' => 'Menikah', 'Janda/Duda' => 'Janda/Duda');
            $a_agama = array('islam' => 'Islam',
                'kristen' => 'Kristen',
                'katolik' => 'Katolik',
                'hindu' => 'Hindu',
                'buddha' => 'Buddha',
                'konghucu' => 'Konghucu',
                'lainnya' => 'lainnya');

            if ($data['datavalue']['nama'] != '')
                $readonly = array('readonly' => '');
            else
                $readonly = array();

            $data['formdata'][] = array('id' => 'nama', 'label' => 'Nama Lengkap :', 'validation' => 'required|min_length[1]|max_length[225]') + $readonly;
            $data['formdata'][] = array('id' => 'jk', 'type' => 'dropdown', 'options' => $a_jeniskelamin, 'label' => 'Jenis Kelamin :', 'validation' => 'required') + $readonly;
            $data['formdata'][] = array('id' => 'tmplahir', 'label' => 'Tempat Lahir :', 'validation' => 'required|min_length[1]|max_length[100]') + $readonly;
            $data['formdata'][] = array('id' => 'tgllahir', 'label' => 'Tanggal Lahir (Format: mm/dd/yyyy) :', 'type' => 'date', 'validation' => 'required|min_length[5]|max_length[10]') + $readonly;
            $data['formdata'][] = array('id' => 'telp', 'label' => 'Telp/HP :', 'validation' => 'required|numeric|min_length[10]|max_length[15]') + $readonly;
            $data['formdata'][] = array('id' => 'email', 'label' => 'Email :', 'validation' => 'required|valid_email') + $readonly;
            $data['formdata'][] = array('id' => 'alamat', 'type' => 'textarea', 'label' => 'Alamat Lengkap Domisili:', 'placeholder' => '', 'rows' => '2', 'validation' => 'required|max_length[225]') + $readonly;
            $data['formdata'][] = array('id' => 'agama', 'type' => 'dropdown', 'options' => $a_agama, 'label' => 'Agama', 'validation' => 'required') + $readonly;
            $data['formdata'][] = array('id' => 'status', 'type' => 'dropdown', 'options' => $a_status, 'label' => 'Status', 'validation' => 'required') + $readonly;
            $data['formdata'][] = array('id' => 'jabatan', 'label' => 'Jabatan :', 'validation' => 'required|min_length[1]|max_length[225]') + $readonly;
            $data['formdata'][] = array('id' => 'golongan', 'label' => 'Golongan :', 'validation' => 'required|min_length[1]|max_length[225]') + $readonly;
            $data['formdata'][] = array('id' => 'perusahaan', 'label' => 'Perusahaan :', 'validation' => 'required|min_length[1]|max_length[225]') + $readonly;
            $data['formdata'][] = array('id' => 'alamatperusahaan', 'type' => 'textarea', 'label' => 'Alamat Perusahaan:', 'placeholder' => '', 'rows' => '2', 'validation' => 'required|max_length[225]') + $readonly;
            $data['formdata'][] = array('id' => 'namaatasan', 'label' => 'Nama Atasan :', 'validation' => 'required|min_length[1]|max_length[225]') + $readonly;
            $data['formdata'][] = array('id' => 'jabatanatasan', 'label' => 'Jabatan Atasan :', 'validation' => 'required|min_length[1]|max_length[225]') + $readonly;
            //$data['formdata'][] = array('id' => 'pekerjaan', 'label' => 'Pekerjaan :', 'validation' => 'required|min_length[1]|max_length[225]');
            $a_konfirmasi = array('id' => 'konfirmasicheck',
                'value' => '1',
                'label' => 'Saya menyatakan bahwa data yang Saya upload adalah benar dan dapat 
                        dipertanggungjawabkan. Apabila nanti terbukti Saya melakukan manipulasi data atau kecurangan pada saat tes, 
                        Saya bersedia menerima sangsi yang berlaku.',
                'validation' => 'required');
            $data['formdata'][] = array('id' => 'konfirm', 'label' => 'Konfirmasi', 'type' => 'checkbox', 'options' => array($a_konfirmasi), 'validation' => 'required') + $readonly;


            if ($data['datavalue']['nama'] != '')
                $data['formdata'][] = array('id' => 'htmlbutton', 'type' => 'html', 'label' => '', 'html' => '<a href="' . base_url('front/papi') . '"><input type="button" name="submit" value="Data sudah diisi, lanjutkan tes" class="btn btn-large btn-theme margintop10 pull-right btn btn-primary"></a>');
            else
                $data['formdata'][] = array('id' => 'submit', 'type' => 'submit', 'label' => 'Simpan dan Mulai Tes', 'class' => 'btn btn-large btn-theme margintop10 pull-right');

            if ($this->input->post()) {

                $this->load->library('valid');

                $datacustom = array();
                //untuk menghilangkan inputan dan tidak ikut ter insert
                $exception = array('submit', 'konfirm');
                $upload_setting = array();
                $result_valid = $this->valid->update($data['formdata'], 'm_peserta', 'daftar-peserta', $datacustom, $exception, $data['datavalue'], $upload_setting);

                if ($result_valid['status_proses']) {
                    $this->session->set_flashdata('info', 'Berhasil perubahan data!');
                    $this->session->set_userdata(array('namalengkap' => $this->input->post('nama')));
                    redirect(base_url('front/papi'));
                    die();
                } else {
                    $this->session->set_flashdata('error', 'Gagal menyimpan data, & Konfirmasi wajib di centang!');
                }

                //overide form untuk message
                $data['formdata'] = $result_valid['form'];
                $data['datavalue'] = $result_valid['datavalue'];
            }
            //print_r($data['formdata']); 
            $this->template->load('front1', 'front1/formdaftar', $data);
        }
    }

    public function belbin() {
        if (!$this->session->userdata('namalengkap')) {
            $this->template->load('front1', 'front1/no_token', null);
        } else {
            $this->load->model('m_jawabanbelbin');
            $sudahjawab = $this->m_jawabanbelbin->get_jawaban_peserta($this->session->userdata('id_peserta'));
            if (!empty($sudahjawab)) {
                $data['jenistes'] = 'BELBIN';
                $data['tesselanjutnya'] = base_url('front/leadership');
                $this->template->load('front1', 'front1/sudah_tes', $data);
            } else {
                $data['a_soal']['kelompok1'] = array(
                    'kelompok' => 'Kelompok I',
                    'keterangan' => 'APA YANG DAPAT SAYA BERIKAN PADA KELOMPOK :',
                    'jawaban' => array(
                        '10' => 'Saya pikir, saya dapat dengan cepat melihat dan memanfaatkan peluang-peluang baru',
                        '11' => 'Tanggapan atau komentar saya secara umum maupun khusus, dapat diterima dengan baik',
                        '12' => 'Saya dapat bekerja sama dengan baik dengan berbagai macam orang',
                        '13' => 'Salah satu potensi alami saya adalah mampu menghasilkan ide-ide',
                        '14' => 'Kelebihan saya adalah kemampuan untuk mendorong orang lain berbicara, ketika saya melihat mereka memilikai sesuatu yang bernilai untuk diberikan pada tujuan kelompok',
                        '15' => 'Saya dapat diandalkan untuk menyelesaikan setiap tugas yang diberikan kepada saya',
                        '16' => 'Biasanya pengetahuan teknis dan pengalaman merupakan kelebihan utama saya',
                        '17' => 'Saya bersedia bersikap tegas dan vokal untuk mewujudkan sesuatu sesuatu yang benar',
                        '18' => 'Saya biasanya dapat memberi penilaian, apakah sesuatu rencana atau ide cocok untuk situasi/kondisi tertentu',
                        '19' => 'Saya dapat menawarkan alternatif tindakan yang beralasan dan objektif'
                    ),
                );
                $data['a_soal']['kelompok2'] = array(
                    'kelompok' => 'Kelompok II',
                    'keterangan' => 'KEMUNGKINAN KEKURANGAN SAYA DALAM KERJA KELOMPOK ADALAH :',
                    'jawaban' => array(
                        '20' => 'Saya merasa tidak tenang bila rapat tidak tertib dan terkendali, atau secara keseluruhan tidak terselenggara dengan baik.',
                        '21' => 'Saya cenderung terlalu memberikan perhatian terhadap orang-orang yang mempunyai pandangan atau pendapat yang benar tetapi belum memperoleh kesempatan untuk mengemukakannya.',
                        '22' => 'Saya enggan memberikan konstribusi kecuali masalahnya berkaitan dengan bidang yang saya ketahui dengan baik.',
                        '23' => 'Saya cenderung banyak berbicara pada saat kelompok masuk ke topik baru.',
                        '24' => 'Saya cenderung kurang menghargai kontribusi saya sendiri.',
                        '25' => 'Pendapat/pandangan saya yang objektif membuat saya sulit untuk secara sepontan dan antusias berbaur dengan rekan-rekan.',
                        '26' => 'Saya kadangkala terlihat memaksa dan otoriter bila menangani hal-hal penting.',
                        '27' => 'Saya mengalami kesulitan untuk memimpin di depan. Mungkin karena saya terlalu responsive terhadap suasana kelompok.',
                        '28' => 'Saya cenderung terperangkap dengan ide-ide saya sendiri sehingga kehilangan jejak akan hal-hal yang terjadi disekitar saya.',
                        '29' => 'Saya enggan mengutarakan pendapat saya mengenai proposal atau rencana yang belum matang atau yang detail-detailnya belum lengkap.'
                    ),
                );
                $data['a_soal']['kelompok3'] = array(
                    'kelompok' => 'Kelompok III',
                    'keterangan' => 'KETIKA TERLIHAT DALAM PROYEK BERSAMA ORANG LAIN :',
                    'jawaban' => array(
                        '30' => 'Saya melihat kemampuan untuk mempengaruhi orang tanpa harus menekan mereka.',
                        '31' => 'Secara umum saya adalah orang yang efektif dalam menghindari kesalahan yang dapat menghalangi keberhasilan suatu oprasi.',
                        '32' => 'Saya siap melakukan tindakan dan menjaga pertemuan itu agar tidak membuang-buang waktu dan tidak menyimpang dari arah atau tujuan semula.',
                        '33' => 'Saya dapat diandalkan untuk menberikan gagasan-gagasan yang orisinil.',
                        '34' => 'Saya selalu siap mendukung saran yang baik untuk kepentingan bersama.',
                        '35' => 'Yakinlah bahwa saya akan berlaku sebagai diri saya sewajarnya ( apa adanya ).',
                        '36' => 'Saya cepat melihat peluang ide-ide dan perkembangan-perkembangan baru.',
                        '37' => 'Saya berusaha menjaga profesionalisme.',
                        '38' => 'Saya percaya bahwa kemampuan saya menilai dapat membantu pengambilan keputusan yang tepat.',
                        '39' => 'Saya dapat diandalkan untuk menyusun cara yang teratur sesuai dengan kebutuhan tugas.'
                    ),
                );
                $data['a_soal']['kelompok4'] = array(
                    'kelompok' => 'Kelompok IV',
                    'keterangan' => 'CIRI KHAS PENDEKATAN SAYA DALAM KERJA KELOMPOK ADALAH :',
                    'jawaban' => array(
                        '40' => 'Saya cukup mempunyai minat untuk mengenal rekan-rekan sekerja secara lebih mendalam',
                        '41' => 'Saya memberi kontribusi/sumbangsih hanya untuk masalah-masalah yang saya kuasai',
                        '42' => 'Saya tidak segan-segan untuk menentang pandangan orang lain atau mempertahankan pendapat saya yang minoritas pendukungnya.',
                        '43' => 'Biasanya saya dapat menemukan alasan yang tepat untuk menolak usulan-usulan yang kurang masuk akal.',
                        '44' => 'Begitu suatu rencana akan dijalankan, saya merasa mempunyai bakat untuk membuat segala sesuatunya berjalan lancar.',
                        '45' => 'Saya lebih suka menghindari cara-cara yang sudah umum/lazim dan memcoba hal-hal baru yang belum digunakan.',
                        '46' => 'Saya selalu berusaha semaksimal mungkin untuk menyelesaikan semua tugas yang saya tangani.',
                        '47' => 'Saya senang menjadi penghubung dengan pihak luar kelompok atau perusahaan',
                        '48' => 'Saya menikmati aspek sosial hubungan kerja.',
                        '49' => 'Sekalipun saya berminat untuk mendengarkan semua pendat/pandangan,namun tidak ragu-ragu untuk menentukan sikap bila harus mengambil keputusan saya sendiri.'
                    ),
                );
                $data['a_soal']['kelompok5'] = array(
                    'kelompok' => 'Kelompok V',
                    'keterangan' => 'SAYA MENDAPAT KEPUASAN DALAM PEKERJAAN KARENA:',
                    'jawaban' => array(
                        '50' => 'Saya Senang menganalisa berbagai situasi dan mempertimbangkan semua kemungkinan pilihan',
                        '51' => 'Saya merasa tertarik untuk menemukan penyelesaian yang praktis terhadap suatu masalah.',
                        '52' => 'Saya merasa senang dapat membantu terciptanya hubungan kerja yang baik.',
                        '53' => 'Saya bisa memberikan pengaruh yang besar dalam pengambilan keputusan.',
                        '54' => 'Saya mempunyai kesempatan bertemu dengan banyak orang yang memiliki beragam gagasan.',
                        '55' => 'Saya bisa membuat orang setuju pada prioritas serta sasaran-sasaran yang ingin dicapai.',
                        '56' => 'Saya merasa bisa memberikan perhatian penuh terhadap tugas-tugas yang saya hadapi.',
                        '57' => 'Saya memiliki kesempatan untuk mengembangkan daya imajinasi saya.',
                        '58' => 'Saya merasa bisa memanfaatkan kemapuan dan keahlian khusus saya.',
                        '59' => 'Saya biasanya mendapatkan bahwa pekerjaan memberi saya kesempatan untuk mengekspresikan diri.',
                    ),
                );
                $data['a_soal']['kelompok6'] = array(
                    'kelompok' => 'Kelompok VI',
                    'keterangan' => 'JIKA TIBA-TIBA SAYA DIBERI TUGAS SULIT YANG HARUS SEGERA DISELESAIKAN DAN HARUS BEKERJASAMA DENGAN ORANG-ORANG YANG TIDAK BEGITU SAYA KENAL',
                    'jawaban' => array(
                        '60' => 'Saya biasanya behasil meski bagaimanapun situasinya.',
                        '61' => 'Saya akan mempelajarinya sampai saya yakin menguasai masalahnya.',
                        '62' => 'Saya akan merancang dulu jalan keluarnya sendiri, lalu berusaha menawarkannya pada kelompok.',
                        '63' => 'Saya akan siap bekerjasama dengan orang-orang yang bisa menunjukan cara yang paling positif.',
                        '64' => 'Saya akan berusaha mengurangi pekerjaan dengan cara menetapkan orang yang tepat untuk tiap bagian pekerjaan.',
                        '65' => 'Saya selalu sadar akan mendesaknya suatu keadaan dalam hal ini akan menjamin kelompok untuk tepat waktu.',
                        '66' => 'Saya yakin akan tetap bersikap tenang dan mempertahankan kemampuan saya berpikir jernih.',
                        '67' => 'Walaupun ada tekanan saya akan berusaha untuk tetap melangkah maju dengan segala yang bisa saya lakukan.',
                        '68' => 'Saya akan mengambil alih pimpinan bila kelompok tidak mengalami kemajuan.',
                        '69' => 'Saya akan membuka diskusi dengan mengajukan pandangan untuk merangsang pemikiran barau dan memperoleh kemajuan.',
                    ),
                );
                $data['a_soal']['kelompok7'] = array(
                    'kelompok' => 'Kelompok VII',
                    'keterangan' => 'DALAM KAITAN DENGAN MASALAH YAANG SAYA ALAMI KETIKA BEKERJA DALAM KELOMPOK :',
                    'jawaban' => array(
                        '70' => 'Saya cenderung mudah menunjukan ketidaksabaran bila orang-orang mengganggu jalannya kemajuan.',
                        '71' => 'Sebagian orang mengkritik bahwa saya terlalu analitis.',
                        '72' => 'Keinginan saya untuk memeriksa apakah kita memperoleh detail-detail penting yang benar tidak selalu disambut dengan baik.',
                        '73' => 'Saya cenderung merasa bosan, kecuali sedang terlibat dalam kegiatan,dengan orang-orang yang menarik.',
                        '74' => 'Saya merasa sulit untuk memulai sesuatu yang tujuannya belum jelas.',
                        '75' => 'Kadang-kadang saya kurang mampu menjelaskan hal-hal kompleks yang ada dalam pikiran saya.',
                        '76' => 'Secara sadar saya mendorong orang lain untuk melakukan hal-hal yang tidak dapat saya lakukan seorang diri.',
                        '77' => 'Saya merasa orang-orang tidak memberi cukup kesempatan untuk mengutarakan semua yang saya ingin katakan.',
                        '78' => 'Saya cenderung merasa bahwa saya hanya membuang waktu saja padahal saya bisa melakukannya dengan baik seorang diri.',
                        '79' => 'Saya merasa ragu bila harus mengemukakan pandangan pribadi saya pada orang yang suka mempersulit atau yang berkuasa.',
                    ),
                );

                $mapping = array('10' => 'RI',
                    '11' => 'DR',
                    '12' => 'TW',
                    '13' => 'PL',
                    '14' => 'CO',
                    '15' => 'CF',
                    '16' => 'SP',
                    '17' => 'SH',
                    '18' => 'IMP',
                    '19' => 'ME',
                    '20' => 'IMP',
                    '21' => 'CO',
                    '22' => 'SP',
                    '23' => 'RI',
                    '24' => 'DR',
                    '25' => 'ME',
                    '26' => 'SH',
                    '27' => 'TW',
                    '28' => 'PL',
                    '29' => 'CF',
                    '30' => 'CO',
                    '31' => 'CF',
                    '32' => 'SH',
                    '33' => 'PL',
                    '34' => 'TW',
                    '35' => 'DR',
                    '36' => 'RI',
                    '37' => 'SP',
                    '38' => 'ME',
                    '39' => 'IMP',
                    '40' => 'TW',
                    '41' => 'SP',
                    '42' => 'SH',
                    '43' => 'ME',
                    '44' => 'IMP',
                    '45' => 'PL',
                    '46' => 'CF',
                    '47' => 'RI',
                    '48' => 'DR',
                    '49' => 'CO',
                    '50' => 'ME',
                    '51' => 'IMP',
                    '52' => 'TW',
                    '53' => 'SH',
                    '54' => 'RI',
                    '55' => 'CO',
                    '56' => 'CF',
                    '57' => 'PL',
                    '58' => 'SP',
                    '59' => 'DR',
                    '60' => 'DR',
                    '61' => 'SP',
                    '62' => 'PL',
                    '63' => 'TW',
                    '64' => 'CO',
                    '65' => 'CF',
                    '66' => 'ME',
                    '67' => 'IMP',
                    '68' => 'SH',
                    '69' => 'RI',
                    '70' => 'SH',
                    '71' => 'ME',
                    '72' => 'CF',
                    '73' => 'RI',
                    '74' => 'IMP',
                    '75' => 'PL',
                    '76' => 'CO',
                    '77' => 'DR',
                    '78' => 'SP',
                    '79' => 'TW'
                );

                if ($this->input->post()) {
                    foreach ($data['a_soal'] as $key => $jawaban) {

                        foreach ($jawaban['jawaban'] as $idjawaban => $deskripsi) {
                            $datainput[] = array('id_peserta' => $this->session->userdata('id_peserta'),
                                'soal' => $deskripsi,
                                'kelompok' => $idjawaban,
                                'jawaban' => $this->input->post('kelompok' . $idjawaban),
                                'jenis' => $mapping[$idjawaban],
                                'log_time' => date('Y-m-d H:i:s'),
                                'log_timeinsert' => date('Y-m-d H:i:s'),
                                'log_act' => 'jawab-belbin',
                                'log_ip' => $_SERVER['REMOTE_ADDR'],
                                'log_ref' => $this->router->fetch_class() . '/' . $this->router->fetch_method()
                            );
                        }
                    }

                    $hasil = $this->m_jawabanbelbin->insert_batch($datainput);

                    if ($hasil > 0) {
                        redirect(base_url('front/leadership'));
                        //die('ok');
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi kesalahan menyimpan data!');
                    }
                }

                $this->template->load('front1', 'front1/tes_belbin', $data);
            }
        }
    }

    public function leadership() {
        if (!$this->session->userdata('namalengkap')) {
            $this->template->load('front1', 'front1/no_token', null);
        } else {
            $this->load->model('m_jawabanleadership');
            $sudahjawab = $this->m_jawabanleadership->get_jawaban_peserta($this->session->userdata('id_peserta'));
            if (!empty($sudahjawab)) {
                $data['jenistes'] = 'LEADERSHIP';
                $data['tesselanjutnya'] = base_url('front/ketelitiancontoh');
                $this->template->load('front1', 'front1/sudah_tes', $data);
            } else {
                $data['a_soal'] = array('1' => 'Saat ini ANDA bersama-sama dengan para bawahan mendapatkan proyek dalam mengembangkan strategi baru untuk efisiensi dan efektivitas produksi. Para bawahan ANDA tahu apa yang harus dilakukan, disamping itu mereka pun telah menunjukkan kematangan dan kecakapannya. Mana pendekatan kepemimpinan yang ANDA anggap (+) atau (-) pada proyek ini dan tahap selanjutanya?',
                    '2' => 'Unjuk kerja dari salah seorang bawahan ANDA merosot. Pada waktu-waktu yang lalu, orang tersebut biasanya menunjukkan kecakapan dan tanggung jawab yang cukup memadai. Ia memberitahu ANDA mengenai masalah serius yang dihadapinya berkaitan dengan salah satu responden. Mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '3' => 'Sebagai pimpinan ANDA berusaha melakukan pendekatan terhadap salah seorang bawahan agar ia dapat meningkatkan unjuk kerjanya, tetapi sama sekali tidak ada tanggapan. Catatan ANDA menunjukkan bahwa kinerja tim-nya 18 % lebih rendah dari rata-rata kinerja tim lainnya. Selain itu penyerahan laporan-laporan sering terlambat dan tidak lengkap. Sejauh ini ANDA telah berusaha mengingatkannya tentang masalah tersebut. Untuk itu tindakan kepemimpinan mana yang ANDA anggap (+) atau (-)?',
                    '4' => 'Selama ini bawahan ANDA menunjukkan kematangan, tanggung jawab, dan kecakapan dalam bekerja. Dalam waktu dekat akan ada perubahan besar dalam prosedur kerja di wilayah kerja ANDA. ANDA memperkirakan akan timbul beberapa persoalan yang disebabkan oleh adanya penugasan-penugasan baru terhadap mereka. Manakah tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '5' => 'ANDA diminta untuk memimpin suatu tim yang memiliki kerja sangat rendah. Hubungan antara ANDA dengan bawahan ANDA di tim tersebut ANDA rasakan cukup positif. Untuk bisa mengatasi secara efektif masalah unjuk kerja yang rendah ini, mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '6' => 'ANDA baru saja bergabung dengan perusahaan swasta dengan jabatan manajer. Bawahan ANDA adalah orang-orang berpengalaman dan selama ini memperlihatkan unjuk kerja yang amat baik. Mereka terbiasa memecahkan masalah sendiri. Tiba-tiba mereka menanyakan pada ANDA tentang masalah dalam pekerjaan yang sulit untuk dipecahkan sendiri. Mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '7' => 'Anda memperkenalkan suatu rencana mengenai cara baru dalam pemberian insentif. Namun menimbulkan ketidakpuasan dari pegawai-pegawai yang unjuk kerjanya tidak menonjol. Ini menimbulkan suatu masalah dalam lingkungan kelompok kerja. Mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '8' => 'Salah seorang bawahan ANDA adalah orang baru dan relatif belum berpengalaman. Sikapnya positif dan kelihatannya mempunyai hubungan baik dengan pegawai yang lain. Tetapi unjuk kerjanya rendah dan harus ditingkatkan. Oleh karena itu, mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '9' => 'Salah seoarang bawahan ANDA sebelumnya mempunyai unjuk kerja biasa-biasa saja, tetapi sekarang menunjukkan peningkatan. Pada saat ini ia mengalami kesulitan untuk membuat timnya untuk memenuhi unjuk kerja/target yang ditetapkan. Mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '10' => 'ANDA sedang mencari suatu cara kepemimpinan yang paling efektif untuk digunakan terhadap para bawahan ANDA sehubungan dengan suatu proyek pengembangan mutu produksi yang baru. Proyek ini sangat membutuhkan kreativitas para anggotanya yang selama ini sebetulnya dinilai sebagai kelompok yang sudah matang dan berpengalaman. Jadi cara kepemimpinan yang akan ANDA pilih akan mempengaruhi setiap anggota dalam kelompok kerja ANDA. Untuk itu mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '11' => 'Anggota kelompok kerja ANDA memberi tanggapan yang baik terhadap usaha ANDA yang konstruktif untuk peningkatan unjuk kerja mereka. Tetapi ada masalah kecil yang timbul hingga perlu disusun suatu rencana untuk mencegah jangan sampai unjuk kerja mereka menurun kembali. Mana tindakan kepemimpinan yang ANDA anggap (+) / (-)?',
                    '12' => 'Hubungan ANDA dengan salah seorang bawahan ANDA berjalan cukup baik. Kecakapannya tergolong sedang-sedang saja tetapi saat ini ia mengalami masalah dalam unjuk kerjanya. Mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '13' => 'Salah seoarang bawahan ANDA menunjukkan kemampuan dan tanggung jawab yang tinggi. ANDA menungaskannya untuk menyelesaikan suatu masalah yang selama ini belum pernah ia tangani. Sehubungan dengan hal ini, mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '14' => 'Selama ini ANDA terbiasa membiarkan bawahan untuk memecahkan sendiri masalah-masalah dalam pekerjaan mereka sehari-hari. Belakangan ini, kelihatannya mereka mengalami kesulitan untuk memecahkan beberapa masalah dan ini berpengaruh terhadap kualitas kerja kelompok tersebut. Mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?',
                    '15' => 'Atasan ANDA mendesak untuk segera memecahkan masalah yang berkaitan dengan motivasi dari para pegawai yang timbul dalam beberapa wilayah ANDA. Team leader dari wilayah-wilayah ANDA tersebut adalah orang-orang yang sudah matang dan berpengalaman di bidangnya. Namun masalah yang dihadapkan pada mereka saat ini sifatnya lebih kompleks dari yang biasa dihadapi. Dalam pengalaman-pengalaman yang lalu, pendekatan partisipatif yang ANDA gunakan memberikan hasil yang positif. Mana tindakan kepemimpinan yang ANDA anggap (+) atau (-)?'
                );
                $data['a_jawab'] = array(
                    '' => '',
                    'A' => 'Biarkan BAWAHAN ANDA memecahkan sendiri masalah yang ada.',
                    'B' => 'Menyusun dan memperbaiki standar, tujuan, peran dan tanggung jawab yang ada, kemudian membimbing BAWAHAN ANDA secara ketat.',
                    'C' => 'Memutuskan bagaimana caranya menangani masalah yang ada, dengan terlebih dahulu menerima masukan dari BAWAHAN ANDA.',
                    'D' => 'Bersama dengan BAWAHAN ANDA menganalisa masalah dan mencari suatu cara pemecahan yang baik.',
                    'E' => 'Mengembangkan cara penyelesaian yang paling memungkinkan untuk dijalankan dan mendorong BAWAHAN ANDA untuk menggunakannya.',
                );
                if ($this->input->post()) {

                    foreach ($data['a_soal'] as $key => $jawaban) {

                        $datainput[] = array('id_peserta' => $this->session->userdata('id_peserta'),
                            'soal' => $jawaban,
                            'nosoal' => $key,
                            'jawaban_plus' => $this->input->post('plus' . $key),
                            'ketjawaban_plus' => $data['a_jawab'][$this->input->post('plus' . $key)],
                            'jawaban_minus' => $this->input->post('minus' . $key),
                            'ketjawaban_minus' => $data['a_jawab'][$this->input->post('minus' . $key)],
                            'log_time' => date('Y-m-d H:i:s'),
                            'log_timeinsert' => date('Y-m-d H:i:s'),
                            'log_act' => 'tes-leadership',
                            'log_ip' => $_SERVER['REMOTE_ADDR'],
                            'log_ref' => $this->router->fetch_class() . '/' . $this->router->fetch_method()
                        );
                    }


                    $hasil = $this->m_jawabanleadership->insert_batch($datainput);

                    if ($hasil > 0) {
                        redirect(base_url('front/ketelitian'));
                        //die('ok');
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi kesalahan menyimpan data!');
                    }
                }

                $this->template->load('front1', 'front1/tes_leadership', $data);
            }
        }
    }

    public function papi() {
        if (!$this->session->userdata('namalengkap')) {
            $this->template->load('front1', 'front1/no_token', null);
        } else {
            $this->load->model('m_jawabanpapi');
            $sudahjawab = $this->m_jawabanpapi->get_jawaban_peserta($this->session->userdata('id_peserta'));
            if (!empty($sudahjawab)) {
                $data['jenistes'] = 'PAPI';
                $data['tesselanjutnya'] = base_url('front/disc');
                $this->template->load('front1', 'front1/sudah_tes', $data);
            } else {

                $data['a_soal'] = array('1' => array('a' => 'Saya seorang pekerja keras. ',
                        'b' => 'Saya bukan seorang pemurung.',),
                    '2' => array('a' => 'Saya suka bekerja lebih baik dari yang lain.',
                        'b' => 'Saya suka menekuni pekerjaan yang saya lakukan sampai selesai. ',),
                    '3' => array('a' => 'Saya suka memberi petunjuk kepada orang bagaimana melakukan sesuatu. ',
                        'b' => 'Saya ingin membuat semaksimal mungkin. ',),
                    '4' => array('a' => 'Saya suka melakukan hal-hal yang lucu. ',
                        'b' => 'Saya suka memberitahukan orang apa yang harus dikerjakan. ',),
                    '5' => array('a' => 'Saya suka bergabung dengan kelompok. ',
                        'b' => 'Saya suka diperhatikan oleh kelompok. ',),
                    '6' => array('a' => 'Saya cepat berubah jika saya rasa diperlukan. ',
                        'b' => 'Saya suka berteman dengan suatu kelompok. ',),
                    '7' => array('a' => 'Saya cepat berubah jika saya rasa diperlukan. ',
                        'b' => 'Saya berusaha membuat teman-teman pribadi yang dekat. ',),
                    '8' => array('a' => 'Saya suka membalas jika saya disakiti. ',
                        'b' => 'Saya suka melakukan hal-hal yang baru dan berbeda. ',),
                    '9' => array('a' => 'Saya ingin agar atasan saya menyukai saya. ',
                        'b' => 'Saya memberitahu orang jika mereka salah. ',),
                    '10' => array('a' => 'Saya suka mengikuti petunjuk-petunjuk yang diberikan kepada saya. ',
                        'b' => 'Saya suka mendukung pendapat atasan saya. ',),
                    '11' => array('a' => 'Saya berusaha sangat keras. ',
                        'b' => 'Saya seorang yang teratur, Saya menaruh barang pada tempatnya. ',),
                    '12' => array('a' => 'Saya dapat membuat orang melakukan apa yang saya inginkan. ',
                        'b' => 'Saya mudah marah. ',),
                    '13' => array('a' => 'Saya memberitahukan kepada kelompok apa yang harus mereka kerjakan. ',
                        'b' => 'Saya selalu menekuni suatu pekerjaan sampai selesai. ',),
                    '14' => array('a' => 'Saya ingin tampil menarik dan mendebarkan. ',
                        'b' => 'Saya ingin menjadi orang yang sangat berhasil. ',),
                    '15' => array('a' => 'Saya ingin sesuai dan diterima dalam kelompok. ',
                        'b' => 'Saya suka membantu orang dalam mengambil keputusan. ',),
                    '16' => array('a' => 'Saya cemas bila seseorang tidak menyukai saya.',
                        'b' => 'Saya suka orang memperhatikan saya. ',),
                    '17' => array('a' => 'Saya suka mencoba hal-hal baru. ',
                        'b' => 'Saya lebih suka bekerja bersama oranglain daripada sendiri. ',),
                    '18' => array('a' => 'Saya kadang-kadang menyalahkan orang lain jika terjadi kesalahan. ',
                        'b' => 'Saya merasa terganggu jika tidak ada yang menyukai saya. ',),
                    '19' => array('a' => 'Saya suka mendukung pendapat atasan saya. ',
                        'b' => 'Saya suka mencoba pekerjaan-pekerjaan yang baru dan berbeda. ',),
                    '20' => array('a' => 'Saya menyukai petunjuk-petunjuk terperinci dalam menyelesaikan pekerjaan. ',
                        'b' => 'Bila terganggu oleh siapapun, Saya akan memberitahukannya. ',),
                    '21' => array('a' => 'Saya suka melaksanakan tugas setiap langkah dengan hati-hati. ',
                        'b' => 'Saya selalu berusaha keras . ',),
                    '22' => array('a' => 'Saya benar-benar pemimpin yang baik. ',
                        'b' => 'Saya dapat mengorganisir suatu pekerjaan dengan baik. ',),
                    '23' => array('a' => 'Saya mudah tersinggung. ',
                        'b' => 'Saya lambat membuat keputusan. ',),
                    '24' => array('a' => 'Bila saya berada dalam satu kelompok, saya suka berdiam diri. ',
                        'b' => 'Saya suka mengerjakan beberapa pekerjaan sekaligus. ',),
                    '25' => array('a' => 'Saya sangat suka bila saya diundang. ',
                        'b' => 'Saya ingin lebih baik dari yang lain dalam mengerjakan sesuatu. ',),
                    '26' => array('a' => 'Saya suka membuat teman-teman pribadi yang dekat. ',
                        'b' => 'Saya suka menasehati orang. ',),
                    '27' => array('a' => 'Saya suka melakukan hal-hal baru dan berbeda. ',
                        'b' => 'Saya suka menceritakan bagaimana saya berhasil dalam melakukan sesuatu. ',),
                    '28' => array('a' => 'Bila saya betul, Saya suka mempertahankannya. ',
                        'b' => 'Saya ingin diterima dan diakui dalam suatu kelompok.',),
                    '29' => array('a' => 'Saya menghindar menjadi seorang yang berbeda. ',
                        'b' => 'Saya berusaha menjadi sangat dekat dengan orang. ',),
                    '30' => array('a' => 'Saya senang diberitahu bagaimana melakukan sesuatu pekerjaan. ',
                        'b' => 'Saya mudah bosan. ',),
                    '31' => array('a' => 'Saya bekerja keras. ',
                        'b' => 'Saya banyak berpikir dan merencana. ',),
                    '32' => array('a' => 'Saya memimpin kelompok. ',
                        'b' => 'Detail (hal-hal kecil) menarik bagi saya. ',),
                    '33' => array('a' => 'Saya dapat mengambil keputusan secara mudah dan tepat. ',
                        'b' => 'Saya menyimpan barang-barang saya secara rapi dan teratur.',),
                    '34' => array('a' => 'Saya cepat dalam melaksanakan suatu pekerjaan. ',
                        'b' => 'Saya tidak sering marah atau sedih. ',),
                    '35' => array('a' => 'Saya ingin menjadi bagian dari kelompok. ',
                        'b' => 'Saya hanya ingin melakukan satu pekerjaan pada satu saat. ',),
                    '36' => array('a' => 'Saya berusaha membuat teman dekat. ',
                        'b' => 'Saya berusaha keras menjadi yang terbaik ',),
                    '37' => array('a' => 'Saya suka mode terbaru untuk pakaian dan mobil. ',
                        'b' => 'Saya suka bertanggung jawab untuk kepentingan orang lain. ',),
                    '38' => array('a' => 'Saya menyukai perdebatan. ',
                        'b' => 'Saya suak mendapat perhatian. ',),
                    '39' => array('a' => 'Saya suka mendukung orang-orang yang menjadi atasan saya. ',
                        'b' => 'Saya tertarik menjadi bagian dari kelompok. ',),
                    '40' => array('a' => 'Saya suka mengikuti peraturan dengan hati-hati. ',
                        'b' => 'Saya suka orang  mengenal saya  dengan baik. ',),
                    '41' => array('a' => 'Saya benar-benar pekerja keras. ',
                        'b' => 'Saya mempunyai sifat bersahabat. ',),
                    '42' => array('a' => 'Orang berpendapat bahwa saya benar-benar seorang pemimpin yang baik. ',
                        'b' => 'Saya berpikir panjang dan berhati-hati.',),
                    '43' => array('a' => 'Saya sering mengambil kesempatan. ',
                        'b' => 'Saya senang mengurus hal-hal kecil. ',),
                    '44' => array('a' => 'Orang berpendapat bahwa saya bekerja cepat. ',
                        'b' => 'Orang berpendapat bahwa saya rapi dan teratur. ',),
                    '45' => array('a' => 'Saya senang berolah raga. ',
                        'b' => 'Saya mempunyai pribadi yang menyenangkan. ',),
                    '46' => array('a' => 'Saya senang jika orang dekat dan bersahabat dengan saya. ',
                        'b' => 'Saya selalu berusaha untuk menyelesaikan sesuatu yang telah saya mulai. ',),
                    '47' => array('a' => 'Saya senang bereksperimen dan mencoba hal-hal baru.',
                        'b' => 'Saya suka melaksanakan suatu pekerjaan sulit dengan baik. ',),
                    '48' => array('a' => 'Saya suka diperlakukan secara adil.',
                        'b' => 'Saya suka memberitahu orang lain bagaimana melaksanakan sesuatu. ',),
                    '49' => array('a' => 'Saya suka melakukan apa yang diharapkan dari saya. ',
                        'b' => 'Saya suka memperoleh perhatian. ',),
                    '50' => array('a' => 'Saya suka petunjuk-petunjuk terinci dalam melaksanakan suatu pekerjaan. ',
                        'b' => 'Saya suka berada diantara orang-orang banyak. ',),
                    '51' => array('a' => 'Saya selalu berusaha menyelesaikan pekerjaan secara sempurna.',
                        'b' => 'Orang mengatakan bahwa saya tidak mengenal lelah. ',),
                    '52' => array('a' => 'Saya tipe pemimpin.',
                        'b' => 'Saya mudah berteman. ',),
                    '53' => array('a' => 'Saya selalu berspekulasi. ',
                        'b' => 'Saya banyak sekali berpikir. ',),
                    '54' => array('a' => 'Saya bekerja dengan kecepatan yang teratur. ',
                        'b' => 'Saya senang bekerja dengan hal-hal yang kecil / terperinci. ',),
                    '55' => array('a' => 'Saya mempunyai banyak tenaga untuk berolahraga. ',
                        'b' => 'Saya menyimpan barang-barang saya secara rapi dan teratur.',),
                    '56' => array('a' => 'Saya dapat bergaul dengan baik terhadap semua orang. ',
                        'b' => 'Saya seorang yang mempunyai pembawaan yang tenang (even tempered). ',),
                    '57' => array('a' => 'Saya ingin bertemu dengan orang-orang baru dan melakukan hal yang baru. ',
                        'b' => 'Saya selalu ingin menyelesaikan pekerjaan yang telah saya mulai. ',),
                    '58' => array('a' => 'Saya biasanya mempertahankan pendapat yang saya yakini. ',
                        'b' => 'Saya biasanya suka bekerja keras. ',),
                    '59' => array('a' => 'Saya suka saran-saran dari orang-orang yang saya kagumi. ',
                        'b' => 'Saya suka melayani orang-orang yang berwenang terhadap saya. ',),
                    '60' => array('a' => 'Saya biarkan diri saya banyak dipengaruhi oleh orang lain.',
                        'b' => 'Saya suka jika mendapat banyak perhatian. ',),
                    '61' => array('a' => 'Saya berusaha bekerja keras. ',
                        'b' => 'Saya mengerjakan sesuatu dengan cepat. ',),
                    '62' => array('a' => 'Apabila saya berbicara, kelompok mendengarkan saya. ',
                        'b' => 'Saya trampil dengan perkakas (alat-alat) ',),
                    '63' => array('a' => 'Saya lambat dalam mendapatkan teman. ',
                        'b' => 'Saya lambat dalam mengambil keputusan.',),
                    '64' => array('a' => 'Saya biasanya makan secara tepat. ',
                        'b' => 'Saya suka membaca. ',),
                    '65' => array('a' => 'Saya suka pekerjaan dimana saya suka bergerak. ',
                        'b' => 'Saya suka pekerjaan yang dilaksanakan secara hati-hati. ',),
                    '66' => array('a' => 'Saya membuat sebanyak mungkin teman. ',
                        'b' => 'Apa yang telah saya simpan, akan muda saya temukan kembali. ',),
                    '67' => array('a' => 'Saya merencanakan jauh-jauh sebelumnya. ',
                        'b' => 'saya selalu menyenangkan. ',),
                    '68' => array('a' => 'Saya mempertahankan dengan bangga nama baik saya. ',
                        'b' => 'Saya terus menekuni satu masalah sampai selesai. ',),
                    '69' => array('a' => 'Saya suka mendukung orang-orang yang saya kagumi. ',
                        'b' => 'Saya ingin sukses. ',),
                    '70' => array('a' => 'Saya suka orang lain membuat keputusan-keputusan untuk kelompok. ',
                        'b' => 'Saya suka mengambil keputusan-keputusan untuk kelompok. ',),
                    '71' => array('a' => 'Saya selalu berusaha bekerja keras. ',
                        'b' => 'Saya mengambil keputusan secara cepat dan mudah. ',),
                    '72' => array('a' => 'Kelompok biasanya melakukan apa yang saya inginkan. ',
                        'b' => 'Saya terbiasa terburu-buru.',),
                    '73' => array('a' => 'Saya sering merasa lelah. ',
                        'b' => 'Saya lamban dalam mengambil sutau keputusan. ',),
                    '74' => array('a' => 'Saya bekerja cepat. ',
                        'b' => 'Saya mudah berteman. ',),
                    '75' => array('a' => 'Saya biasanya mempunyai gairah dan tenaga. ',
                        'b' => 'Saya banyak menghabiskan waktu untuk berpikir. ',),
                    '76' => array('a' => 'Saya sangat ramah terhadap orang. ',
                        'b' => 'Saya sangat suka pekerjaan yang memerlukan ketelitian. ',),
                    '77' => array('a' => 'Saya banyak berpikir dan merencana. ',
                        'b' => 'Saya menyimpan segala sesuatu pada tempatnya. ',),
                    '78' => array('a' => 'Saya suka pekerjaan yang menuntut hal-hal yang terperinci. ',
                        'b' => 'Saya tidak mudah marah. ',),
                    '79' => array('a' => 'Saya suka mengikuti orang yang saya kagumi. ',
                        'b' => 'Saya selalu menyelesaikan pekerjaan yang telah saya mulai.',),
                    '80' => array('a' => 'Saya suka petunjuk yang jelas ',
                        'b' => 'Saya suka bekerja keras. ',),
                    '81' => array('a' => 'Saya mengejar apa yang saya inginkan. ',
                        'b' => 'Saya seorang pemimpin yang baik. ',),
                    '82' => array('a' => 'Saya dapat membuat orang lain bekerja sesuai dengan apa yang saya inginkan. ',
                        'b' => 'Saya orang yang bertipe santai tapi beruntung. ',),
                    '83' => array('a' => 'Saya mengambil keputusan secara cepat.',
                        'b' => 'Saya bicara dengan cepat. ',),
                    '84' => array('a' => 'Saya biasanya bekerja cepat. ',
                        'b' => 'Saya berolahraga secara teratur. ',),
                    '85' => array('a' => 'Saya tidak suka bertemu orang. ',
                        'b' => 'Saya cepat merasa lelah. ',),
                    '86' => array('a' => 'Saya membuat banyak sekali teman. ',
                        'b' => 'Saya banyak menghabiskan waktu dengan berpikir. ',),
                    '87' => array('a' => 'Saya suka bekerja dengan teori. ',
                        'b' => 'Saya suka bekerja dengan hal-hal yang terperinci. ',),
                    '88' => array('a' => 'Saya dapat menikmati hal-hal / pekerjaan yang terperinci. ',
                        'b' => 'Saya suka mengorganisir pekerjaan saya. ',),
                    '89' => array('a' => 'Saya menaruh barang pada tempatnya. ',
                        'b' => 'Saya selalu menyenangkan. ',),
                    '90' => array('a' => 'Saya suka diberitahu tentang apa yang perlu saya lakukan. ',
                        'b' => 'Saya harus menyelesaikan apa yang saya mulai. ',)
                );

                if ($this->input->post()) {

                    foreach ($data['a_soal'] as $nomor => $pilihanganda) {

                        foreach ($pilihanganda as $abjad => $deskripsi) {

                            $abjadjawaban = ($this->input->post('soal' . $nomor) == $abjad) ? '1' : '0';

                            $datainput[] = array('id_peserta' => $this->session->userdata('id_peserta'),
                                'soal' => $deskripsi,
                                'abjadsoal' => $abjad,
                                'kelompok' => $nomor,
                                'jawaban' => $abjadjawaban,
                                'jenis' => '',
                                'log_time' => date('Y-m-d H:i:s'),
                                'log_timeinsert' => date('Y-m-d H:i:s'),
                                'log_act' => 'jawab-papi',
                                'log_ip' => $_SERVER['REMOTE_ADDR'],
                                'log_ref' => $this->router->fetch_class() . '/' . $this->router->fetch_method()
                            );
                        }
                    }

                    $hasil = $this->m_jawabanpapi->insert_batch($datainput);

                    if ($hasil > 0) {
                        redirect(base_url('front/disc'));
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi kesalahan menyimpan data!');
                    }
                }

                $this->template->load('front1', 'front1/tes_papi', $data);
            }
        }
    }

    public function disc() {
        if (!$this->session->userdata('namalengkap')) {
            $this->template->load('front1', 'front1/no_token', null);
        } else {

            $this->load->model('m_jawabandisc');
            $sudahjawab = $this->m_jawabandisc->get_jawaban_peserta($this->session->userdata('id_peserta'));
            if (!empty($sudahjawab)) {
                $data['jenistes'] = 'DISC';
                $data['tesselanjutnya'] = base_url('front/belbin');
                $this->template->load('front1', 'front1/sudah_tes', $data);
            } else {
                $data['a_soal'] = array(
                    '1' => array('Gampangan, Mudah setuju',
                        'Percaya, Mudah percaya pada orang',
                        'Petualang, Mengambil resiko',
                        'Toleran, Menghormati',
                    ),
                    '2' => array(
                        'Lembut suara, Pendiam',
                        'Optimistik, Visioner',
                        'Pusat Perhatian, Suka gaul',
                        'Pendamai, Membawa Harmoni',
                    ),
                    '3' => array(
                        'Menyemangati orang',
                        'Berusaha sempurna',
                        'Bagian dari kelompok',
                        'Ingin membuat tujuan',
                    ),
                    '4' => array(
                        'Menjadi frustrasi',
                        'Menyimpan perasaan saya',
                        'Menceritakan sisi saya',
                        'Siap beroposisi',
                    ),
                    '5' => array(
                        'Hidup, Suka bicara',
                        'Gerak cepat, Tekun',
                        'Usaha menjaga keseimbangan',
                        'Usaha mengikuti aturan',
                    ),
                    '6' => array(
                        'Kelola waktu secara efisien',
                        'Sering terburu-buru, Merasa tertekan',
                        'Masalah sosial itu penting',
                        'Suka selesaikan apa yang saya mulai',
                    ),
                    '7' => array(
                        'Tolak perubahan mendadak',
                        'Cenderung janji berlebihan',
                        'Tarik diri di tengah tekanan',
                        'Tidak takut bertempur',
                    ),
                    '8' => array(
                        'Penyemangat yang baik',
                        'Pendengar yang baik',
                        'Penganalisa yang baik',
                        'Delegator yang baik',
                    ),
                    '9' => array('Hasil adalah penting',
                        'Lakukan dengan benar, Akurasi penting',
                        'Dibuat menyenangkan',
                        'Mari kerjakan bersama',
                    ),
                    '10' => array(
                        'Akan berjalan terus tanpa kontrol diri',
                        'Akan membeli sesuai dorongan hati',
                        'Akan menunggu, Tanpa tekanan',
                        'Akan mengusahakan  yang kuinginkan',
                    ),
                    '11' => array(
                        'Ramah, Mudah bergabung',
                        'Unik, Bosan rutinitas',
                        'Aktif mengubah sesuatu',
                        'Ingin hal-hal yang pasti',
                    ),
                    '12' => array(
                        'Non-konfrontasi, Menyerah',
                        'Dipenuhi hal detail',
                        'Perubahan pada menit terakhir',
                        'Menuntut, Kasar',
                    ),
                    '13' => array(
                        'Ingin kemajuan',
                        'Puas dengan segalanya',
                        'Terbuka memperlihatkan perasaan',
                        'Rendah hati, Sederhana',
                    ),
                    '14' => array(
                        'Tenang, Pendiam',
                        'Bahagia, Tanpa beban',
                        'Menyenangkan, Baik hati',
                        'Tak gentar, Berani',
                    ),
                    '15' => array(
                        'Menggunakan waktu berkualitas dgn teman',
                        'Rencanakan masa depan, Bersiap',
                        'Bepergian demi petualangan baru',
                        'Menerima ganjaran atas tujuan yg dicapai',
                    ),
                    '16' => array(
                        'Aturan perlu dipertanyakan',
                        'Aturan membuat adil',
                        'Aturan membuat bosan',
                        'Aturan membuat aman',
                    ),
                    '17' => array('Pendidikan, Kebudayaan',
                        'Prestasi, Ganjaran',
                        'Keselamatan, keamanan',
                        'Sosial, Perkumpulan kelompok',
                    ),
                    '18' => array(
                        'Memimpin, Pendekatan langsung',
                        'Suka bergaul, Antusias',
                        'Dapat diramal, Konsisten',
                        'Waspada, Hati-hati',
                    ),
                    '19' => array(
                        'Tidak mudah dikalahkan',
                        'Kerjakan sesuai perintah, Ikut pimpinan',
                        'Mudah terangsang, Riang',
                        'Ingin segalanya teratur, Rapi',
                    ),
                    '20' => array(
                        'Saya akan pimpin mereka',
                        'Saya akan melaksanakan',
                        'Saya akan meyakinkan mereka',
                        'Saya dapatkan fakta',
                    ),
                    '21' => array(
                        'Memikirkan orang dahulu',
                        'Kompetitif, Suka tantangan',
                        'Optimis, Positif',
                        'Pemikir logis, Sistematik',
                    ),
                    '22' => array(
                        'Menyenangkan orang, Mudah setuju',
                        'Tertawa lepas, Hidup',
                        'Berani, Tak gentar',
                        'Tenang, Pendiam',
                    ),
                    '23' => array(
                        'Ingin otoritas lebih',
                        'Ingin kesempatan baru',
                        'Menghindari konflik',
                        'Ingin petunjuk yang jelas',
                    ),
                    '24' => array(
                        'Dapat diandalkan, Dapata dipercaya',
                        'Kreatif, Unik',
                        'Garis dasar, Orientasi hasil',
                        'Jalankan standar yang tinggi, Akurat',
                    ),
                );

                if ($this->input->post()) {

                    foreach ($data['a_soal'] as $nomor => $soal) {

                        foreach ($soal as $urutsoal => $deskripsi) {

                            //P
                            $jawaban = ($this->input->post('soal' . $nomor . 'P') == 'P|' . $nomor . '|' . $urutsoal) ? '1' : '0';
                            $datainput[] = array('id_peserta' => $this->session->userdata('id_peserta'),
                                'jenissoal' => 'P',
                                'urutsoal' => $urutsoal,
                                'soal' => $deskripsi,
                                'kelompok' => $nomor,
                                'jawaban' => $jawaban,
                                'jenis' => '',
                                'log_time' => date('Y-m-d H:i:s'),
                                'log_timeinsert' => date('Y-m-d H:i:s'),
                                'log_act' => 'jawab-disc',
                                'log_ip' => $_SERVER['REMOTE_ADDR'],
                                'log_ref' => $this->router->fetch_class() . '/' . $this->router->fetch_method()
                            );

                            //K
                            $jawaban = ($this->input->post('soal' . $nomor . 'K') == 'K|' . $nomor . '|' . $urutsoal) ? '1' : '0';
                            $datainput[] = array('id_peserta' => $this->session->userdata('id_peserta'),
                                'jenissoal' => 'K',
                                'urutsoal' => $urutsoal,
                                'soal' => $deskripsi,
                                'kelompok' => $nomor,
                                'jawaban' => $jawaban,
                                'jenis' => '',
                                'log_time' => date('Y-m-d H:i:s'),
                                'log_timeinsert' => date('Y-m-d H:i:s'),
                                'log_act' => 'jawab-disc',
                                'log_ip' => $_SERVER['REMOTE_ADDR'],
                                'log_ref' => $this->router->fetch_class() . '/' . $this->router->fetch_method()
                            );
                        }
                    }

                    $hasil = $this->m_jawabandisc->insert_batch($datainput);

                    if ($hasil > 0) {
                        redirect(base_url('front/belbin'));
                        //die('ok');
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi kesalahan menyimpan data!');
                    }
                }

                $this->template->load('front1', 'front1/tes_disc', $data);
            }
        }
    }

    public function ketelitiancontoh() {
        if (!$this->session->userdata('namalengkap')) {
            $this->template->load('front1', 'front1/no_token', null);
        } else {

            $this->load->model('m_jawabanketelitiancontoh');
            $sudahjawab = $this->m_jawabanketelitiancontoh->get_jawaban_peserta($this->session->userdata('id_peserta'));
            if (!empty($sudahjawab)) {
                $data['jenistes'] = 'TRIAL TES KETELITIAN';
                $data['tesselanjutnya'] = base_url('front/ketelitian');
                $this->template->load('front1', 'front1/sudah_tes', $data);
            } else {
                //print_r($this->input->post);die();
                if ($this->input->post()) {

                    for ($i = 1; $i <= 20; $i++) {

                        $datainput[] = array(
                            'id_peserta' => $this->session->userdata('id_peserta'),
                            'nosoal' => $i,
                            'jawaban' => $this->input->post('soal' . $i),
                            'log_time' => date('Y-m-d H:i:s'),
                            'log_timeinsert' => date('Y-m-d H:i:s'),
                            'log_act' => 'tes-ketelitancontoh',
                            'log_ip' => $_SERVER['REMOTE_ADDR'],
                            'log_ref' => $this->router->fetch_class() . '/' . $this->router->fetch_method()
                        );
                    }
                    $hasil = $this->m_jawabanketelitiancontoh->insert_batch($datainput);
                    if ($hasil > 0) {
                        redirect(base_url('front/ketelitian'));
                        //die('ok');
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi kesalahan menyimpan data!');
                    }

                    //$this->template->load('front1', 'front1/tes_ketelitian', null);
                }
                $this->template->load('front1', 'front1/tes_ketelitiancontoh', null);
            }
        }
    }

    public function ketelitian() {
        if (!$this->session->userdata('namalengkap')) {
            $this->template->load('front1', 'front1/no_token', null);
        } else {
            $this->load->model('m_jawabanketelitian');
            $sudahjawab = $this->m_jawabanketelitian->get_jawaban_peserta($this->session->userdata('id_peserta'));
            if (!empty($sudahjawab)) {
                $data['jenistes'] = 'KETELITIAN';
                $data['tesselanjutnya'] = base_url('front/endtest');
                $this->template->load('front1', 'front1/sudah_tes', $data);
            } else {
                if ($this->input->post()) {

                    for ($i = 1; $i <= 100; $i++) {

                        $datainput[] = array(
                            'id_peserta' => $this->session->userdata('id_peserta'),
                            'nosoal' => $i,
                            'jawaban' => $this->input->post('soal' . $i),
                            'log_time' => date('Y-m-d H:i:s'),
                            'log_timeinsert' => date('Y-m-d H:i:s'),
                            'log_act' => 'tes-ketelitancontoh',
                            'log_ip' => $_SERVER['REMOTE_ADDR'],
                            'log_ref' => $this->router->fetch_class() . '/' . $this->router->fetch_method()
                        );
                    }
                    $hasil = $this->m_jawabanketelitian->insert_batch($datainput);
                    if ($hasil > 0) {
                        redirect(base_url('front/endtest'));
                        //die('ok');
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi kesalahan menyimpan data!');
                    }

                    //$this->template->load('front1', 'front1/tes_ketelitian', null);
                }
                $this->template->load('front1', 'front1/tes_ketelitian', null);
            }
        }
    }
    
    public function endtest(){
        $this->session->sess_destroy();
        $this->template->load('front1', 'front1/sudah_semuates', null);
    }

}
