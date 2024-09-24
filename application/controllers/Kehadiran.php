<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kehadiran extends CI_Controller
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
        $this->load->helper('date');

    }

    public function index()
    {

    }

    public function scan()
    {
        $data['title'] = 'Scan Kehadiran';
        $this->load->view('admin/absensi/scan', $data);

    }

    public function scan_kehadiran()
    {
        $username = $this->input->post('username');
        date_default_timezone_set('Asia/Jakarta'); // Set timezone to Jakarta
        $current_time = date('H:i:s'); // Ambil waktu sekarang
        $current_date = date('Y-m-d'); // Ambil tanggal sekarang

        // Cek apakah user dengan ID tersebut ada dalam database
        $user = $this->User_Model->get_by_username($username);
        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'user tidak ditemukan']);
            return;
        }

        // Cek apakah user sudah scan untuk absen masuk hari ini
        $absen_today = $this->Kehadiran_Model->get_absen_today($user->id_pegawai, $current_date);

        if ($absen_today) {
            // Jika sudah absen masuk, lakukan absensi pulang
            if ($absen_today->waktu_pulang === '00:00:00') {
                // Update absen sebagai waktu pulang
                $data_absen_pulang = [
                    'waktu_pulang' => $current_time,
                ];
                $this->Kehadiran_Model->update($absen_today->id, $data_absen_pulang);

                echo json_encode(['status' => 'success', 'message' => 'Absensi pulang berhasil!' . 'jam :' . $current_time]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Anda sudah absen pulang hari ini.']);
            }
        } else {
            // Jika belum absen hari ini, lakukan absensi masuk
            $data_absen = [
                'id_pegawai' => $user->id_pegawai,
                'tanggal' => $current_date,
                'waktu_datang' => $current_time,
                'status' => 'HADIR',
            ];
            $this->Kehadiran_Model->insert($data_absen);

            echo json_encode(['status' => 'success', 'message' => 'Absensi masuk berhasil! ' . 'jam :' . $current_time]);
        }
    }

    // public function insert(){
    //     $username = $this->post->('username');
    //     $waktu = $this->post->('waktu');
    // }
}
