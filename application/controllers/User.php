<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // Load Dependencies
    $this->load->model('m_user');
  }

  // List all users
  public function index()
  {
    $data = array(
      'title' => 'User',
      'user'  => $this->m_user->get_all_data(),
      'isi'   => 'v_user',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  // Add a new user
  public function add()
  {
    $this->form_validation->set_rules('nama_user', 'Nama User', 'required', array('required' => '%s Harus diisi'));

    $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[12]|is_unique[tbl_user.username]', array(
      'required'      => '%s Harus diisi',
      'min_length'    => '%s Minimal 6 karakter',
      'max_length'    => '%s Maksimal 12 karakter',
      'is_unique'     => '%s Sudah ada. Buat username baru.'
    ));

    $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s Harus diisi'));

    if ($this->form_validation->run() == TRUE) {
      $data = array(
        'nama_user'  => $this->input->post('nama_user'),
        'username'   => $this->input->post('username'),
        'password'   => SHA1($this->input->post('password')),
        'level_user' => $this->input->post('level_user'),
      );
      $this->m_user->add($data);
      $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan');
      redirect('user');
    }
    $data = array(
      'title' => 'User',
      'user'  => $this->m_user->get_all_data(),
      'isi'   => 'v_user',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  // Edit one user
  public function edit($id_user)
  {
    $this->form_validation->set_rules('nama_user', 'Nama User', 'required', array('required' => '%s Harus diisi'));

    $this->form_validation->set_rules('username', 'Username', 'required', array('required' => '%s Harus diisi'));

    if ($this->form_validation->run() == TRUE) {
      if ($this->input->post('password') == '') {
        $data = array(
          'id_user'    => $id_user,
          'nama_user'  => $this->input->post('nama_user'),
          'username'   => $this->input->post('username'),
          'level_user' => $this->input->post('level_user'),
        );
        $this->m_user->edit($data);
        $this->session->set_flashdata('pesan', 'Data berhasil diedit kecuali password');
        redirect('user');
      } else {
        $data = array(
          'id_user'    => $id_user,
          'nama_user'  => $this->input->post('nama_user'),
          'username'   => $this->input->post('username'),
          'password'   => SHA1($this->input->post('password')),
          'level_user' => $this->input->post('level_user'),
        );
        $this->m_user->edit($data);
        $this->session->set_flashdata('pesan', 'Data berhasil diedit');
        redirect('user');
      }
    }
    $data = array(
      'title' => 'User',
      'user'  => $this->m_user->get_all_data(),
      'isi'   => 'v_user',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  // Delete one user
  public function delete($id_user)
  {
    $data = array('id_user' => $id_user);
    $this->m_user->delete($data);
    $this->session->set_flashdata('pesan', 'Data telah dihapus');
    redirect(base_url('user'));
  }
}

/* End of file Controllername.php */
