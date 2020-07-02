<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getAuthGuruKelas()
{
    $CI = &get_instance();
    if ($CI->session->userdata('is_login') !== 'punten') {
        $CI->session->set_flashdata('msg_failed', 'Maaf, Harus login terlebih dahulu!');
        redirect('administrator');
        return false;
    }elseif($CI->session->userdata('nama_role') !== 'Guru Kelas'){
        $CI->session->set_flashdata('msg_failed', 'Maaf, Anda tidak memiliki akses ke halaman!');
        redirect('guru_kelas/dashboard');
        return false;
    }
}

function getAuthGuruMapel()
{
    $CI = &get_instance();
    if ($CI->session->userdata('is_login') !== 'punten') {
        $CI->session->set_flashdata('msg_failed', 'Maaf, Harus login terlebih dahulu!');
        redirect('administrator');
        return false;
    }elseif($CI->session->userdata('nama_role') !== 'Guru Mapel'){
        $CI->session->set_flashdata('msg_failed', 'Maaf, Anda tidak memiliki akses ke halaman!');
        redirect('guru_kelas/dashboard');
        return false;
    }
}

function getAuthTatausaha()
{
    $CI = &get_instance();
    if ($CI->session->userdata('is_login') !== 'punten') {
        $CI->session->set_flashdata('msg_failed', 'Maaf, Harus login terlebih dahulu!');
        redirect('tatausaha');
        return false;
    }elseif ($CI->session->userdata('nama_role') !== 'TU') {
        $CI->session->set_flashdata('msg_failed', 'Maaf, Anda tidak memiliki akses ke halaman!');
        redirect('tatausaha');
        return false;
    }
}

function getAuthKepsek()
{
    $CI = &get_instance();
    if ($CI->session->userdata('is_login') !== 'punten') {
        $CI->session->set_flashdata('msg_failed', 'Maaf, Harus login terlebih dahulu!');
        redirect('/');
        return false;
    }elseif($CI->session->userdata('nama_role') !== 'kepsek'){
        $CI->session->set_flashdata('msg_failed', 'Maaf, Anda tidak memiliki akses ke halaman!');
        redirect('/');
        return false;
    }
}