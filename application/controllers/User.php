<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
    }

    public function check_username()
    {
        $username = $this->input->post('username');
        $exists = $this->User_Model->get_by_username($username);

        // Mengirimkan respons JSON
        echo json_encode(['exists' => $exists ? true : false]);
    }

}
