<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Blog extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Post_model'
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
        redirect('/');
    }

    public function detail($slug)
    {
        $post =
        $this->Post_model
        ->get_by_slug(
            $slug
        );

        // kalau artikel tidak ditemukan
        if(!$post){
            show_404();
        }

        // tambah views
        $this->db
        ->set(
            'views',
            'views+1',
            FALSE
        );

        $this->db
        ->where(
            'id',
            $post->id
        );

        $this->db
        ->update(
            'posts'
        );

        // ambil komentar approved
        $comments =
        $this->Comment_model
        ->get_by_post(
            $post->id
        );

        $data['title'] =
        $post->title;

        $data['post'] =
        $post;

        $data['comments'] =
        $comments;

        $data['categories'] =
        $this->Category_model
        ->get_all();

        $this->load->view(
            'public/detail',
            $data
        );
    }
}