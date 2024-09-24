<?php

class Kehadiran_model extends CI_Model
{
    private $table = 'tb_absensi';

    public function get_all()
    {
        $this->db->select($this->table . '.*, tb_pegawai.nama');
        $this->db->from($this->table);
        $this->db->join('tb_pegawai', 'tb_pegawai.id = ' . $this->table . '.id_pegawai');
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

    public function get_absen_today($id_pegawai, $date = null)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->where('tanggal', $date); // Cek berdasarkan tanggal hari ini
        return $this->db->get($this->table)->row();
    }
}
