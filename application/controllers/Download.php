<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Download_model'
        );

        $this->load->model(
            'Download_category_model'
        );
        $this->load->helper('download');
    }

    public function index()
    {
        $data['title'] =
            'Download';

        $data['downloads'] =
            $this->Download_model
                ->get_published();

        $data['download_categories']
=
$this->Download_category_model
->get_all();

        $this->load->view(
            'public/download/index',
            $data
        );
    }

    public function file($slug)
    {
        $file =
            $this->Download_model
                ->get_by_slug(
                    $slug
                );

        if (!$file) {
            show_404();
        }

        /*
        Increment download
        */
        $this->Download_model
            ->increment_download(
                $file->id
            );

        /*
        External URL
        */
        if (
            $file->file_source
            == 'external'
        ) {

            redirect(
                $file->external_url
            );
        }

        /*
        Local file
        */
        if (
            !empty(
                $file->file_path
            )
        ) {

            force_download(
                FCPATH .
                $file->file_path,
                NULL
            );
        }

        show_404();
    }

    public function category($slug)
    {
        $category =
            $this->Download_category_model
                ->get_by_slug(
                    $slug
                );

        if (!$category) {
            show_404();
        }

        $data['title'] =
            'Download - ' .
            $category->name;

        $data['downloads'] =
            $this->Download_model
                ->get_by_category(
                    $category->id
                );

        $data['category'] =
            $category;

       $data['download_categories']
=
$this->Download_category_model
->get_all();

        $this->load->view(
            'public/download/index',
            $data
        );
    }
}