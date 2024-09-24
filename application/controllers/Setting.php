<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save_sidebar_color()
    {

        $color = $this->input->post('color');
        $this->session->set_userdata('sidebar_color', $color);
        echo $color;
    }
    public function save_sidebar_type()
    {

        $color = $this->input->post('color');
        $this->session->set_userdata('sidebar_type', $color);
        echo $color;
    }
}