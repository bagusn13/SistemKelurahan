<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keputusan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->model('M_surat_keputusan');
  }

  // List all your items
  public function index()
  {
    $data = array(
      'title'   => 'Surat Keputusan Lurah',
      'arsip'   => $this->M_surat_keputusan->get_all_data(),
      'isi'     => 'surat_keputusan/v_arsip',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  // Add a new item
  public function add()
  {
    $this->form_validation->set_rules(
      'materi',
      'Materi Keputusan',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'nomor_surat',
      'Nomor Surat',
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
      $config['upload_path']    = './assets/arsipSurat/keputusan/';
      $config['allowed_types']  = 'pdf';
      $config['max_size']       = '2000';
      $this->upload->initialize($config);
      $field_name = "surat"; #name di form view
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title'         => 'Tambah Arsip SK Lurah',
          'arsip'         => $this->M_surat_keputusan->get_all_data(),
          'isi'           => 'surat_keputusan/v_add',
          'error_upload'  => $this->upload->display_errors(),
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $data = array(
          'materi'         => $this->input->post('materi'),
          'nomor_surat'    => $this->input->post('nomor_surat'),
          'tanggal_arsip'  => date("Y-m-d"),
          'keterangan'     => $this->input->post('keterangan'),
          'surat'          => $upload_data['uploads']['file_name'],
        );

        $this->M_surat_keputusan->add($data);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan');
        redirect('surat_keputusan');
      }
    }

    $data = array(
      'title'   => 'Tambah Arsip SK Lurah',
      'arsip'   => $this->M_surat_keputusan->get_all_data(),
      'isi'     => 'surat_keputusan/v_add',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Update one item
  public function edit($id_surat)
  {
    $this->form_validation->set_rules(
      'materi',
      'Materi Keputusan',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'nomor_surat',
      'Nomor Surat',
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
        $config['upload_path']    = './assets/arsipSurat/keputusan/';
        $config['allowed_types']  = 'pdf';
        $config['max_size']       = '2000';
        $this->upload->initialize($config);
        $field_name = "surat"; #name di form view
        if (!$this->upload->do_upload($field_name)) {
          $data = array(
            'title'         => 'Ubah Arsip SK Lurah',
            'arsip'         => $this->M_surat_keputusan->get_data($id_surat),
            'isi'           => 'surat_keputusan/v_edit',
            'error_upload'  => $this->upload->display_errors(),
          );
          $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        } else {
          // hapus arsip
          $surat = $this->M_surat_keputusan->get_data($id_surat);
          if ($surat->surat != "") {
            unlink('./assets/arsipSurat/keputusan/' . $surat->surat);
          }

          $upload_data = array('uploads' => $this->upload->data());
          $data = array(
            'id_surat'    => $id_surat,
            'materi'      => $this->input->post('materi'),
            'nomor_surat' => $this->input->post('nomor_surat'),
            'keterangan'  => $this->input->post('keterangan'),
            'surat'       => $upload_data['uploads']['file_name'],
          );

          $this->M_surat_keputusan->edit($data);
          $this->session->set_flashdata('pesan', 'Data berhasil diedit');
          redirect('surat_keputusan');
        }
      } else {
        $data = array(
          'id_surat'    => $id_surat,
          'materi'      => $this->input->post('materi'),
          'nomor_surat' => $this->input->post('nomor_surat'),
          'keterangan'  => $this->input->post('keterangan'),
        );

        $this->M_surat_keputusan->edit($data);
        $this->session->set_flashdata('pesan', 'Data berhasil diedit');
        redirect('surat_keputusan');
      }
    }

    $data = array(
      'title'   => 'Ubah Arsip SK Lurah',
      'arsip'   => $this->M_surat_keputusan->get_data($id_surat),
      'isi'     => 'surat_keputusan/v_edit',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Delete one item
  public function delete($id_surat)
  {
    // hapus gambar
    $surat = $this->M_surat_keputusan->get_data($id_surat);
    if ($surat->surat != "") {
      unlink('./assets/arsipSurat/keputusan/' . $surat->surat);
    }

    $data = array('id_surat' => $id_surat);
    $this->M_surat_keputusan->delete($data);
    $this->session->set_flashdata('pesan', 'Data telah dihapus');
    redirect(base_url('surat_keputusan'));
  }
}
