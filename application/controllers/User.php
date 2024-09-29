<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata([
            'username' => 'admin',
            'id_pegawai' => '26',
        ]);
        $this->load->model('User_Model');
        $this->load->model('Pegawai_Model');
        $this->load->model('Kehadiran_Model');
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

        $data['kehadiran'] = $this->Kehadiran_Model->get_by_pegawai($this->session->userdata('id_pegawai'));

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
        $data['pegawai'] = $this->Pegawai_Model->get_by_id($this->session->userdata('id_pegawai'));
        $this->load->view('user/scan', $data);
    }

    public function kehadiran()
    {
        $data['title'] = 'Kehadiran';
        $data['kehadiran'] = $this->Kehadiran_Model->get_by_pegawai($this->session->userdata('id_pegawai'));
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
        $data['pegawai'] = $this->Pegawai_Model->get_by_id($this->session->userdata('id_pegawai'));
        $data['user'] = $this->User_Model->get_by_id_pegawai($this->session->userdata('id_pegawai'));
        $this->load->view('user/profile/index', $data);
    }

    public function check_username()
    {
        $username = $this->input->post('username');
        $exists = $this->User_Model->get_by_username($username);

        // Mengirimkan respons JSON
        echo json_encode(['exists' => $exists ? true : false]);
    }

}
