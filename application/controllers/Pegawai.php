<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->model('User_model');
        $config['upload_path'] = './assets/img/foto/';
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['max_size'] = 5000; // max 5 MB

        $this->load->library('upload', $config);
        $this->load->library('ciqrcode');
        $config['cacheable'] = true; //boolean, the default is true
        $config['cachedir'] = './assets/'; //string, the default is application/cache/
        $config['errorlog'] = './assets/'; //string, the default is application/logs/
        $config['imagedir'] = FCPATH . 'assets/img/qr-code/';
        $config['quality'] = true; //boolean, the default is true
        $config['size'] = '1024'; //interger, the default is 1024
        $config['black'] = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
    }

    public function insert()
    {
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $no_telp = $this->input->post('no_telp');
        $alamat = $this->input->post('alamat');
        $foto = $_FILES['foto']['name'];
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data('file_name');
        } else {
            $foto = 'default.jpg';
        }

        // Generate QR Code
        $image_name = $username . '.png';
        $params['data'] = $username;
        $params['level'] = 'H'; // Tingkat koreksi kesalahan
        $params['size'] = 10;
        $params['savename'] = FCPATH . 'assets/img/qr-code/' . $image_name; // Path penyimpanan

        // Buat QR Code
        $this->ciqrcode->generate($params);

        // Log apakah QR Code berhasil dibuat
        if (file_exists($params['savename'])) {
            log_message('info', 'QR code berhasil dibuat: ' . $params['savename']);
        } else {
            log_message('error', 'Gagal membuat QR code.');
        }

        // Simpan data pegawai
        $data['pegawai'] = array(
            'nama' => $nama,
            'jabatan' => $jabatan,
            'no_telepon' => $no_telp,
            'alamat' => $alamat,
            'foto' => $foto,
            'qr_code' => $image_name,
        );

        if (!$this->Pegawai_model->insert($data['pegawai'])) {
            $this->session->set_flashdata('error', 'gagal ditambahkan');
            redirect('admin/pegawai');
            return;
        }

        // Simpan data user
        $data['user'] = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => '1',
            'id_pegawai' => $this->db->insert_id(),
        );

        if (!$this->User_model->insert($data['user'])) {
            $this->session->set_flashdata('error', 'gagal ditambahkan');
            redirect('admin/pegawai');
            return;
        }

        $this->session->set_flashdata('success', 'ditambahkan');
        redirect('admin/pegawai');
    }

    public function update($id)
    {
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $no_telp = $this->input->post('no_telp');
        $alamat = $this->input->post('alamat');
        $foto = $_FILES['foto']['name'];
        $old_foto = $this->input->post('old_foto');

        if ($foto) {
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');
                if ($old_foto !== 'default.jpg') {
                    @unlink('./assets/img/foto/' . $old_foto);
                }
            } else {
                $foto = 'default.jpg';
            }
        } else {
            $foto = $old_foto;
        }

        $data['pegawai'] = array(
            'nama' => $nama,
            'jabatan' => $jabatan,
            'no_telepon' => $no_telp,
            'alamat' => $alamat,
            'foto' => $foto,
        );

        if (!$this->Pegawai_model->update($id, $data['pegawai'])) {
            $this->session->set_flashdata('error', 'gagal diedit');
            redirect('admin/pegawai_edit/' . $id);
            return;
        }

        $this->session->set_flashdata('success', 'berhasil diedit');
        redirect('admin/pegawai_edit/' . $id);
    }

    public function delete($id)
    {
        $this->Pegawai_model->delete($id);
        $this->session->set_flashdata('success', 'dihapus');
        redirect('admin/pegawai');
    }
}