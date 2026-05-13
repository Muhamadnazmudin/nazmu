<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Category extends MY_Controller
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

    public function index($slug)
    {
        $category =
            $this->Category_model
            ->get_by_slug($slug);

        if(!$category){
            show_404();
        }

        $data['title'] =
            $category->name;

        $data['category'] =
            $category;

        $data['posts'] =
            $this->Post_model
            ->get_posts_by_category(
                $category->id
            );

        $data['categories'] =
            $this->Category_model
            ->get_all();

        $data['popular_posts'] =
            $this->Post_model
            ->get_popular_posts();

        $this->load->view(
            'public/category',
            $data
        );
    }
}