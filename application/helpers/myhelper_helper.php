<?php

if (!function_exists('create_image')) {

    function create_image($folder, $file, $class = "img-thumbnail", $width = 200, $style='') {
        $baseurl = base_url();
        if ($file == '' || !file_exists("./$folder/$file")) {
            $folder = 'assets/images';
            $file = 'no-foto.png';
        }
        $image = "<img src='$baseurl$folder/$file' class='$class' width='$width' alt='$file' style='$style'>";

        return $image;
    }

    function gate_check($controller = '') {
        $CI = & get_instance();
        $akseshalaman = array();
        if (!$CI->session->userdata('id_user')) {
            redirect(base_url());
            die();
        } else {
            $approved = false;
            $a_role = $CI->session->userdata('role');
            //print_r($a_role);die();
            foreach ($a_role as $key => $value) {
                $urlsession = explode("|", $key)[1];
                    
                //view
                if ($urlsession == $CI->uri->segment(1) && $value['v'] == 1) {
                    $approved = true;
                    $akseshalaman = $value;
                    if ($controller == '') {
                        $controller = $urlsession;
                    }
                    //echo $CI->uri->segment(2).''.$controller;
                    if (($CI->uri->segment(2) == 'datatable' . $controller) && ($value['v'] != 1)) {
                        $approved = false;
                    }
                    if (($CI->uri->segment(2) == 'tambah' . $controller) && ($value['i'] != 1)) {
                        $approved = false;
                    }
                    if (($CI->uri->segment(2) == 'ubah' . $controller) && ($value['u'] != 1)) {
                        $approved = false;
                    }
                    if (($CI->uri->segment(2) == 'hapus' . $controller) && ($value['d'] != 1)) {
                        $approved = false;
                    }
                }
            }
            if (!$approved) {
                redirect(base_url('error404/denied'));
                die();
            }
        }
        return($akseshalaman);
    }

    function create_buttonlist($id, $urledit, $is_edit, $is_delete) {
        $CI = & get_instance();
        $CI->load->library('urlencrypt');
        $button = '';
        if ($is_edit) {
            $button .= '<a href="' . base_url($urledit) . '/' . $CI->urlencrypt->encode($id) . '" title="edit"><button type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button></a> ';
        }

        if ($is_delete) {
            $button .= ' &nbsp; <a  onclick="hapusdata(' . "'" . $CI->urlencrypt->encode($id) . "'" . ')" title="hapus"><button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button></a>';
        }
        return $button;
    }

    function tgl_indo($tgl,$denganjam=true){
  $tanggal = substr($tgl,8,2);
  $bulan = getBulan(substr($tgl,5,2));
  $tahun = substr($tgl,0,4);
  $jam = substr($tgl,11,2);
  $menit = substr($tgl,14,2);
  if($denganjam&&$jam!='')
	return "$tanggal $bulan $tahun, jam $jam:$menit";  
  else
	return "$tanggal $bulan $tahun"; 
}

    
function getBulan($bln){
  switch ($bln){
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "April";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
    }
 }
 
    function terbilang($nilai) {
            $nilai = abs($nilai);
            $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
            $temp = "";
            if ($nilai < 12) {
                    $temp = "". $huruf[$nilai];
            } else if ($nilai <20) {
                    $temp = terbilang($nilai - 10). " belas";
            } else if ($nilai < 100) {
                    $temp = terbilang($nilai/10)." puluh". terbilang($nilai % 10);
            } else if ($nilai < 200) {
                    $temp = " seratus" . terbilang($nilai - 100);
            } else if ($nilai < 1000) {
                    $temp = terbilang($nilai/100) . " ratus" . terbilang($nilai % 100);
            } else if ($nilai < 2000) {
                    $temp = " seribu" . terbilang($nilai - 1000);
            } else if ($nilai < 1000000) {
                    $temp = terbilang($nilai/1000) . " ribu" . terbilang($nilai % 1000);
            } else if ($nilai < 1000000000) {
                    $temp = terbilang($nilai/1000000) . " juta" . terbilang($nilai % 1000000);
            } else if ($nilai < 1000000000000) {
                    $temp = terbilang($nilai/1000000000) . " milyar" . terbilang(fmod($nilai,1000000000));
            } else if ($nilai < 1000000000000000) {
                    $temp = terbilang($nilai/1000000000000) . " trilyun" . terbilang(fmod($nilai,1000000000000));
            }     
            return $temp;
    }
    
    
    
    function FormatRupiah($angka) {
        $desimal = 0;
        $pemisahdesimal = ",";
        $pemisahribuan = ".";
        return "Rp " . number_format($angka, $desimal, $pemisahdesimal, $pemisahribuan) . ",-";
    }

}
