<?php


defined('BASEPATH') or exit('No direct script access allowed');

class User_login
{
  protected $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
    // Load data model auth
    $this->ci->load->model('m_auth');
  }

  public function login($username, $password)
  {
    $cek = $this->ci->m_auth->login_user($username, $password);
    // jika ada data user, maka create session login
    if ($cek) {
      $id_user    = $cek->id_user;
      $nama_user  = $cek->nama_user;
      $username   = $cek->username;
      $level_user = $cek->level_user;
      // buat session
      $this->ci->session->set_userdata('id_user', $id_user);
      $this->ci->session->set_userdata('username', $username);
      $this->ci->session->set_userdata('nama_user', $nama_user);
      $this->ci->session->set_userdata('level_user', $level_user);
      // redirect ke halaman dashboard admin
      redirect('admin');
    } else {
      // jika tidak ada (username password salah), maka suruh login lagi
      $this->ci->session->set_flashdata('error', 'Username atau Password salah');
      redirect('auth');
    }
  }

  public function proteksi_halaman()
  {
    if ($this->ci->session->userdata('username') == '') {
      $this->ci->session->set_flashdata('error', 'Anda belum melakukan login');
      redirect('auth');
    }
  }

  public function logout()
  {
    $this->ci->session->unset_userdata('id_user');
    $this->ci->session->unset_userdata('username');
    $this->ci->session->unset_userdata('nama_user');
    $this->ci->session->unset_userdata('level_user');
    $this->ci->session->set_flashdata('pesan', 'Anda berhasil logout');
    redirect('auth');
  }
}

/* End of file User_login.php */
