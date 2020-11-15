<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->model('M_surat_keluar');
    $this->load->model('M_kategori');
  }

  // List all your items
  public function index()
  {
    $data = array(
      'title'   => 'Surat Keluar',
      'arsip'   => $this->M_surat_keluar->get_all_data(),
      'isi'     => 'surat_keluar/v_arsip',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  // Add a new item
  public function add()
  {
    $this->form_validation->set_rules(
      'tanggal_surat',
      'Tanggal Surat',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'kode',
      'Kode',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'perihal',
      'Perihal',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'kepada',
      'Kepada',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'keterangan',
      'Keterangan',
      'required',
      array('required' => '%s Harus Diisi')
    );

    if ($this->form_validation->run() == TRUE) {
      $config['upload_path']    = './assets/arsipSurat/keluar/';
      $config['allowed_types']  = 'pdf';
      $config['max_size']       = '2000';
      $this->upload->initialize($config);
      $field_name = "surat"; #name di form view
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title'         => 'Tambah Arsip Surat Keluar',
          'kategori'      => $this->M_kategori->get_all_data(),
          'isi'           => 'surat_keluar/v_add',
          'error_upload'  => $this->upload->display_errors(),
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $data = array(
          'tanggal_surat'  => $this->input->post('tanggal_surat'),
          'kode'           => $this->input->post('kode'),
          'perihal'        => $this->input->post('perihal'),
          'kepada'         => $this->input->post('kepada'),
          'keterangan'     => $this->input->post('keterangan'),
          'kategori'       => $this->input->post('kategori'),
          'surat'          => $upload_data['uploads']['file_name'],
        );

        $this->M_surat_keluar->add($data);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan');
        redirect('surat_keluar');
      }
    }

    $data = array(
      'title'     => 'Tambah Arsip Surat Keluar',
      'kategori'  => $this->M_kategori->get_all_data(),
      'isi'       => 'surat_keluar/v_add',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Update one item
  public function edit($id_surat)
  {
    $this->form_validation->set_rules(
      'tanggal_surat',
      'Tanggal Surat',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'kode',
      'Kode',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'perihal',
      'Perihal',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'kepada',
      'Kepada',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'keterangan',
      'Keterangan',
      'required',
      array('required' => '%s Harus Diisi')
    );

    if ($this->form_validation->run() == TRUE) {

      if (!empty($_FILES['surat']['name'])) {
        $config['upload_path']    = './assets/arsipSurat/keluar/';
        $config['allowed_types']  = 'pdf';
        $config['max_size']       = '2000';
        $this->upload->initialize($config);
        $field_name = "surat"; #name di form view
        if (!$this->upload->do_upload($field_name)) {
          $data = array(
            'title'         => 'Ubah Arsip Surat Keluar',
            'arsip'         => $this->M_surat_keluar->get_data($id_surat),
            'kategori'      => $this->M_kategori->get_all_data(),
            'isi'           => 'surat_keluar/v_edit',
            'error_upload'  => $this->upload->display_errors(),
          );
          $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        } else {
          // hapus arsip
          $surat = $this->M_surat_keluar->get_data($id_surat);
          if ($surat->surat != "") {
            unlink('./assets/arsipSurat/keluar/' . $surat->surat);
          }

          $upload_data = array('uploads' => $this->upload->data());
          $data = array(
            'id_surat'       => $id_surat,
            'tanggal_surat'  => $this->input->post('tanggal_surat'),
            'kode'           => $this->input->post('kode'),
            'perihal'        => $this->input->post('perihal'),
            'kepada'         => $this->input->post('kepada'),
            'keterangan'     => $this->input->post('keterangan'),
            'kategori'       => $this->input->post('kategori'),
            'surat'          => $upload_data['uploads']['file_name'],
          );

          $this->M_surat_keluar->edit($data);
          $this->session->set_flashdata('pesan', 'Data berhasil diedit');
          redirect('surat_keluar');
        }
      } else {
        $data = array(
          'id_surat'       => $id_surat,
          'tanggal_surat'  => $this->input->post('tanggal_surat'),
          'kode'           => $this->input->post('kode'),
          'perihal'        => $this->input->post('perihal'),
          'kepada'         => $this->input->post('kepada'),
          'keterangan'     => $this->input->post('keterangan'),
          'kategori'       => $this->input->post('kategori'),
        );

        $this->M_surat_keluar->edit($data);
        $this->session->set_flashdata('pesan', 'Data berhasil diedit');
        redirect('surat_keluar');
      }
    }

    $data = array(
      'title'     => 'Ubah Arsip Surat Keluar',
      'arsip'     => $this->M_surat_keluar->get_data($id_surat),
      'kategori'  => $this->M_kategori->get_all_data(),
      'isi'       => 'surat_keluar/v_edit',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Delete one item
  public function delete($id_surat)
  {
    // hapus gambar
    $surat = $this->M_surat_keluar->get_data($id_surat);
    if ($surat->surat != "") {
      unlink('./assets/arsipSurat/keluar/' . $surat->surat);
    }

    $data = array('id_surat' => $id_surat);
    $this->M_surat_keluar->delete($data);
    $this->session->set_flashdata('pesan', 'Data telah dihapus');
    redirect(base_url('surat_keluar'));
  }
}
