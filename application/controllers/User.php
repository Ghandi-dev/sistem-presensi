<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != "1") {
            // $this->session->set_flashdata('error', 'Anda tidak memiliki akses untuk halaman ini!');
            redirect('auth');
        }
        $this->load->model('User_model');
        $this->load->model('Pegawai_model');
        $this->load->model('Kehadiran_model');
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta'); // Set timezone to Jakarta
        $current_date = date('Y-m-d'); // Ambil tanggal sekarang
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        // Ambil nama hari dalam Bahasa Inggris, lalu konversikan ke Bahasa Indonesia
        $day_in_english = date('l', strtotime($current_date));
        $hari = $days[$day_in_english];

        $data['tanggal'] = $current_date;
        $data['hari'] = $hari;
        $data['title'] = 'Dashboard';

        $data['kehadiran'] = $this->Kehadiran_model->get_by_pegawai($this->session->userdata('id_pegawai'));

        $validStatuses = [
            'HADIR' => 'bg-gradient-success', // hijau
            'TELAT' => 'bg-gradient-warning', // kuning
            'TIDAK HADIR' => 'bg-gradient-danger', // merah
            // Tambahkan status valid lainnya jika diperlukan
        ];

        // Mapping status ke badge color dengan default untuk status tidak dikenali
        foreach ($data['kehadiran'] as $item) {
            // Tentukan warna berdasarkan status
            $status = strtoupper($item->status); // Mengubah status menjadi huruf kapital untuk pencocokan
            if (array_key_exists($status, $validStatuses)) {
                $item->badge = $validStatuses[$status];
            } else {
                $item->badge = 'bg-gradient-secondary'; // abu-abu untuk status yang tidak dikenali
            }
        }

        $kehadiran_hari_ini = null;
        foreach ($data['kehadiran'] as $item) {
            if ($item->tanggal == $current_date) {
                $kehadiran_hari_ini = $item;
                break;
            }
        }

        // Jika tidak ada data kehadiran untuk hari ini, buat objek dengan nilai default
        if (!$kehadiran_hari_ini) {
            $kehadiran_hari_ini = (object) [
                'waktu_datang' => '00:00:00',
                'waktu_pulang' => '00:00:00',
                'status' => 'TIDAK HADIR',
                'badge' => 'bg-gradient-danger',
            ];
        }

        $data['kehadiran_hari_ini'] = $kehadiran_hari_ini;
        $this->load->view('user/index', $data);
    }

    public function scan()
    {
        $data['title'] = 'Scan Kehadiran';
        $data['pegawai'] = $this->Pegawai_model->get_by_id($this->session->userdata('id_pegawai'));
        $this->load->view('user/scan', $data);
    }

    public function kehadiran()
    {
        $data['title'] = 'Kehadiran';
        $data['kehadiran'] = $this->Kehadiran_model->get_by_pegawai($this->session->userdata('id_pegawai'));
        $validStatuses = [
            'HADIR' => 'bg-gradient-success', // hijau
            'TELAT' => 'bg-gradient-warning', // kuning
            'TIDAK HADIR' => 'bg-gradient-danger', // merah
            // Tambahkan status valid lainnya jika diperlukan
        ];

        // Mapping status ke badge color dengan default untuk status tidak dikenali
        foreach ($data['kehadiran'] as $item) {
            // Tentukan warna berdasarkan status
            $status = strtoupper($item->status); // Mengubah status menjadi huruf kapital untuk pencocokan
            if (array_key_exists($status, $validStatuses)) {
                $item->badge = $validStatuses[$status];
            } else {
                $item->badge = 'bg-gradient-secondary'; // abu-abu untuk status yang tidak dikenali
            }
        }
        $this->load->view('user/kehadiran/index', $data);
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['pegawai'] = $this->Pegawai_model->get_by_id($this->session->userdata('id_pegawai'));
        $data['user'] = $this->User_model->get_by_id_pegawai($this->session->userdata('id_pegawai'));
        $this->load->view('user/profile/index', $data);
    }

    public function change_password_by_user()
    {
        $id = $this->session->userdata('id_pegawai');
        $user = $this->User_model->get_by_id_pegawai($id);
        $new_password = $this->input->post('new_password');

        $data = array(
            'username' => $user->username,
            'id_pegawai' => $user->id_pegawai,
            'password' => password_hash($new_password, PASSWORD_BCRYPT),
            'role' => $user->role,
        );

        if (!$this->User_model->update($user->id, $data)) {
            $this->session->set_flashdata('error', 'gagal diubah');
            redirect('auth');
            return;
        }

        $this->session->set_flashdata('success', 'diubah');
        redirect('auth');

    }

    public function check_username()
    {
        $username = $this->input->post('username');
        $exists = $this->User_model->get_by_username($username);

        // Mengirimkan respons JSON
        echo json_encode(['exists' => $exists ? true : false]);
    }

}
