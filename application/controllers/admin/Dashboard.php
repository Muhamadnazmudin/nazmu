<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Dashboard
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
        'Post_model'
        );

        $this->load->model(
        'Media_model'
        );

        $this->load->model(
        'Comment_model'
        );

        $this->load->model(
        'Category_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Dashboard';

        // Statistics
        $data['total_posts'] =
        $this->Post_model
        ->count_all();

        $data['total_media'] =
        $this->Media_model
        ->count_all();

        $data['total_comments'] =
        $this->Comment_model
        ->count_all();

        $data['total_categories'] =
        $this->Category_model
        ->count_all();

        $this->load->view(
        'admin/dashboard',
        $data
        );
    }
}