<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// application/config/bootstrap_pagination.php
$config['pagination']['full_tag_open'] = '<ul class="pagination-default pagination">';
$config['pagination']['full_tag_close'] = '</ul>';
$config['pagination']['first_link'] = '&laquo; First';
$config['pagination']['first_tag_open'] = '<li class="prev page">';
$config['pagination']['first_tag_close'] = '</li>';

$config['pagination']['last_link'] = 'Last &raquo;';
$config['pagination']['last_tag_open'] = '<li class="next page">';
$config['pagination']['last_tag_close'] = '</li>';

$config['pagination']['next_link'] = 'Next &rarr;';
$config['pagination']['next_tag_open'] = '<li class="next page">';
$config['pagination']['next_tag_close'] = '</li>';

$config['pagination']['prev_link'] = '&larr; Prev';
$config['pagination']['prev_tag_open'] = '<li class="prev page">';
$config['pagination']['prev_tag_close'] = '</li>';

$config['pagination']['cur_tag_open'] = '<li class="current"><a href="">';
$config['pagination']['cur_tag_close'] = '</a></li>';

$config['pagination']['num_tag_open'] = '<li class="page">';
$config['pagination']['num_tag_close'] = '</li>';
?>