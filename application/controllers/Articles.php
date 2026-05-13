<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Articles extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Post_model'
        );

        $this->load->model(
            'Category_model'
        );
    }

    public function index()
    {
        $data['title'] =
            'Artikel';

        $data['posts'] =
            $this->Post_model
            ->get_all_published();

        $data['categories'] =
            $this->Category_model
            ->get_all();

        $data['popular_posts'] =
            $this->Post_model
            ->get_popular_posts();

        $this->load->view(
            'public/articles',
            $data
        );
    }
}