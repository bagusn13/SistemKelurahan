<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_arsip extends CI_Model
{
  public function get_all_data()
  {
    $this->db->select('*');
    $this->db->from('tbl_arsip_surat');
    $this->db->order_by('id_arsip', 'asc');
    // result() untuk memanggil seluruh data
    return $this->db->get()->result();
  }

  public function get_data($id_arsip)
  {
    $this->db->select('*');
    $this->db->from('tbl_arsip_surat');
    $this->db->where('id_arsip', $id_arsip);
    return $this->db->get()->row();
  }

  public function add($data)
  {
    $this->db->insert('tbl_arsip_surat', $data);
  }

  public function edit($data)
  {
    $this->db->where('id_arsip', $data['id_arsip']);
    $this->db->update('tbl_arsip_surat', $data);
  }

  public function delete($data)
  {
    $this->db->where('id_arsip', $data['id_arsip']);
    $this->db->delete('tbl_arsip_surat', $data);
  }
}
