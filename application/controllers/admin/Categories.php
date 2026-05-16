<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Categories
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
                'auth'
            );
        }

        $this->load->model(
            'Category_model'
        );
    }

    // semua kategori
    public function index()
    {
        $data['title'] =
        'Kategori';

        $data['categories'] =
        $this->Category_model
        ->get_all();

        $this->load->view(
            'admin/categories/index',
            $data
        );
    }

    // simpan
    public function store()
    {
        $name =
        $this->input
        ->post('name');

        $data = [

            'name' =>
            $name,

            'slug' =>
            $this->Category_model
            ->generate_slug(
                $name
            )
        ];

        $this->Category_model
        ->insert($data);

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOG
        |--------------------------------------------------------------------------
        */
        activity_log(
            'CATEGORY',
            'Menambahkan kategori: ' .
            $name
        );

        redirect(
            'admin/categories'
        );
    }

    // edit
    public function update($id)
    {
        $name =
        $this->input
        ->post('name');

        $data = [

            'name' =>
            $name,

            'slug' =>
            $this->Category_model
            ->generate_slug(
                $name
            )
        ];

        $this->Category_model
        ->update(
            $id,
            $data
        );

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOG
        |--------------------------------------------------------------------------
        */
        activity_log(
            'CATEGORY',
            'Mengubah kategori: ' .
            $name
        );

        redirect(
            'admin/categories'
        );
    }

    // delete
    public function delete($id)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA DULU
        |--------------------------------------------------------------------------
        */
        $category =
        $this->db
        ->get_where(
            'categories',
            [
                'id' => $id
            ]
        )
        ->row();

        $this->Category_model
        ->delete($id);

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOG
        |--------------------------------------------------------------------------
        */
        activity_log(
            'CATEGORY',
            'Menghapus kategori: ' .
            (
                $category->name
                ?? 'Unknown'
            )
        );

        redirect(
            'admin/categories'
        );
    }
}