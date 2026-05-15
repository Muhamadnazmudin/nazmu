<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Post_model'
        );

        $this->load->model(
            'Category_model'
        );
        $this->load->model(
            'Slider_model'
            );
    }
    

    public function index()
{
    $featured =
    $this->Post_model
    ->get_featured_post();

    $data['meta_title'] =
    $this->setting
    ->site_name;

    $data['meta_description'] =
    !empty(
    $this->setting
    ->meta_description
    )
    ? $this->setting
    ->meta_description
    : $this->setting
    ->site_description;

    $data['featured'] =
    $featured;

    $data['posts'] =
    $this->Post_model
    ->get_latest_posts(
        6,
        $featured->id
        ?? null
    );

    $data['categories'] =
    $this->Category_model
    ->get_all();

    $data['popular_posts'] =
    $this->Post_model
    ->get_popular_posts();
    
    $data['sliders'] =
    $this->Slider_model
    ->get_published();

    $this->load->view(
        'public/home',
        $data
    );
}
}