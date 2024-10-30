<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != "2") {
            // $this->session->set_flashdata('error', 'Anda tidak memiliki akses untuk halaman ini.');
            redirect('auth'); // Ganti dengan URL login yang sesuai
        }

        // $this->load->model('Aset_Model');
        $this->load->model('Pegawai_model');
        $this->load->model('Kehadiran_model');
        $this->load->model('User_model');

    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta'); // Set timezone to Jakarta
        $current_date = date('Y-m-d'); // Ambil tanggal sekarang
        $data['title'] = 'Dashboard';
        $data['jumlah_pegawai'] = count($this->Pegawai_model->get_all());
        $kehadiran_hari_ini = $this->Kehadiran_model->get_by_date($current_date);

        // Filter kehadiran yang statusnya "Hadir" atau "Telat"
        $kehadiran_valid = array_filter($kehadiran_hari_ini, function ($kehadiran) {
            return $kehadiran['status'] === 'HADIR' || $kehadiran['status'] === 'TELAT';
        });

        $kehadiran_tidak_valid = array_filter($kehadiran_hari_ini, function ($kehadiran) {
            return $kehadiran['status'] !== 'HADIR' && $kehadiran['status'] !== 'TELAT'; // Menggunakan AND
        });

        // Hitung jumlah data kehadiran yang valid
        $data['jumlah_kehadiran_hari_ini'] = count($kehadiran_valid);
        $data['jumlah_tidak_hadir_hari_ini'] = count($kehadiran_tidak_valid);

        $data['tidak_hadir'] = $this->Kehadiran_model->get_tidak_hadir_today($current_date);
        $data['belum_presensi'] = $this->Pegawai_model->get_pegawai_belum_presensi($current_date);
        $this->load->view('admin/dashboard/index', $data);
    }
    public function kehadiran($date = null)
    {
        date_default_timezone_set('Asia/Jakarta'); // Set timezone to Jakarta
        $current_date = date('Y-m-d'); // Ambil tanggal sekarang
        if ($date == null) {
            $date = $current_date;
        }
        $data['title'] = 'Kehadiran';
        $data['pegawai'] = $this->Pegawai_model->get_pegawai_belum_presensi($current_date);
        $data['kehadiran'] = $this->Kehadiran_model->get_by_date($date);

        // Daftar status yang valid
        $validStatuses = [
            'HADIR' => 'bg-gradient-success', // hijau
            'TELAT' => 'bg-gradient-warning', // kuning
            'TIDAK HADIR' => 'bg-gradient-danger', // merah
            // Tambahkan status valid lainnya jika diperlukan
        ];

        // Mapping status ke badge color dengan default untuk status tidak dikenali
        $data['kehadiran'] = array_map(function ($item) use ($validStatuses) {
            // Tentukan warna berdasarkan status
            $status = strtoupper($item['status']); // Mengubah status menjadi huruf kapital untuk pencocokan
            if (array_key_exists($status, $validStatuses)) {
                $item['badge'] = $validStatuses[$status];
            } else {
                $item['badge'] = 'bg-gradient-secondary'; // abu-abu untuk status yang tidak dikenali
            }
            return $item;
        }, $data['kehadiran']);

        $data['date'] = $date;

        $this->load->view('admin/kehadiran/index', $data);

    }

    public function pegawai()
    {
        $data['title'] = 'Pegawai';
        $data['pegawai'] = $this->Pegawai_model->get_all();
        $this->load->view('admin/pegawai/index', $data);
    }

    public function pegawai_detail($id)
    {
        $data['title'] = 'Pegawai';
        $data['pegawai'] = $this->Pegawai_model->get_by_id($id);
        $this->load->view('admin/pegawai/detail', $data);
    }
    public function pegawai_edit($id)
    {
        $data['title'] = 'Pegawai';
        $data['pegawai'] = $this->Pegawai_model->get_by_id($id);
        $data['user'] = $this->User_model->get_by_id_pegawai($id);
        $this->load->view('admin/pegawai/edit', $data);
    }

    public function change_password_by_admin($id)
    {
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
            redirect('admin/pegawai_edit/' . $id);
            return;
        }

        $this->session->set_flashdata('success', 'diubah');
        redirect('admin/pegawai_edit/' . $id);

    }

    public function print_kehadiran($date = null)
    {
        date_default_timezone_set('Asia/Jakarta'); // Set timezone ke Jakarta
        $current_date = date('Y-m-d'); // Ambil tanggal sekarang
        if ($date == null) {
            $date = $current_date;
        }

        // Array untuk menerjemahkan nama hari ke Bahasa Indonesia
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
        $day_in_english = date('l', strtotime($date));
        $hari = $days[$day_in_english];

        $data['kepala_desa'] = $this->Pegawai_model->get_by_jabatan('kepala desa');
        $data['title'] = 'Print Kehadiran';
        $data['kehadiran'] = $this->Kehadiran_model->get_by_date($date);
        $data['date'] = $date;
        $data['hari'] = $hari; // Kirim nama hari dalam Bahasa Indonesia ke view
        $this->load->view('admin/kehadiran/print', $data);
    }

}
