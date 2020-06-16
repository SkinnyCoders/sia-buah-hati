<?php
defined('BASEPATH') or exit('No direct script access allowed');

function active($menu)
{
    $CI = &get_instance();
    if ($CI->uri->segment(2) == $menu) {
        $class = 'active';
        return $class;
    }else{
        return false;
    }
}