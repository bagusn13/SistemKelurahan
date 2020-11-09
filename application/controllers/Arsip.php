<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->model('M_arsip');
  }

  // List all your items
  public function index()
  {
    $data = array(
      'title'   => 'Arsip Surat',
      'arsip'   => $this->M_arsip->get_all_data(),
      'isi'     => 'arsip/v_arsip',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  // Add a new item
  public function add()
  {
    $this->form_validation->set_rules(
      'judul_surat',
      'Judul Surat',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'nomor_surat',
      'Nomor Surat',
      'required',
      array('required' => '%s Harus Diisi')
    );

    if ($this->form_validation->run() == TRUE) {
      $config['upload_path']    = './assets/arsipSurat/';
      $config['allowed_types']  = 'pdf';
      $config['max_size']       = '2000';
      $this->upload->initialize($config);
      $field_name = "surat"; #name di form view
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title'         => 'Membuat arsip Surat',
          'arsip'         => $this->M_arsip->get_all_data(),
          'isi'           => 'arsip/v_arsip',
          'error_upload'  => $this->upload->display_errors(),
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
      } else {
        $upload_data              = array('uploads' => $this->upload->data());
        $config['image_library']  = 'gd2';
        $config['source_image']   = './assets/image/' . $upload_data['uploads']['file_name'];
        $this->load->library('image_lib', $config);

        $data = array(
          'judul_surat' => $this->input->post('judul_surat'),
          'nomor_surat' => $this->input->post('nomor_surat'),
          'created_at'  => date("Y-m-d H:i:s"),
          'modified_at' => date("Y-m-d H:i:s"),
          'surat'       => $upload_data['uploads']['file_name'],
        );

        $this->M_arsip->add($data);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan');
        redirect('arsip');
      }
    }

    $data = array(
      'title'   => 'Arsip Surat',
      'arsip'   => $this->M_arsip->get_all_data(),
      'isi'     => 'arsip/v_arsip',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Update one item
  public function edit($id_arsip)
  {
    $this->form_validation->set_rules(
      'judul_surat',
      'Judul Surat',
      'required',
      array('required' => '%s Harus Diisi')
    );
    $this->form_validation->set_rules(
      'nomor_surat',
      'Nomor Surat',
      'required',
      array('required' => '%s Harus Diisi')
    );

    if ($this->form_validation->run() == TRUE) {
      $config['upload_path']    = './assets/arsipSurat/';
      $config['allowed_types']  = 'pdf';
      $config['max_size']       = '2000';
      $this->upload->initialize($config);
      $field_name = "surat"; #name di form view
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title'         => 'Arsip Surat',
          'arsip'         => $this->M_arsip->get_all_data(),
          'isi'           => 'arsip/v_arsip',
          'error_upload'  => $this->upload->display_errors(),
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
      } else {
        // hapus arsip
        $surat = $this->M_arsip->get_data($id_arsip);
        if ($surat->surat != "") {
          unlink('./assets/arsipSurat/' . $surat->surat);
        }

        $upload_data              = array('uploads' => $this->upload->data());
        $config['image_library']  = 'gd2';
        $config['source_image']   = './assets/arsipSurat/' . $upload_data['uploads']['file_name'];
        $this->load->library('image_lib', $config);

        $data = array(
          'id_arsip'    => $id_arsip,
          'judul_surat' => $this->input->post('judul_surat'),
          'nomor_surat' => $this->input->post('nomor_surat'),
          'modified_at' => date("Y-m-d H:i:s"),
          'surat'       => $upload_data['uploads']['file_name'],
        );

        $this->M_arsip->edit($data);
        $this->session->set_flashdata('pesan', 'Data berhasil diedit');
        redirect('arsip');
      }
      $data = array(
        'id_arsip'    => $id_arsip,
        'judul_surat' => $this->input->post('judul_surat'),
        'nomor_surat' => $this->input->post('nomor_surat'),
        'modified_at' => date("Y-m-d H:i:s")
      );

      $this->M_arsip->edit($data);
      $this->session->set_flashdata('pesan', 'Data berhasil diedit');
      redirect('arsip');
    }
    $data = array(
      'title'   => 'Arsip Surat',
      'arsip'   => $this->M_arsip->get_all_data(),
      'isi'     => 'arsip/v_arsip',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  //Delete one item
  public function delete($id_arsip)
  {
    // hapus gambar
    $surat = $this->M_arsip->get_data($id_arsip);
    if ($surat->surat != "") {
      unlink('./assets/arsipSurat/' . $surat->surat);
    }

    $data = array('id_arsip' => $id_arsip);
    $this->M_arsip->delete($data);
    $this->session->set_flashdata('pesan', 'Data telah dihapus');
    redirect(base_url('arsip'));
  }
}




  //Update one item
  // public function edit($id_arsip)
  // {
  //   $this->form_validation->set_rules(
  //     'judul_surat',
  //     'Judul Surat',
  //     'required',
  //     array('required' => '%s Harus Diisi')
  //   );
  //   $this->form_validation->set_rules(
  //     'nomor_surat',
  //     'Nomor Surat',
  //     'required',
  //     array('required' => '%s Harus Diisi')
  //   );

  //   if ($this->form_validation->run() == TRUE) {
  //     $config['upload_path']    = './assets/arsipSurat/';
  //     $config['allowed_types']  = 'pdf';
  //     $config['max_size']       = '2000';
  //     $this->upload->initialize($config);
  //     $field_name = "surat"; #name di form view
  //     if (!$this->upload->do_upload($field_name)) {
  //       $data = array(
  //         'title'         => 'Edit Arsip Surat',
  //         'surat'         => $this->M_arsip->get_data($id_arsip),
  //         'error_upload'  => $this->upload->display_errors(),
  //         'isi'           => 'arsip/v_edit',
  //       );
  //       $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  //     } else {
  //       // hapus arsip
  //       $surat = $this->M_arsip->get_data($id_arsip);
  //       if ($surat->surat != "") {
  //         unlink('./assets/arsipSurat/' . $surat->surat);
  //       }

  //       $upload_data              = array('uploads' => $this->upload->data());
  //       $config['image_library']  = 'gd2';
  //       $config['source_image']   = './assets/arsipSurat/' . $upload_data['uploads']['file_name'];
  //       $this->load->library('image_lib', $config);

  //       $data = array(
  //         'id_arsip'    => $id_arsip,
  //         'judul_surat' => $this->input->post('judul_surat'),
  //         'nomor_surat' => $this->input->post('nomor_surat'),
  //         'modified_at' => date("Y-m-d H:i:s"),
  //         'surat'       => $upload_data['uploads']['file_name'],
  //       );

  //       $this->M_arsip->edit($data);
  //       $this->session->set_flashdata('pesan', 'Data berhasil diedit');
  //       redirect('arsip');
  //     }
  //     $data = array(
  //       'id_arsip'    => $id_arsip,
  //       'judul_surat' => $this->input->post('judul_surat'),
  //       'nomor_surat' => $this->input->post('nomor_surat'),
  //       'modified_at' => date("Y-m-d H:i:s")
  //     );

  //     $this->M_arsip->edit($data);
  //     $this->session->set_flashdata('pesan', 'Data berhasil diedit');
  //     redirect('arsip');
  //   }
  //   $data = array(
  //     'title'     => 'Edit Arsip Surat',
  //     'surat'     => $this->M_arsip->get_data($id_arsip),
  //     'isi'       => 'arsip/v_edit',
  //   );
  //   $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  // }
