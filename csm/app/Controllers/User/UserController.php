<?php

namespace App\Controllers;

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class User extends BaseController
{
    public function index()
    {
        $data['title'] = 'Users';
        $this->load->view('defaults/header');
        $this->load->view('defaults/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('defaults/footer');
        return view('dashboard/index');
    }
}
