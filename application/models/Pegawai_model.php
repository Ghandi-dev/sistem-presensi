<?php

class Pegawai_model extends CI_Model
{
    private $table = 'tb_pegawai';
    public function get_all()
    {
        $this->db->where('nama <>', 'admin'); // Ganti 'nama' dengan nama kolom yang sesuai
        return $this->db->get($this->table)->result();
    }

    public function get_pegawai_belum_presensi($current_date)
    {

        // Query untuk menampilkan pegawai yang belum absen hari ini
        $this->db->select('tb_pegawai.*');
        $this->db->from('tb_pegawai');
        $this->db->join('tb_absensi', 'tb_pegawai.id = tb_absensi.id_pegawai AND tb_absensi.tanggal = "' . $current_date . '"', 'left');
        $this->db->where('tb_absensi.id_pegawai IS NULL'); // Pegawai yang tidak ditemukan di tabel absensi untuk hari ini
        $this->db->where('tb_pegawai.nama <>', 'admin'); // Filter pegawai yang bukan admin

        return $this->db->get()->result();
    }

    public function get_by_jabatan($jabatan)
    {
        $this->db->like('LOWER(jabatan)', strtolower($jabatan));
        return $this->db->get($this->table)->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            // Debugging: cek error
            log_message('error', 'Error updating data: ' . print_r($this->db->error(), true));
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}
