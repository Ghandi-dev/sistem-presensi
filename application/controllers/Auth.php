<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->model('Pegawai_Model');
    }

    public function index()
    {
        $this->session->sess_destroy();
        $data['title'] = 'Login';
        $this->session->set_userdata($data);
        $this->load->view('auth/login', $data);
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_Model->get_by_username($username);
        if (!$user) {
            $this->session->set_flashdata('error', 'Userame atau password salah!');
            redirect('auth');
        }
        $pegawai = $this->Pegawai_Model->get_by_id($user->id_pegawai);

        $data_session = array(
            "id" => $user->id,
            "username" => $user->username,
            "role" => $user->role,
            "id_pegawai" => $user->id_pegawai,
            "foto" => $pegawai->foto,
        );

        $this->session->set_userdata($data_session);
        if ($user->role == "2") {
            redirect('admin');
        } else {
            redirect('user');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
