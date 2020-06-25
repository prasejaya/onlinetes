<!DOCTYPE html>
<html>
    <head>
        <title>Cetak Formulir</title>
        <style>
            body {
                background: rgb(204,204,204); 
                font-family: Arial, Helvetica, sans-serif;
            }
            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
            }
            page[size="A4"] {  
                width: 21cm;
                height: 29.7cm; 
            }
            page[size="A4"][layout="landscape"] {
                width: 29.7cm;
                height: 21cm;  
            }
            page[size="A3"] {
                width: 29.7cm;
                height: 42cm;
            }
            page[size="A3"][layout="landscape"] {
                width: 42cm;
                height: 29.7cm;  
            }
            page[size="A5"] {
                width: 14.8cm;
                height: 21cm;
            }
            page[size="A5"][layout="landscape"] {
                width: 21cm;
                height: 14.8cm;  
            }
            @media print {
                body, page {
                    margin: 0;
                    box-shadow: none;
                    background: white;
                }
            }

              hr.style1{
                      border-top: 1px solid #8c8b8b;
              }


              hr.style2 {
                      border-top: 3px double #8c8b8b;
              }

              hr.style3 {
                      border-top: 1px dashed #8c8b8b;
              }

              hr.style4 {
                      border-top: 1px dotted #8c8b8b;
              }

              hr.style5 {
                      background-color: #fff;
                      border-top: 2px dashed #8c8b8b;
              }


              hr.style6 {
                      background-color: #fff;
                      border-top: 2px dotted #8c8b8b;
              }

              hr.style7 {
                      border-top: 1px solid #8c8b8b;
                      border-bottom: 1px solid #fff;
              }


              hr.style8 {
                      border-top: 1px solid #8c8b8b;
                      border-bottom: 1px solid #fff;
              }
              hr.style8:after {
                      content: '';
                      display: block;
                      margin-top: 2px;
                      border-top: 1px solid #8c8b8b;
                      border-bottom: 1px solid #fff;
              }

              hr.style9 {
                      border-top: 1px dashed #8c8b8b;
                      border-bottom: 1px dashed #fff;
              }

              hr.style10 {
                      border-top: 1px dotted #8c8b8b;
                      border-bottom: 1px dotted #fff;
              }


              hr.style11 {
                      height: 6px;
                      background: url(http://ibrahimjabbari.com/english/images/hr-11.png) repeat-x 0 0;
                  border: 0;
              }


              hr.style12 {
                      height: 6px;
                      background: url(http://ibrahimjabbari.com/english/images/hr-12.png) repeat-x 0 0;
                  border: 0;
              }

              hr.style13 {
                      height: 10px;
                      border: 0;
                      box-shadow: 0 10px 10px -10px #8c8b8b inset;
              }


              hr.style14 { 
                border: 0; 
                height: 1px; 
                background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
                background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
                background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
                background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
              }


              hr.style15 {
                      border-top: 4px double #8c8b8b;
                      text-align: center;
              }
              hr.style15:after {
                      content: '\002665';
                      display: inline-block;
                      position: relative;
                      top: -15px;
                      padding: 0 10px;
                      background: #f0f0f0;
                      color: #8c8b8b;
                      font-size: 18px;
              }

              hr.style16 { 
                border-top: 1px dashed #8c8b8b; 
              } 
              hr.style16:after { 
                content: '\002702'; 
                display: inline-block; 
                position: relative; 
                top: -12px; 
                left: 40px; 
                padding: 0 3px; 
                background: #f0f0f0; 
                color: #8c8b8b; 
                font-size: 18px; 
              }


              hr.style17 {
                      border-top: 1px solid #8c8b8b;
                      text-align: center;
              }
              hr.style17:after {
                      content: '§';
                      display: inline-block;
                      position: relative;
                      top: -14px;
                      padding: 0 10px;
                      background: #f0f0f0;
                      color: #8c8b8b;
                      font-size: 18px;
                      -webkit-transform: rotate(60deg);
                      -moz-transform: rotate(60deg);
                      transform: rotate(60deg);
              }


              hr.style18 { 
                height: 30px; 
                border-style: solid; 
                border-color: #8c8b8b; 
                border-width: 1px 0 0 0; 
                border-radius: 20px; 
              } 
              hr.style18:before { 
                display: block; 
                content: ""; 
                height: 30px; 
                margin-top: -31px; 
                border-style: solid; 
                border-color: #8c8b8b; 
                border-width: 0 0 1px 0; 
                border-radius: 20px; 
              }

        </style>
    </head>
<!--    <body onload="window.print()">-->
<body>
    <page size="A4">
        <table style="height: 2cm; width: 100%; margin-left: 1.5cm">
            <tbody>
                <tr>
                    <td >
                        <img style="float: left; position: absolute; width: 3cm;" src="<?= base_url() . 'uploads/images/logoypi.png' ?>"/>
                        <strong >
                            <p style="text-align: center; margin: 0px; font-size: 14pt">YAYASAN PENDIDIKAN ISLAM</p>
                            <p style="text-align: center; margin: 0px; font-size: 20pt">YPI DARUSSALAM CERME - GRESIK</p>
                        </strong>
                            <p style="text-align: center; margin: 0px;">AKTE NO.43/2008 SK.MENKUMHAM RI NO.AHU-48 34.AH.01.02. Tahun 2008<br>
                                ALAMAT: JL. RAYA PASAR CERME LOR NO. 12 CERME GRESIK<br>
                                TELP. (031) 7992120 FAX. (031) 799095</p>
                        
                    </td>
                </tr>
            </tbody>
        </table>
        <hr class="style8" />

        <strong>
            <p style="text-align: center; margin: 0px; font-size: 14pt"><u>FORMULIR PENDAFTARAN PESERTA DIDIK BARU</u></p>
        </strong>
        <br>
        <table style="width:80%;margin:0px auto;padding:0px;">
            <tbody>
                <tr>
                    <td colspan="3" style="text-align:right;">
                       
                        NO. &nbsp;<p style="border-style: solid; width:4cm; float:right; margin-top:0px;">&nbsp;<?= $datapendaftar['kodependaftar']?></p>
                        <?= create_image('uploads/foto', $datapendaftar['foto'],null,null,'float: left; width: 4cm; border: 1px solid #ddd; border-radius: 4px;')?>
<!--                     <img style="float: left; width: 3cm; border: 1px solid #ddd; border-radius: 4px;" src="<?= base_url() . 'uploads/foto/logoypi.png' ?>"/>
                        -->
                    </td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>I IDENTITAS CALON SISWA</strong></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm; width: 6cm;">1. Nama Lengkap</td>
                    <td>:</td>
                    <td><?= $datapendaftar['nama']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">2. Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= $datapendaftar['jk']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">3. Tempat dan Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= $datapendaftar['tmplahir']?>, <?= tgl_indo($datapendaftar['kodependaftar'],false)?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">4. Agama</td>
                    <td>:</td>
                    <td><?= $datapendaftar['agama']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">5. Alamat</td>
                    <td>:</td>
                    <td><?= $datapendaftar['alamat']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">6. Asal Sekolah</td>
                    <td>:</td>
                    <td><?= $datapendaftar['asalsekolah']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">7. NISN Asal</td>
                    <td>:</td>
                    <td><?= $datapendaftar['nisnlama']?></td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>II ORANG TUA / WALI</strong></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">1. Nama Ayah Kandung</td>
                    <td>:</td>
                    <td><?= $datapendaftar['namaayah']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 2.2cm;">Ibu Kandung</td>
                    <td>:</td>
                    <td><?= $datapendaftar['namaibu']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">2. Pekerjaan Ayah</td>
                    <td>:</td>
                    <td><?= $datapendaftar['pekerjaanayah']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 2.9cm;">Ibu</td>
                    <td>:</td>
                    <td><?= $datapendaftar['pekerjaanibu']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">3. Nama Wali Murid</td>
                    <td>:</td>
                    <td><?= $datapendaftar['wali']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">4. Hubungan dengan Wali Murid</td>
                    <td>:</td>
                    <td><?= $datapendaftar['hubunganwali']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">5. Pekerjaan</td>
                    <td>:</td>
                    <td><?= $datapendaftar['pekerjaanwali']?></td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5cm;">6. Alamat</td>
                    <td>:</td>
                    <td><?= $datapendaftar['alamatwali']?></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table style="width: 80%; margin: 0px auto;">
            <tr>
                <td style="width: 50%;text-align: center;">
                    <br><br>
                    Petugas PSB<br>
                    <br>
                    <br>
                    <br>
                    <br>
                    ...............................<br>
                    <br>
                </td>
                <td style="width: 50%;text-align: center;">
                    Gresik,........................<br><br>
                    Orang tua / wali<br>
                    <br>
                    <br>
                    <br>
                    <br>
                    ...............................<br>
                    <br>
                </td>
            </tr>
        </table>
    </page>
    <!--page size="A4" layout="landscape"></page>
    <page size="A5"></page>
    <page size="A5" layout="landscape"></page>
    <page size="A3"></page>
    <page size="A3" layout="landscape"></page-->
</body>
</html>