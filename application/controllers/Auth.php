<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function index()
    {
        $this->load->view(
            'auth/login'
        );
    }

    public function login()
    {
        $username = trim(
            $this->input->post(
                'username',
                true
            )
        );

        $password = $this->input->post(
            'password'
        );

        $user = $this->db
            ->where(
                'username',
                $username
            )
            ->get('users')
            ->row();

        // Username salah
        if (!$user) {

            $this->session->set_flashdata(
                'error',
                'Username tidak ditemukan.'
            );

            redirect('asup');
        }

        // Password salah
        if (
            !password_verify(
                $password,
                $user->password
            )
        ) {

            $this->session->set_flashdata(
                'error',
                'Password yang dimasukkan salah.'
            );

            redirect('asup');
        }

        // Session login
        $session = [

            'id_user'   => $user->id,
            'nama'      => $user->nama,
            'username'  => $user->username,
            'photo'     => $user->photo,
            'logged_in' => true
        ];

        // Regenerate session
        $this->session->sess_regenerate(TRUE);

        // Simpan session
        $this->session->set_userdata(
            $session
        );

        redirect('admin');
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('asup');
    }
}