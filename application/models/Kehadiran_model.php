<?php

class Kehadiran_model extends CI_Model
{
    private $table = 'tb_absensi';

    public function get_all()
    {
        $this->db->select($this->table . '.*, tb_pegawai.nama');
        $this->db->from($this->table);
        $this->db->join('tb_pegawai', 'tb_pegawai.id = ' . $this->table . '.id_pegawai');

        // Tambahkan order_by untuk mengurutkan berdasarkan tanggal terbaru
        $this->db->order_by($this->table . '.id', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }
    public function get_by_date($date)
    {
        $this->db->select($this->table . '.*, tb_pegawai.nama, tb_pegawai.jabatan');
        $this->db->from($this->table);
        $this->db->join('tb_pegawai', 'tb_pegawai.id = ' . $this->table . '.id_pegawai');
        $this->db->where($this->table . '.tanggal', $date);

        // Tambahkan order_by untuk mengurutkan berdasarkan tanggal terbaru
        $this->db->order_by($this->table . '.id', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function get_kehadiran_today($id_pegawai, $date = null)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->where('tanggal', $date); // Cek berdasarkan tanggal hari ini
        return $this->db->get($this->table)->row();
    }

    public function get_tidak_hadir_today($current_date)
    {
        $this->db->select('tb_absensi.*, tb_pegawai.nama, tb_pegawai.foto'); // Memilih semua data dari tb_absensi, dan hanya nama serta foto dari tb_pegawai
        $this->db->from('tb_absensi');
        $this->db->join('tb_pegawai', 'tb_pegawai.id = tb_absensi.id_pegawai', 'left'); // Menghubungkan ke tabel pegawai
        $this->db->where('tb_absensi.tanggal', $current_date); // Filter berdasarkan tanggal
        $this->db->where_not_in('tb_absensi.status', ['HADIR', 'TELAT']); // Mengecualikan HADIR dan TELAT
        $this->db->where('tb_pegawai.nama <>', 'admin'); // Mengecualikan admin

        return $this->db->get()->result();
    }

    public function get_by_pegawai($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(5); // Membatasi hasil query hanya 5 data
        return $this->db->get($this->table)->result();
    }

}
