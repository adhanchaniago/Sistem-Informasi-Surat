<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Disposisi_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT * FROM disposisi
                ";
        return $this->db->query($query)->result_array();
    }

    public function hitungSurat(){
        $query=$this->db->get('disposisi');
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else{
            return 0;
        }
    }

}
