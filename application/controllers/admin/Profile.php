<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Profile
extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(
        !$this->session
        ->userdata(
        'logged_in'
        )
        ){
            redirect('auth');
        }

        $this->load->model(
        'User_model'
        );
    }

    public function index()
    {
        $id =
        $this->session
        ->userdata(
        'id_user'
        );

        $data['title'] =
        'Profile Saya';

        $data['user'] =
        $this->User_model
        ->get_by_id($id);

        $this->load->view(
        'admin/profile/index',
        $data
        );
    }

    public function update()
    {
        $id =
        $this->session
        ->userdata(
        'id_user'
        );

        $user =
        $this->User_model
        ->get_by_id($id);

        $photo =
        $user->photo ?? '';

        if(
        !empty(
        $_FILES['photo']['name']
        )
        ){

            if(
            !is_dir(
            './uploads/users'
            )
            ){
                mkdir(
                './uploads/users',
                0777,
                true
                );
            }

            $config['upload_path'] =
            './uploads/users/';

            $config['allowed_types'] =
            'jpg|jpeg|png|webp';

            $config['encrypt_name'] =
            TRUE;

            $this->load->library(
            'upload',
            $config
            );

            if(
            $this->upload
            ->do_upload(
            'photo'
            )
            ){
                $upload =
                $this->upload
                ->data();

                $photo =
                $upload[
                'file_name'
                ];
            }
        }

        $data = [

        'nama' =>
        $this->input
        ->post(
        'nama'
        ),

        'username' =>
        $this->input
        ->post(
        'username'
        ),

        'email' =>
        $this->input
        ->post(
        'email'
        ),

        'photo' =>
        $photo

        ];

        if(
        !empty(
        $this->input
        ->post(
        'password'
        )
        )
        ){
            $data[
            'password'
            ] =
            password_hash(
            $this->input
            ->post(
            'password'
            ),
            PASSWORD_DEFAULT
            );
        }

        $this->User_model
        ->update(
        $id,
        $data
        );

        // update session
        $this->session
->set_userdata([

    'nama' =>
    $data['nama'],

    'username' =>
    $data['username'],

    'photo' =>
    $photo

]);

        $this->session
        ->set_flashdata(
        'success',
        'Profile berhasil diperbarui'
        );

        redirect(
        'admin/profile'
        );
    }
}