<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata([
            'username' => 'admin',
            'jabatan' => 'kepala',
            'foto' => 'default.jpg',
        ]);
        // if (!$this->session->userdata('is_login')) {
        //     redirect('auth'); // Ganti dengan URL login yang sesuai
        // }
        // $this->load->model('Aset_Model');
        $this->load->model('Pegawai_Model');
        $this->load->model('Kehadiran_Model');
        $this->load->model('User_Model');

    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->load->view('admin/dashboard/index', $data);
    }
    public function absensi()
    {
        $data['title'] = 'Absensi';
        $data['absensi'] = $this->Kehadiran_Model->get_all();

        // Daftar status yang valid
        $validStatuses = [
            'HADIR' => 'bg-gradient-success', // hijau
            'TELAT' => 'bg-gradient-warning', // kuning
            'TIDAK HADIR' => 'bg-gradient-danger', // merah
            // Tambahkan status valid lainnya jika diperlukan
        ];

        // Mapping status ke badge color dengan default untuk status tidak dikenali
        $data['absensi'] = array_map(function ($item) use ($validStatuses) {
            // Tentukan warna berdasarkan status
            $status = strtoupper($item['status']); // Mengubah status menjadi huruf kapital untuk pencocokan
            if (array_key_exists($status, $validStatuses)) {
                $item['badge'] = $validStatuses[$status];
            } else {
                $item['badge'] = 'bg-gradient-secondary'; // abu-abu untuk status yang tidak dikenali
            }
            return $item;
        }, $data['absensi']);

        $this->load->view('admin/absensi/index', $data);

    }

    public function pegawai()
    {
        $data['title'] = 'Pegawai';
        $data['pegawai'] = $this->Pegawai_Model->get_all();
        $this->load->view('admin/pegawai/index', $data);
    }

    public function pegawai_detail($id)
    {
        $data['title'] = 'Pegawai';
        $data['pegawai'] = $this->Pegawai_Model->get_by_id($id);
        $this->load->view('admin/pegawai/detail', $data);
    }
    public function pegawai_edit($id)
    {
        $data['title'] = 'Pegawai';
        $data['pegawai'] = $this->Pegawai_Model->get_by_id($id);
        $data['user'] = $this->User_Model->get_by_id_pegawai($id);
        $this->load->view('admin/pegawai/edit', $data);
    }

    public function change_password_by_admin($id)
    {
        $user = $this->User_Model->get_by_id_pegawai($id);
        $new_password = $this->input->post('new_password');

        $data = array(
            'username' => $user['username'],
            'id_pegawai' => $user['id_pegawai'],
            'password' => password_hash($new_password, PASSWORD_BCRYPT),
            'role' => $user['role'],
        );

        if (!$this->User_Model->update($user['id'], $data)) {
            $this->session->set_flashdata('error', 'gagal diubah');
            redirect('admin/pegawai_edit/' . $user['id_pegawai']);
            return;
        }

        $this->session->set_flashdata('success', 'diubah');
        redirect('admin/pegawai_edit/' . $user['id_pegawai']);

    }
}
