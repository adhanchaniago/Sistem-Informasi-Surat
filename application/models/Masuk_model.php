<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Masuk_model extends CI_Model
{
    public $_table = "surat_masuk";

    public function getSubMenu()
    {
        $query = "SELECT * FROM surat_masuk
                ";
        return $this->db->query($query)->result_array();
    }

    public function deleteSuratMasuk($suratId)
    {
        $this->db->where('id', $suratId);
        $query = $this->db->delete('surat_masuk');

        return $query;
    }

    public function get($suratId)
    {
        $this->db->where('id', $suratId);
        $query=$this->db->get('surat_masuk')->row();

        return $query;
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function hitungSurat(){
        $query=$this->db->get('surat_masuk');
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else{
            return 0;
        }
    }
}
