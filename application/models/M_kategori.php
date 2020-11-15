<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{
  public function get_all_data()
  {
    $this->db->select('*');
    $this->db->from('tbl_kategori');
    $this->db->order_by('id_kategori', 'asc');
    // result() untuk memanggil seluruh data
    return $this->db->get()->result();
  }

  public function get_data($id_kategori)
  {
    $this->db->select('*');
    $this->db->from('tbl_kategori');
    $this->db->where('id_kategori', $id_kategori);
    return $this->db->get()->row();
  }

  public function add($data)
  {
    $this->db->insert('tbl_kategori', $data);
  }

  public function edit($data)
  {
    $this->db->where('id_kategori', $data['id_kategori']);
    $this->db->update('tbl_kategori', $data);
  }

  public function delete($data)
  {
    $this->db->where('id_kategori', $data['id_kategori']);
    $this->db->delete('tbl_kategori', $data);
  }
}
