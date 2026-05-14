<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_categories extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Download_category_model'
        );
    }

    public function index()
    {
        $data['title'] =
            'Kategori Download';

        $data['categories'] =
            $this->Download_category_model
                ->get_all();

        $this->load->view(
            'admin/download_categories/index',
            $data
        );
    }

    public function store()
    {
        $name =
            $this->input->post(
                'name',
                true
            );

        $data = [

            'name' =>
                $name,

            'slug' =>
                url_title(
                    $name,
                    '-',
                    true
                ),

            'created_at' =>
                date(
                    'Y-m-d H:i:s'
                )
        ];

        $this->Download_category_model
            ->insert($data);

        $this->session
            ->set_flashdata(
                'success',
                'Kategori berhasil ditambahkan'
            );

        redirect(
            'admin/download_categories'
        );
    }

    public function update($id)
    {
        $name =
            $this->input->post(
                'name',
                true
            );

        $data = [

            'name' =>
                $name,

            'slug' =>
                url_title(
                    $name,
                    '-',
                    true
                )
        ];

        $this->Download_category_model
            ->update(
                $id,
                $data
            );

        $this->session
            ->set_flashdata(
                'success',
                'Kategori berhasil diupdate'
            );

        redirect(
            'admin/download_categories'
        );
    }

    public function delete($id)
    {
        $this->Download_category_model
            ->delete($id);

        $this->session
            ->set_flashdata(
                'success',
                'Kategori berhasil dihapus'
            );

        redirect(
            'admin/download_categories'
        );
    }
}