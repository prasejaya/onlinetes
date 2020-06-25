<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class menubuilder {

    var $ci;
    var $strmenu;

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('m_menu');
    }

    function generate_menu($tipeuser, $parent = 0, $level = 1) {
        $arr_menu = $this->ci->m_menu->view_sitemenu($tipeuser, $parent);
        //print_r($arr_menu);die();
        foreach ($arr_menu as $row) {
            $active='';
            if($this->ci->uri->segment(1)==$row['url']){
                $active='class="active"';
            }
            
            //cek hak akses menu
            if($this->ci->session->userdata('role')[$row['id_menu'].'|'.$row['url']]['v']==1){
                $printmenu=true;
            }else{
                $printmenu=false;
            }
            
            if ($row['child'] > 0) {
                if ($level > 1) {
                    if($printmenu)
                        $this->strmenu .= '<li '.$active.'><a href="' . base_url($row['url']) . '">' . $row['nama'] . '</a></li>';
                } else {
                    if($printmenu)
                        $this->strmenu .= '<li class="cm-submenu"><a class="'.$row['icon_image'].'">' . $row['nama'] . '<span class="caret"></span></a>';
                }
                $this->strmenu .= '<ul>';
                $this->generate_menu($tipeuser, $row['id_menu'], $level + 1);
                $this->strmenu .= '</ul>';
                $this->strmenu .= " </li>";
            } elseif ($row['child'] == 0) {
                if ($level > 1) {
                    if($printmenu)
                        $this->strmenu .= '<li '.$active.'><a href="' . base_url($row['url']) . '">' . $row['nama'] . '</a></li>';
                } else {
                    if($printmenu)
                     $this->strmenu .= '<li '.$active.'><a href="' . base_url($row['url']) . '" class="'.$row['icon_image'].'">' . $row['nama'] . '</a></li>';
                }
            } 
            else;
        }
    }
    
//    function generate_menuarr($arraymenu) {
//        
//        foreach ($arraymenu as $row) {
//            if($row['child']>0){
//                echo '<li class="cm-submenu"><a class="'.$row['icon_image'].'">' . $row['nama'] . '<span class="caret"></span></a>';
//               
//            }else{
//                echo '<li><a href="' . base_url($row['url']) . '" class="'.$row['icon_image'].'">' . $row['nama'] . '</a></li>';
//            }
//        }
//    }
//
//    function generate_menubck($tipeuser, $parent = 0, $level = 1) {
//        $arr_menu = $this->ci->m_menu->view_sitemenu($tipeuser, $parent);
//        foreach ($arr_menu as $row) {
//            if ($row['child'] > 0) {
//                if ($level > 1) {
//                    $this->strmenu .= " <li class='dropdown-submenu'><a href='" . $row['url'] . "' class='dropdown-toggle' 
//                        data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>" . $row['nama'] . "</span></a>";
//                } else {
//                    $this->strmenu .= " <li class='dropdown'><a href='" . $row['url'] . "' class='dropdown-toggle' 
//                        data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>" . $row['nama'] . "<span class='caret'></span></a>";
//                }
//                $this->strmenu .= '<ul class="dropdown-menu">';
//                $this->generate_menu($tipeuser, $row['id_menu'], $level + 1);
//                $this->strmenu .= '</ul>';
//                $this->strmenu .= " </li>";
//            } elseif ($row['child'] == 0) {
//                $this->strmenu .= " <li><a href='" . $row['url'] . "'>" . $row['nama'] . "</a></li>";
//            } 
//                else;
//        }
//    }

}
