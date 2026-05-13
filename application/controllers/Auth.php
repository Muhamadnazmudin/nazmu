<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function login()
{
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->db
        ->where('username', $username)
        ->get('users')
        ->row();

    if (!$user) {
        echo "Username tidak ditemukan";
        die;
    }

    if (!password_verify($password, $user->password)) {
        echo "Password salah";
        die;
    }

    $session = [
    'id_user' =>
    $user->id,

    'nama' =>
    $user->nama,

    'username' =>
    $user->username,

    'photo' =>
    $user->photo,

    'logged_in' =>
    true
];

    $this->session->set_userdata($session);

    redirect('admin');
}

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}