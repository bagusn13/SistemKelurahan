<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->model('M_surat_masuk');
    $this->load->model('M_kategori');
  }

  // List all your items
  public function index()
  {
    $data = array(
      'title'   => 'Surat Masuk',
      'arsip'   => $this->M_surat_masuk->get_all_data(),
      'isi'     => 'surat_masuk/v_arsip',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  // Add a new item
  public function add()
  {
    $this->form_validation->set_rules(
      'dari',
      'Dari',
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
      'tanggal_surat',
      'Tanggal Surat',
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
      'di',
      'Di',
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
      $config['upload_path']    = './assets/arsipSurat/masuk/';
      $config['allowed_types']  = 'pdf';
      $config['max_size']       = '2000';
      $this->upload->initialize($config);
      $field_name = "surat"; #name di form view
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title'         => 'Tambah Arsip Surat Masuk',
          'kategori'      => $this->M_kategori->get_all_data(),
          'isi'           => 'surat_masuk/v_add',
          'error_upload'  => $this->upload->display_errors(),
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $data = array(
          'tanggal_arsip'  => date("Y-m-d"),
          'dari'           => $this->input->post('dari'),
          'nomor_surat'    => $this->input->post('nomor_surat'),
          'tanggal_surat'  => $this->input->post('tanggal_surat'),
          'perihal'        => $this->input->post('perihal'),
          'di'             => $this->input->post('di'),
          'keterangan'     => $this->input->post('keterangan'),
          'kategori'       => $this->input->post('kategori'),
          'surat'          => $upload_data['uploads']['file_name'],
        );

        $this->M_surat_masuk->add($data);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan');
        redirect('surat_masuk');
      }
    }

    $data = array(
      'title'     => 'Tambah Arsip Surat Masuk',
      'kategori'  => $this->M_kategori->get_all_data(),
      'isi'       => 'surat_masuk/v_add',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Update one item
  public function edit($id_surat)
  {
    $this->form_validation->set_rules(
      'dari',
      'Dari',
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
      'tanggal_surat',
      'Tanggal Surat',
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
      'di',
      'Di',
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
        $config['upload_path']    = './assets/arsipSurat/masuk/';
        $config['allowed_types']  = 'pdf';
        $config['max_size']       = '2000';
        $this->upload->initialize($config);
        $field_name = "surat"; #name di form view
        if (!$this->upload->do_upload($field_name)) {
          $data = array(
            'title'         => 'Ubah Arsip Surat Masuk',
            'arsip'         => $this->M_surat_masuk->get_data($id_surat),
            'kategori'      => $this->M_kategori->get_all_data(),
            'isi'           => 'surat_masuk/v_edit',
            'error_upload'  => $this->upload->display_errors(),
          );
          $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        } else {
          // hapus arsip
          $surat = $this->M_surat_masuk->get_data($id_surat);
          if ($surat->surat != "") {
            unlink('./assets/arsipSurat/masuk/' . $surat->surat);
          }

          $upload_data = array('uploads' => $this->upload->data());
          $data = array(
            'id_surat'       => $id_surat,
            'dari'           => $this->input->post('dari'),
            'nomor_surat'    => $this->input->post('nomor_surat'),
            'tanggal_surat'  => $this->input->post('tanggal_surat'),
            'perihal'        => $this->input->post('perihal'),
            'di'             => $this->input->post('di'),
            'keterangan'     => $this->input->post('keterangan'),
            'kategori'       => $this->input->post('kategori'),
            'surat'          => $upload_data['uploads']['file_name'],
          );

          $this->M_surat_masuk->edit($data);
          $this->session->set_flashdata('pesan', 'Data berhasil diedit');
          redirect('surat_masuk');
        }
      } else {
        $data = array(
          'id_surat'       => $id_surat,
          'dari'           => $this->input->post('dari'),
          'nomor_surat'    => $this->input->post('nomor_surat'),
          'tanggal_surat'  => $this->input->post('tanggal_surat'),
          'perihal'        => $this->input->post('perihal'),
          'di'             => $this->input->post('di'),
          'keterangan'     => $this->input->post('keterangan'),
          'kategori'       => $this->input->post('kategori'),
        );

        $this->M_surat_masuk->edit($data);
        $this->session->set_flashdata('pesan', 'Data berhasil diedit');
        redirect('surat_masuk');
      }
    }

    $data = array(
      'title'     => 'Ubah Arsip Surat Masuk',
      'arsip'     => $this->M_surat_masuk->get_data($id_surat),
      'kategori'  => $this->M_kategori->get_all_data(),
      'isi'       => 'surat_masuk/v_edit',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Delete one item
  public function delete($id_surat)
  {
    // hapus gambar
    $surat = $this->M_surat_masuk->get_data($id_surat);
    if ($surat->surat != "") {
      unlink('./assets/arsipSurat/masuk/' . $surat->surat);
    }

    $data = array('id_surat' => $id_surat);
    $this->M_surat_masuk->delete($data);
    $this->session->set_flashdata('pesan', 'Data telah dihapus');
    redirect(base_url('surat_masuk'));
  }
}
