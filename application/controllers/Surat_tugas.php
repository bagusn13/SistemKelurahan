<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_tugas extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->model('M_surat_tugas');
  }

  // List all your items
  public function index()
  {
    $data = array(
      'title'   => 'Surat Tugas',
      'arsip'   => $this->M_surat_tugas->get_all_data(),
      'isi'     => 'surat_tugas/v_arsip',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  // Add a new item
  public function add()
  {
    $this->form_validation->set_rules(
      'tentang',
      'Tentang',
      'required',
      array('required' => '%s Harus Diisi')
    );

    if ($this->form_validation->run() == TRUE) {
      $config['upload_path']    = './assets/arsipSurat/tugas/';
      $config['allowed_types']  = 'pdf';
      $config['max_size']       = '2000';
      $this->upload->initialize($config);
      $field_name = "surat"; #name di form view
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title'         => 'Tambah Arsip Surat Tugas',
          'arsip'         => $this->M_surat_tugas->get_all_data(),
          'isi'           => 'surat_tugas/v_add',
          'error_upload'  => $this->upload->display_errors(),
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $data = array(
          'tentang'        => $this->input->post('tentang'),
          'tanggal_arsip'  => date("Y-m-d"),
          'surat'          => $upload_data['uploads']['file_name'],
        );

        $this->M_surat_tugas->add($data);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan');
        redirect('surat_tugas');
      }
    }

    $data = array(
      'title'   => 'Tambah Arsip Surat Tugas',
      'arsip'   => $this->M_surat_tugas->get_all_data(),
      'isi'     => 'surat_tugas/v_add',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Update one item
  public function edit($id_surat)
  {
    $this->form_validation->set_rules(
      'tentang',
      'Tentang',
      'required',
      array('required' => '%s Harus Diisi')
    );

    if ($this->form_validation->run() == TRUE) {

      if (!empty($_FILES['surat']['name'])) {
        $config['upload_path']    = './assets/arsipSurat/tugas/';
        $config['allowed_types']  = 'pdf';
        $config['max_size']       = '2000';
        $this->upload->initialize($config);
        $field_name = "surat"; #name di form view
        if (!$this->upload->do_upload($field_name)) {
          $data = array(
            'title'         => 'Ubah Arsip Surat Tugas',
            'arsip'         => $this->M_surat_tugas->get_data($id_surat),
            'isi'           => 'surat_tugas/v_edit',
            'error_upload'  => $this->upload->display_errors(),
          );
          $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        } else {
          // hapus arsip
          $surat = $this->M_surat_tugas->get_data($id_surat);
          if ($surat->surat != "") {
            unlink('./assets/arsipSurat/tugas/' . $surat->surat);
          }

          $upload_data = array('uploads' => $this->upload->data());
          $data = array(
            'id_surat'    => $id_surat,
            'tentang'     => $this->input->post('tentang'),
            'surat'       => $upload_data['uploads']['file_name'],
          );

          $this->M_surat_tugas->edit($data);
          $this->session->set_flashdata('pesan', 'Data berhasil diedit');
          redirect('surat_tugas');
        }
      } else {
        $data = array(
          'id_surat'    => $id_surat,
          'tentang'     => $this->input->post('tentang'),
        );

        $this->M_surat_tugas->edit($data);
        $this->session->set_flashdata('pesan', 'Data berhasil diedit');
        redirect('surat_tugas');
      }
    }

    $data = array(
      'title'   => 'Ubah Arsip Surat Tugas',
      'arsip'   => $this->M_surat_tugas->get_data($id_surat),
      'isi'     => 'surat_tugas/v_edit',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Delete one item
  public function delete($id_surat)
  {
    // hapus gambar
    $surat = $this->M_surat_tugas->get_data($id_surat);
    if ($surat->surat != "") {
      unlink('./assets/arsipSurat/tugas/' . $surat->surat);
    }

    $data = array('id_surat' => $id_surat);
    $this->M_surat_tugas->delete($data);
    $this->session->set_flashdata('pesan', 'Data telah dihapus');
    redirect(base_url('surat_tugas'));
  }
}
