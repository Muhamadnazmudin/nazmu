<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Users
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
            redirect(
            'login'
            );
        }

        $this->load->model(
        'User_model'
        );

        $this->load->helper([
            'url',
            'form'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['title'] =
        'Manajemen User';

        $data['users'] =
        $this->User_model
        ->get_all();

        $this->load->view(
        'admin/users/index',
        $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data['title'] =
        'Tambah User';

        $this->load->view(
        'admin/users/create',
        $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $photo = null;

        /*
        |----------------------------------
        | Upload Photo
        |----------------------------------
        */

        if(
        !empty(
        $_FILES['photo']['name']
        )
        ){

            if(
            !is_dir(
            './uploads/users/'
            )
            ){
                mkdir(
                './uploads/users/',
                0755,
                true
                );
            }

            $config['upload_path'] =
            './uploads/users/';

            $config['allowed_types'] =
            'jpg|jpeg|png|webp';

            $config['encrypt_name'] =
            true;

            $config['max_size'] =
            2048;

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
                $upload['file_name'];
            }
        }

        $data = [

            'nama' =>
            $this->input->post(
            'nama',
            true
            ),

            'username' =>
            $this->input->post(
            'username',
            true
            ),

            'email' =>
            $this->input->post(
            'email',
            true
            ),

            'password' =>
            password_hash(
                $this->input->post(
                'password'
                ),
                PASSWORD_DEFAULT
            ),

            'photo' =>
            $photo,

            'role' =>
            $this->input->post(
            'role'
            ),

            'created_at' =>
            date(
            'Y-m-d H:i:s'
            )
        ];

        $this->User_model
        ->insert(
        $data
        );

        $this->session
        ->set_flashdata(
        'success',
        'User berhasil ditambahkan'
        );

        redirect(
        'admin/users'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $user =
        $this->User_model
        ->get_by_id(
        $id
        );

        if(!$user){
            show_404();
        }

        $data['title'] =
        'Edit User';

        $data['user'] =
        $user;

        $this->load->view(
        'admin/users/edit',
        $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $user =
        $this->User_model
        ->get_by_id(
        $id
        );

        if(!$user){
            show_404();
        }

        $data = [

            'nama' =>
            $this->input->post(
            'nama',
            true
            ),

            'username' =>
            $this->input->post(
            'username',
            true
            ),

            'email' =>
            $this->input->post(
            'email',
            true
            ),

            'role' =>
            $this->input->post(
            'role'
            ),

            'updated_at' =>
            date(
            'Y-m-d H:i:s'
            )
        ];

        /*
        |----------------------------------
        | Password Optional
        |----------------------------------
        */

        if(
        !empty(
        $this->input->post(
        'password'
        )
        )
        ){

            $data['password'] =
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

        $this->session
        ->set_flashdata(
        'success',
        'User berhasil diupdate'
        );

        redirect(
        'admin/users'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        /*
        | Prevent delete self
        */

        if(
        $id ==
        $this->session
        ->userdata(
        'id_user'
        )
        ){
            $this->session
            ->set_flashdata(
            'error',
            'Tidak bisa menghapus akun sendiri'
            );

            redirect(
            'admin/users'
            );
        }

        $user =
        $this->User_model
        ->get_by_id(
        $id
        );

        if(!$user){
            show_404();
        }

        /*
        | Delete photo
        */

        if(
        !empty(
        $user->photo
        )
        &&
        file_exists(
        './uploads/users/' .
        $user->photo
        )
        ){
            unlink(
            './uploads/users/' .
            $user->photo
            );
        }

        $this->User_model
        ->delete(
        $id
        );

        $this->session
        ->set_flashdata(
        'success',
        'User berhasil dihapus'
        );

        redirect(
        'admin/users'
        );
    }
}