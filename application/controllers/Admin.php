<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function index()
	{
		$data = array(
			'title' 		=> 'Admin',
			'isi'   		=> 'v_admin',
			'tugas'			=> $this->db->count_all('tbl_surat_tugas'),
			'masuk'			=> $this->db->count_all('tbl_surat_masuk'),
			'keluar'		=> $this->db->count_all('tbl_surat_keluar'),
			'keputusan'	=> $this->db->count_all('tbl_surat_keputusan'),
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}
}

/* End of file Admin.php */
