<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_surat_keputusan extends CI_Model
{
  public function get_all_data()
  {
    $this->db->select('*');
    $this->db->from('tbl_surat_keputusan');
    $this->db->order_by('id_surat', 'asc');
    // result() untuk memanggil seluruh data
    return $this->db->get()->result();
  }

  public function get_data($id_surat)
  {
    $this->db->select('*');
    $this->db->from('tbl_surat_keputusan');
    $this->db->where('id_surat', $id_surat);
    return $this->db->get()->row();
  }

  public function add($data)
  {
    $this->db->insert('tbl_surat_keputusan', $data);
  }

  public function edit($data)
  {
    $this->db->where('id_surat', $data['id_surat']);
    $this->db->update('tbl_surat_keputusan', $data);
  }

  public function delete($data)
  {
    $this->db->where('id_surat', $data['id_surat']);
    $this->db->delete('tbl_surat_keputusan', $data);
  }
}
