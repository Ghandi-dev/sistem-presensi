<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
    }

    public function index()
    {
        $this->session->sess_destroy();
        $data['title'] = 'Login';
        $this->session->set_userdata($data);
        $this->load->view('auth/login', $data);
    }

    private function login()
    {

    }
}
